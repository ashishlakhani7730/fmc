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
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo ATTANDANCE_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active"><?php echo ATTANDANCE_TITLE; ?></li>
                        </ul>                        
                    </div>            
                    <div class="col-lg-8 col-md-8 col-sm-12 text-right">

                        <a href="<?= site_url(); ?>attendance/add" class="btn btn-info">Add Attendance</a>

                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span id="search_concept">Excel</span> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-item"><a href="<?= site_url(); ?>assets/sample-excel/sample-employee-attendance-new.xlsx">Download Sample</a></li>
                            <li class="dropdown-item"><a href="#" data-toggle="modal" data-target="#importExcelModel">Import</a></li>
                        </ul>      
                        
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo ATTANDANCE_SELECT_YEAR; ?></label>
                                            <select name="year" id="attendance_year" class="form-control show-tick ms select2" data-placeholder="Select Year" required>
                                                <option value=""><?php echo ATTANDANCE_SELECT_YEAR; ?></option>
                                                <?php
                                                for ($i=2020; $i <= date('Y'); $i++) { 
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo ATTANDANCE_SELECT_MONTH; ?></label>
                                            <select name="month" id="attendance_month" class="form-control show-tick ms select2" data-placeholder="Select Month" required>
                                                <option value=""><?php echo ATTANDANCE_SELECT_MONTH; ?></option>
                                                <option value="01" <?php echo ($month == "01") ? "selected" : ""; ?>><?php echo ATTANDANCE_JANUARY; ?></option>
                                                <option value="02" <?php echo ($month == "02") ? "selected" : ""; ?>><?php echo ATTANDANCE_FEBRUARY; ?></option>
                                                <option value="03" <?php echo ($month == "03") ? "selected" : ""; ?>><?php echo ATTANDANCE_MARCH; ?></option>
                                                <option value="04" <?php echo ($month == "04") ? "selected" : ""; ?>><?php echo ATTANDANCE_APRIL; ?></option>
                                                <option value="05" <?php echo ($month == "05") ? "selected" : ""; ?>><?php echo ATTANDANCE_MAY; ?></option>
                                                <option value="06" <?php echo ($month == "06") ? "selected" : ""; ?>><?php echo ATTANDANCE_JUNE; ?></option>
                                                <option value="07" <?php echo ($month == "07") ? "selected" : ""; ?>><?php echo ATTANDANCE_JULY; ?></option>
                                                <option value="08" <?php echo ($month == "08") ? "selected" : ""; ?>><?php echo ATTANDANCE_AUGUST; ?></option>
                                                <option value="09" <?php echo ($month == "09") ? "selected" : ""; ?>><?php echo ATTANDANCE_SEPTEMBER; ?></option>
                                                <option value="10" <?php echo ($month == "10") ? "selected" : ""; ?>><?php echo ATTANDANCE_OCTOMBER; ?></option>
                                                <option value="11" <?php echo ($month == "11") ? "selected" : ""; ?>><?php echo ATTANDANCE_NOVEMBER; ?></option>
                                                <option value="12" <?php echo ($month == "12") ? "selected" : ""; ?>><?php echo ATTANDANCE_DECEMBER; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo ATTANDANCE_SELECT_DEPARTMENT; ?></label>
                                            <select name="department" id="department" class="form-control show-tick ms select2" data-placeholder="Select Year">
                                                <option value=""><?php echo ATTANDANCE_SELECT_ALL; ?></option>
                                                <?php
                                                if(!empty($departments)){
                                                    foreach ($departments as $key => $value) { 

                                                    $selected = "";
                                                    if($attendance_department == $value['id']){
                                                        $selected = "selected";
                                                    }
                                                ?>
                                                    ?>
                                                        <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['name']; ?></option>
                                                    <?php 
                                                    }
                                                } 
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo ATTANDANCE_SELECT_DESIGNATION; ?></label>
                                            <select name="designation" id="designation" class="form-control show-tick ms select2" data-placeholder="Select Year">
                                                <option value=""><?php echo ATTANDANCE_SELECT_ALL; ?></option>
                                                <?php
                                                if(!empty($designation)){
                                                    foreach ($designation as $key => $value) { 

                                                    $selected = "";
                                                    if($attendance_designation == $value['id']){
                                                        $selected = "selected";
                                                    }
                                                ?>
                                                    ?>
                                                        <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['name']; ?></option>
                                                    <?php 
                                                    }
                                                } 
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button onclick="set_filter_session();" style="background-color: #0069d9;" type="button" class="btn btn-primary form-control"><?php echo ATTANDANCE_SEARCH; ?></button>
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
                            </form>
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
                                        if(!empty($items)){
                                        foreach ($items as $key => $value) {
                                            $attendance_id = $value['id'];
                                            $employee_id = $value['employee_id'];
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $value['employee_fullname_english']; ?>
                                                </td>
                                                <?php 
                                                for ($i=1; $i <= $month_days; $i++) {
                                                    $key = "date_".$i;
                                                ?>
                                                <td>
                                                <?php 
                                                    if(isset($value[$key])){
                                                        $att_value = $value[$key];
                                                    }else{
                                                        $att_value = "";
                                                    }
                                                    if(!empty($att_value)){
                                                        if($att_value == 'OFF'){
                                                            $att_class = "attendance-off";
                                                        }
                                                        if($att_value == 'A'){
                                                            $att_class = "attendance-absent";
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
                                                        <button data-id="<?php echo $attendance_id; ?>" data-day="<?php echo $i; ?>" data-value="<?php echo $att_value; ?>"  type="button" class="attendance <?php echo $att_class; ?>">
                                                            <?php echo strtoupper($att_value); ?>
                                                        </button>
                                                <?php
                                                    }
                                                ?>
                                                    
                                                </td>
                                                <?php   
                                                }                                            
                                                ?>
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
            <form method="post" id="update_attendance_form" action="<?= base_url('attendance/update');?>" enctype="multipart/form-data">
            <input type="hidden" name="attendance_document_id">
            <input type="hidden" name="attendance_id">
            <input type="hidden" name="attendance_day">
            <div class="modal-header">
                <h4 class="title"><?php echo ATTANDANCE_UPDATE; ?></h4>
            </div>            
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
                <div class="row clearfix">
                    <div class="form-group col-lg-12 col-md-6">
                        <div class="form-line">
                            <textarea class="form-control" name="description" placeholder="<?php echo ATTANDANCE_DESCRIPTION; ?>"></textarea>
                        </div>
                    </div>                
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-12">
                        <label for="document" class="dragndrop m-2">
                            <img src="<?= site_url(); ?>assets/images/upload.png" alt=""><br>
                            <?php echo ATTANDANCE_DRAG; ?><br>
                            <?php echo CLIENTS_OR; ?><br>
                            <button type="button" class="btn btn-sm btn-outline-primary"><?php echo ATTANDANCE_BROWSE_FILE; ?></button>
                            <input type="file" name="document" id="document" style="display: none;">
                        </label>
                    </div>
                    <div class="col-md-12 text-center" id="download_doc"></div>
                </div>
                  
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><?php echo ATTANDANCE_ADD; ?></button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo ATTANDANCE_CLOSE; ?></button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Import Excel Modal -->
<div class="modal animated jello" id="importExcelModel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('attendance/import_excel');?>" method="post" id="importExcelForm" enctype="multipart/form-data" novalidate="novalidate">
                <div class="modal-header">
                    <h4 class="title">Import Excel</h4>
                </div>            
                <div class="modal-body">                
                    <div class="row clearfix">
                        <div class="form-group col-lg-12 col-md-12">
                            <label><?php echo ATTANDANCE_SELECT_YEAR; ?></label>
                            <select name="year" id="attendance_year" class="form-control show-tick ms select2" data-placeholder="Select Year" required>
                                <option value=""><?php echo ATTANDANCE_SELECT_YEAR; ?></option>
                                <?php
                                for ($i=2020; $i <= date('Y'); $i++) { 
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
                    <div class="row clearfix">
                        <div class="form-group col-lg-12 col-md-12">
                            <label><?php echo ATTANDANCE_SELECT_MONTH; ?></label>
                            <select name="month" id="attendance_month" class="form-control show-tick ms select2" data-placeholder="Select Month" required>
                                <option value=""><?php echo ATTANDANCE_SELECT_MONTH; ?></option>
                                <option value="01" <?php echo ($month == "01") ? "selected" : ""; ?>><?php echo ATTANDANCE_JANUARY; ?></option>
                                <option value="02" <?php echo ($month == "02") ? "selected" : ""; ?>><?php echo ATTANDANCE_FEBRUARY; ?></option>
                                <option value="03" <?php echo ($month == "03") ? "selected" : ""; ?>><?php echo ATTANDANCE_MARCH; ?></option>
                                <option value="04" <?php echo ($month == "04") ? "selected" : ""; ?>><?php echo ATTANDANCE_APRIL; ?></option>
                                <option value="05" <?php echo ($month == "05") ? "selected" : ""; ?>><?php echo ATTANDANCE_MAY; ?></option>
                                <option value="06" <?php echo ($month == "06") ? "selected" : ""; ?>><?php echo ATTANDANCE_JUNE; ?></option>
                                <option value="07" <?php echo ($month == "07") ? "selected" : ""; ?>><?php echo ATTANDANCE_JULY; ?></option>
                                <option value="08" <?php echo ($month == "08") ? "selected" : ""; ?>><?php echo ATTANDANCE_AUGUST; ?></option>
                                <option value="09" <?php echo ($month == "09") ? "selected" : ""; ?>><?php echo ATTANDANCE_SEPTEMBER; ?></option>
                                <option value="10" <?php echo ($month == "10") ? "selected" : ""; ?>><?php echo ATTANDANCE_OCTOMBER; ?></option>
                                <option value="11" <?php echo ($month == "11") ? "selected" : ""; ?>><?php echo ATTANDANCE_NOVEMBER; ?></option>
                                <option value="12" <?php echo ($month == "12") ? "selected" : ""; ?>><?php echo ATTANDANCE_DECEMBER; ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group">
                                <label class="form-label text-xs-left" for="">Select Excel File</label>
                                <input class="form-control" type="file" name="excel_file" id="excel_file" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Import</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
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


function set_filter_session()
{
    var attendance_month = $("#attendance_month").val();
    var attendance_year = $("#attendance_year").val();
    var designation = $("#designation").val();
    var department = $("#department").val();

    show_page_loader();
    $.ajax({
        url: "<?= site_url('attendance/set_filter_session/'); ?>",
        type: 'post',
        data: {
            'attendance_month': attendance_month,
            'attendance_year': attendance_year,
            'designation': designation,
            'department': department
        },
        success: function (data) {
            hide_page_loader();
            location.reload();
        },
        error: function () {    
            hide_page_loader();
        }
    });
}

</script>
<script type="text/javascript">
    $(function () {      
        $('#update_attendance_form').parsley();
        $('#importExcelForm').parsley();
        
        
        $(".attendance").click(function(){
            $("#download_doc").html("");
            $("#update_attendance_form textarea[name='description']").val(""); 

            var attendance_id = $(this).attr('data-id');
            var attendance_day = $(this).attr('data-day');
            var attendance_status = $(this).attr('data-value');
            
            $("#update_attendance_form input[name='attendance_day']").val(attendance_day);

            if(attendance_day.length == 1){
                attendance_day = '0'+attendance_day
            }

            var month = parseInt("<?php echo $month; ?>");
            month = month.toString();
            if(month.length == 1){
                month = '0'+month;
            }

            var date = attendance_day+"/"+month+"/"+<?php echo $year; ?>;
            
            show_page_loader();      
            $.ajax({
                url: "<?= site_url('attendance/get_attendance_document/'); ?>",
                type: 'post',
                data: {'attendance_id': attendance_id,'date': date},
                success: function (data) {
                    hide_page_loader();
                    var obj = JSON.parse(data);

                    if(obj.success == "true"){
                        console.log(obj.data);
                        var description = (obj.data && obj.data.description != "") ? obj.data.description : "";
                        $("#update_attendance_form input[name='attendance_document_id']").val(obj.data.id); 
                        $("#update_attendance_form textarea[name='description']").val(description); 
                        if(obj.data.document != ""){
                            var link_html = "<a target='_blank' href='<?= site_url(); ?>/uploads/"+obj.data.document+"'>"+obj.data.document+"</a>";
                            $("#download_doc").html(link_html);
                        }   
                    }
                    
                    $("#update_attendance_form input[name='attendance_id']").val(attendance_id);
                    $("#update_attendance_form input[name='date']").val(date);
                    $("#attendance_status").val(attendance_status).change();

                    $("#update_attendance").modal("show");
                },
                error: function () {    
                    hide_page_loader();
                }
            });
        });

    });
</script>