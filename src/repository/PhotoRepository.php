<?php

require_once "Repository.php";
require_once __DIR__.'/../models/Photo.php';

class UserRepository extends Repository
{

    public function getPhoto(int $id): ?Photo
    {

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.photos WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $photo = $stmt->fetch(PDO::FETCH_ASSOC);

        if($photo == false) {
            return null;
        }

        return new Photo(
            $photo['id'],
            $photo['title'],
            $photo['image'],
            $photo['id_user']
        );
    }

//    public function addUser($nick, $email, $password): bool {
//        $stmt = $this->database->connect()->prepare('
//            INSERT INTO public.users (nick, email, password) VALUES (:nick, :email, :password)
//        ');
//        $stmt->bindParam(':nick', $nick, PDO::PARAM_STR);
//        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
//        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
//
//        return $stmt->execute();
//    }
}