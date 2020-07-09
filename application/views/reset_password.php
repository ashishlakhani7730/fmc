<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">

<head>
<title>:: FMC :: Reset Password</title>
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

<!--Form Validation  -->
<link rel="stylesheet" href="<?= site_url(); ?>assets/vendor/parsleyjs/css/parsley.css">

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
                            <p class="lead">Reset your password</p>
                            <div class="text-center m-3">
                                <img src="<?= site_url(); ?>assets/images/smily.png" alt="Alternate Text" />
                            </div>
                            
                            <span>Congratulation , your number/email is verified </span>
                        </div>
                        <div class="body">
                            <form id="reset-password-form" class="form-auth-small" action="<?= base_url('login/reset_password/'.base64_encode($id));?>" method="post">
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">New Password</label>
                                    <input type="password" name="new_password" class="form-control" id="password" value="" placeholder="New Password" required>
                                </div>
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control" id="signin-password" value="" placeholder="Confirm Password" required data-parsley-equalto-message="This value should be the same as password." data-parsley-equalto="#password">
                                </div>
                                
                                <button type="submit" class="btn btn-primary btn-lg btn-block">SAVE NEW PASSWORD</button>
                                <div class="bottom">
                                    <span>Know your password? <a href="<?= site_url(); ?>login">Login</a></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- END WRAPPER -->

    <!-- Common Javascript Library Included jquery-3.3.1.min.js,popper.min.js,bootstrap.js -->
    <script src="<?= site_url(); ?>assets/bundles/libscripts.bundle.js"></script>
    <!-- Common Javascript Library metisMenu.js,jquery.slimscroll.min.js,bootstrap-progressbar.min.js,jquery.sparkline.min.js -->
    <script src="<?= site_url(); ?>assets/bundles/vendorscripts.bundle.js"></script>

    <!-- Form Validation -->
    <script src="<?= site_url(); ?>assets/vendor/parsleyjs/js/parsley.min.js"></script>

    <script type="text/javascript">
        $(function() {
            //initialize Form Validation
            $('#reset-password-form').parsley();
        });
    </script>

</body>

</html>
