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

        $position = "";
        $employer_name = "";
        $job_task = "";
        $address = "";
        $total_salary = "";
        $from_date = "";
        $to_date = "";
        if(count($work_experience_items) > 0){
            $position = $work_experience_items[0]['position'];
            $employer_name = $work_experience_items[0]['employer_name'];
            $job_task = $work_experience_items[0]['job_task'];
            $address = $work_experience_items[0]['address'];
            $total_salary = $work_experience_items[0]['total_salary'];
            $from_date = $work_experience_items[0]['from_date'];
            $to_date = $work_experience_items[0]['to_date'];

            $from_date = explode("-", $from_date);
            $from_date = $from_date[2]."/".$from_date[1]."/".$from_date[0];

            $to_date = explode("-", $to_date);
            $to_date = $to_date[2]."/".$to_date[1]."/".$to_date[0];
        }
    ?>
   
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo COMPANY_EMPLOYEE_EMPLOYEE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>clients"><?php echo COMPANY_EMPLOYEE_EMPLOYEE; ?></a></li>
                            <li class="breadcrumb-item active"><?php echo COMPANY_EMPLOYEE_WORK_EXP; ?></li>
                        </ul>                        
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                                             
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                
                <div class="col-lg-12 col-md-12">
                    <div class="card planned_task">
                        <div class="body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="flex-container-custom">
                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_1/<?php echo base64_encode($id); ?>" class="flex-item-custom">1. <br /> <span><?php echo COMPANY_EMPLOYEE_ACCOUNT_DETAILS; ?></span></a>
                                        
                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_2/<?php echo base64_encode($id); ?>" class="flex-item-custom">2. <br /> <span><?php echo COMPANY_EMPLOYEE_POSITIONAL_INFO; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_3/<?php echo base64_encode($id); ?>" class="flex-item-custom">3. <br /> <span><?php echo COMPANY_EMPLOYEE_PERSONAL_INFO; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_4/<?php echo base64_encode($id); ?>" class="flex-item-custom">4. <br /> <span><?php echo COMPANY_EMPLOYEE_EMERGENCY_CONTACT; ?></span></a>
                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_5/<?php echo base64_encode($id); ?>" class="flex-item-custom">5. <br /> <span><?php echo COMPANY_EMPLOYEE_QUALIFICATION; ?></span></a>
                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_6/<?php echo base64_encode($id); ?>" class="flex-item-custom active">6. <br /> <span><?php echo COMPANY_EMPLOYEE_WORK_EXP; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_7/<?php echo base64_encode($id); ?>" class="flex-item-custom">7. <br /> <span><?php echo COMPANY_EMPLOYEE_LEAVE_DETAILS; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_8/<?php echo base64_encode($id); ?>" class="flex-item-custom">8. <br /> <span><?php echo COMPANY_EMPLOYEE_SALARY_DETAILS; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_9/<?php echo base64_encode($id); ?>" class="flex-item-custom">9. <br /> <span><?php echo "Personal Documents"; ?></span></a>
                                        
                                    </div>
                                    <div class="custom-hr"><hr /></div>
                                </div>
                            </div>
                            <form action="<?= base_url('employees/company_employees_create_step_6');?>" id="create-employee" method="post" novalidate>
                            <input type="hidden" name="id" value="<?php echo base64_encode($id); ?>">
                                
                                <div class="row-box">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_POSITION; ?><span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="position[]" value="<?php echo $position; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_POSITION; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYER_NAME; ?><span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="employer_name[]" value="<?php echo $employer_name; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYER_NAME; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_JOB_TASK; ?><span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="job_task[]" value="<?php echo $job_task; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_JOB_TASK; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_ADDRESS; ?><span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="address[]" value="<?php echo $address; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_ADDRESS; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_TOTAL_SALARY; ?><span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="total_salary[]" value="<?php echo $total_salary; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_TOTAL_SALARY; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_FROM_DATE; ?><span class="text-danger">*</span></label>
                                                <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="from_date[]" placeholder="<?php echo COMPANY_EMPLOYEE_FROM_DATE; ?>" autocomplete="off" value="<?php echo $from_date; ?>" readonly required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_TO_DATE; ?><span class="text-danger">*</span></label>
                                                <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="to_date[]" placeholder="<?php echo COMPANY_EMPLOYEE_TO_DATE; ?>" autocomplete="off" value="<?php echo $to_date; ?>" readonly required>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if(!empty($work_experience_items)){
                                    foreach ($work_experience_items as $key => $value) {
                                    if($key > 0){

                                        $from_date = explode("-", $value['from_date']);
                                        $from_date = $from_date[2]."/".$from_date[1]."/".$from_date[0];

                                        $to_date = explode("-", $value['to_date']);
                                        $to_date = $to_date[2]."/".$to_date[1]."/".$to_date[0];
                                    ?>
                                    <div class="row" id="rows_<?php echo $key; ?>">
                                        <div class="col-md-12 text-left">
                                            <hr>
                                            <button type="button" data-row-id="<?php echo $key; ?>" class="btn btn-sm btn-outline-danger delete-btn" title="Delete"><i class="fa fa-trash-o"></i></button><br><br>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_POSITION; ?><span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="position[]" value="<?php echo $value['position']; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_POSITION; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYER_NAME; ?><span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="employer_name[]" value="<?php echo $value['employer_name']; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYER_NAME; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_JOB_TASK; ?><span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="job_task[]" value="<?php echo $value['job_task']; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_JOB_TASK; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_ADDRESS; ?><span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="address[]" value="<?php echo $value['address']; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_ADDRESS; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_TOTAL_SALARY; ?><span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="total_salary[]" value="<?php echo $value['total_salary']; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_TOTAL_SALARY; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_FROM_DATE; ?><span class="text-danger">*</span></label>
                                                <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="from_date[]" placeholder="<?php echo COMPANY_EMPLOYEE_FROM_DATE; ?>" autocomplete="off" value="<?php echo $from_date; ?>" readonly required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_TO_DATE; ?><span class="text-danger">*</span></label>
                                                <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="to_date[]" placeholder="<?php echo COMPANY_EMPLOYEE_TO_DATE; ?>" autocomplete="off" value="<?php echo $to_date; ?>" readonly required>
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
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-success" id="add-more"><?php echo COMPANY_EMPLOYEE_ADD_MORE; ?></button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="float-right">
                                            
                                            <!-- Skip -->
                                            <a href="<?= site_url(); ?>employees/company_employees_create_step_7/<?php echo base64_encode($id); ?>">
                                                <button type="button" name="skip" class="btn btn-default"><?php echo COMPANY_EMPLOYEE_SKIP; ?></button>
                                            </a>
                                            <!-- Previous -->
                                            <a href="<?= site_url(); ?>employees/company_employees_create_step_5/<?php echo base64_encode($id); ?>">
                                                <button type="button" name="previous" class="btn btn-info"><?php echo COMPANY_EMPLOYEE_PREVIOUS; ?></button>
                                            </a>
                                            <!-- Save -->
                                            <button type="submit" name="submit_btn" value="
                                            submit_btn" class="btn btn-success"><?php echo COMPANY_EMPLOYEE_SAVE; ?></button>
                                            <!-- Next -->
                                            <button type="submit" name="next_btn" value="next_btn" class="btn btn-info"><?php echo COMPANY_EMPLOYEE_NEXT; ?></button>
                                            
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
        $('#create-employee').parsley();
        
        $("#nationality").change(function(){
            if(this.value == 'foreigner'){
                $("#passport_row").show();
            }else{
                $("#passport_row").hide();
            }
        });

        $("#social_status").change(function(){
            if(this.value == 'married'){
                $("#number_of_dependent").attr("disabled", false);
            }else{
                $("#number_of_dependent").attr("disabled", true);
            }
        });
        

        var row_id = 2;

        $("#add-more").click(function(){
            $(".row-box").append('<div class="row" id="rows_'+row_id+'"><div class="col-md-12 text-left"><hr><button type="button" data-row-id="'+row_id+'" class="btn btn-sm btn-outline-danger delete-btn" title="Delete"><i class="fa fa-trash-o"></i></button><br><br></div><div class="col-md-4"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_POSITION; ?></label><input type="text" class="form-control" name="position[]" value="" required="" placeholder="<?php echo COMPANY_EMPLOYEE_POSITION; ?>"></div></div><div class="col-md-4"><div class="form-group"><label><?php echo COMPANY_EMPLOYER_NAME; ?></label><input type="text" class="form-control" name="employer_name[]" value="" required="" placeholder="<?php echo COMPANY_EMPLOYER_NAME; ?>"></div></div><div class="col-md-4"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_JOB_TASK; ?></label><input type="text" class="form-control" name="job_task[]" value="" required="" placeholder="<?php echo COMPANY_EMPLOYEE_JOB_TASK; ?>"></div></div><div class="col-md-6"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_ADDRESS; ?></label><input type="text" class="form-control" name="address[]" value="" required="" placeholder="<?php echo COMPANY_EMPLOYEE_ADDRESS; ?>"></div></div><div class="col-md-6"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_TOTAL_SALARY; ?></label><input type="text" class="form-control" name="total_salary[]" value="" required="" placeholder="<?php echo COMPANY_EMPLOYEE_TOTAL_SALARY; ?>"></div></div><div class="col-md-6"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_FROM_DATE; ?></label><input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="from_date[]" placeholder="<?php echo COMPANY_EMPLOYEE_FROM_DATE; ?>" autocomplete="off" value="" readonly required></div></div><div class="col-md-6"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_TO_DATE; ?></label><input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="to_date[]" placeholder="<?php echo COMPANY_EMPLOYEE_TO_DATE; ?>" autocomplete="off" value="" readonly required></div></div></div>');
               
            row_id++;
        });

        $(document).on("click", '.delete-btn', function(e) {
            var row_id = $(this).attr('data-row-id');
            $('#rows_' + row_id).hide("slow", function(){ $(this).remove(); });
        });


    });
</script>