<?php

declare(strict_types=1);

namespace App\Tests\Behat\Application;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Behat\Behat\Context\Context;
use Doctrine\Common\Persistence\ObjectManager;
use Webmozart\Assert\Assert;

final class ProductContext implements Context
{
    /**
     * @var ObjectManager
     */
    private $manager;
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ObjectManager $manager, ProductRepository $productRepository)
    {
        $this->manager = $manager;
        $this->productRepository = $productRepository;
    }

    /**
     * @When I add a :name product that costs :price USD
     * @Given there is a :name product that costs :price USD
     */
    public function iAddAProductThatCostsUsd(string $name, float $price): void
    {
        $price = (int) $price * 100;

        $product = new Product($name, $price);

        $this->manager->persist($product);
        $this->manager->flush();
    }

    /**
     * @Then I should see a :name in my product catalog
     */
    public function iShouldSeeAInMyProductCatalog(string $name): void
    {
        Assert::notNull($this->productRepository->findOneBy(['name' => $name]));
    }
}
