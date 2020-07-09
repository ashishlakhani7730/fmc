<div id="wrapper">
<?php include("inc/company_employee_navbar.php") ?>

<?php include("inc/company_employee_sidebar.php") ?>
 
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
                                <li class="nav-item"><a class="nav-link <?php echo ($current_tab == 'current') ? 'active show' : ''; ?>" data-toggle="tab" href="#Assigned-assets"><?php echo ASSETS_CURRENT; ?></a></li>
                                <li class="nav-item"><a class="nav-link <?php echo ($current_tab == 'past') ? 'active show' : ''; ?>" data-toggle="tab" href="#Retun-assets"><?php echo ASSETS_PAST; ?></a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane <?php echo ($current_tab == 'current') ? 'active show' : ''; ?>" id="Assigned-assets">
                                    <div class="header">
                                        <h2><?php echo ASSETS_CURRENT; ?></h2>                         
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
                                                if(!empty($assets_assign_current)){
                                                foreach ($assets_assign_current as $value) {

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
                                                        <a href="<?= site_url(); ?>assets_employee/view/<?php echo base64_encode($value['id']); ?>" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="fa fa-eye"></i></a>
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
                                <div class="tab-pane <?php echo ($current_tab == 'past') ? 'active show' : ''; ?>" id="Retun-assets">
                                    <div class="header">
                                        <h2><?php echo ASSETS_PAST; ?></h2>                        
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
                                                if(!empty($assets_assign_past)){
                                                    foreach ($assets_assign_past as $value) {

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
                                                                <a href="<?= site_url(); ?>assets_employee/view/<?php echo base64_encode($value['id']); ?>" class="btn btn-sm btn-outline-secondary" title="Edit">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
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
