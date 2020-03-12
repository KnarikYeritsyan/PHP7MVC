<?php

class About extends Controller
{
    function __construct()
    {
        parent::__construct();

    }
    function index()
    {
        $this->vew->render('about' .DS.'index');
    }

}