<?php

declare(strict_types=1);

namespace App\Tests\Behat\Application;

use App\Factory\ProductFactory;
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
    /**
     * @var ProductFactory
     */
    private $productFactory;

    public function __construct(ObjectManager $manager, ProductRepository $productRepository, ProductFactory $productFactory)
    {
        $this->manager = $manager;
        $this->productRepository = $productRepository;
        $this->productFactory = $productFactory;
    }

    /**
     * @When I add a :name product that costs :price USD
     */
    public function iAddAProductThatCostsUsd(string $name, int $price): void
    {
        $this->manager->persist($this->productFactory->create($name, $price));
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
