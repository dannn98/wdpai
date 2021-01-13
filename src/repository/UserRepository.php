<?php

require_once "Repository.php";
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user == false) {
            return null;
        }

        return new User(
            $user['nick'],
            $user['email'],
            $user['password']
        );
    }

    public function addUser($nick, $email, $password):bool {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.users (nick, email, password) VALUES (:nick, :email, :password)
        ');
        $stmt->bindParam(':nick', $nick, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function isNickExist(string $nick): bool
    {
        $stmt = $this->database->connect()->prepare('
            SELECT nick FROM public.users WHERE nick = :nick
        ');
        $stmt->bindParam(':nick', $nick, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result == false) {
            return false;
        }

        return true;
    }
}