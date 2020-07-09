<div id="wrapper">

    <?php include("inc/company_employee_navbar.php") ?>
    
    <?php include("inc/company_employee_sidebar.php") ?>

    <div id="main-content">
    	<div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> <?php echo REQUEST_LEAVE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                            <li class="breadcrumb-item active"><?php echo REQUEST_LEAVE_LEAVE; ?></li>
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
                        <div class="body">
                            <form id="request-leave" action="<?= base_url('myprofile_requests/create_leave_request');?>" method="post" novalidate enctype="multipart/form-data">
                            <input type="hidden" name="employee_id" value="<php echo $employee_id; ?>">
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo REQUESTS_LEAVE_TITLE; ?></label>
                                        <input type="text" class="form-control" name="title" required>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-12">
                                        <div class="form-group">
                                            <label><?php echo REQUESTS_LEAVE_LEAVE_TYPE; ?></label>
                                            <select name="leave_type_id" id="leave_type_id" class="form-control show-tick ms select2" data-placeholder="Select" required>
                                                <option value=""><?php echo REQUESTS_LEAVE_SELECT_LEAVE_TYPE; ?></option>
                                                <?php
                                                if(!empty($leave_types)){
                                                    foreach ($leave_types as $key => $value) { 
                                                        $selected = "";
                                                    ?>
                                                        <option value="<?php echo $value['leave_type_id']; ?>" <?php echo $selected; ?>><?php echo $value['leave_type_name']; ?></option>
                                                    <?php 
                                                    }
                                                } 
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="form-group">
                                            <label><?php echo REQUESTS_LEAVE_FROM_DATE; ?></label>
                                            <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="from_date" id="from_date" placeholder="<?php echo REQUESTS_LEAVE_FROM_DATE; ?>" autocomplete="off" value="" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="form-group">
                                            <label><?php echo REQUESTS_LEAVE_TO_DATE; ?></label>
                                            <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="to_date" id="to_date" placeholder="<?php echo REQUESTS_LEAVE_TO_DATE; ?>" autocomplete="off" value="" readonly required>
                                        </div>
                                    </div>
                                </div>
                                
                                

                                <div class="row-box" style="display: none;">
                                    
                                </div>

                                                               
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo REQUESTS_LEAVE_DESCRIPTION; ?></label>
                                        <textarea class="form-control" name="description" placeholder="<?php echo REQUESTS_LEAVE_DESCRIPTION; ?>"></textarea>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-12">
                                        <div class="fancy-checkbox">
                                            <label><input name="is_entry_visa_required" value="yes" type="checkbox"><span><?php echo REQUESTS_LEAVE_ENTRY_VISA_REAUIRED; ?></span></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="fancy-checkbox">
                                            <label><input name="is_exit_visa_required" value="yes" type="checkbox"><span><?php echo REQUESTS_LEAVE_EXIT_VISA_REAUIRED; ?></span></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="fancy-checkbox">
                                            <label><input name="is_travel_ticket_required" value="yes" type="checkbox"><span><?php echo REQUESTS_LEAVE_TRAVEL_TICKET; ?></span></label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row clearfix">
                                    <div class="col-md-12 form-group">
                                        <label><?php echo REQUESTS_LEAVE_UPLOAD_DOC; ?></label>
                                        <label for="document_file" class="dragndrop">
                                            <img src="<?= site_url(); ?>assets/images/upload.png" alt="" /><br />
                                            <?php echo REQUESTS_LEAVE_DRAG_DROP; ?><br />
                                            <?php echo CLIENTS_OR; ?><br />
                                            <?php echo REQUESTS_LEAVE_DOC_FILE; ?><br />
                                            <?php echo REQUESTS_LEAVE_FILE_TYPE; ?>
                                            </br>
                                            <button type="button" class="btn btn-sm btn-outline-primary"><?php echo REQUESTS_LEAVE_BROWSE_FILE; ?></button>
                                            <br>
                                            <span id="selected_document_file_name"></span>
                                            <br>
                                            <input type="file" name="document_file" id="document_file" style="display: none;">
                                        </label>
                                    </div>
                                </div>
                              
                                <br>
                                <button type="submit" class="btn btn-success"><?php echo REQUESTS_LEAVE_CREATE; ?></button>
                                <a href="<?= site_url(); ?>employees"><button type="button" class="btn btn-danger"><?php echo REQUESTS_LEAVE_CANCEL; ?></button></a>
                            </form>                           
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

<!-- Input Mask Plugin Js --> 
<script src="<?= site_url(); ?>assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js"></script> 
<script src="<?= site_url(); ?>assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js"></script>

<!--moment js-->
<script src="<?= site_url(); ?>assets/js/moment.js"></script> 

<!-- Toaster --> 
<script src="<?= site_url(); ?>assets/vendor/toastr/toastr.js"></script> 

<!-- SweetAlert For Dialog Box --> 
<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script>

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
    $(function() {        

        $('#request-leave').parsley();

        $('#to_date').change(function(){

            $(".row-box").html("");

            var workweek_details = <?php echo json_encode($employee_workweel_details); ?>;
            var holidays = <?php echo json_encode($holidays); ?>;
            
            console.log(holidays);

            var from_date = $("#from_date").val();
            var to_date = $("#to_date").val();
            if(to_date != ""){
                if(from_date == ""){
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = 'toast-bottom-right';    
                    toastr['error']('Please select leave from-date.');
                    return false;
                }
                from_date = from_date.split('/');
                from_date = from_date[2]+'-'+from_date[1]+'-'+from_date[0];

                to_date = to_date.split('/');
                to_date = to_date[2]+'-'+to_date[1]+'-'+to_date[0];

                from_date = new Date(from_date);
                to_date = new Date(to_date);

                if(from_date.getTime() > to_date.getTime()){
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = 'toast-bottom-right';    
                    toastr['error']('From-date should small than to-date.');
                    return false;
                }
                
                var timeDiff = to_date.getTime() - from_date.getTime();
                var days_diff = timeDiff / (1000 * 3600 * 24);
                days_diff = days_diff + 1;
                        
                Date.prototype.addDays = function(days) {
                    this.setDate(this.getDate() + parseInt(days));
                    return this;
                };

                var days = ['sunday','monday','tuesday','wednesday','thursday','friday','saturday'];

                var leave_type_dropdown = '<select class="form-control" name="leave_type[]"><option value="full_leave">Full Leave</option><option value="half_leave">Half Leave</option></select>';

                var leave_html = "";
                var start_date = from_date;
                for(var i = 1;i<=days_diff;i++){
                    
                    var month = start_date.getMonth() + 1;
                    var day = start_date.getDay();
                    var day_name = days[day];
                    
                    console.log(workweek_details[day_name]);

                    var leave_date = moment(start_date).format('DD/MM/YYYY');
                    //var leave_date = start_date.getDate()+"/"+month+"/"+start_date.getFullYear();

                    if(workweek_details[day_name] == 'yes'){
                        leave_html += '<div class="row clearfix">';
                            leave_html += '<div class="col-md-3">';
                                leave_html += '<div class="form-group">';
                                    leave_html += '<input type="hidden" name="leave_date[]" value="'+leave_date+'">';
                                    leave_html += '<label>'+leave_date+'</label>';
                                leave_html += '</div>';
                            leave_html += '</div>';
                            leave_html += '<div class="col-md-3">';
                                leave_html += '<div class="form-group">';
                                    leave_html += '<label>'+moment(start_date).format('dddd')+'</label>';
                                leave_html += '</div>';
                            leave_html += '</div>';
                            leave_html += '<div class="col-md-3">';
                            leave_html += '<div class="form-group">'+leave_type_dropdown+'</div>';
                            leave_html += '</div>';
                        leave_html += '</div>';
                    }else{
                        leave_html += '<div class="row clearfix">';
                            leave_html += '<div class="col-md-3">';
                                leave_html += '<div class="form-group">';
                                    leave_html += '<label>'+leave_date+'</label>';
                                leave_html += '</div>';
                            leave_html += '</div>';
                            leave_html += '<div class="col-md-3">';
                                leave_html += '<div class="form-group">';
                                    leave_html += '<label>'+moment(start_date).format('dddd')+'</label>';
                                leave_html += '</div>';
                            leave_html += '</div>';
                            leave_html += '<div class="col-md-3">';
                                leave_html += '<div class="form-group">';
                                    leave_html += '<label>No-Working Day</label>';
                                leave_html += '</div>';
                            leave_html += '</div>';
                        leave_html += '</div>';
                    }
                                        
                    start_date = start_date.addDays(1);
                }

                if(leave_html != ""){
                    $(".row-box").append(leave_html);
                    $(".row-box").show();
                }

            }

        });
    });
</script>


<script type="text/javascript">
    
    var fileInput = document.querySelector('input[id="document_file"]');
    fileInput.addEventListener('change', changeFile);

    function changeFile(){
        $("#selected_document_file_name").html(fileInput.files[0].name);
    }

</script>
