<?php

require_once "Repository.php";
require_once __DIR__.'/../models/Photo.php';

class PhotoRepository extends Repository
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
            $photo['title'],
            $photo['image']
        );
    }

    public function addPhoto(Photo $photo): bool {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.photos (title, image, id_user) VALUES (?, ?, ?)
        ');

        //TODO
        $id_user = 1;

        return $stmt->execute([
            $photo->getTitle(),
            $photo->getImage(),
            $id_user
        ]);
    }
}