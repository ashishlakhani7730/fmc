<div id="wrapper">

    <?php include("inc/company_navbar.php") ?>

    <?php include("inc/company_sidebar.php") ?>
 

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo JOB_OPENIG_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active"><?php echo JOB_OPENIG_TITLE; ?></li>
                        </ul>                        
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                        <a href="<?= site_url(); ?>jobopenings/create" class="btn btn-info"><?php echo JOB_OPENIG_ADD_JOB; ?></a>
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
                                            <th><?php echo JOB_POSITIONS_JOB_TITLE; ?></th>
                                            <th><?php echo JOB_POSITIONS_DESIGNATION; ?></th>
                                            <th><?php echo JOB_POSITIONS_STATUS; ?></th>
                                            <th>***</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    if(!empty($items)){
                                        foreach ($items as $key => $value) { ?>
                                        <tr>                                        
                                            <td><?php echo $value['job_title']; ?></td>
                                            <td>
                                                <?php echo $value['designation_name'] ?>
                                            </td>
                                            <td>
                                                <a style="cursor: pointer;" class="badge badge-default"><?php echo $value['status']; ?></a>
                                            </td>
                                            <td>
                                                 <a href="<?= site_url(); ?>jobopenings/update/<?= base64_encode($value['id']);?>" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>
                                               
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

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 


<script type="text/javascript">

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
            url: "<?= site_url('jobopenings/delete/'); ?>",
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
        //display tree view data                  
    });
</script>