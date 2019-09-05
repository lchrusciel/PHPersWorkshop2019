<?php

declare(strict_types=1);

namespace spec\App\Provider;

use App\Entity\Cart;
use App\Provider\CartProvider;
use App\Repository\CartRepository;
use Doctrine\Common\Persistence\ObjectManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

final class CartProviderSpec extends ObjectBehavior
{
    function let(CartRepository $cartRepository, ObjectManager $manager)
    {
        $this->beConstructedWith($cartRepository, $manager);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(CartProvider::class);
    }

    function it_creates_cart_if_it_is_not_found_in_database(CartRepository $cartRepository, ObjectManager $manager, Cart $cart): void
    {
        $cartRepository->findOneBy(['code' => 'MY_CART'])->willReturn(null, $cart);

        $manager->persist(Argument::type(Cart::class))->shouldBeCalledOnce();

        $this->provideCart('MY_CART')->shouldBeLike(new Cart('MY_CART'));
        $this->provideCart('MY_CART')->shouldReturn($cart);
    }
}
