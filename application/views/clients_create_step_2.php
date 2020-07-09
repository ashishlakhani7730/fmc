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

        $contract_start_date = (isset($details) && $details['contract_start_date'] != "") ? $details['contract_start_date'] : '0000-00-00';
        $contract_start_date = explode("-", $contract_start_date);
        $contract_start_date = $contract_start_date[2]."/".$contract_start_date[1]."/".$contract_start_date[0];
        if($contract_start_date == '00/00/0000'){
            $contract_start_date = "";
        }

        $contract_agreement_file = (isset($details) && $details['contract_agreement_file'] != "") ? $details['contract_agreement_file'] : 'no file';
        

        $contract_end_date = (isset($details) && $details['contract_end_date'] != "") ? $details['contract_end_date'] : '0000-00-00';
        $contract_end_date = explode("-", $contract_end_date);
        $contract_end_date = $contract_end_date[2]."/".$contract_end_date[1]."/".$contract_end_date[0];
        if($contract_end_date == '00/00/0000'){
            $contract_end_date = "";
        }

        $contract_date = (isset($details) && $details['contract_date'] != "") ? $details['contract_date'] : '0000-00-00';
        $contract_date = explode("-", $contract_date);
        $contract_date = $contract_date[2]."/".$contract_date[1]."/".$contract_date[0];
        if($contract_date == '00/00/0000'){
            $contract_date = "";
        }
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
                            <li class="breadcrumb-item active"><?php echo CLIENT_CONTRACT_DETAILS; ?></li>
                        </ul>                       
                    </div>
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right"></div>
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
                                        <a href="<?= site_url(); ?>clients/create_contract_details/<?php echo base64_encode($id); ?>" class="flex-item-custom active">2. <br /> <span><?php echo CLIENTS_CONTRACT_DETAILS; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_contact_information/<?php echo base64_encode($id); ?>" class="flex-item-custom">3. <br /> <span><?php echo CLIENTS_CONTACT_INFORMATIONS; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_property_information/<?php echo base64_encode($id); ?>" class="flex-item-custom">4. <br /> <span><?php echo CLIENTS_PROPERTY_INFORMATION; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_executive_management/<?php echo base64_encode($id); ?>" class="flex-item-custom">5. <br /> <span><?php echo CLIENTS_EXECUTIVE_MANAGEMENT; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_branch_subsidiary/<?php echo base64_encode($id); ?>" class="flex-item-custom">6. <br /> <span><?php echo CLIENTS_BRANCH_SUBSIDIARIES; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_company_documents/<?php echo base64_encode($id); ?>" class="flex-item-custom">7. <br /> <span><?php echo CLIENTS_COMPANY_DOCUMENTS; ?></span></a>
                                    </div>
                                    <div class="custom-hr"><hr /></div>
                                </div>
                            </div>
                            <form action="<?= base_url('clients/create_contract_details/'.base64_encode($id));?>" id="create-client" method="post" novalidate enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo base64_encode($id); ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTRACT_NO; ?><span class="text-danger">*</span></label>
                                            <input type="text" class="form-control w-90" name="contract_number" value="<?php echo $details['contract_number']; ?>" required="">
                                            <a href="#" class="fr"><img src="<?= site_url(); ?>assets/images/question.png" alt="" /></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTRACT_DATE; ?><span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="contract_date" placeholder="<?php echo CLIENTS_CONTRACT_DATE; ?>" autocomplete="off" value="<?php echo $contract_date; ?>" readonly required>
                                                <div class="input-group-append calendar-open">
                                                    <span class="input-group-text"><i class="icon-calendar"></i></span>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>
                                                        <?php echo CLIENTS_COMPANY_AGREEMENT; ?> 
                                                        <?php
                                                        if(file_exists("uploads/".$contract_agreement_file)){
                                                        ?>
                                                            <br>
                                                            <a target="_blank" href="<?= site_url(); ?>/uploads/<?php echo $contract_agreement_file; ?>" alt="" width="50" height="50"><?php echo CLIENTS_CLICK_TODOWNLOAD; ?></a>
                                                            <br>
                                                        <?php
                                                        }else{
                                                            echo "<br /><br />";  
                                                        }
                                                        ?>
                                                    <span class="text-muted"><?php echo CLIENTS_COMPANY_DOCUMENTS; ?>
                                                    <br /><?php echo CLIENTS_MAX; ?> 
                                                    <br /><?php echo CLIENTS_PDF_DOC; ?> </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <label for="contract_agreement_file" style="width: 100%;">
                                                    <input type="file" class="dropify" name="contract_agreement_file" id="contract_agreement_file">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTRACT_START_DATE; ?></label>
                                            <div class="input-group">
                                                <input class="form-control" id="contract_start_date" name="contract_start_date" placeholder="<?php echo CLIENTS_CONTRACT_START_DATE; ?>" autocomplete="off" value="<?php echo $contract_start_date; ?>" readonly>
                                                <div class="input-group-append calendar-open">
                                                    <span class="input-group-text"><i class="icon-calendar"></i></span>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTRACT_END_DATE; ?></label>
                                            <div class="input-group">
                                                <input class="form-control" id="contract_end_date" name="contract_end_date" placeholder="<?php echo CLIENTS_CONTRACT_END_DATE; ?>" autocomplete="off" value="<?php echo $contract_end_date; ?>" readonly>
                                                <div class="input-group-append calendar-open">
                                                    <span class="input-group-text"><i class="icon-calendar"></i></span>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTRACT_CREATED_BY; ?></label>
                                            <input type="text" name="contract_created_by" value="<?php echo $details['contract_created_by']; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTRACT_SIGNED_BY; ?></label>
                                            <input type="text" name="contract_signed_by_fmc" value="<?php echo $details['contract_signed_by_fmc']; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTRACT_SIGNED_BY_CLIENT; ?></label>
                                            <input type="text" name="contract_signed_by_client" value="<?php echo $details['contract_signed_by_client']; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTRACT_SIGEN_LOCATION; ?></label>
                                            <input type="text" name="contract_signed_location" value="<?php echo $details['contract_signed_location']; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?php echo CLIENTS_CONTRACT_NOTES; ?></label>
                                            <textarea id="ckeditor" name="contract_notes"><?php echo $details['contract_notes']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="float-right">
                                            <a href="<?= site_url(); ?>clients/create_contact_information/<?php echo base64_encode($id); ?>">
                                                <button type="button" name="skip" class="btn btn-default"><?php echo CLIENTS_CONTRACT_SKIP; ?></button>
                                            </a>
                                            <a href="<?= site_url(); ?>clients/create_general_information/<?php echo base64_encode($id); ?>">
                                                <button type="button" name="previous" class="btn btn-default"><?php echo CLIENTS_CONTRACT_PREVIOUS; ?></button>
                                            </a>
                                            <button type="submit" name="save" class="btn btn-default"><?php echo CLIENTS_SAVE; ?></button>
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

        //Open Upload Dialog On Btn Click
        $("#contract_agreement_file_btn").click(function(){
            $('#contract_agreement_file').trigger('click');
        }); 

        //Drag & Drop
        $('.dropify').dropify();

        //CKEditor
        CKEDITOR.replace('ckeditor');
        CKEDITOR.config.height = 200;  

        //Open Calander On Icon Click
        $('.calendar-open').click(function() {
            var ele = $(this).prev("input")
            $(ele).focus();
        });

        $('#contract_start_date').datepicker({
            format: 'dd/mm/yyyy',
            autoclose : true
        }).on('changeDate', function(e) {
            var contract_start_date = this.value;
            contract_start_date = contract_start_date.split("/");
            contract_start_date = new Date(+contract_start_date[2], contract_start_date[1] - 1, +contract_start_date[0]);   
            
            $("#contract_end_date").val(""); 

            $("#contract_end_date").datepicker('remove'); //detach
            $('#contract_end_date').datepicker({
                format: 'dd/mm/yyyy',
                autoclose : true,
                startDate: contract_start_date
            });
        });
            
    });
</script>