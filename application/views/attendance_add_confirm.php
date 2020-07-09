<div id="wrapper">

    <?php include("inc/company_navbar.php") ?>

    <?php include("inc/company_sidebar.php") ?>

    <?php 
    //Load Attendance Model
    $CI->load->model('attendance_model');
    ?>
 
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
        .attendance-holiday{
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
        .attendance-holiday:focus{
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.5);
        } 
        .attendance-off{
            color: #777;
            background-color: #fff;
            border-color: #eee;
        }
        .attendance-off:focus{
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
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
        .attendance-full-leave{
            color: #fff;
            background-color: #343a40;
            border-color: #343a40;
        }
        .attendance-full-leave:focus{
            box-shadow: 0 0 0 0.2rem rgba(52,58,64,.5);
        }
        button.attendance:focus {outline:0;}
    </style>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo ATTANDANCE_ADD_CONFIRM_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">
                                <a href="<?= site_url(); ?>attendance"><?php echo ATTANDANCE_ADD_CONFIRM_BREADCRUMBS_TITLE_1; ?></a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="<?= site_url(); ?>attendance/add"><?php echo ATTANDANCE_ADD_CONFIRM_BREADCRUMBS_TITLE_2; ?></a>
                            </li>
                            <li class="breadcrumb-item active"><?php echo ATTANDANCE_ADD_CONFIRM_BREADCRUMBS_TITLE_3; ?></li>
                        </ul>                        
                    </div>            
                    <div class="col-lg-8 col-md-8 col-sm-12 text-right">
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
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Year: <?php echo $year; ?></label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Month: <?php echo $month; ?></label>
                                    </div>
                                </div>
                                <div class="col-md-10 text-right">
                                    <button type="button" class="btn btn-default">OFF - Working Off</button>
                                    <button type="button" class="btn btn-success"><?php echo ATTANDANCE_PRESENT; ?></button>
                                    <button type="button" class="btn btn-danger"><?php echo ATTANDANCE_ABSENT; ?></button>
                                    <button type="button" class="btn btn-warning"><?php echo ATTANDANCE_HALF_DAY; ?></button>
                                    <button type="button" class="btn btn-dark"><?php echo ATTANDANCE_FULL_DAY; ?></button>
                                    <button type="button" class="btn btn-primary"><?php echo ATTANDANCE_HOLIDAY; ?></button>
                                </div>
                            </div>
                            <form action="<?= base_url('attendance/save_data');?>" id="add_attendance_form" method="post" novalidate>
                                <input type="hidden" name="attendance_year" value="<?php echo $year; ?>">
                                <input type="hidden" name="attendance_month" value="<?php echo $month; ?>">
                            <div class="table-responsive" style="min-height: 300px;">
                                
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?php echo ATTANDANCE_EMPLOYEE; ?></th>
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
                                    if(!empty($employees)){
                                        foreach ($employees as $value) {
                                            $employee_id = $value['id'];
                                    ?>    
                                        <input type="hidden" name="employee_id[]" value="<?php echo $employee_id; ?>">
                                        <tr>
                                            <td>
                                                <?php echo $value['fullname_english']; ?>
                                            </td>
                                            <?php 
                                            $i = 1;
                                            foreach ($value['attendance'] as $key => $att_value) {
                                            ?>
                                            <td>
                                            <?php 
                                                if(!empty($att_value)){
                                                    if($att_value == 'OFF'){
                                                        $att_class = "attendance-off";
                                                    }
                                                    if($att_value == 'P'){
                                                        $att_class = "attendance-present";
                                                    }
                                                    if($att_value == 'H'){
                                                        $att_class = "attendance-holiday";
                                                    }
                                                    if($att_value == 'HL'){
                                                        $att_class = "attendance-halfday";
                                                    }
                                                    if($att_value == 'FL'){
                                                        $att_class = "attendance-full-leave";
                                                    }
                                            ?>
                                                    <input type="hidden" id="<?php echo $employee_id; ?>-<?php echo $key; ?>-input" name="<?php echo $employee_id; ?>-<?php echo $key; ?>" value="<?php echo $att_value; ?>">
                                                    <button id="<?php echo $employee_id; ?>-<?php echo $key; ?>-btn" data-id="<?php echo $employee_id; ?>-<?php echo $key; ?>" data-day="<?php echo $i; ?>" data-value="<?php echo $att_value; ?>" type="button" class="attendance <?php echo $att_class; ?>">
                                                        <?php echo strtoupper($att_value); ?>
                                                    </button>
                                            <?php
                                                }
                                            ?>
                                                
                                            </td>
                                            <?php   
                                                $i++;
                                            }                                            
                                            ?>
                                        </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div> 
                            <br>
                            <br> 
                            <button type="submit" class="btn btn-success">Confirm</button>
                            <a href="<?= site_url(); ?>attendance" class="btn btn-danger">
                                    <?php echo ATTANDANCE_ADD_CANCEL_BTN; ?>
                            </a>       
                            </form>
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
            <div class="modal-header">
                <h4 class="title"><?php echo ATTANDANCE_UPDATE; ?></h4>
            </div>            
            <form method="get" id="update_attendance_form" action="<?= base_url('attendance');?>" enctype="multipart/form-data">
                <input type="hidden" name="attendance_id" id="attendance_id">
            <div class="modal-body">                
                <div class="row clearfix">
                    <div class="form-group col-lg-12 col-md-6">
                        <div class="form-line">
                            <select name="attendance_status" id="attendance_status" class="form-control show-tick ms select2" data-placeholder="Select Attendance" required>
                                <option value=""><?php echo ATTANDANCE_SELECT_ATTANDANCE; ?></option>
                                <option value="OFF">Working Off</option>
                                <option value="A"><?php echo ATTANDANCE_SELECT_ABSENT; ?></option>
                                <option value="P"><?php echo ATTANDANCE_SELECT_PRESENT; ?></option>
                                <option value="HL"><?php echo ATTANDANCE_SELECT_HALF_DAY; ?></option>
                                <option value="FL"><?php echo ATTANDANCE_SELECT_FULL_DAY; ?></option>
                                <option value="H">Holiday</option>
                            </select>
                        </div>
                    </div>                    
                </div>   
                <div class="row clearfix">
                    <div class="form-group col-lg-12 col-md-6">
                        <div class="form-line">
                            <input class="form-control" name="date" placeholder="<?php echo ATTANDANCE_DATE; ?>" value="" readonly>
                        </div>
                    </div>                
                </div>                            
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="update-attendance-save-btn">Save</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo ATTANDANCE_CLOSE; ?></button>
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
    $(function () {      

        
        $("#update-attendance-save-btn").click(function(){
            var attendance_id = $("#attendance_id").val();
            var attendance_status = $("#attendance_status").val();

            if(attendance_status == 'OFF'){
                var att_class = "attendance-off";
            }
            if(attendance_status == 'P'){
                var att_class = "attendance-present";
            }
            if(attendance_status == 'H'){
                var att_class = "attendance-holiday";
            }
            if(attendance_status == 'HL'){
                var att_class = "attendance-halfday";
            }
            if(attendance_status == 'FL'){
                var att_class = "attendance-full-leave";
            }            
            if(attendance_status == 'A'){
                var att_class = "attendance-absent";
            }
            
            $("#"+attendance_id+"-input").val(attendance_status);
            $("#"+attendance_id+"-btn").removeClass();
            $("#"+attendance_id+"-btn").addClass("attendance "+att_class);

            $("#"+attendance_id+"-btn").html(attendance_status);

            $("#update_attendance").modal("hide");
        });
        
        $(".attendance").click(function(){
            var attendance_id = $(this).attr('data-id');
            var attendance_day = $(this).attr('data-day');
            var attendance_status = $(this).attr('data-value');
            
            if(attendance_day.length == 1){
                attendance_day = '0'+attendance_day
            }

            var month = parseInt("<?php echo $month; ?>");
            month = month.toString();
            if(month.length == 1){
                month = '0'+month;
            }

            var date = attendance_day+"/"+month+"/"+<?php echo $year; ?>;
            $("#attendance_id").val(attendance_id);
            $("#update_attendance_form input[name='date']").val(date);
            $("#attendance_status").val(attendance_status).change();
            $("#update_attendance").modal("show");
        });

    });
</script>