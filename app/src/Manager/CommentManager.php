<?php

namespace App\Manager;

use App\Entity\Comment;
use App\Entity\Post;

class CommentManager extends BaseManager
{
    /**
     * @return Comment[]
     */
    public function getComments(): array
    {
        $query = $this->pdo->query("select * from Comment");

        $users = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $users[] = new Comment($data);
        }

        return $users;
    }


    public function insertcomment(Comment $comment)
    {   
        $post = new Post ();

        $query = $this->pdo->prepare("INSERT INTO Comment (content, author,postId  ) VALUES (:content,:author, :postId)");
        $query->bindValue("content", $comment->getContent(), \PDO::PARAM_STR);
        $query->bindValue("author", $comment->getAuthor(), \PDO::PARAM_STR);
        $query->bindValue("commentId", $post->getId(), \PDO::PARAM_STR);
        $query->execute();   

    }
    
}