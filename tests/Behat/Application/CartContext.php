<?php

declare(strict_types=1);

namespace App\Tests\Behat\Application;

use App\Entity\Cart;
use App\Entity\Product;
use App\Handler\CartHandler;
use App\Provider\CartProvider;
use App\Repository\CartRepository;
use Behat\Behat\Context\Context;
use Doctrine\Common\Persistence\ObjectManager;
use Webmozart\Assert\Assert;

final class CartContext implements Context
{
    /**
     * @var CartRepository
     */
    private $cartRepository;
    /**
     * @var ObjectManager
     */
    private $manager;
    /**
     * @var CartHandler
     */
    private $cartHandler;
    /**
     * @var CartProvider
     */
    private $cartProvider;

    public function __construct(
        CartRepository $cartRepository,
        ObjectManager $manager,
        CartHandler $cartHandler,
        CartProvider $cartProvider
    )  {
        $this->cartRepository = $cartRepository;
        $this->manager = $manager;
        $this->cartHandler = $cartHandler;
        $this->cartProvider = $cartProvider;
    }

    /**
     * @When /^I add the ("[^"]+" product) to my cart$/
     */
    public function iAddTheProductToMyCart(Product $product): void
    {
        $cart = $this->cartProvider->provideCart('MY_CODE');

        $this->cartHandler->addToCart($cart, $product);

        $this->manager->persist($cart);
        $this->manager->flush();
    }

    /**
     * @Then my cart should have :product product inside
     */
    public function myCartShouldHaveProductInside(Product $product): void
    {
        $cart = $this->cartRepository->findOneBy(['code' => 'MY_CODE']);

        foreach ($cart->getItems() as $item) {
            if ($item->getProductName() === $product->getName()) {
                return;
            }
        }

        throw new \InvalidArgumentException('Product not found');
    }

    /**
     * @Then my cart total should be :price USD
     */
    public function myCartTotalShouldBeUsd(int $price): void
    {
        /** @var Cart $cart */
        $cart = $this->cartRepository->findOneBy(['code' => 'MY_CODE']);

        Assert::same($price, $cart->getTotal());
    }
}
