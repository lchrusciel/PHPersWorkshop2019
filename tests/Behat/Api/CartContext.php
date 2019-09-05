<?php

declare(strict_types=1);

namespace App\Tests\Behat\Api;

use Behat\Behat\Context\Context;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;

final class CartContext implements Context
{
    /**
     * @var KernelBrowser
     */
    private $kernelBrowser;

    public function __construct(KernelBrowser $kernelBrowser)
    {
        $this->kernelBrowser = $kernelBrowser;
    }

    /**
     * @When I add the :productName product to my cart
     */
    public function iAddTheProductToMyCart(string $productName): void
    {
        $this->kernelBrowser->request('PUT', '/api/shop/cart', [
            'product' => $productName,
        ]);
    }

    /**
     * @Then my cart should have :productName product inside
     */
    public function myCartShouldHaveProductInside(string $productName): void
    {
        $this->kernelBrowser->request('GET', '/api/shop/cart');

        $response = $this->kernelBrowser->getResponse();

        Assert::same($response->getStatusCode(), Response::HTTP_OK);
        Assert::contains($response->getContent(), $productName);
    }

    /**
     * @Then my cart total should be :price USD
     */
    public function myCartTotalShouldBeUsd(int $price): void
    {
        $this->kernelBrowser->request('GET', '/api/shop/cart');

        $response = $this->kernelBrowser->getResponse();

        Assert::same($response->getStatusCode(), Response::HTTP_OK);
        Assert::contains($response->getContent(), $price);
    }
}
