<div id="wrapper">

    <?php include("inc/navbar.php") ?>

    <?php include("inc/sidebar.php") ?>    

    <div id="main-content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-sm-12">
                            <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo CLIENTS_TITLE; ?></h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                                <li class="breadcrumb-item active"><?php echo CLIENTS_TITLE; ?></li>
                            </ul>
                        </div>            
                        <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                            <a href="<?= site_url(); ?>clients/create_general_information" class="btn btn-info"><?php echo CLIENTS_ADD_NEW_CLIENTS; ?></a>
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
                                                <th><?php echo CLIENTS_NAME_ENGLISH; ?></th>
                                                <th><?php echo CLIENTS_NAME_ARABIC; ?></th>                 
                                                <th><?php echo CLIENTS_STATUS; ?></th>
                                                <th>***</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 

                                        if(!empty($items)){
                                            foreach ($items as $key => $value) {
                                                $client_draft_details = $CI->clients_model->get_draft_details_by_client_id($value['id']);               
                                        ?>
                                            <tr>
                                                <td><?php echo $value['company_name_english'] ?></td>
                                                <td><?php echo $value['company_name_arabic'] ?></td>
                                                <td>
                                                <?php
                                                    if($value['status'] == 'active'){
                                                       echo '<span class="badge badge-success">Active</span>'; 
                                                    }else if($value['status'] == 'draft'){
                                                        echo '<span class="badge badge-info">Draft</span>';
                                                    }else if($value['status'] == 'detail_validated'){
                                                        echo '<span class="badge badge-info">Detail Validated</span>';
                                                    }else if($value['status'] == 'in_confirmation'){
                                                        echo '<span class="badge badge-info">In FMC Confirmation</span>';
                                                    }else if($value['status'] == 'in_confirmation'){
                                                        echo '<span class="badge badge-info">In FMC Confirmation</span>';
                                                    }else if($value['status'] == 'confirmed'){
                                                        echo '<span class="badge badge-info">confirmed</span>';
                                                    }else if($value['status'] == 'declined'){
                                                        echo '<span class="badge badge-danger">declined</span>';
                                                    }
                                                ?>
                                                </td>
                                                <td>
                                                    <a href="<?= site_url(); ?>clients/create_draft_client/<?php echo base64_encode($value['id']); ?>">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></button>
                                                    </a>
                                                    <a href="<?= site_url(); ?>clients/view/<?php echo base64_encode($value['id']); ?>">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="View"><i class="fa fa-eye"></i></button>
                                                    </a>
                                                    <button type="button" onclick="deleteItem('<?php echo $value['id']; ?>');" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fa fa-trash-o"></i></button>

                                                    <?php if($client_draft_details && $client_draft_details['request_id'] != '0'){ ?>
                                                    <a href="<?= site_url(); ?>clients/confirm_client_details/<?php echo base64_encode($client_draft_details['id']); ?>">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="View">View Request Details</button>
                                                    </a>
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
            url: "<?= site_url('clients/delete/'); ?>",
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
