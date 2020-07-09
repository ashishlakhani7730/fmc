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
    ?>
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo CLIENTS_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>clients"><?php echo CLIENTS_TITLE; ?> </a></li>
                            <li class="breadcrumb-item active"><?php echo CLIENTS_CONTACT_INFO; ?></li>
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
                                        <a href="<?= site_url(); ?>clients/create_general_information/<?php echo base64_encode($id); ?>" class="flex-item-custom">1. <br /> <span><?php echo CLIENTS_GENERAL_INFO; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_contract_details/<?php echo base64_encode($id); ?>" class="flex-item-custom">2. <br /> <span><?php echo CLIENTS_CONTRACT_DETAILS; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_contact_information/<?php echo base64_encode($id); ?>" class="flex-item-custom active">3. <br /> <span><?php echo CLIENTS_CONTACT_INFORMATIONS; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_property_information/<?php echo base64_encode($id); ?>" class="flex-item-custom">4. <br /> <span><?php echo CLIENTS_PROPERTY_INFORMATION; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_executive_management/<?php echo base64_encode($id); ?>" class="flex-item-custom">5. <br /> <span><?php echo CLIENTS_EXECUTIVE_MANAGEMENT; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_branch_subsidiary/<?php echo base64_encode($id); ?>" class="flex-item-custom">6. <br /> <span><?php echo CLIENTS_BRANCH_SUBSIDIARIES; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_company_documents/<?php echo base64_encode($id); ?>" class="flex-item-custom">7. <br /> <span><?php echo CLIENTS_COMPANY_DOCUMENTS; ?> </span></a>
                                    </div>
                                    <div class="custom-hr"><hr /></div>
                                </div>
                            </div>
                            <form action="<?= base_url('clients/create_contact_information/'.base64_encode($id));?>" id="create-client" method="post" novalidate>
                                <input type="hidden" name="id" value="<?php echo base64_encode($id); ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTACT_P_O_BOX; ?><span class="text-danger">*</span> </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="text" class="form-control" required="" name="post_box_no" value="<?php echo $details['post_box_no']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTACT_BUILDING_NO; ?><span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="building_no" value="<?php echo $details['building_no']; ?>" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTACT_STREET_NAME; ?><span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="street_name" value="<?php echo $details['street_name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTACT_REGION; ?><span class="text-danger">*</span></label>
                                            <select name="region_id" class="form-control show-tick ms select2" data-placeholder="Select Regions" required>
                                            <?php
                                            foreach ($regions as $key => $value) {
                                                $selected = "";
                                                if($details['region_id'] == $value['id']){
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTACT_CITY; ?><span class="text-danger">*</span></label>
                                            <select name="city_id" class="form-control show-tick ms select2" data-placeholder="Select Regions" required>
                                            <?php
                                            foreach ($cities as $key => $value) {
                                                $selected = "";
                                                if($details['city_id'] == $value['id']){
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTACT_ZIP_CODE; ?></label>
                                            <input type="number" class="form-control" name="zip_code" value="<?php echo $details['zip_code']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTACT_ADDITIONAL_NO; ?>  </label>
                                            <input type="text" class="form-control" name="addional_no" value="<?php echo $details['addional_no']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTACT_COORDINATES; ?></label>
                                            <input type="text" class="form-control" name="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTACT_TEL; ?></label>
                                            <input type="number" class="form-control" name="telephone_no" value="<?php echo $details['telephone_no']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTACT_FAX; ?></label>
                                            <input type="text" class="form-control" name="fax_no" value="<?php echo $details['fax_no']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTACT_EMAIL; ?></label>
                                            <input type="email" class="form-control" name="email" value="<?php echo $details['email']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTACT_WEBSITE; ?></label>
                                            <input data-parsley-pattern="^(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})$"  type="text" class="form-control" name="website" value="<?php echo $details['website']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTACT_PERSON_NAME; ?><span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="contact_person_name" value="<?php echo $details['contact_person_name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTACT_PERSON_MO_NO; ?><span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="contact_person_mobile" value="<?php echo $details['contact_person_mobile']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTACT_PERSON_EMAIL; ?><span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="contact_person_email" value="<?php echo $details['contact_person_email']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTACT_PERSON_TEL; ?><span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="contact_person_tel_ext" value="<?php echo $details['contact_person_tel_ext']; ?>" required>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="float-right">
                                            <a href="<?= site_url(); ?>clients/create_property_information/<?php echo base64_encode($id); ?>">
                                                <button type="button" name="skip" class="btn btn-default"><?php echo CLIENTS_CONTRACT_SKIP; ?></button>
                                            </a>
                                            <a href="<?= site_url(); ?>clients/create_contract_details/<?php echo base64_encode($id); ?>">
                                                <button type="button" name="previous" class="btn btn-default"><?php echo CLIENTS_CONTRACT_PREVIOUS; ?></button>
                                            </a>
                                            <button type="submit" name="save" class="btn btn-default"><?php echo CLIENTS_CONTACT_SAVE; ?></button>
                                            <button type="submit" name="next_btn" class="btn btn-info" value="next_btn"><?php echo CLIENTS_NEXT; ?></button>
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

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>

<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script>

<script type="text/javascript">
    $(function() {      
        //initialize Form Validation
        $('#create-client').parsley();

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