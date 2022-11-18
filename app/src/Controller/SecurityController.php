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

        $htmlUsername = strip_tags($_POST['username']);
        $htmlPassword = strip_tags($_POST['password']);
        $htmlEmail = strip_tags($_POST['email']);
        $htmlFirstName = strip_tags($_POST['firstName']);
        $htmlLastname = strip_tags($_POST['lastName']);
        $htmlGender = strip_tags($_POST['gender']);
        
        $user = new User ();

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


    #[Route('/login', name: "login", methods: ["GET", "POST"])]
    public function login( )
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->render('Login.php');
        }
       
        $formEmail = $_POST['email'];
        $formPwd = $_POST['password'];



        
    
       

        $userManager = new UserManager(new PDOFactory());
        $user = $userManager->getByUser($formEmail,$formPwd);
        //var_dump( $formPwd );
       //$user->passwordMatch($formPwd);

       var_dump($user);

        die;

        if (!$user) {
            header("Location: /?error=notfound");
            exit;
        }

        if ($user->passwordMatch($formPwd)) {
            

            $this->render("showUsers.php", [
                "message" => "je suis un message"
            ],
                "titre de la page");
        }

        header("Location: /?error=notfound");
        exit;
    }
}
