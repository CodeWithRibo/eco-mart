<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderItemRequest;
use App\Models\OrderItem;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrderItemController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', OrderItem::class);

        return OrderItem::all();
    }

    public function store(OrderItemRequest $request)
    {
        $this->authorize('create', OrderItem::class);

        return OrderItem::create($request->validated());
    }

    public function show(OrderItem $orderItem)
    {
        $this->authorize('view', $orderItem);

        return $orderItem;
    }

    public function update(OrderItemRequest $request, OrderItem $orderItem)
    {
        $this->authorize('update', $orderItem);

        $orderItem->update($request->validated());

        return $orderItem;
    }

    public function destroy(OrderItem $orderItem)
    {
        $this->authorize('delete', $orderItem);

        $orderItem->delete();

        return response()->json();
    }
}
