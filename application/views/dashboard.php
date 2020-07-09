<div id="wrapper">

    <?php include("inc/navbar.php") ?>

    <?php include("inc/sidebar.php") ?>
 

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> <?php echo DASHBOARD_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active"><?php echo DASHBOARD_TITLE; ?></li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right"></div>
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
                        <div class="header">
                            <h2><?php echo DASHBOARD_REQUESTS; ?></h2>
                        </div>
                        <div class="body">
                            <ul class="nav nav-tabs-new2">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#primary_requests"><?php echo DASHBOARD_PRIMARY_REQUEST; ?></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#other_requests"><?php echo DASHBOARD_OTHER_REQUEST; ?></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#closed_requests"><?php echo DASHBOARD_APPROVED_REQUEST; ?></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#declined_requests"><?php echo DASHBOARD_DECLINED_REQUEST; ?></a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="primary_requests">
                                    <div class="table-responsive">
                                    <table class="table table-hover js-basic-example dataTable table-custom">
                                        <thead>
                                            <tr>
                                                <th><?php echo DASHBOARD_REQUEST_TYPE; ?></th>
                                                <th><?php echo DASHBOARD_COMPANY_NAME; ?></th>
                                                <th><?php echo DASHBOARD_EMPLOYEE_NAME; ?></th>
                                                <th><?php echo DASHBOARD_CREATED_AT; ?></th>
                                                <th>***</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        foreach ($primary_requests as $primary_request_value) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php 
                                                    if($primary_request_value['request_type'] == 'overtime'){
                                                        echo "<b>OVER-TIME</b>";
                                                    }
                                                    if($primary_request_value['request_type'] == 'leave'){
                                                        echo "<b>LEAVE</b>";
                                                    }
                                                    if($primary_request_value['request_type'] == 'business_trip'){
                                                        echo "<b>BUSINESS-TRIP</b>";
                                                    }
                                                    if($primary_request_value['request_type'] == 'eccr'){
                                                        echo "<b>ECCR</b>";
                                                    }
                                                    if($primary_request_value['request_type'] == 'general'){
                                                        echo "<b>GENERAL</b>";
                                                    }
                                                    if($primary_request_value['request_type'] == 'client_confirmation'){
                                                        echo "<b>CLIENT-CONFIRMATION</b>";
                                                    }

                                                    if($primary_request_value['request_type'] == 'employee_confirmation'){
                                                        echo "<b>EMPLOYEE-CONFIRMATION</b>";
                                                    }
                                                    if($primary_request_value['request_type'] == 'payroll_confirmation'){
                                                        echo "<b>PAYROLL-CONFIRMATION</b>";
                                                    }
                                                    if($primary_request_value['request_type'] == 'employee_education'){
                                                        echo "<b>EDUCATION</b>";
                                                    }
                                                    if($primary_request_value['request_type'] == 'work_experience'){
                                                        echo "<b>WORK-EXPERIENCE</b>";
                                                    }
                                                    
                                                    ?>
                                                </td>
                                                <td><?php echo $primary_request_value['company_name_english']; ?></td>
                                                <td><?php echo $primary_request_value['emp_fullname_english']; ?></td>
                                                <td><?php echo date('d/m/Y',strtotime($primary_request_value['modified_at'])); ?></td>
                                                <td>   
                                                    <?php if($primary_request_value['request_type'] == 'client_confirmation'){ ?>
                                                        <a href="<?= site_url(); ?>confirm-client-request-details/<?= base64_encode($primary_request_value['id']);?>" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="fa fa-eye"></i></a>
                                                    <?php }elseif($primary_request_value['request_type'] == 'employee_confirmation'){ ?>

                                                        <a href="<?= site_url(); ?>requests/confirm_employee_request_details/<?= base64_encode($primary_request_value['id']);?>" class="btn btn-info" title="Edit"><i class="fa fa-eye"></i></a>
                                                    <?php }elseif($primary_request_value['request_type'] == 'payroll_confirmation'){ ?>

                                                        <a href="<?= site_url(); ?>confirm-company-payroll-request/<?= base64_encode($primary_request_value['id']);?>" class="btn btn-info" title="Edit"><i class="fa fa-eye"></i></a>
                                                    <?php }else{ ?>
                                                        <a href="<?= site_url(); ?>compnay-request-details/<?= base64_encode($primary_request_value['id']);?>" class="btn btn-info" title="Edit"><i class="fa fa-eye"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                <div class="tab-pane show" id="other_requests">
                                    <div class="table-responsive">
                                    <table class="table table-hover js-basic-example dataTable table-custom">
                                        <thead>
                                            <tr>
                                                <th><?php echo DASHBOARD_REQUEST_TYPE; ?></th>
                                                <th><?php echo DASHBOARD_COMPANY_NAME; ?></th>
                                                <th><?php echo DASHBOARD_EMPLOYEE_NAME; ?></th>
                                                <th><?php echo DASHBOARD_CREATED_AT; ?></th>
                                                <th>***</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        foreach ($other_requests as $other_request_value) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php 
                                                    if($other_request_value['request_type'] == 'overtime'){
                                                        echo "<b>OVER-TIME</b>";
                                                    }
                                                    if($other_request_value['request_type'] == 'leave'){
                                                        echo "<b>LEAVE</b>";
                                                    }
                                                    if($other_request_value['request_type'] == 'business_trip'){
                                                        echo "<b>BUSINESS-TRIP</b>";
                                                    }
                                                    if($other_request_value['request_type'] == 'eccr'){
                                                        echo "<b>ECCR</b>";
                                                    }
                                                    if($other_request_value['request_type'] == 'general'){
                                                        echo "<b>GENERAL</b>";
                                                    }
                                                    if($other_request_value['request_type'] == 'client_confirmation'){
                                                        echo "<b>CLIENT-CONFIRMATION</b>";
                                                    }
                                                    if($other_request_value['request_type'] == 'employee_confirmation'){
                                                        echo "<b>EMPLOYEE-CONFIRMATION</b>";
                                                    }
                                                    if($other_request_value['request_type'] == 'payroll_confirmation'){
                                                        echo "<b>PAYROLL-CONFIRMATION</b>";
                                                    }
                                                    if($other_request_value['request_type'] == 'employee_education'){
                                                        echo "<b>EDUCATION</b>";
                                                    }
                                                    if($other_request_value['request_type'] == 'work_experience'){
                                                        echo "<b>WORK-EXPERIENCE</b>";
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $other_request_value['company_name_english']; ?></td>
                                                <td><?php echo $other_request_value['emp_fullname_english']; ?></td>
                                                <td><?php echo date('d/m/Y',strtotime($other_request_value['modified_at'])); ?></td>
                                                <td>   
                                                    <?php if($other_request_value['request_type'] == 'client_confirmation'){ ?>
                                                        <a href="<?= site_url(); ?>confirm-client-request-details/<?= base64_encode($other_request_value['id']);?>" class="btn btn-info" title="Edit"><i class="fa fa-eye"></i></a>
                                                    <?php }elseif($other_request_value['request_type'] == 'employee_confirmation'){ ?>

                                                        <a href="<?= site_url(); ?>requests/confirm_employee_request_details/<?= base64_encode($other_request_value['id']);?>" class="btn btn-info" title="Edit"><i class="fa fa-eye"></i></a>
                                                    <?php }elseif($other_request_value['request_type'] == 'payroll_confirmation'){ ?>

                                                        <a href="<?= site_url(); ?>confirm-company-payroll-request/<?= base64_encode($other_request_value['id']);?>" class="btn btn-info" title="Edit"><i class="fa fa-eye"></i></a>
                                                    <?php }else{ ?>
                                                        <a href="<?= site_url(); ?>compnay-request-details/<?= base64_encode($other_request_value['id']);?>" class="btn btn-info" title="Edit"><i class="fa fa-eye"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                <div class="tab-pane show" id="closed_requests">
                                    <div class="table-responsive">
                                    <table class="table table-hover js-basic-example dataTable table-custom">
                                        <thead>
                                            <tr>
                                                <th><?php echo DASHBOARD_REQUEST_TYPE; ?></th>
                                                <th><?php echo DASHBOARD_COMPANY_NAME; ?></th>
                                                <th><?php echo DASHBOARD_EMPLOYEE_NAME; ?></th>
                                                <th><?php echo DASHBOARD_CREATED_AT; ?></th>
                                                <th>***</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        foreach ($closed_requests as $closed_request_value) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php 
                                                    if($closed_request_value['request_type'] == 'overtime'){
                                                        echo "<b>OVER-TIME</b>";
                                                    }
                                                    if($closed_request_value['request_type'] == 'leave'){
                                                        echo "<b>LEAVE</b>";
                                                    }
                                                    if($closed_request_value['request_type'] == 'business_trip'){
                                                        echo "<b>BUSINESS-TRIP</b>";
                                                    }
                                                    if($closed_request_value['request_type'] == 'eccr'){
                                                        echo "<b>ECCR</b>";
                                                    }
                                                    if($closed_request_value['request_type'] == 'general'){
                                                        echo "<b>GENERAL</b>";
                                                    }
                                                    if($closed_request_value['request_type'] == 'client_confirmation'){
                                                        echo "<b>CLIENT-CONFIRMATION</b>";
                                                    }
                                                    if($closed_request_value['request_type'] == 'employee_confirmation'){
                                                        echo "<b>EMPLOYEE-CONFIRMATION</b>";
                                                    }
                                                    if($closed_request_value['request_type'] == 'payroll_confirmation'){
                                                        echo "<b>PAYROLL-CONFIRMATION</b>";
                                                    }
                                                    if($closed_request_value['request_type'] == 'employee_education'){
                                                        echo "<b>EDUCATION</b>";
                                                    }
                                                    if($closed_request_value['request_type'] == 'work_experience'){
                                                        echo "<b>WORK-EXPERIENCE</b>";
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $closed_request_value['company_name_english']; ?></td>
                                                <td><?php echo $closed_request_value['emp_fullname_english']; ?></td>
                                                <td><?php echo date('d/m/Y',strtotime($closed_request_value['modified_at'])); ?></td>
                                                <td>   
                                                    <?php 
                                                    if($closed_request_value['request_type'] == 'client_confirmation'){ ?>
                                                        <a href="<?= site_url(); ?>client-request-details/<?= base64_encode($closed_request_value['id']);?>" class="btn btn-info" title="Edit"><i class="fa fa-eye"></i></a>
                                                    <?php }elseif($closed_request_value['request_type'] == 'employee_confirmation'){ ?>

                                                        <a href="<?= site_url(); ?>requests/confirm_employee_request_details/<?= base64_encode($closed_request_value['id']);?>" class="btn btn-info" title="Edit"><i class="fa fa-eye"></i></a>
                                                    <?php }elseif($closed_request_value['request_type'] == 'payroll_confirmation'){ ?>

                                                        <a href="<?= site_url(); ?>confirm-company-payroll-request/<?= base64_encode($closed_request_value['id']);?>" class="btn btn-info" title="Edit"><i class="fa fa-eye"></i></a>
                                                    <?php }else{ ?>
                                                        <a href="<?= site_url(); ?>compnay-request-details/<?= base64_encode($closed_request_value['id']);?>" class="btn btn-info" title="Edit"><i class="fa fa-eye"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                <div class="tab-pane show" id="declined_requests">
                                    <div class="table-responsive">
                                    <table class="table table-hover js-basic-example dataTable table-custom">
                                        <thead>
                                            <tr>
                                                <th><?php echo DASHBOARD_REQUEST_TYPE; ?></th>
                                                <th><?php echo DASHBOARD_COMPANY_NAME; ?></th>
                                                <th><?php echo DASHBOARD_EMPLOYEE_NAME; ?></th>
                                                <th><?php echo DASHBOARD_CREATED_AT; ?></th>
                                                <th>***</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        foreach ($declined_requests as $declined_request_value) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php 
                                                    if($declined_request_value['request_type'] == 'overtime'){
                                                        echo "<b>OVER-TIME</b>";
                                                    }
                                                    if($declined_request_value['request_type'] == 'leave'){
                                                        echo "<b>LEAVE</b>";
                                                    }
                                                    if($declined_request_value['request_type'] == 'business_trip'){
                                                        echo "<b>BUSINESS-TRIP</b>";
                                                    }
                                                    if($declined_request_value['request_type'] == 'eccr'){
                                                        echo "<b>ECCR</b>";
                                                    }
                                                    if($declined_request_value['request_type'] == 'general'){
                                                        echo "<b>GENERAL</b>";
                                                    }
                                                    if($declined_request_value['request_type'] == 'client_confirmation'){
                                                        echo "<b>CLIENT-CONFIRMATION</b>";
                                                    }
                                                    if($declined_request_value['request_type'] == 'employee_confirmation'){
                                                        echo "<b>EMPLOYEE-CONFIRMATION</b>";
                                                    }
                                                    if($declined_request_value['request_type'] == 'payroll_confirmation'){
                                                        echo "<b>PAYROLL-CONFIRMATION</b>";
                                                    }
                                                    if($declined_request_value['request_type'] == 'employee_education'){
                                                        echo "<b>EDUCATION</b>";
                                                    }
                                                    if($declined_request_value['request_type'] == 'work_experience'){
                                                        echo "<b>WORK-EXPERIENCE</b>";
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $declined_request_value['company_name_english']; ?></td>
                                                <td><?php echo $declined_request_value['emp_fullname_english']; ?></td>
                                                <td><?php echo date('d/m/Y',strtotime($declined_request_value['modified_at'])); ?></td>
                                                <td>   
                                                    <?php if($declined_request_value['request_type'] == 'client_confirmation'){ ?>
                                                        <a href="<?= site_url(); ?>client-request-details/<?= base64_encode($declined_request_value['id']);?>" class="btn btn-info" title="Edit"><i class="fa fa-eye"></i></a>
                                                    <?php }elseif($declined_request_value['request_type'] == 'employee_confirmation'){ ?>

                                                        <a href="<?= site_url(); ?>requests/confirm_employee_request_details/<?= base64_encode($declined_request_value['id']);?>" class="btn btn-info" title="Edit"><i class="fa fa-eye"></i></a>
                                                    <?php }elseif($declined_request_value['request_type'] == 'payroll_confirmation'){ ?>

                                                        <a href="<?= site_url(); ?>confirm-company-payroll-request/<?= base64_encode($declined_request_value['id']);?>" class="btn btn-info" title="Edit"><i class="fa fa-eye"></i></a>
                                                    <?php }else{ ?>
                                                        <a href="<?= site_url(); ?>compnay-request-details/<?= base64_encode($declined_request_value['id']);?>" class="btn btn-info" title="Edit"><i class="fa fa-eye"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php
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


<!-- Common Javascript Library Included jquery-3.3.1.min.js,popper.min.js,bootstrap.js -->
<script src="<?= site_url(); ?>assets/bundles/libscripts.bundle.js"></script>
<!-- Common Javascript Library metisMenu.js,jquery.slimscroll.min.js,bootstrap-progressbar.min.js,jquery.sparkline.min.js -->
<script src="<?= site_url(); ?>assets/bundles/vendorscripts.bundle.js"></script>

<!-- Search Drondown .select2 -->
<script src="<?= site_url(); ?>assets/vendor/select2/select2.min.js"></script>

<script src="<?= site_url(); ?>assets/bundles/datatablescripts.bundle.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>

<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 


<script type="text/javascript">
    $(function () {
        $('.js-basic-example').DataTable();
    });
</script>