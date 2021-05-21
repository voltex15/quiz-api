<?php


namespace App\Controller;

use App\Entity\Answer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AnswerController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/api/answers", name="getAnswers", methods={"GET"})
     */
    public function getAnswers(): JsonResponse
    {
        $repository = $this->em->getRepository(Answer::class);
        $answers = $repository->findAll();

        return new JsonResponse([
            'answers' => $answers
        ]);
    }

    /**
     * @Route("/api/answers/{id}", name="getAnswerById", methods={"GET"})
     */
    public function getAnswer(int $id): JsonResponse
    {
        $repository = $this->em->getRepository(Answer::class);
        $answer = $repository->find($id);

        return new JsonResponse([
            'answer' => $answer
        ]);
    }

    /**
     * @Route("/api/answersByQuestion/{questionId}", name="getAnswersByQuestionId", methods={"GET"})
     */
    public function getAnswersByQuestionId(int $questionId): JsonResponse
    {
        $repository = $this->em->getRepository(Answer::class);
        $answers = $repository->findBy(array('question' => $questionId));

        return new JsonResponse([
            'answers' => $answers,
        ]);
    }

    /**
     * @Route("/api/answers/{id}", name="postAnswer", methods={"POST"})
     */
    public function postAnswer(int $id): JsonResponse
    {
        $repository = $this->em->getRepository(Answer::class);

        return new JsonResponse([
            'message' => 'Success!',
        ]);
    }

    /**
     * @Route("/api/answers/{id}", name="putAnswer", methods={"PUT"})
     */
    public function putAnswer(int $id): JsonResponse
    {
        $repository = $this->em->getRepository(Answer::class);

        return new JsonResponse([
            'message' => 'Success!',
        ]);
    }

    /**
     * @Route("/api/answers/{id}", name="deleteAnswer", methods={"DELETE"})
     */
    public function deleteAnswer(int $id): JsonResponse
    {
        $repository = $this->em->getRepository(Answer::class);

        return new JsonResponse([
            'message' => 'Success!',
        ]);
    }
}