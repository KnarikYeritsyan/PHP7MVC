<?php

class Register_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function run()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $password1 = $_POST['password1'];
        $remember = $_POST['remember'];

        $sthu = $this->db->query(" SELECT username FROM ".DB_TABLE1." WHERE `username` = '$username'");
        $countu = $sthu->rowCount();

        if ($countu == 0 && strlen($username)>0 && strlen($password)>5 && $password1 == $password) {
            try {
                $sth = $this->db->prepare(" INSERT INTO " . DB_TABLE1 . " (`id`, `username`, `password`, `first_name`, `last_name`) VALUES (NULL, :username  , :password, :firstname, :lastname  )");
                $sth->execute(array(':username' => $username,
                    ':password' => $password,
                    ':firstname' => $first_name,
                    ':lastname' => $last_name
                ));
            } catch (PDOException $e) {
                die($e->getMessage());
            }
            if ($sth == true) {
                $sthh = $this->db->query(" SELECT * FROM " . DB_TABLE1 . " WHERE `username` = '$username' AND `password` = '$password'");
                $data = $sthh->fetch();
                Session::init();
                Session::set('user_id', $data['id']);
                Session::set('username', $username);
                Session::set('password', $password);
                Session::set('firstname', $first_name);
                Session::set('lastname', $last_name);
                Session::set('profile', '');
                Session::set('text', '');
                Session::set('loggedIn', true);
                echo "Registered Successfully";
                if ($remember == 1) {
                    setcookie("username", $username, time() + 60 * 60 * 2);
                    setcookie("password", $password, time() + 60 * 60 * 2);
                }
                header("Refresh:0; url=" . URL . 'dashboard');
            }else{
                exit();
            }
        }else{
            exit();
        }
    }
}