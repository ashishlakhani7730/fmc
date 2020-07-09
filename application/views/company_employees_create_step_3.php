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
    ?>

    <?php 
        $id = (isset($details) && $details['id']) ? $details['id'] : '';

        $birthdate = (isset($details) && $details['birthdate'] != "") ? $details['birthdate'] : '0000-00-00';
        $birthdate = explode("-", $birthdate);
        $birthdate = $birthdate[2]."/".$birthdate[1]."/".$birthdate[0];
        if($birthdate == '00/00/0000'){
            $birthdate = "";
        }

        $medical_expire_date = "";
        if(!empty($details['medical_expire_date'])){
            $medical_expire_date = explode("-", $details['medical_expire_date']);
            $medical_expire_date = $medical_expire_date[2]."/".$medical_expire_date[1]."/".$medical_expire_date[0];
            if($medical_expire_date == '00/00/0000'){
                $medical_expire_date = "";
            }            
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
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>employees"><?php echo COMPANY_EMPLOYEE_EMPLOYEE; ?></a></li>
                            <li class="breadcrumb-item active"><?php echo COMPANY_EMPLOYEE_PERSONAL_INFO; ?></li>
                        </ul>                        
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                                             
                    </div>
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

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_3/<?php echo base64_encode($id); ?>" class="flex-item-custom active">3. <br /> <span><?php echo COMPANY_EMPLOYEE_PERSONAL_INFO; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_4/<?php echo base64_encode($id); ?>" class="flex-item-custom">4. <br /> <span><?php echo COMPANY_EMPLOYEE_EMERGENCY_CONTACT; ?></span></a>
                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_5/<?php echo base64_encode($id); ?>" class="flex-item-custom">5. <br /> <span><?php echo COMPANY_EMPLOYEE_QUALIFICATION; ?></span></a>
                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_6/<?php echo base64_encode($id); ?>" class="flex-item-custom">6. <br /> <span><?php echo COMPANY_EMPLOYEE_WORK_EXP; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_7/<?php echo base64_encode($id); ?>" class="flex-item-custom">7. <br /> <span><?php echo COMPANY_EMPLOYEE_LEAVE_DETAILS; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_8/<?php echo base64_encode($id); ?>" class="flex-item-custom">8. <br /> <span><?php echo COMPANY_EMPLOYEE_SALARY_DETAILS; ?></span></a>

                                        <a href="<?= site_url(); ?>employees/company_employees_create_step_9/<?php echo base64_encode($id); ?>" class="flex-item-custom">9. <br /> <span><?php echo "Personal Documents"; ?></span></a>
                                    </div>
                                    <div class="custom-hr"><hr /></div>
                                </div>
                            </div>
                            <form action="<?= base_url('employees/company_employees_create_step_3');?>" id="create-employee" method="post" novalidate enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo base64_encode($id); ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_PERSONAL_EMAIL; ?> </label>
                                            <input type="email" class="form-control" name="personal_email" value="<?php echo $details['personal_email']; ?>" placeholder="<?php echo COMPANY_EMPLOYEE_PERSONAL_EMAIL; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_PERSONAL_MOBILE; ?></label>
                                            <input type="number" class="form-control" name="personal_mobile" value="<?php echo $details['personal_mobile']; ?>" placeholder="<?php echo COMPANY_EMPLOYEE_PERSONAL_MOBILE; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_GENDER; ?></label>
                                            <select name="gender" class="form-control" data-placeholder="Select Gender">
                                                <option value=""><?php echo COMPANY_EMPLOYEE_SELECT_GENDER; ?></option>
                                                <option value="male" <?php echo ($details['gender'] == 'male') ? 'selected' : ''; ?>><?php echo COMPANY_EMPLOYEE_MALE; ?></option>
                                                <option value="female" <?php echo ($details['gender'] == 'female') ? 'selected' : ''; ?>><?php echo COMPANY_EMPLOYEE_FEMALE; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_NATIONALITY; ?></label>
                                            <select name="nationality" id="nationality" class="form-control" data-placeholder="Select Nationality">
                                                <option value=""><?php echo COMPANY_EMPLOYEE_SELECT_NATIONALITY; ?></option>
                                                <option value="saudi" <?php echo ($details['nationality'] == 'saudi') ? 'selected' : ''; ?>><?php echo COMPANY_EMPLOYEE_SOSM; ?></option>
                                                <option value="foreigner" <?php echo ($details['nationality'] == 'foreigner') ? 'selected' : ''; ?>><?php echo COMPANY_EMPLOYEE_NO_NATIONALITY; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                $is_passport_display = "display: none;";
                                $is_country_display = "display: none;";
                                if($details['nationality'] == 'foreigner'){
                                    $is_passport_display = "";    
                                    $is_country_display = "";
                                }
                                ?>
                                <div class="row" style="<?php echo $is_passport_display; ?>" id="passport_row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_PASSPORT_NUMBER; ?></label>
                                            <input type="text" class="form-control" name="passport_number" value="<?php echo $details['passport_number']; ?>" placeholder="<?php echo COMPANY_EMPLOYEE_PASSPORT_NUMBER; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_PASSPORT_ISSUE_PLACE; ?> </label>
                                            <input type="text" class="form-control" name="passport_issue_place" value="<?php echo $details['passport_issue_place']; ?>" placeholder="<?php echo COMPANY_EMPLOYEE_PASSPORT_ISSUE_PLACE; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_PASSPORT_EXPIRY_DATE; ?> </label>
                                            <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="passport_expiry_date" placeholder="<?php echo COMPANY_EMPLOYEE_PASSPORT_EXPIRY_DATE; ?>" autocomplete="off" value="" readonly>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                $is_gosi_number = "display: none;";
                                if($details['nationality'] == 'saudi'){
                                    $is_gosi_number = "";    
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-4" id="is_gosi_number" style="<?php echo $is_gosi_number; ?>">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_GOSI_NUMBER; ?> </label>
                                            <input type="text" class="form-control" name="gosi_number" value="<?php echo $details['gosi_number']; ?>" placeholder="<?php echo COMPANY_EMPLOYEE_GOSI_NUMBER; ?>">
                                        </div>
                                    </div>                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_ID_NUMBER; ?></label>
                                            <input type="text" class="form-control" name="id_number" value="<?php echo $details['id_number']; ?>" placeholder="<?php echo COMPANY_EMPLOYEE_ID_NUMBER; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_BORTHDATE; ?> </label>
                                            <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="birthdate" placeholder="<?php echo COMPANY_EMPLOYEE_BORTHDATE; ?>" autocomplete="off" value="<?php echo $birthdate; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="employee_country_box" style="<?php echo $is_country_display; ?>">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_COUNTRY; ?></label>
                                            <select name="employee_country_id" class="form-control show-tick ms select2" data-placeholder="Select Country of Origin" required>
                                                <option value=""><?php echo COMPANY_EMPLOYEE_SELECT_COUNTRY; ?></option>
                                                <?php
                                                if(!empty($countries)){
                                                    foreach ($countries as $key => $value) {
                                                        $selected = "";
                                                        
                                                        if(!empty($details['employee_country_id'])){
                                                            if($value['id'] == $details['employee_country_id']){
                                                                $selected = "selected";
                                                            }
                                                        }else{
                                                            if($value['is_default'] == '1'){
                                                                $selected = "selected";
                                                            }
                                                        }
                                                ?>
                                                    ?>
                                                        <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['country_name']." (".$value['country_code'].")"; ?></option>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_SOCIAL_STATUS; ?> </label>
                                            <select name="social_status" id="social_status" class="form-control" data-placeholder="Social Status">
                                                <option value=""><?php echo COMPANY_EMPLOYEE_SOCIAL_STATUS; ?></option>
                                                <option value="married" <?php echo ($details['social_status'] == 'married') ? 'selected' : ''; ?>><?php echo COMPANY_EMPLOYEE_MARRIED; ?></option>
                                                <option value="single" <?php echo ($details['social_status'] == 'single') ? 'selected' : ''; ?>><?php echo COMPANY_EMPLOYEE_SINGLE; ?></option>
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_NO_OF_DEPENDENT; ?> </label>
                                            <input disabled type="text" class="form-control" name="number_of_dependent" id="number_of_dependent" value="<?php echo $details['number_of_dependent']; ?>" placeholder="<?php echo COMPANY_EMPLOYEE_NO_OF_DEPENDENT; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_RELIGION; ?> </label>
                                            <select name="religion" id="religion" class="form-control" data-placeholder="Religion">
                                                <option value=""><?php echo COMPANY_EMPLOYEE_SOCIAL_RELIGION; ?></option>
                                                <option value="muslim" <?php echo ($details['religion'] == 'muslim') ? 'selected' : ''; ?>><?php echo COMPANY_EMPLOYEE_MUSLIM; ?></option>
                                                <option value="non_muslim" <?php echo ($details['religion'] == 'non_muslim') ? 'selected' : ''; ?>><?php echo COMPANY_EMPLOYEE_NON_MUSLIM; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b><?php echo COMPANY_EMPLOYEE_ADD_MOTHER_CITY; ?></b></p>
                                        <hr>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_ADDRESS; ?><span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="mother_city_address" value="<?php echo $details['mother_city_address']; ?>" placeholder="<?php echo COMPANY_EMPLOYEE_ADDRESS; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_CITY; ?><span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="mother_city_city" value="<?php echo $details['mother_city_city']; ?>" placeholder="<?php echo COMPANY_EMPLOYEE_CITY; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_STATE; ?><span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="mother_city_state" value="<?php echo $details['mother_city_state']; ?>" placeholder="<?php echo COMPANY_EMPLOYEE_STATE; ?>" required>
                                        </div>
                                    </div>                                   
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b><?php echo COMPANY_EMPLOYEE_ADD_IN_KING; ?></b></p>
                                        <hr>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_P_O_BOX; ?><span class="text-danger">*</span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="text" class="form-control" name="kingdom_po_box" value="<?php echo $details['kingdom_po_box']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_BUILDING_NO; ?><span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="kingdom_building_no" value="<?php echo $details['kingdom_building_no']; ?>" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_STREET_NAME; ?><span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="kingdom_street_name" value="<?php echo $details['kingdom_street_name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_RELIGION; ?><span class="text-danger">*</span></label>
                                            <select name="kingdom_region_id" class="form-control show-tick ms select2" data-placeholder="Select Regions" required>
                                            <?php
                                            foreach ($regions as $key => $value) {
                                                $selected = "";
                                                if($details['kingdom_region_id'] == $value['id']){
                                                    $selected = "selected";
                                                }                                
                                            ?>
                                                <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                            </select>
                                        </div>
                                    </div>                              
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_CITY; ?><span class="text-danger">*</span></label>
                                            <select name="kingdom_city_id" class="form-control show-tick ms select2" data-placeholder="Select Regions" required>
                                            <?php
                                            foreach ($cities as $key => $value) {
                                                $selected = "";
                                                if($details['kingdom_city_id'] == $value['id']){
                                                    $selected = "selected";
                                                }                                
                                            ?>
                                                <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_ZIP_CODE; ?><span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="kingdom_zipcode" value="<?php echo $details['kingdom_zipcode']; ?>" required>
                                        </div>
                                    </div>

                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b><?php echo COMPANY_EMPLOYEE_BANK_DETAIL; ?></b></p>
                                        <hr>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_BANK_NAME; ?> </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="text" class="form-control" name="bank_name" value="<?php echo $details['bank_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_BANK_IBAN_NO; ?> </label>
                                            <input type="text" class="form-control" name="bank_iban_number" value="<?php echo $details['bank_iban_number']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_BANK_ACCOUNT_NO; ?></label>
                                            <input type="text" class="form-control" name="bank_account_number" value="<?php echo $details['bank_account_number']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_BANK_ID_NUMBER; ?></label>
                                            <input type="text" class="form-control" name="bank_id_number" value="<?php echo $details['bank_id_number']; ?>">
                                        </div>
                                    </div>
                                </div>


                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b><?php echo COMPANY_EMPLOYEE_MEDICAL_DETAILS; ?></b></p>
                                        <hr>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_MEDICAL_COMPANY_NAME; ?> </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="text" class="form-control" name="medical_company_name" value="<?php echo $details['medical_company_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_MEDICAL_CATEGORY; ?> </label>
                                            <select name="medical_category_id" class="form-control show-tick ms select2" data-placeholder="Select Regions">
                                            <?php
                                            foreach ($medical_categories as $key => $value) {
                                                $selected = "";
                                                if($details['medical_category_id'] == $value['medical_category_id']){
                                                    $selected = "selected";
                                                }                                
                                            ?>
                                                <option value="<?php echo $value['medical_category_id']; ?>" <?php echo $selected; ?>><?php echo $value['name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_MEDICAL_EXPIRY_DATE; ?></label>
                                            <input type="text" class="form-control" id="medical_expire_date" name="medical_expire_date" value="<?php echo $medical_expire_date; ?>" readonly>
                                        </div>
                                    </div> 
                                    <div class="col-md-12 col-sm-12">                        
                                        <div class="form-group">
                                            <label for="medical_documents" style="width: 100%;">
                                                <input type="file" class="dropify" name="medical_documents[]" id="medical_documents" multiple="true">
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix file_manager">
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
                                                    <div class="hover">
                                                        <button onclick="deleteDocument(<?php echo $value['id']; ?>);" type="button" class="btn btn-icon btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
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

                                <div class="row clearfix file_manager" id="item-documents-list">
                                
                                </div>   

                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b><?php echo COMPANY_EMPLOYEE_EXTRA_BENIFIT; ?></b></p>
                                        <hr>
                                    </div>
                                </div>    
                                <div class="row-box">
                                    <?php
                                    if(!empty($employee_benefits)){
                                        foreach ($employee_benefits as $key => $value) {
                                    ?>
                                    <div class="row" id="rows_<?php echo $key; ?>">
                                        <div class="col-md-12 text-left">
                                            <?php if($key > 0){ ?>
                                            <hr>
                                            <?php } ?>
                                            <button type="button" data-row-id="<?php echo $key; ?>" class="btn btn-sm btn-outline-danger delete-btn" title="Delete"><i class="fa fa-trash-o"></i></button><br><br>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_EXTRA_BENIFIT_TITLE; ?> </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="text" class="form-control" name="extra_benifit_title[]" value="<?php echo $value['extra_benifit_title']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_EXTRA_BENIFIT_NUMBER; ?></label>
                                                <input type="text" class="form-control" name="extra_benifit_number[]" value="<?php echo $value['extra_benifit_number']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_EXTRA_BENIFIT_NOTE; ?></label>
                                                <textarea class="form-control" name="extra_benifit_note[]"><?php echo $value['extra_benifit_note']; ?></textarea>
                                            </div>
                                        </div>                                    
                                    </div>
                                    <?php 
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-success" id="add-more"><?php echo COMPANY_EMPLOYEE_EXTRA_BENIFIT_ADD_MORE; ?></button>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="float-right">
                                            
                                            <!-- Skip -->
                                            <a href="<?= site_url(); ?>employees/company_employees_create_step_4/<?php echo base64_encode($id); ?>">
                                                <button type="button" name="skip" class="btn btn-default"><?php echo COMPANY_EMPLOYEE_SKIP; ?></button>
                                            </a>
                                            <!-- Previous -->
                                            <a href="<?= site_url(); ?>employees/company_employees_create_step_2/<?php echo base64_encode($id); ?>">
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


<!-- Form Validation -->
<script src="<?= site_url(); ?>assets/vendor/parsleyjs/js/parsley.min.js"></script>

<!-- Date-Picker Time-Picker -->
<script src="<?= site_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<!-- Ckeditor --> 
<script src="<?= site_url(); ?>assets/vendor/ckeditor/ckeditor.js"></script> 

<!--moment js-->
<script src="<?= site_url(); ?>assets/js/moment.js"></script> 

<!-- SweetAlert For Dialog Box --> 
<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script> 

<!-- Dropify -->
<script src="<?= site_url(); ?>assets/vendor/dropify/js/dropify.min.js"></script>

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
    var fileList = [];
    var fileInput = document.querySelector('input[name="medical_documents[]"]');

    fileInput.addEventListener('change', setList);
    
    function setList() {
        //Convert the FileList Object to an Array of File Objects
        fileList = fileList.concat(Array.from(fileInput.files));
        outputList();
    }

    function outputList() {
        var output = document.getElementById('item-documents-list');        
        
        var file_list_doc = "";

        fileList.forEach((file, i) => {
            
            console.log(file.type);
            var file_type_icon = getFontAwesomeIconFromMIME(file.type);
            console.log(file_type_icon);
            var lastModified = moment(file.lastModified).format('MMM D , YYYY');

            file_list_doc += '<div class="col-lg-3 col-md-4 col-sm-12">';
                file_list_doc += '<div class="card">';
                    file_list_doc += '<div class="file">';
                        file_list_doc += '<a href="javascript:void(0);">';
                            file_list_doc += '<div class="hover">';
                                //file_list_doc += '<button onclick="remove_file('+i+')" type="button" class="btn btn-icon btn-danger">';
                                    //file_list_doc += '<i class="fa fa-trash"></i>';
                                //file_list_doc += '</button>';
                            file_list_doc += '</div>';
                            file_list_doc += '<div class="icon">';
                                file_list_doc += '<i class="fa '+file_type_icon+'"></i>';
                            file_list_doc += '</div>';
                            file_list_doc += '<div class="file-name">';
                                file_list_doc += '<p class="m-b-5 text-muted">'+file.name+'</p>';
                                file_list_doc += '<small>Size: '+file.size+'KB <span class="date text-muted">'+lastModified+'</span></small>';
                            file_list_doc += '</div>';

                        file_list_doc += '</a>';
                    file_list_doc += '</div>';
                file_list_doc += '</div>';
            file_list_doc += '</div>';

            
        });

        output.innerHTML = '';
        output.innerHTML = file_list_doc;
    }  

    function remove_file(i){
        fileList.splice(i, 1);
        outputList();
    }

    function deleteDocument(id){
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true
        }, function () {
            $.ajax({
                url: "<?= site_url('assets_items/delete_document'); ?>",
                type: 'post',
                data: {'id': id},
                success: function (data) {
                    $("#document-"+id).remove();
                },
                error: function () {
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = 'toast-bottom-right';    
                    toastr['error']('something went wrong!.');                    
                }
            });            
        });
    }
</script>

<script type="text/javascript">
    $(function() {      
        //initialize Form Validation
        $('#create-employee').parsley();
        
        //Drag & Drop
        $('.dropify').dropify();

        $("#nationality").change(function(){
            if(this.value == 'foreigner'){                
                $("#employee_country_box").show();
                $("#passport_row").show();
                $("#is_gosi_number").hide();                
            }else{
                $("#employee_country_box").hide();
                $("#passport_row").hide();
                $("#is_gosi_number").show();
            }
        });

        $("#social_status").change(function(){
            if(this.value == 'married'){
                $("#number_of_dependent").attr("disabled", false);
            }else{
                $("#number_of_dependent").attr("disabled", true);
            }
        });

        $('#medical_expire_date').datepicker({
            format: 'dd/mm/yyyy',
            autoclose : true
        });

        var row_id = 1;
        <?php 
        if(count($employee_benefits) > 0){
        ?>
        row_id = <?php echo count($employee_benefits); ?>;
        <?php } ?>
        $("#add-more").click(function(){
            var row_str = "";
            row_str += '<div class="row" id="rows_'+row_id+'">';
                row_str += '<div class="col-md-12 text-right">';
                    if(row_id > 1){
                        row_str += '<hr>';
                    }
                        row_str += '<button type="button" data-row-id="'+row_id+'" class="btn btn-sm btn-outline-danger delete-btn" title="Delete"><i class="fa fa-trash-o"></i></button><br><br>';
                row_str += '</div>';

                row_str += '<div class="col-md-6">';
                    row_str += '<div class="form-group">';
                        row_str += '<label><?php echo COMPANY_EMPLOYEE_EXTRA_BENIFIT_TITLE; ?> </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                        row_str += '<input type="text" class="form-control" name="extra_benifit_title[]" value="" required>';
                    row_str += '</div>';
                row_str += '</div>';
                row_str += '<div class="col-md-6">';
                    row_str += '<div class="form-group">';
                        row_str += '<label><?php echo COMPANY_EMPLOYEE_EXTRA_BENIFIT_NUMBER; ?></label>';
                        row_str += '<input type="text" class="form-control" name="extra_benifit_number[]" value="">';
                    row_str += '</div>';
                row_str += '</div>';
                row_str += '<div class="col-md-12">';
                    row_str += '<div class="form-group">';
                        row_str += '<label><?php echo COMPANY_EMPLOYEE_EXTRA_BENIFIT_NOTE; ?></label>';
                        row_str += '<textarea class="form-control" name="extra_benifit_note[]"></textarea>';
                    row_str += '</div>';
                row_str += '</div>';                              
            row_str += '</div>';
            console.log(row_str);
            $(".row-box").append(row_str);
            row_id++;
        });

        $(document).on("click", '.delete-btn', function(e) {
            var row_id = $(this).attr('data-row-id');
            $('#rows_' + row_id).hide("slow", function(){ $(this).remove(); });
        });
        
    });
</script>