<?php

require_once "Repository.php";

class TokenRepository extends Repository
{
    public function addToken($key, $id_user) {
        $hashed = md5($key.$_SERVER['REMOTE_ADDR']);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.authentication_tokens (token, id_user) VALUES (?, ?)
        ');

        return $stmt->execute([
            $hashed,
            $id_user
        ]);
    }

    public function checkToken($key): bool {
        $hashed = md5($key.$_SERVER['REMOTE_ADDR']);

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.authentication_tokens WHERE token = :token
        ');
        $stmt->bindParam(':token', $hashed, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result == false) {
            return false;
        }

        return true;
    }

    public function delToken($key) {
        $hashed = md5($key.$_SERVER['REMOTE_ADDR']);

        $stmt = $this->database->connect()->prepare('
            DELETE FROM public.authentication_tokens WHERE token = :token
        ');
        $stmt->bindParam(':token', $hashed, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getUserId($key): ?int {
        $hashed = md5($key.$_SERVER['REMOTE_ADDR']);

        $stmt = $this->database->connect()->prepare('
            SELECT id_user FROM public.authentication_tokens WHERE token = :token
        ');
        $stmt->bindParam(':token', $hashed, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result == false) {
            return null;
        }

        return $result['id_user'];
    }
}