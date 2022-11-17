<?php

namespace App\Manager;

use App\Entity\Comment;

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

    
}