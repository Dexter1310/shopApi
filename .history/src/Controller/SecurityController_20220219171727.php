<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;

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


class SecurityController extends AbstractController
{


    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $user = new User();
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        $formUser = $this->createForm(UserType::class, $user);//todo: if new user added. this is your form

        return $this->json('succes');
        // return $this->render('Front/security/login.html.twig', [
        //     'last_username' => $lastUsername,
        //     'error' => $error,
        //     'formUser' => $formUser->createView(),
        // ]);
    }


}
