<?php

class Users_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function edit(array $data)
	{
        $id = $data['id'];
        $username = $data['username'];
        $password = $data['password'];
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
//        $remember = $data['remember'];

        $sthu = $this->db->query(" SELECT username FROM ".DB_TABLE1." WHERE `username` = '$username' and id <>'$id'");
        $countu = $sthu->rowCount();

        if ($countu == 0)
        {
        try{
            $sth = $this->db->query(" UPDATE ".DB_TABLE1." SET `username` = '$username', `password` = '$password', `first_name` = '$first_name', `last_name` = '$last_name' WHERE " . DB_TABLE1 . ".`id` = '$id'");

        }catch (PDOException $e){
            die($e->getMessage());
        }
        if ($sth == true) {
            return true;
            /*if ($remember == 1) {
                setcookie("username", $username, time() + 60 * 60 * 2);
                setcookie("password", $password, time() + 60 * 60 * 2);
            }*/
        }else {
            exit();
        }
        }else{
            exit();
        }

	}
    public function userDelete($id)
    {
        try
        {
            $sth = $this->db->query(" DELETE FROM " .DB_TABLE1. " WHERE id = '$id' LIMIT 1 ");
//            $sthh = $this->db->query(" DELETE FROM ".DB_TABLE2." WHERE username = '$id'");

        }catch (PDOException $e){
            die($e->getMessage());
        }
        if ($sth == true
//            && $sthh == true
        ) {
            return true;
        }else {
            return false;
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