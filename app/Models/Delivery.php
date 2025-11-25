<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Builder\Class_;

class Delivery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'address',
        'region',
        'province',
        'city',
        'barangay',
        'delivery_notes',
        'order_id',
        'rider_id',
        'status',
    ];

    public function rider()
    {
        return $this->belongsTo(User::class, 'rider_id');
    }
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::Class, 'order_id');
    }
}
