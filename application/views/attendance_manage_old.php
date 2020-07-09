<div id="wrapper">

    <?php include("inc/company_navbar.php") ?>

    <?php include("inc/company_sidebar.php") ?>
 

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Manage Attendance</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Manage Attendance</li>
                        </ul>                        
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                        <a href="javascript:void(0);" class="btn btn-info" data-toggle="modal" data-target="#single_checkin">Single Check In</a>
                        <a href="javascript:void(0);" class="btn btn-info" data-toggle="modal" data-target="#bulk_checkin">Bulk Check In</a>
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
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Emp. Name</th>
                                            <th>Emp. ID</th>
                                            <th>Date</th>
                                            <th>Check-In</th>
                                            <th>Checkout</th>
                                            <th>Stay</th>
                                            <th>***</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    if(!empty($items)){
                                        foreach ($items as $key => $value) { 
                                            $date = (isset($value) && $value['date'] != "") ? $value['date'] : '0000-00-00';
                                            $date = explode("-", $date);
                                            $date = $date[2]."-".$date[1]."-".$date[0];
                                            if($date == '00-00-0000'){
                                                $date = "";
                                            }
                                    ?>
                                        <tr>
                                            <td><?php echo $value['employee_fullname_english']; ?></td>
                                            <td>-</td>
                                            <td><?php echo $date; ?></td>
                                            <td><?php echo $value['check_in']; ?></td>
                                            <td><?php echo $value['checkout']; ?></td>
                                            <td><?php echo $value['staytime']; ?></td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <button type="button" class="btn btn-outline-secondary"><i class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-outline-danger"><i class="fa fa-trash"></i></button>
                                                </div>
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


<!-- Single Check-In -->
<div class="modal animated fadeIn" id="single_checkin" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form id="check_in_form" class="form-auth-small" action="<?= base_url('manage_attendance/single_checkin');?>" method="post">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Attendance Single Check In</h6>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-6">
                        <div class="form-group">
                            <label>Employee</label>
                            <select name="employee_id" class="form-control show-tick ms select2" data-placeholder="Select" required>
                                <option value="">Select Employee</option>
                                <?php
                                if(!empty($employees)){
                                    foreach ($employees as $key => $value) { ?>
                                    ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['fullname_english']; ?></option>
                                    <?php 
                                    }
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <div class="form-group">
                            <label>Date</label>
                            <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="date" placeholder="Date" autocomplete="off" value="" required readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <label>Check In (24 hour)</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-clock"></i></span>
                            </div>
                            <input type="text" name="check_in" class="form-control time24" placeholder="Ex: 23:59" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <label>Checkout (24 hour)</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-clock"></i></span>
                            </div>
                            <input type="text" name="checkout" class="form-control time24" placeholder="Ex: 23:59" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Check In</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Bulk Check-In -->
<div class="modal animated fadeIn" id="bulk_checkin" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form class="form-auth-small" action="<?= base_url('manage_attendance/single_checkin');?>" method="post">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Attendance Bulk Check In</h6>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-6">
                        <h6>You can import test.csv file Example</h6>
                        <p style="margin-bottom: 0;">employee_id,date,sign_in,sign_out,staytime</p>
                        <p style="margin-bottom: 0;">EY2T1OWA,2018-10-07,12:14,05:07,04:59</p>
                        <p>EY2T1OWA,2018-10-07,12:14,05:07,04:59</p>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <div class="form-group">
                            <label>Upload CSV</label>
                            <input type="file" name="attendance_csv">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Check In</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
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

<!-- Jquery Datatables -->
<script src="<?= site_url(); ?>assets/bundles/datatablescripts.bundle.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>

<!-- Form Validation -->
<script src="<?= site_url(); ?>assets/vendor/parsleyjs/js/parsley.min.js"></script>

<!-- Date-Picker Time-Picker -->
<script src="<?= site_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<!-- Ckeditor --> 
<script src="<?= site_url(); ?>assets/vendor/ckeditor/ckeditor.js"></script> 

<!-- bootstrap treeview -->
<script src="<?= site_url(); ?>assets/vendor/bootstrap-treeview/bootstrap-treeview.min.js"></script>

<!-- Input Mask Plugin Js --> 
<script src="<?= site_url(); ?>assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js"></script> 
<script src="<?= site_url(); ?>assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js"></script>

<!-- SweetAlert For Dialog Box --> 
<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script> 

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 


<script type="text/javascript">

function deleteItem(id)
{
    swal({
            title: "Are you sure?",
            text: "You will not be able to recover this record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
    }, function () {
        show_page_loader();
        $.ajax({
            url: "<?= site_url('jobopenings/delete/'); ?>",
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
    });
}
</script>
<script type="text/javascript">
    $(function () {      
        //checkin form validation initialize
        $('#check_in_form').parsley();

        $('.js-basic-example').DataTable();

        $('.time24').inputmask('hh:mm', { placeholder: '__:__ _m', alias: 'time24', hourFormat: '24' });
    });
</script>