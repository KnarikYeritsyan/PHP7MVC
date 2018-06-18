<?php

class Help extends Controller
{
    function __construct()
    {
        parent::__construct();

    }
    function index()
    {
        $this->vew->render('help'.DS.'index');
    }

}