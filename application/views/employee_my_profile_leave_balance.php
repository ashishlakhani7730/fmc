<div id="wrapper">

    <?php include("inc/company_employee_navbar.php") ?>

    <?php include("inc/company_employee_sidebar.php") ?>
    
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Leave Balance</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Leave Balance</li>
                        </ul>
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right"></div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom m-b-0">
                                    <thead>
                                        <tr>
                                            <th>Leave Type</th>
                                            <th>Days/Year</th>
                                            <th>Opening</th>
                                            <th>Used</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($leave_types as $value) { ?>
                                        <tr>
                                            <td><?php echo $value['leave_type_name']; ?></td>
                                            <td><?php echo $value['leave_days']; ?></td>
                                            <td><?php echo $value['opening_balance']; ?></td>
                                            <td><?php echo $value['used_leaves']; ?></td>
                                            <td><?php echo $value['closing_balance']; ?></td>
                                        </tr>
                                    <?php } ?>
                                        
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

<!--moment js-->
<script src="<?= site_url(); ?>assets/js/moment.js"></script> 

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
    $(function() {      
        var form_instance = $('#create-form').parsley();        
    }); 
</script>

