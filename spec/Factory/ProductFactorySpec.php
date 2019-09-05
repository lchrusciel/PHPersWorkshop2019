<?php

declare(strict_types=1);

namespace spec\App\Factory;

use App\Entity\Product;
use App\Factory\ProductFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

final class ProductFactorySpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(ProductFactory::class);
    }

    function it_creates_product(): void
    {
        $this
            ->create('Product name' , 1000)
            ->shouldBeLike(new Product('Product name', 1000))
        ;
    }
}
