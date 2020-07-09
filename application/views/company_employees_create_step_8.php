<div id="wrapper">

    <?php include("inc/company_navbar.php") ?>

    <?php include("inc/company_sidebar.php") ?>
    
    <style type="text/css">
        .flex-container-custom a.active{
            background-color: #337AB7;
            color: white!important;
            font-weight: bold;
        }

        .salary-preview-inner-table .border_btm{
            border-bottom: 1px solid black;   
        }
        .salary-preview-inner-table .border_right{
            border-right: 1px solid black;   
        }
    </style>

    <?php
    $id = (isset($details) && $details['id']) ? $details['id'] : '';
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
                            <li class="breadcrumb-item active"><?php echo COMPANY_EMPLOYEE_SALARY_DETAILS; ?></li>
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
                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_6/<?php echo base64_encode($id); ?>" class="flex-item-custom">6. <br /> <span><?php echo COMPANY_EMPLOYEE_WORK_EXP; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_7/<?php echo base64_encode($id); ?>" class="flex-item-custom">7. <br /> <span><?php echo COMPANY_EMPLOYEE_LEAVE_DETAILS; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_8/<?php echo base64_encode($id); ?>" class="flex-item-custom active">8. <br /> <span><?php echo COMPANY_EMPLOYEE_SALARY_DETAILS; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_9/<?php echo base64_encode($id); ?>" class="flex-item-custom">9. <br /> <span><?php echo "Personal Documents"; ?></span></a>

                                    </div>
                                    <div class="custom-hr"><hr /></div>
                                </div>
                            </div>
                            <form action="<?= base_url('employees/company_employees_create_step_8');?>" id="create-employee" method="post" novalidate>
                            <input type="hidden" name="id" value="<?php echo base64_encode($id); ?>">
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_ANNUAL_CTC; ?> </label>
                                            <input type="number" class="form-control" name="annual_ctc" id="annual_ctc" value="<?php echo $details['annual_ctc']; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_ANNUAL_CTC; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_MONTHLY; ?> </label><br>
                                            <input type="text" class="form-control" name="monthly_salary" id="monthly_salary" value="<?php echo $details['monthly_salary']; ?>" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>&nbsp</label><br>
                                            <button type="button" name="preview_salary" id="preview_salary_btn" value="
                                            submit_btn" class="btn btn-primary" data-toggle="modal"><?php echo COMPANY_EMPLOYEE_PREVIEW; ?></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <address style="margin: 0px;">
                                            <strong><?php echo COMPANY_EMPLOYEE_EARNING_COMPONENTS; ?></strong> 
                                            <br>
                                            <?php echo COMPANY_EMPLOYEE_EARNING_COMPO_WITH_SALARY; ?><br>
                                        </address>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover js-basic-example dataTable table-custom m-b-0">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">#</th>
                                                        <th width="20%"><?php echo COMPANY_EMPLOYEE_NAME; ?></th>
                                                        <th width="20%"><?php echo COMPANY_EMPLOYEE_COMMON_TYPE; ?></th>
                                                        <th width="20%"><?php echo COMPANY_EMPLOYEE_AMOUNT; ?></th>
                                                        <th width="20%"><?php echo COMPANY_EMPLOYEE_VALUE; ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php

                                                if(!empty($salary_components_earning)){
                                                    foreach ($salary_components_earning as $key => $value) { 

                                                    $salary_component_value = $value['value'];
                                                    $salary_amount = "";

                                                    $checked = "";
                                                    $disabled = "disabled";
                                                    foreach ($employee_salary_components as $sal_compo_value) {
                                                        if($value['id'] == $sal_compo_value['salary_component_id']){
                                                            $checked = "checked";
                                                            $disabled = "";
                                                            $salary_component_value = $sal_compo_value['salary_component_value'];
                                                            $salary_amount = $sal_compo_value['salary_amount'];
                                                        }
                                                    }

                                                ?>
                                                    <tr>
                                                        <td>
                                                            <div class="fancy-checkbox">
                                                                <label><input class="salary_component_id" <?php echo $checked; ?> type="checkbox" data-component-type="<?php echo $value['component_type']; ?>" data-component-name="<?php echo $value['name_in_payslip']; ?>" name="salary_component_id[]" value="<?php echo $value['id']; ?>"><span></span></label>
                                                            </div>
                                                        </td>
                                                        <td><?php echo $value['name'] ?></td>
                                                        <td>
                                                        <?php 
                                                        if($value['component_type'] == "earning"){
                                                            echo'<a style="cursor: pointer;" class="badge badge-success">earning</a>';
                                                        }
                                                        if($value['component_type'] == "deduction"){
                                                            echo'<a style="cursor: pointer;" class="badge badge-success">deduction</a>';
                                                        }
                                                        ?>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input readonly size="1" type="text" class="form-control" name="salary_amount_<?php echo $value['id']; ?>" value="<?php echo $salary_amount; ?>" id="salary_amount_<?php echo $value['id']; ?>">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><?php echo COMPANY_EMPLOYEE_SAR; ?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input data-id="<?php echo $value['id']; ?>" <?php echo $disabled; ?>  type="number" class="form-control calculation_value" name="value_<?php echo $value['id']; ?>" value="<?php echo $salary_component_value; ?>" id="value_<?php echo $value['id']; ?>">

                                                                <!-- calculation_type  -->
                                                                <input type="hidden" value="<?php echo $value['calculation_type']; ?>" name="calculation_type"  id="calculation_type_<?php echo $value['id']; ?>">

                                                                <div class="input-group-append">
                                                                <?php 
                                                                if($value['calculation_type'] == "flat_amount"){
                                                                    echo'<span class="input-group-text">SAR</span>';
                                                                }
                                                                if($value['calculation_type'] == "percentage"){
                                                                    echo'<span class="input-group-text">%</span>';
                                                                }
                                                                ?>
                                                                    
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>                                           
                                                    <?php 
                                                    } 
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <address style="margin: 0px;">
                                            <strong><?php echo COMPANY_EMPLOYEE_DEDUCTION_COMPO; ?></strong> 
                                            <br>
                                            <?php echo COMPANY_EMPLOYEE_DEDUCTION_COMPO_SALARY; ?><br>
                                        </address>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover js-basic-example dataTable table-custom m-b-0">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">#</th>
                                                        <th width="20%"><?php echo COMPANY_EMPLOYEE_NAME; ?></th>
                                                        <th width="20%"><?php echo COMPANY_EMPLOYEE_COMMON_TYPE; ?></th>
                                                        <th width="20%"><?php echo COMPANY_EMPLOYEE_AMOUNT; ?></th>
                                                        <th width="20%"><?php echo COMPANY_EMPLOYEE_VALUE; ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php

                                                if(!empty($salary_components_deduction)){
                                                    foreach ($salary_components_deduction as $key => $value) { 

                                                    $salary_component_value = $value['value'];
                                                    $salary_amount = "";

                                                    $checked = "";
                                                    $disabled = "disabled";
                                                    foreach ($employee_salary_components as $sal_compo_value) {
                                                        if($value['id'] == $sal_compo_value['salary_component_id']){
                                                            $checked = "checked";
                                                            $disabled = "";
                                                            $salary_component_value = $sal_compo_value['salary_component_value'];
                                                            $salary_amount = $sal_compo_value['salary_amount'];
                                                        }
                                                    }

                                                ?>
                                                    <tr>
                                                        <td>
                                                            <div class="fancy-checkbox">
                                                                <label><input class="salary_component_id" <?php echo $checked; ?> type="checkbox" data-component-type="<?php echo $value['component_type']; ?>" data-component-name="<?php echo $value['name_in_payslip']; ?>" name="salary_component_id[]" value="<?php echo $value['id']; ?>"><span></span></label>
                                                            </div>
                                                        </td>
                                                        <td><?php echo $value['name'] ?></td>
                                                        <td>
                                                        <?php 
                                                        if($value['component_type'] == "earning"){
                                                            echo'<a style="cursor: pointer;" class="badge badge-success">earning</a>';
                                                        }
                                                        if($value['component_type'] == "deduction"){
                                                            echo'<a style="cursor: pointer;" class="badge badge-success">deduction</a>';
                                                        }
                                                        ?>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input readonly size="1" type="text" class="form-control" name="salary_amount_<?php echo $value['id']; ?>" value="<?php echo $salary_amount; ?>" id="salary_amount_<?php echo $value['id']; ?>">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">SAR</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input data-id="<?php echo $value['id']; ?>" <?php echo $disabled; ?> size="1" type="number" class="form-control calculation_value" name="value_<?php echo $value['id']; ?>" value="<?php echo $salary_component_value; ?>" id="value_<?php echo $value['id']; ?>">

                                                                <!-- calculation_type  -->
                                                                <input type="hidden" value="<?php echo $value['calculation_type']; ?>" name="calculation_type"  id="calculation_type_<?php echo $value['id']; ?>">

                                                                <div class="input-group-append">
                                                                <?php 
                                                                if($value['calculation_type'] == "flat_amount"){
                                                                    echo'<span class="input-group-text">SAR</span>';
                                                                }
                                                                if($value['calculation_type'] == "percentage"){
                                                                    echo'<span class="input-group-text">%</span>';
                                                                }
                                                                ?>
                                                                    
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>                                           
                                                    <?php 
                                                    } 
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="float-right">                   
                                            <!-- Skip -->
                                            <a href="<?= site_url(); ?>employees/company_employees_create_step_9/<?php echo base64_encode($id); ?>">
                                                <button type="button" name="skip" class="btn btn-default"><?php echo COMPANY_EMPLOYEE_SKIP; ?></button>
                                            </a>
                                            <!-- Previous -->
                                            <a href="<?= site_url(); ?>employees/company_employees_create_step_7/<?php echo base64_encode($id); ?>">
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


<!-- Return Item -->
<div class="modal animated jello" id="preview_salary" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel"><?php echo COMPANY_EMPLOYEE_SALARY_SLEEP; ?></h4>
            </div>           
            <div class="modal-body">
                <table class="salary-preview-inner-table" border="1" width="100%" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td width="50%" align="center"><h6 style="margin: 5px 5px;"><?php echo COMPANY_EMPLOYEE_EARNINGS; ?></h6></td>
                            <td width="50%" align="center"><h6 style="margin: 5px 5px;"><?php echo COMPANY_EMPLOYEE_DEDUCTION; ?></h6></td>
                        </tr>
                        <tr class="border_btm">
                            <td valign="top">
                                <table class="salary-preview-inner-table" border="0" width="100%" id="earning-table">

                                </table>
                            </td>
                            <td valign="top">
                                <table class="salary-preview-inner-table" border="0" width="100%" id="deduction-table">         

                                </table>
                            </td>
                        </tr>
                        <tr class="border_btm">
                            <td valign="top">
                                <table class="salary-preview-inner-table" border="0" width="100%">
                                <tr>
                                    <td width="70%" class="border_right"><?php echo COMPANY_EMPLOYEE_TOTAL_EARNING; ?></td>
                                    <td width="30%" id="total_earning_value"></td>
                                </tr>
                                </table>
                            </td>
                            <td valign="top">
                                <table class="salary-preview-inner-table" border="0" width="100%">
                                    <tr>
                                        <td width="70%" class="border_right"><?php echo COMPANY_EMPLOYEE_TOTAL_DEDUCTION; ?></td>
                                        <td width="30%" id="total_deduction_value"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="border_btm">
                            <td valign="top">
                                <table class="salary-preview-inner-table" border="0" width="100%">
                                <tr>
                                    <td width="70%" class="border_right"><?php echo COMPANY_EMPLOYEE_NET_BALANCE; ?></td>
                                    <td width="30%" id="net_balance_value"></td>
                                </tr>
                                </table>
                            </td>
                            <td valign="top">
                                <table class="salary-preview-inner-table" border="0" width="100%">
                                    <tr><td>&nbsp</td></tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo COMPANY_EMPLOYEE_CLOSE; ?></button>
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

<!-- Toaster --> 
<script src="<?= site_url(); ?>assets/vendor/toastr/toastr.js"></script> 

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
    $(function() {      
        //initialize Form Validation
        $('#create-employee').parsley();

        $(".salary_component_id").change(function(){
            if($(this).is(":checked")){
                if($("#annual_ctc").val() != "" && $("#annual_ctc").val() > 0){

                    $("#value_"+this.value).attr("disabled", false);

                    var annual_ctc = $("#annual_ctc").val();
                    var monthly_salary = annual_ctc / 12;
                    var calculation_type = $("#calculation_type_"+this.value).val();
                    var calculation_value = $("#value_"+this.value).val();
                    if(calculation_value == ""){
                        calculation_value = 0;
                    }

                    var salary_amount = 0;
                    if(calculation_type == 'percentage'){
                        salary_amount = (monthly_salary * calculation_value) / 100;
                    }else{
                        salary_amount = calculation_value;
                    }    
                    salary_amount = parseFloat(salary_amount);
                    $("#salary_amount_"+this.value).val(salary_amount.toFixed(2));                
                    monthly_salary = parseFloat(monthly_salary);
                    $("#monthly_salary").val(monthly_salary.toFixed(2));  

                }else{
                    $(this).prop('checked', false);
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = 'toast-bottom-right';    
                    toastr['error']('Anual CTC should not blank.');                  
                }                
            }else{

                $("#value_"+this.value).attr("disabled", true);

            }
        });

        $("#annual_ctc").keyup(function(){
            if(this.value == 0 || this.value < 0){
                window.location.reload();
            }

            $(".salary_component_id:checked").each(function(){
                var row_id = this.value;

                var annual_ctc = $("#annual_ctc").val();
                var monthly_salary = annual_ctc / 12;
                var calculation_type = $("#calculation_type_"+row_id).val();
                var calculation_value = $("#value_"+row_id).val();
                if(calculation_value == ""){
                    calculation_value = 0;
                }
                var salary_amount = 0;
                if(calculation_type == 'percentage'){
                    salary_amount = (monthly_salary * calculation_value) / 100;
                }else{
                    salary_amount = calculation_value;
                }    
                
                salary_amount = parseFloat(salary_amount);
                $("#salary_amount_"+row_id).val(salary_amount.toFixed(2));  

                monthly_salary = parseFloat(monthly_salary);
                $("#monthly_salary").val(monthly_salary.toFixed(2));  

            });

        });

        $(".calculation_value").keyup(function(){
            var row_id = $(this).attr("data-id");

            var annual_ctc = $("#annual_ctc").val();
            var monthly_salary = annual_ctc / 12;
            var calculation_type = $("#calculation_type_"+row_id).val();
            var calculation_value = $("#value_"+row_id).val();
            if(calculation_value == ""){
                calculation_value = 0;
            }
            var salary_amount = 0;
            if(calculation_type == 'percentage'){
                salary_amount = (monthly_salary * calculation_value) / 100;
            }else{
                salary_amount = calculation_value;
            }    
            
            salary_amount = parseFloat(salary_amount);
            $("#salary_amount_"+row_id).val(salary_amount.toFixed(2));  

            monthly_salary = parseFloat(monthly_salary);
            $("#monthly_salary").val(monthly_salary.toFixed(2));  
                        
        });

        $("#preview_salary_btn").click(function(){

            var total_earning = 0;
            var total_deduction = 0;
            var net_balance = 0;

            var earning_html = "";
            var deduction_html = "";

            $(".salary_component_id:checked").each(function(){
                var component_type = $(this).attr('data-component-type');
                var component_name = $(this).attr('data-component-name');

                var row_id = $(this).val();
                var component_amount = $("#salary_amount_"+row_id).val();
                component_amount = parseFloat(component_amount);
                

                if(component_type == "earning"){
                    total_earning = total_earning + component_amount;
                    earning_html += "<tr class='border_btm'><td width='70%' class='border_right'>"+component_name+"</td><td width='30%'>"+component_amount+"</td></tr>";
                }

                if(component_type == "deduction"){
                    total_deduction = total_deduction + component_amount;
                    deduction_html += "<tr class='border_btm'><td class='border_right' width='70%'>"+component_name+"</td><td width='30%'>"+component_amount+"</td></tr>";
                }                
            });

            $("#earning-table").html(earning_html);
            $("#deduction-table").html(deduction_html);

            var net_balance = total_earning - total_deduction;
            
            net_balance = parseFloat(net_balance);

            $("#total_earning_value").html(total_earning);
            $("#total_deduction_value").html(total_deduction);
            $("#net_balance_value").html(net_balance.toFixed(2));

            $("#preview_salary").modal("show");
        });

    });
</script>

