<div id="wrapper">

    <?php include("inc/company_employee_navbar.php") ?>

    <?php include("inc/company_employee_sidebar.php") ?>

    <?php
    //Emergency Contacts
    $contact_name = "";
    $address = "";
    $relationship = "";
    $mobile = "";
    if(count($emergency_contacts) > 0){
        $contact_name = $emergency_contacts[0]['contact_name'];
        $address = $emergency_contacts[0]['address'];
        $relationship = $emergency_contacts[0]['relationship'];
        $mobile = $emergency_contacts[0]['mobile'];
    }
    ?>

    <div id="main-content">        
        <div class="container-fluid">
            <form action="<?= base_url('myprofile/emergency_contacts');?>" id="create-employee" method="post" novalidate enctype="multipart/form-data">
                
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-sm-12">
                            <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Emergency Contacts</h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                                <li class="breadcrumb-item active">Emergency Contacts</li>
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
                        <div class="card planned_task">                        
                            <div class="body">
                                <div class="emergencey-contact-row-box">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_CONTACT_NAME; ?></label>
                                                <input type="text" class="form-control" name="contact_name[]" value="<?php echo $contact_name; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_CONTACT_NAME; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_ADDRESS; ?></label>
                                                <input type="text" class="form-control" name="address[]" value="<?php echo $address; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_ADDRESS; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_RELATIONSHIP; ?></label>
                                                <input type="text" class="form-control" name="relationship[]" value="<?php echo $relationship; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_RELATIONSHIP; ?>">
                                            </div>
                                        </div>                                   
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_MOBILE; ?></label>
                                                <input type="number" class="form-control" name="mobile[]" value="<?php echo $mobile; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_MOBILE; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if(!empty($emergency_contacts)){
                                    foreach ($emergency_contacts as $key => $value) {
                                    if($key > 0){
                                    ?>
                                    <div class="row" id="emergency_contacts_rows_<?php echo $key; ?>">
                                        <div class="col-md-12 text-left">
                                            <hr>
                                            <button type="button" data-row-id="<?php echo $key; ?>" class="btn btn-sm btn-outline-danger delete-btn" title="Delete"><i class="fa fa-trash-o"></i></button><br><br>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_CONTACT_NAME; ?></label>
                                                <input type="text" class="form-control" name="contact_name[]" value="<?php echo $value['contact_name']; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_CONTACT_NAME; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_ADDRESS; ?></label>
                                                <input type="text" class="form-control" name="address[]" value="<?php echo $value['address']; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_ADDRESS; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_RELATIONSHIP; ?></label>
                                                <input type="text" class="form-control" name="relationship[]" value="<?php echo $value['relationship']; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_RELATIONSHIP; ?>">
                                            </div>
                                        </div>                                   
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_MOBILE; ?></label>
                                                <input type="number" class="form-control" name="mobile[]" value="<?php echo $value['mobile']; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_MOBILE; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <?php      
                                    }                                      
                                    }
                                    }
                                    ?>
                                </div>
                                                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-success" id="add-more"><?php echo COMPANY_EMPLOYEE_ADD_MORE; ?></button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" name="submit" value="submit" class="btn btn-info">Save & Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br>
                <br>
            </form>
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

<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 

<!-- Ckeditor --> 
<script src="<?= site_url(); ?>assets/vendor/ckeditor/ckeditor.js"></script> 


<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script>

<script type="text/javascript">
    var row_id = 2;
        <?php 
        if(count($emergency_contacts) > 0){
        ?>
        row_id = <?php echo count($emergency_contacts); ?>;
        <?php } ?>

        $("#add-more").click(function(){
            $(".emergencey-contact-row-box").append('<div class="row" id="emergency_contacts_rows_'+row_id+'"><div class="col-md-12 text-left"><hr><button type="button" data-row-id="'+row_id+'" class="btn btn-sm btn-outline-danger delete-btn" title="Delete"><i class="fa fa-trash-o"></i></button><br><br></div><div class="col-md-6"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_CONTACT_NAME; ?></label><input type="text" class="form-control" name="contact_name[]" value="" placeholder="<?php echo COMPANY_EMPLOYEE_CONTACT_NAME; ?>"></div></div><div class="col-md-6"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_ADDRESS; ?></label><input type="text" class="form-control" name="address[]" value="" placeholder="<?php echo COMPANY_EMPLOYEE_ADDRESS; ?>"></div></div><div class="col-md-6"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_RELATIONSHIP; ?></label><input type="text" class="form-control" name="relationship[]" value="" placeholder="<?php echo COMPANY_EMPLOYEE_RELATIONSHIP; ?>"></div></div><div class="col-md-6"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_MOBILE; ?></label><input type="number" class="form-control" name="mobile[]" value="" placeholder="<?php echo COMPANY_EMPLOYEE_MOBILE; ?>"></div></div></div>');
            row_id++;
        });

        $(document).on("click", '.delete-btn', function(e) {
            var row_id = $(this).attr('data-row-id');
            $('#emergency_contacts_rows_' + row_id).hide("slow", function(){ $(this).remove(); });
        });
</script>