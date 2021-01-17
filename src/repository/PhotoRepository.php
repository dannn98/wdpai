<?php

require_once "Repository.php";
require_once __DIR__.'/../models/Photo.php';
require_once __DIR__.'/../AuthenticationGuard.php';

class PhotoRepository extends Repository
{

    public function addPhoto(Photo $photo): bool {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.photos (title, image, id_user) VALUES (?, ?, ?)
        ');

        $id_user = AuthenticationGuard::getCurrentUserId();
        if(!$id_user) {
            return false;
        }

        return $stmt->execute([
            $photo->getTitle(),
            $photo->getImage(),
            $id_user
        ]);
    }

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

    public function getPhotos($id_last = null) {
        if(!$id_last) {
            $stmt = $this->database->connect()->prepare('
                SELECT photos.id as id_photo,
                       photos.title as title,
                       photos.image as image,
                       photos.id_user as id_user,
                       u.nick as nick,
                       (
                           SELECT COUNT(*) FROM photos_likes WHERE photos_likes.id_photo = photos.id
                       ) as likes,
                       (
                           SELECT COUNT(*) FROM photos_comments WHERE photos_comments.id_photo = photos.id
                       ) as comments
                FROM photos
                JOIN users u on u.id = photos.id_user
                ORDER BY photos.id DESC LIMIT 10;
            ');
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}