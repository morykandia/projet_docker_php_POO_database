<?php

namespace App\Manager;

use App\Entity\User;

class UserManager extends BaseManager
{

    /**
     * @return User[]
     */
    public function getAllUsers(): array
    {
        $query = $this->pdo->query("select * from User");

        $users = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $users[] = new User($data);
        }

        return $users;
    }

    public function getByUsername(string $username): ?User
    {
        $query = $this->pdo->prepare("SELECT * FROM User WHERE username = :username");
        $query->bindValue("username", $username, \PDO::PARAM_STR);
        $query->execute();
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if ($data) {
            return new User($data);
        }

        return null;
    }


    public function getByUser(string $email, string $password): ?User
    {
        $query = $this->pdo->prepare("SELECT * FROM User WHERE email=:email AND password=:password LIMIT 1");
        $query->bindValue("email", $email, \PDO::PARAM_STR);
        $query->bindValue("password", $password, \PDO::PARAM_STR);
        $query->execute();
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if ($data) {
            return new User($data);
        }

        return null;
    }

    public function insertUser(User $user )
    {
        $query = $this->pdo->prepare("INSERT INTO User (username, password, email, firstName, lastName, gender, roles) VALUES ( :username,:password,:email,:firstName, :lastName, :gender, :roles)");
        $query->bindValue("username", $user->getUsername(), \PDO::PARAM_STR);
        $query->bindValue("password", $user->getHashedPassword(), \PDO::PARAM_STR);
        $query->bindValue("email", $user->getEmail(), \PDO::PARAM_STR);
        $query->bindValue("firstName", $user->getFirstName(), \PDO::PARAM_STR);
        $query->bindValue("lastName", $user->getLastName(), \PDO::PARAM_STR);
        $query->bindValue("gender", $user->getGender(), \PDO::PARAM_STR);
        $query->bindValue("roles", json_encode($user->getRoles()), \PDO::PARAM_STR);
        $query->execute();
       
    }
}
