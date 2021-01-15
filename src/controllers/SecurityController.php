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
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userRepository->getUser($email);

        if(!$user) {
            $this->render('login', ['messages' => ['User not exist!']]);
        }

        if ($user->getPassword() !== $password) {
            $this->render('login', ['messages' => ['Wrong password!']]);
        }

        AuthenticationGuard::authenticateUser($this->userRepository->getUserId($user));

        $this->redirect("home");
    }

    public function register() {
        if(!$this->isPost()) {
            return $this->render('register');
        }

        $user = new User($_POST['nick'], $_POST['email'], $_POST['password']);
        $userTest = $this->userRepository->getUser($user->getEmail(), $user->getNick());

        if($userTest) {
           if($userTest->getEmail() === $user->getEmail()) {
               return $this->render('register', ['messages' => ['This email is already taken']]);
           }
           return $this->render('register', ['messages' => ['This nick is already taken']]);
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