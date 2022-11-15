<?php

namespace App\Controller;

use App\Factory\PDOFactory;
use App\Manager\PostManager;

class PostController extends AbstractController
{


    public function home()
    {
        $manger = new PostManager(new PDOFactory());
        $posts = $manger->getAllPosts();

        $this->render("home.php", ["posts" => $posts], "Tous les posts");
    }
}
