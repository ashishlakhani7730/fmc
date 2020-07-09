<div id="wrapper">

    <?php include("inc/company_navbar.php") ?>

    <?php include("inc/company_sidebar.php") ?>    

    <div id="main-content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-sm-12">
                            <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo  COMPANY_DEPARTMENT_TITLE; ?></h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                                <li class="breadcrumb-item active"><?php echo  COMPANY_DEPARTMENT_TITLE; ?></li>
                            </ul>
                        </div>            
                        <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                            <a href="javascript:void(0);" class="btn btn-info" data-toggle="modal" data-target="#add_user"><?php echo  COMPANY_DEPARTMENT_ADD_DEPARTMENT; ?></a>
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
                                                <th><?php echo  COMPANY_DEPARTMENT_NAME; ?></th>                                             
                                                <th>***</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 

                                        if(!empty($items)){
                                            foreach ($items as $key => $value) { ?>
                                            <tr>
                                                <td><?php echo $value['name']; ?></td>
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

<!-- Default Size -->
<div class="modal animated fadeIn" id="add_user" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="form-auth-small" action="<?= base_url('company_departments/create');?>" method="post">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel"><?php echo  COMPANY_DEPARTMENT_ADD_DEPARTMENT; ?></h6>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="<?php echo COMPANY_DEPARTMENT_PLSH_NAME; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><?php echo  COMPANY_DEPARTMENT_ADD; ?></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo  COMPANY_DEPARTMENT_CLOSE; ?></button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Default Size -->
<div class="modal animated fadeIn" id="update_department" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="form-auth-small" action="<?= base_url('company_departments/update');?>" method="post">
            <input type="hidden" name="id" id="department_id" value="">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel"><?php echo  COMPANY_DEPARTMENT_UPDATE; ?></h6>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <input type="text" name="name" id="department_name" class="form-control" placeholder="<?php echo  COMPANY_DEPARTMENT_PLSH_NAME; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><?php echo  COMPANY_DEPARTMENT_SAVE; ?></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo  COMPANY_DEPARTMENT_CLOSE; ?></button>
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

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>

<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
function getItem(id){
    show_page_loader();
    $.ajax({
        url: "<?= base_url('company_departments/get');?>",
        method: "POST",
        data: { id : id },
        success : function(response){
            hide_page_loader();
            var obj = JSON.parse(response);
            if(obj.success == 'true'){
                $("#department_id").val(obj.data.id);
                $("#department_name").val(obj.data.name);

                 $("#update_department").modal("show");
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
    var result = confirm("<?php echo R_U_SURE; ?>");
    if (result) {
        show_page_loader();
        $.ajax({
            url: "<?= site_url('company_departments/delete/'); ?>",
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
    }
    else{
        return false;
    }
}
</script>

</body>
</html>
