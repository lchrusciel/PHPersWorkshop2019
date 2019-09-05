<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemRepository")
 */
class Item
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $productName;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $price;

    public function __construct(string $productName, int $price)
    {
        $this->productName = $productName;
        $this->price = $price;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}
