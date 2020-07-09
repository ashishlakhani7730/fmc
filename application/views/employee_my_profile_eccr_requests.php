<div id="wrapper">
    <?php include("inc/company_employee_navbar.php") ?>
    
    <?php include("inc/company_employee_sidebar.php") ?>
    
    <div id="main-content">        
        <div class="container-fluid">
            <form action="<?= base_url('myprofile/emergency_contacts');?>" id="create-employee" method="post" novalidate enctype="multipart/form-data">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-sm-12">
                            <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>ECCR Requests</h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                                <li class="breadcrumb-item active">ECCR Requests</li>
                            </ul>
                        </div>            
                        <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                            <a href="<?= site_url(); ?>eccr-requests/create" class="btn btn-info">Create ECCR Request</a>
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
                        <div class="card planned_task">
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-hover js-basic-example dataTable table-custom m-b-0">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Request Type</th>
                                                <th>Status</th>
                                                <th>Created-At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!empty($eccr_requests)){
                                        foreach ($eccr_requests as $key => $item) {
                                            if($item['request_status'] == "created"){
                                                $request_status_class = "badge-default";
                                            }
                                            if($item['request_status'] == "in_approval"){
                                                $request_status_class = "badge-default";
                                            }
                                            if($item['request_status'] == "approved"){
                                                $request_status_class = "badge-success";             
                                            }
                                            if($item['request_status'] == "declined" || $item['request_status'] == "deleted"){
                                                $request_status_class = "badge-danger";
                                            }
                                        ?>
                                        <tr>
                                            <td><?php echo $item['title']; ?></td>
                                            <td>
                                            <?php 
                                            if($item['request_type'] == 'position_change'){
                                                echo "POSITION CHANGE";
                                            }
                                            if($item['request_type'] == 'allowances_add'){
                                                echo "ADD ALLOWANCES";
                                            }
                                            if($item['request_type'] == 'allowances_descrease'){
                                                echo "DESCREASE ALLOWANCES";
                                            }
                                            if($item['request_type'] == 'salary_increment'){
                                                echo "SALARY INCREMENT";
                                            }
                                            if($item['request_type'] == 'location_change'){
                                                echo "LOCATION CHANGE";
                                            }
                                            if($item['request_type'] == 'department_change'){
                                                echo "DEPARTMENT CHANGE";
                                            }
                                            if($item['request_type'] == 'temporary_relocation'){
                                                echo "TEMPORARY RELOCATION";
                                            }
                                            ?>
                                            <td>
                                                <span class="badge <?php echo $request_status_class; ?>"><?php echo $item['request_status']; ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('d/m/Y',strtotime($item['created_at'])) ?></td>
                                            <td>
                                                <a href="<?= site_url(); ?>eccr-request/details/<?php echo base64_encode($item['id']); ?>"><button type="button" class="btn btn-info"><i class="fa fa-eye"></i></button></a>
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
                <br>
                <br>
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

<!-- Multi Select Dropdown -->
<script src="<?= site_url(); ?>assets/vendor/multi-select/js/jquery.multi-select.js"></script> 
<script src="<?= site_url(); ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>

<!-- Form Validation -->
<script src="<?= site_url(); ?>assets/vendor/parsleyjs/js/parsley.min.js"></script>

<!-- Date-Picker Time-Picker -->
<script src="<?= site_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 

<!-- Ckeditor --> 
<script src="<?= site_url(); ?>assets/vendor/ckeditor/ckeditor.js"></script> 


<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script>
