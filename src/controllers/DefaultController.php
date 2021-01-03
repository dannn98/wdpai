<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index() {
        //TODO display login.html
        //die("index method");

        $this->render('login');
    }

    public function projects() {
        //TODO display projects.html
        die("projects method");
    }
}