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

    public function login() {

        if(!$this->isPost()) {
            $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userRepository->getUser($email);

        if(!$user) {
            $this->render('login', ['messages' => ['User not exist!']]);
        }

//        if ($user->getEmail() !== $email) {
//            return $this->render('login', ['messages' => ['User with this email not exist!']]);
//        }

        if ($user->getPassword() !== $password) {
            $this->render('login', ['messages' => ['Wrong password!']]);
        }

//        return $this->render('home');

        $this->redirect("home");
    }

    public function register() {
        if(!$this->isPost()) {
            return $this->render('register');
        }

        $nick = $_POST['nick'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userRepository->getUser($email, $nick);

        if($user) {
           if($user->getEmail() === $email) {
               return $this->render('register', ['messages' => ['This email is already taken']]);
           }
           return $this->render('register', ['messages' => ['This nick is already taken']]);
        }

        if(!$this->userRepository->addUser($nick, $email, $password)){
            die("Something went wrong with create new account (register)");
        }

        $this->redirect("home");
    }
}