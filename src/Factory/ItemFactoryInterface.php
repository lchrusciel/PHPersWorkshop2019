<?php

namespace App\Factory;

use App\Entity\Item;
use App\Entity\Product;

interface ItemFactoryInterface
{
    public function create(Product $product): Item;
}
