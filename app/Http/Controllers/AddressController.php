<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeliveryRequest;
use App\Models\Address;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AddressController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Address::class);

        return Address::all();
    }

    public function store(DeliveryRequest $request)
    {
        $this->authorize('create', Address::class);

        return Address::create($request->validated());
    }

    public function show(Address $delivery)
    {
        $this->authorize('view', $delivery);

        return $delivery;
    }

    public function update(DeliveryRequest $request, Address $delivery)
    {
        $this->authorize('update', $delivery);

        $delivery->update($request->validated());

        return $delivery;
    }

    public function destroy(Address $delivery)
    {
        $this->authorize('delete', $delivery);

        $delivery->delete();

        return response()->json();
    }
}
