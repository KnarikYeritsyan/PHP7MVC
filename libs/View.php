<?php

class View
{
    function __construct()
    {

    }
    public function render($name, $vars = [], $noninclude = false)
    {
        ob_start();
        extract($vars);
        require $_SERVER['DOCUMENT_ROOT'].'/views/'.$name.'.php';
        $layout_content = ob_get_clean();
        if ($noninclude == true)
        {
            $layout_content;
//            require 'views/'.$name.'.php';
        }else{
            require $_SERVER['DOCUMENT_ROOT'].'/views/layouts/default.php';
//            require 'views/'.'header.php';
//            require 'views/'.$name.'.php';
//            require 'views/'.'footer.php';
        }

    }
}