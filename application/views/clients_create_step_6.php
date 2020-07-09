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
        
        $trading_name = "";
        $branch_type = "";
        $po_box = "";
        $building_no = "";
        $street_name = "";
        $region_id = "";
        $city_id = "";
        $zip_code = "";
        $addional_no = "";
        $latitude = "";
        $longitude = "";
        $tel_no = "";
        $fax_no = "";
        $email = "";
        $website = "";
        $contact_person_name = "";
        $contact_person_mobile = "";
        $contact_person_email = "";
        $contact_person_tel_ext = "";
    ?>
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo CLIENTS_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>clients"><?php echo CLIENTS_TITLE; ?></a></li>
                            <li class="breadcrumb-item active"><?php echo CLIENTS_BRANCH_SUBSID; ?></li>
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
                                        <a href="<?= site_url(); ?>clients/create_contact_information/<?php echo base64_encode($id); ?>" class="flex-item-custom">3. <br /> <span><?php echo CLIENTS_CONTACT_INFORMATIONS; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_property_information/<?php echo base64_encode($id); ?>" class="flex-item-custom">4. <br /> <span><?php echo CLIENTS_PROPERTY_INFORMATION; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_executive_management/<?php echo base64_encode($id); ?>" class="flex-item-custom">5. <br /> <span><?php echo CLIENTS_EXECUTIVE_MANAGEMENT; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_branch_subsidiary/<?php echo base64_encode($id); ?>" class="flex-item-custom active">6. <br /> <span><?php echo CLIENTS_BRANCH_SUBSIDIARIES; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_company_documents/<?php echo base64_encode($id); ?>" class="flex-item-custom">7. <br /> <span><?php echo CLIENTS_COMPANY_DOCUMENTS; ?> </span></a>
                                    </div>
                                    <div class="custom-hr"><hr /></div>
                                </div>
                            </div>
                            <form action="<?= base_url('clients/create_branch_subsidiary/'.base64_encode($id));?>" id="create-client" method="post" novalidate>
                            <input type="hidden" name="id" value="<?php echo base64_encode($id); ?>">
                                
                                <div class="form-group" id="regions_dropdown" style="display: none;">
                                    <label><?php echo CLIENTS_CONTACT_REGION; ?><span class="text-danger">*</span></label>
                                    <select name="region_id[]" class="form-control show-tick ms" data-placeholder="Select Regions" required>
                                    <?php
                                    foreach ($regions as $key => $value) {
                                        $selected = "";
                                        if($region_id == $value['id']){
                                            $selected = "selected";
                                        }                                
                                    ?>
                                        <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                </div>


                                <div class="form-group" id="city_dropdown" style="display: none;">
                                    <label><?php echo CLIENTS_CONTACT_CITY; ?><span class="text-danger">*</span></label>
                                    <select name="city_id[]" class="form-control show-tick ms" data-placeholder="Select Regions" required>
                                    <?php
                                    foreach ($cities as $key => $value) {
                                        $selected = "";
                                        if($city_id == $value['id']){
                                            $selected = "selected";
                                        }                                
                                    ?>
                                        <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                </div>  

                                <div class="row-box">
                                    <?php
                                    if(!empty($branches)){
                                        foreach ($branches as $key => $value) {
                                            $trading_name = $value['trading_name'];
                                            $branch_type = $value['branch_type'];
                                            $po_box = $value['po_box'];
                                            $building_no = $value['building_no'];
                                            $street_name = $value['street_name'];
                                            $region_id = $value['region_id'];
                                            $city_id = $value['city_id'];
                                            $zip_code = $value['zip_code'];
                                            $addional_no = $value['addional_no'];
                                            $latitude = $value['latitude'];
                                            $longitude = $value['longitude'];
                                            $tel_no = $value['tel_no'];
                                            $fax_no = $value['fax_no'];
                                            $email = $value['email'];
                                            $website = $value['website'];
                                            $contact_person_name = $value['contact_person_name'];
                                            $contact_person_mobile = $value['contact_person_mobile'];
                                            $contact_person_email = $value['contact_person_email'];
                                            $contact_person_tel_ext = $value['contact_person_tel_ext'];

                                    ?>
                                    <div class="row" id="rows_old_<?php echo $key; ?>">
                                        <div class="col-md-12 text-right">
                                            <?php if($key > 0){ ?>
                                            <hr>
                                            <?php } ?>
                                            <button type="button" data-row-id="old_<?php echo $key; ?>" class="btn btn-sm btn-outline-danger delete-btn" title="Delete"><i class="fa fa-trash-o"></i></button>
                                            <br><br>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo CLIENTS_BRANCH_SUBSID_TRADING_NAME; ?><span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" required="" name="trading_name[]" value="<?php echo $trading_name; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo CLIENTS_BRANCH_SUBSID_BRANCH_TYPE; ?><span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" required="" value="<?php echo $branch_type; ?>" name="branch_type[]">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="d-block"><?php echo CLIENTS_CONTACT_P_O_BOX; ?><span class="text-danger">*</span></label>
                                                <input type="text" class="form-control w-90" required="" value="<?php echo $po_box; ?>" name="po_box[]">
                                                <a style="cursor: pointer;" class="fr"><img src="<?= site_url(); ?>assets/images/question.png" alt="" /></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="d-block"><?php echo CLIENTS_CONTACT_BUILDING_NO; ?><span class="text-danger">*</span></label>
                                                <input type="text" class="form-control w-90" required="" value="<?php echo $building_no; ?>" name="building_no[]">
                                                <a style="cursor: pointer;" class="fr"><img src="<?= site_url(); ?>assets/images/question.png" alt="" /></a>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo CLIENTS_CONTACT_STREET_NAME; ?><span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" required="" value="<?php echo $street_name; ?>" name="street_name[]">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="regions_dropdown">
                                                <label><?php echo CLIENTS_CONTACT_REGION; ?><span class="text-danger">*</span></label>
                                                <select name="region_id[]" class="form-control show-tick ms" data-placeholder="Select Regions" required>
                                                <?php
                                                foreach ($regions as $key => $value) {
                                                    $selected = "";
                                                    if($region_id == $value['id']){
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
                                            <div class="form-group" id="city_dropdown">
                                                <label><?php echo CLIENTS_CONTACT_CITY; ?><span class="text-danger">*</span></label>
                                                <select name="city_id[]" class="form-control show-tick ms" data-placeholder="Select Regions" required>
                                                <?php
                                                foreach ($cities as $key => $value) {
                                                    $selected = "";
                                                    if($city_id == $value['id']){
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
                                                <input type="number" class="form-control" value="<?php echo $zip_code; ?>" name="zip_code[]">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo CLIENTS_CONTACT_ADDITIONAL_NO; ?></label>
                                                <input type="text" class="form-control" value="<?php echo $addional_no; ?>" name="addional_no[]">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo CLIENTS_CONTACT_COORDINATES; ?></label>
                                                <input type="hidden" name="latitude[]">
                                                <input type="hidden" name="longitude[]">
                                                <input type="text" class="form-control" name="">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo CLIENTS_CONTACT_TEL; ?></label>
                                                <input type="number" class="form-control"  value="<?php echo $tel_no; ?>" name="tel_no[]">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo CLIENTS_CONTACT_FAX; ?></label>
                                                <input type="text" class="form-control" value="<?php echo $fax_no; ?>" name="fax_no[]">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo CLIENTS_CONTACT_EMAIL; ?></label>
                                                <input type="email" class="form-control" value="<?php echo $email; ?>" name="email[]">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo CLIENTS_CONTACT_WEBSITE; ?></label>
                                                <input data-parsley-pattern="^(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})$" type="text" class="form-control" value="<?php echo $website; ?>" name="website[]">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo CLIENTS_CONTACT_PERSON_NAME; ?><span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" required="" value="<?php echo $contact_person_name; ?>" name="contact_person_name[]">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo CLIENTS_CONTACT_PERSON_MO_NO; ?>
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="number" class="form-control" required="" value="<?php echo $contact_person_mobile; ?>" name="contact_person_mobile[]">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo CLIENTS_CONTACT_PERSON_EMAIL; ?>
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="email" class="form-control" required="" value="<?php echo $contact_person_email; ?>" name="contact_person_email[]">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>
                                                    <?php echo CLIENTS_CONTACT_PERSON_TEL; ?>
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="number" class="form-control" required="" value="<?php echo $contact_person_tel_ext; ?>" name="contact_person_tel_ext[]">
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
                                        <div class="m-b-10">
                                            <button type="button" id="add-more" class="btn btn-info"><?php echo CLIENTS_BRANCH_SUBSID_ADD_BRANCH; ?></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="float-right">
                                            <a href="<?= site_url(); ?>clients/create_company_documents/<?php echo base64_encode($id); ?>">
                                                <button type="button" name="skip" class="btn btn-default"><?php echo CLIENTS_CONTRACT_SKIP; ?></button>
                                            </a>
                                            <a href="<?= site_url(); ?>clients/create_executive_management/<?php echo base64_encode($id); ?>">
                                                <button type="button" name="previous" class="btn btn-default"><?php echo CLIENTS_CONTRACT_PREVIOUS; ?></button>
                                            </a>
                                            <button type="submit" name="save" class="btn btn-default"><?php echo CLIENTS_CONTACT_SAVE; ?></button>
                                            <button type="submit" name="next_btn" class="btn btn-default" value="next_btn"><?php echo CLIENTS_NEXT; ?></button>
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

        var row_id = <?php echo count($branches); ?>;

        $("#add-more").click(function(){

            var append_str = '<div class="row" id="rows_'+row_id+'"><div class="col-md-12 text-right">';

            if(row_id > 0){
                append_str += '<hr>';
            }

            append_str += '<button type="button" data-row-id="'+row_id+'" class="btn btn-sm btn-outline-danger delete-btn" title="Delete"><i class="fa fa-trash-o"></i></button><br><br></div><div class="col-md-6"><div class="form-group"><label><?php echo CLIENTS_BRANCH_SUBSID_TRADING_NAME; ?><span class="text-danger">*</span></label><input type="text" class="form-control" required="" name="trading_name[]" value=""></div></div><div class="col-md-6"><div class="form-group"><label><?php echo CLIENTS_BRANCH_SUBSID_BRANCH_TYPE; ?><span class="text-danger">*</span></label><input type="text" class="form-control" required="" name="branch_type[]"></div></div><div class="col-md-6"><div class="form-group"><label class="d-block"><?php echo CLIENTS_CONTACT_P_O_BOX; ?><span class="text-danger">*</span></label><input type="text" class="form-control w-90" required="" name="po_box[]"><a style="cursor: pointer;" class="fr"><img src="<?= site_url(); ?>assets/images/question.png" alt="" /></a></div></div><div class="col-md-6"><div class="form-group"><label class="d-block"><?php echo CLIENTS_CONTACT_BUILDING_NO; ?><span class="text-danger">*</span></label><input type="text" class="form-control w-90" required="" name="building_no[]"><a style="cursor: pointer;" class="fr"><img src="<?= site_url(); ?>assets/images/question.png" alt="" /></a></div></div><div class="col-md-6"><div class="form-group"><label><?php echo CLIENTS_CONTACT_STREET_NAME; ?><span class="text-danger">*</span></label><input type="text" class="form-control" required="" name="street_name[]"></div></div><div class="col-md-6"><div class="form-group">'+$("#regions_dropdown").html()+'</div></div><div class="col-md-3"><div class="form-group">'+$("#city_dropdown").html()+'</div></div><div class="col-md-3"><div class="form-group"><label><?php echo CLIENTS_CONTACT_ZIP_CODE; ?></label><input type="number" class="form-control" name="zip_code[]"></div></div><div class="col-md-3"><div class="form-group"><label><?php echo CLIENTS_CONTACT_ADDITIONAL_NO; ?></label><input type="text" class="form-control" name="addional_no[]"></div></div><div class="col-md-3"><div class="form-group"><label><?php echo CLIENTS_CONTACT_COORDINATES; ?></label><input type="hidden" name="latitude[]"><input type="hidden" name="longitude[]"><input type="text" class="form-control" name=""></div></div><div class="col-md-3"><div class="form-group"><label><?php echo CLIENTS_CONTACT_TEL; ?></label><input type="number" class="form-control" name="tel_no[]"></div></div><div class="col-md-3"><div class="form-group"><label><?php echo CLIENTS_CONTACT_FAX; ?></label><input type="text" class="form-control" name="fax_no[]"></div></div><div class="col-md-3"><div class="form-group"><label><?php echo CLIENTS_CONTACT_EMAIL; ?></label><input type="email" class="form-control" name="email[]"></div></div><div class="col-md-3"><div class="form-group"><label><?php echo CLIENTS_CONTACT_WEBSITE; ?></label><input data-parsley-pattern="^(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})$" type="text" class="form-control" name="website[]"></div></div><div class="col-md-3"><div class="form-group"><label><?php echo CLIENTS_CONTACT_PERSON_NAME; ?><span class="text-danger">*</span></label><input type="text" class="form-control" required="" name="contact_person_name[]"></div></div><div class="col-md-3"><div class="form-group"><label><?php echo CLIENTS_CONTACT_PERSON_MO_NO; ?><span class="text-danger">*</span></label><input type="number" class="form-control" required="" name="contact_person_mobile[]"></div></div><div class="col-md-3"><div class="form-group"><label><?php echo CLIENTS_CONTACT_PERSON_EMAIL; ?><span class="text-danger">*</span></label><input type="email" class="form-control" required="" name="contact_person_email[]"></div></div><div class="col-md-3"><div class="form-group"><label><?php echo CLIENTS_CONTACT_PERSON_TEL; ?><span class="text-danger">*</span></label><input type="number" class="form-control" required="" name="contact_person_tel_ext[]"></div></div></div>';

            $(".row-box").append(append_str);

            row_id++;

        });

        $(document).on("click", '.delete-btn', function(e) {
            var row_id = $(this).attr('data-row-id');
            $('#rows_' + row_id).hide("slow", function(){ $(this).remove(); });
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