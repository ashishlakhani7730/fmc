<div id="wrapper">

  <?php include("inc/company_navbar.php") ?>

  <?php include("inc/company_sidebar.php") ?>
  
  <style type="text/css">
      .flex-container-custom a.active{
          background-color: #337AB7;
          color: white!important;
          font-weight: bold;
      }
  </style>

  <?php

    $CI =& get_instance();
    $CI->load->model('leave_types_model');
    $CI->load->model('holidays_model');
    $CI->load->model('holidays_model');

    $id = (isset($details) && $details['id']) ? $details['id'] : '';

    $leave_types = array();
    if($details['leave_group'] != ""){
        $leave_types = $CI->leave_types_model->get_leave_type_by_leave_group($details['leave_group']);  
    }
    if($details['holiday_group'] != ""){
        $holidays = $CI->holidays_model->get_holiday_by_holiday_group($details['holiday_group']);
    }
    if($details['work_group'] != ""){
        $workdays = $CI->workweek_model->get_details($details['work_group']);
    }

  ?>
 
  <div id="main-content">
    <div class="container-fluid">
      <div class="block-header">
        <div class="row">
          <div class="col-lg-6 col-md-8 col-sm-12">
            <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo COMPANY_EMPLOYEE_EMPLOYEE; ?></h2>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="<?= site_url(); ?>clients"><?php echo COMPANY_EMPLOYEE_EMPLOYEE; ?></a></li>
              <li class="breadcrumb-item active"><?php echo COMPANY_EMPLOYEE_LEAVE_WORK_DETAILS; ?></li>
            </ul>                        
          </div>            
          <div class="col-lg-6 col-md-4 col-sm-12 text-right"></div>
        </div>
      </div>

      <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
          <div class="card planned_task">
            <div class="body">
              <div class="row">
                <div class="col-md-12">
                  <div class="flex-container-custom">
                    <a href="<?= site_url(); ?>employees/company_employees_create_step_1/<?php echo base64_encode($id); ?>" class="flex-item-custom">1. <br /> <span><?php echo COMPANY_EMPLOYEE_ACCOUNT_DETAILS; ?></span></a>
                    
                    <a href="<?= site_url(); ?>employees/company_employees_create_step_2/<?php echo base64_encode($id); ?>" class="flex-item-custom">2. <br /> <span><?php echo COMPANY_EMPLOYEE_POSITIONAL_INFO; ?></span></a>

                    <a href="<?= site_url(); ?>employees/company_employees_create_step_3/<?php echo base64_encode($id); ?>" class="flex-item-custom">3. <br /> <span><?php echo COMPANY_EMPLOYEE_PERSONAL_INFO; ?></span></a>

                    <a href="<?= site_url(); ?>employees/company_employees_create_step_4/<?php echo base64_encode($id); ?>" class="flex-item-custom">4. <br /> <span><?php echo COMPANY_EMPLOYEE_EMERGENCY_CONTACT; ?></span></a>
                    <a href="<?= site_url(); ?>employees/company_employees_create_step_5/<?php echo base64_encode($id); ?>" class="flex-item-custom">5. <br /> <span><?php echo COMPANY_EMPLOYEE_QUALIFICATION; ?></span></a>
                    <a href="<?= site_url(); ?>employees/company_employees_create_step_6/<?php echo base64_encode($id); ?>" class="flex-item-custom">6. <br /> <span><?php echo COMPANY_EMPLOYEE_WORK_EXP; ?></span></a>

                    <a href="<?= site_url(); ?>employees/company_employees_create_step_7/<?php echo base64_encode($id); ?>" class="flex-item-custom active">7. <br /> <span><?php echo COMPANY_EMPLOYEE_LEAVE_DETAILS; ?></span></a>

                    <a href="<?= site_url(); ?>employees/company_employees_create_step_8/<?php echo base64_encode($id); ?>" class="flex-item-custom">8. <br /> <span><?php echo COMPANY_EMPLOYEE_SALARY_DETAILS; ?></span></a>

                    <a href="<?= site_url(); ?>employees/company_employees_create_step_9/<?php echo base64_encode($id); ?>" class="flex-item-custom">9. <br /> <span><?php echo "Personal Documents"; ?></span></a>
                    
                  </div>
                  <div class="custom-hr"><hr /></div>
                </div>
              </div>
              <form action="<?= base_url('employees/company_employees_create_step_7');?>" id="create-employee" method="post" novalidate>
              <input type="hidden" name="id" id="employee_id" value="<?php echo base64_encode($id); ?>">
                  
                  <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label><?php echo COMPANY_EMPLOYEE_SELECT_LEAVE_GROUP; ?><span class="text-danger">*</span></label>
                              <select name="leave_group" id="leave_group" class="form-control select2" data-placeholder="Select From Year" required>
                                  <option value=""><?php echo COMPANY_EMPLOYEE_SELECT_LEAVE_GROUP; ?></option>
                                  <?php 
                                  if(!empty($leave_types_groups)){
                                      foreach ($leave_types_groups as $value) {
                                          $selected = "";
                                          if($details['leave_group'] == $value['id']){
                                              $selected = "selected";
                                          }
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
                          <ul class="list-group" id="leave_types">
                          <?php 
                          foreach ($leave_types as $value) {
                          ?>
                              <li class="list-group-item d-flex justify-content-between align-items-center"><?php echo $value['leave_type_name']; ?><span class="badge badge-primary badge-pill"><?php echo $value['leave_days']; ?></span></li>
                          <?php
                          }
                          ?>
                          </ul>
                      </div>
                  </div>
                  <hr>
                  <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label><?php echo COMPANY_EMPLOYEE_SELECT_HOLIDAY_GROUP; ?><span class="text-danger">*</span></label>
                              <select name="holiday_group" id="holiday_group" class="form-control select2" data-placeholder="Select From Year" required>
                                  <option value=""><?php echo COMPANY_EMPLOYEE_SELECT_HOLIDAY_GROUP; ?></option>
                                  <?php 
                                  if(!empty($holiday_groups)){
                                      foreach ($holiday_groups as $value) {
                                          $selected = "";
                                          if($details['holiday_group'] == $value['id']){
                                              $selected = "selected";
                                          }
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
                          <ul class="list-group" id="holidays">
                          <?php 
                          foreach ($holidays as $value) {
                              $holiday_date = explode("-", $value['holiday_date']);
                              $holiday_date = $holiday_date[2]."/".$holiday_date[1]."/".$holiday_date[0];
                              if($holiday_date == '00/00/0000'){
                                  $holiday_date = "";
                              }
                          ?>
                              <li class="list-group-item d-flex justify-content-between align-items-center"><?php echo $value['holiday_name']; ?><span class="badge badge-primary badge-pill"><?php echo $holiday_date; ?></span></li>
                          <?php
                          }
                          ?>
                          </ul>
                      </div>
                  </div>
                  <hr>
                  <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label><?php echo COMPANY_EMPLOYEE_SELECT_WORK_WEEK_WORKSHIFT; ?><span class="text-danger">*</span></label>
                              <select name="work_group" id="work_group" class="form-control select2" data-placeholder="Select From Year" required>
                                  <option value=""><?php echo COMPANY_EMPLOYEE_SELECT_WORK_WEEK; ?></option>
                                  <?php 
                                  if(!empty($workweek_groups)){
                                      foreach ($workweek_groups as $value) {
                                          $selected = "";
                                          if($details['work_group'] == $value['id']){
                                              $selected = "selected";
                                          }
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
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-hover js-basic-example dataTable table-custom">
                          <thead class="thead-dark">
                            <tr>
                              <th width="15%"><?php echo COMPANY_EMPLOYEE_DAY; ?></th>
                              <th width="15%"><?php echo COMPANY_EMPLOYEE_IS_WORKING; ?></th>
                              <th width="80%"><?php echo COMPANY_EMPLOYEE_SHIFT; ?></th>
                            </tr>
                          </thead>                                           
                          <tbody id="work_group_table_body">
                            <?php 
                            if($details['work_group'] != "" && $details['work_group'] != "0"){
                            foreach ($days as $day) {

                              $day_w_a = array();
                              foreach ($employee_workshift as $key => $value) {
                                if($value['day_name'] == $day){
                                  $day_w_a[] = $value;
                                }
                              }
                              
                              $employee_workshift_column = array_column($day_w_a, 'shift_id');

                            ?>
                            <tr>
                                    <td><?php echo ucfirst($day); ?></td>
                                    <td>
                                      <span class="badge badge-primary badge-pill"><?php echo  strtoupper($workdays[$day]); ?>
                                      </span>
                                    </td>
                                    <td>
                                      <div class="row">
                                        <?php 
                                        if(!empty($workshift) && $workdays[$day] == 'yes'){
                                          foreach ($workshift as $value) {
                                            $checked = "";
                                            //employee_workshift
                                            if(in_array($value['id'],$employee_workshift_column)){
                                              $checked = "checked";
                                            }

                                        ?>
                                          <div class="col-md-5">
                                            <div class="fancy-checkbox">
                                                <label>
                                                  <input <?php echo $checked; ?> name="<?php echo $day; ?>[]" type="checkbox" value="<?php echo $value['id']; ?>">
                                                  <span>
                                                    <?php echo $value['shift_name']; ?> (<?php echo $value['start_time']."-".$value['end_time']; ?>)
                                                  </span>
                                                </label>
                                            </div>
                                          </div>
                                          <?php
                                          }
                                        }
                                        ?>
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
                  
                  <br>
                  <br>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="float-right">                          
                        <!-- Skip -->
                        <a href="<?= site_url(); ?>employees/company_employees_create_step_8/<?php echo base64_encode($id); ?>">
                            <button type="button" name="skip" class="btn btn-default"><?php echo COMPANY_EMPLOYEE_SKIP; ?></button>
                        </a>
                        <!-- Previous -->
                        <a href="<?= site_url(); ?>employees/company_employees_create_step_6/<?php echo base64_encode($id); ?>">
                            <button type="button" name="previous" class="btn btn-info"><?php echo COMPANY_EMPLOYEE_PREVIOUS; ?></button>
                        </a>
                        <!-- Save -->
                        <button type="submit" name="submit_btn" value="
                        submit_btn" class="btn btn-success"><?php echo COMPANY_EMPLOYEE_SAVE; ?></button>
                        <!-- Next -->
                        <button type="submit" name="next_btn" value="next_btn" class="btn btn-info"><?php echo COMPANY_EMPLOYEE_NEXT; ?></button>
                      </div>
                    </div>
                  </div>
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


<script src="<?= site_url(); ?>assets/vendor/toastr/toastr.js"></script> 
<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 

<!-- Form Validation -->
<script src="<?= site_url(); ?>assets/vendor/parsleyjs/js/parsley.min.js"></script>

<!-- Date-Picker Time-Picker -->
<script src="<?= site_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<!-- Ckeditor --> 
<script src="<?= site_url(); ?>assets/vendor/ckeditor/ckeditor.js"></script> 


<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
    $(function() {      
        //initialize Form Validation
        $('#create-employee').parsley();
        
        $("#leave_group").change(function(){
            if(this.value != ""){
                show_page_loader();
                $.ajax({
                    url: "<?= site_url('leavemanagement/get_all_leave_types_by_leavegroup_ajax'); ?>",
                    type: 'post',
                    data: {'leave_group_id': this.value},
                    success: function (data) {
                        data = JSON.parse(data);
                        console.log(data);
                        var html = "";
                        data.data.forEach(function(d){
                            html += '<li class="list-group-item d-flex justify-content-between align-items-center">'+d.title+'<span class="badge badge-primary badge-pill">'+d.value+'</span></li>';
                        });
                        $("#leave_types").html(html);
                        hide_page_loader();
                    },
                    error: function () {    
                        hide_page_loader();
                    }
                }); 
            }else{
                $("#leave_types").html("");
            }
            
        });

        $("#holiday_group").change(function(){
            if(this.value != ""){
                show_page_loader();
                $.ajax({
                    url: "<?= site_url('leavemanagement/get_all_holidays_by_holidaygroup_ajax'); ?>",
                    type: 'post',
                    data: {'holiday_group_id': this.value},
                    success: function (data) {
                        data = JSON.parse(data);
                        var html = "";
                        data.data.forEach(function(d){
                            html += '<li class="list-group-item d-flex justify-content-between align-items-center">'+d.holiday_name+'<span class="badge badge-primary badge-pill">'+d.holiday_date+'</span></li>';
                        });
                        $("#holidays").html(html);
                        hide_page_loader();
                    },
                    error: function () {    
                        hide_page_loader();
                    }
                }); 
            }else{
                $("#holidays").html("");
            }
            
        });

        $("#work_group").change(function(){
          swal({
              title: "Are you sure?",
              text: "Old workshift data will removed!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#dc3545",
              confirmButtonText: "Yes, chnage it!",
              closeOnConfirm: false
          }, function () {
            if($("#work_group").val() != ""){
                show_page_loader();
                $.ajax({
                    url: "<?= site_url('leavemanagement/get_all_workdays_html_by_workgroup_ajax'); ?>",
                    type: 'post',
                    data: {
                      'work_group': $("#work_group").val(),
                      'employee_id': $("#employee_id").val(),
                      'leave_group': $("#leave_group").val(),
                      'holiday_group': $("#holiday_group").val()
                    },
                    success: function (data) {
                        data = JSON.parse(data);
                        
                        if(data.success == "true"){
                          location.reload();
                        }

                        /*
                        var d = data.data;
                        var html = "";
                        
                        html += '<li class="list-group-item d-flex justify-content-between align-items-center">Sunday<span class="badge badge-primary badge-pill">'+d.sunday.toUpperCase()+'</span></li>';

                        html += '<li class="list-group-item d-flex justify-content-between align-items-center">Monday<span class="badge badge-primary badge-pill">'+d.monday.toUpperCase()+'</span></li>';

                        html += '<li class="list-group-item d-flex justify-content-between align-items-center">Tuesday<span class="badge badge-primary badge-pill">'+d.tuesday.toUpperCase()+'</span></li>';

                        html += '<li class="list-group-item d-flex justify-content-between align-items-center">Wednesday<span class="badge badge-primary badge-pill">'+d.wednesday.toUpperCase()+'</span></li>';

                        html += '<li class="list-group-item d-flex justify-content-between align-items-center">Thursday<span class="badge badge-primary badge-pill">'+d.thursday.toUpperCase()+'</span></li>';

                        html += '<li class="list-group-item d-flex justify-content-between align-items-center">Friday<span class="badge badge-primary badge-pill">'+d.friday.toUpperCase()+'</span></li>';

                        html += '<li class="list-group-item d-flex justify-content-between align-items-center">Saturday<span class="badge badge-primary badge-pill">'+d.saturday.toUpperCase()+'</span></li>';
                        */
                    },
                    error: function () {    
                        hide_page_loader();
                    }
                }); 
            }
          });

        });
    });
</script>
