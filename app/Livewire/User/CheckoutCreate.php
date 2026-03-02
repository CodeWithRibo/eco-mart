<?php

namespace App\Livewire\User;

use App\Contracts\CartServiceInterface;
use App\Livewire\Concerns\HasToast;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CheckoutCreate extends Component
{
    use HasToast;
    public $addressId;
    /*Orders*/
//    public $payment_method;

    public $deliveryFee = 40; /*Default Fee*/

    protected CartServiceInterface $cartService;

    public function boot(CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
    }


//    protected function rules(): array
//    {
//        return [
//            'payment_method' => 'nullable|required',
//        ];
//    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \Throwable
     */

    #[On('selected-address')]
    public function loadCheckout($id): void
    {
        $this->addressId = $id;
    }

    public function save()
    {
//        $this->validate();
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

            $latestOrder = Order::query()->latest('id')->first();
            $currentYear = Carbon::now()->year;

            if ($latestOrder) {
                $lastNumber = (int) substr($latestOrder->order_number, -3);
                $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $nextNumber = '001';
            }

            $orderNumber = 'ORD-' . $currentYear . '-' . $nextNumber;

            $order = Order::query()->create([
                'total_amount' => $total + $this->deliveryFee,
                'order_number' => $orderNumber,
                'payment_method' => 'Gcash', //Temporary
                'user_id' => auth()->id(),
            ]);

            Address::query()
                ->where('id', $this->addressId)
                ->update([
                'order_id' => $order->id,
            ]);

            foreach ($cart as $item) {

                OrderItem::query()->create([
                    'order_id'     => $order->id,
                    'product_id'   => $item['id'],
                    'product_name' => $item['product_name'],
                    'subtotal'     => $item['subtotal'],
                    'quantity'     => $item['quantity'],
                    'unit_price'   => $item['price'],
                    'user_id'      => auth()->id()
                ]);

                Product::query()->where('id', $item['id'])
                    ->decrement('stock', $item['quantity']);
            }

            DB::commit();

            session()->forget('cart');
            $this->successCheckout('Successfully Checkout');
            return redirect()->route('order-successful');

        } catch (\Exception $e) {

            DB::rollBack();
            Log::error('Checkout Failed: ' . $e->getMessage());

            return back()->with('error', $e->getMessage());
        }
    }


    public function render() : View
    {
        return view('livewire.user.checkout-create');
    }

}
