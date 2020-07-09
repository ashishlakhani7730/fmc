<div id="wrapper">

    <?php include("inc/company_navbar.php") ?>

    <?php include("inc/company_sidebar.php") ?>
 
    <style type="text/css">
        .attendance{
            cursor: pointer;
            display: inline-block;
            font-weight: bold;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;
            padding: 5px 7px;
            font-size: 11px;
            line-height: 1.0;
            border-radius: 10px!important;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .attendance-absent{
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .attendance-absent:focus{
            box-shadow: 0 0 0 0.2rem rgba(220,53,69,.5);
        } 
        .attendance-present{
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }
        .attendance-present:focus{
            box-shadow: 0 0 0 0.2rem rgba(40,167,69,.5);
        }
        .attendance-halfday{
            color: #212529;
            background-color: #ffc107;
            border-color: #ffc107;
        }
        .attendance-halfday:focus{
            box-shadow: 0 0 0 0.2rem rgba(255,193,7,.5);            
        }
        button.attendance:focus {outline:0;}
    </style>
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
                        <button type="button" class="btn btn-success">P - Present</button>
                        <button type="button" class="btn btn-danger">A - Absent</button>
                        <button type="button" class="btn btn-warning">H - Half Day</button>
                        
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
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Select Year</label>
                                        <select name="year" class="form-control show-tick ms select2" data-placeholder="Select Year">
                                            <option value="">Select Year</option>
                                            <?php
                                            for ($i=2019; $i < 2025; $i++) { 
                                                $selected = "";
                                                if($year == $i){
                                                    $selected = "selected";
                                                }
                                            ?>
                                            <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                                            <?php    
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Select Month</label>
                                        <select name="month" class="form-control show-tick ms select2" data-placeholder="Select Month">
                                            <option value="">Select Month</option>
                                            <option value="01" <?php echo ($month == "01") ? "selected" : ""; ?>>January</option>
                                            <option value="02" <?php echo ($month == "02") ? "selected" : ""; ?>>February</option>
                                            <option value="03" <?php echo ($month == "03") ? "selected" : ""; ?>>March</option>
                                            <option value="04" <?php echo ($month == "04") ? "selected" : ""; ?>>April</option>
                                            <option value="05" <?php echo ($month == "05") ? "selected" : ""; ?>>May</option>
                                            <option value="06" <?php echo ($month == "06") ? "selected" : ""; ?>>June</option>
                                            <option value="07" <?php echo ($month == "07") ? "selected" : ""; ?>>July</option>
                                            <option value="08" <?php echo ($month == "08") ? "selected" : ""; ?>>August</option>
                                            <option value="09" <?php echo ($month == "09") ? "selected" : ""; ?>>September</option>
                                            <option value="10" <?php echo ($month == "10") ? "selected" : ""; ?>>October</option>
                                            <option value="11" <?php echo ($month == "11") ? "selected" : ""; ?>>November</option>
                                            <option value="12" <?php echo ($month == "12") ? "selected" : ""; ?>>December</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">

                                </div>
                            </div>
                            <div class="table-responsive" style="min-height: 300px;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Employee</th>
                                            <?php for ($i=1; $i <= $month_days; $i++) {?> 
                                            <th class="text-center">
                                            <?php 
                                                $timestamp = strtotime($year.'-'.$month.'-'.$i);
                                                echo $day = date('D', $timestamp);
                                                echo "<br>";
                                                echo $i; 
                                            ?>
                                            </th>     
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(!empty($items)){
                                        foreach ($items as $key => $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo $value['employee_fullname_english']; ?></td>
                                            <?php for ($i=1; $i <= $month_days; $i++) {

                                                if($value['date_'.$i] == 'a'){
                                                    $att_class = "attendance-absent";
                                                }
                                                if($value['date_'.$i] == 'p'){
                                                    $att_class = "attendance-present";
                                                }
                                                if($value['date_'.$i] == 'h'){
                                                    $att_class = "attendance-halfday";
                                                }
                                            ?> 
                                            <td>
                                                <button id="btn_<?php echo $value['id']; ?>_<?php echo $i; ?>" type="button" class="attendance <?php echo $att_class; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo strtoupper($value['date_'.$i]); ?></button>
                                                <div class="dropdown-menu" aria-labelledby="btn_<?php echo $value['id']; ?>_<?php echo $i; ?>">
                                                    <a href="#btn_<?php echo $value['id']; ?>_<?php echo $i; ?>" class="dropdown-item add-attendance" data-id="<?php echo $value['id']; ?>" data-day="<?php echo $i; ?>" data-value="a" style="cursor: pointer;">A - Absent</a>
                                                    <a href="#btn_<?php echo $value['id']; ?>_<?php echo $i; ?>" class="dropdown-item add-attendance" data-id="<?php echo $value['id']; ?>" data-day="<?php echo $i; ?>" data-value="p" style="cursor: pointer;">P - Present</a>
                                                    <a href="#btn_<?php echo $value['id']; ?>_<?php echo $i; ?>" class="dropdown-item add-attendance" data-id="<?php echo $value['id']; ?>" data-day="<?php echo $i; ?>" data-value="h" style="cursor: pointer;">H - Half Day</a>
                                                </div>

                                            </td>
                                            <?php } ?>
                                        </tr>
                                        <?php 
                                        }
                                        }
                                        ?>
                                       
                                    </tbody>
                                </table>
                                <br>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>


<!-- Update Attendance -->
<div class="modal animated jello" id="update_attendance" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="update_attendance_form" action="<?= base_url('holidays/create');?>">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Add new holiday</h4>
            </div>            
            <div class="modal-body">                
                <div class="row clearfix">
                    <div class="form-group col-lg-12 col-md-6">
                        <div class="form-line">
                            <input type="text" name="name" class="form-control" placeholder="Holiday Title">
                        </div>
                    </div>                    
                </div>   
                <div class="row clearfix">
                    <div class="form-group col-lg-12 col-md-6">
                        <div class="form-line">
                            <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="date" placeholder="Date" autocomplete="off" value="" readonly>
                        </div>
                    </div>                
                </div>
                <div class="row clearfix">
                    <div class="form-group col-lg-12 col-md-6">
                        <div class="form-line">
                            <textarea class="form-control" name="description" placeholder="Description"></textarea>
                        </div>
                    </div>                
                </div>
                  
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">CLOSE</button>
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
        $(".add-attendance").click(function(){
            var attendance_id = $(this).attr('data-id');
            var attendance_day = $(this).attr('data-day');
            var attendance_status = $(this).attr('data-value');
            
            var btn_id = "#btn_"+attendance_id+"_"+attendance_day;
            
            $.ajax({
                url: "<?= site_url('manage_attendance/update'); ?>",
                type: 'post',
                data: {
                    'attendance_id': attendance_id,
                    'attendance_day': attendance_day,
                    'attendance_status': attendance_status
                },
                success: function (data) {
                    if($(btn_id).hasClass("attendance-present")){
                        $(btn_id).removeClass("attendance-present");
                    }
                    if($(btn_id).hasClass("attendance-absent")){
                        $(btn_id).removeClass("attendance-absent");
                    }
                    if($(btn_id).hasClass("attendance-halfday")){
                        $(btn_id).removeClass("attendance-halfday");
                    }
                    if(attendance_status == 'a'){
                        $(btn_id).addClass("attendance-absent");                
                    }
                    if(attendance_status == 'p'){
                        $(btn_id).addClass("attendance-present");                
                    }
                    if(attendance_status == 'h'){
                        $(btn_id).addClass("attendance-halfday");                
                    }
                    $(btn_id).html(attendance_status.toUpperCase());
                },
                error: function () {    
                    
                }
            });
            
        });
    });
</script>