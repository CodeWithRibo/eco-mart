<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeliveryRequest;
use App\Models\Delivery;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DeliveryController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Delivery::class);

        return Delivery::all();
    }

    public function store(DeliveryRequest $request)
    {
        $this->authorize('create', Delivery::class);

        return Delivery::create($request->validated());
    }

    public function show(Delivery $delivery)
    {
        $this->authorize('view', $delivery);

        return $delivery;
    }

    public function update(DeliveryRequest $request, Delivery $delivery)
    {
        $this->authorize('update', $delivery);

        $delivery->update($request->validated());

        return $delivery;
    }

    public function destroy(Delivery $delivery)
    {
        $this->authorize('delete', $delivery);

        $delivery->delete();

        return response()->json();
    }
}
