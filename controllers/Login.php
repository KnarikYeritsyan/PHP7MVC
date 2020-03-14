<?php
namespace controllers;

class Login extends Controller
{
    protected $model;
    function __construct()
    {
        parent::__construct();
        $this->model= new \Login_Model();
    }
    function index()
    {
        $this->view->render('login'.DS.'index',['title'=>'got login title']);
    }
    function run()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
//        $remember = $_POST['remember'];
        if (strlen($username)>0 && strlen($password)>0) {
            if ($this->model->authenticate($username, $password)) {
                $data = $this->model->get_user(\Session::get('user_id'));
                /*if ($remember == 1) {
                    setcookie("username", $username, time() + 60 * 60 * 7);
                    setcookie("password", $password, time() + 60 * 60 * 7);
                }*/
                $this->view->render('dashboard/index',compact('data'));
            }
        }
    }
    function profile()
    {
        $id = \Session::get('user_id');
        $this->model->profile($id);
        header("Refresh:0; url=" . URL . 'dashboard');
    }


}