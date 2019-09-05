<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Product;

final class ProductFactory
{
    public function create(string $name, int $price): Product
    {
        return new Product($name, $price);
    }
}
