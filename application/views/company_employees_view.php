<div id="wrapper">

  <?php include("inc/company_navbar.php") ?>

  <?php include("inc/company_sidebar.php") ?>

  
    <div id="main-content" class="profilepage_2 blog-page">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo EMPLOYEE_PROFILE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item"><?php echo EMPLOYEE_PROFILE_PROFILE; ?></li>
                        </ul>
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right"></div>
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
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="card profile-header">
                        <div class="body">                      
                            <div class="profile-image"> 
                                <?php
                                if(!empty($details['profile_pic']) && file_exists("uploads/".$details['profile_pic'])){
                                ?>
                                <img height="100" width="100" src="<?= site_url(); ?>uploads/<?php echo $details['profile_pic']; ?>" class="rounded-circle" alt="No Image"> 
                                <?php }else{ ?>
                                <img height="100" width="100" src="<?= site_url(); ?>uploads/user_default.png" class="rounded-circle" alt="">
                                <?php } ?>
                            </div>
                            <div>
                            <h4 class="m-b-0"><strong><?php echo $details['fullname_english']; ?></strong></h4>
                            <span><?php echo $details['department_name']; ?>, <?php echo $details['designation_name']; ?></span>
                            </div> 
                            <div class="m-t-15">
                                <a target="_blank" class="btn btn-primary" href="<?= site_url(); ?>employees/view_full_profile/<?php echo base64_encode($details['id']); ?>"><?php echo EMPLOYEE_PROFILE_VIEW_FULL_PROFILE; ?></a>
                            </div>                                                 
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2><?php echo EMPLOYEE_PROFILE_LEAVE_BALANCE; ?></h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <small class="text-muted"><?php echo EMPLOYEE_PROFILE_NAME_ENGLISH; ?> </small>
                                    <p><?php echo $details['fullname_english'] ?></p>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <small class="text-muted"><?php echo EMPLOYEE_PROFILE_NAME_AREBIC; ?> </small>
                                    <p><?php echo $details['fullname_arabic'] ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <small class="text-muted"><?php echo EMPLOYEE_PROFILE_EMAIL; ?></small>
                                    <p><?php echo $details['email'] ?></p>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <small class="text-muted"><?php echo EMPLOYEE_PROFILE_MOBILE; ?></small>
                                    <p><?php echo $details['mobile'] ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <small class="text-muted"><?php echo EMPLOYEE_PROFILE_PASSWORD; ?></small>
                                    <p><?php echo $details['password'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="header">
                            <ul class="nav nav-tabs-new">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Overtime"><?php echo EMPLOYEE_PROFILE_OVERTIME; ?></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Leaves"><?php echo EMPLOYEE_PROFILE_LEAVES; ?></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Business-Trip"><?php echo EMPLOYEE_PROFILE_BUSINESS_TRIP; ?></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#eccr"><?php echo EMPLOYEE_PROFILE_ECCR; ?></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#general_request"><?php echo EMPLOYEE_PROFILE_GENERAL; ?></a></li>
                            </ul>
                            <ul class="header-dropdown">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right animated bounceIn" x-placement="bottom-end" style="top: 0px; position: absolute; transform: translate3d(23px, 31px, 0px); left: 0px; will-change: transform;">
                                        
                                        <li><a  href="<?= site_url(); ?>requests/overtime/<?php echo base64_encode($details['id']); ?>"><?php echo EMPLOYEE_PROFILE_REQUEST_OVERTIME; ?></a></li>
                                        <li><a  href="<?= site_url(); ?>requests/bussiness_trip/<?php echo base64_encode($details['id']); ?>"><?php echo EMPLOYEE_PROFILE_REQUEST_BUSINESS_TRIP; ?></a></li>
                                        <li><a href="<?= site_url(); ?>requests/leave/<?php echo base64_encode($details['id']); ?>"><?php echo EMPLOYEE_PROFILE_REQUEST_LEAVE; ?></a></li>
                                        <li><a href="<?= site_url(); ?>requests/eccr/<?php echo base64_encode($details['id']); ?>"><?php echo EMPLOYEE_PROFILE_REQUEST_ECCR; ?></a></li>
                                        <li><a href="<?= site_url(); ?>requests/general/<?php echo base64_encode($details['id']); ?>"><?php echo EMPLOYEE_PROFILE_REQUEST_GENERAL; ?></a></li>
                                        <li><a href="javascript:void(0);"><?php echo EMPLOYEE_PROFILE_REQUEST_EOS; ?></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="tab-content padding-0">
                                <div class="tab-pane animated fadeIn active" id="Overtime">
                                    <div class="table-responsive">
                                    <table class="table table-hover js-basic-example dataTable table-custom">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th><?php echo EMPLOYEE_PROFILE_DATE; ?></th>
                                                <th><?php echo EMPLOYEE_PROFILE_OVERTIME; ?></th>
                                                <th><?php echo EMPLOYEE_PROFILE_REQUEST_STATUS; ?></th>
                                                <th><?php echo EMPLOYEE_PROFILE_CREATED_AT; ?></th>
                                                <th>***</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        if(!empty($overtime_requests)){
                                        foreach ($overtime_requests as $key => $overtime_value) {
                                            if($overtime_value['request_status'] == "open"){
                                                $request_status_class = "badge-default";
                                            }
                                            if($overtime_value['request_status'] == "closed"){
                                                $request_status_class = "badge-success";
                                                $overtime_value['request_status'] = 'approved';
                                            }
                                            if($overtime_value['request_status'] == "declined"){
                                                $request_status_class = "badge-danger";
                                            }
                                        ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y',strtotime($overtime_value['date'])) ?></td>
                                            <td>
                                                <?php echo $overtime_value['from_time']." - ".$overtime_value['to_time']; ?></td>
                                            <td>
                                                <span class="badge <?php echo $request_status_class; ?>"><?php echo $overtime_value['request_status']; ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('d/m/Y',strtotime($overtime_value['created_at'])) ?></td>
                                            <td></td>
                                        </tr>
                                        <?php    
                                        }
                                        }
                                        ?>    
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                <div class="tab-pane animated fadeIn" id="Leaves">
                                    <div class="table-responsive">
                                    <table class="table table-hover js-basic-example dataTable table-custom">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th><?php echo EMPLOYEE_PROFILE_TITLE; ?></th>
                                                <th><?php echo EMPLOYEE_PROFILE_DAY_DATE; ?></th>
                                                <th><?php echo EMPLOYEE_PROFILE_REQUEST_STATUS; ?></th>
                                                <th><?php echo EMPLOYEE_PROFILE_CREATED_AT; ?></th>
                                                <th>***</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        if(!empty($leave_requests)){
                                        foreach ($leave_requests as $key => $leave_value) {
                                            if($leave_value['request_status'] == "open"){
                                                $request_status_class = "badge-default";
                                            }
                                            if($leave_value['request_status'] == "closed"){
                                                $request_status_class = "badge-success";
                                                $leave_value['request_status'] = 'approved';
                                            }
                                            if($leave_value['request_status'] == "declined"){
                                                $request_status_class = "badge-danger";
                                            }
                                        ?>
                                        <tr>
                                            <td><?php echo $leave_value['title']; ?></td>
                                            <td>
                                                <?php echo $leave_value['from_date']." to ".$leave_value['to_date']; ?></td>
                                            <td>
                                                <span class="badge <?php echo $request_status_class; ?>"><?php echo $leave_value['request_status']; ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('d/m/Y',strtotime($leave_value['created_at'])) ?></td>
                                            <td></td>
                                        </tr>
                                        <?php    
                                        }
                                        }
                                        ?>    
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                <div class="tab-pane animated fadeIn" id="Business-Trip">
                                    <div class="table-responsive">
                                    <table class="table table-hover js-basic-example dataTable table-custom">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th><?php echo EMPLOYEE_PROFILE_DATE; ?></th>
                                                <th><?php echo EMPLOYEE_PROFILE_OVERTIME; ?></th>
                                                <th><?php echo EMPLOYEE_PROFILE_REQUEST_STATUS; ?></th>
                                                <th><?php echo EMPLOYEE_PROFILE_CREATED_AT; ?></th>
                                                <th>***</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        if(!empty($business_trip_requests)){
                                        foreach ($business_trip_requests as $key => $business_trip_value) {
                                            if($business_trip_value['request_status'] == "open"){
                                                $request_status_class = "badge-default";
                                            }
                                            if($business_trip_value['request_status'] == "closed"){
                                                $request_status_class = "badge-success";
                                                $business_trip_value['request_status'] = 'approved';
                                            }
                                            if($business_trip_value['request_status'] == "declined"){
                                                $request_status_class = "badge-danger";
                                            }
                                        ?>
                                        <tr>
                                            <td><?php echo $business_trip_value['title']; ?></td>
                                            <td>
                                                <?php echo $business_trip_value['from_date']." to ".$business_trip_value['to_date']; ?></td>
                                            <td>
                                                <span class="badge <?php echo $request_status_class; ?>"><?php echo $business_trip_value['request_status']; ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('d/m/Y',strtotime($business_trip_value['created_at'])) ?></td>
                                            <td></td>
                                        </tr>
                                        <?php    
                                        }
                                        }
                                        ?>    
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                <div class="tab-pane animated fadeIn" id="eccr">
                                    <div class="table-responsive">
                                    <table class="table table-hover js-basic-example dataTable table-custom">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th><?php echo EMPLOYEE_PROFILE_DATE; ?></th>
                                                <th><?php echo EMPLOYEE_PROFILE_OVERTIME; ?></th>
                                                <th><?php echo EMPLOYEE_PROFILE_REQUEST_STATUS; ?></th>
                                                <th><?php echo EMPLOYEE_PROFILE_CREATED_AT; ?></th>
                                                <th>***</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        if(!empty($overtime_requests)){
                                        foreach ($overtime_requests as $key => $overtime_value) {
                                            if($overtime_value['request_status'] == "open"){
                                                $request_status_class = "badge-default";
                                            }
                                            if($overtime_value['request_status'] == "closed"){
                                                $request_status_class = "badge-success";
                                                $overtime_value['request_status'] = 'approved';
                                            }
                                            if($overtime_value['request_status'] == "declined"){
                                                $request_status_class = "badge-danger";
                                            }
                                        ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y',strtotime($overtime_value['date'])) ?></td>
                                            <td>
                                                <?php echo $overtime_value['from_time']." - ".$overtime_value['to_time']; ?></td>
                                            <td>
                                                <span class="badge <?php echo $request_status_class; ?>"><?php echo $overtime_value['request_status']; ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('d/m/Y',strtotime($overtime_value['created_at'])) ?></td>
                                            <td></td>
                                        </tr>
                                        <?php    
                                        }
                                        }
                                        ?>    
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                <div class="tab-pane animated fadeIn" id="general_request">
                                    <div class="table-responsive">
                                    <table class="table table-hover js-basic-example dataTable table-custom">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th><?php echo EMPLOYEE_PROFILE_DATE; ?></th>
                                                <th><?php echo EMPLOYEE_PROFILE_OVERTIME; ?></th>
                                                <th><?php echo EMPLOYEE_PROFILE_REQUEST_STATUS; ?></th>
                                                <th><?php echo EMPLOYEE_PROFILE_CREATED_AT; ?></th>
                                                <th>***</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        if(!empty($overtime_requests)){
                                        foreach ($overtime_requests as $key => $overtime_value) {
                                            if($overtime_value['request_status'] == "open"){
                                                $request_status_class = "badge-default";
                                            }
                                            if($overtime_value['request_status'] == "closed"){
                                                $request_status_class = "badge-success";
                                                $overtime_value['request_status'] = 'approved';
                                            }
                                            if($overtime_value['request_status'] == "declined"){
                                                $request_status_class = "badge-danger";
                                            }
                                        ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y',strtotime($overtime_value['date'])) ?></td>
                                            <td>
                                                <?php echo $overtime_value['from_time']." - ".$overtime_value['to_time']; ?></td>
                                            <td>
                                                <span class="badge <?php echo $request_status_class; ?>"><?php echo $overtime_value['request_status']; ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('d/m/Y',strtotime($overtime_value['created_at'])) ?></td>
                                            <td></td>
                                        </tr>
                                        <?php    
                                        }
                                        }
                                        ?>    
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>               
                </div>
            </div>

            <!-- Employee Confirmation Request Commnets & Timeline -->
            <?php if($details['request_id'] != 0){ ?>
            <div class="row clearfix file_manager">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Employee Confirmation Request Comments</h2>
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
                </div>
            </div>  

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Employee Confirmation Request Timeline</h2>
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
                </div>
            </div>
            <?php } ?>
            <!-- End Employee Confirmation Request Commnets & Timeline -->

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

<!-- bootstrap treeview -->
<script src="<?= site_url(); ?>assets/vendor/bootstrap-treeview/bootstrap-treeview.min.js"></script>

<!-- SweetAlert For Dialog Box --> 
<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script> 

<!-- Toaster --> 
<script src="<?= site_url(); ?>assets/vendor/toastr/toastr.js"></script> 

<script src="<?= site_url(); ?>assets/bundles/datatablescripts.bundle.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>

<!--moment js-->
<script src="<?= site_url(); ?>assets/js/moment.js"></script> 

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 


<script type="text/javascript">
    $(function () {      
        //datatables
        $('.js-basic-example').DataTable();      
        
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
                window.location.href = "<?= site_url('employees/view/'.base64_encode($details['id'])); ?>";
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