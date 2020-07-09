    <div id="wrapper">

    <?php include("inc/company_navbar.php") ?>

    <?php include("inc/company_sidebar.php") ?>
 
    <?php

        $id = (isset($details) && $details['id']) ? $details['id'] : '';

        $document_file = (isset($details) && $details['document_file'] != "") ? $details['document_file'] : '';

    ?>
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="<?= site_url(); ?>dashboard" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo COMPANY_DOCUMENTS_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active"><?php echo COMPANY_DOCUMENTS_LIST; ?></li>
                        </ul>                        
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#add_company_documents"><?php echo COMPANY_NEW_DOCUMENTS; ?></button>
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
                            <form action="<?= base_url('company_documents');?>" method="post" novalidate enctype="multipart/form-data">
                            <div class="row clearfix">
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo COMPANY_SELECT_CATEGORY; ?></label>
                                        <select name="document_category_id" class="form-control show-tick ms select2" data-placeholder="Select Documents Categories" required>
                                        <option value=""><?php echo COMPANY_SELECT_ALL; ?></option>
                                        <?php
                                        foreach ($document_categories as $key => $value) {
                                            $selected = "";
                                                                            
                                        ?>
                                        <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>&nbsp</label>
                                        <button style="background-color: #0069d9;" type="submit" class="btn btn-primary form-control"><?php echo COMPANY_SEARCH; ?></button>
                                    </div>
                                </div>
                            </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th><?php echo COMPANY_DOC_CAT_NAME; ?></th>
                                        <th><?php echo COMPANY_TITLE; ?></th>
                                        <th><?php echo COMPANY_DESCRIPTIONS; ?></th>
                                        <th><?php echo COMPANY_EXPIRYDATE; ?></th>
                                        <th>***</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php 

                                        if(!empty($items)){
                                            foreach ($items as $key => $value) {

                                                $expiry_date = (isset($value) && $value['expiry_date'] != "") ? $value['expiry_date'] : '0000-00-00';
                                                $expiry_date = explode("-", $expiry_date);
                                                $expiry_date = $expiry_date[2]."/".$expiry_date[1]."/".$expiry_date[0];
                                                if($expiry_date == '00/00/0000'){
                                                    $expiry_date = "-";
                                                }

                                            ?>            
                                            <tr>
                                                <td><?php echo $value['document_category_name']; ?></td>
                                                <td><?php echo $value['title']; ?></td>    
                                                <td><?php echo $value['descriptions']; ?></td>
                                                <td>
                                                    <?php echo $expiry_date ?>
                                                </td>
                                                
                                                <td>
                                                    <?php 
                                                        $file_path_info = pathinfo(site_url()."uploads/".$value['document_file']); 
                                                        $file_extension = $file_path_info['extension'];
                                                    ?>
                                                    <a href="<?= site_url(); ?>uploads/<?php echo $value['document_file']; ?>" target="_blank" class="btn btn-sm btn-outline-primary" download="<?php echo $value['title'].".".$file_extension; ?>" style="font-size:smaller;" ><i class="fa fa-download"></i></a>

                                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="getItem('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-edit"  data-toggle="modal" data-target="#update_company_documents"></i></button>
                                                    <button type="button" onclick="deleteItem('<?php echo $value['id']; ?>');" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fa fa-trash-o"></i></button>
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


<!-- Add New Assets Type -->
<div class="modal animated fadeIn" id="add_company_documents" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-auth-small" id="add_company_documents_form" action="<?= base_url('company_documents/create');?>" method="post" novalidate enctype="multipart/form-data">
            <div class="modal-header">
                <h6 class="title"><?php echo COMPANY_DOCUMENTS_TITLE; ?></h6>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_DOC_CAT; ?></label>
                            <select name="document_category_id" class="form-control show-tick ms select2" data-placeholder="Select Documents Categories" required>
                            <?php
                            foreach ($document_categories as $key => $value) {
                                $selected = "";
                                                                
                            ?>
                            <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['name']; ?></option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_TITLE; ?></label>
                            <input type="text" name="title" class="form-control" placeholder="<?php echo COMPANY_TITLE_PLSH; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_DESCRIPTIONS; ?></label>
                            <input type="text" name="descriptions" class="form-control" placeholder="<?php echo COMPANY_DESCRIPTIONS; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>
                                     <?php
                                    if(file_exists("uploads/".$document_file)){
                                    ?>
                                        <img src="<?= site_url(); ?>/uploads/<?php echo $document_file; ?>" alt="" width="50" height="50" />
                                        <br>
                                    <?php
                                    }else{
                                        echo "<br /><br />";  
                                    }
                                    ?>
                                    
                                    </label>
                                
                        </div>
                        <div class="col-md-11">
                            <label for="document_file" class="dragndrop m-2">
                                <img src="<?= site_url(); ?>assets/images/upload.png" alt="" /><br />
                                <?php echo COMPANY_DRAG_DROP; ?><br />
                                <?php echo CLIENTS_OR; ?><br />
                                <?php echo COMPANY_DOC_FILE; ?><br />
                                <?php echo COMPANY_SIZE_FILE; ?><br />
                                <?php echo COMPANY_FILE_TYPE; ?></br>
                                <button type="button" class="btn btn-sm btn-outline-primary"><?php echo COMPANY_BROWSE_FILE; ?></button>
                                <input type="file" name="document_file" id="document_file" style="display: none;">
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_DATE_OF_EXPIRY; ?></label>
                            <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="expiry_date" placeholder="<?php echo COMPANY_DATE_OF_EXPIRY; ?>" autocomplete="off" readonly><!-- value="<?php echo $cr_number_expiry_date; ?>" -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?php echo COMPANY_ADD; ?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo COMPANY_CLOSE; ?></button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Update Country -->
<div class="modal animated fadeIn" id="update_company_documents" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-auth-small" id="update_company_documents_form" action="<?= base_url('company_documents/update');?>" method="post"  novalidate enctype="multipart/form-data">
            <input type="hidden" name="id" value="">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel"><?php echo COMPANY_UPDATE; ?></h6>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_DOC_CAT; ?></label>
                            <select name="document_category_id" class="form-control show-tick ms select2" data-placeholder="Select Documents Categories" required>
                            <?php
                            foreach ($document_categories as $key => $value) {
                                $selected = "";
                                                                
                            ?>
                            <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['name']; ?></option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_TITLE; ?></label>
                            <input type="text" name="title" class="form-control" placeholder="<?php echo COMPANY_TITLE_PLSH; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_DESCRIPTIONS; ?></label>
                            <input type="text" name="descriptions" class="form-control" placeholder="<?php echo COMPANY_DESCRIPTIONS; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>
                                     <?php
                                    if(file_exists("uploads/".$document_file)){
                                    ?>
                                        <img src="<?= site_url(); ?>/uploads/<?php echo $document_file; ?>" alt="" width="50" height="50" />
                                        <br>
                                    <?php
                                    }else{
                                        echo "<br /><br />";  
                                    }
                                    ?>
                                    
                                    </label>
                                
                        </div>
                        <div class="col-md-11">
                            <label for="document_file" class="dragndrop m-2">
                                <img src="<?= site_url(); ?>assets/images/upload.png" alt="" /><br />
                                <?php echo COMPANY_DRAG_DROP; ?><br />
                                <?php echo CLIENTS_OR; ?><br />
                                <?php echo COMPANY_DOC_FILE; ?><br />
                                <?php echo COMPANY_SIZE_FILE; ?><br />
                                <?php echo COMPANY_FILE_TYPE; ?></br>
                                <button type="button" class="btn btn-sm btn-outline-primary"><?php echo COMPANY_BROWSE_FILE; ?></button>
                                <input type="file" name="document_file" id="document_file" style="display: none;">
                            </label>
                        </div>
                        <div class="col-md-12 text-center" name="document_file" value="<?php echo $document_file; ?>"></div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_DATE_OF_EXPIRY; ?></label>
                            <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="expiry_date" placeholder="<?php echo COMPANY_DATE_OF_EXPIRY; ?>" autocomplete="off" value="<?php echo $expiry_date; ?>" readonly ><!--  -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?php echo COMPANY_ADD; ?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo COMPANY_CLOSE; ?></button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Javascript -->

<script src="<?= site_url(); ?>assets/bundles/libscripts.bundle.js"></script>
<script src="<?= site_url(); ?>assets/bundles/vendorscripts.bundle.js"></script>

<script src="<?= site_url(); ?>assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/multi-select/js/jquery.multi-select.js"></script>

<script src="<?= site_url(); ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="<?= site_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> <!-- Bootstrap Tags Input Plugin Js --> 
<script src="<?= site_url(); ?>assets/vendor/nouislider/nouislider.js"></script> <!-- noUISlider Plugin Js --> 
<script src="<?= site_url(); ?>assets/vendor/select2/select2.min.js"></script> <!-- Select2 Js -->

<script src="<?= site_url(); ?>assets/bundles/datatablescripts.bundle.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>

<script src="<?= site_url(); ?>assets/vendor/parsleyjs/js/parsley.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/toastr/toastr.js"></script> 
<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 

<script src="<?= site_url(); ?>assets/vendor/dropify/js/dropify.min.js"></script>

<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
function getItem(id){
    show_page_loader();
    $.ajax({
        url: "<?= base_url('company_documents/get');?>",
        method: "POST",
        data: { id : id },
        success : function(response){
            hide_page_loader();
            var obj = JSON.parse(response);
            if(obj.success == 'true'){
                $("#update_company_documents_form input[name*='id']").val(obj.data.id);
                $("#update_company_documents_form input[name*='document_category_id']").val(obj.data.document_category_id);
                $("#update_company_documents_form input[name*='title']").val(obj.data.title);
                $("#update_company_documents_form input[name*='descriptions']").val(obj.data.descriptions);
                $("#update_company_documents_form input[name*='document_file']").val(obj.data.document_file);
                $("#update_company_documents_form input[name*='ExpiryDate']").val(obj.data.ExpiryDate);
                
                
                

                $("#update_company_documents").modal("show");
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
function readURL(input) {
    if (input.files && input.files[0]) 
    {
        var reader = new FileReader();
        reader.onload = function (e) {
        $("#document_selected").show();                
    }
        reader.readAsDataURL(input.files[0]);
    }
}

    $("#document").change(function(){
        readURL(this);
    });

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
            url: "<?= site_url('company_documents/delete/'); ?>",
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
        //checkin form validation initialize
        $('#add_company_documents_form').parsley();
        $('#update_company_documents_form').parsley();

       // $('.js-basic-example').DataTable();

    });
</script>

