<?php

require_once "Repository.php";
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $email, ?string $nick = null): ?User
    {
        if($nick) {
            $stmt = $this->database->connect()->prepare('
                SELECT * FROM public.users WHERE email = :email or nick = :nick
            ');
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':nick', $nick, PDO::PARAM_STR);
        }
        else {
            $stmt = $this->database->connect()->prepare('
                SELECT * FROM public.users WHERE email = :email
            ');
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        }
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

    public function addUser(User $user): bool {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.users (nick, email, password) VALUES (?, ?, ?)
        ');

        return $stmt->execute([
            $user->getNick(),
            $user->getEmail(),
            password_hash($user->getPassword(), PASSWORD_BCRYPT)
        ]);
    }

    public function getUserId(User $user): int {
        $email = $user->getEmail();

        $stmt = $this->database->connect()->prepare('
            SELECT id FROM public.users WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['id'];
    }
}