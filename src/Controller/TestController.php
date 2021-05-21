<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
    * @Route("/api/test", methods={"GET"})
    */
    public function number(): JsonResponse
    {
        $number = random_int(0, 100);
        return new JsonResponse(array('id' => $number, 'name' => 'Test'));
    }

    /**
     * @Route("/test", name="test")
     */
    public function test()
    {
        return new JsonResponse([
            'message' => 'test!',
        ]);
    }
}