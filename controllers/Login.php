<?php

class Login extends Controller
{
    function __construct()
    {
        parent::__construct();

    }
    function index()
    {
        $this->vew->render('login'.DS.'index');
    }
    function run()
    {
        $this->model->run();
    }
    function profile()
    {
        $this->model->profile();
        header("Refresh:0; url=" . URL . 'dashboard');
    }


}