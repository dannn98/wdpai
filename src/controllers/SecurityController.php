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

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }

    public function register() {
        if(!$this->isPost()) {
            return $this->register('register');
        }

        $nick = $_POST['nick'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $isEmail = $this->userRepository->getUser($email);

        if($isEmail) {
            $this->render('register', ['messages' => ['This email is already taken']]);
        }

        if($this->userRepository->isNickExist($nick)) {
            $this->render('register', ['messages' => ['This nick is already taken']]);
        }

        if(!$this->userRepository->addUser($nick, $email, $password)){
            die("Something went wrong with create new account (register)");
        }

        $this->render('home');
    }
}