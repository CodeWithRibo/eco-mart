<?php

namespace App\Livewire\User;

use App\Contracts\CartServiceInterface;
use App\Livewire\Concerns\HasToast;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CheckoutCreate extends Component
{
    use HasToast;

    /*Delivery Information*/
    public $first_name;
    public $last_name;
    public $email;
    public $phone_number;
    public $address;
    public $region;
    public $province;
    public $city;
    public $barangay;
    public $delivery_notes;

    /*Orders*/
    public $payment_method;

    public $deliveryFee = 40; /*Default Fee*/

    protected CartServiceInterface $cartService;

    public function boot(CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
    }


    protected function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email|required',
            'address' => 'required',
            'phone_number' => ['required', 'max:11', 'regex:/^[0-9]+$/'],
            'region' => 'required',
            'province' => 'required',
            'city' => 'required',
            'barangay' => 'required',
            'delivery_notes' => 'nullable',
            'payment_method' => 'required',
        ];
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \Throwable
     */
    public function save()
    {
        $this->validate();

        DB::beginTransaction();

        try {

            $cart = session()->get('cart', []);
            $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);


            foreach ($cart as $item) {
                $product = Product::find($item['id']);

                if (!$product) {
                    $this->checkOutFailed('Product not found');
                    throw new \Exception("Product not found.");
                }

                if ($product->stock < $item['quantity']) {
                    $this->checkOutFailed("Stock too low for {$product->product_name}. Available: {$product->stock}");
                    throw new \Exception("Stock too low for {$product->product_name}. Available: {$product->stock}");
                }
            }

            $latestOrder = Order::latest('id')->first();
            $currentYear = Carbon::now()->year;

            if ($latestOrder) {
                $lastNumber = (int) substr($latestOrder->order_number, -3);
                $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $nextNumber = '001';
            }

            $orderNumber = 'ORD-' . $currentYear . '-' . $nextNumber;

            $order = Order::create([
                'total_amount' => $total + $this->deliveryFee,
                'order_number' => $orderNumber,
                'payment_method' => $this->payment_method,
                'user_id' => auth()->id(),
            ]);


            foreach ($cart as $item) {

                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item['id'],
                    'product_name' => $item['product_name'],
                    'subtotal'     => $item['subtotal'],
                    'quantity'     => $item['quantity'],
                    'unit_price'   => $item['price'],
                ]);

                Product::where('id', $item['id'])
                    ->decrement('stock', $item['quantity']);
            }


            Delivery::create([
                'first_name'     => $this->first_name,
                'last_name'      => $this->last_name,
                'email'          => $this->email,
                'phone_number'   => $this->phone_number,
                'address'        => $this->address,
                'region'         => $this->region,
                'province'       => $this->province,
                'city'           => $this->city,
                'barangay'       => $this->barangay,
                'delivery_notes' => $this->delivery_notes,
                'order_id'       => $order->id,
            ]);

            DB::commit();

            session()->forget('cart');
            $this->successCheckout('Successfully Checkout');
            return redirect()->route('shopping-carts');

        } catch (\Exception $e) {

            DB::rollBack();
            Log::error('Checkout Failed: ' . $e->getMessage());

            return back()->with('error', $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.user.checkout-create');
    }

}
