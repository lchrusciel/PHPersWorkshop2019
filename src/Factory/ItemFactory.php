<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Item;
use App\Entity\Product;

final class ItemFactory implements ItemFactoryInterface
{
    public function create(Product $product): Item
    {
        return new Item($product->getName(), $product->getPrice());
    }
}
