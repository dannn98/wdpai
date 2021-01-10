<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController
{
    private Repository $userRepository;

    protected function repositories()
    {
        $this->userRepository = new UserRepository();
    }

    public function login(){

        if(!$this->isPost()) {
            return $this->login('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userRepository->getUser($email);

        if(!$user) {
            return $this->render('login', ['messages' => ['User not exist!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

//        return $this->render('home');

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }
}