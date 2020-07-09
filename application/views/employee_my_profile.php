<div id="wrapper">

    <?php include("inc/company_employee_navbar.php") ?>

    <?php include("inc/company_employee_sidebar.php") ?>

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

    $CI =& get_instance();
    $CI->load->model('countries_model');
    $CI->load->model('medical_categories_model');

    $profile_pic = (isset($details) && $details['profile_pic'] != "") ? $details['profile_pic'] : '';


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
    
    $medical_category_name = "";
    if(!empty($details['medical_category_id'])){
        $medical_category_details = $CI->medical_categories_model->get_details($details['medical_category_id']);
        if($medical_category_details){
            $medical_category_name = $medical_category_details['name'];        
        }
    }
    ?>

    <div id="main-content">        
        <div class="container-fluid">
            <form action="<?= base_url('myprofile/save_employee_data');?>" id="create-employee" method="post" novalidate enctype="multipart/form-data">
            
                <input type="hidden" name="employee_id" value="<?php echo $details['id']; ?>">
                
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-sm-12">
                            <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Basic Details</h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                                <li class="breadcrumb-item active">Basic Details</li>
                            </ul>
                        </div>            
                        <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                                                 
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="card profile-header">
                            <div class="body">                      
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-12" style="text-align: center;">
                                        <div class="profile-image"> 
                                            <?php
                                            if(file_exists("uploads/".$profile_pic)){
                                                $is_profile_pic = "";
                                            }else{
                                                $is_profile_pic = "display:none;";
                                            }
                                            ?>
                                            <img width="150" height="150" src="<?= site_url(); ?>/uploads/<?php echo $profile_pic; ?>" class="rounded-circle" alt=""> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <small class="text-muted"><?php echo  EMPLOYEE_FULL_NAME_ENG; ?> </small>
                                                <p><?php echo $details['fullname_english'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <small class="text-muted"><?php echo  EMPLOYEE_FULL_NAME_AREBIC; ?> </small>
                                                <p><?php echo $details['fullname_arabic'] ?></p>
                                            </div>
                                        </div>
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
                                <hr>
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
                                <hr>
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
                                ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <small class="text-muted"><?php echo  EMPLOYEE_PASSPORT_NUMBER; ?> </small>
                                        <p><?php echo $details['passport_number'] ?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <small class="text-muted"><?php echo  EMPLOYEE_PASSPORT_ISSUE_PALCE; ?> </small>
                                        <p><?php echo $details['passport_issue_place'] ?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <small class="text-muted"><?php echo  EMPLOYEE_PASSPORT_EXPIRY_DATE; ?> </small>
                                        <p><?php echo $passport_expiry_date; ?></p>
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
                    </div>
                </div>
                
                <br>
                <br>
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

<!-- Form Validation -->
<script src="<?= site_url(); ?>assets/vendor/parsleyjs/js/parsley.min.js"></script>

<!-- Date-Picker Time-Picker -->
<script src="<?= site_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 

<!-- Ckeditor --> 
<script src="<?= site_url(); ?>assets/vendor/ckeditor/ckeditor.js"></script> 


<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script>