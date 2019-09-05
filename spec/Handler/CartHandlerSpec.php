<?php

declare(strict_types=1);

namespace spec\App\Handler;

use App\Entity\Cart;
use App\Entity\Item;
use App\Entity\Product;
use App\Factory\ItemFactoryInterface;
use App\Handler\CartHandler;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

final class CartHandlerSpec extends ObjectBehavior
{
    function let(ItemFactoryInterface $factory): void
    {
        $this->beConstructedWith($factory);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(CartHandler::class);
    }

    function it_adds_product_to_cart(
        Cart $cart,
        Product $product,
        Item $item,
        ItemFactoryInterface $factory
    ): void  {
        $factory->create($product)->willReturn($item);

        $cart->addItem($item)->shouldBeCalled();

        $this->addToCart($cart, $product);
    }
}
