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
                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_1/<?php echo base64_encode($id); ?>" class="flex-item-custom">1. <br /> <span><?php echo COMPANY_EMPLOYEE_ACCOUNT_DETAILS; ?></span></a>
                                        
                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_2/<?php echo base64_encode($id); ?>" class="flex-item-custom">2. <br /> <span><?php echo COMPANY_EMPLOYEE_POSITIONAL_INFO; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_3/<?php echo base64_encode($id); ?>" class="flex-item-custom">3. <br /> <span><?php echo COMPANY_EMPLOYEE_PERSONAL_INFO; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_4/<?php echo base64_encode($id); ?>" class="flex-item-custom">4. <br /> <span><?php echo COMPANY_EMPLOYEE_EMERGENCY_CONTACT; ?></span></a>
                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_5/<?php echo base64_encode($id); ?>" class="flex-item-custom">5. <br /> <span><?php echo COMPANY_EMPLOYEE_QUALIFICATION; ?></span></a>
                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_6/<?php echo base64_encode($id); ?>" class="flex-item-custom">6. <br /> <span><?php echo COMPANY_EMPLOYEE_WORK_EXP; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_7/<?php echo base64_encode($id); ?>" class="flex-item-custom">7. <br /> <span><?php echo COMPANY_EMPLOYEE_LEAVE_DETAILS; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_8/<?php echo base64_encode($id); ?>" class="flex-item-custom">8. <br /> <span><?php echo COMPANY_EMPLOYEE_SALARY_DETAILS; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_9/<?php echo base64_encode($id); ?>" class="flex-item-custom active">9. <br /> <span><?php echo "Personal Documents"; ?></span></a>

                                    </div>
                                    <div class="custom-hr"><hr /></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="button" class="btn btn-success align-right" data-toggle="modal" data-target="#add_personal_document"><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW; ?></button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                    <table class="table m-b-0">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Issue-Date</th>
                                                <th>Expiry-Date</th>
                                                <th>Document</th>
                                                <th>***</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                            
                                            <?php 
                                            foreach ($documents as $key => $value) {
                                            ?>
                                            <tr>
                                                <td><?php echo $value['title']; ?></td>
                                                <td>
                                                <?php 
                                                    if($value['issue_date'] != "0000-00-00"){
                                                        echo date('d-m-Y',strtotime($value['issue_date']));
                                                    }else{
                                                        echo "-";
                                                    }
                                                ?>
                                                </td>
                                                <td>
                                                <?php 
                                                    if($value['expiry_date'] != "0000-00-00"){
                                                        echo date('d-m-Y',strtotime($value['expiry_date']));
                                                    }else{
                                                        echo "-";
                                                    }
                                                ?>
                                                </td>
                                                <td><a download="<?php echo $value['document_file']; ?>" target="_blank" href="<?= site_url(); ?>uploads/<?php echo $value['document_file']; ?>">Download</a></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="getDocument('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-edit"></i></button>
                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteDocument('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <?php
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
                                        <!-- Previous -->
                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_8/<?php echo base64_encode($id); ?>">
                                            <button type="button" name="previous" class="btn btn-info"><?php echo COMPANY_EMPLOYEE_PREVIOUS; ?></button>
                                        </a>
                                        <a href="<?= site_url(); ?>employees">
                                            <button type="button" name="previous" class="btn btn-success"><?php echo COMPANY_EMPLOYEE_SAVE_CLOSE; ?></button>
                                        </a>
                                        <!-- Send For Approval -->
                                        <?php if($details['status'] == 'draft'){ ?>
                                        <a href="<?= site_url(); ?>employees/send-for-approval/<?php echo base64_encode($id); ?>">
                                            <button type="button" name="send_for_approval" class="btn btn-info">Send For Approval</button>
                                        </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             
            </div>

        </div>
    </div>

</div>


<!-- Upload Personal Documets Modal-Popup -->
<div class="modal animated fadeIn" id="add_personal_document" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-auth-small" id="add_personal_document_form" action="<?= base_url('employees/add_employee_document');?>" method="post" novalidate enctype="multipart/form-data">
            <input type="hidden" name="employee_id" value="<?php echo $details['id']; ?>">
            <div class="modal-header">
                <h6 class="title"><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_MODAL_POPUP_TITILE; ?></h6>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_TITLE; ?><span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" placeholder="<?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_TITLE; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_ISSUE_DATE; ?></label>
                            <input id="issue_date" class="form-control" name="issue_date" placeholder="<?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_ISSUE_DATE; ?>" autocomplete="off" readonly><!-- value="<?php echo $cr_number_expiry_date; ?>" -->
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_EXPIRY_DATE; ?></label>
                            <input class="form-control" id="expiry_date" name="expiry_date" placeholder="<?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_EXPIRY_DATE; ?>" autocomplete="off" readonly><!-- value="<?php echo $cr_number_expiry_date; ?>" -->
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_DESCRIPTION; ?></label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="document_file" style="width: 100%;">
                                <input type="file" class="dropify" name="document_file" id="document_file" required>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_ADD_BTN; ?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_CLOSE_BTN; ?></button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Upload Personal Documets Modal-Popup -->

<!-- Update Personal Documets Modal-Popup -->
<div class="modal animated fadeIn" id="upload_personal_document" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-auth-small" id="update_personal_document_form" action="<?= base_url('employees/update_employee_document');?>" method="post" novalidate enctype="multipart/form-data">                
            <input type="hidden" id="update_id" name="id" value="">
            <input type="hidden" id="update_employee_id" name="employee_id" value="<?php echo $details['id']; ?>">
            <div class="modal-header">
                <h6 class="title"><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_UPDATE_MODAL_POPUP_TITILE; ?></h6>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_TITLE; ?><span class="text-danger">*</span></label>
                            <input type="text" id="update_title" name="title" class="form-control" placeholder="<?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_TITLE; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_ISSUE_DATE; ?></label>
                            <input class="form-control" id="update_issue_date" name="issue_date" placeholder="<?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_ISSUE_DATE; ?>" autocomplete="off" readonly>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_EXPIRY_DATE; ?></label>
                            <input class="form-control" id="update_expiry_date" name="expiry_date" placeholder="<?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_EXPIRY_DATE; ?>" autocomplete="off" readonly>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_DESCRIPTION; ?></label>
                            <textarea class="form-control" id="update_description" name="description"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">                        
                        <div class="form-group">
                            <label for="update_document_file" style="width: 100%;">
                                <input type="file" class="dropify" name="document_file" id="update_document_file">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_ADD_BTN; ?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_CLOSE_BTN; ?></button>                                                        
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Update Personal Documets Modal-Popup -->

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

<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 

<!-- Ckeditor --> 
<script src="<?= site_url(); ?>assets/vendor/ckeditor/ckeditor.js"></script> 

<!-- Toaster --> 
<script src="<?= site_url(); ?>assets/vendor/toastr/toastr.js"></script> 

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>

<!-- Dropify -->
<script src="<?= site_url(); ?>assets/vendor/dropify/js/dropify.min.js"></script>

<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
    
    var fileInput = document.querySelector('input[id="document_file"]');
    fileInput.addEventListener('change', changeFile);

    function changeFile(){
        console.log("HELLo");
        console.log(fileInput.files[0]);
        $("#selected_file_name").html(fileInput.files[0].name);
    }

    var fileInputUpdate = document.querySelector('input[id="update_document_file"]');
    fileInputUpdate.addEventListener('change', changeUpdateFile);

    function changeUpdateFile(){
        $("#update_selected_file_name").html(fileInputUpdate.files[0].name);
    }

</script>

<script type="text/javascript">
    $(function() {      
        //initialize Form Validation  
        $('#add_personal_document_form').parsley();    
        $('#update_personal_document_form').parsley();                    

        //Drag & Drop
        $('.dropify').dropify();

        //Open Upload Company Logo Dialog On Btn Click
        $("#selected_file_name_btn").click(function(){
            $('#document_file').trigger('click');
        });
        $("#update_document_file_btn").click(function(){
            $('#update_document_file').trigger('click');
        });

        $('#issue_date').datepicker({
            format: 'dd/mm/yyyy',
            autoclose : true
        }).on('changeDate', function(e) {
            var issue_date = this.value;
            issue_date = issue_date.split("/");
            issue_date = new Date(+issue_date[2], issue_date[1] - 1, +issue_date[0]);   
            $("#expiry_date").val(''); //Blank Expiry Date
            $("#expiry_date").datepicker('remove'); //detach
            $('#expiry_date').datepicker({
                format: 'dd/mm/yyyy',
                autoclose : true,
                startDate: issue_date
            });
        });
    });
</script>

<script type="text/javascript">
    function getDocument(id){
        show_page_loader();
        $.ajax({
            url: "<?= base_url('employees/get_employee_document_details');?>",
            method: "POST",
            data: { id : id },
            success : function(response){
                hide_page_loader();
                var obj = JSON.parse(response);
                if(obj.success == 'true'){                    
                    $("#update_share_link_id").val($("#share_link_id").val());
                    $("#update_id").val(obj.data.id);
                    $("#update_employee_id").val(obj.data.employee_id);
                    $("#update_title").val(obj.data.title);
                    $("#update_description").val(obj.data.description);
                    $("#update_issue_date").val(obj.data.issue_date);
                    $("#update_expiry_date").val(obj.data.expiry_date);

                    $('#update_expiry_date').datepicker({
                        format: 'dd/mm/yyyy',
                        autoclose : true
                    })
                    
                    $('#update_issue_date').datepicker({
                        format: 'dd/mm/yyyy',
                        autoclose : true
                    }).on('changeDate', function(e) {
                        var issue_date = this.value;
                        issue_date = issue_date.split("/");
                        issue_date = new Date(+issue_date[2], issue_date[1] - 1, +issue_date[0]);   
                        $("#update_expiry_date").val(''); //detach
                        $("#update_expiry_date").datepicker('remove'); //detach
                        $('#update_expiry_date').datepicker({
                            format: 'dd/mm/yyyy',
                            autoclose : true,
                            startDate: issue_date
                        });
                    });

                    //Date Change   
                    if(obj.data.issue_date){
                        var issue_date = obj.data.issue_date;
                        issue_date = issue_date.split("/");
                        issue_date = new Date(+issue_date[2], issue_date[1] - 1, +issue_date[0]);   
                        //$("#expiry_date").datepicker('remove'); //detach
                        $('#update_expiry_date').datepicker({
                            format: 'dd/mm/yyyy',
                            autoclose : true,
                            startDate: issue_date
                        });                        
                    }                    
                    
                    $("#upload_personal_document").modal("show");
                }else{
                    // notification popup
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = 'toast-bottom-right';    
                    toastr['error']('something went wrong!.');
                }
            },
            error : function(){
                // notification popup
                toastr.options.closeButton = true;
                toastr.options.positionClass = 'toast-bottom-right';    
                toastr['error']('something went wrong!.');
                hide_page_loader();
            }
        });
    }

    function deleteDocument(id)
    {
        swal({
            title: "<?php echo R_U_SURE; ?>",
            text: "<?php echo RECOVER_RECORD; ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "<?php echo YES; ?>",
            closeOnConfirm: false
        }, function () {
            show_page_loader();
            $.ajax({
                url: "<?= site_url('employees/delete_employee_document'); ?>",
                type: 'post',
                data: {'id': id},
                success: function (data) {
                    hide_page_loader();
                    location.reload();
                },
                error: function () {    
                    hide_page_loader();
                }
            });    
        });
    }
</script>


