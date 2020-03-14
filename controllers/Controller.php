<?php
namespace controllers;

class Controller
{
    public $view;
    function __construct()
    {
        $this->view = new \View();
    }
    public function loadModel($name)
    {
        $path = PATH.'models'.DS.$name.'_Model.php';
        if (file_exists($path))
        {
            $modelName = '\\'.$name .'_Model';
            $this->model = new $modelName();
        }
    }



}