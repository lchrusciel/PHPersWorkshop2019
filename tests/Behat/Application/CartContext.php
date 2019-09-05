<?php

declare(strict_types=1);

namespace App\Tests\Behat\Application;

use App\Entity\Cart;
use App\Entity\Item;
use App\Entity\Product;
use App\Repository\CartRepository;
use App\Repository\ProductRepository;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Doctrine\Common\Persistence\ObjectManager;
use Webmozart\Assert\Assert;

final class CartContext implements Context
{
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var CartRepository
     */
    private $cartRepository;
    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ProductRepository $productRepository, CartRepository $cartRepository, ObjectManager $manager)
    {
        $this->productRepository = $productRepository;
        $this->cartRepository = $cartRepository;
        $this->manager = $manager;
    }

    /**
     * @When I add the :product product to my cart
     */
    public function iAddTheProductToMyCart(Product $product): void
    {
        $cart = new Cart('MY_CODE');

        $cart->addItem(new Item($product->getName(), $product->getPrice()));

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
     * @Then my cart total should be :total USD
     */
    public function myCartTotalShouldBeUsd(float $total): void
    {
        /** @var Cart $cart */
        $cart = $this->cartRepository->findOneBy(['code' => 'MY_CODE']);

        Assert::same((int) $total * 100, $cart->getTotal());
    }
}
