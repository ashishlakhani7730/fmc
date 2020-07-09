<div id="wrapper">

    <?php include("inc/company_navbar.php") ?>

    <?php include("inc/company_sidebar.php") ?>
 

    <div id="main-content">
    	<div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo JOB_POSITIONS_CRATE_JOB; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                  
                            <li class="breadcrumb-item active"><?php echo JOB_POSITIONS_UPDATE; ?></li>
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
                            <form action="<?= base_url('jobpositions/update');?>" id="create-job-position" method="post" novalidate>
                            <input type="hidden" name="id" value="<?php echo base64_encode($details['id']); ?>">
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo JOB_POSITIONS_JOB_TITLE; ?></label>
                                        <input type="text" class="form-control" name="job_title" value="<?php echo $details['job_title']; ?>" placeholder="<?php echo JOB_POSITIONS_JOB_TITLE; ?>" required>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo JOB_POSITIONS_DESIGNATION; ?></label>
                                        <select name="designation" class="form-control show-tick ms select2" data-placeholder="Select" required>
                                            <option value=""><?php echo JOB_POSITIONS_SELECT; ?></option>
                                            <?php
                                            if(!empty($designation)){
                                                foreach ($designation as $key => $value) { 

                                                $selected = "";
                                                if($details['designation'] == $value['id']){
                                                    $selected = "selected";
                                                }
                                                

                                            ?>      <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['name']; ?></option>
                                                <?php 
                                                }
                                            } 
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo JOB_POSITIONS_PARENT_EMPLOYEE; ?></label>
                                        <select name="under_employee_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                            <option value=""><?php echo JOB_POSITIONS_SELECT_PARENT_EMPLOYEE; ?></option>
                                            <?php
                                            if(!empty($employees)){
                                                foreach ($employees as $key => $value) { 
                                                $selected = "";
                                                if($details['under_employee_id'] == $value['id']){
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
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label>Status</label>
                                        <select name="status" class="form-control show-tick ms select2" data-placeholder="Select">
                                            <option value="open">Open</option>
                                            <option value="closed">Closed</option>
                                            <option value="in_progress">In-Progress</option>
                                            <option value="deleted">Deleted</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo JOB_POSITIONS_DESCRIPTION; ?></label>
                                        <textarea class="form-control" name="description" placeholder="<?php echo JOB_POSITIONS_DESCRIPTION; ?>" required><?php echo $details['job_title']; ?></textarea>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-success"><?php echo JOB_POSITIONS_SAVE; ?></button>
                                <a href="<?= site_url(); ?>jobpositions"><button type="button" class="btn btn-danger"><?php echo JOB_POSITIONS_CANCEL; ?></button></a>
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
        $('#create-job-position').parsley();
        
    });
</script>