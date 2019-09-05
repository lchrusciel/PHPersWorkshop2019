<?php

declare(strict_types=1);

namespace App\Handler;

use App\Entity\Cart;
use App\Entity\Item;
use App\Entity\Product;

final class CartHandler
{
    public function addToCart(Cart $cart, Product $product): void
    {
        $cart->addItem(new Item($product->getName(), $product->getPrice()));
    }
}
