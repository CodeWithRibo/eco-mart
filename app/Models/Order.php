<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'status',
        'total_amount',
        'payment_method',
        'order_number',
        'user_id',

    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function delivery(): HasOne
    {
        return $this->hasOne(Delivery::class, 'order_id');
    }

    public function scopeSearch(Builder $query, $term)
    {
        $query
            ->where(function ($q) use ($term) {
//                $q->whereLike('user_id', '%'.$term.'%' ?? '');
                $q->whereLike('order_number', '%'.$term.'%' ?? '');
            });
    }

    // app/Models/Order.php
    protected $casts = [
        'total_amount' => 'float',
    ];

}
