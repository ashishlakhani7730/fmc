<div id="wrapper">

    <?php include("inc/navbar.php") ?>

    <?php include("inc/sidebar.php") ?>
 

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Notifications</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>notifications"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Notifications</li>
                        </ul>                         
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                                             
                    </div>
                </div>
            </div>           
            
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">                        
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th width="25%">Type</th>
                                            <th width="50%">Description</th>
                                            <th width="20%">Date</th>
                                            <th width="5%">***</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    foreach ($items as $item) {
                                        $created_at = $item['created_at'];
                                    ?>
                                        <tr>
                                            <td>
                                                <?php 
                                                if($item['type'] == 'overtime'){
                                                    echo "<b>OVER-TIME</b>";
                                                }
                                                if($item['type'] == 'leave'){
                                                    echo "<b>LEAVE</b>";
                                                }
                                                if($item['type'] == 'business_trip'){
                                                    echo "<b>BUSINESS-TRIP</b>";
                                                }
                                                if($item['type'] == 'eccr'){
                                                    echo "<b>ECCR</b>";
                                                }
                                                if($item['type'] == 'general'){
                                                    echo "<b>GENERAL</b>";
                                                }
                                                if($item['type'] == 'client_confirmation'){
                                                    echo "<b>CLIENT-CONFIRMATION</b>";
                                                }
                                                if($item['type'] == 'client_confirmation_request_update'){
                                                    echo "<b>CLIENT-CONFIRMATION</b>";
                                                }
                                                if($item['type'] == 'employee_confirmation'){
                                                    echo "<b>EMPLOYEE-CONFIRMATION</b>";
                                                } 
                                                if($item['type'] == 'employee_confirmation_request_update'){
                                                    echo "<b>EMPLOYEE-CONFIRMATION</b>";
                                                }  
                                                if($item['type'] == 'payroll_confirmation'){
                                                    echo "<b>PAYROLL-CONFIRMATION</b>";
                                                }                                                
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo ($fmc_language == 'english') ? $item['title_en'] : $item['title_ar']; ?>
                                            </td>
                                            <td>
                                                <?php echo date("d-m-Y h:i A",strtotime($created_at)); ?>
                                            </td>
                                            <td>
                                                <?php if($item['type'] == 'client_confirmation'){ ?>
                                                    <a href="<?= site_url(); ?>confirm-client-request-details/<?= base64_encode($item['request_id']);?>" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="fa fa-eye"></i></a>
                                                <?php }elseif($item['type'] == 'client_confirmation_request_update'){ ?>

                                                    <a href="<?= site_url(); ?>clients/view/<?= base64_encode($item['company_id']);?>" class="btn btn-info" title="Edit"><i class="fa fa-eye"></i></a>
                                                <?php }elseif($item['type'] == 'employee_confirmation'){ ?>

                                                    <a href="<?= site_url(); ?>requests/confirm_employee_request_details/<?= base64_encode($item['request_id']);?>" class="btn btn-info" title="Edit"><i class="fa fa-eye"></i></a>
                                                <?php }elseif($item['type'] == 'employee_confirmation_request_update'){ ?>
                                                    <a href="<?= site_url(); ?>employees" class="btn btn-info" title="Edit"><i class="fa fa-eye"></i></a>
                                                <?php }elseif($item['type'] == 'payroll_confirmation'){ ?>

                                                    <a href="<?= site_url(); ?>confirm-company-payroll-request/<?= base64_encode($item['request_id']);?>" class="btn btn-info" title="Edit"><i class="fa fa-eye"></i></a>
                                                <?php }else{ ?>
                                                    <a href="<?= site_url(); ?>compnay-request-details/<?= base64_encode($item['request_id']);?>" class="btn btn-info" title="Edit"><i class="fa fa-eye"></i></a>
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


<!-- Default Size -->
<div class="modal animated jello" id="addevent" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Add Event</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-line">
                        <input type="number" class="form-control" placeholder="Event Date">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" class="form-control" placeholder="Event Title">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <textarea class="form-control no-resize" rows="4" placeholder="Event Description..."></textarea>
                    </div>
                </div>       
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">CLOSE</button>
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









