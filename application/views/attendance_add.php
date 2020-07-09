<div id="wrapper">

    <?php include("inc/company_navbar.php") ?>

    <?php include("inc/company_sidebar.php") ?>

    <?php 
    //Load Attendance Model
    $CI->load->model('attendance_model');
    ?>
 
    <style type="text/css">
        .attendance{
            cursor: pointer;
            display: inline-block;
            font-weight: bold;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;
            padding: 5px 7px;
            font-size: 11px;
            line-height: 1.0;
            border-radius: 10px!important;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .attendance-absent{
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .attendance-absent:focus{
            box-shadow: 0 0 0 0.2rem rgba(220,53,69,.5);
        } 
        .attendance-present{
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }
        .attendance-present:focus{
            box-shadow: 0 0 0 0.2rem rgba(40,167,69,.5);
        }
        .attendance-halfday{
            color: #212529;
            background-color: #ffc107;
            border-color: #ffc107;
        }
        .attendance-halfday:focus{
            box-shadow: 0 0 0 0.2rem rgba(255,193,7,.5);            
        }
        .attendance-full-leave{
            color: #fff;
            background-color: #343a40;
            border-color: #343a40;
        }
        .attendance-full-leave:focus{
            box-shadow: 0 0 0 0.2rem rgba(52,58,64,.5);
        }
        button.attendance:focus {outline:0;}
    </style>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo ATTANDANCE_ADD_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">
                                <a href="<?= site_url(); ?>attendance"><?php echo ATTANDANCE_ADD_BREADCRUMBS_TITLE_1; ?></a>
                            </li>
                            <li class="breadcrumb-item active"><?php echo ATTANDANCE_ADD_BREADCRUMBS_TITLE_2; ?></li>
                        </ul>                        
                    </div>            
                    <div class="col-lg-8 col-md-8 col-sm-12 text-right">
                    </div>
                </div>
            </div>
            
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
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
                    <div class="card">
                        <div class="body">
                        <form action="<?= base_url('attendance/confirm');?>" id="add_attendance_form" method="post" novalidate>

                            <div class="row clearfix">
                                <div class="form-group col-lg-12 col-md-12">
                                    <label><?php echo ATTANDANCE_SELECT_YEAR; ?></label>
                                    <select name="year" id="attendance_year" class="form-control show-tick ms select2" data-placeholder="Select Year" required>
                                        <option value=""><?php echo ATTANDANCE_SELECT_YEAR; ?></option>
                                        <?php
                                        for ($i=2020; $i <= date('Y'); $i++) { 
                                            $selected = "";
                                            if($year == $i){
                                                $selected = "selected";
                                            }
                                        ?>
                                        <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                                        <?php    
                                        }
                                        ?>
                                    </select>
                                </div>                                             
                            </div>
                            
                            <div class="row clearfix">
                                <div class="form-group col-lg-12 col-md-12">
                                    <label><?php echo ATTANDANCE_SELECT_MONTH; ?></label>
                                    <select name="month" id="attendance_month" class="form-control show-tick ms select2" data-placeholder="Select Month" required>
                                        <option value=""><?php echo ATTANDANCE_SELECT_MONTH; ?></option>
                                        <option value="01" <?php echo ($month == "01") ? "selected" : ""; ?>><?php echo ATTANDANCE_JANUARY; ?></option>
                                        <option value="02" <?php echo ($month == "02") ? "selected" : ""; ?>><?php echo ATTANDANCE_FEBRUARY; ?></option>
                                        <option value="03" <?php echo ($month == "03") ? "selected" : ""; ?>><?php echo ATTANDANCE_MARCH; ?></option>
                                        <option value="04" <?php echo ($month == "04") ? "selected" : ""; ?>><?php echo ATTANDANCE_APRIL; ?></option>
                                        <option value="05" <?php echo ($month == "05") ? "selected" : ""; ?>><?php echo ATTANDANCE_MAY; ?></option>
                                        <option value="06" <?php echo ($month == "06") ? "selected" : ""; ?>><?php echo ATTANDANCE_JUNE; ?></option>
                                        <option value="07" <?php echo ($month == "07") ? "selected" : ""; ?>><?php echo ATTANDANCE_JULY; ?></option>
                                        <option value="08" <?php echo ($month == "08") ? "selected" : ""; ?>><?php echo ATTANDANCE_AUGUST; ?></option>
                                        <option value="09" <?php echo ($month == "09") ? "selected" : ""; ?>><?php echo ATTANDANCE_SEPTEMBER; ?></option>
                                        <option value="10" <?php echo ($month == "10") ? "selected" : ""; ?>><?php echo ATTANDANCE_OCTOMBER; ?></option>
                                        <option value="11" <?php echo ($month == "11") ? "selected" : ""; ?>><?php echo ATTANDANCE_NOVEMBER; ?></option>
                                        <option value="12" <?php echo ($month == "12") ? "selected" : ""; ?>><?php echo ATTANDANCE_DECEMBER; ?></option>
                                    </select>
                                </div>
                            </div>

                            <br>
                            <button type="submit" class="btn btn-success"><?php echo ATTANDANCE_ADD_SUBMIT_BTN; ?></button>
                            <a href="<?= site_url(); ?>attendance" class="btn btn-danger">
                                <?php echo ATTANDANCE_ADD_CANCEL_BTN; ?>
                            </a>

                        </form>                    
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<!-- Common Javascript Library Included jquery-3.3.1.min.js,popper.min.js,bootstrap.js -->
<script src="<?= site_url(); ?>assets/bundles/libscripts.bundle.js"></script>
<!-- Common Javascript Library metisMenu.js,jquery.slimscroll.min.js,bootstrap-progressbar.min.js,jquery.sparkline.min.js -->
<script src="<?= site_url(); ?>assets/bundles/vendorscripts.bundle.js"></script>

<!-- Search Drondown .select2 -->
<script src="<?= site_url(); ?>assets/vendor/select2/select2.min.js"></script>

<!-- Multi Select Dropdown -->
<script src="<?= site_url(); ?>assets/vendor/multi-select/js/jquery.multi-select.js"></script> 
<script src="<?= site_url(); ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>

<!-- Jquery Datatables -->
<script src="<?= site_url(); ?>assets/bundles/datatablescripts.bundle.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>

<!-- Form Validation -->
<script src="<?= site_url(); ?>assets/vendor/parsleyjs/js/parsley.min.js"></script>

<!-- Date-Picker Time-Picker -->
<script src="<?= site_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<!-- Ckeditor --> 
<script src="<?= site_url(); ?>assets/vendor/ckeditor/ckeditor.js"></script> 

<!-- bootstrap treeview -->
<script src="<?= site_url(); ?>assets/vendor/bootstrap-treeview/bootstrap-treeview.min.js"></script>

<!-- Input Mask Plugin Js --> 
<script src="<?= site_url(); ?>assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js"></script> 
<script src="<?= site_url(); ?>assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js"></script>

<!-- SweetAlert For Dialog Box --> 
<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script> 

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 



<script type="text/javascript">
    $(function () {      
        $('#add_attendance_form').parsley();
    });
</script>