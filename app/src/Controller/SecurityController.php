<?php

namespace App\Controller;

use App\Entity\User;
use App\Factory\PDOFactory;
use App\Manager\UserManager;
use App\Route\Route;

class SecurityController extends AbstractController
{
    #[Route('/create', name: "createuser", methods: ["GET", "POST"])]
    public function CreateUser ()
    {


        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->render('contactform.php');
        }

        var_dump($_POST['username']);
        die;


        $htmlUsername = strip_tags($_POST['username']);
        $htmlPassword = strip_tags($_POST['password']);
        $htmlEmail = strip_tags($email);
        $htmlFirstName = strip_tags($firstName);
        $htmlLastname = strip_tags($lastName);
        $htmlGender = strip_tags($gender);

        $user->setUsername( $htmlUsername);
        $user->setHashedPassword( $htmlPassword);
        $user->setEmail( $htmlEmail);
        $user->setFirstName( $htmlFirstName);
        $user->setLastName( $htmlLastname);
        $user->setGender( $htmlGender);

        $createUserManager = new UserManager((new PDOFactory()));

        $createUserManager->insertUser($user);

        $this->render("home.php");

    }


    #[Route('/login', name: "login", methods: ["GET"])]
    public function login($username,$password )
    {
       
        $userManager = new UserManager(new PDOFactory());
        $user = $userManager->getByUsername($username);

        if (!$user) {
            header("Location: /?error=notfound");
            exit;
        }

        if ($user->passwordMatch($password)) {

            $this->render("user/showUsers.php", [
                "message" => "je suis un message"
            ],
                "titre de la page");
        }

        header("Location: /?error=notfound");
        exit;
    }
}
