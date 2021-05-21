<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Firebase\JWT\JWT;

class AuthController extends AbstractController
{
    /**
     * @Route("/auth/register", name="register", methods={"POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $parameters = json_decode($request->getContent(), true);

        $password = $parameters['password'];
        $email = $parameters['email'];
        $user = new User();
        $user->setPassword($encoder->encodePassword($user, $password));
        $user->setEmail($email);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return $this->json([
            'user' => $user->getEmail()
        ]);
    }

    /**
     * @Route("/auth/login", name="login", methods={"POST"})
     */
    public function login(Request $request, \App\Repository\UserRepository $userRepository, UserPasswordEncoderInterface $encoder)
    {
        $parameters = json_decode($request->getContent(), true);

        $user = $userRepository->findOneBy([
            'email' => $parameters['email'],
        ]);
        if (!$user || !$encoder->isPasswordValid($user, $parameters['password'])) {
            return $this->json([
                'message' => 'Email or password is wrong.',
            ]);
        }
        $payload = [
            "user" => $user->getUsername(),
            "exp"  => (new \DateTime())->modify("+5 minutes")->getTimestamp(),
        ];

        $jwt = JWT::encode($payload, $this->getParameter('jwt_secret'), 'HS256');
        return $this->json([
            'message' => 'Success!',
            'email' => $parameters['email'],
            'token' => sprintf('Bearer %s', $jwt),
        ]);
    }

}