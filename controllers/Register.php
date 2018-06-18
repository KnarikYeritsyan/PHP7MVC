<?php

class Register extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        $this->vew->render('register'.DS.'index');
    }

    function run()
    {
        $this->model->run();
    }


}