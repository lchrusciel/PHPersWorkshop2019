<?php

declare(strict_types=1);

namespace spec\App\Factory;

use App\Entity\Item;
use App\Entity\Product;
use App\Factory\ItemFactory;
use App\Factory\ItemFactoryInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

final class ItemFactorySpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(ItemFactory::class);
    }

    function it_is_item_factory()
    {
        $this->shouldImplement(ItemFactoryInterface::class);
    }

    function it_creates_item(Product $product)
    {
        $product->getName()->willReturn('Product name');
        $product->getPrice()->willReturn(1000);

        $this
            ->create($product)
            ->shouldBeLike(new Item('Product name', 1000))
        ;
    }
}
