<div id="wrapper">

    <?php include("inc/navbar.php") ?>

    <?php include("inc/sidebar.php") ?>
 

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo FMC_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                            <li class="breadcrumb-item active"><?php echo FMC_UPDATE_USER; ?></li>
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

                        $fmc_employee_id = ($details['fmc_employee_id']) ? $details['fmc_employee_id'] : "";

                        $profile_picture = ($details['profile_picture']) ? $details['profile_picture'] : "";

                        $user_type = ($details['user_type']) ? $details['user_type'] : "";
                        $first_name = ($details['first_name']) ? $details['first_name'] : "";
                        $last_name = ($details['last_name']) ? $details['last_name'] : "";
                        $surname = ($details['surname']) ? $details['surname'] : "";
                        $email = ($details['email']) ? $details['email'] : "";                        
                        $mobile = ($details['mobile']) ? $details['mobile'] : "";
                        $alternative_mobile_no = ($details['alternative_mobile_no']) ? $details['alternative_mobile_no'] : "";
                        $birthdate = ($details['birthdate']) ? $details['birthdate'] : "";
                        
                        $birthdate = explode("-", $birthdate);
                        $birthdate = $birthdate[2]."/".$birthdate[1]."/".$birthdate[0];


                        $address = ($details['address']) ? $details['address'] : "";
                        

                    ?>
                    <div class="card">
                        <div class="body">
                            <form action="<?= base_url('fmcusers/update');?>" id="create-user" method="post" enctype="multipart/form-data" novalidate>
                                <input type="hidden" name="id" value="<?php echo base64_encode($details['id']); ?>">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6" style="padding-left: 0px;">
                                        <div class="form-group col-lg-8 col-md-6">
                                            <label><?php echo FMC_EMPLOYEE_ID; ?></label>
                                            <input type="text" class="form-control" name="fmc_employee_id" placeholder="<?php echo FMC_EMPLOYEE_ID; ?>" required value="<?php echo $fmc_employee_id; ?>">
                                        </div>
                                        <div class="form-group col-lg-8 col-md-6">
                                            <label><?php echo FMC_USER_TYPE; ?></label>
                                            <select id="user_type" name="user_type" class="form-control show-tick ms select2" data-placeholder="Select" required>
                                                <option value=""><?php echo FMC_SELECT_USER_TYPE; ?></option>
                                                <option value="ceo" <?php echo ($user_type == "ceo") ? 'selected' : ''; ?>><?php echo FMC_CEO; ?></option>
                                                <option value="hr" <?php echo ($user_type == "hr") ? 'selected' : ''; ?>><?php echo FMC_HR; ?></option>
                                                <option value="coordinator" <?php echo ($user_type == "coordinator") ? 'selected' : ''; ?>><?php echo FMC_COORDINATOR; ?></option>
                                            </select>                                            
                                        </div>
                                        <div class="form-group col-lg-8 col-md-6">
                                            <label><?php echo FMC_SELECT_DEPARTMENT; ?><span class="text-danger">*</span></label>
                                            <select name="department_ids[]" class="form-control show-tick ms select2" multiple data-placeholder="Select Department">
                                                <option value=""><?php echo FMC_SELECT_USER_TYPE; ?></option>
                                                <?php
                                                foreach ($departments as $key => $value) {
                                                    $selected = "";
                                                    if(in_array($value['id'],$details['departments'])){
                                                        $selected = "selected";
                                                    }                                
                                                ?>
                                                    <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['department_name']; ?></option>
                                            <?php
                                                }
                                            ?>
                                            </select>                                           
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 text-center">
                                        <div class="form-group col-lg-4 col-md-6">
                                            <div class="profile-image">
                                                <label for="profile_picture">
                                                    <?php if(file_exists("uploads/".$profile_picture)){ ?>
                                                        <img height="100" id="profile_picture_img" width="100" src="<?= site_url(); ?>uploads/<?php echo $profile_picture; ?>" class="rounded-circle" alt="">
                                                    <?php }else{ ?> 
                                                    <img height="100" id="profile_picture_img" width="100" src="<?= site_url(); ?>assets/profiles/ppro.png" class="rounded-circle" alt="">
                                                    <?php } ?>

                                                    <input name="profile_picture" type="file" id="profile_picture" style="display:none">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-4 col-md-6">
                                        <label><?php echo FMC_FIRST_NAME; ?></label>
                                        <input type="text" class="form-control" name="first_name" placeholder="<?php echo FMC_FIRST_NAME; ?>" required value="<?php echo $first_name; ?>">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6">
                                        <label><?php echo FMC_MIDDLE_NAME; ?></label>
                                        <input type="text" class="form-control" name="last_name" placeholder="<?php echo FMC_MIDDLE_NAME; ?>" required value="<?php echo $last_name; ?>">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6">
                                        <label><?php echo FMC_LAST_NAME; ?></label>
                                        <input type="text" class="form-control" name="surname" placeholder="<?php echo FMC_LAST_NAME; ?>" value="<?php echo $surname; ?>">
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-4 col-md-6">
                                        <label><?php echo FMC_EMAIL; ?></label>
                                        <input type="email" class="form-control" name="email" placeholder="<?php echo FMC_EMAIL; ?>" required value="<?php echo $email; ?>">
                                    </div>
                                    <!--
                                    <div class="form-group col-lg-4 col-md-6">
                                        <label>Password</label>
                                        <input type="text" class="form-control" id="password" name="password" placeholder="Password" required>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6">
                                        <label>Confirm Password</label>
                                        <input type="text" class="form-control" name="co_password" placeholder="Confirm Password" required data-parsley-equalto-message="This value should be the same as password." data-parsley-equalto="#password">
                                    </div>-->
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-4 col-md-6">
                                        <label><?php echo FMC_MOBILE; ?></label>
                                        <input type="number" class="form-control" name="mobile" placeholder="<?php echo FMC_MOBILE; ?>" required value="<?php echo $mobile; ?>">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6">
                                        <label><?php echo FMC_ALTERNATIVE_MOBILE; ?></label>
                                        <input type="number" class="form-control" name="alternative_mobile_no" placeholder="<?php echo FMC_ALTERNATIVE_MOBILE; ?>" value="<?php echo $alternative_mobile_no; ?>">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6">
                                        <label><?php echo FMC_BIRTHDATE; ?></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">           
                                                <button class="btn input-group-text" type="button"><i class="icon-calendar"></i></button>
                                            </div>
                                            <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="birthdate" placeholder="<?php echo FMC_BIRTHDATE; ?>" required autocomplete="off" value="<?php echo $birthdate; ?>">
                                        </div>
                                    </div>                                    
                                </div>
                                
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo FMC_ADDRESS; ?></label>
                                        <textarea class="form-control" name="address" required><?php echo $address; ?></textarea>
                                    </div>
                                </div>
                                
                                
                                <br>
                                <button type="submit" class="btn btn-success"><?php echo FMC_SAVE_USER; ?></button>
                                <a href="<?= site_url(); ?>fmcusers"><button type="button" class="btn btn-danger"><?php echo FMC_CANCEL; ?></button></a>
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

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>

<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
    $(function() {      
        //initialize Form Validation
        $('#create-user').parsley();

        // Multiselect
        $('#departments').multiselect({
            maxHeight: 300
        });

    });
</script>


<script type="text/javascript">
    //Display Selected Image 
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile_picture_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile_picture").change(function(){
        readURL(this);
    });
</script>