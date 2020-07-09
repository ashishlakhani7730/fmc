<div id="wrapper">

    <?php include("inc/navbar.php") ?>

    <?php include("inc/sidebar.php") ?>
 
    <?php
        $id = (isset($details) && $details['id']) ? $details['id'] : '';
    ?>
    <style type="text/css">
        .card-panel-body{
            display: none;
        }
    </style>
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Requests</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>requests">Requests</a></li>
                            <li class="breadcrumb-item active">Payroll Request Details</li>
                        </ul>
                        
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                                             
                    </div>
                </div>
            </div>

            <?php
            $is_all_confirmed = 'yes';
            foreach ($employees_payroll as $payroll_value) {
                $employee_id = $payroll_value['employee_id'];
                $total_earning_value = 0;
                $total_deduction_value = 0;
                $is_disable = 'disabled';
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
                        </div>
                    </div>
                </div>
            </div>
            <?php  
            }            
            ?>

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
                    
                                    
                    <div class="card planned_task file_manager">
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
                                            <li><?php echo date('d M Y h:i A',strtotime($comment['created_at'])); ?></li>
                                        </ul>
                                    </div>                                  
                                </li>
                                <hr>
                                <?php } ?>
                            </ul> 
                            <?php if($request_details['status'] == 'in_approval'){ ?>
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
                                <span class="date"><?php echo date('d-m-Y h:i A',strtotime($value['created_at'])); ?></span>
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
                    

                    <?php if($request_details['status'] == 'in_approval'){ ?>
                    <form action="<?= base_url('requests/approve_decline_payroll_confirm_request');?>" id="request-details-form" method="post" novalidate>
                        <input type="hidden" name="request_id" value="<?php echo base64_encode($request_details['id']); ?>">
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="body">
                                        <div class="row clearfix">
                                            <div class="form-group col-lg-12 col-md-6">
                                                <label>Approve/Decline Notes</label>
                                                <textarea class="form-control" name="description" placeholder="Approve/Decline Notes" required></textarea>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Select Request Status</label>
                                                <select class="form-control show-tick ms select2" data-placeholder="Request Status" name="status" id="status" required>
                                                    <option value="approved">Approved</option>
                                                    <option value="declined">Declined</option>
                                                </select>
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-7">
                                <div class="float-right">
                                    <button type="submit" name="submit" value="
                                    submit_btn" class="btn btn-success">Submit</button>
                                    <a href="<?= site_url(); ?>dashboard">
                                        <button type="button" name="cancel" value="next_btn" class="btn btn-danger">Cancel</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                    </form>
                    <?php } ?>
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

<script src="<?= site_url(); ?>assets/vendor/toastr/toastr.js"></script> 
<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 

<!-- Date-Picker Time-Picker -->
<script src="<?= site_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<!--moment js-->
<script src="<?= site_url(); ?>assets/js/moment.js"></script> 

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
    $(function() {      
        //initialize Form Validation
        $('#confirm-client-request').parsley();

        $('.card-panel-header').click(function(){
            var target_id = $(this).attr("data-target-body");
            $("#"+target_id).toggle('slow');
            if($(this).children().hasClass('fa-plus')){
                $(this).find('.fa-plus').addClass('fa-minus');
                $(this).find('.fa-plus').removeClass('fa-plus');
            }else{
                $(this).find('.fa-minus').addClass('fa-plus');
                $(this).find('.fa-minus').removeClass('fa-minus');
            }
        });

    });
</script>

<script type="text/javascript">
    $(function() {      
        $('#request-details-form').parsley();        
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
                window.location.href = "<?= site_url('confirm-company-payroll-request/'.base64_encode($request_details['id'])); ?>";
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