<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\UserService;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use PhpParser\Node\Expr\Cast\Object_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;





class DefaultController extends AbstractController
{


    /**
     * @Route("/api/users", name="users")
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */

    public function getUsers(UserRepository $userRepository): Response
    {

        $users =  $userRepository->findAll();
        $us = [];
        foreach ($users as $user) {
            array_push($us, [
                'id' => $user->getId(), 'name' => $user->getName(),
                'lastname' => $user->getLastname(), 'email' => $user->getEmail()
            ]);
        }
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->setContent(json_encode($us));

        return $response;
    }

    /**
     * @Route("/api/addUser", name="useradd", methods={"GET", "POST"})
     */

    public function actionUser(Request $request, UserService $userService): Response
    {
        $parameters = json_decode($request->getContent(), true);
        header('Access-Control-Allow-Origin:*');
        $userService->actionUser($parameters);
        return $this->json($parameters);
    }


    /**
     * @Route("/api/user/{id}", name="editUser", methods={"GET", "POST"})
     * @ParamConverter("user", class="App\Entity\User")
     */

    public function editUserAction(Request $request, UserService $userService, User $user,): Response
    {
        $data=$request->request;
        header('Access-Control-Allow-Origin:*');
     
        $us = $userService->findUser($user);
        return $this->json($us);
    }
}
