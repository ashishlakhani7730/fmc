<div id="wrapper">

    <?php include("inc/company_navbar.php") ?>

    <?php include("inc/company_sidebar.php") ?>
    
    <style type="text/css">
        .flex-container-custom a.active{
            background-color: #337AB7;
            color: white!important;
            font-weight: bold;
        }
    </style>

    <?php 
        $id = (isset($details) && $details['id']) ? $details['id'] : '';
        
        
        $employee_code = (isset($details) && $details['employee_code'] != "") ? $details['employee_code'] : '';
        $profile_pic = (isset($details) && $details['profile_pic'] != "") ? $details['profile_pic'] : '';

        $joining_date = (isset($details) && $details['joining_date'] != "") ? $details['joining_date'] : '0000-00-00';

        $joining_date = explode("-", $joining_date);
        $joining_date = $joining_date[2]."/".$joining_date[1]."/".$joining_date[0];
        if($joining_date == '00/00/0000'){
            $joining_date = "";
        }

        $attendance_start_date = (isset($details) && $details['attendance_start_date'] != "") ? $details['attendance_start_date'] : '0000-00-00';

        $attendance_start_date = explode("-", $attendance_start_date);
        $attendance_start_date = $attendance_start_date[2]."/".$attendance_start_date[1]."/".$attendance_start_date[0];
        if($attendance_start_date == '00/00/0000'){
            $attendance_start_date = "";
        }  
                   
        $fullname_english = (isset($details) && $details['fullname_english'] != "") ? $details['fullname_english'] : '';
        $fullname_arabic = (isset($details) && $details['fullname_arabic'] != "") ? $details['fullname_arabic'] : '';
        $email = (isset($details) && $details['email'] != "") ? $details['email'] : '';
        $mobile = (isset($details) && $details['mobile'] != "") ? $details['mobile'] : '';
        $password = (isset($details) && $details['password'] != "") ? $details['password'] : '';
        $is_login = (isset($details) && $details['is_login'] != "") ? $details['is_login'] : '';

    ?>
   
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo COMPANY_EMPLOYEE_EMPLOYEE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>employees"><?php echo COMPANY_EMPLOYEE_EMPLOYEE; ?></a></li>
                            <li class="breadcrumb-item active">
                            <?php if(!empty($id)){ ?>
                            <?php echo COMPANY_EMPLOYEE_UPDATE_ACCOUNT; ?>
                            <?php }else{ ?>
                            <?php echo COMPANY_EMPLOYEE_CREATE_ACCOUNT; ?>
                            <?php } ?>
                            </li>
                        </ul>                        
                    </div>    
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                        
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
                    <div class="card planned_task">
                        <div class="body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="flex-container-custom">
                                    <?php if(!empty($id)){ ?>
                                       
                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_1/<?php echo base64_encode($id); ?>" class="flex-item-custom active">1. <br /> <span><?php echo COMPANY_EMPLOYEE_ACCOUNT_DETAILS; ?></span></a>
                                        
                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_2/<?php echo base64_encode($id); ?>" class="flex-item-custom">2. <br /> <span><?php echo COMPANY_EMPLOYEE_POSITIONAL_INFO; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_3/<?php echo base64_encode($id); ?>" class="flex-item-custom">3. <br /> <span><?php echo COMPANY_EMPLOYEE_PERSONAL_INFO; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_4/<?php echo base64_encode($id); ?>" class="flex-item-custom">4. <br /> <span><?php echo COMPANY_EMPLOYEE_EMERGENCY_CONTACT; ?></span></a>
                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_5/<?php echo base64_encode($id); ?>" class="flex-item-custom">5. <br /> <span><?php echo COMPANY_EMPLOYEE_QUALIFICATION; ?></span></a>
                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_6/<?php echo base64_encode($id); ?>" class="flex-item-custom">6. <br /> <span><?php echo COMPANY_EMPLOYEE_WORK_EXP; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_7/<?php echo base64_encode($id); ?>" class="flex-item-custom">7. <br /> <span><?php echo COMPANY_EMPLOYEE_LEAVE_DETAILS; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_8/<?php echo base64_encode($id); ?>" class="flex-item-custom">8. <br /> <span><?php echo COMPANY_EMPLOYEE_SALARY_DETAILS; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_9/<?php echo base64_encode($id); ?>" class="flex-item-custom">9. <br /> <span><?php echo "Personal Documents"; ?></span></a>

                                    <?php }else{ ?>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_1" class="flex-item-custom active">1. <br /> <span><?php echo COMPANY_EMPLOYEE_ACCOUNT_DETAILS; ?></span></a>
                                        
                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_2" class="flex-item-custom">2. <br /> <span>Positional Information</span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_3" class="flex-item-custom">3. <br /> <span><?php echo COMPANY_EMPLOYEE_POSITIONAL_INFO; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_4" class="flex-item-custom">4. <br /> <span><?php echo COMPANY_EMPLOYEE_EMERGENCY_CONTACT; ?></span></a>
                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_5" class="flex-item-custom">5. <br /> <span><?php echo COMPANY_EMPLOYEE_QUALIFICATION; ?></span></a>
                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_6" class="flex-item-custom">6. <br /> <span><?php echo COMPANY_EMPLOYEE_WORK_EXP; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_7" class="flex-item-custom">7. <br /> <span><?php echo COMPANY_EMPLOYEE_LEAVE_DETAILS; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_8" class="flex-item-custom">8. <br /> <span><?php echo COMPANY_EMPLOYEE_SALARY_DETAILS; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_9" class="flex-item-custom">9. <br /> <span><?php echo "Personal Documents"; ?></span></a>

                                    <?php } ?>
                                    </div>
                                    <div class="custom-hr"><hr /></div>
                                </div>
                            </div>
                            <form action="<?= base_url('employees/company_employees_create_step_1');?>" id="create-employee" method="post" novalidate enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo base64_encode($id); ?>">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_PROFILE_PIC; ?><br /><br />
                                            <span class="text-muted"><?php echo COMPANY_EMPLOYEE_PROFILE_PIC_SIZE; ?><br /><?php echo COMPANY_EMPLOYEE_PROFILE_PIC_TYPES; ?> </span>
                                            </label>
                                        </div>
                                    </div>
                                    <?php
                                    if(file_exists("uploads/".$profile_pic)){
                                    ?>
                                    <div class="col-md-2">
                                        <img src="<?= site_url(); ?>/uploads/<?php echo $profile_pic; ?>" alt="" width="100" height="100" />
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="col-md-4">
                                        <label for="profile_pic" style="width: 100%;">
                                            <input type="file" class="dropify" name="profile_pic" id="profile_pic">
                                        </label>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_CODE; ?><span class="text-danger">*</span></label>
                                            <input type="text" class="form-control w-90" name="employee_code" value="<?php echo $employee_code; ?>" required="">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_NAME_ENGLISH; ?><span class="text-danger">*</span></label>
                                            <input type="text" class="form-control w-90" name="fullname_english" value="<?php echo $fullname_english; ?>" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_NAME_ARABIC; ?><span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="fullname_arabic" value="<?php echo $fullname_arabic; ?>"  required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_MOBILE; ?><span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="mobile" value="<?php echo $mobile; ?>" required="">
                                        </div>
                                    </div>
                                </div>
                                   
                                <div class="row">    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_JOINING_DATE; ?><span class="text-danger">*</span></label>
                                            <input class="form-control" id="joining_date" name="joining_date" placeholder="<?php echo COMPANY_EMPLOYEE_JOINING_DATE; ?>" autocomplete="off" value="<?php echo $joining_date; ?>" required readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_ATTENDANCE_START_DATE; ?><span class="text-danger">*</span></label>
                                            <input class="form-control" name="attendance_start_date" id="attendance_start_date" placeholder="<?php echo COMPANY_EMPLOYEE_ATTENDANCE_START_DATE; ?>" autocomplete="off" value="<?php echo $attendance_start_date; ?>" required readonly>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6><?php echo COMPANY_EMPLOYEE_LOGIN_DETAILS; ?></h6>    
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_EMAIL; ?><span class="text-danger">*</span>&nbsp&nbsp&nbsp</label>
                                            <input type="email" class="form-control w-90" name="email" value="<?php echo $email; ?>" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_PASSWORD; ?><span class="text-danger">*</span></label>
                                            <input type="text" class="form-control w-90" id="password" name="password" value="<?php echo $password; ?>" required="">
                                        </div>
                                    </div>
                                </div>
                                <?php if(!empty($id)){ ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" <?php echo ($is_login == 'yes') ? 'checked' : ''; ?> name="is_login" value="yes">
                                                <span><?php echo COMPANY_EMPLOYEE_ENABLE_LOGIN; ?></span>
                                            </label>
                                        </div>
                                    </div>                                    
                                </div>
                                <?php } ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="float-right">
                                            
                                            <!-- Save -->
                                            <button type="submit" name="save_btn" value="
                                            submit_btn" class="btn btn-success"><?php echo COMPANY_EMPLOYEE_SAVE; ?></button>
                                            <!-- Next -->
                                            <button type="submit" name="next_btn" value="
                                                next_btn" class="btn btn-info"><?php echo COMPANY_EMPLOYEE_NEXT; ?></button>

                                        </div>
                                    </div>                                
                                </div>
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

<!-- Dropify -->
<script src="<?= site_url(); ?>assets/vendor/dropify/js/dropify.min.js"></script>

<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
    $(function() {      
        //initialize Form Validation
        $('#create-employee').parsley();
        
        //Drag & Drop
        $('.dropify').dropify();

        $('#joining_date').datepicker({
            format: 'dd/mm/yyyy',
            autoclose : true
        }).on('changeDate', function(e) {
            var joining_date = this.value;
            joining_date = joining_date.split("/");
            joining_date = new Date(+joining_date[2], joining_date[1] - 1, +joining_date[0]);   
            $("#attendance_start_date").val(''); //Blank Expiry Date
            $("#attendance_start_date").datepicker('remove'); //detach
            $('#attendance_start_date').datepicker({
                format: 'dd/mm/yyyy',
                autoclose : true,
                startDate: joining_date
            });
        });
    });
</script>