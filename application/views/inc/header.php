<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php 
$fmc_language = (isset($_COOKIE["fmc_language"])) ? $_COOKIE["fmc_language"] :"english";
?>
<!doctype html>
<html lang="en">

<head>
    <title>FMC :: <?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Lucid Bootstrap 4.1.1 Admin Template">
    <meta name="author" content="WrapTheme, design by: ThemeMakker.com">

    <link rel="icon" href="<?= site_url(); ?>assets/favicon.ico" type="image/x-icon">
    
    <!-- COMMON CSS -->
    <?php if($fmc_language == 'english'){ ?>
    <link rel="stylesheet" href="<?= site_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <?php } ?>
    <?php if($fmc_language == 'arabic'){ ?>
    <link rel="stylesheet" href="<?= site_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.rtl.css">
    <?php } ?>
    
    <link rel="stylesheet" href="<?= site_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css">

    <!--Seach Dropdown .select2  -->
    <link rel="stylesheet" href="<?= site_url(); ?>assets/vendor/select2/select2.css" />

    <!-- MultiSelect Dropdown -->
    <link rel="stylesheet" href="<?= site_url(); ?>assets/vendor/multi-select/css/multi-select.css">
    <link rel="stylesheet" href="<?= site_url(); ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css">

    <link rel="stylesheet" href="<?= site_url(); ?>assets/vendor/fullcalendar/fullcalendar.min.css">

    <!--Form Validation  -->
    <link rel="stylesheet" href="<?= site_url(); ?>assets/vendor/parsleyjs/css/parsley.css">

    <!--Jquery Datatable  -->
    <link rel="stylesheet" href="<?= site_url(); ?>assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= site_url(); ?>assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= site_url(); ?>assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">

    <!--Date Picker -->
    <link rel="stylesheet" href="<?= site_url(); ?>assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">

    <!--Color Picker -->
    <link rel="stylesheet" href="<?= site_url(); ?>assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css">

    <!--Sweetalert for Dialog Box -->
    <link rel="stylesheet" href="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.css"/>
    <!-- Toaster --> 
    <link rel="stylesheet" href="<?= site_url(); ?>assets/vendor/toastr/toastr.css"/>

    <!-- COMMON CSS -->
    <?php if($fmc_language == 'english'){ ?>
    <link rel="stylesheet" href="<?= site_url(); ?>assets/css/main.css">
    <link rel="stylesheet" href="<?= site_url(); ?>assets/css/color_skins.css">
    <?php } ?>
    <?php if($fmc_language == 'arabic'){ ?>
    <link rel="stylesheet" href="<?= site_url(); ?>assets/css/rtl_main.css">
    <link rel="stylesheet" href="<?= site_url(); ?>assets/css/rtl_color_skins.css">
    <?php } ?>

    <link rel="stylesheet" href="<?= site_url(); ?>assets/css/blog.css">

    <!-- Drag & Drop -->
    <link rel="stylesheet" href="<?= site_url(); ?>assets/vendor/dropify/css/dropify.min.css">
    
</head>

<body class="theme-orange <?php echo ($fmc_language == 'arabic') ? 'rtl' : ''; ?>">

	<!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img src="<?= site_url(); ?>assets/images/favicon.png" width="48" height="48" alt="Lucid"></div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- Overlay For Sidebars -->