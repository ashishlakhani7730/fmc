<div id="wrapper">

    <?php include("inc/company_navbar.php") ?>

    <?php include("inc/company_sidebar.php") ?> 

    <div id="main-content">
    	<div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo REQUEST_BUSINESS_TRIP; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                            <li class="breadcrumb-item active"><?php echo REQUEST_BUSINESS_TRIP; ?></li>
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
                            <form id="request-businesstrip" action="<?= base_url('requests/bussiness_trip');?>" method="post" novalidate>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-6 col-md-6">
                                        <label><?php echo REQUEST_BUSINESS_EMPLOYEE; ?></label>
                                        <select name="employee_id" id="employee_id" class="form-control show-tick ms select2" data-placeholder="Select" required>
                                            <option value=""><?php echo REQUEST_BUSINESS_SELECT_EMPLOYEE; ?><</option>
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
                                    <div class="form-group col-lg-6 col-md-6">
                                        <label><?php echo REQUEST_BUSINESS_TITLE; ?></label>
                                        <input type="text" class="form-control" name="title" placeholder="<?php echo REQUEST_BUSINESS_TITLE; ?>">
                                    </div>
                                </div>
                                <div class="row clearfix">
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo REQUEST_BUSINESS_FROM_DATE; ?> <span class="text-danger">*</span></label>
                                             <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="from_date" id="from_date" placeholder="<?php echo REQUEST_BUSINESS_FROM_DATE; ?>" autocomplete="off" value="" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo REQUEST_BUSINESS_TO_DATE; ?> <span class="text-danger">*</span></label>
                                             <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="to_date" id="to_date" placeholder="<?php echo REQUEST_BUSINESS_TO_DATE; ?>" autocomplete="off" value="" readonly required>
                                        </div>
                                    </div>
                                     
                                </div>                                
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo REQUEST_BUSINESS_DESCRIPTION; ?></label>
                                        <textarea class="form-control" name="description" placeholder="<?php echo REQUEST_BUSINESS_DESCRIPTION; ?>" ></textarea>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo REQUEST_BUSINESS_TRIP_ROUTE; ?></label>
                                        <textarea class="form-control" name="trip_route" placeholder="<?php echo REQUEST_BUSINESS_TRIP_ROUTE; ?>" required></textarea>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-6 col-md-6">
                                        <label><?php echo REQUEST_BUSINESS_PROJECT_NAME; ?></label>
                                        <input class="form-control" type="text" name="project_name" placeholder="<?php echo REQUEST_BUSINESS_PROJECT_NAME; ?>" required>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6">
                                        <label><?php echo REQUEST_BUSINESS_DESTINATION; ?></label>
                                        <input class="form-control" type="text" name="destination" placeholder="<?php echo REQUEST_BUSINESS_DESTINATION; ?>" required>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-4 col-md-6">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox" name="is_accommodation_required" value="yes"><span><?php echo REQUEST_BUSINESS_ACCOMODATION; ?></span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox" name="is_entry_visa_required" value="yes"><span><?php echo REQUEST_BUSINESS_ENTRY_VISA; ?></span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox" name="is_exit_visa_required" value="yes"><span><?php echo REQUEST_BUSINESS_EXIT_VISA; ?></span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-4 col-md-6">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox" name="is_travel_ticket_required" value="yes"><span><?php echo REQUEST_BUSINESS_TRAVEL_TICKET; ?></span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox" name="is_on_hand_cash_required" id="is_on_hand_cash_required" value="yes"><span><?php echo REQUEST_BUSINESS_ON_HAND_CASH; ?></span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6">
                                        <input class="form-control" type="text" id="cash_amount" name="cash_amount"  style="display:none;" placeholder="<?php echo REQUEST_BUSINESS_ON_HAND_AMMOUNT; ?>" />
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-4 col-md-6">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox" name="is_car_required" value="yes"><span><?php echo REQUEST_BUSINESS_CAR; ?></span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-6 col-md-6">
                                        <label><?php echo REQUEST_BUSINESS_ASSIGN_USER; ?> </label>
                                        <select name="assigned_fmc_user_id" id="assigned_fmc_user_id" class="form-control show-tick ms select2" data-placeholder="Select" required>
                                            <option value=""><?php echo REQUEST_BUSINESS_SELECT_USER; ?></option>
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
                                <button type="submit" class="btn btn-success"><?php echo REQUEST_BUSINESS_CREATE; ?></button>
                                <a href="<?= site_url(); ?>employees"><button type="button" class="btn btn-danger"><?php echo REQUEST_BUSINESS_CANCEL; ?></button></a>
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

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
    $(function() {      
        //initialize Form Validation
        $('#request-businesstrip').parsley();    
        
        $("#is_on_hand_cash_required").click(function() {
            $("#cash_amount").toggle();
        });
        
    });
</script>
