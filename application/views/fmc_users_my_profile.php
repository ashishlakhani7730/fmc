<div id="wrapper">

    <?php include("inc/navbar.php") ?>

    <?php include("inc/sidebar.php") ?>
 

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>My Profile</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                            <li class="breadcrumb-item active">My Profile</li>
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
                        $quick_menu = ($details['quick_menu']) ? explode(',',$details['quick_menu']) : array();


                    ?>
                    <div class="card">
                        <div class="body">
                            <form action="<?= base_url('fmcusers/myprofile');?>" id="create-user" method="post" enctype="multipart/form-data" novalidate>
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6" style="padding-left: 0px;">
                                        <div class="form-group col-lg-8 col-md-6">
                                            <label><?php echo FMC_EMPLOYEE_ID; ?></label>
                                            <input type="text" class="form-control" name="fmc_employee_id"  value="<?php echo $fmc_employee_id; ?>" readonly>
                                        </div>
                                        <div class="form-group col-lg-8 col-md-6">
                                            <label><?php echo FMC_USER_TYPE; ?></label>
                                            <input type="text" class="form-control" name="user_type_tmp" placeholder="<?php echo FMC_EMPLOYEE_ID; ?>" value="<?php echo strtoupper($user_type); ?>" readonly>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label>Departments</label>                  
                                            <?php
                                            $departments_str = "";
                                            foreach ($departments as $key => $value) {
                                                if(in_array($value['id'],$details['departments'])){
                                                    $departments_str = ($departments_str != "") ? "," : "".$value['department_name'];
                                                }
                                            }
                                            ?>   
                                            <input type="text" class="form-control" placeholder="Departments" name="user_type_tmp" value="<?php echo $departments_str; ?>" readonly>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6">
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
                                        <input type="email" class="form-control" name="email" placeholder="<?php echo FMC_EMAIL; ?>" required value="<?php echo $email; ?>" readonly>
                                    </div>
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
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label>Quick Menu</label>
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox" name="quick_menu[]" value="clients/create_general_information" <?php echo (in_array('clients/create_general_information',$quick_menu)) ? 'checked' : ''; ?>><span>Create New Client</span></label>
                                        </div>
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox" name="quick_menu[]" value="fmcusers/create" <?php echo (in_array('fmcusers/create',$quick_menu)) ? 'checked' : ''; ?>><span>Create User</span></label>
                                        </div>
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox" name="quick_menu[]" value="dashboard" <?php echo (in_array('dashboard',$quick_menu)) ? 'checked' : ''; ?>><span>Dashboard</span></label>
                                        </div>
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox" name="quick_menu[]" value="requests" <?php echo (in_array('requests',$quick_menu)) ? 'checked' : ''; ?>><span>Requests</span></label>
                                        </div>
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox" name="quick_menu[]" value="clients" <?php echo (in_array('clients',$quick_menu)) ? 'checked' : ''; ?>><span>Clients</span></label>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <br>
                                <button type="submit" class="btn btn-success">Save</button>
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