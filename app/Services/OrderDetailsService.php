<?php

namespace App\Services;

use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderItem;

class OrderDetailsService
{
    public function __construct()
    {
    }

    public static function latestOrderId($authId)
    {
        return OrderItem::query()
            ->where('user_id', $authId)
            ->latest()
            ->value('order_id');
    }

    public static function getOrderDetails($authId)
    {
        return Order::query()
            ->where('user_id', $authId)
            ->select(['total_amount', 'payment_method', 'order_number', 'created_at'])
            ->latest()
            ->first();
    }

    public static function getOrderItemDetails($authId)
    {
        $orderId = self::latestOrderId($authId);
        return OrderItem::query()
            ->where('user_id', $authId)
            ->where('order_id', $orderId)
            ->select(['id','product_name', 'unit_price', 'quantity', 'subtotal'])
            ->get();
    }

    public static function getOrderItemSubTotal($authId) {
        $orderId = self::latestOrderId($authId);
        return OrderItem::query()
            ->where('user_id', auth()->id())
            ->where('order_id', $orderId)
            ->sum('subtotal');
    }

    public static function getDeliveryAddress($authId)
    {
        $orderId = self::latestOrderId($authId);
        return Delivery::query()
            ->where('user_id', $authId)
            ->where('order_id', $orderId)
            ->select(['first_name', 'last_name', 'phone_number', 'address', 'region', 'province', 'city', 'barangay'])
            ->first();
    }
}
