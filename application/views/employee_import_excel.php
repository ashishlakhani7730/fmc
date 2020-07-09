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
        .attendance-holiday{
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
        .attendance-holiday:focus{
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.5);
        } 
        .attendance-off{
            color: #777;
            background-color: #fff;
            border-color: #eee;
        }
        .attendance-off:focus{
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
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
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo IMPORT_EMPLOYEE_CONFIRM_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active"><?php echo IMPORT_EMPLOYEE_CONFIRM_TITLE; ?></li>
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
                            <form action="<?= base_url('employees/import_excel_save_data');?>" id="add_attendance_form" method="post" novalidate>
                            <div class="table-responsive" style="min-height: 300px;">
                                
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?php echo COMPANY_EMPLOYEE_IMPORT_EMP_CODE; ?></th>
                                            <th><?php echo COMPANY_EMPLOYEE_IMPORT_EMP_FULLNAME_ENG; ?></th>
                                            <th><?php echo COMPANY_EMPLOYEE_IMPORT_EMP_FULLNAME_ARA; ?></th>
                                            <th><?php echo COMPANY_EMPLOYEE_IMPORT_EMP_MOBILE; ?></th>
                                            <th><?php echo COMPANY_EMPLOYEE_IMPORT_EMP_JOINING_DATE; ?></th>
                                            <th><?php echo COMPANY_EMPLOYEE_IMPORT_EMP_ATTENDANCE_START_DATE; ?></th>
                                            <th><?php echo COMPANY_EMPLOYEE_IMPORT_EMP_EMAIL; ?></th>
                                            <th><?php echo COMPANY_EMPLOYEE_IMPORT_EMP_PER_EMAIL; ?></th>
                                            <th><?php echo COMPANY_EMPLOYEE_IMPORT_EMP_PER_MOBILE; ?></th>
                                            <th><?php echo COMPANY_EMPLOYEE_IMPORT_EMP_GENDER; ?></th>
                                            <th><?php echo COMPANY_EMPLOYEE_IMPORT_EMP_BIRTHDATE; ?></th>
                                            <th><?php echo COMPANY_EMPLOYEE_IMPORT_EMP_NOTE; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    if(!empty($employees)){
                                        foreach ($employees as $value) {
                                            $note = "";
                                            $style = "";
                                            if($value['is_employee_code_exist'] == 'yes'){
                                                $style = "bg-danger";
                                                $note .= "Employee code alredy exist"; 
                                            }
                                            if($value['is_employee_email_exist'] == 'yes'){
                                                $style = "bg-danger";
                                                $note .= " Employee email alredy exist"; 
                                            }
                                    ?>    
                                    <?php if($value['is_employee_code_exist'] == 'no' && $value['is_employee_email_exist'] == 'no' ){ ?>
                                    <input type="hidden" name="employee_code[]" value="<?php echo $value['employee_code']; ?>">
                                    <input type="hidden" name="fullname_english[]" value="<?php echo $value['fullname_english']; ?>">
                                    <input type="hidden" name="fullname_arabic[]" value="<?php echo $value['fullname_arabic']; ?>">
                                    <input type="hidden" name="mobile[]" value="<?php echo $value['mobile']; ?>">
                                    <input type="hidden" name="joining_date[]" value="<?php echo $value['joining_date']; ?>">
                                    <input type="hidden" name="attendance_start_date[]" value="<?php echo $value['attendance_start_date']; ?>">
                                    <input type="hidden" name="email[]" value="<?php echo $value['email']; ?>">
                                    <input type="hidden" name="personal_email[]" value="<?php echo $value['personal_email']; ?>">
                                    <input type="hidden" name="gender[]" value="<?php echo $value['gender']; ?>">
                                    <input type="hidden" name="personal_mobile[]" value="<?php echo $value['personal_mobile']; ?>">
                                    <input type="hidden" name="birthdate[]" value="<?php echo $value['birthdate']; ?>">
                                    <?php } ?>
                                    <tr class="<?php echo $style; ?>">
                                        <td><?php echo $value['employee_code']; ?></td>
                                        <td><?php echo $value['fullname_english']; ?></td>
                                        <td><?php echo $value['fullname_arabic']; ?></td>
                                        <td><?php echo $value['mobile']; ?></td>
                                        <td><?php echo $value['joining_date']; ?></td>
                                        <td><?php echo $value['attendance_start_date']; ?></td>
                                        <td><?php echo $value['email']; ?></td>
                                        <td><?php echo $value['personal_email']; ?></td>
                                        <td><?php echo $value['personal_mobile']; ?></td>
                                        <td><?php echo $value['gender']; ?></td>
                                        <td><?php echo $value['birthdate']; ?></td>
                                        <td><?php echo $note; ?></td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div> 
                            <br>
                            <br> 
                            <button type="submit" class="btn btn-success"><?php echo COMPANY_EMPLOYEE_IMPORT_CONFIRM_BTN_TITLE; ?></button>
                            <a href="<?= site_url(); ?>employees" class="btn btn-danger">
                                    <?php echo COMPANY_EMPLOYEE_IMPORT_CAN_BTN_TITLE; ?>
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


    });
</script>