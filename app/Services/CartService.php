<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CartService
{
    public function addToCart($item)
    {
        $cart = Session::get('cart', []);
        $cart[] = $item;
        Session::put('cart', $cart);
    }

    public function removeFromCart($itemId)
    {
        $cart = Session::get('cart', []);
        $cart = array_filter($cart, function ($item) use ($itemId) {
            return $item['id'] !== $itemId;
        });
        Session::put('cart', array_values($cart));
    }

    public function getCart()
    {
        return Session::get('cart', []);
    }
}
