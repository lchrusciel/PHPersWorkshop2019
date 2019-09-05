<?php

declare(strict_types=1);

namespace App\Tests\Behat\Api;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;

final class ProductContext implements Context
{
    /**
     * @var KernelBrowser
     */
    private $browser;

    public function __construct(KernelBrowser $browser)
    {
        $this->browser = $browser;
    }

    /**
     * @When I add a :name product that costs :price USD
     */
    public function iAddAProductThatCostsUsd(string $name, int $price): void
    {
        $this->browser->request('POST', '/api/admin/products/', [
            'name' => $name,
            'price' => $price,
        ]);
    }

    /**
     * @Then I should see a :name in my product catalog
     */
    public function iShouldSeeAInMyProductCatalog(string $name): void
    {
        $this->browser->request('GET', '/api/admin/products/');

        $response = $this->browser->getResponse();

        Assert::same($response->getStatusCode(), Response::HTTP_OK);
        Assert::contains($response->getContent(), $name);
    }
}
