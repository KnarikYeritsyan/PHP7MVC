<?php
namespace controllers;

class Users extends Controller {

    protected $model;

	public function __construct() {
		parent::__construct();
        $this->model= new \Users_Model();
		\Session::init();
		$logged = \Session::get('loggedIn');
		
		if ($logged == false) {
			\Session::destroy();
			header('location:' .URL.'Login');
			exit;
		}
			
	}
    function dashboard()
    {
        $model = new \Login_Model();
        $data = $model->get_user(\Session::get('user_id'));
        $this->view->render('dashboard/index',['data'=>$data]);
    }
	
	public function settings()
	{
        $this->view->render('settings'.DS.'index');
	}

	public function userEdit()
    {
        $model = new \Login_Model();
        $data = $model->get_user(\Session::get('user_id'));
        $this->view->render('userEdit/index',compact('data'));
    }
    public function userDelete()
    {
        $id = $_GET['id'];
        if ($this->model->userDelete($id))
        {
            \Session::destroy();
            header('Refresh:0;url= ' . URL . 'login');
        }else{
            header('Refresh:0;url= ' . URL . 'dashboard');
        }
    }
	public function edit()
    {
        $data = $_POST;
        if (strlen($_POST['username']) > 0 && strlen($_POST['password']) > 5) {
            if ($this->model->edit($data)) {
                $model = new \Login_Model();
                $data = $model->get_user(\Session::get('user_id'));
                $this->view->render('dashboard/index', compact('data'));
            }
        }
	}
    function display()
    {
        $this->model->display();
        $this->view->render('images'.DS.'index');
    }
    function imageInsertEditDelete()
    {
        $this->model->imageInsertEditDelete();
    }

}