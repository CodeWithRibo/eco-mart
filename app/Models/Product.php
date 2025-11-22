<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_name',
        'product_image',
        'category',
        'price',
        'stock',
    ];

    public function scopeSearch(Builder $query, $term)
    {
        $query
            ->where(function ($q) use ($term) {
                $q->whereLike('product_name', '%'.$term.'%' ?? '');
            });
    }

}
