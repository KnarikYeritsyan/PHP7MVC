<?php Session::init(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Test</title>
    <link rel="stylesheet" type="text/css" href = "<?php echo URL; ?>public/css/default.css" />
    <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery.js">    </script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery-ui.js">    </script>
    <link rel="stylesheet" href = "<?php echo URL; ?>public/bootstrap/css/bootstrap.min.css" />
    <script type="text/javascript" src="<?php echo URL; ?>public/bootstrap/js/bootstrap.min.js">    </script>
</head>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <button type="button" class="navbar-toggle"
                data-toggle="collapse"
                data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <?php if (Session::get('loggedIn')==true):?>
            <a class="navbar-brand" href="<?php echo URL; ?>dashboard">My account</a>
        <?php else:?>
            <a class="navbar-brand" href="<?php echo URL; ?>login">Login</a>
            <a class="navbar-brand" href="<?php echo URL; ?>register">Register</a>
        <?php endif; ?>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"> <a  href="<?php echo URL; ?>index">Home</a></li>
                <li><a  href="<?php echo URL; ?>about">About</a></li>
                <?php if (Session::get('loggedIn')==true):
                $id = $_SESSION['user_id'];?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle"
                       data-toggle="dropdown">More <b class="caret"></b>
                        <ul class="dropdown-menu">
                            <li><a  href="<?php echo URL; ?>users/display?user_id=<?php echo $id; ?>">My Photos</a></li>
                            <li><a  href="<?php echo URL; ?>users/settings">Settings</a></li>
                            <li><a href="<?php echo URL; ?>dashboard/logout">Log out</a></li>
                        </ul>
                    </a>
                </li>
            </ul>
        </div>
    <?php endif; ?>
    </div>
</nav>
<body>

<div id="content">

