<?php

class Users_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function edit()
	{

        $id = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $remember = $_POST['remember'];

        $sthu = $this->db->query(" SELECT username FROM ".DB_TABLE1." WHERE `username` = '$username'");
        $countu = $sthu->rowCount();

        if ($countu == 0 && strlen($username)>0 && strlen($password)>5)
        {
        try{
            $sth = $this->db->query(" UPDATE ".DB_TABLE1." SET `username` = '$username', `password` = '$password', `first_name` = '$first_name', `last_name` = '$last_name' WHERE " . DB_TABLE1 . ".`id` = '$id'");

        }catch (PDOException $e){
            die($e->getMessage());
        }
        if ($sth == true) {

            Session::init();
            //Session::set('loggedIn',true);
            Session::set('username',$username);
            Session::set('password',$password);
            Session::set('firstname',$first_name);
            Session::set('lastname',$last_name);
            echo "Changed Successfully";
            if ($remember == 1) {
                setcookie("username", $username, time() + 60 * 60 * 2);
                setcookie("password", $password, time() + 60 * 60 * 2);
            }
            header("Refresh:0; url=".URL.'dashboard');
        }else {
            exit();
        }
        }else{
            exit();
        }

	}
    public function userDelete()
    {
        $id = $_GET['id'];
        try
        {
            $sth = $this->db->query(" DELETE FROM " .DB_TABLE1. " WHERE id = '$id' LIMIT 1 ");
            $sthh = $this->db->query(" DELETE FROM ".DB_TABLE2." WHERE username = '$id'");

        }catch (PDOException $e){
            die($e->getMessage());
        }
        if ($sth == true && $sthh == true) {
            Session::set('loggedIn', false);
            header('Refresh:0;url= ' . URL . 'login');
        }else {
            Session::set('loggedIn', true);
            header('Refresh:0;url= ' . URL . 'dashboard');
        }
    }
    public function display()
    {
        $user_id = $_GET['user_id'];
        $sth = $this->db->query(' SELECT * FROM '.DB_TABLE2.' WHERE '.DB_TABLE2.'.`username` = '.$user_id );
        $data = $sth->fetchAll();
        Session::init();
        Session::set('array',$data);
    }
    public function imageInsertEditDelete()
    {

        if ($_POST["action"] == "insert") {
            $user_id = $_GET['user_id'];
            $text = $_POST['text'];
            $file = addslashes($_FILES['image']['tmp_name']);
            $file = file_get_contents($file);
            $file = base64_encode($file);
            $sth = $this->db->query(" INSERT INTO ".DB_TABLE2." (`id`, `image`, `text` ,`username`) VALUES (NULL,' $file ', '$text','$user_id') ");
            if ($sth == true) {
                echo "Image Inserted Successfully";
            } else {
                echo 'error';
            }
        }
        if ($_POST["action"] == "update") {

            $file = addslashes($_FILES['image']['tmp_name']);
            $file = file_get_contents($file);
            $file = base64_encode($file);
            $text = $_POST['text'];
            $id = $_POST["image_id"];
            $sth = $this->db->query(" UPDATE ".DB_TABLE2." SET `image`='$file', `text`='$text' WHERE " . DB_TABLE2 . ".`id` = '$id' ");
            if ($sth == true) {
                echo "Image Updated Successfully";
            } else {
                echo 'error';
            }
        }
        if ($_POST["action"] == "delete") {
            $id = $_POST["image_id"];
            $sth = $this->db->query(" DELETE FROM ".DB_TABLE2." WHERE id = '$id' LIMIT 1 ");
            if ($sth == true) {
                echo "Image Deleted Successfully";
            } else {
                echo 'error';
            }
        }
    }
}