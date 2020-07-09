<div id="wrapper">

    <?php include("inc/company_navbar.php") ?>

    <?php include("inc/company_sidebar.php") ?> 

    <div id="main-content">
    	<div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo REQUEST_LEAVE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                            <li class="breadcrumb-item active"><?php echo REQUESTS_ECCR; ?></li>
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
                            <form id="request-eccr" action="<?= base_url('requests/eccr');?>" method="post" novalidate enctype="multipart/form-data">
                                <div class="row clearfix">
                                    <div class="form-group col-lg-6 col-md-12">
                                        <label><?php echo REQUESTS_ECCR_EMPLOYEE; ?></label>
                                        <select name="employee_id" id="employee_id" class="form-control show-tick ms select2" data-placeholder="Select" required>
                                            <option value=""><?php echo REQUESTS_ECCR_SELECT_EMPLOYEE; ?></option>
                                            <?php
                                            if(!empty($employees)){
                                                foreach ($employees as $key => $value) { 
                                                    $selected = "";
                                                    if($employee_id == $value['id']){
                                                        $selected = "selected";
                                                    }
                                                ?>
                                                    <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['fullname_english']; ?></option>
                                                <?php 
                                                }
                                            } 
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-12">
                                        <label><?php echo REQUESTS_ECCR_TYPE; ?></label>
                                        <select name="request_type" id="request_type" class="form-control show-tick ms select2" required>
                                            <option value="position_change"><?php echo REQUESTS_ECCR_POSITION_CHANGE; ?></option>
                                            <option value="allowances_add"><?php echo REQUESTS_ECCR_POSITION_ADD_ALLOWANCE; ?></option>
                                            <option value="allowances_descrease"><?php echo REQUESTS_ECCR_DESCREASE_ALLOWANCE; ?></option>
                                            <option value="salary_increment"><?php echo REQUESTS_ECCR_SALARY_INCREMENT; ?></option>
                                            <option value="location_change"><?php echo REQUESTS_ECCR_LOCATION_CHANGE; ?></option>
                                            <option value="department_change"><?php echo REQUESTS_ECCR_DEPARTMENT_CHANGE; ?></option>
                                            <option value="temporary_relocation"><?php echo REQUESTS_ECCR_TEMPORARY_RELOACTION; ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo REQUESTS_ECCR_TITLE; ?></label>
                                        <input type="text" class="form-control" name="title" placeholder="<?php echo REQUESTS_ECCR_TITLE; ?>" required>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo REQUESTS_ECCR_DESCRIPTION; ?></label>
                                        <textarea class="form-control" name="description" placeholder="<?php echo REQUESTS_ECCR_DESCRIPTION; ?>"></textarea>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-6 col-md-6">
                                        <label><?php echo REQUESTS_ECCR_ASSIGN_USER; ?></label>
                                        <select name="assigned_fmc_user_id" id="assigned_fmc_user_id" class="form-control show-tick ms select2" data-placeholder="Select" required>
                                            <option value=""><?php echo REQUESTS_ECCR_SELECT_USER; ?></option>
                                            <?php
                                            if(!empty($fmc_users)){
                                                foreach ($fmc_users as $key => $value) { 
                                                    $selected = "";
                                                ?>
                                                    <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['first_name']." ".$value['last_name']." ".$value['surname']; ?></option>
                                                <?php 
                                                }
                                            } 
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-success"><?php echo REQUESTS_ECCR_CREATE; ?></button>
                                <a href="<?= site_url(); ?>employees"><button type="button" class="btn btn-danger"><?php echo REQUESTS_ECCR_CANCEL; ?></button></a>
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

<!-- Form Validation -->
<script src="<?= site_url(); ?>assets/vendor/parsleyjs/js/parsley.min.js"></script>

<!-- Date-Picker Time-Picker -->
<script src="<?= site_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<!-- Ckeditor --> 
<script src="<?= site_url(); ?>assets/vendor/ckeditor/ckeditor.js"></script> 

<!-- Input Mask Plugin Js --> 
<script src="<?= site_url(); ?>assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js"></script> 
<script src="<?= site_url(); ?>assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js"></script>

<!-- Toaster --> 
<script src="<?= site_url(); ?>assets/vendor/toastr/toastr.js"></script> 

<!-- SweetAlert For Dialog Box --> 
<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script>

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
    $(function() {
        $('#request-eccr').parsley();    
    });
</script>

