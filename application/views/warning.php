<div id="wrapper">

    <?php include("inc/company_navbar.php") ?>

    <?php include("inc/company_sidebar.php") ?>
 
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo WARNING_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active"><?php echo WARNING_LIST; ?></li>
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
                    <div class="header">
                        <ul class="header-dropdown">
                            <li>
                                <a href="<?= site_url(); ?>warning/create" class="btn btn-primary" title="Add"><?php echo WARNING_ADD_NEW; ?></a>
                            </li>
                        </ul>                            
                    </div>                       
                    <div class="body">
                        <div class="table-responsive">  
                            <table class="table table-hover js-basic-example dataTable table-custom">
                                <thead class="thead-dark">
                                    <tr>
                                        <th><?php echo WARNING_USER; ?></th>
                                        <th><?php echo WARNING_CATEGORY; ?></th>
                                        <th><?php echo WARNING_TITLE_LIST; ?></th>
                                        <th><?php echo WARNING_DESCRIPTION_LIST; ?></th>
                                        <th><?php echo WARNING_DATE_TIME; ?></th>
                                        <th>***</th>
                                    </tr>
                                </thead>                                            
                                <tbody>
                                    <?php
                                    if(!empty($warning_list)){
                                    foreach ($warning_list as $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $value['fullname_english'].' '.$value['fullname_arabic']; ?></td>
                                        <td><?php echo $value['title_en'] .' '.$value['title_ar'] ; ?></td>
                                        <td><?php echo $value['title']; ?></td>
                                        <td><?php echo $value['description']; ?></td>
                                        <td> <?php echo date("d-m-Y H:i:s",strtotime($value['date_time'])) ?> </td>
                                        <td>
                                            <a href="<?= site_url(); ?>warning/update/<?php echo base64_encode($value['employee_warning_id']); ?>" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>
                                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteWarning('<?php echo $value['employee_warning_id']; ?>');" title="Edit"><i class="fa fa-trash"></i></button>
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

    function deleteWarning(id){
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
                url: "<?= site_url('warning/delete/'); ?>",
                type: 'post',
                data: {'employee_warning_id': id,'status': 'deleted'},
                success: function (data) {
                    window.location.href = "<?= site_url('warning'); ?>";
                },
                error: function () {
                    window.location.href = "<?= site_url('warning'); ?>";
                }
            });            
        });
    }
</script>
