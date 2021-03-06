<?php


namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    private $em;

    public function __constructor(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/api/categories", name="getCategories", methods={"GET"})
     */
    public function getCategories(): JsonResponse
    {
        $repository = $this->em->getRepository(Category::class);
        $categories = $repository->findAll();

        return new JsonResponse([
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/api/categories/{id}", name="getCategoryById", methods={"GET"})
     */
    public function getCategory(int $id): JsonResponse
    {
        $repository = $this->em->getRepository(Category::class);
        $category = $repository->find($id);

        return new JsonResponse([
            'category' => $category,
        ]);
    }

    /**
     * @Route("/api/categories/{id}", name="postCategory", methods={"POST"})
     */
    public function postCategory(int $id): JsonResponse
    {
        $repository = $this->em->getRepository(Category::class);

        return new JsonResponse([
            'message' => 'Success',
        ]);
    }

    /**
     * @Route("/api/categories/{id}", name="putCategory", methods={"PUT"})
     */
    public function putCategory(int $id): JsonResponse
    {
        $repository = $this->em->getRepository(Category::class);

        return new JsonResponse([
            'message' => 'test!',
        ]);
    }

    /**
     * @Route("/api/categories/{id}", name="deleteCategory", methods={"DELETE"})
     */
    public function deleteCategory(int $id): JsonResponse
    {
        $repository = $this->em->getRepository(Category::class);

        return new JsonResponse([
            'message' => 'test!',
        ]);
    }
}