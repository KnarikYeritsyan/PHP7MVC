<?php

class Login_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function run()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $remember = $_POST['remember'];

        if (strlen($username)>0 && strlen($password)>0)
        {
        try {
            $sth = $this->db->prepare("SELECT * FROM ".DB_TABLE1." WHERE `username` = :username AND `password` = :password ");
            $sth->execute(array(':username' => $username,
                ':password' => $password
            ));

        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $count = $sth->rowCount();
        if ($count > 0) {
            $data = $sth->fetch();
            Session::init();
            Session::set('user_id', $data['id']);
            Session::set('username', $username);
            Session::set('password', $password);
            Session::set('firstname', $data['first_name']);
            Session::set('lastname', $data['last_name']);
            Session::set('profile', $data['profile_picture']);
            Session::set('comment', $data['profile_comment']);
            Session::set('loggedIn', true);
            if ($remember == 1)
            {
                setcookie("username", $username,time()+60*60*7);
                setcookie("password", $password,time()+60*60*7);
            }
            header('location: ' . URL . 'dashboard');
        } else {
            exit();
        }
        }else{
            exit();
        }
    }

    public function profile()
    {
        Session::init();
        $user_id = $_GET['user_id'];
        if ($_POST["action"] == "insert") {
            $text = $_POST['text'];
            $file = addslashes($_FILES['image']['tmp_name']);
            $file = file_get_contents($file);
            $file = base64_encode($file);
            $sth = $this->db->query(" UPDATE ".DB_TABLE1." SET `profile_picture` = '$file', `profile_comment`='$text' WHERE ".DB_TABLE1.".`id` = '$user_id'");

            if ($sth == true) {
                echo "Your profile picture inserted successfully";
                $sthh = $this->db->query("SELECT * FROM ".DB_TABLE1." WHERE ".DB_TABLE1.".`id` = '$user_id' ");

                $data = $sthh->fetch();
                Session::set('profile', $data['profile_picture']);
                Session::set('comment', $data['profile_comment']);
            } else {
                echo 'error';
            }
        }
        if ($_POST["action"] == "update") {

            $file = addslashes($_FILES['image']['tmp_name']);
            $file = file_get_contents($file);
            $file = base64_encode($file);
            $text = $_POST['text'];
            $sth = $this->db->query(" UPDATE ".DB_TABLE1." SET `profile_picture` = '$file', `profile_comment`='$text' WHERE ".DB_TABLE1.".`id` = '$user_id'");
            if ($sth == true) {
                echo "Your profile picture updated successfully";

                $sthh = $this->db->query("SELECT * FROM ".DB_TABLE1." WHERE  ".DB_TABLE1.".`id` = '$user_id' ");
                $data = $sthh->fetch();
                Session::set('profile', $data['profile_picture']);
                Session::set('comment', $data['profile_comment']);
            } else {
                echo 'error';
            }
        }
        if ($_POST["action"] == "delete") {
            $sth = $this->db->query(" UPDATE ".DB_TABLE1." SET `profile_picture` = '', `profile_comment`='' WHERE ".DB_TABLE1.".`id` = '$user_id'");
            if ($sth == true) {
                echo "Your profile picture deleted successfully";
                Session::set('profile', '');
                Session::set('comment', '');
            } else {
                echo 'error';
            }
        }
    }
}