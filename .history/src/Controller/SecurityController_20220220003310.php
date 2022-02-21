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

        $_username = "batman";
        $_password = "batmobil";

        // Recuperar el codificador de seguridad de Symfony
        $factory = $this->get('security.encoder_factory');

        /// Iniciar recuperación de usuario
        // Recuperemos al usuario por su nombre de usuario:
        // Si está utilizando FOSUserBundle:
        $user_manager = $this->get('fos_user.user_manager');
        $user = $user_manager->findUserByUsername($_username);
        // O por ti mismo
        $user = $this->getDoctrine()->getManager()->getRepository("userBundle:User")
                ->findOneBy(array('username' => $_username));
        /// Usuario de recuperación final

        // ¡Compruebe si el usuario existe!
        if(!$user){
            return new Response(
                'Username doesnt exists',
                Response::HTTP_UNAUTHORIZED,
                array('Content-type' => 'application/json')
            );
        }

        /// Iniciar verificación
        $encoder = $factory->getEncoder($user);
        $salt = $user->getSalt();

        if(!$encoder->isPasswordValid($user->getPassword(), $_password, $salt)) {
            return new Response(
                'Username or Password not valid.',
                Response::HTTP_UNAUTHORIZED,
                array('Content-type' => 'application/json')
            );
        } 


    }


}
