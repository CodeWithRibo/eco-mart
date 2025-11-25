<?php
namespace App\Contracts;

interface CartServiceInterface
{
    public function add(int $productId);

    public function remove(int $productId);

    public function getCart();
}
