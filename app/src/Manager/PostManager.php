<?php

namespace App\Manager;

use App\Entity\Post;
use App\Entity\User;

class PostManager extends BaseManager
{
    /**
     * @return Post[]
     */
    public function getAllPosts(): array
    {
        $query = $this->pdo->query("select * from Post");

        $users = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $users[] = new Post($data);
        }

        return $users;
    }

    public function getPostById($id): array
    {

        $query = $this->pdo->query("select* from Post where id = $id ");

        $users = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $users[] = new Post($data);
        }

        return $users;
    }


    public function insertPost(Post $post)
    {
        $user = new User();
        if ($user->getId() != 0)
        {
             $query = $this->pdo->prepare("INSERT INTO User( content, author ) VALUES ( :content,:author)");
             $query->bindValue("content", $post->getContent(), \PDO::PARAM_STR);
             $query->bindValue("author", $post->getAuthor(), \PDO::PARAM_STR);
             $query->execute();
             


        }
           
        

    }
}
