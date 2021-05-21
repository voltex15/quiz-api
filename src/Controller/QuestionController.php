<?php


namespace App\Controller;

use App\Entity\Question;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/questions", name="getQuestions", methods={"GET"})
     */
    public function getQuestions(): JsonResponse
    {
        $repository = $this->em->getRepository(Question::class);
        $questions = $repository->findAll();

        return new JsonResponse([
            'questions' => $questions,
        ]);
    }

    /**
     * @Route("/question/{id}", name="getQuestionById", methods={"GET"})
     */
    public function getQuestion(int $id): JsonResponse
    {
        $repository = $this->em->getRepository(Question::class);
        $question = $repository->find($id);

        return new JsonResponse([
            'question' => $question,
        ]);
    }

    /**
     * @Route("/questionsByCategory/{categoryId}", name="getQuestionsByCategoryId", methods={"GET"})
     */
    public function getQuestionsByCategoryId(int $categoryId): JsonResponse
    {
        $repository = $this->em->getRepository(Question::class);
        $questions = $repository->findBy(array('category' => $categoryId));

        return new JsonResponse([
            'questions' => $questions,
        ]);
    }

    /**
     * @Route("/question/{id}", name="postQuestion", methods={"POST"})
     */
    public function postQuestion(int $id): JsonResponse
    {
        $repository = $this->em->getRepository(Question::class);

        return new JsonResponse([
            'message' => 'Success!',
        ]);
    }

    /**
     * @Route("/question/{id}", name="putQuestion", methods={"PUT"})
     */
    public function putQuestion(int $id): JsonResponse
    {
        $repository = $this->em->getRepository(Question::class);

        return new JsonResponse([
            'message' => 'Success!',
        ]);
    }

    /**
     * @Route("/question/{id}", name="deleteQuestion", methods={"DELETE"})
     */
    public function deleteQuestion(int $id): JsonResponse
    {
        $repository = $this->em->getRepository(Question::class);

        return new JsonResponse([
            'message' => 'Success!',
        ]);
    }
}