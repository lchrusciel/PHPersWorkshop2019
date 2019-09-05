<?php

declare(strict_types=1);

namespace App\Tests\Behat\Transformer;

use Behat\Behat\Context\Context;

final class PriceContext implements Context
{
    /**
     * @Transform :price
     */
    public function convertPrice(float $price): int
    {
        return (int) $price * 100;
    }
}
