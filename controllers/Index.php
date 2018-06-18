<?php

class Index extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        $this->vew->render('index'.DS.'index');
    }

}