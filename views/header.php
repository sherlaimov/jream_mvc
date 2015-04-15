<?php
//print_r($_SESSION);

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Header</title>
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?= URL; ?>public/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?= URL; ?>public/js/custom.js"></script>
        <link rel="stylesheet" href="<?= URL; ?>public/css/main.css">


        <?php
        if (isset($this->js)) {
            foreach ($this->js as $js) {
                echo '<script type="text/javascript" src="' . URL . 'views/' . $js . '"></script>';
            }
        }
        ?>
    </head>
    <body>
        <div class="container">
            <header id="header" role="header">
                <nav class="navbar navbar-default">

                    <ul class="nav navbar-nav">
                        <li><a href="<?= URL; ?>index">Index</a></li>
                        <li><a href="<?= URL; ?>help">Help</a></li>
                        <?php if (Session::get('loggedIn') == TRUE) : ?>
                            <li><a href="<?= URL; ?>dashboard">Dashboard</a></li>
                            <li><a href="<?= URL; ?>note">Notes</a></li>

                        <?php if (Session::get('role') == 'owner' || 'admin') : ?>
                            <li><a href="<?= URL; ?>user">Users</a></li>
                        <?php endif; ?>
                            <li class="pull-right"><a href="<?= URL; ?>dashboard/logout">Logout</a></li>
                        <?php else: ?>
                            <li><a href="<?= URL; ?>login">Login</a></li>
                        <?php endif; ?>

                </nav>
            </header>
        </div>
        <div class="container">
            <div id="main">

