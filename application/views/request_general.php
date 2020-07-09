<div id="wrapper">

    <?php include("inc/company_navbar.php") ?>

    <?php include("inc/company_sidebar.php") ?>
 

    <div id="main-content">
    	<div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo GENERAL_REQUEST; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                            <li class="breadcrumb-item active"><?php echo GENERAL_REQUEST_CREATE; ?></li>
                        </ul>
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                                             
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <form action="<?= base_url('requests/general');?>" id="create-general_request" method="post" novalidate>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-6 col-md-12">
                                        <label><?php echo GENERAL_REQUEST_EMPLOYEE; ?></label>
                                        <select name="employee_id" id="employee_id" class="form-control show-tick ms select2" data-placeholder="Select" required>
                                            <option value=""><?php echo GENERAL_REQUEST_SELECT_EMPLOYEE; ?></option>
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
                                        <label><?php echo GENERAL_REQUEST_TYPE; ?></label>
                                        <select name="request_type_id" id="request_type_id" class="form-control show-tick ms select2" required>
                                            <option value=""><?php echo GENERAL_REQUEST_SELECT_TYPE; ?></option>
                                        <?php if(!empty($reuests_types)){ ?>
                                        <?php foreach ($reuests_types as $key => $value) { ?>
                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                        <?php } //foreach?>
                                        <?php } //if?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo GENERAL_REQUEST_TITLE; ?></label>
                                        <input type="text" class="form-control" name="title" placeholder="<?php echo GENERAL_REQUEST_TITLE; ?>"required>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo GENERAL_REQUEST_DESCRIPTION; ?></label>
                                        <textarea class="form-control" name="description" placeholder="<?php echo GENERAL_REQUEST_DESCRIPTION; ?>"></textarea>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-6 col-md-6">
                                        <label><?php echo GENERAL_REQUEST_ASSIGN_USER; ?> </label>
                                        <select name="assigned_fmc_user_id" id="assigned_fmc_user_id" class="form-control show-tick ms select2" data-placeholder="Select" required>
                                            <option value=""><?php echo GENERAL_REQUEST_SELECT_USER; ?></option>
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
                                <button type="submit" class="btn btn-success"><?php echo GENERAL_REQUEST_CREATES; ?></button>
                                <a href="<?= site_url(); ?>general_request"><button type="button" class="btn btn-danger"><?php echo GENERAL_REQUEST_CANCEL; ?></button></a>
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


<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
    $(function() {      
        //initialize Form Validation
        $('#create-general_request').parsley();
        
    });
</script>