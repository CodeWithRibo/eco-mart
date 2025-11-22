<?php

namespace App\Services;

use App\Models\Product;
use Spatie\QueryBuilder\QueryBuilder;

class InventoryService
{

    public static function setProduct($validated, $image)
    {
        $products = Product::query()->create([
            'product_image' => $image,
            ... $validated
        ]);

        if ($products) {
            NotificationService::notifCreateProduct();
        }

        return redirect()->route('admin.inventories');
    }

    public static function getProduct($search, $sortColumn, $category)
    {

        $query = QueryBuilder::for(Product::class)
            ->search(trim($search))
            ->allowedSorts('category')
            ->defaultSort($sortColumn);

        if ($category != 'All Categories')
            $query->where('category', $category);

        return $query->paginate(10);

//        return Product::query()
//            ->search(trim($search))
//            ->select(['id', 'product_name', 'product_image','category', 'price', 'stock'])
//            ->paginate(10);
    }

    public static function editProduct($id)
    {
        return Product::query()->findOrFail($id);
    }

    public static function deleteProduct($id)
    {
        return Product::query()->findOrFail($id);
    }

}
