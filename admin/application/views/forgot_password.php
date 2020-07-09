<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">

<head>
<title>:: Lucid HR :: Login</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Lucid Bootstrap 4.1.1 Admin Template">
<meta name="author" content="WrapTheme, design by: ThemeMakker.com">

<link rel="icon" href="<?= site_url(); ?>assets/favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="<?= site_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= site_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="<?= site_url(); ?>assets/css/main.css">
<link rel="stylesheet" href="<?= site_url(); ?>assets/css/color_skins.css">
</head>

<body class="theme-orange">
	<!-- WRAPPER -->
    <div id="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle auth-main">
                <div class="auth-box">
                    <div class="top">
                        <img src="assets/images/fmc-logo.png" alt="Lucid">
                    </div>
                    <div class="card">
                        <div class="header">
                            <p class="lead">Recover my password</p>
                        </div>
                        <div class="body">
                            <p>Please enter your email address below to receive instructions for resetting password.</p>
                            <form class="form-auth-small" action="<?= base_url('forgot-password');?>" method="post">
                                <div class="form-group">                                    
                                    <input type="email" name="email" class="form-control" id="signup-password" placeholder="Email address / Mobile Number" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">RESET PASSWORD</button>
                                <div class="bottom">
                                    <span class="helper-text">Know your password? <a href="<?= site_url(); ?>login">Login</a></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	
	<!-- END WRAPPER -->
</body>
</html>
