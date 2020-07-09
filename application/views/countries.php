<div id="wrapper">

    <?php include("inc/navbar.php") ?>

    <?php include("inc/sidebar.php") ?>    

    <div id="main-content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-sm-12">
                            <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo COUNTRIES_TITLE; ?></h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                                <li class="breadcrumb-item active"><?php echo COUNTRIES_TITLE; ?></li>
                            </ul>
                        </div>            
                        <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                            <a href="javascript:void(0);" class="btn btn-info" data-toggle="modal" data-target="#add_country"><?php echo COUNTRIES_ADD; ?></a>
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
                                                <th><?php echo COUNTRIES_NAME; ?></th>
                                                <th><?php echo COUNTRIES_DEFAULT; ?></th>
                                                <th>***</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 

                                        if(!empty($items)){
                                            foreach ($items as $key => $value) { ?>
                                            <tr>
                                                <td><?php echo $value['country_name']." (".$value['country_code'].")"; ?></td>
                                                <td>
                                                <?php 
                                                if($value['is_default'] == 1){
                                                ?>
                                                    <a style="cursor: pointer;" class="badge badge-success"><?php echo COUNTRIES_DEFAULT; ?></a>
                                                <?php } ?>
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

<!-- Add Country -->
<div class="modal animated fadeIn" id="add_country" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-auth-small" id="add_country_form" action="<?= base_url('countries/create');?>" method="post">
            <div class="modal-header">
                <h6 class="title"><?php echo COUNTRIES_ADD_CONTRIES; ?></h6>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COUNTRIES_NAME; ?></label>
                            <input type="text" name="country_name" class="form-control" placeholder="<?php echo COUNTRIES_NAME; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COUNTRIES_COUNTRY_CODE; ?></label>
                            <input type="text" name="country_code" class="form-control" placeholder="<?php echo COUNTRIES_COUNTRY_CODE; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <div class="fancy-checkbox">
                                <label><input class="salary_component_id" type="checkbox" name="is_default" value="1"><span><?php echo COUNTRIES_ISDEFAULT; ?></span></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><?php echo DEPARTMENTS_ADD; ?></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo DEPARTMENTS_CLOSE; ?></button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Update Country -->
<div class="modal animated fadeIn" id="update_country" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-auth-small" id="update_country_form" action="<?= base_url('countries/update');?>" method="post">
            <input type="hidden" name="id" value="">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel"><?php echo COUNTRIES_UPDATE; ?></h6>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COUNTRIES_NAME; ?></label>
                            <input type="text" name="country_name" class="form-control" placeholder="<?php echo COUNTRIES_UPDATE; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COUNTRIES_COUNTRY_CODE; ?></label>
                            <input type="text" name="country_code" class="form-control" placeholder="<?php echo COUNTRIES_COUNTRY_CODE; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" name="is_default" value="1"><span> <?php echo COUNTRIES_ISDEFAULT; ?></span></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><?php echo DEPARTMENTS_SAVE; ?></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo DEPARTMENTS_CLOSE; ?></button>
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
function getItem(id){
    show_page_loader();
    $.ajax({
        url: "<?= base_url('countries/get');?>",
        method: "POST",
        data: { id : id },
        success : function(response){
            hide_page_loader();
            var obj = JSON.parse(response);
            if(obj.success == 'true'){
                $("#update_country_form input[name*='id']").val(obj.data.id);
                $("#update_country_form input[name*='country_name']").val(obj.data.country_name);
                $("#update_country_form input[name*='country_code']").val(obj.data.country_code);
                if(obj.data.is_default == 1){
                    $("#update_country_form input[name*='is_default']").attr('checked',true);
                }
                else{
                    $("#update_country_form input[name*='is_default']").attr('checked',false);   
                }
                
                

                $("#update_country").modal("show");
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
            url: "<?= site_url('countries/delete/'); ?>",
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
        $('#add_country_form').parsley();
        $('#update_country_form').parsley();

        $('.js-basic-example').DataTable();

    });
</script>
</body>
</html>
