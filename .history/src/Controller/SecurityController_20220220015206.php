<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Services\TaskService;
use App\Services\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class SecurityController extends AbstractController
{


    /**
     * @Route("/login", name="actionLogin", methods={"GET", "POST"}, options={"expose"=true})
     * @return Response
     */
    public function actionLogin(Request $request,UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): Response
    {

        $parameters = json_decode($request->getContent(), true);
        header('Access-Control-Allow-Origin:*');

        $user = $userRepository->findOneBy([
            'email'=>$parameters['email'],
    ]);
    if (!$user || !$passwordHasher->hashPassword($user,$parameters['pass'])) {
            return $this->json([
                'message' => 'email or password is wrong.',
            ]);
    }


    $jwt = JWT::encode($payload, $this->getParameter('jwt_secret'), 'HS256');
    return $this->json([
        'message' => 'success!',
        'token' => sprintf('Bearer %s', $jwt),
    ]);
 


        return $this->json([$parameters]);
    }



}
