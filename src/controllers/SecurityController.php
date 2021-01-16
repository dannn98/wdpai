<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../AuthenticationGuard.php';

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
            return;
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userRepository->getUser($email);

        if(!$user) {
            $this->render('login', ['messages' => ['User not exist!']]);
            return;
        }

        if (!password_verify($password, $user->getPassword())) {
            $this->render('login', ['messages' => ['Wrong password!']]);
            return;
        }

        AuthenticationGuard::authenticateUser($this->userRepository->getUserId($user));

        $this->redirect("home");
    }

    public function register() {
        if(!$this->isPost()) {
            $this->render('register');
            return;
        }

        $user = new User($_POST['nick'], $_POST['email'], $_POST['password']);
        $isExist = $this->userRepository->getUser($user->getEmail(), $user->getNick());

        if($isExist) {
           if($isExist->getEmail() === $user->getEmail()) {
               $this->render('register', ['messages' => ['This email is already taken']]);
               return;
           }
           $this->render('register', ['messages' => ['This nick is already taken']]);
           return;
        }

        if(!$this->userRepository->addUser($user)){
            die("Something went wrong with create new account (register)");
        }

        $this->redirect("login");
    }

    public function logout() {
        AuthenticationGuard::cancelAuthentication();
        $this->redirect("login");
    }
}