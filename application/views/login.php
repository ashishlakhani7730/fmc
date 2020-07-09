<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">

<head>
<title>:: FMC :: Login</title>
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
                        <img src="<?= site_url(); ?>assets/images/fmc-logo.png" alt="Lucid">
                    </div>
					<div class="card">
                        <div class="header">
                            <p class="lead">Login to your account</p>
                        </div>
                        <div class="body">
                            <?php
                                if($this->session->flashdata('flashError'))
                                {
                                    echo '<div class="alert alert-warning login-alert has-error">'.$this->session->flashdata('flashError').'</div>';
                                }
                                if($this->session->flashdata('flashSuccess'))
                                {
                                    echo '<div class="alert alert-success login-alert has-error">'.$this->session->flashdata('flashSuccess').'</div>';
                                }

                                $email = get_cookie('email')?get_cookie('email'):"";
                                $password = get_cookie('password')?get_cookie('password'):"";
                                $remember_me = get_cookie('remember_me')?"checked":"";
                            ?>
                            <form class="form-auth-small" action="<?= base_url('login');?>" method="post">
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Email</label>
                                    <input type="email" name="email" class="form-control" id="signin-email" value="<?php echo $email;?>" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    <input type="password" name="password" class="form-control" id="signin-password" value="<?php echo $password;?>" placeholder="Password" required>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="fancy-checkbox element-left">
                                        <input type="checkbox" name="remember_me" value="1" <?php echo $remember_me; ?>>
                                        <span>Remember me</span>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                                <div class="bottom">
                                    <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="<?= site_url(); ?>forgot-password">Forgot password?</a></span>
                                    <span>Contact Support <a href="<?= site_url(); ?>fmc-policy">FMC Policy</a></span>
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
