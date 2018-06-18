<?php

class Users extends Controller {

	public function __construct() {
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
		
		if ($logged == false) {
			Session::destroy();
			header('location:' .URL.'Login');
			exit;
		}
			
	}
    function dashboard()
    {
        $this->vew->render('dashboard'.DS.'index');
    }
	
	public function settings()
	{
        $this->vew->render('settings'.DS.'index');
	}

	public function userEdit()
    {
        $this->vew->render('userEdit'.DS.'index');
    }
    public function userDelete()
    {
        $this->model->userDelete();
    }
	public function edit()
	{
		$this->model->edit();
	}
    function display()
    {
        $this->model->display();
        $this->vew->render('images'.DS.'index');
    }
    function imageInsertEditDelete()
    {
        $this->model->imageInsertEditDelete();
    }

}