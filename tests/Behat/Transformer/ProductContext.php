<?php

declare(strict_types=1);

namespace App\Tests\Behat\Transformer;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Behat\Behat\Context\Context;
use Webmozart\Assert\Assert;

final class ProductContext implements Context
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @Transform :product
     * @Transform /^"([^"]+)" product$/
     */
    public function getOneByName(string $productName): Product
    {
        $product = $this->productRepository->findOneBy(['name' => $productName]);

        Assert::notNull($product);

        return $product;
    }
}
