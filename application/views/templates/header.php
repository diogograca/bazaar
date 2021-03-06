<!--  This template is to be used with any page that doesnt have an iframe object  -->
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/css.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/bootstrap.min.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>JavaScript/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>JavaScript/bootstrap.min.js"></script>
</head>

<body>

<div id="wrapper">

    <div class="navbar navbar-default navbar-static-top">
        <div class="container">

            <a href="<?php echo base_url(); ?>" class="navbar-brand">Home</a>

            <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <div class="collapse navbar-collapse navHeaderCollapse">

                <ul class="nav navbar-nav navbar-right">

                    <li><a href="<?php echo base_url(); ?>index.php/proposals">Proposals</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/lecturers">Lecturers</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/projectsSummaries">Past Projects</a></li>
                    <?php
                    $logged_in = $this->session->userdata('loggedin');
                    $username = $this->session->userdata('username');


                    if ($logged_in) {
                        ?>
                        <li><a href="<?php echo base_url() . 'index.php/profile/' . $username; ?>">My Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/home/logout">Log out</a></li>
                    <?php
                    } else {
                        ?>
                        <li><a href="<?php echo base_url(); ?>index.php/register">Register</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/login">Login</a></li>
                    <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
    </div>

