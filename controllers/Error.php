<?php

class Error extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        $this->vew->render('error/index');
    }

}
