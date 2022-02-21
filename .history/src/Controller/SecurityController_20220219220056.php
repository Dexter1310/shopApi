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
     * @Route("/login", name="loginAction", methods={"GET", "POST"}, options={"expose"=true})
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function actionLogin(Request $request,AuthenticationUtils $authenticationUtils): Response
    {
        header('Access-Control-Allow-Origin:*');
        $parameters = json_decode($request->getContent(), true);
      
        $user = new User();
        $authenticationUtils->setEmail($parameters['email']);
        $authenticationUtils->setPassword
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->json(['last_username' => $lastUsername]);
    }

}
