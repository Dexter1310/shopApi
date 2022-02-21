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
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;



class SecurityController extends AbstractController
{


    /**
     * @Route("/login", name="actionLogin", methods={"GET", "POST"}, options={"expose"=true})
     * @param AuthenticationUtils $authenticationUtils
     */
    public function actionLogin(Request $request): Response
    {

        $parameters = json_decode($request->getContent(), true);
        header('Access-Control-Allow-Origin:*');
        

        return $this->json([$parameters]);
    }


}
