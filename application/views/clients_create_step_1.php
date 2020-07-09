<div id="wrapper">

    <?php include("inc/navbar.php") ?>

    <?php include("inc/sidebar.php") ?>
    
    <style type="text/css">
        .flex-container-custom a.active{
            background-color: #337AB7;
            color: white!important;
            font-weight: bold;
        }
    </style>
    <?php

        $id = (isset($details) && $details['id']) ? $details['id'] : '';


        $primary_hr = (isset($details) && $details['primary_hr']) ? $details['primary_hr'] : '';

        $company_logo = (isset($details) && $details['company_logo'] != "") ? $details['company_logo'] : '';

        $company_name_english = (isset($details) && $details['company_name_english'] != "") ? $details['company_name_english'] : '';
        $company_name_arabic = (isset($details) && $details['company_name_arabic'] != "") ? $details['company_name_arabic'] : '';
        $all_cis = (isset($details) && $details['all_cis'] != "") ? $details['all_cis'] : '';
        $cr_number = (isset($details) && $details['cr_number'] != "") ? $details['cr_number'] : '';

        $cr_number_from_date = (isset($details) && $details['cr_number_from_date'] != "") ? $details['cr_number_from_date'] : '0000-00-00';

        $cr_number_from_date = explode("-", $cr_number_from_date);
        $cr_number_from_date = $cr_number_from_date[2]."/".$cr_number_from_date[1]."/".$cr_number_from_date[0];
        if($cr_number_from_date == '00/00/0000'){
            $cr_number_from_date = "";
        }   
        

        $cr_number_issue_date = (isset($details) && $details['cr_number_issue_date'] != "") ? $details['cr_number_issue_date'] : '0000-00-00';
        $cr_number_issue_date = explode("-", $cr_number_issue_date);
        $cr_number_issue_date = $cr_number_issue_date[2]."/".$cr_number_issue_date[1]."/".$cr_number_issue_date[0];
        if($cr_number_issue_date == '00/00/0000'){
            $cr_number_issue_date = "";
        }


        $cr_number_expiry_date = (isset($details) && $details['cr_number_expiry_date'] != "") ? $details['cr_number_expiry_date'] : '0000-00-00';
        $cr_number_expiry_date = explode("-", $cr_number_expiry_date);
        $cr_number_expiry_date = $cr_number_expiry_date[2]."/".$cr_number_expiry_date[1]."/".$cr_number_expiry_date[0];
        if($cr_number_expiry_date == '00/00/0000'){
            $cr_number_expiry_date = "";
        }

        $legal_entity = (isset($details) && $details['legal_entity'] != "") ? $details['legal_entity'] : '';
        
        $established_date = (isset($details) && $details['established_date'] != "") ? $details['established_date'] : '0000-00-00';
        $established_date = explode("-", $established_date);
        $established_date = $established_date[2]."/".$established_date[1]."/".$established_date[0];

        if($established_date == '00/00/0000'){
            $established_date = "";
        }

        $main_activity = (isset($details) && $details['main_activity'] != "") ? $details['main_activity'] : '';
        $country_of_origin = (isset($details) && $details['country_of_origin'] != "") ? $details['country_of_origin'] : '';
        $about_company = (isset($details) && $details['about_company'] != "") ? $details['about_company'] : '';

    ?>
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> <?php echo CLIENTS_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>clients"><?php echo CLIENTS_TITLE; ?></a></li>
                            <li class="breadcrumb-item active"><?php echo CLIENTS_GENERAL_INFORMATION; ?></li>
                        </ul>                        
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                                             
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
                    <div class="card planned_task">
                        <div class="body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="flex-container-custom">
                                        <?php if(!empty($id)){ ?>

                                            <a href="<?= site_url(); ?>clients/create_general_information/<?php echo base64_encode($id); ?>" class="flex-item-custom active">1. <br /> <span><?php echo CLIENTS_GENERAL_INFO; ?></span></a>
                                            <a href="<?= site_url(); ?>clients/create_contract_details/<?php echo base64_encode($id); ?>" class="flex-item-custom">2. <br /> <span><?php echo CLIENTS_CONTRACT_DETAILS; ?></span></a>
                                            <a href="<?= site_url(); ?>clients/create_contact_information/<?php echo base64_encode($id); ?>" class="flex-item-custom">3. <br /> <span><?php echo CLIENTS_CONTACT_INFORMATIONS; ?></span></a>
                                            <a href="<?= site_url(); ?>clients/create_property_information/<?php echo base64_encode($id); ?>" class="flex-item-custom">4. <br /> <span><?php echo CLIENTS_PROPERTY_INFORMATION; ?></span></a>
                                            <a href="<?= site_url(); ?>clients/create_executive_management/<?php echo base64_encode($id); ?>" class="flex-item-custom">5. <br /> <span><?php echo CLIENTS_EXECUTIVE_MANAGEMENT; ?></span></a>
                                            <a href="<?= site_url(); ?>clients/create_branch_subsidiary/<?php echo base64_encode($id); ?>" class="flex-item-custom">6. <br /> <span>
                                            <?php echo CLIENTS_BRANCH_SUBSIDIARIES; ?></span></a>
                                            <a href="<?= site_url(); ?>clients/create_company_documents/<?php echo base64_encode($id); ?>" class="flex-item-custom">7. <br /> <span>
                                            <?php echo CLIENTS_COMPANY_DOCUMENTS; ?></span></a>

                                        <?php }else{ ?>

                                            <a href="<?= site_url(); ?>clients/create_general_information" class="flex-item-custom active">1. <br /> <span><?php echo CLIENTS_GENERAL_INFO; ?></span></a>
                                            <a href="<?= site_url(); ?>clients/create_contract_details" class="flex-item-custom">2. <br /> <span><?php echo CLIENTS_CONTRACT_DETAILS; ?></span></a>
                                            <a href="<?= site_url(); ?>clients/create_contact_information" class="flex-item-custom">3. <br /> <span><?php echo CLIENTS_CONTACT_INFORMATIONS; ?></span></a>
                                            <a href="<?= site_url(); ?>clients/create_property_information" class="flex-item-custom">4. <br /> <span><?php echo CLIENTS_PROPERTY_INFORMATION; ?></span></a>
                                            <a href="<?= site_url(); ?>clients/create_executive_management" class="flex-item-custom">5. <br /> <span><?php echo CLIENTS_EXECUTIVE_MANAGEMENT; ?></span></a>
                                            <a href="<?= site_url(); ?>clients/create_branch_subsidiary" class="flex-item-custom">6. <br /> <span><?php echo CLIENTS_BRANCH_SUBSIDIARIES; ?></span></a>
                                            <a href="<?= site_url(); ?>clients/create_company_documents" class="flex-item-custom">7. <br /> <span><?php echo CLIENTS_COMPANY_DOCUMENTS; ?> </span></a>

                                        <?php } ?>
                                    </div>
                                    <div class="custom-hr"><hr /></div>
                                </div>
                            </div>
                            <form action="<?= base_url('clients/create_general_information');?>" id="create-client" method="post" novalidate enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo base64_encode($id); ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                <?php echo CLIENTS_PRIMARY_HR; ?><span class="text-danger">*</span>
                                            </label>
                                            <select name="primary_hr" class="form-control show-tick ms select2" data-placeholder="Select Legal entity" required>
                                                <option value=""><?php echo CLIENTS_SELECT_PRIMARY_HR; ?></option>
                                                <?php
                                                if(!empty($fmc_users)){
                                                    foreach ($fmc_users as $key => $value) { 
                                                        $selected = "";
                                                        if($primary_hr == $value['id']){
                                                            $selected = "selected";
                                                        }      
                                                    ?>
                                                        <option <?php echo $selected; ?> value="<?php echo $value['id']; ?>">
                                                            <?php echo $value['first_name']." ".$value['last_name']." ".$value['surname']."(".$value['fmc_employee_id'].")"; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_COMPANY_NAME_ENGLISH; ?><span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="company_name_english" value="<?php echo $company_name_english; ?>" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_COMPANY_NAME_AREBIC; ?><span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="company_name_arabic" value="<?php echo $company_name_arabic; ?>" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><?php echo CLIENTS_COMPANY_LOGO; ?>
                                                    <?php
                                                    if(file_exists("uploads/".$company_logo)){
                                                    ?>
                                                        <img src="<?= site_url(); ?>/uploads/<?php echo $company_logo; ?>" alt="" width="50" height="50" />
                                                        <br>
                                                    <?php
                                                    }else{
                                                        echo "<br /><br />";  
                                                    }
                                                    ?>
                                                    <br /><?php echo CLIENTS_LOGO_SIZE; ?>
                                                    <br /><?php echo CLIENTS_LOGO_EXTENSION; ?></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <label for="company_logo" style="width: 100%;">
                                                    <input type="file" class="dropify" name="company_logo" id="company_logo">
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_ALL_CIS; ?><span class="text-danger">*</span></label>
                                            <input type="text" name="all_cis" value="<?php echo $all_cis; ?>" class="form-control w-90" required>
                                            <a title="<?php echo CLIENTS_ALL_CIS; ?>" class="fr"><img src="<?= site_url(); ?>assets/images/question.png" alt="" /></a>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_C_R_NUMBER; ?><span class="text-danger">*</span></label>
                                            <input type="text" name="cr_number" value="<?php echo $cr_number; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_FROM; ?><span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="cr_number_from_date" placeholder="<?php echo CLIENTS_FROM; ?>" autocomplete="off" value="<?php echo $cr_number_from_date; ?>" readonly required>
                                                <div class="input-group-append calendar-open">
                                                    <span class="input-group-text"><i class="icon-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_DATE_OF_ISSUE; ?><span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" id="cr_number_issue_date" name="cr_number_issue_date" placeholder="<?php echo CLIENTS_DATE_OF_ISSUE; ?>" autocomplete="off" value="<?php echo $cr_number_issue_date; ?>" readonly required>
                                                <div class="input-group-append calendar-open">
                                                    <span class="input-group-text"><i class="icon-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_DATE_OF_EXPIRY; ?><span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input class="form-control" id="cr_number_expiry_date" name="cr_number_expiry_date" placeholder="<?php echo CLIENTS_DATE_OF_EXPIRY; ?>" autocomplete="off" value="<?php echo $cr_number_expiry_date; ?>" readonly required>
                                                <div class="input-group-append calendar-open">
                                                    <span class="input-group-text"><i class="icon-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_LEGAL_ENTITY; ?></label>
                                            <select name="legal_entity" class="form-control show-tick ms select2" data-placeholder="Select Legal entity">
                                                <option value=""><?php echo CLIENTS_SELECT_LEGAL_ENTITY; ?></option>   
                                                <?php
                                                if(!empty($legal_entities)){
                                                    foreach ($legal_entities as $key => $value) { 
                                                        $selected = "";
                                                        if($legal_entity == $value['id']){
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_DATA_ESTABLISHED; ?></label>
                                            <div class="input-group">
                                                <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="established_date" placeholder="<?php echo CLIENTS_DATA_ESTABLISHED; ?>" autocomplete="off" value="<?php echo $established_date; ?>" readonly>
                                                <div class="input-group-append calendar-open">
                                                    <span class="input-group-text"><i class="icon-calendar"></i></span>
                                                </div>
                                            </div>                                      
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_MAIN_ACTIVITY; ?></label>
                                            <select name="main_activity" class="form-control show-tick ms select2" data-placeholder="Select Legal entity">
                                                <option value=""><?php echo CLIENTS_SELECT_MAIN_ACTIVITY; ?></option>
                                                <?php
                                                if(!empty($main_activities)){
                                                    foreach ($main_activities as $key => $value) { 
                                                        $selected = "";
                                                        if($main_activity == $value['id']){
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_COUNTRY_OF_ORIGIN; ?><span class="text-danger">*</span></label>
                                            <select name="country_of_origin" class="form-control show-tick ms select2" data-placeholder="Select Country of Origin" required>
                                                <option value=""><?php echo CLIENTS_SELECT_COUNTRY_OF_ORIGIN; ?></option>
                                                <?php
                                                if(!empty($countries)){
                                                    foreach ($countries as $key => $value) {
                                                        $selected = "";
                                                        
                                                        if(!empty($country_of_origin)){
                                                            if($value['id'] == $country_of_origin){
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
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_ABOUT_COMPANY; ?></label>
                                            <textarea id="ckeditor" name="about_company"><?php echo $about_company; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="float-right">
                                            <button type="submit" name="submit_btn" value="submit_btn" class="btn btn-default"><?php echo CLIENTS_SAVE; ?></button>
                                            <button type="submit" name="next_btn" value="next_btn" class="btn btn-info"><?php echo CLIENTS_NEXT; ?></button>
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

<!-- Dropify -->
<script src="<?= site_url(); ?>assets/vendor/dropify/js/dropify.min.js"></script>

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
    $(function() {      
        //initialize Form Validation
        $('#create-client').parsley();
        
        //Open Upload Company Logo Dialog On Btn Click
        $("#company_logo_upload_btn").click(function(){
            $('#company_logo').trigger('click');
        });

        //Drag & Drop
        $('.dropify').dropify();

        //CKEditor
        CKEDITOR.replace('ckeditor');
        CKEDITOR.config.height = 200; 

        $('.calendar-open').click(function() {
            var ele = $(this).prev("input")
            $(ele).focus();
        });

        var todayDate = new Date();
        $('#cr_number_expiry_date').datepicker({
            format: 'dd/mm/yyyy',
            autoclose : true
        });
            
        //Date Change
        $('#cr_number_issue_date').on('change', function () {
            var cr_number_issue_date = this.value;
            cr_number_issue_date = cr_number_issue_date.split("/");
            cr_number_issue_date = new Date(+cr_number_issue_date[2], cr_number_issue_date[1] - 1, +cr_number_issue_date[0]);   

            $("#cr_number_expiry_date").val(""); 
            
            var todayDate = new Date();
            $("#cr_number_expiry_date").datepicker('remove'); //detach
            $('#cr_number_expiry_date').datepicker({
                format: 'dd/mm/yyyy',
                autoclose : true,
                startDate: cr_number_issue_date
            });
        });
    
    });
</script>

<script type="text/javascript">
    
    var fileInput = document.querySelector('input[id="company_logo"]');
    fileInput.addEventListener('change', changeFile);

    function changeFile(){
        $("#company_logo_file_name").html(fileInput.files[0].name);
    }

</script>