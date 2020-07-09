<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">

<head>
<title>:: FMC :: Verify Account</title>
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
                        <div class="header" style="padding-bottom:0;">
                            <?php
                                if($this->session->flashdata('flashError'))
                                {
                                    echo '<div class="alert alert-warning login-alert has-error">'.$this->session->flashdata('flashError').'</div>';
                                }
                                if($this->session->flashdata('flashSuccess'))
                                {
                                    echo '<div class="alert alert-success login-alert has-error">'.$this->session->flashdata('flashSuccess').'</div>';
                                }
                            ?>
                            <p class="lead mb-2">Verify Account</p>
                            <span>
                                OTP has been send to your mobile/email. <br />
                                Please verify .
                            </span>
                        </div>
                        <div class="body">
                            <form class="form-auth-small" action="<?= base_url('login-verify-otp/'.base64_encode($id));?>" method="post">
                                <div class="form-group">
                                    <input type="password" name="opt_code" class="form-control mb-2" id="" placeholder="OTP Code" required autocomplete="off">
                                    <span class="helper-text">If you don’t receive a code ! <a href="<?= site_url(); ?>login/resend_login_otp/<?php echo base64_encode($id); ?>">Resend</a></span>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">VERIFY ACCOUNT</button>
                                <div class="bottom">
                                    <span class="helper-text">Back to Login <a href="<?= site_url(); ?>login">Login</a></span>
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
