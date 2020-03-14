<?php
namespace controllers;

class Register extends Controller
{
    protected $model;
    function __construct()
    {
        parent::__construct();
        $this->model= new \Register_Model();
    }
    function index()
    {
        $this->view->render('register'.DS.'index');
    }

    function run()
    {
        $data = $_POST;
        if (strlen($_POST['username']) > 0 && strlen($_POST['password']) > 5 && $_POST['password1'] == $_POST['password']) {
            if ($this->model->create($data)){
                echo "Registered Successfully";
                header("Refresh:0; url=" . URL . 'dashboard');
            }
        }
    }


}