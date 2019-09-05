<?php

namespace App\Provider;

use App\Entity\Cart;
use App\Repository\CartRepository;
use Doctrine\Common\Persistence\ObjectManager;

class CartProvider
{
    /**
     * @var CartRepository
     */
    private $cartRepository;
    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(CartRepository $cartRepository, ObjectManager $manager)
    {
        $this->cartRepository = $cartRepository;
        $this->manager = $manager;
    }

    public function provideCart(string $code): Cart
    {
        $cart = $this->cartRepository->findOneBy(['code' => $code]);

        if (null === $cart) {
            $cart = new Cart($code);

            $this->manager->persist($cart);
        }

        return  $cart;
    }
}
