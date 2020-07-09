<div id="wrapper">

    <nav class="navbar navbar-fixed-top">
	    <div class="container-fluid">
	        <div class="navbar-btn">
	            <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
	        </div>

	        <div class="navbar-brand" style="left: 45%;">
	            <a href="<?= site_url(); ?>"><img src="<?= site_url(); ?>assets/images/mainlogo.png" alt="Lucid Logo" class="img-responsive logo"></a>
	        </div>	        
	    </div>
	</nav>

	<?php
	
	$fullname_english = (isset($details) && $details['fullname_english'] != "") ? $details['fullname_english'] : '';
    
    $fullname_arabic = (isset($details) && $details['fullname_arabic'] != "") ? $details['fullname_arabic'] : '';   

    $profile_pic = (isset($details) && $details['profile_pic'] != "") ? $details['profile_pic'] : '';


    $birthdate = (isset($details) && $details['birthdate'] != "") ? $details['birthdate'] : '0000-00-00';
    $birthdate = explode("-", $birthdate);
    $birthdate = $birthdate[2]."/".$birthdate[1]."/".$birthdate[0];
    if($birthdate == '00/00/0000'){
        $birthdate = "";
    }


    //Emergency Contacts
    $contact_name = "";
    $address = "";
    $relationship = "";
    $mobile = "";
    if(count($emergency_contacts) > 0){
        $contact_name = $emergency_contacts[0]['contact_name'];
        $address = $emergency_contacts[0]['address'];
        $relationship = $emergency_contacts[0]['relationship'];
        $mobile = $emergency_contacts[0]['mobile'];
    }

    //Qualification
    $specialization = "";
    $institute_name = "";
    $from_year = "";
    $to_year = "";
    if(count($educations) > 0){
        $specialization = $educations[0]['specialization'];
        $institute_name = $educations[0]['institute_name'];
        $from_year = $educations[0]['from_year'];
        $to_year = $educations[0]['to_year'];
    }

    //Work-Experience
    $position = "";
    $employer_name = "";
    $job_task = "";
    $address = "";
    $total_salary = "";
    $from_date = "";
    $to_date = "";
    if(count($work_experience_items) > 0){
        $position = $work_experience_items[0]['position'];
        $employer_name = $work_experience_items[0]['employer_name'];
        $job_task = $work_experience_items[0]['job_task'];
        $address = $work_experience_items[0]['address'];
        $total_salary = $work_experience_items[0]['total_salary'];
        $from_date = $work_experience_items[0]['from_date'];
        $to_date = $work_experience_items[0]['to_date'];

        $from_date = explode("-", $from_date);
        $from_date = $from_date[2]."/".$from_date[1]."/".$from_date[0];

        $to_date = explode("-", $to_date);
        $to_date = $to_date[2]."/".$to_date[1]."/".$to_date[0];
    }
	?>

    <div id="main-content" style="width: 100%!important;">        
    	<div class="container-fluid">
            <form action="<?= base_url('sharelink/save_employee_data');?>" id="create-employee" method="post" novalidate enctype="multipart/form-data">
            
                <input type="hidden" name="employee_id" value="<?php echo $details['employee_id']; ?>">
                <input type="hidden" id="share_link_id" name="share_link_id" value="<?php echo $share_link_details['id']; ?>">

                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-sm-12">
                            <h2><?php echo  COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PAGE_TITLE; ?></h2>
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
                        <div class="card planned_task">                        
                        	<div class="header">
                                <h2>Personal Details</h2>
                            </div>    
                            <div class="body">

    	                        <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_PROFILE_PIC; ?><br /><br />
                                            <span class="text-muted"><?php echo COMPANY_EMPLOYEE_PROFILE_PIC_SIZE; ?><br /><?php echo COMPANY_EMPLOYEE_PROFILE_PIC_TYPES; ?> </span>
                                            </label>
                                        </div>
                                    </div>
                                    <?php
                                    if(file_exists("uploads/".$profile_pic)){
                                    	$is_profile_pic = "";
                                    }else{
                                    	$is_profile_pic = "display:none;";
                                    }
                                    ?>
                                    <div class="col-md-2">
                                        <img style="<?php echo $is_profile_pic; ?>" src="<?= site_url(); ?>/uploads/<?php echo $profile_pic; ?>" alt="" id="profile_pic_img" width="100" height="100" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="profile_pic" style="width: 100%;">
                                            <input type="file" class="dropify" name="profile_pic" id="profile_pic">
                                        </label>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_NAME_ENGLISH; ?><span class="text-danger">*</span></label>
                                            <input type="text" class="form-control w-90" name="fullname_english" value="<?php echo $fullname_english; ?>" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_NAME_ARABIC; ?><span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="fullname_arabic" value="<?php echo $fullname_arabic; ?>"  required="">
                                        </div>
                                    </div>
                                </div>                         
                                
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
                                if($details['nationality'] == 'foreigner'){
                                    $is_passport_display = "";    
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
                                            <label><?php echo COMPANY_EMPLOYEE_ADDRESS; ?></label>
                                            <input type="text" class="form-control" name="mother_city_address" value="<?php echo $details['mother_city_address']; ?>" placeholder="<?php echo COMPANY_EMPLOYEE_ADDRESS; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_CITY; ?></label>
                                            <input type="text" class="form-control" name="mother_city_city" value="<?php echo $details['mother_city_city']; ?>" placeholder="<?php echo COMPANY_EMPLOYEE_CITY; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_STATE; ?> </label>
                                            <input type="text" class="form-control" name="mother_city_state" value="<?php echo $details['mother_city_state']; ?>" placeholder="<?php echo COMPANY_EMPLOYEE_STATE; ?>">
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
                                            <label><?php echo COMPANY_EMPLOYEE_P_O_BOX; ?> </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="text" class="form-control" name="kingdom_po_box" value="<?php echo $details['kingdom_po_box']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_BUILDING_NO; ?> </label>
                                            <input type="text" class="form-control" name="kingdom_building_no" value="<?php echo $details['kingdom_building_no']; ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_STREET_NAME; ?></label>
                                            <input type="text" class="form-control" name="kingdom_street_name" value="<?php echo $details['kingdom_street_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo COMPANY_EMPLOYEE_KINGDOM_REGION; ?></label>
                                            <select name="kingdom_region_id" class="form-control show-tick ms select2" data-placeholder="Select Regions">
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
                                            <label><?php echo COMPANY_EMPLOYEE_CITY; ?></label>
                                            <select name="kingdom_city_id" class="form-control show-tick ms select2" data-placeholder="Select Regions">
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
                                            <label><?php echo COMPANY_EMPLOYEE_ZIP_CODE; ?></label>
                                            <input type="text" class="form-control" name="kingdom_zipcode" value="<?php echo $details['kingdom_zipcode']; ?>">
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!--Emergency Contacts-->
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card planned_task">                        
                        	<div class="header">
                                <h2>Emergency Contacts</h2>
                            </div>    
                            <div class="body">
                            	<div class="emergencey-contact-row-box">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_CONTACT_NAME; ?></label>
                                                <input type="text" class="form-control" name="contact_name[]" value="<?php echo $contact_name; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_CONTACT_NAME; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_ADDRESS; ?></label>
                                                <input type="text" class="form-control" name="address[]" value="<?php echo $address; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_ADDRESS; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_RELATIONSHIP; ?></label>
                                                <input type="text" class="form-control" name="relationship[]" value="<?php echo $relationship; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_RELATIONSHIP; ?>">
                                            </div>
                                        </div>                                   
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_MOBILE; ?></label>
                                                <input type="number" class="form-control" name="mobile[]" value="<?php echo $mobile; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_MOBILE; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if(!empty($emergency_contacts)){
                                    foreach ($emergency_contacts as $key => $value) {
                                    if($key > 0){
                                    ?>
                                    <div class="row" id="emergency_contacts_rows_<?php echo $key; ?>">
                                        <div class="col-md-12 text-left">
                                            <hr>
                                            <button type="button" data-row-id="<?php echo $key; ?>" class="btn btn-sm btn-outline-danger delete-btn" title="Delete"><i class="fa fa-trash-o"></i></button><br><br>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_CONTACT_NAME; ?></label>
                                                <input type="text" class="form-control" name="contact_name[]" value="<?php echo $value['contact_name']; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_CONTACT_NAME; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_ADDRESS; ?></label>
                                                <input type="text" class="form-control" name="address[]" value="<?php echo $value['address']; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_ADDRESS; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_RELATIONSHIP; ?></label>
                                                <input type="text" class="form-control" name="relationship[]" value="<?php echo $value['relationship']; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_RELATIONSHIP; ?>">
                                            </div>
                                        </div>                                   
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_MOBILE; ?></label>
                                                <input type="number" class="form-control" name="mobile[]" value="<?php echo $value['mobile']; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_MOBILE; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <?php      
                                    }                                      
                                    }
                                    }
                                    ?>
                                </div>
                                                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-success" id="add-more"><?php echo COMPANY_EMPLOYEE_ADD_MORE; ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Emergency Contacts-->

                <!--Qualification-->
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card planned_task">                        
                        	<div class="header">
                                <h2>Qualification</h2>
                            </div>    
                            <div class="body">
                            	<div class="qualification-row-box">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_SPECIALIZATION; ?></label>
                                                <input type="text" class="form-control" name="specialization[]" value="<?php echo $specialization; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_SPECIALIZATION; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_INSTITUTE; ?></label>
                                                <input type="text" class="form-control" name="institute_name[]" value="<?php echo $institute_name; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_INSTITUTE; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_FROM_YEAR; ?></label>
                                                <select name="from_year[]" class="form-control select2" data-placeholder="Select From Year" required>
                                                    <option value=""><?php echo COMPANY_EMPLOYEE_SELECT_FROM_YEAR; ?></option>  
                                                    <?php
                                                    for($year = 2019;$year >= 1960;$year--){
                                                        $selected = "";
                                                        if($from_year == $year){
                                                            $selected = "selected";
                                                        }
                                                    ?>
                                                    <option value="<?php echo $year; ?>" <?php echo $selected; ?>><?php echo $year; ?></option>  
                                                    <?php
                                                    }
                                                    ?>
                                                    
                                                </select>
                                            </div>
                                        </div>                                   
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_TO_YEAR; ?></label>
                                                <select name="to_year[]" class="form-control select2" data-placeholder="Select To Year" required>
                                                    <option value=""><?php echo COMPANY_EMPLOYEE_SELECT_TO_YEAR; ?></option>  
                                                    <?php
                                                    for($year = 2019;$year >= 1960;$year--){
                                                        $selected = "";
                                                        if($to_year == $year){
                                                            $selected = "selected";
                                                        }
                                                    ?>
                                                        <option value="<?php echo $year; ?>" <?php echo $selected; ?>><?php echo $year; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if(!empty($educations)){
                                    foreach ($educations as $key => $value) {
                                    if($key > 0){
                                    ?>
                                    <div class="row" id="rows_<?php echo $key; ?>">
                                        <div class="col-md-12 text-left">
                                            <hr>
                                            <button type="button" data-row-id="<?php echo $key; ?>" class="btn btn-sm btn-outline-danger delete-qualification-btn" title="Delete"><i class="fa fa-trash-o"></i></button><br><br>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_SPECIALIZATION; ?></label>
                                                <input type="text" class="form-control" name="specialization[]" value="<?php echo $value['specialization']; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_SPECIALIZATION; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_INSTITUTE; ?></label>
                                                <input type="text" class="form-control" name="institute_name[]" value="<?php echo $value['institute_name']; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_INSTITUTE; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_FROM_YEAR; ?></label>
                                                <select name="from_year[]" class="form-control select2" data-placeholder="Select From Year" required>
                                                    <option value=""><?php echo COMPANY_EMPLOYEE_SELECT_FROM_YEAR; ?></option>  
                                                    <?php
                                                    for($year = 2019;$year >= 1960;$year--){
                                                        $selected = "";
                                                        if($value['from_year'] == $year){
                                                            $selected = "selected";
                                                        }
                                                    ?>
                                                    <option value="<?php echo $year; ?>" <?php echo $selected; ?>><?php echo $year; ?></option>  
                                                    <?php
                                                    }
                                                    ?>
                                                    
                                                </select>
                                            </div>
                                        </div>                                   
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_TO_YEAR; ?></label>
                                                <select name="to_year[]" class="form-control select2" data-placeholder="Select To Year" required>
                                                    <option value=""><?php echo COMPANY_EMPLOYEE_SELECT_TO_YEAR; ?></option>  
                                                    <?php
                                                    for($year = 2019;$year >= 1960;$year--){
                                                        $selected = "";
                                                        if($value['to_year'] == $year){
                                                            $selected = "selected";
                                                        }
                                                    ?>
                                                        <option value="<?php echo $year; ?>" <?php echo $selected; ?>><?php echo $year; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                    } 
                                    }
                                    }
                                    ?>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-success" id="add-more-qualification"><?php echo COMPANY_EMPLOYEE_ADD_MORE; ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               	</div>
               	<!--End Qualification-->

               	<!--Work Experience-->
               	<div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card planned_task">                        
                        	<div class="header">
                                <h2>Work Experience</h2>
                            </div>    
                            <div class="body">
                            	<div class="work-experience-row-box">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_POSITION; ?></label>
                                                <input type="text" class="form-control" name="position[]" value="<?php echo $position; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_POSITION; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYER_NAME; ?></label>
                                                <input type="text" class="form-control" name="employer_name[]" value="<?php echo $employer_name; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYER_NAME; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_JOB_TASK; ?></label>
                                                <input type="text" class="form-control" name="job_task[]" value="<?php echo $job_task; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_JOB_TASK; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_ADDRESS; ?></label>
                                                <input type="text" class="form-control" name="address[]" value="<?php echo $address; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_ADDRESS; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_TOTAL_SALARY; ?></label>
                                                <input type="text" class="form-control" name="total_salary[]" value="<?php echo $total_salary; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_TOTAL_SALARY; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_FROM_DATE; ?></label>
                                                <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="from_date[]" placeholder="<?php echo COMPANY_EMPLOYEE_FROM_DATE; ?>" autocomplete="off" value="<?php echo $from_date; ?>" readonly required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_TO_DATE; ?></label>
                                                <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="to_date[]" placeholder="<?php echo COMPANY_EMPLOYEE_TO_DATE; ?>" autocomplete="off" value="<?php echo $to_date; ?>" readonly required>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if(!empty($work_experience_items)){
                                    foreach ($work_experience_items as $key => $value) {
                                    if($key > 0){

                                        $from_date = explode("-", $value['from_date']);
                                        $from_date = $from_date[2]."/".$from_date[1]."/".$from_date[0];

                                        $to_date = explode("-", $value['to_date']);
                                        $to_date = $to_date[2]."/".$to_date[1]."/".$to_date[0];
                                    ?>
                                    <div class="row" id="work_experience_rows_<?php echo $key; ?>">
                                        <div class="col-md-12 text-left">
                                            <hr>
                                            <button type="button" data-row-id="<?php echo $key; ?>" class="btn btn-sm btn-outline-danger delete-work-experience-btn" title="Delete"><i class="fa fa-trash-o"></i></button><br><br>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_POSITION; ?></label>
                                                <input type="text" class="form-control" name="position[]" value="<?php echo $value['position']; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_POSITION; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYER_NAME; ?></label>
                                                <input type="text" class="form-control" name="employer_name[]" value="<?php echo $value['employer_name']; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYER_NAME; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_JOB_TASK; ?></label>
                                                <input type="text" class="form-control" name="job_task[]" value="<?php echo $value['job_task']; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_JOB_TASK; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_ADDRESS; ?></label>
                                                <input type="text" class="form-control" name="address[]" value="<?php echo $value['address']; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_ADDRESS; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_TOTAL_SALARY; ?></label>
                                                <input type="text" class="form-control" name="total_salary[]" value="<?php echo $value['total_salary']; ?>" required="" placeholder="<?php echo COMPANY_EMPLOYEE_TOTAL_SALARY; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_FROM_DATE; ?></label>
                                                <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="from_date[]" placeholder="<?php echo COMPANY_EMPLOYEE_FROM_DATE; ?>" autocomplete="off" value="<?php echo $from_date; ?>" readonly required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo COMPANY_EMPLOYEE_TO_DATE; ?></label>
                                                <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="to_date[]" placeholder="<?php echo COMPANY_EMPLOYEE_TO_DATE; ?>" autocomplete="off" value="<?php echo $to_date; ?>" readonly required>
                                            </div>
                                        </div>
                                    </div> 
                                    <?php 
                                    }
                                    }
                                    }
                                    ?>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-success" id="add-more-work-experience"><?php echo COMPANY_EMPLOYEE_ADD_MORE; ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Work Experience-->

                <!-- Employee Documents -->
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card planned_task">                        
                            <div class="body">
                                <div class="row">
                                     <div class="col-lg-9">
                                        <h6><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_TITLE; ?></h6>
                                    </div>
                                    <div class="col-lg-3 text-right">
                                        <button type="button" class="btn btn-success align-right" data-toggle="modal" data-target="#add_personal_document"><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW; ?></button>
                                    </div>
                                </div>
                                <br>
                                <div class="table-responsive">
                                    <table class="table m-b-0">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Issue-Date</th>
                                                <th>Expiry-Date</th>
                                                <th>Document</th>
                                                <th>***</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                            
                                            <?php 
                                            foreach ($documents as $key => $value) {
                                            ?>
                                            <tr>
                                                <td><?php echo $value['title']; ?></td>
                                                <td>
                                                <?php 
                                                    if($value['issue_date'] != "0000-00-00"){
                                                        echo date('d-m-Y',strtotime($value['issue_date']));
                                                    }else{
                                                        echo "-";
                                                    }
                                                ?>
                                                </td>
                                                <td>
                                                <?php 
                                                    if($value['expiry_date'] != "0000-00-00"){
                                                        echo date('d-m-Y',strtotime($value['expiry_date']));
                                                    }else{
                                                        echo "-";
                                                    }
                                                ?>
                                                </td>
                                                <td><a download="<?php echo $value['document_file']; ?>" href="../uploads/<?php echo $value['document_file']; ?>">Download</a></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="getDocument('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-edit"></i></button>
                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteDocument('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>          
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Employee Documents -->

                <div class="row clearfix">
                	<div class="col-lg-7">
                		<div class="float-right">
                            <!-- Save -->
                            <button type="submit" name="save" value="
                            submit_btn" class="btn btn-default"><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_FORM_SAVE; ?></button>
                            <!-- Next -->
                            <button type="submit" name="save_submit" value="next_btn" class="btn btn-info"><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_FORM_SAVE_SUBMIT; ?></button>
                            
                        </div>
                	</div>
                </div>
                <br>
                <br>
            </form>
        </div>
    </div>

</div>  


<!-- Upload Personal Documets Modal-Popup -->
<div class="modal animated fadeIn" id="add_personal_document" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-auth-small" id="add_personal_document_form" action="<?= base_url('sharelink/save_employee_document');?>" method="post" novalidate enctype="multipart/form-data">
            <input type="hidden" name="employee_id" value="<?php echo $details['employee_id']; ?>">
            <input type="hidden" name="share_link_id" value="<?php echo $share_link_details['share_link']; ?>">
            <div class="modal-header">
                <h6 class="title"><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_MODAL_POPUP_TITILE; ?></h6>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_TITLE; ?></label>
                            <input type="text" name="title" class="form-control" placeholder="<?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_TITLE; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_ISSUE_DATE; ?></label>
                            <input id="issue_date" class="form-control" name="issue_date" placeholder="<?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_ISSUE_DATE; ?>" autocomplete="off" readonly>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_EXPIRY_DATE; ?></label>
                            <input class="form-control" id="expiry_date" name="expiry_date" placeholder="<?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_EXPIRY_DATE; ?>" autocomplete="off" readonly>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_DESCRIPTION; ?></label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label for="document_file" style="width: 100%;">
                            <input type="file" class="dropify" name="document_file" id="document_file">
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_ADD_BTN; ?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_CLOSE_BTN; ?></button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Upload Personal Documets Modal-Popup -->

<!-- Update Personal Documets Modal-Popup -->
<div class="modal animated fadeIn" id="upload_personal_document" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-auth-small" id="update_personal_document_form" action="<?= base_url('sharelink/update_employee_document');?>" method="post" novalidate enctype="multipart/form-data">                
            <input type="hidden" id="update_id" name="id" value="">
            <input type="hidden" id="update_employee_id" name="employee_id" value="<?php echo $details['employee_id']; ?>">
            <input type="hidden" id="update_share_link_id" name="share_link_id" value="<?php echo $share_link_details['share_link']; ?>">
            <div class="modal-header">
                <h6 class="title"><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_UPDATE_MODAL_POPUP_TITILE; ?></h6>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_TITLE; ?></label>
                            <input type="text" id="update_title" name="title" class="form-control" placeholder="<?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_TITLE; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_ISSUE_DATE; ?></label>
                            <input class="form-control" data-date-format="dd/mm/yyyy" id="update_issue_date" name="issue_date" placeholder="<?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_ISSUE_DATE; ?>" autocomplete="off" readonly><!-- value="<?php echo $cr_number_expiry_date; ?>" -->
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_EXPIRY_DATE; ?></label>
                            <input class="form-control" data-date-format="dd/mm/yyyy" id="update_expiry_date" name="expiry_date" placeholder="<?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_EXPIRY_DATE; ?>" autocomplete="off" readonly><!-- value="<?php echo $cr_number_expiry_date; ?>" -->
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_DESCRIPTION; ?></label>
                            <textarea class="form-control" id="update_description" name="description"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label for="update_document_file" style="width: 100%;">
                            <input type="file" class="dropify" name="document_file" id="update_document_file">
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_ADD_BTN; ?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo COMPANY_EMPLOYEE_SHARE_PUBLIC_LINK_PERSONAL_DOCUMENTS_ADD_NEW_DOCUMENT_CLOSE_BTN; ?></button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Update Personal Documets Modal-Popup -->

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

<!-- Dropify -->
<script src="<?= site_url(); ?>assets/vendor/dropify/js/dropify.min.js"></script>

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
    
    var fileInput = document.querySelector('input[id="document_file"]');
    fileInput.addEventListener('change', changeFile);

    function changeFile(){
        $("#selected_file_name").html(fileInput.files[0].name);
    }

    var fileInputUpdate = document.querySelector('input[id="update_document_file"]');
    fileInputUpdate.addEventListener('change', changeUpdateFile);

    function changeUpdateFile(){
        $("#update_selected_file_name").html(fileInputUpdate.files[0].name);
    }

</script>

<script type="text/javascript">
    $(function() {      
        //initialize Form Validation  
        $('#add_personal_document_form').parsley();    
        $('#update_personal_document_form').parsley();  

        //Drag & Drop
        $('.dropify').dropify();  

        $("#nationality").change(function(){
            if(this.value == 'foreigner'){
                $("#passport_row").show();
                $("#is_gosi_number").hide();                
            }else{
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

        $('#issue_date').datepicker({
            format: 'dd/mm/yyyy',
            autoclose : true
        }).on('changeDate', function(e) {
            var issue_date = this.value;
            issue_date = issue_date.split("/");
            issue_date = new Date(+issue_date[2], issue_date[1] - 1, +issue_date[0]);   
            $("#expiry_date").val(''); //Blank Expiry Date
            $("#expiry_date").datepicker('remove'); //detach
            $('#expiry_date').datepicker({
                format: 'dd/mm/yyyy',
                autoclose : true,
                startDate: issue_date
            });
        });


        var row_id = 2;
        <?php 
        if(count($emergency_contacts) > 0){
        ?>
        row_id = <?php echo count($emergency_contacts); ?>;
        <?php } ?>

        $("#add-more").click(function(){
            $(".emergencey-contact-row-box").append('<div class="row" id="emergency_contacts_rows_'+row_id+'"><div class="col-md-12 text-left"><hr><button type="button" data-row-id="'+row_id+'" class="btn btn-sm btn-outline-danger delete-btn" title="Delete"><i class="fa fa-trash-o"></i></button><br><br></div><div class="col-md-6"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_CONTACT_NAME; ?></label><input type="text" class="form-control" name="contact_name[]" value="" placeholder="<?php echo COMPANY_EMPLOYEE_CONTACT_NAME; ?>"></div></div><div class="col-md-6"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_ADDRESS; ?></label><input type="text" class="form-control" name="address[]" value="" placeholder="<?php echo COMPANY_EMPLOYEE_ADDRESS; ?>"></div></div><div class="col-md-6"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_RELATIONSHIP; ?></label><input type="text" class="form-control" name="relationship[]" value="" placeholder="<?php echo COMPANY_EMPLOYEE_RELATIONSHIP; ?>"></div></div><div class="col-md-6"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_MOBILE; ?></label><input type="number" class="form-control" name="mobile[]" value="" placeholder="<?php echo COMPANY_EMPLOYEE_MOBILE; ?>"></div></div></div>');
            row_id++;
        });

        $(document).on("click", '.delete-btn', function(e) {
            var row_id = $(this).attr('data-row-id');
            $('#emergency_contacts_rows_' + row_id).hide("slow", function(){ $(this).remove(); });
        });


        //Qualificarions
        var education_row_id = 2;
        <?php 
        if(count($educations) > 0){
        ?>
        education_row_id = <?php echo count($educations); ?>;
        <?php } ?>

        $("#add-more-qualification").click(function(){
            $(".qualification-row-box").append('<div class="row" id="rows_'+education_row_id+'"><div class="col-md-12 text-left"><hr><button type="button" data-row-id="'+education_row_id+'" class="btn btn-sm btn-outline-danger delete-qualification-btn" title="Delete"><i class="fa fa-trash-o"></i></button><br><br></div><div class="col-md-6"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_SPECIALIZATION; ?></label><input type="text" class="form-control" name="specialization[]" value="" required="" placeholder="<?php echo COMPANY_EMPLOYEE_SPECIALIZATION; ?>"></div></div><div class="col-md-6"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_INSTITUTE; ?></label><input type="text" class="form-control" name="institute_name[]" value="" required="" placeholder="<?php echo COMPANY_EMPLOYEE_INSTITUTE; ?>"></div></div><div class="col-md-6"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_FROM_YEAR; ?></label><select name="from_year[]" class="form-control" data-placeholder="Select From Year" required><option value=""><?php echo COMPANY_EMPLOYEE_SELECT_FROM_YEAR; ?></option><?php for($year = 2019;$year >= 1960;$year--){ ?><option value="<?php echo $year; ?>"><?php echo $year; ?></option><?php } ?></select></div></div><div class="col-md-6"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_TO_YEAR; ?></label><select name="to_year[]" class="form-control to_year" data-placeholder="Select To Year" required><option value=""><?php echo COMPANY_EMPLOYEE_SELECT_TO_YEAR; ?></option><?php for($year = 2019;$year >= 1960;$year--){ ?><option value="<?php echo $year; ?>"><?php echo $year; ?></option><?php } ?></select></div></div></div>');

                setTimeout(function(){
                    $('.select2').select2();
                }, 100);

            education_row_id++;
        });

        $(document).on("click", '.delete-qualification-btn', function(e) {
            var education_row_id = $(this).attr('data-row-id');
            $('#rows_' + education_row_id).hide("slow", function(){ $(this).remove(); });
        });

        //End Qualificarions


        //Work-Experience
        var work_experience_row_id = 2;
        <?php 
        if(count($work_experience_items) > 0){
        ?>
        work_experience_row_id = <?php echo count($work_experience_items); ?>;
        <?php } ?>

        $("#add-more-work-experience").click(function(){
            $(".work-experience-row-box").append('<div class="row" id="work_experience_rows_'+work_experience_row_id+'"><div class="col-md-12 text-left"><hr><button type="button" data-row-id="'+work_experience_row_id+'" class="btn btn-sm btn-outline-danger delete-work-experience-btn" title="Delete"><i class="fa fa-trash-o"></i></button><br><br></div><div class="col-md-4"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_POSITION; ?></label><input type="text" class="form-control" name="position[]" value="" required="" placeholder="<?php echo COMPANY_EMPLOYEE_POSITION; ?>"></div></div><div class="col-md-4"><div class="form-group"><label><?php echo COMPANY_EMPLOYER_NAME; ?></label><input type="text" class="form-control" name="employer_name[]" value="" required="" placeholder="<?php echo COMPANY_EMPLOYER_NAME; ?>"></div></div><div class="col-md-4"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_JOB_TASK; ?></label><input type="text" class="form-control" name="job_task[]" value="" required="" placeholder="<?php echo COMPANY_EMPLOYEE_JOB_TASK; ?>"></div></div><div class="col-md-6"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_ADDRESS; ?></label><input type="text" class="form-control" name="address[]" value="" required="" placeholder="<?php echo COMPANY_EMPLOYEE_ADDRESS; ?>"></div></div><div class="col-md-6"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_TOTAL_SALARY; ?></label><input type="text" class="form-control" name="total_salary[]" value="" required="" placeholder="<?php echo COMPANY_EMPLOYEE_TOTAL_SALARY; ?>"></div></div><div class="col-md-6"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_FROM_DATE; ?></label><input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="from_date[]" placeholder="<?php echo COMPANY_EMPLOYEE_FROM_DATE; ?>" autocomplete="off" value="" readonly required></div></div><div class="col-md-6"><div class="form-group"><label><?php echo COMPANY_EMPLOYEE_TO_DATE; ?></label><input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="to_date[]" placeholder="<?php echo COMPANY_EMPLOYEE_TO_DATE; ?>" autocomplete="off" value="" readonly required></div></div></div>');
               
            work_experience_row_id++;
        });

        $(document).on("click", '.delete-work-experience-btn', function(e) {
            var work_experience_row_id = $(this).attr('data-row-id');
            $('#work_experience_rows_' + work_experience_row_id).hide("slow", function(){ $(this).remove(); });
        });
        //End Work-Experience
    });
</script>

<script type="text/javascript">
    //Display Selected Image 
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
            	$('#profile_pic_img').show();
                $('#profile_pic_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile_pic").change(function(){
        readURL(this);
    });
</script>

<script type="text/javascript">
    function getDocument(id){
        show_page_loader();
        $.ajax({
            url: "<?= base_url('sharelink/get_document_details');?>",
            method: "POST",
            data: { id : id },
            success : function(response){
                hide_page_loader();
                var obj = JSON.parse(response);
                if(obj.success == 'true'){                    
                    //$("#update_share_link_id").val($("#share_link_id").val());
                    $("#update_id").val(obj.data.id);
                    $("#update_employee_id").val(obj.data.employee_id);
                    $("#update_title").val(obj.data.title);
                    $("#update_description").val(obj.data.description);
                    $("#update_issue_date").val(obj.data.issue_date);
                    $("#update_expiry_date").val(obj.data.expiry_date);


                    $('#update_expiry_date').datepicker({
                        format: 'dd/mm/yyyy',
                        autoclose : true,
                        startDate: obj.data.issue_date
                    })

                    $('#update_issue_date').datepicker({
                        format: 'dd/mm/yyyy',
                        autoclose : true
                    }).on('changeDate', function(e) {
                        var issue_date = this.value;
                        issue_date = issue_date.split("/");
                        issue_date = new Date(+issue_date[2], issue_date[1] - 1, +issue_date[0]);   
                        $("#update_expiry_date").datepicker('remove'); //detach
                        $("#update_expiry_date").val(''); //detach
                        $('#update_expiry_date').datepicker({
                            format: 'dd/mm/yyyy',
                            autoclose : true,
                            startDate: issue_date
                        });
                    });
                    
                    $("#upload_personal_document").modal("show");
                }else{
                    // notification popup
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = 'toast-bottom-right';    
                    toastr['error']('something went wrong!.');
                }
            },
            error : function(){
                // notification popup
                toastr.options.closeButton = true;
                toastr.options.positionClass = 'toast-bottom-right';    
                toastr['error']('something went wrong!.');
                hide_page_loader();
            }
        });
    }

    function deleteDocument(id)
    {
        swal({
            title: "<?php echo R_U_SURE; ?>",
            text: "<?php echo RECOVER_RECORD; ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "<?php echo YES; ?>",
            closeOnConfirm: false
        }, function () {
            show_page_loader();
            $.ajax({
                url: "<?= site_url('sharelink/delete_document_draft'); ?>",
                type: 'post',
                data: {'id': id},
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