<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Photo.php';
require_once __DIR__.'/../repository/PhotoRepository.php';

class PhotoController extends AppController {

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];
    private Repository $photoRepository;

    protected function repositories()
    {
        $this->photoRepository = new PhotoRepository();
    }

    public function photo() {
        $id_photo = $this->segments[1];

        if($id_photo == null || !is_numeric($id_photo)) {
            http_response_code(404);
            return;
        }

        $photo = $this->photoRepository->getPhoto($id_photo);

        if($photo == false) {
            http_response_code(404);
            return;
        }

        $comments = $this->photoRepository->getComments($id_photo);

        $this->render('photo', ['photo' => $photo, 'comments' => $comments]);
    }

    public function photos($id_last = null) {
        $photos = $this->photoRepository->getPhotos();
        header('Content-type: application/json');
        echo json_encode($photos);
    }

    public function upload() {

        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {

            $uniqname = uniqid().".".explode("/", $_FILES['file']['type'])[1];

            $photo = new Photo($_POST['title'], $uniqname);
            if(!$this->photoRepository->addPhoto($photo)) {
                $this->messages[] = 'Database error';
                $this->render('upload', ['messages' => $this->messages]);
                return;
            }

            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$uniqname
            );

            $this->messages[] = 'Photo uploaded successfully';
            $this->render('upload', ['messages' => $this->messages]);
            return;
        }

        $this->messages[] = 'Something is wrong';
        $this->render('upload', ['messages' => $this->messages]);
    }

    public function addComment() {
        $id_photo = $_POST['id_photo'];
        $content = $_POST['comment'];
        if(!$this->photoRepository->addComment($id_photo, $content)) {
            die("Something went wrong!");
        }
        else {
            $this->redirect("photo/".$id_photo);
        }
    }

    private function validate(array $file): bool {
        if($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'File is too large for destination file system';
            return false;
        }

        if(!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = 'File type is not supported';
            return false;
        }

        return true;
    }
}