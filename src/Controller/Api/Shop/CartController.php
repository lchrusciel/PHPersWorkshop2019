<?php

declare(strict_types=1);

namespace App\Controller\Api\Shop;

use App\Handler\CartHandler;
use App\Provider\CartProvider;
use App\Repository\ProductRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CartController extends AbstractController
{
    /**
     * @Route("/api/shop/cart", name="api_shop_cart_show", methods={"GET"})
     */
    public function show(CartProvider $cartProvider): Response
    {
        return $this->json($cartProvider->provideCart('MY_CART'));
    }

    /**
     * @Route("/api/shop/cart", name="api_shop_cart_add_item", methods={"PUT"})
     */
    public function addToCart(
        Request $request,
        CartProvider $cartProvider,
        CartHandler $cartHandler,
        ProductRepository $productRepository,
        ObjectManager $manager
    ): Response  {
        $cart = $cartProvider->provideCart('MY_CART');

        $cartHandler->addToCart($cart, $productRepository->findOneBy([
            'name' => $request->request->get('product')
        ]));

        $manager->flush();

        return $this->json($cart);
    }
}
