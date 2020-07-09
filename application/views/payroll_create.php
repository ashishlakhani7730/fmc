<div id="wrapper">

    <?php include("inc/company_navbar.php") ?>

    <?php include("inc/company_sidebar.php") ?> 

    <style type="text/css">
        .multiselect-container {
            width: 100% !important;
        }
        .input-group-addon {
            padding: 6px 12px;
            font-size: 14px;
            font-weight: 400;
            line-height: 1;
            color: #555;
            text-align: center;
            background-color: #eee;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .multiselect{
            text-align: left;
        }
    </style>
    <link rel="stylesheet" href="<?= site_url(); ?>assets/css/bootstrap-multiselect.css">
    
    <div id="main-content">
    	<div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo PAYROLL_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                            <li class="breadcrumb-item active"><?php echo PAYROLL_CREATE; ?></li>
                        </ul>
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                                             
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
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
                            <form id="create-company-payroll" action="<?= base_url('payroll/create');?>" method="post" novalidate>
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Month<span class="text-danger">*</span></label>
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Year<span class="text-danger">*</span></label>
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
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-12">
                                        <label><?php echo PAYROLL_EMPLOYEE_NAME; ?></label><br>
                                        <select id="employee_id" name="employee_id[]" class="multiselect multiselect-custom" multiple="multiple" required>
                                            <?php
                                            if(!empty($employees)){
                                                foreach ($employees as $key => $value) { ?>
                                                ?>
                                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['fullname_english']; ?></option>
                                                <?php 
                                                }
                                            } 
                                            ?>
                                        </select>
                                    </div>
                                </div>                          
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo PAYROLL_DETAILS; ?></label>
                                        <textarea class="form-control" name="description" placeholder="<?php echo PAYROLL_DETAILS; ?>"></textarea>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-success"><?php echo PAYROLL_GENERATE; ?></button>
                                <a href="<?= site_url(); ?>payroll"><button type="button" class="btn btn-danger"><?php echo PAYROLL_CANCEL; ?></button></a>
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
<script src="<?= site_url(); ?>assets/js/bootstrap-multiselect.js"></script>

<!-- Form Validation -->
<script src="<?= site_url(); ?>assets/vendor/parsleyjs/js/parsley.min.js"></script>

<!-- Date-Picker Time-Picker -->
<script src="<?= site_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<!-- Ckeditor --> 
<script src="<?= site_url(); ?>assets/vendor/ckeditor/ckeditor.js"></script> 


<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
    $(function() {      
        //initialize Form Validation
        $('#create-company-payroll').parsley();

        $('#employee_id').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '100%',
            includeSelectAllOption: true
        });

        $("#from_date").change(function(){
            console.log("From Date Change");
        });

        $("#to_date").change(function(){
            console.log("To Date Change");
        });
            
    });
</script>
