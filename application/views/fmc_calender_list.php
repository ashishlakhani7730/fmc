<div id="wrapper">

    <?php include("inc/navbar.php") ?>

    <?php include("inc/sidebar.php") ?>
 

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Calendar</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">
                                <a href="<?= site_url(); ?>fmc_calendar" class="active"><i class="icon-calendar"></i> Calendar View</a>
                                <a href="<?= site_url(); ?>fmc_calendar/list_view" style="margin-left: 15px;" href=""><i class="icon-list"></i> List View</a>
                            </li>                                
                        </ul>
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                                             
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
                        <div class="header">
                            <h2><?php echo CALENDER_LIST_VIEW; ?></h2>
                            <ul class="header-dropdown">
                                <li><a href="<?= site_url(); ?>fmc_calendar/create_event" class="btn btn-info"><?php echo CALENDER_ADD_NEW_EVENT; ?></a></li>
                            </ul>                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th><?php echo CALENDER_EVENT_TITLE; ?></th>
                                            <th><?php echo CALENDER_START_DATE; ?></th>
                                            <th><?php echo CALENDER_END_DATE; ?></th>
                                            <th><?php echo CALENDER_START_TIME; ?></th>
                                            <th><?php echo CALENDER_END_TIME; ?></th>
                                            
                                            <th>***</th>
                                        </tr>
                                    </thead>
                                     
                                    <tbody>
                                         <?php
                                                if(!empty($items)){
                                                    foreach ($items as $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $value['event_title']; ?></td>  
                                                    <td><?php echo $value['event_start_date']; ?></td>  
                                                    <td><?php echo $value['event_end_date']; ?></td>  
                                                    <td><?php echo $value['event_start_time']; ?></td>  
                                                    <td><?php echo $value['event_end_time']; ?></td>  
                                                    
                                                    <td>
                                                        <a href="<?= site_url(); ?>fmc_calendar/event_detail/<?= base64_encode($value['id']);?>">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="View"><i class="fa fa-eye"></i></button>
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteEvents('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-trash"></i></button>
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

<!-- Javascript -->
<script src="<?= site_url(); ?>assets/bundles/libscripts.bundle.js"></script>
<script src="<?= site_url(); ?>assets/bundles/vendorscripts.bundle.js"></script>

<script src="<?= site_url(); ?>assets/bundles/datatablescripts.bundle.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>

<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>

<script type="text/javascript">
    $(function () {
        $('.js-basic-example').DataTable();
    });
</script>
<script type="text/javascript">
function deleteEvents(id){
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
                url: "<?= site_url('fmc_calendar/delete/'); ?>",
                type: 'post',
                data: {'id': id,'status': 'deleted'},
                success: function (data) {
                    window.location.href = "<?= site_url('fmc_calendar/list_view'); ?>";
                },
                error: function () {
                    window.location.href = "<?= site_url('fmc_calendar/list_view'); ?>";
                }
            });            
        });
    }
</script>





