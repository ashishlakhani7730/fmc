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

        $owner_name = "";
        $nationality = "";
        $company_status = "";
        $property_percentage = "";
        
        
        if(count($properties) > 0){
            $owner_name = $properties[0]['owner_name'];
            $nationality = $properties[0]['nationality'];
            $company_status = $properties[0]['company_status'];
            $property_percentage = $properties[0]['property_percentage'];            
        }
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
                            <li class="breadcrumb-item active"><?php echo CLIENTS_PROPERTY; ?></li>
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
                                        <a href="<?= site_url(); ?>clients/create_general_information/<?php echo base64_encode($id); ?>" class="flex-item-custom">1. <br /> <span><?php echo CLIENTS_GENERAL_INFO; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_contract_details/<?php echo base64_encode($id); ?>" class="flex-item-custom">2. <br /> <span><?php echo CLIENTS_CONTRACT_DETAILS; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_contact_information/<?php echo base64_encode($id); ?>" class="flex-item-custom">3. <br /> <span><?php echo CLIENTS_CONTACT_INFORMATIONS; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_property_information/<?php echo base64_encode($id); ?>" class="flex-item-custom active">4. <br /> <span><?php echo CLIENTS_PROPERTY_INFORMATION; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_executive_management/<?php echo base64_encode($id); ?>" class="flex-item-custom">5. <br /> <span><?php echo CLIENTS_EXECUTIVE_MANAGEMENT; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_branch_subsidiary/<?php echo base64_encode($id); ?>" class="flex-item-custom">6. <br /> <span><?php echo CLIENTS_BRANCH_SUBSIDIARIES; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_company_documents/<?php echo base64_encode($id); ?>" class="flex-item-custom">7. <br /> <span><?php echo CLIENTS_COMPANY_DOCUMENTS; ?></span></a>
                                    </div>
                                    <div class="custom-hr"><hr /></div>
                                </div>
                            </div>
                            <form action="<?= base_url('clients/create_property_information/'.base64_encode($id));?>" id="create-client" method="post" novalidate>
                                <input type="hidden" name="id" value="<?php echo base64_encode($id); ?>">

                                <div class="row-box">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo CLIENTS_OWNER_NAME; ?><span class="text-danger">*</span></label>
                                                <input type="text" class="form-control w-90" name="owner_name[]" value="<?php echo $owner_name; ?>" required>
                                                <a style="cursor: pointer;" class="fr"><img src="<?= site_url(); ?>assets/images/question.png" alt="" /></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="nationality">
                                                <label><?php echo CLIENTS_NATIONALITY; ?><span class="text-danger">*</span></label>
                                                <select required name="nationality[]" class="form-control show-tick ms w-90" data-placeholder="Select Nationality">
                                                    <option value=""><?php echo CLIENTS_SELECT_NATIONALITY; ?></option>
                                                    <?php
                                                    if(!empty($countries)){
                                                        foreach ($countries as $key => $value) {
                                                            $selected = "";
                                                            
                                                            if(!empty($nationality)){
                                                                if($value['id'] == $nationality){
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
                                                <a href="#" class="fr"><img src="<?= site_url(); ?>assets/images/question.png" alt="" /></a>
                                            </div>
                                        </div>                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo CLIENTS_COMPANY_STATUS; ?></label>
                                                <input type="text" name="company_status[]" value="<?php echo $company_status; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo CLIENTS_PROPERTY_PERCENTAGE; ?></label>
                                                <input type="text" class="form-control" name="property_percentage[]" value="<?php echo $property_percentage; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if(!empty($properties)){
                                        foreach ($properties as $key => $value) {
                                            if($key > 0){
                                    ?>
                                    <div class="row" id="rows_old_<?php echo $key; ?>">
                                        <div class="col-md-12 text-right">
                                            <hr>
                                            <button type="button" data-row-id="old_<?php echo $key; ?>" class="btn btn-sm btn-outline-danger delete-btn" title="Delete"><i class="fa fa-trash-o"></i></button>
                                            <br><br>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo CLIENTS_OWNER_NAME; ?><span class="text-danger">*</span></label>
                                                <input type="text" class="form-control w-90" name="owner_name[]" value="<?php echo $value['owner_name']; ?>" required>
                                                <a href="#" class="fr"><img src="<?= site_url(); ?>assets/images/question.png" alt="" /></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="nationality">
                                                <label><?php echo CLIENTS_NATIONALITY; ?><span class="text-danger">*</span></label>
                                                <select required name="nationality[]" class="form-control show-tick ms w-90" data-placeholder="Select Nationality">
                                                    <option value=""><?php echo CLIENTS_SELECT_NATIONALITY; ?></option>
                                                    <?php
                                                    if(!empty($countries)){
                                                        foreach ($countries as $key => $country_value) {
                                                            $selected = "";
                                                            
                                                            if(!empty($value['nationality'])){
                                                                if($country_value['id'] == $value['nationality']){
                                                                    $selected = "selected";
                                                                }
                                                            }else{
                                                                if($country_value['is_default'] == '1'){
                                                                    $selected = "selected";
                                                                }
                                                            }
                                                    ?>
                                                        ?>
                                                            <option value="<?php echo $country_value['id']; ?>" <?php echo $selected; ?>><?php echo $country_value['country_name']." (".$country_value['country_code'].")"; ?></option>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <a href="#" class="fr"><img src="<?= site_url(); ?>assets/images/question.png" alt="" /></a>
                                            </div>
                                        </div>                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo CLIENTS_COMPANY_STATUS; ?></label>
                                                <input type="text" name="company_status[]" value="<?php echo $value['company_status']; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo CLIENTS_PROPERTY_PERCENTAGE; ?></label>
                                                <input type="text" class="form-control" name="property_percentage[]" value="<?php echo $value['property_percentage']; ?>">
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
                                        <button type="button" id="add-more" class="btn btn-info m-b-10"> <?php echo CLIENTS_ADD_PROPERTY_INFORMATION; ?></button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-xs-left text-sm-right text-md-right">
                                            <a href="<?= site_url(); ?>clients/create_executive_management/<?php echo base64_encode($id); ?>">
                                                <button type="button" name="skip" class="btn btn-default"><?php echo CLIENTS_CONTRACT_SKIP; ?></button>
                                            </a>
                                            <a href="<?= site_url(); ?>clients/create_contact_information/<?php echo base64_encode($id); ?>">
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

        var row_id = 1;
        $("#add-more").click(function(){

            $(".row-box").append('<div class="row" id="rows_'+row_id+'"><div class="col-md-12 text-right"><hr><button type="button" data-row-id="'+row_id+'" class="btn btn-sm btn-outline-danger delete-btn" title="Delete"><i class="fa fa-trash-o"></i></button><br><br></div><div class="col-md-6"><div class="form-group"><label><?php echo CLIENTS_OWNER_NAME; ?><span class="text-danger">*</span></label><input type="text" class="form-control" name="owner_name[]" required=""></div></div><div class="col-md-6"><div class="form-group">'+$("#nationality").html()+'</div></div><div class="col-md-6"><div class="form-group"><label><?php echo CLIENTS_COMPANY_STATUS; ?></label><input type="text" name="company_status[]" class="form-control"></div></div><div class="col-md-6"><div class="form-group"><label><?php echo CLIENTS_PROPERTY_PERCENTAGE; ?></label><input type="text" name="property_percentage[]" class="form-control"></div></div></div>');

            row_id++;

        });

        $(document).on("click", '.delete-btn', function(e) {
            var row_id = $(this).attr('data-row-id');
            $('#rows_' + row_id).hide("slow", function(){ $(this).remove(); });
        });
        

        //Open Calander On Icon Click
        $('body').on('click', '.calendar-open', function() {
            var ele = $(this).prev("input")
            $(ele).focus();
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