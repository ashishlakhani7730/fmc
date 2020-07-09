<div id="wrapper">

  <?php include("inc/company_navbar.php") ?>

  <?php include("inc/company_sidebar.php") ?>

  <style type="text/css">
    .card-panel-body{
        display: none;
    }
  </style>
  <?php
    function get_file_icon($ext) {
        $idx = $ext;

        $mimet = array( 
            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'fa-file-image-o',
            'jpe' => 'fa-file-image-o',
            'jpeg' => 'fa-file-image-o',
            'jpg' => 'fa-file-image-o',
            'gif' => 'fa-file-image-o',
            'bmp' => 'fa-file-image-o',
            'ico' => 'fa-file-image-o',
            'tiff' => 'fa-file-image-o',
            'tif' => 'fa-file-image-o',
            'svg' => 'fa-file-image-o',
            'svgz' => 'fa-file-image-o',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'fa-file-audio-o',
            'qt' => 'fa-file-video-o',
            'mov' => 'fa-file-video-o',

            // adobe
            'pdf' => 'fa-file-pdf-o',
            'psd' => 'fa-file-o',
            'ai' => 'fa-file-o',
            'eps' => 'fa-file-o',
            'ps' => 'fa-file-o',

            // ms office
            'doc' => 'fa-file-word-o',
            'xls' => 'fa-file-excel-o',
            'ppt' => 'fa-file-powerpoint-o',
            'docx' => 'fa-file-word-o',
            'xlsx' => 'fa-file-excel-o',
            'pptx' => 'fa-file-powerpoint-o',


            // open office
            'odt' => 'fa-file-word-o',
            'ods' => 'fa-file-excel-o',
        );

        if (isset( $mimet[$idx] )) {
            return $mimet[$idx];
        } else {
            return 'fa-file-o';
        }
    }

    $birthdate = (isset($details) && $details['birthdate'] != "") ? $details['birthdate'] : '0000-00-00';

    $birthdate = explode("-", $birthdate);
    $birthdate = $birthdate[2]."/".$birthdate[1]."/".$birthdate[0];
    if($birthdate == '00/00/0000'){
        $birthdate = "-";
    }



    $CI =& get_instance();
    $CI->load->model('leave_types_model');
    $CI->load->model('holidays_model');
    $CI->load->model('countries_model');
    $CI->load->model('medical_categories_model');

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

    $medical_expire_date = "";
    if(!empty($details['medical_expire_date'])){
        $medical_expire_date = explode("-", $details['medical_expire_date']);
        $medical_expire_date = $medical_expire_date[2]."/".$medical_expire_date[1]."/".$medical_expire_date[0];
        if($medical_expire_date == '00/00/0000'){
            $medical_expire_date = "";
        }            
    }
    
    $medical_category_name = "";
    if(!empty($details['medical_category_id'])){
        $medical_category_details = $CI->medical_categories_model->get_details($details['medical_category_id']);
        if($medical_category_details){
            $medical_category_name = $medical_category_details['name'];        
        }
    }
  ?>

  <div id="main-content" class="profilepage_2 blog-page">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo  COMPANY_EMPLOYEE_EMPLOYEE; ?></h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"><?php echo  EMPLOYEE_VIEW; ?></li>
                    </ul>
                </div>            
                <div class="col-lg-6 col-md-4 col-sm-12 text-right"></div>
            </div>
        </div>

        <div class="card planned_task">
            <div class="header">
                <h2 class="card-panel-header" style="cursor: pointer;" data-target-body="account_details"><i class="fa fa-plus"></i> <?php echo  EMPLOYEE_ACCOUNT_DETAILS; ?></h2>
                <ul class="header-dropdown">
                    <li class="remove">
                        <a role="button" href="<?= site_url(); ?>employees/company_employees_create_step_1/<?php echo base64_encode($details['id']); ?>"><i class="fa fa-edit"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body card-panel-body" id="account_details">
                <div class="row">
                    <div class="col-md-6">
                        <small class="text-muted"><?php echo  EMPLOYEE_FULL_NAME_ENG; ?> </small>
                        <p><?php echo $details['fullname_english'] ?></p>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted"><?php echo  EMPLOYEE_FULL_NAME_AREBIC; ?> </small>
                        <p><?php echo $details['fullname_arabic'] ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <small class="text-muted"><?php echo  EMPLOYEE_EMAIL; ?> </small>
                        <p><?php echo $details['email'] ?></p>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted"><?php echo  EMPLOYEE_MOBILE; ?> </small>
                        <p><?php echo $details['mobile'] ?></p>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted"><?php echo  EMPLOYEE_PASSWORD; ?> </small>
                        <p><?php echo $details['password'] ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card planned_task">
            <div class="header">
                <h2 class="card-panel-header" style="cursor: pointer;" data-target-body="positional_information"><i class="fa fa-plus"></i> <?php echo  EMPLOYEE_POSITIONAL_INFO; ?></h2>
                <ul class="header-dropdown">
                    <li class="remove">
                        <a role="button" href="<?= site_url(); ?>employees/company_employees_create_step_2/<?php echo base64_encode($details['id']); ?>"><i class="fa fa-edit"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body card-panel-body" id="positional_information">
                <div class="row">
                    <div class="col-md-4">
                        <small class="text-muted"><?php echo  EMPLOYEE_DEPARTMENT; ?></small>
                        <p><?php echo $details['department_name'] ?></p>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted"><?php echo  EMPLOYEE_DESIGNATION; ?> </small>
                        <p><?php echo $details['designation_name'] ?></p>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted"><?php echo  EMPLOYEE_JOB_POSITIONS; ?> </small>
                        <p><?php echo $details['job_position'] ?></p>
                    </div>
                </div>
            </div>
        </div>


        <div class="card planned_task">
            <div class="header">
                <h2 class="card-panel-header" style="cursor: pointer;" data-target-body="personal_information"><i class="fa fa-plus"></i>  <?php echo  EMPLOYEE_PERSONAL_INFO; ?></h2>
                <ul class="header-dropdown">
                    <li class="remove">
                        <a role="button" href="<?= site_url(); ?>employees/company_employees_create_step_3/<?php echo base64_encode($details['id']); ?>"><i class="fa fa-edit"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body card-panel-body" id="personal_information">
                <div class="row">
                    <div class="col-md-3">
                        <small class="text-muted"><?php echo  EMPLOYEE_PERSONAL_EMAIL; ?> </small>
                        <p><?php echo $details['personal_email'] ?></p>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted"><?php echo  EMPLOYEE_PERSONAL_MOBILE; ?></small>
                        <p><?php echo $details['personal_mobile'] ?></p>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted"><?php echo  EMPLOYEE_GENDER; ?> </small>
                        <p><?php echo ucfirst($details['gender']) ?></p>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted"><?php echo  EMPLOYEE_NATIONALITY; ?></small>
                        <p>
                        <?php 
                        if($details['nationality'] == 'saudi'){
                            echo "Son of saudi mother";
                        }
                        if($details['nationality'] == 'foreigner'){
                            echo "No Nationality";
                        }
                        ?>    
                        </p>
                    </div>
                </div>
                <hr>
                <?php 
                if($details['nationality'] == 'foreigner'){
                    $passport_expiry_date = (isset($details) && $details['passport_expiry_date'] != "") ? $details['passport_expiry_date'] : '0000-00-00';

                    $passport_expiry_date = explode("-", $passport_expiry_date);
                    $passport_expiry_date = $passport_expiry_date[2]."/".$passport_expiry_date[1]."/".$passport_expiry_date[0];
                    if($passport_expiry_date == '00/00/0000'){
                        $passport_expiry_date = "-";
                    }
                    $country_name = "";
                    if(!empty($details['employee_country_id'])){
                        $country_details = $CI->countries_model->get_details($details['employee_country_id']);
                        if($country_details){
                            $country_name = $country_details['country_name']." (".$country_details['country_name'].")"; 
                        }
                    }
                    
                ?>
                <div class="row">
                    <div class="col-md-3">
                        <small class="text-muted"><?php echo  EMPLOYEE_PASSPORT_NUMBER; ?> </small>
                        <p><?php echo $details['passport_number'] ?></p>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted"><?php echo  EMPLOYEE_PASSPORT_ISSUE_PALCE; ?> </small>
                        <p><?php echo $details['passport_issue_place'] ?></p>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted"><?php echo  EMPLOYEE_PASSPORT_EXPIRY_DATE; ?> </small>
                        <p><?php echo $passport_expiry_date; ?></p>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted"><?php echo  EMPLOYEE_COUNTRY_LABLE; ?> </small>
                        <p><?php echo $country_name; ?></p>
                    </div>
                </div>
                <hr>
                <?php
                }
                ?>
                <div class="row">
                    <div class="col-md-3">
                        <small class="text-muted"><?php echo  EMPLOYEE_GOSI_NUMBER; ?></small>
                        <p><?php echo $details['gosi_number'] ?></p>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted"><?php echo  EMPLOYEE_ID_NUMBER; ?> </small>
                        <p><?php echo $details['id_number'] ?></p>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted"><?php echo  EMPLOYEE_BIRTHDATE; ?></small>
                        <p><?php echo $birthdate; ?></p>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted"><?php echo  EMPLOYEE_SOCIAL_STATUS; ?> </small>
                        <p><?php echo ucfirst($details['social_status']) ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <small class="text-muted"><?php echo  EMPLOYEE_REGION; ?> </small>
                        <p><?php echo ucfirst($details['religion']) ?></p>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted"><?php echo  EMPLOYEE_NUMBER_OF_DEPENDANT; ?> </small>
                        <p><?php echo $details['number_of_dependent'] ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <p><b><?php echo  EMPLOYEE_ADDRESS_MOTHER_CITY; ?></b></p>
                        <hr>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted"><?php echo  EMPLOYEE_ADDRESS; ?> </small>
                        <p><?php echo $details['mother_city_address'] ?></p>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted"><?php echo  EMPLOYEE_CITY; ?> </small>
                        <p><?php echo $details['mother_city_city'] ?></p>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted"><?php echo  EMPLOYEE_STATE; ?></small>
                        <p><?php echo $details['mother_city_state'] ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <p><b><?php echo  EMPLOYEE_ADDRESS_IN_MOTHER_KINGDOM; ?></b></p>
                        <hr>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted"><?php echo  EMPLOYEE_PO_BOX; ?> </small>
                        <p><?php echo $details['mother_city_address'] ?></p>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted"><?php echo  EMPLOYEE_BUILDING_NO; ?> </small>
                        <p><?php echo $details['mother_city_city'] ?></p>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted"><?php echo  EMPLOYEE_STREET_NAME; ?> </small>
                        <p><?php echo $details['mother_city_state'] ?></p>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted"><?php echo  EMPLOYEE_REGION; ?> </small>
                        <p><?php echo $details['kingdom_region_name'] ?></p>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted"><?php echo  EMPLOYEE_CITY; ?> </small>
                        <p><?php echo $details['kingdom_city_name'] ?></p>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted"><?php echo  EMPLOYEE_ZIP_CODE; ?> </small>
                        <p><?php echo $details['kingdom_zipcode'] ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <p><b><?php echo  COMPANY_EMPLOYEE_BANK_DETAIL; ?></b></p>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted"><?php echo  COMPANY_EMPLOYEE_BANK_NAME; ?> </small>
                        <p><?php echo $details['bank_name'] ?></p>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted"><?php echo  COMPANY_EMPLOYEE_BANK_IBAN_NO; ?> </small>
                        <p><?php echo $details['bank_iban_number'] ?></p>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted"><?php echo  COMPANY_EMPLOYEE_BANK_ACCOUNT_NO; ?> </small>
                        <p><?php echo $details['bank_account_number'] ?></p>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted"><?php echo  COMPANY_EMPLOYEE_BANK_ID_NUMBER; ?> </small>
                        <p><?php echo $details['bank_id_number'] ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <p><b><?php echo  COMPANY_EMPLOYEE_MEDICAL_DETAILS; ?></b></p>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted"><?php echo  COMPANY_EMPLOYEE_MEDICAL_COMPANY_NAME; ?> </small>
                        <p><?php echo $details['medical_company_name'] ?></p>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted"><?php echo  COMPANY_EMPLOYEE_MEDICAL_CATEGORY; ?> </small>
                        <p><?php echo $medical_category_name ?></p>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted"><?php echo  COMPANY_EMPLOYEE_MEDICAL_EXPIRY_DATE; ?> </small>
                        <p><?php echo $medical_expire_date; ?></p>
                    </div>
                </div>
                <div class="row clearfix file_manager">
                    <div class="col-md-12">
                        <small class="text-muted"><?php echo  COMPANY_EMPLOYEE_MEDICAL_DOCUMENTS; ?>: </small>
                    </div>
                    <?php 
                    if(isset($details['medical_documents'])){
                    foreach ($details['medical_documents'] as $key => $value) {
                        $pathinfo = pathinfo(site_url().'uploads/'.$value['document_file']);
                        $file_icon = get_file_icon($pathinfo['extension']);
                    ?>
                        <div class="col-lg-3 col-md-4 col-sm-12" id="document-<?php echo $value['id']; ?>">
                            <div class="card">
                                <div class="file">
                                    <a href="javascript:void(0);">
                                        <div class="icon">
                                            <i class="fa <?php echo $file_icon; ?> text-info"></i>
                                        </div>
                                        <div class="file-name">
                                            <p class="m-b-5 text-muted"><a download="<?php echo $value['document_file']; ?>" href="<?= site_url(); ?>uploads/<?php echo $value['document_file']; ?>"><?php echo $value['document_file']; ?></a></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php    
                    }
                    }
                    ?>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <p><b><?php echo  COMPANY_EMPLOYEE_EXTRA_BENIFIT; ?></b></p>
                        <hr>
                    </div>
                    <?php
                    if(!empty($employee_benefits)){
                        foreach ($employee_benefits as $key => $value) {
                    ?>
                    <?php if($key > 0){ ?>
                    <div class="col-md-12">
                        <hr>
                    </div>
                    <?php } ?>
                    <div class="col-md-12">
                        <small class="text-muted"><?php echo COMPANY_EMPLOYEE_EXTRA_BENIFIT_TITLE; ?> </small>
                        <p><?php echo $value['extra_benifit_title'] ?></p>
                    </div>
                    <div class="col-md-12">
                        <small class="text-muted"><?php echo COMPANY_EMPLOYEE_EXTRA_BENIFIT_NUMBER; ?> </small>
                        <p><?php echo $value['extra_benifit_number'] ?></p>
                    </div>
                    <div class="col-md-12">
                        <small class="text-muted"><?php echo COMPANY_EMPLOYEE_EXTRA_BENIFIT_NOTE; ?> </small>
                        <p><?php echo $value['extra_benifit_note'] ?></p>
                    </div>
                    <?php 
                        } 
                    }
                    ?>
                </div>

            </div>
        </div>

        <div class="card planned_task">
            <div class="header">
                <h2 class="card-panel-header" style="cursor: pointer;" data-target-body="emergency_contacts"><i class="fa fa-plus"></i>    <?php echo  EMPLOYEE_EMERGENCY_CONTACTS; ?></h2>
                <ul class="header-dropdown">
                    <li class="remove">
                        <a role="button" href="<?= site_url(); ?>employees/company_employees_create_step_4/<?php echo base64_encode($details['id']); ?>"><i class="fa fa-edit"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body card-panel-body" id="emergency_contacts">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped js-basic-example dataTable table-custom">
                                <thead class="thead-dark">
                                    <tr>
                                        <th><?php echo  EMPLOYEE_CONTACT_NAME; ?></th>
                                        <th><?php echo  EMPLOYEE_ADDRESS; ?></th>
                                        <th><?php echo  EMPLOYEE_RELATIONSHIP; ?></th>
                                        <th><?php echo  EMPLOYEE_MOBILE; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!empty($emergency_contacts)){
                                    foreach ($emergency_contacts as $key => $value) {                                       
                                    ?>
                                    <tr>
                                        <td><?php echo $value['contact_name']; ?></td>
                                        <td><?php echo $value['address']; ?></td>
                                        <td><?php echo $value['relationship']; ?></td>
                                        <td><?php echo $value['mobile']; ?></td>
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

        <div class="card planned_task">
            <div class="header">
                <h2 class="card-panel-header" style="cursor: pointer;" data-target-body="qualification"><i class="fa fa-plus"></i> <?php echo  EMPLOYEE_QUALIFICATION; ?></h2>
                <ul class="header-dropdown">
                    <li class="remove">
                        <a role="button" href="<?= site_url(); ?>employees/company_employees_create_step_5/<?php echo base64_encode($details['id']); ?>"><i class="fa fa-edit"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body card-panel-body" id="qualification">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped js-basic-example dataTable table-custom">
                                <thead class="thead-dark">
                                    <tr>
                                        <th><?php echo  EMPLOYEE_SPECIALIZATION; ?></th>
                                        <th><?php echo  EMPLOYEE_INSTITUTE; ?></th>
                                        <th><?php echo  EMPLOYEE_FROM_YEAR; ?></th>
                                        <th><?php echo  EMPLOYEE_TO_YEAR; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!empty($educations)){
                                    foreach ($educations as $key => $value) {                                       
                                    ?>
                                    <tr>
                                        <td><?php echo $value['specialization']; ?></td>
                                        <td><?php echo $value['institute_name']; ?></td>
                                        <td><?php echo $value['from_year']; ?></td>
                                        <td><?php echo $value['to_year']; ?></td>
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

        <div class="card planned_task">
            <div class="header">
                <h2 class="card-panel-header" style="cursor: pointer;" data-target-body="work_experience"><i class="fa fa-plus"></i> <?php echo  EMPLOYEE_WORK_EXPERIANCE; ?></h2>
                <ul class="header-dropdown">
                    <li class="remove">
                        <a role="button" href="<?= site_url(); ?>employees/company_employees_create_step_6/<?php echo base64_encode($details['id']); ?>"><i class="fa fa-edit"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body card-panel-body" id="work_experience">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped js-basic-example dataTable table-custom">
                                <tbody>
                                <?php
                                if(!empty($work_experience_items)){
                                    foreach ($work_experience_items as $key => $value) {
                                    $from_date = (isset($value) && $value['from_date'] != "") ? $value['from_date'] : '0000-00-00';

                                    $from_date = explode("-", $from_date);
                                    $from_date = $from_date[2]."/".$from_date[1]."/".$from_date[0];
                                    if($from_date == '00/00/0000'){
                                        $from_date = "-";
                                    }   

                                    $to_date = (isset($value) && $value['to_date'] != "") ? $value['to_date'] : '0000-00-00';

                                    $to_date = explode("-", $to_date);
                                    $to_date = $to_date[2]."/".$to_date[1]."/".$to_date[0];
                                    if($to_date == '00/00/0000'){
                                        $to_date = "-";
                                    }                              
                                    ?>
                                    <tr>
                                        <td>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <small class="text-muted"><?php echo  EMPLOYEE_POSITIONS; ?></small>
                                                <p><?php echo $value['position'] ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <small class="text-muted"><?php echo  EMPLOYEE_NAME; ?></small>
                                                <p><?php echo $value['employer_name'] ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <small class="text-muted"><?php echo  EMPLOYEE_JOB_TASK; ?> </small>
                                                <p><?php echo $value['job_task'] ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <small class="text-muted"><?php echo  EMPLOYEE_TOTAL_SALARY; ?></small>
                                                <p><?php echo $value['total_salary'] ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <small class="text-muted"><?php echo  EMPLOYEE_FROM_DATE; ?> </small>
                                                <p><?php echo $from_date; ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <small class="text-muted"><?php echo  EMPLOYEE_TO_DATE; ?> </small>
                                                <p><?php echo $to_date; ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted"><?php echo  EMPLOYEE_ADDRESS; ?></small>
                                                <p><?php echo $value['address'] ?></p>
                                            </div>
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

        <div class="card planned_task">
            <div class="header">
                <h2 class="card-panel-header" style="cursor: pointer;" data-target-body="leave_details"><i class="fa fa-plus"></i> <?php echo  EMPLOYEE_LEAVE_DETAILS; ?></h2>
                <ul class="header-dropdown">
                    <li class="remove">
                        <a role="button" href="<?= site_url(); ?>employees/company_employees_create_step_4/<?php echo base64_encode($details['id']); ?>"><i class="fa fa-edit"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body card-panel-body" id="leave_details">
                <div class="row">
                    <div class="col-md-3">
                        <small class="text-muted"><?php echo  EMPLOYEE_LEAVE_GROUP; ?> </small>
                        <p><?php echo $details['mother_city_address'] ?></p>
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
                    <div class="col-md-3">
                        <small class="text-muted"><?php echo  EMPLOYEE_HOLIDAY_GROUP; ?></small>
                        <p><?php echo $details['mother_city_address'] ?></p>
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
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <small class="text-muted"><?php echo  EMPLOYEE_WORKWEEK_SHIFT; ?> </small>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <table class="table table-hover js-basic-example dataTable table-custom">
                          <thead class="thead-dark">
                            <tr>
                              <th width="15%"><?php echo  EMPLOYEE_DAY; ?></th>
                              <th width="15%"><?php echo  EMPLOYEE_IS_WORKING; ?></th>
                              <th width="80%"><?php echo  EMPLOYEE_SHIFT; ?></th>
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
                                                  <input disabled <?php echo $checked; ?> name="<?php echo $day; ?>[]" type="checkbox" value="<?php echo $value['id']; ?>">
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
            </div>
        </div>

        <div class="card planned_task">
            <div class="header">
                <h2 class="card-panel-header" style="cursor: pointer;" data-target-body="salary_details"><i class="fa fa-plus"></i><?php echo  EMPLOYEE_SALARY_DETAILS; ?></h2>
                <ul class="header-dropdown">
                    <li class="remove">
                        <a role="button" href="<?= site_url(); ?>employees/company_employees_create_step_8/<?php echo base64_encode($details['id']); ?>"><i class="fa fa-edit"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body card-panel-body" id="salary_details">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo  EMPLOYEE_ANNUAL_CTC; ?> </label><br>
                            <?php echo $details['annual_ctc']; ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo  EMPLOYEE_MONTHLY; ?></label><br>
                            <?php echo round($details['annual_ctc']/12,2); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <br>
                        <button type="button" name="preview_salary" id="preview_salary_btn" value="
                                            submit_btn" class="btn btn-primary" data-toggle="modal"><?php echo  EMPLOYEE_PREVIEW_SALARY_SLEEP; ?></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <address style="margin: 0px;">
                            <strong><?php echo  EMPLOYEE_EARNING_COMPONENT; ?></strong> 
                            <br>
                            <?php echo  EMPLOYEE_EARNING_COMPONENT_WITH_SALARY; ?><br>
                        </address>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table-custom m-b-0">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="20%"><?php echo  EMPLOYEE_NAMES; ?></th>
                                        <th width="20%"><?php echo  EMPLOYEE_COMPONENT_TYPE; ?></th>
                                        <th width="20%"><?php echo  EMPLOYEE_AMMOUNT; ?></th>
                                        <th width="20%"><?php echo  EMPLOYEE_VALUE; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php

                                if(!empty($salary_components_earning)){
                                    foreach ($salary_components_earning as $key => $value) { 

                                    $salary_component_value = $value['value'];
                                    $salary_amount = "";

                                    $checked = "";
                                    $disabled = "disabled";
                                    foreach ($employee_salary_components as $sal_compo_value) {
                                        if($value['id'] == $sal_compo_value['salary_component_id']){
                                            $checked = "checked";
                                            $disabled = "disabled";
                                            $salary_component_value = $sal_compo_value['salary_component_value'];
                                            $salary_amount = $sal_compo_value['salary_amount'];
                                        }
                                    }

                                ?>
                                    <tr>
                                        <td>
                                            <div class="fancy-checkbox">
                                                <label><input disabled class="salary_component_id" <?php echo $checked; ?> type="checkbox" data-component-type="<?php echo $value['component_type']; ?>" data-component-name="<?php echo $value['name_in_payslip']; ?>" name="salary_component_id[]" value="<?php echo $value['id']; ?>"><span></span></label>
                                            </div>
                                        </td>
                                        <td><?php echo $value['name'] ?></td>
                                        <td>
                                        <?php 
                                        if($value['component_type'] == "earning"){
                                            echo'<a style="cursor: pointer;" class="badge badge-success">earning</a>';
                                        }
                                        if($value['component_type'] == "deduction"){
                                            echo'<a style="cursor: pointer;" class="badge badge-success">deduction</a>';
                                        }
                                        ?>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input readonly size="1" type="text" class="form-control" name="salary_amount_<?php echo $value['id']; ?>" value="<?php echo $salary_amount; ?>" id="salary_amount_<?php echo $value['id']; ?>">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><?php echo  EMPLOYEE_SAR; ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input data-id="<?php echo $value['id']; ?>" <?php echo $disabled; ?>  type="number" class="form-control calculation_value" name="value_<?php echo $value['id']; ?>" value="<?php echo $salary_component_value; ?>" id="value_<?php echo $value['id']; ?>">

                                                <!-- calculation_type  -->
                                                <input type="hidden" value="<?php echo $value['calculation_type']; ?>" name="calculation_type"  id="calculation_type_<?php echo $value['id']; ?>">

                                                <div class="input-group-append">
                                                <?php 
                                                if($value['calculation_type'] == "flat_amount"){
                                                    echo'<span class="input-group-text">SAR</span>';
                                                }
                                                if($value['calculation_type'] == "percentage"){
                                                    echo'<span class="input-group-text">%</span>';
                                                }
                                                ?>
                                                    
                                                </div>
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
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <address style="margin: 0px;">
                            <strong><?php echo  EMPLOYEE_DEDUCTUION_COMPONENT; ?></strong> 
                            <br>
                            <?php echo  EMPLOYEE_DEDUCTUION_COMPONENT_WITH_SALARY; ?><br>
                        </address>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table-custom m-b-0">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="20%"><?php echo  EMPLOYEE_NAMES; ?></th>
                                        <th width="20%"><?php echo  EMPLOYEE_COMPONENT_TYPE; ?></th>
                                        <th width="20%"><?php echo  EMPLOYEE_AMMOUNT; ?></th>
                                        <th width="20%"><?php echo  EMPLOYEE_VALUE; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php

                                if(!empty($salary_components_deduction)){
                                    foreach ($salary_components_deduction as $key => $value) { 

                                    $salary_component_value = $value['value'];
                                    $salary_amount = "";

                                    $checked = "";
                                    $disabled = "disabled";
                                    foreach ($employee_salary_components as $sal_compo_value) {
                                        if($value['id'] == $sal_compo_value['salary_component_id']){
                                            $checked = "checked";
                                            $disabled = "disabled";
                                            $salary_component_value = $sal_compo_value['salary_component_value'];
                                            $salary_amount = $sal_compo_value['salary_amount'];
                                        }
                                    }

                                ?>
                                    <tr>
                                        <td>
                                            <div class="fancy-checkbox">
                                                <label><input disabled class="salary_component_id" <?php echo $checked; ?> type="checkbox" data-component-type="<?php echo $value['component_type']; ?>" data-component-name="<?php echo $value['name_in_payslip']; ?>" name="salary_component_id[]" value="<?php echo $value['id']; ?>"><span></span></label>
                                            </div>
                                        </td>
                                        <td><?php echo $value['name'] ?></td>
                                        <td>
                                        <?php 
                                        if($value['component_type'] == "earning"){
                                            echo'<a style="cursor: pointer;" class="badge badge-success">earning</a>';
                                        }
                                        if($value['component_type'] == "deduction"){
                                            echo'<a style="cursor: pointer;" class="badge badge-success">deduction</a>';
                                        }
                                        ?>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input readonly size="1" type="text" class="form-control" name="salary_amount_<?php echo $value['id']; ?>" value="<?php echo $salary_amount; ?>" id="salary_amount_<?php echo $value['id']; ?>">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">SAR</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input data-id="<?php echo $value['id']; ?>" <?php echo $disabled; ?> size="1" type="number" class="form-control calculation_value" name="value_<?php echo $value['id']; ?>" value="<?php echo $salary_component_value; ?>" id="value_<?php echo $value['id']; ?>">

                                                <!-- calculation_type  -->
                                                <input type="hidden" value="<?php echo $value['calculation_type']; ?>" name="calculation_type"  id="calculation_type_<?php echo $value['id']; ?>">

                                                <div class="input-group-append">
                                                <?php 
                                                if($value['calculation_type'] == "flat_amount"){
                                                    echo'<span class="input-group-text">SAR</span>';
                                                }
                                                if($value['calculation_type'] == "percentage"){
                                                    echo'<span class="input-group-text">%</span>';
                                                }
                                                ?>
                                                    
                                                </div>
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


<div class="modal animated jello" id="preview_salary" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel"><?php echo  EMPLOYEE_SALARY_SLEEP; ?></h4>
            </div>           
            <div class="modal-body">
                <table class="salary-preview-inner-table" border="1" width="100%" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td width="50%" align="center"><h6 style="margin: 5px 5px;"><?php echo  EMPLOYEE_EARNING; ?></h6></td>
                            <td width="50%" align="center"><h6 style="margin: 5px 5px;"><?php echo  EMPLOYEE_DEDUCTION; ?></h6></td>
                        </tr>
                        <tr class="border_btm">
                            <td valign="top">
                                <table class="salary-preview-inner-table" border="0" width="100%" id="earning-table">

                                </table>
                            </td>
                            <td valign="top">
                                <table class="salary-preview-inner-table" border="0" width="100%" id="deduction-table">         

                                </table>
                            </td>
                        </tr>
                        <tr class="border_btm">
                            <td valign="top">
                                <table class="salary-preview-inner-table" border="0" width="100%">
                                <tr>
                                    <td width="70%" class="border_right"><?php echo  EMPLOYEE_TOTAL_EARNING; ?></td>
                                    <td width="30%" id="total_earning_value"></td>
                                </tr>
                                </table>
                            </td>
                            <td valign="top">
                                <table class="salary-preview-inner-table" border="0" width="100%">
                                    <tr>
                                        <td width="70%" class="border_right"><?php echo  EMPLOYEE_TOTAL_DEDUCTION; ?></td>
                                        <td width="30%" id="total_deduction_value"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="border_btm">
                            <td valign="top">
                                <table class="salary-preview-inner-table" border="0" width="100%">
                                <tr>
                                    <td width="70%" class="border_right"><?php echo  EMPLOYEE_NET_BALANCE; ?></td>
                                    <td width="30%" id="net_balance_value"></td>
                                </tr>
                                </table>
                            </td>
                            <td valign="top">
                                <table class="salary-preview-inner-table" border="0" width="100%">
                                    <tr><td>&nbsp</td></tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo  EMPLOYEE_CLOSE; ?></button>
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

<!-- bootstrap treeview -->
<script src="<?= site_url(); ?>assets/vendor/bootstrap-treeview/bootstrap-treeview.min.js"></script>

<!-- SweetAlert For Dialog Box --> 
<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script> 

<!-- Toaster --> 
<script src="<?= site_url(); ?>assets/vendor/toastr/toastr.js"></script> 

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 


<script type="text/javascript">
    $(function () {      
        //display tree view data 

        $('.card-panel-header').click(function(){
            var target_id = $(this).attr("data-target-body");
            $("#"+target_id).toggle('slow');
            if($(this).children().hasClass('fa-plus')){
                $(this).find('.fa-plus').addClass('fa-minus');
                $(this).find('.fa-plus').removeClass('fa-plus');
            }else{
                $(this).find('.fa-minus').addClass('fa-plus');
                $(this).find('.fa-minus').removeClass('fa-minus');
            }
        });      

        $("#preview_salary_btn").click(function(){

            var total_earning = 0;
            var total_deduction = 0;
            var net_balance = 0;

            var earning_html = "";
            var deduction_html = "";

            $(".salary_component_id:checked").each(function(){
                var component_type = $(this).attr('data-component-type');
                var component_name = $(this).attr('data-component-name');

                var row_id = $(this).val();
                var component_amount = $("#salary_amount_"+row_id).val();
                component_amount = parseFloat(component_amount);
                

                if(component_type == "earning"){
                    total_earning = total_earning + component_amount;
                    earning_html += "<tr class='border_btm'><td width='70%' class='border_right'>"+component_name+"</td><td width='30%'>"+component_amount+"</td></tr>";
                    
                }
                if(component_type == "deduction"){
                    total_deduction = total_deduction + component_amount;
                    deduction_html += "<tr class='border_btm'><td class='border_right' width='70%'>"+component_name+"</td><td width='30%'>"+component_amount+"</td></tr>";
                    
                }
                
            });

            $("#earning-table").html(earning_html);
            $("#deduction-table").html(deduction_html);

            var net_balance = total_earning - total_deduction;
            
            net_balance = parseFloat(net_balance);

            $("#total_earning_value").html(total_earning);
            $("#total_deduction_value").html(total_deduction);
            $("#net_balance_value").html(net_balance.toFixed(2));

            $("#preview_salary").modal("show");
        }); 
    });
</script>