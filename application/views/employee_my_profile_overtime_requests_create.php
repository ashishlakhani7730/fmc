<div id="wrapper">

    <?php include("inc/company_employee_navbar.php") ?>
    
    <?php include("inc/company_employee_sidebar.php") ?>

    <div id="main-content">
    	<div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo REQUEST_OVERTIME_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                    <li class="breadcrumb-item"><a href="<?= site_url(); ?>overtime-requests">Ovetime Requests</a></li>                                     
                            <li class="breadcrumb-item active"><?php echo REQUEST_OVERTIME_CREATE; ?></li>
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
                            <form id="request-overtime" action="<?= base_url('myprofile_requests/create_overtime_request');?>" method="post" novalidate enctype="multipart/form-data">
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label><?php echo REQUEST_OVERTIME_DATE; ?> <span class="text-danger">*</span></label>
                                             <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="date" id="from_date" placeholder="<?php echo REQUEST_OVERTIME_DATE; ?>" autocomplete="off" value="" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                         <div class="form-group">
                                             <label><?php echo REQUEST_OVERTIME_FROM_TIME; ?></label>
                                             <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="icon-clock"></i></span>
                                                </div>
                                                <input type="text" name="from_time" class="form-control time12" placeholder="<?php echo REQUEST_OVERTIME_FROM_TIME_EX; ?>" required>
                                             </div>
                                         </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label><?php echo REQUEST_OVERTIME_TO_TIME; ?></label>
                                                <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="icon-clock"></i></span>
                                                </div>
                                                <input type="text" name="to_time" class="form-control time12" placeholder="<?php echo REQUEST_OVERTIME_FROM_TIME_EX; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo REQUEST_OVERTIME_DESCRIPTION; ?></label>
                                        <textarea class="form-control" name="description" placeholder="<?php echo REQUEST_OVERTIME_DESCRIPTION; ?>"></textarea>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12 form-group">
                                        <label><?php echo REQUEST_OVERTIME_UPLOAD_DOC; ?></label>
                                        <label for="document_file" class="dragndrop">
                                            <img src="<?= site_url(); ?>assets/images/upload.png" alt="" /><br />
                                            <?php echo REQUEST_OVERTIME_DRAG_DROP; ?><br />
                                            <?php echo CLIENTS_OR; ?><br />
                                            <?php echo REQUEST_OVERTIME_DOC_FILE; ?><br />
                                            <?php echo REQUEST_OVERTIME_DOC_TYPE; ?><br />
                                            <button for="document_file" type="button" class="btn btn-sm btn-outline-primary"><?php echo REQUEST_OVERTIME_BROWSE_FILE; ?></button>
                                            <br>
                                            <span id="selected_document_file_name"></span>
                                            <br>
                                            <input type="file" name="document_file" id="document_file" style="display: none;">
                                        </label>
                                    </div>
                                </div>                             

                                <br>
                                <button type="submit" class="btn btn-success"><?php echo REQUEST_OVERTIME_CREATE; ?></button>
                                <a href="<?= site_url(); ?>employees"><button type="button" class="btn btn-danger"><?php echo REQUEST_OVERTIME_CANCEL; ?></button></a>
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
        $('#request-overtime').parsley();

        $(function () {
            $('.time12').inputmask('hh:mm t', { placeholder: '__:__ _m', alias: 'time12', hourFormat: '12' });
        });            
    });
</script>

<script type="text/javascript">
    
    var fileInput = document.querySelector('input[id="document_file"]');
    fileInput.addEventListener('change', changeFile);

    function changeFile(){
        $("#selected_document_file_name").html(fileInput.files[0].name);
    }

</script>
