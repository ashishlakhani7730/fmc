<div id="wrapper">

    <?php include("inc/company_navbar.php") ?>

    <?php include("inc/company_sidebar.php") ?> 

    <style type="text/css">
        .multiselect-container {
            width: 100% !important;
        }
        .input-group-addon {
            padding: 6px 12px;
            font-size: 14px;
            font-weight: 400;
            line-height: 1;
            color: #555;
            text-align: center;
            background-color: #eee;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .multiselect{
            text-align: left;
        }
        .salary-preview-inner-table .border_btm{
            border-bottom: 1px solid black;   
        }
        .salary-preview-inner-table .border_right{
            border-right: 1px solid black;   
        }
    </style>
    <link rel="stylesheet" href="<?= site_url(); ?>assets/css/bootstrap-multiselect.css">
    

    <div id="main-content">
    	<div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo PAYROLL_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>

                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>payroll/create"><?php echo PAYROLL_CREATE; ?></a></li>                                                       
                            <li class="breadcrumb-item active">Confirm</li>
                        </ul>
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                                             
                    </div>
                </div>
            </div>
            <?php
                if($this->session->flashdata('flashError'))
                {
                    echo '<div class="row"><div class="col-lg-12"><div class="alert alert-warning login-alert has-error">'.$this->session->flashdata('flashError').'</div></div></div>';
                }
                if($this->session->flashdata('flashSuccess'))
                {
                    echo '<div class="row"><div class="col-lg-12"><div class="alert alert-success login-alert has-error">'.$this->session->flashdata('flashSuccess').'</div></div></div>';
                }
            ?>
            <?php
            $is_all_confirmed = 'yes';
            foreach ($employees_payroll as $payroll_value) {
                $employee_id = $payroll_value['employee_id'];
                $total_earning_value = 0;
                $total_deduction_value = 0;
                if($payroll_value['status'] == 'confirmed'){
                    $is_disable = 'disabled';
                }else{
                    $is_disable = '';                    
                    $is_all_confirmed = "no";
                }
            ?>
            <div class="row clearfix" id="employee-<?php echo $employee_id; ?>">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-11"><b>Employee Name:</b> <?php echo $payroll_value['fullname_english']; ?></div>
                                <div class="col-lg-1" style="text-align: right;color: green;font-size: 20px;">
                                    <?php if($payroll_value['status'] == 'confirmed'){ ?>
                                    <i class="fa fa-check-circle"></i>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-12"><b>Employee Monthly Salary:</b> <?php echo $payroll_value['monthly_salary']; ?></div>
                                <div class="col-lg-12"><b>Month:</b> <?php echo $details['month']."-".$details['year']; ?></div>
                            </div>                
                            <br>
                            <table class="salary-preview-inner-table" border="1" width="100%" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td width="50%" align="center"><h6 style="margin: 5px 5px;">Earnings</h6></td>
                                        <td width="50%" align="center"><h6 style="margin: 5px 5px;">Deductions</h6></td>
                                    </tr>
                                    <tr class="border_btm">
                                        <td valign="top">
                                            <table class="salary-preview-inner-table" border="0" width="100%" id="earning-table">
                                                <?php 
                                                foreach ($payroll_value['components'] as $comp_value) { 
                                                    if($comp_value['salary_component_type'] == 'earning'){
                                                        $total_earning_value = $total_earning_value + $comp_value['salary_component_amount'];
                                                ?>
                                                    <tr class="border_btm">
                                                        <td width="70%" class="border_right"><?php echo $comp_value['salary_component_title']; ?></td>
                                                        <td width="30%">
                                                            <input <?php echo $is_disable; ?> data-employee-id="<?php echo $employee_id; ?>" data-component-id="<?php echo $comp_value['id']; ?>" class="earning" type="number" value="<?php echo $comp_value['salary_component_amount']; ?>">
                                                        </td>
                                                    </tr>    
                                                <?php 
                                                    }
                                                } 
                                                ?>          
                                            </table>
                                        </td>
                                        <td valign="top">
                                            <table class="salary-preview-inner-table" border="0" width="100%" id="deduction-table">
                                                <?php 
                                                foreach ($payroll_value['components'] as $comp_value) { 
                                                    if($comp_value['salary_component_type'] == 'deduction'){
                                                        $total_deduction_value = $total_deduction_value + $comp_value['salary_component_amount'];
                                                ?>
                                                    <tr class="border_btm">
                                                        <td width="70%" class="border_right"><?php echo $comp_value['salary_component_title']; ?></td>
                                                        <td width="30%">
                                                            <input <?php echo $is_disable; ?> data-employee-id="<?php echo $employee_id; ?>" class="deduction" type="number" data-component-id="<?php echo $comp_value['id']; ?>" value="<?php echo $comp_value['salary_component_amount']; ?>">
                                                        </td>
                                                    </tr>    
                                                <?php 
                                                    }
                                                } 
                                                ?>  
                                            </table>
                                        </td>
                                    </tr>
                                    <tr class="border_btm">
                                        <td valign="top">
                                            <table class="salary-preview-inner-table" border="0" width="100%">
                                            <tbody><tr>
                                                <td width="70%" class="border_right">Total Earning</td>
                                                <td width="30%" id="total_earning_value">
                                                    <input <?php echo $is_disable; ?> readonly type="number" name="total_earning_value" value="<?php echo $total_earning_value; ?>">
                                                </td>
                                            </tr>
                                            </tbody></table>
                                        </td>
                                        <td valign="top">
                                            <table class="salary-preview-inner-table" border="0" width="100%">
                                                <tbody><tr>
                                                    <td width="70%" class="border_right">Total Deduction</td>
                                                    <td width="30%">
                                                        <input <?php echo $is_disable; ?> readonly type="number" name="total_deduction_value" value="<?php echo $total_deduction_value; ?>">
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        </td>
                                    </tr>
                                    <tr class="border_btm">
                                        <td valign="top">
                                            <table class="salary-preview-inner-table" border="0" width="100%">
                                            <tbody><tr>
                                                <td width="70%" class="border_right">Net Balance</td>
                                                <td width="30%" id="net_balance_value">
                                                    <input <?php echo $is_disable; ?> readonly type="number" name="final_salary" value="<?php echo ($total_earning_value-$total_deduction_value); ?>">
                                                </td>
                                            </tr>
                                            </tbody></table>
                                        </td>
                                        <td valign="top">
                                            <table class="salary-preview-inner-table" border="0" width="100%">
                                                <tbody><tr><td>&nbsp;</td></tr>
                                            </tbody></table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>    
                            <br>
                            <?php if($payroll_value['status'] == 'draft'){ ?>
                            <button type="button" data-employee-payroll-id="<?php echo $payroll_value['id']; ?>" data-employee-id="<?php echo $employee_id; ?>" class="btn btn-success confirm-salary">Confirm</button>           
                            <?php } ?>           
                        </div>
                    </div>
                </div>
            </div>
            <?php  
            }            
            ?>

            <?php if(isset($request_details)){ ?>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card planned_task">
                        <div class="header">
                            <h2>Request Timeline</h2>
                        </div>
                        <div class="body">
                            <?php 
                            foreach($request_threads as $value){
                                $color = 'blue';
                                if($value['status'] == 'created'){
                                    $color = 'blue';
                                }
                                if($value['status'] == 'in_approval'){
                                    $color = 'blue';
                                }
                                if($value['status'] == 'declined'){
                                    $color = 'warning';
                                }
                                if($value['status'] == 'approved'){
                                    $color = 'green';
                                }
                            ?>
                            <div class="timeline-item animated fadeIn faster <?php echo $color; ?>">
                                <span class="date"><?php echo date('d-m-Y',strtotime($value['created_at'])); ?></span>
                                <span><?php echo $value['log_text']; ?></span>
                                <div class="msg">
                                    <p><?php echo $value['note']; ?></p>
                                </div>                                
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div> 
                </div>
            </div>   
            
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card planned_task">
                        <div class="header">
                            <h2>Request Comments</h2>
                        </div>
                        <div class="body">
                            <ul class="comment-reply list-unstyled">
                                <?php foreach ($request_details['request_comments'] as $comment) {
                                ?>                                    
                                <li class="row clearfix" style="margin-left: 0px;">
                                    <div class="text-box col-md-10 col-8 p-l-0 p-r0">
                                        <h5 class="m-b-0"><?php echo $comment['comment_by']; ?></h5>
                                        <p><?php echo $comment['description']; ?></p>
                                        <ul class="list-inline">
                                            <?php foreach ($comment['documents'] as $document) { ?>
                                            <li>
                                                <a download="<?php echo $document['document_file']; ?>" href="<?= site_url(); ?>uploads/<?php echo $document['document_file']; ?>">Download</a>
                                            </li>
                                            <?php 
                                            } ?>
                                        </ul>
                                        <ul class="list-inline">
                                            <li><?php echo date('d M Y',strtotime($comment['created_at'])); ?></li>
                                        </ul>
                                    </div>                                  
                                </li>
                                <hr>
                                <?php } ?>
                            </ul> 
                            <?php if($details['status'] == 'in_approval'){ ?>
                            <h6>Leave a comment</h6>
                            <div class="comment-form">
                                <form class="row clearfix" action="<?= base_url('requests/create_request_comment');?>" id="create-comment-form" method="post" novalidate>
                                <input type="hidden" name="request_id" id="request_id" value="<?php echo $request_details['id']; ?>">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea required rows="4" name="description" id="description" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                                        </div>
                                    </div>  
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">    
                                            <label for="documents" class="dragndrop">
                                                <img src="<?= site_url(); ?>assets/images/upload.png" alt="" /><br />
                                                Select document & image files here<br />
                                                size : 200 x 200 px <br />
                                                PDF.DOC.DOCX.PNG.JPG.JPEG </br>
                                                <a style="cursor: pointer;" class="btn btn-sm btn-outline-primary">Browse Files</a>
                                                <input type="file" name="documents" id="documents" multiple style="display: none;">
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" col-md-12 col-sm-12">
                                        <div class="row clearfix file_manager" id="item-documents-list" style="padding-right: 15px;padding-left: 15px;">
                                        
                                        </div>                              
                                    </div>
                                    <div class=" col-md-12 col-sm-12">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>  
                            <?php } ?>    
                        </div>
                    </div>
                </div>
            </div>
            
            <?php } ?> 

            <?php if($is_all_confirmed == 'yes' && $details['status'] == 'draft'){ ?>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">                        
                        <div class="header">
                            <h2>Send For Approval</h2>
                        </div>
                        <div class="body">
                            <form action="<?= base_url('payroll/send_for_approval');?>" id="send-for-approval" method="post" novalidate>
                                <input type="hidden" name="id" value="<?php echo base64_encode($details['id']); ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Verifier:</label>
                                            <select name="assigned_fmc_user_id" class="form-control show-tick ms select2" data-placeholder="Select Legal entity" required>
                                                <option value="">Select Verifier</option>  
                                                <?php
                                                if(!empty($fmc_users)){
                                                    foreach ($fmc_users as $key => $value) { 
                                                ?>
                                                        <option value="<?php echo $value['id']; ?>">
                                                            <?php echo $value['first_name']." ".$value['last_name']." ".$value['surname']."(".$value['fmc_employee_id'].")"; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Note:</label>
                                            <textarea class="form-control" name="note" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="float-left">
                                            <button type="submit" class="btn btn-success">Send For Approval</button>
                                            <a href="<?= site_url(); ?>payroll">
                                                <button type="button" class="btn btn-danger"><?php echo PAYROLL_CANCEL; ?></button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>


            <?php if($is_all_confirmed == 'yes' && $details['status'] == 'declined'){ ?>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">                        
                        <div class="header">
                            <h2>Send For Approval</h2>
                        </div>
                        <div class="body">
                            <form action="<?= base_url('payroll/send_for_reapproval');?>" id="send-for-approval" method="post" novalidate>
                                <input type="hidden" name="id" value="<?php echo base64_encode($details['id']); ?>">
                                <input type="hidden" name="request_id" id="request_id" value="<?php echo base64_encode($request_details['id']); ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Verifier:</label>
                                            <select name="assigned_fmc_user_id" class="form-control show-tick ms select2" data-placeholder="Select Legal entity" required>
                                                <option value="">Select Verifier</option>  
                                                <?php
                                                if(!empty($fmc_users)){
                                                    foreach ($fmc_users as $key => $value) { 
                                                ?>
                                                        <option value="<?php echo $value['id']; ?>">
                                                            <?php echo $value['first_name']." ".$value['last_name']." ".$value['surname']."(".$value['fmc_employee_id'].")"; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Note:</label>
                                            <textarea class="form-control" name="note" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="float-left">
                                            <button type="submit" class="btn btn-success">Send For Approval</button>
                                            <a href="<?= site_url(); ?>payroll">
                                                <button type="button" class="btn btn-danger"><?php echo PAYROLL_CANCEL; ?></button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>



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
<script src="<?= site_url(); ?>assets/js/bootstrap-multiselect.js"></script>

<!-- Form Validation -->
<script src="<?= site_url(); ?>assets/vendor/parsleyjs/js/parsley.min.js"></script>

<!-- Date-Picker Time-Picker -->
<script src="<?= site_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<!-- Ckeditor --> 
<script src="<?= site_url(); ?>assets/vendor/ckeditor/ckeditor.js"></script> 

<!--moment js-->
<script src="<?= site_url(); ?>assets/js/moment.js"></script> 

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
    $(function() {
        
        $('#send-for-approval').parsley();       

        $(".confirm-salary").click(function() {
            var employee_id  = "#employee-"+$(this).attr("data-employee-id");
            var employees_payroll_id  = $(this).attr("data-employee-payroll-id");

            var components_arr = [];
            $(employee_id+" input.earning").each(function(){
                components_arr.push({
                    component_id : $(this).attr("data-component-id"),
                    component_value : this.value
                });
            });
            $(employee_id+" input.deduction").each(function(){
                components_arr.push({
                    component_id : $(this).attr("data-component-id"),
                    component_value : this.value
                });
            });

            var total_earning_value = $(employee_id+" input[name='total_earning_value']").val();
            var total_deduction_value = $(employee_id+" input[name='total_deduction_value']").val();
            var final_salary = $(employee_id+" input[name='final_salary']").val();
            
            
            $.ajax({
                url: "<?= site_url('payroll/confirm_employee_payroll'); ?>",
                type: 'post',
                data: {
                    'components' : components_arr,
                    'employees_payroll_id' : employees_payroll_id,
                    'total_earning_value' : total_earning_value,
                    'total_deduction_value' : total_deduction_value,
                    'final_salary' : final_salary
                },
                success: function (data) {
                   window.location.href = "<?= site_url('payroll/confirm/'.base64_encode($details['id'])); ?>";
                },
                error: function () {
                    window.location.href = "<?= site_url('payroll/confirm/'.base64_encode($details['id'])); ?>"; 
                }
            }); 
        });

        $(".earning").keyup(function() {
            var employee_id  = "#employee-"+$(this).attr("data-employee-id");
            
            var total_earning_value = 0;
            $(employee_id+" input.earning").each(function(){
                total_earning_value = total_earning_value + parseFloat(this.value);
            });
            var total_deduction_value = 0;
            $(employee_id+" input.deduction").each(function(){
                total_deduction_value += parseFloat(this.value);
            });
            total_earning_value = total_earning_value.toFixed(2);
            total_deduction_value = total_deduction_value.toFixed(2);
            final_salary = total_earning_value-total_deduction_value;
            final_salary = final_salary.toFixed(2);

            $(employee_id+" input[name='total_earning_value']").val(total_earning_value);
            $(employee_id+" input[name='total_deduction_value']").val(total_deduction_value);
            $(employee_id+" input[name='final_salary']").val(final_salary);

        });
        $(".deduction").keyup(function() {
            var employee_id  = "#employee-"+$(this).attr("data-employee-id");
            
            var total_earning_value = 0;
            $(employee_id+" input.earning").each(function(){
                total_earning_value = total_earning_value + parseFloat(this.value);
            });
            var total_deduction_value = 0;
            $(employee_id+" input.deduction").each(function(){
                total_deduction_value += parseFloat(this.value);
            });
            total_earning_value = total_earning_value.toFixed(2);
            total_deduction_value = total_deduction_value.toFixed(2);
            final_salary = total_earning_value-total_deduction_value;
            final_salary = final_salary.toFixed(2);

            $(employee_id+" input[name='total_earning_value']").val(total_earning_value);
            $(employee_id+" input[name='total_deduction_value']").val(total_deduction_value);
            $(employee_id+" input[name='final_salary']").val(final_salary);

        });
    });
</script>
<script type="text/javascript">
    $(function() {      
        var form_instance = $('#create-comment-form').parsley();        
    }); 
</script>

<script type="text/javascript">
    
    var fileList = [];
    var fileInput = document.querySelector('input[name="documents"]');

    fileInput.addEventListener('change', setList);
    document.querySelector('#create-comment-form').addEventListener('submit', sendModifiesList);
    
    function setList() {
        //Convert the FileList Object to an Array of File Objects
        fileList = fileList.concat(Array.from(fileInput.files));

        outputList();
    }

    function outputList() {
        var output = document.getElementById('item-documents-list');        
        
        var file_list_doc = "";

        fileList.forEach((file, i) => {
            
            var file_type_icon = getFontAwesomeIconFromMIME(file.type);
            var lastModified = moment(file.lastModified).format('MMM D , YYYY');

            file_list_doc += '<div class="col-lg-3 col-md-4 col-sm-12">';
                file_list_doc += '<div class="card">';
                    file_list_doc += '<div class="file">';
                        file_list_doc += '<a href="javascript:void(0);">';
                            file_list_doc += '<div class="hover">';
                                file_list_doc += '<button onclick="remove_file('+i+')" type="button" class="btn btn-icon btn-danger">';
                                    file_list_doc += '<i class="fa fa-trash"></i>';
                                file_list_doc += '</button>';
                            file_list_doc += '</div>';
                            file_list_doc += '<div class="icon">';
                                file_list_doc += '<i class="fa '+file_type_icon+'"></i>';
                            file_list_doc += '</div>';
                            file_list_doc += '<div class="file-name">';
                                file_list_doc += '<p class="m-b-5 text-muted">'+file.name+'</p>';
                                file_list_doc += '<small>Size: '+file.size+'KB <span class="date text-muted">'+lastModified+'</span></small>';
                            file_list_doc += '</div>';

                        file_list_doc += '</a>';
                    file_list_doc += '</div>';
                file_list_doc += '</div>';
            file_list_doc += '</div>';

            
        });

        output.innerHTML = '';
        output.innerHTML = file_list_doc;
    }  

    function sendModifiesList(e) {
        var form_instance = $('#create-comment-form').parsley();        
        console.log(form_instance.isValid());
        if(form_instance.isValid()){        
            e.preventDefault();
            var formData = new FormData();

            fileList.forEach(function(file) {
              formData.append('documents[]', file);
            });  

            formData.append("description",$('#description').val());            
            formData.append("request_id",$('#request_id').val());            

            let url = document.forms[0].action;
            let request = new XMLHttpRequest();

            request.open("POST", url);

            //response
            request.onload = function() {
                window.location.href = "<?= site_url('payroll/confirm/'.base64_encode($details['id'])); ?>";
            };

            request.send(formData);
        }else{
            return false;
        }
    }

    function remove_file(i){
        fileList.splice(i, 1);
        outputList();
    }
</script>