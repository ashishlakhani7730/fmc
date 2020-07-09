<div id="wrapper">

    <?php include("inc/company_navbar.php") ?>

    <?php include("inc/company_sidebar.php") ?>
 
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo ASSETS_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active"><?php echo ASSETS_LIST; ?></li>
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
                    <div class="card">                        
                        <div class="body">
                            <ul class="nav nav-tabs-new2">
                                <li class="nav-item"><a class="nav-link <?php echo ($current_tab == 'assets-type') ? 'active show' : ''; ?>" data-toggle="tab" href="#Assets-type"><?php echo ASSETS_TYPE; ?></a></li>
                                <li class="nav-item"><a class="nav-link <?php echo ($current_tab == 'assets-manufacturer') ? 'active show' : ''; ?>" data-toggle="tab" href="#Assets-manufacturer"><?php echo ASSETS_MANUFACTURER; ?></a></li>
                                <li class="nav-item"><a class="nav-link <?php echo ($current_tab == 'assets-item') ? 'active show' : ''; ?>" data-toggle="tab" href="#Assets-item"><?php echo ASSETS_ITEM; ?></a></li>
                                <li class="nav-item"><a class="nav-link <?php echo ($current_tab == 'assigned-assets') ? 'active show' : ''; ?>" data-toggle="tab" href="#Assigned-assets"><?php echo ASSETS_ASSIGNED; ?></a></li>
                                <li class="nav-item"><a class="nav-link <?php echo ($current_tab == 'retun-assets') ? 'active show' : ''; ?>" data-toggle="tab" href="#Retun-assets"><?php echo ASSETS_RETURN; ?></a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane <?php echo ($current_tab == 'assets-type') ? 'active show' : ''; ?>" id="Assets-type">
                                    <div class="header">
                                        <h2><?php echo ASSETS_TYPE; ?></h2>
                                        <ul class="header-dropdown">
                                            <li>
                                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_assets_type"><?php echo ASSETS_ADD_NEW; ?></button>
                                            </li>                                            
                                        </ul>                            
                                    </div>  
                                    <div class="table-responsive">
                                        <table class="table table-hover js-basic-example dataTable table-custom">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th><?php echo ASSETS_TYPE_TITLE; ?></th>                  
                                                    <th>***</th>
                                                    
                                                </tr>
                                            </thead>                                           
                                            <tbody>
                                                <?php
                                                if(!empty($assets_type)){
                                                    foreach ($assets_type as $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $value['name']; ?></td>  
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="getAssetsType('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-edit"></i></button>
                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteAssetsType('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-trash"></i></button>
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
                                <div class="tab-pane <?php echo ($current_tab == 'assets-manufacturer') ? 'active show' : ''; ?>" id="Assets-manufacturer">
                                    <div class="header">
                                        <h2><?php echo ASSETS_MANUFACTURER; ?></h2>
                                        <ul class="header-dropdown">
                                            <li>
                                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_manufacturer"><?php echo ASSETS_NEW_MANUFACTURER; ?></button>
                                            </li>
                                        </ul>                            
                                    </div>  
                                    <div class="table-responsive">
                                        <table class="table table-hover js-basic-example dataTable table-custom">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th><?php echo ASSETS_MANUFACTURER_NAME; ?></th>
                                                    <th><?php echo ASSETS_NOTES; ?></th>
                                                    <th>***</th>
                                                </tr>
                                            </thead>                                            
                                            <tbody>
                                                <?php
                                                if(!empty($assets_manufacturer)){
                                                    foreach ($assets_manufacturer as $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $value['name']; ?></td>
                                                    <td><?php echo $value['note']; ?></td>  
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="getAssetsmanufacturer('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-edit"></i></button>
                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteAssetsmanufacturer('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-trash"></i></button>
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
                                <div class="tab-pane <?php echo ($current_tab == 'assets-item') ? 'active show' : ''; ?>" id="Assets-item">
                                    <div class="header">
                                        <h2><?php echo ASSETS_ITEM; ?></h2>
                                        <ul class="header-dropdown">
                                            <li>
                                                <a href="<?= site_url(); ?>assets_items/create" class="btn btn-primary" title="Edit"><?php echo ASSETS_ADD_NEW_ITEM; ?></a>
                                            </li>
                                        </ul>                            
                                    </div>  
                                    <div class="table-responsive">
                                        <table class="table table-hover js-basic-example dataTable table-custom">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th><?php echo ASSETS_ITEM_NAME; ?></th>
                                                    <th><?php echo ASSETS_ITEM_ID; ?></th>
                                                    <th><?php echo ASSETS_SERIAL_NUMBER; ?></th>
                                                    <th><?php echo ASSETS_MODEL; ?></th>
                                                    <th><?php echo ASSETS_MANUFACTURER; ?></th>
                                                    <th><?php echo ASSETS_TYPE; ?></th>
                                                    <th><?php echo ASSETS_CONDITIONS; ?></th>
                                                    <th><?php echo ASSETS_STATUS; ?></th>                
                                                    <th>***</th>
                                                </tr>
                                            </thead>                                            
                                            <tbody>
                                                <?php
                                                if(!empty($assets_item)){
                                                    foreach ($assets_item as $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $value['item_name']; ?></td>
                                                    <td><?php echo $value['item_id']; ?></td>
                                                    <td><?php echo $value['serial_number']; ?></td>
                                                    <td><?php echo $value['model']; ?></td>
                                                    <td><?php echo $value['manufacturer_name']; ?></td>
                                                    <td><?php echo $value['assets_type_name']; ?></td>
                                                    <td>
                                                        <?php 
                                                        if($value['conditions'] == 'new'){
                                                            echo "New";
                                                        }
                                                        if($value['conditions'] == 'used'){
                                                            echo "Used";
                                                        }
                                                        if($value['conditions'] == 'partially_damaged'){
                                                            echo "Partially Damaged";
                                                        }
                                                        if($value['conditions'] == 'fully_damaged'){
                                                            echo "Fully Damaged";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo strtoupper($value['status_assign']); ?></td>
                                                    <td>
                                                        <a href="<?= site_url(); ?>assets_items/update/<?php echo base64_encode($value['id']); ?>" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>

                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteAssetsItem('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-trash"></i></button>
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
                                <div class="tab-pane <?php echo ($current_tab == 'assigned-assets') ? 'active show' : ''; ?>" id="Assigned-assets">
                                    <div class="header">
                                        <h2><?php echo ASSETS_ASSIGNED; ?></h2>
                                        <ul class="header-dropdown">
                                            <li>
                                                <a href="<?= site_url(); ?>assets-assign/create" class="btn btn-primary" title="Edit"><?php echo ASSETS_ASSIGN_ITEM; ?></a>
                                            </li>
                                            
                                        </ul>                            
                                    </div>  
                                    <div class="table-responsive">
                                        <table class="table table-hover js-basic-example dataTable table-custom">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th><?php echo ASSETS_USER; ?></th>
                                                    <th><?php echo ASSETS_ITEM_NAME; ?></th>
                                                    <th><?php echo ASSETS_CONDITION; ?></th>
                                                    <th><?php echo ASSETS_ASSIGNED_DATE; ?></th>
                                                    <th>***</th>
                                                </tr>
                                            </thead>                                            
                                            <tbody>
                                                <?php
                                                if(!empty($assets_assign)){
                                                foreach ($assets_assign as $value) {

                                                    $assign_date = (isset($value) && $value['assign_date'] != "") ? $value['assign_date'] : '0000-00-00';
                                                    $assign_date = explode("-", $assign_date);
                                                    $assign_date = $assign_date[2]."/".$assign_date[1]."/".$assign_date[0];
                                                    if($assign_date == '00/00/0000'){
                                                        $assign_date = "-";
                                                    }
                                                ?>
                                                <tr>
                                                    <td><?php echo $value['emp_fullname_english']; ?></td>
                                                    <td><?php echo $value['item_name']; ?></td>
                                                    <td>
                                                    <?php 
                                                    if($value['conditions'] == 'new'){
                                                        echo "New";
                                                    }
                                                    if($value['conditions'] == 'used'){
                                                        echo "Used";
                                                    }
                                                    if($value['conditions'] == 'partially_damaged'){
                                                        echo "Partially Damaged";
                                                    }
                                                    if($value['conditions'] == 'fully_damaged'){
                                                        echo "Fully Damaged";
                                                    }
                                                    ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $assign_date ?>
                                                    </td>
                                                    
                                                    <!-- <td><?php  ?></td> -->

                                                    <td>
                                                        <a href="<?= site_url(); ?>assets-assign/update/<?php echo base64_encode($value['id']); ?>" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>

                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteAssetsAssign('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-trash"></i></button>
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
                                <div class="tab-pane <?php echo ($current_tab == 'retun-assets') ? 'active show' : ''; ?>" id="Retun-assets">
                                    <div class="header">
                                        <h2><?php echo ASSETS_RETURN_ASSETS; ?></h2>
                                        <ul class="header-dropdown">
                                            <li>
                                                <a href="<?= site_url(); ?>assets-return/create" class="btn btn-primary" title="Edit"><?php echo ASSETS_ADD_RETURN_ITEM; ?></a>
                                            </li>
                                        </ul>                            
                                    </div>  
                                    <div class="table-responsive">
                                        <table class="table table-hover js-basic-example dataTable table-custom">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th><?php echo ASSETS_USER; ?></th>
                                                    <th><?php echo ASSETS_ITEM_NAME; ?></th>
                                                    <th><?php echo ASSETS_CONDITION; ?></th>
                                                    <th><?php echo ASSETS_RETURN_DATE; ?></th>
                                                    <th>***</th>
                                                </tr>
                                            </thead>                                            
                                            <tbody>
                                                <?php
                                                if(!empty($assets_assign)){
                                                    foreach ($assets_assign as $value) {

                                                        if($value['is_return'] == 'yes'){
                                                            $return_date = (isset($value) && $value['return_date'] != "") ? $value['return_date'] : '0000-00-00';
                                                            $return_date = explode("-", $return_date);
                                                            $return_date = $return_date[2]."/".$return_date[1]."/".$return_date[0];
                                                            if($return_date == '00/00/0000'){
                                                                $return_date = "-";
                                                            }

                                                        ?>
                                                        <tr>
                                                            <td><?php echo $value['emp_fullname_english']; ?></td>
                                                            <td><?php echo $value['item_name']; ?></td>
                                                            <td>
                                                            <?php 
                                                            if($value['return_conditions'] == 'new'){
                                                                echo "New";
                                                            }
                                                            if($value['return_conditions'] == 'used'){
                                                                echo "Used";
                                                            }
                                                            if($value['return_conditions'] == 'partially_damaged'){
                                                                echo "Partially Damaged";
                                                            }
                                                            if($value['return_conditions'] == 'fully_damaged'){
                                                                echo "Fully Damaged";
                                                            }
                                                            ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $return_date ?>
                                                            </td>

                                                            <td>
                                                                <a href="<?= site_url(); ?>assets-return/update/<?php echo base64_encode($value['id']); ?>" class="btn btn-sm btn-outline-secondary" title="Edit">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>

                                                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="delete_returned_item('<?php echo $value['id']; ?>');" title="Delete"><i class="fa fa-trash"></i></button>
                                                            </td> 

                                                        </tr>    
                                                        <?php
                                                        }
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
</div>


<!-- Add New Assets Type -->
<div class="modal animated jello" id="add_assets_type" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="add_Assets_type_form" action="<?= base_url('assets/create_assets_type');?>">

            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel"><?php echo ASSETS_ADD_NEW_TYPE; ?></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="name" class="form-control" placeholder="<?php echo ASSETS_TYPE_TITLE; ?>" required>
                    </div>
                </div>                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><?php echo ASSETS_ADD; ?></button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo ASSETS_CLOSE; ?></button>
            </div>
        </form>
        </div>
    </div>
</div>
<!--Update add new assets -->
<div class="modal animated jello" id="update_assets_type" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="update_assets_type_form" action="<?= base_url('assets/update_assets_type');?>">
            <input type="hidden" name="id" value="">

            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel"><?php echo ASSETS_UPDATE_TYPE; ?></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="name" class="form-control" placeholder="<?php echo ASSETS_TYPE_TITLE; ?>" required>
                    </div>
                </div>                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><?php echo ASSETS_SAVE; ?></button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo ASSETS_CLOSE; ?></button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Add New Manufacturer Type -->
<div class="modal animated jello" id="add_manufacturer" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="post" id="add_manufacturer_form" action="<?= base_url('assets_manufacturer/create');?>">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel"><?php echo ASSETS_ADD_NEW_MANUFACTURER; ?></h4>
            </div>            
            <div class="modal-body">                
                <div class="row clearfix">
                    <div class="form-group col-lg-12 col-md-6">
                        <div class="form-line">
                            <input type="text" name="name" class="form-control" placeholder="<?php echo ASSETS_MANUFACTURER_NAME; ?>" required>
                        </div>
                    </div>                    
                </div>   
                <div class="row clearfix">
                    <div class="form-group col-lg-12 col-md-6">
                        <div class="form-line">
                            <textarea name="note" class="form-control" placeholder="<?php echo ASSETS_NOTES; ?>" required></textarea>
                        </div>
                    </div>                
                </div>             
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><?php echo ASSETS_ADD; ?></button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo ASSETS_CLOSE; ?></button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- update assets manufacturer -->
<div class="modal animated jello" id="update_manufacturer" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="post" id="update_assets_manufacturer_form" action="<?= base_url('assets_manufacturer/update');?>">
            <input type="hidden" name="id" value="">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel"><?php echo ASSETS_UPDATE_MANUFACTURER; ?></h4>
            </div>            
            <div class="modal-body">                
                <div class="row clearfix">
                    <div class="form-group col-lg-12 col-md-6">
                        <div class="form-line">
                            <input type="text" name="name" class="form-control" placeholder="<?php echo ASSETS_MANUFACTURER_NAME; ?>" required>
                        </div>
                    </div>                    
                </div>   
                <div class="row clearfix">
                    <div class="form-group col-lg-12 col-md-6">
                        <div class="form-line">
                            <textarea name="note" class="form-control" placeholder="<?php echo ASSETS_NOTES; ?>" required></textarea>
                        </div>
                    </div>                
                </div>             
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><?php echo ASSETS_UPDATE; ?></button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo ASSETS_CLOSE; ?></button>
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
<script src="<?= site_url(); ?>assets/vendor/multi-select/js/jquery.multi-select.js"></script> 

<script src="<?= site_url(); ?>assets/vendor/parsleyjs/js/parsley.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="<?= site_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> <!-- Bootstrap Tags Input Plugin Js --> 
<script src="<?= site_url(); ?>assets/vendor/nouislider/nouislider.js"></script> <!-- noUISlider Plugin Js --> 
<script src="<?= site_url(); ?>assets/vendor/select2/select2.min.js"></script> <!-- Select2 Js -->
<script src="<?= site_url(); ?>assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<script src="<?= site_url(); ?>assets/bundles/datatablescripts.bundle.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/toastr/toastr.js"></script> 
<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 

<script src="<?= site_url(); ?>assets/vendor/dropify/js/dropify.min.js"></script>

<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>

<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
    $(function () {
        $('.js-basic-example').DataTable();

        //Form Validation
        $('#add_assets_type_form').parsley();
        $('#update_assets_type_form').parsley();

        //Form Validation
        $('#add_manufacturer_form').parsley();
        $('#update_assets_manufacturer_form').parsley();

        //Form Validation
        $('#add_assets_item_form').parsley();
        $('#update_assets_item_form').parsley();
    });
</script>

<script type="text/javascript">
    //Get assets-type For Update
    function getAssetsType(id){
        show_page_loader();
        $.ajax({
            url: "<?= base_url('assets/get_assets_type');?>",
            method: "POST",
            data: { id : id },
            success : function(response){
                hide_page_loader();
                var obj = JSON.parse(response);
                console.log(obj);
                if(obj.success == 'true'){
                    $("#update_assets_type input[name*='id']").val(obj.data.id);
                    $("#update_assets_type input[name*='name']").val(obj.data.name);
                                        
                    $("#update_assets_type").modal("show");
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

    function deleteAssetsType(id){
        swal({
            title: "<?php echo R_U_SURE; ?>",
            text: "<?php echo RECOVER_RECORD; ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "<?php echo YES; ?>",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                url: "<?= site_url('assets/delete_assets_type/'); ?>",
                type: 'post',
                data: {'id': id,'status': 'deleted'},
                success: function (data) {
                    window.location.href = "<?= site_url('assets-management'); ?>";
                },
                error: function () {
                    window.location.href = "<?= site_url('assets-management'); ?>";
                }
            });            
        });
    }
</script>

<!-- assets_manufacturer -->
<script type="text/javascript">
    function getAssetsmanufacturer(id){
        show_page_loader();
        $.ajax({
            url: "<?= base_url('assets_manufacturer/get_assets_manufacturer');?>",
            method: "POST",
            data: { id : id },
            success : function(response){
                hide_page_loader();
                var obj = JSON.parse(response);
                if(obj.success == 'true'){
                    console.log(obj.data);
                    $("#update_manufacturer input[name*='id']").val(obj.data.id);
                    $("#update_manufacturer input[name*='name']").val(obj.data.name);
                    $("#update_manufacturer textarea[name*='note']").val(obj.data.note);                                        
                    $("#update_manufacturer").modal("show");
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
    function deleteAssetsmanufacturer(id){
        swal({
            title: "<?php echo R_U_SURE; ?>",
            text: "<?php echo RECOVER_RECORD; ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "<?php echo YES; ?>",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                url: "<?= site_url('assets_manufacturer/delete/'); ?>",
                type: 'post',
                data: {'id': id,'status': 'deleted'},
                success: function (data) {
                    window.location.href = "<?= site_url('assets_manufacturer'); ?>";
                },
                error: function () {
                    window.location.href = "<?= site_url('assets_manufacturer'); ?>";
                }
            });            
        });
    }
</script>

<script type="text/javascript">        
    function delete_returned_item(id){
        swal({
            title: "<?php echo R_U_SURE; ?>",
            text: "<?php echo RECOVER_RECORD; ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "<?php echo YES; ?>",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                url: "<?= site_url('assets_return/delete/'); ?>",
                type: 'post',
                data: {'id': id,'status': 'deleted'},
                success: function (data) {
                    window.location.href = "<?= site_url('assets-return'); ?>";
                },
                error: function () {
                    window.location.href = "<?= site_url('assets-return'); ?>";
                }
            });
        });
    }
</script>