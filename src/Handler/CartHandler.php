<?php

declare(strict_types=1);

namespace App\Handler;

use App\Entity\Cart;
use App\Entity\Product;
use App\Factory\ItemFactoryInterface;

final class CartHandler
{
    /**
     * @var ItemFactoryInterface
     */
    private $factory;

    public function __construct(ItemFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function addToCart(Cart $cart, Product $product): void
    {
        $cart->addItem($this->factory->create($product));
    }
}
