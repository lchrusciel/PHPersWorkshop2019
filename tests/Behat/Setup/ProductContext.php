<?php

declare(strict_types=1);

namespace App\Tests\Behat\Setup;

use App\Factory\ProductFactory;
use Behat\Behat\Context\Context;
use Doctrine\Common\Persistence\ObjectManager;

final class ProductContext implements Context
{
    /**
     * @var ObjectManager
     */
    private $manager;
    /**
     * @var ProductFactory
     */
    private $productFactory;

    public function __construct(ObjectManager $manager, ProductFactory $productFactory)
    {
        $this->manager = $manager;
        $this->productFactory = $productFactory;
    }

    /**
     * @Given there is a :name product that costs :price USD
     */
    public function iAddAProductThatCostsUsd(string $name, int $price): void
    {
        $this->manager->persist($this->productFactory->create($name, $price));
        $this->manager->flush();
    }

}
