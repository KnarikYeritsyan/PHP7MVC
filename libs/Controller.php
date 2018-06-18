<?php

class Controller
{
    function __construct()
    {
        $this->vew = new View();
    }
    public function loadModel($name)
    {
        $path = PATH.'models'.DS.$name.'_Model.php';
        if (file_exists($path))
        {
            $modelName = $name .'_Model';
            $this->model = new $modelName();
        }
    }



}