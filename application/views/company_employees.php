<div id="wrapper">

    <?php include("inc/company_navbar.php") ?>

    <?php include("inc/company_sidebar.php") ?>
    
    <?php
        $CI =& get_instance();
        $CI->load->model('employees_model');
        $CI->load->model('requests_model');

        $clients_array = $CI->clients_model->get_clients_for_drodown();          
        $fmc_language = get_cookie('fmc_language')?get_cookie('fmc_language'):"english";
    ?>

    <div id="main-content">
      <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo COMPANY_EMPLOYEE_TITLE; ?></h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active"><?php echo COMPANY_EMPLOYEE_LIST; ?></li>
                    </ul>                        
                </div>            
                <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                    <a href="<?= site_url(); ?>employees/company_employees_create_step_1" class="btn btn-info"><?php echo COMPANY_EMPLOYEE_ADD; ?></a>


                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span id="search_concept">Excel</span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-item"><a href="<?= site_url(); ?>assets/sample-excel/sample-employee-new.xlsx">Download Sample</a></li>
                        <li class="dropdown-item"><a href="#" data-toggle="modal" data-target="#importExcelModel">Import</a></li>
                    </ul>  
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
                <div class="table-responsive">
                  <table class="table table-hover js-basic-example dataTable table-custom m-b-0">
                    <thead>
                      <tr>
                        <th><?php echo COMPANY_EMPLOYEE_FULL_NAME; ?></th>
                        <th><?php echo COMPANY_EMPLOYEE_EMAIL; ?></th>
                        <th><?php echo COMPANY_EMPLOYEE_MOBILE; ?></th>
                        <th><?php echo COMPANY_EMPLOYEE_ENABLE_LOGIN; ?></th>
                        <th>Status</th>
                        <th>***</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                      if(!empty($items)){
                        foreach ($items as $key => $value) { 
                          $is_shared_link = $CI->employees_model->get_employee_share_link($value['id']);  
                                    ?>
                          <tr>                                        
                            <td><?php echo $value['fullname_english']; ?> (<?php echo $value['employee_code']; ?>)</td>
                            <td>
                              <?php echo $value['email'] ?><br>
                              <?php echo "Password: ".$value['password']; ?>
                            </td>
                            <td>
                              <?php echo $value['mobile'];  ?>
                            </td>
                            <td>
                              <?php echo ($value['is_login'] == 'yes') ? 'YES' : 'NO';  ?>
                            </td>
                            <td>
                            <?php 
                              if($value['status'] == "draft"){
                                $status_class = "badge-default";
                                $status = "Draft";
                            }
                            if($value['status'] == "in_approval"){
                              $status_class = "badge-default";
                              $status = "In-Approval";
                            }
                            if($value['status'] == "active"){
                              $status_class = "badge-success";
                              $status = "Active";
                            }
                            if($value['status'] == "declined"){
                              $status_class = "badge-danger";
                              $status = "Declined";
                            }
                            ?>
                            <span class="badge <?php echo $status_class; ?>"><?php echo $status; ?>
                            </span>
                            </td>
                            <td>
                              <a href="<?= site_url(); ?>employees/view/<?php echo base64_encode($value['id']); ?>">
                                <button type="button" class="btn btn-sm btn-outline-secondary" title="View"><i class="fa fa-eye"></i></button>
                              </a>
                              <a href="<?= site_url(); ?>employees/company_employees_create_step_1/<?= base64_encode($value['id']);?>" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>
                              <button type="button" onclick="deleteItem('<?php echo $value['id']; ?>');" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fa fa-trash-o"></i></button>
                              <?php 
                                if($value['is_login'] == 'no' && $value['status'] == "active"){
                                  if($is_shared_link){ 
                                    $expiry_date = date('d/m/Y',strtotime($is_shared_link['expiry_date']));
                              ?>
                                    <button type="button" onclick="update_share_public_link('<?php echo $is_shared_link['id']; ?>','<?php echo $is_shared_link['employee_id']; ?>','<?php echo $is_shared_link['email']; ?>','<?php echo $is_shared_link['share_link']; ?>','<?php echo $expiry_date; ?>');" class="btn btn-sm btn-success" title="Share Public Link">Copy Shared Link</button>
                              <?php 
                                  }else{ 
                              ?>
                                    <button type="button" onclick="share_public_link('<?php echo $value['id']; ?>');" class="btn btn-sm btn-success" title="Share Public Link">Share Public Link</button>
                              <?php 
                                  } 
                              ?>    
                              <?php 
                                } 
                            ?>
                            <?php if($value['request_id'] == 0 && $value['status'] == "draft"){ ?>
                              <a href="<?= site_url(); ?>employees/send-for-approval/<?php echo base64_encode($value['id']); ?>" class="btn btn-sm btn-outline-secondary">Send For Approval</a>
                            <?php } ?>
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
                </div>
            </div>
        </div>
    </div>

</div>



<!-- Import Excel Modal -->
<div class="modal animated jello" id="importExcelModel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('employees/import_excel');?>" method="post" id="importExcelForm" enctype="multipart/form-data" novalidate="novalidate">
                <div class="modal-header">
                    <h4 class="title"><?php echo COMPANY_EMPLOYEE_IMPORT_TITLE; ?></h4>
                </div>            
                <div class="modal-body">                
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group">
                                <label class="form-label text-xs-left" for=""><?php echo COMPANY_EMPLOYEE_IMPORT_SELECT_FILE; ?></label>
                                <input class="form-control" type="file" name="excel_file" id="excel_file" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?php echo COMPANY_EMPLOYEE_IMPORT_SUB_BTN_TITLE; ?></button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo COMPANY_EMPLOYEE_IMPORT_CAN_BTN_TITLE; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Share Public Link -->
<div class="modal animated jello" id="share_public_link_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('employees/share_public_link');?>" id="share_public_link_modal_form" method="post" novalidate enctype="multipart/form-data">
            <input type="hidden" name="employee_id" id="employee_id" value="">
            <input type="hidden" name="share_link" id="share_link" value="">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel"><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_TITLE; ?></h4>
            </div>           
            <div class="modal-body">
                <div class="row">    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_PUBLIC_URL; ?></label>
                            <input class="form-control" name="public_url" id="public_url" placeholder="<?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_PUBLIC_URL; ?>" value="" readonly required>
                        </div>
                        <div class="form-group">
                            <label><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_EMAIL; ?></label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="<?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_EMAIL; ?>" value=""  required>
                        </div>
                        <div class="form-group">
                            <label><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_EXPIRY_DATE; ?></label>
                            <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="expiry_date" placeholder="<?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_EXPIRY_DATE; ?>" autocomplete="off" value="" readonly required>
                        </div>
                        
                    </div>
                </div>            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo COMPANY_EMPLOYEE_CLOSE; ?></button>
                <button type="submit" name="next_btn" class="btn btn-info"><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_SUBMIT_BTN; ?></button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Public Link -->
<div class="modal animated jello" id="update_shared_public_link_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('employees/update_share_public_link');?>" id="share_public_link_modal_form" method="post" novalidate enctype="multipart/form-data">
            <input type="hidden" name="id" id="update_id" value="">
            <input type="hidden" name="employee_id" id="update_employee_id" value="">
            <input type="hidden" name="share_link" id="update_share_link" value="">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel"><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_TITLE; ?></h4>
            </div>           
            <div class="modal-body">
                <div class="row">    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_PUBLIC_URL; ?></label>
                            <div class="input-group colorpicker colorpicker-element">
                                <input class="form-control" name="public_url" id="update_public_url" placeholder="<?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_PUBLIC_URL; ?>" value="" readonly required>
                                <div class="input-group-append" style="cursor: pointer;" onclick="copy_share_public_link();">
                                    <span class="input-group-text"><span id="copy_text_ele" class="input-group-addon">Copy</span></span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_EMAIL; ?></label>
                            <input type="email" class="form-control" name="email" id="update_email" placeholder="<?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_EMAIL; ?>" value=""  required>
                        </div>
                        <div class="form-group">
                            <label><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_EXPIRY_DATE; ?></label>
                            <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="expiry_date" id="update_expiry_date" placeholder="<?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_EXPIRY_DATE; ?>" autocomplete="off" value="" readonly required>
                        </div>
                        
                    </div>
                </div>            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo COMPANY_EMPLOYEE_CLOSE; ?></button>
                <button type="submit" name="next_btn" class="btn btn-info"><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_MODAL_RESEND_BTN; ?></button>
            </div>
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

<!-- Ckeditor --> 
<script src="<?= site_url(); ?>assets/vendor/ckeditor/ckeditor.js"></script> 

<!-- bootstrap treeview -->
<script src="<?= site_url(); ?>assets/vendor/bootstrap-treeview/bootstrap-treeview.min.js"></script>

<!-- SweetAlert For Dialog Box --> 
<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script> 

<!-- Toaster --> 
<script src="<?= site_url(); ?>assets/vendor/toastr/toastr.js"></script> 

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 


<script type="text/javascript">

    function copy_share_public_link(){
        var copyText = document.getElementById("update_public_url");
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");        
        $("#copy_text_ele").html("Copied");
    }

    function update_share_public_link(id,employee_id,email,share_link,expiry_date){    
        var share_link_url = "<?= site_url(); ?>employee-public-link/"+share_link

        $("#copy_text_ele").html("Copy");

        $("#update_id").val(id);
        $("#update_share_link").val(share_link);
        $("#update_employee_id").val(employee_id);
        $("#update_email").val(email);
        $("#update_public_url").val(share_link_url);
        $("#update_expiry_date").val(expiry_date);

        $("#update_shared_public_link_modal").modal();
    }

    function share_public_link(employee_id){
        show_page_loader();
        $("#employee_id").val(employee_id);

        $.ajax({
            url: "<?= site_url('employees/get_share_link_ajax'); ?>",
            type: 'get',            
            success: function (data) {
                hide_page_loader();

                data = JSON.parse(data);
                var share_link = employee_id+data.share_link;
                var share_link_url = "<?= site_url(); ?>employee-public-link/"+share_link

                $("#share_link").val(share_link);
                $("#public_url").val(share_link_url);
                $('#share_public_link_modal_form').parsley();
                $("#share_public_link_modal").modal();
            },
            error: function () {
                hide_page_loader();
            }
        });         
    }

    function deleteItem(id)
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
                url: "<?= site_url('employees/delete/'); ?>",
                type: 'post',
                data: {'id': id,'status': 'deleted'},
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
<script type="text/javascript">
    $(function () {      
        //initialize Form Validation
        $('#importExcelForm').parsley();

    });
</script>