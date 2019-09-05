<?php

declare(strict_types=1);

namespace spec\App\Handler;

use App\Entity\Cart;
use App\Entity\Item;
use App\Entity\Product;
use App\Handler\CartHandler;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

final class CartHandlerSpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(CartHandler::class);
    }

    function it_adds_product_to_cart(Cart $cart, Product $product): void
    {
        $product->getName()->willReturn('Product name');
        $product->getPrice()->willReturn(1000);

        $cart->addItem(new Item('Product name', 1000))->shouldBeCalled();

        $cart->addItem(Argument::type(Item::class))->shouldBeCalled();
        $cart->addItem(Argument::any())->shouldBeCalled();
        $cart->addItem(Argument::that(function (Item $item): bool {
            return $item->getPrice() === 1000 && $item->getProductName() === 'Product name';
        }))->shouldBeCalled();

        $this->addToCart($cart, $product);
    }
}
