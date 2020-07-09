<div id="wrapper">

    <?php include("inc/navbar.php") ?>

    <?php include("inc/sidebar.php") ?>    

    <div id="main-content">
        <div class="container-fluid">            
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo FMC_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active"><?php echo FMC_TITLE; ?></li>
                        </ul>
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                        <a href="<?= site_url(); ?>fmcusers/create" class="btn btn-info"><?php echo FMC_ADD_USERS; ?></a>
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
                                        <th><?php echo FMC_EMPLOYEE_ID; ?></th>
                                        <th><?php echo FMC_FULL_NAME; ?></th>
                                        <th><?php echo FMC_EMAIL; ?></th>
                                        <th><?php echo FMC_DEPARTMENT_NAME; ?></th>
                                        <th>***</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    if(!empty($items)){
                                        foreach ($items as $key => $value) { ?>
                                        <tr>                                        
                                            <td><?php echo $value['fmc_employee_id'] ?><br></td>
                                            <td><?php echo $value['first_name']." ".$value['last_name']." ".$value['surname']; ?></td>
                                            <td>
                                                <?php echo $value['email'] ?><br>
                                                <?php echo "Password: ".$value['password']; ?>
                                            </td>
                                            <td>
                                                <?php echo strtoupper($value['user_type']);  ?>
                                            </td>
                                            <td>
                                                <a href="<?= site_url(); ?>fmcusers/view/<?= base64_encode($value['id']);?>">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="View"><i class="fa fa-eye"></i></button>
                                                </a>
                                                 <a href="<?= site_url(); ?>fmcusers/update/<?= base64_encode($value['id']);?>" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>
                                               
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

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>

<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
function deleteItem(id)
{
    var result = confirm("<?php echo R_U_SURE; ?>");
    if (result) {
        show_page_loader();
        $.ajax({
            url: "<?= site_url('fmcusers/delete/'); ?>",
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
    }else{
        return false;
    }
}
</script>

</body>
</html>
