<div id="wrapper">

    <?php include("inc/navbar.php") ?>

    <?php include("inc/sidebar.php") ?>    
    <style type="text/css">
        td:hover{
            cursor:move;
            }
    </style>

    <div id="main-content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-sm-12">
                            <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Client Required Documents</h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                                <li class="breadcrumb-item active">list</li>
                            </ul>
                        </div>            
                        <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                            <a href="javascript:void(0);" class="btn btn-info" data-toggle="modal" data-target="#add_new_document">Add new document</a>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-12">
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
                                                <th>Document Name</th>
                                                <th>Required</th>
                                                <th>***</th>
                                            </tr>
                                        </thead>
                                        <tbody class="row_drag">
                                        <?php 

                                        if(!empty($items)){
                                            foreach ($items as $key => $value) { ?>
                                            <tr id="<?php echo $value['id'] ?>">
                                                <td><?php echo $value['name']; ?></td>    
                                                <td>
                                                    <a style="cursor: pointer;" class="badge badge-primary">
                                                        <?php echo $value['is_required']; ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="getItem('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-edit"></i></button>
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
    
</div>

<!-- Add new document -->
<div class="modal animated fadeIn" id="add_new_document" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-auth-small" id="add_new_document_form" action="<?= base_url('client_required_documents/create');?>" method="post">
            <div class="modal-header">
                <h6 class="title"><?php echo DOCUMENT_CATEGORY_ADD; ?></h6>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Document Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Document Name" required>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" name="is_required" value="1"><span>Is Required</span></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Create</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Update Country -->
<div class="modal animated fadeIn" id="update_document" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-auth-small" id="update_document_form" action="<?= base_url('client_required_documents/update');?>" method="post">
            <input type="hidden" name="id" value="">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Update Document</h6>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Document Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Document Name" required>
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" name="is_required" value="1"><span>Is-Required</span></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- Common Javascript Library Included jquery-3.3.1.min.js,popper.min.js,bootstrap.js -->
<script src="<?= site_url(); ?>assets/bundles/libscripts.bundle.js"></script>
<!-- Common Javascript Library metisMenu.js,jquery.slimscroll.min.js,bootstrap-progressbar.min.js,jquery.sparkline.min.js -->
<script src="<?= site_url(); ?>assets/bundles/vendorscripts.bundle.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>

<!-- Search Drondown .select2 -->
<script src="<?= site_url(); ?>assets/vendor/select2/select2.min.js"></script>

<!-- Jquery Datatables -->
<script src="<?= site_url(); ?>assets/bundles/datatablescripts.bundle.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>

<!-- Form Validation -->
<script src="<?= site_url(); ?>assets/vendor/parsleyjs/js/parsley.min.js"></script>

<!-- Toaster --> 
<script src="<?= site_url(); ?>assets/vendor/toastr/toastr.js"></script> 

<!-- SweetAlert For Dialog Box --> 
<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script> 

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>

<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 


<script type="text/javascript">
    $(function() {      
        $('#add_new_document_form').parsley();        
        $('#update_document_form').parsley();        
    }); 
</script>

<script type="text/javascript">
function getItem(id){
    show_page_loader();
    $.ajax({
        url: "<?= base_url('client_required_documents/get');?>",
        method: "POST",
        data: { id : id },
        success : function(response){
            hide_page_loader();
            var obj = JSON.parse(response);
            if(obj.success == 'true'){
                $("#update_document_form input[name*='id']").val(obj.data.id);
                $("#update_document_form input[name*='name']").val(obj.data.name);
                if(obj.data.is_required == 'yes'){
                    $("#update_document_form input[name*='is_required']").attr('checked',true);
                }
                else{
                    $("#update_document_form input[name*='is_required']").attr('checked',false);   
                }
                
                

                $("#update_document").modal("show");
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
            url: "<?= site_url('client_required_documents/delete/'); ?>",
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
        $('#add_document_categories_form').parsley();
        $('#update_document_categories_form').parsley();

        //$('.js-basic-example').DataTable();

    });
</script>

</body>
</html>
