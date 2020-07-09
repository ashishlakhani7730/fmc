<div id="wrapper">

    <?php include("inc/company_navbar.php") ?>

    <?php include("inc/company_sidebar.php") ?>
 

    <div id="main-content">
    	<div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo JOB_OPENIG_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                            <li class="breadcrumb-item active"><?php echo JOB_OPENIG_CREATE_JOB; ?></li>
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
                            <form action="<?= base_url('jobopenings/create');?>" id="create-job-position" method="post" novalidate>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo JOB_POSITIONS_JOB_TITLE; ?></label>
                                        <input type="text" class="form-control" name="job_title" placeholder="<?php echo JOB_POSITIONS_JOB_TITLE; ?>" required>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo JOB_OPENIG_JOB_DESIGNATION; ?></label>
                                        <select name="job_designation" class="form-control show-tick ms select2" data-placeholder="Select" required>
                                            <option value=""><?php echo JOB_POSITIONS_SELECT; ?></option>
                                            <?php
                                            if(!empty($designation)){
                                                foreach ($designation as $key => $value) { ?>
                                                ?>
                                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                                <?php 
                                                }
                                            } 
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo JOB_POSITIONS_TITLE; ?></label>
                                        <select name="job_position[]" class="form-control show-tick ms select2" multiple="true" data-placeholder="Select" required>
                                            <option value=""><?php echo JOB_OPENIG_SELECT_POSITION; ?></option>
                                            <?php
                                            if(!empty($job_positions)){
                                                foreach ($job_positions as $key => $value) { ?>
                                                ?>
                                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['job_title']; ?> / <?php echo $value['designation_name']; ?></option>
                                                <?php 
                                                }
                                            } 
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo JOB_OPENIG_NO_OF_VACANCY; ?></label>
                                        <input type="number" value="1" class="form-control" name="no_of_vacancy" placeholder="<?php echo JOB_OPENIG_NO_OF_VACANCY; ?>" required>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo JOB_OPENIG_DESCRIPTION; ?></label>
                                        <textarea class="form-control" name="job_description" id="job_description" placeholder="<?php echo JOB_OPENIG_DESCRIPTION; ?>" required></textarea>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo JOB_OPENIG_STATUS; ?></label>
                                        <select name="status" class="form-control show-tick ms select2" data-placeholder="Select" required>
                                            <option value=""><?php echo JOB_OPENIG_SELECT_STATUS; ?></option>
                                            <option value="open" selected><?php echo JOB_OPENIG_OPEN; ?></option>
                                            <option value="closed"><?php echo JOB_OPENIG_CLOSED; ?></option>
                                            <option value="in_progress"><?php echo JOB_OPENIG_IN_PROGRESS; ?></option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-success"><?php echo JOB_OPENIG_CREATE_JOB_OPEN; ?></button>
                                <a href="<?= site_url(); ?>jobopenings"><button type="button" class="btn btn-danger"><?php echo JOB_OPENIG_CANCEL; ?></button></a>
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

        //Text Editor For #job_description
        CKEDITOR.replace('job_description');
        CKEDITOR.config.height = 300;
        
    });
</script>