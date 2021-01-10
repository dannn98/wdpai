<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index() {
        //TODO display login.php
        //die("index method");

        $this->render('login');
    }

    public function home() {
        //TODO display projects.html

        $this->render('home');
    }

    public function photo() {
        $this->render('photo');
    }
}