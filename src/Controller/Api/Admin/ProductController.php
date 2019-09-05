<?php

declare(strict_types=1);

namespace App\Controller\Api\Admin;

use App\Factory\ProductFactory;
use App\Repository\ProductRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ProductController extends AbstractController
{
    /**
     * @Route("/api/admin/products/", name="api_admin_product_index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->json($productRepository->findAll());
    }

    /**
     * @Route("/api/admin/products/", name="api_admin_product_create", methods={"POST"})
     */
    public function create(
        Request $request,
        ProductFactory $factory,
        ObjectManager $manager
    ): Response {
        $product = $factory->create(
            $request->request->get('name'),
            $request->request->get('price')
        );

        $manager->persist($product);
        $manager->flush();

        return $this->json($product, Response::HTTP_CREATED);
    }
}
