<div id="wrapper">

    <?php include("inc/navbar.php") ?>

    <?php include("inc/sidebar.php") ?>
 
    <?php
        $id = (isset($details) && $details['id']) ? $details['id'] : '';

        $cr_number_from_date = (isset($details) && $details['cr_number_from_date'] != "") ? $details['cr_number_from_date'] : '0000-00-00';

        $cr_number_from_date = explode("-", $cr_number_from_date);
        $cr_number_from_date = $cr_number_from_date[2]."/".$cr_number_from_date[1]."/".$cr_number_from_date[0];
        if($cr_number_from_date == '00/00/0000'){
            $cr_number_from_date = "-";
        }   
        

        $cr_number_issue_date = (isset($details) && $details['cr_number_issue_date'] != "") ? $details['cr_number_issue_date'] : '0000-00-00';
        $cr_number_issue_date = explode("-", $cr_number_issue_date);
        $cr_number_issue_date = $cr_number_issue_date[2]."/".$cr_number_issue_date[1]."/".$cr_number_issue_date[0];
        if($cr_number_issue_date == '00/00/0000'){
            $cr_number_issue_date = "-";
        }


        $cr_number_expiry_date = (isset($details) && $details['cr_number_expiry_date'] != "") ? $details['cr_number_expiry_date'] : '0000-00-00';
        $cr_number_expiry_date = explode("-", $cr_number_expiry_date);
        $cr_number_expiry_date = $cr_number_expiry_date[2]."/".$cr_number_expiry_date[1]."/".$cr_number_expiry_date[0];
        if($cr_number_expiry_date == '00/00/0000'){
            $cr_number_expiry_date = "-";
        }

        $contract_start_date = (isset($details) && $details['contract_start_date'] != "") ? $details['contract_start_date'] : '0000-00-00';
        $contract_start_date = explode("-", $contract_start_date);
        $contract_start_date = $contract_start_date[2]."/".$contract_start_date[1]."/".$contract_start_date[0];
        if($contract_start_date == '00/00/0000'){
            $contract_start_date = "";
        }

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
   	<style type="text/css">
   		.card-panel-body{
   			display: none;
   		}
   	</style>
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo CLIENTS_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>clients"><?php echo CLIENTS_TITLE; ?></a></li>
                            <li class="breadcrumb-item active"><?php echo CLIENTS_DETAILS; ?></li>
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

                    <div class="card">
                        <div class="header">
                            <h2 class="card-panel-header" style="cursor: pointer;" data-target-body="general_information_body"><i class="fa fa-plus"></i> <?php echo CLIENTS_GENERAL_INFORMATION; ?></h2>
                        </div>
                        <div class="body card-panel-body" id="general_information_body">
                            <?php
                            if(file_exists("uploads/".$details['company_logo'])){
                            ?>                        
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="profile-image"> 
                                        <img height="100" width="100" src="<?= site_url(); ?>/uploads/<?php echo $details['company_logo']; ?>" class="rounded-circle" alt="No Image"> 
                                    </div>
                                </div>
                            </div>
                            <br>
                            <?php
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_NAME_ENGLISH; ?> </small>
                                    <p><?php echo $details['company_name_english'] ?></p>
                                </div>
                                <div class="col-md-4">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_NAME_AREBIC; ?></small>
                                    <p><?php echo $details['company_name_arabic'] ?></p>
                                </div>
                                <div class="col-md-4">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_ALL_CIS; ?></small>
                                    <p><?php echo $details['all_cis'] ?></p>
                                </div>
                            </div>
                            <hr>                            
                            <div class="row">
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_C_R_NUMBER; ?> </small>
                                    <p><?php echo $details['cr_number'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_FROM; ?></small>
                                    <p><?php echo $cr_number_from_date; ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_DATE_OF_ISSUE; ?> </small>
                                    <p><?php echo $cr_number_issue_date; ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_DATE_OF_EXPIRY; ?></small>
                                    <p><?php echo $cr_number_expiry_date; ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_LEGAL_ENTITY; ?> </small>
                                    <p><?php echo $details['legal_entity_name'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_DATE_ESTABLISHED; ?></small>
                                    <p><?php echo $cr_number_from_date; ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_MAIN_ACTIVITY; ?> </small>
                                    <p><?php echo $details['main_activity_name']; ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_ABOUT_COMPANY; ?></small>
                                    <p><?php echo $details['country_name']; ?></p>
                                </div>                                
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_COUNTRY_OF_REGION; ?></small>
                                    <div class="testimonial4">
                                        <div class="active item">
                                            <blockquote class="primary"><p><?php echo $details['about_company'] ?></p></blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>                                                  
                        </div>
                    </div>

                    <div class="card planned_task">
                        <div class="header">
                            <h2 class="card-panel-header" style="cursor: pointer;" data-target-body="contract_detail_body"><i class="fa fa-plus"></i> <?php echo CLIENTS_COMPANY_CONTACT_DETAIL; ?></h2>
                        </div>
                        <div class="body card-panel-body" id="contract_detail_body">
                        	<div class="row">
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_CONTRACT; ?> </small>
                                    <p><?php echo $details['contract_number'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_CONTRACT_DATE; ?> </small>
                                    <p><?php echo $contract_date; ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_CONTRACT_START_DATE; ?></small>
                                    <p><?php echo $contract_start_date; ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_CONTRACT_END_DATE; ?> </small>
                                    <p><?php echo $contract_end_date; ?></p>
                                </div>
                            </div>
                            <hr> 
                            <div class="row"> 
                            	<div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted"><?php echo CLIENTS_COMPANY_CONTRACT_CREATED_BY; ?></small>
                                        <p><?php echo $details['contract_created_by'] ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted"><?php echo CLIENTS_COMPANY_CONTRACT_CREATED_BY_FMC; ?></small>
                                        <p><?php echo $details['contract_signed_by_fmc'] ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted"><?php echo CLIENTS_COMPANY_CONTRACT_CREATED_BY_CLIENT; ?></small>
                                        <p><?php echo $details['contract_signed_by_client'] ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted"><?php echo CLIENTS_COMPANY_CONTRACT_SIGNED_LOCATION; ?></small>
                                        <p><?php echo $details['contract_signed_location'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if(file_exists("uploads/".$details['contract_agreement_file'])){
                            ?>
                            <hr> 
                            <div class="row">
                                <div class="col-md-12">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_AGREEMENT; ?></small>
                                    <br>
                                    <a target="_blank" href="<?= site_url(); ?>/uploads/<?php echo $details['contract_agreement_file']; ?>" alt="" width="50" height="50"><?php echo CLIENTS_CLICK_TODOWNLOAD; ?></a>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_CONTRACT_NOTES; ?> </small>
                                    <div class="testimonial4">
                                        <div class="active item">
                                            <blockquote class="primary"><p><?php echo $details['contract_notes'] ?></p></blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="card planned_task">
                        <div class="header">
                            <h2 class="card-panel-header" style="cursor: pointer;" data-target-body="contact_information_body"><i class="fa fa-plus"></i> <?php echo CLIENTS_COMPANY_CONTRACT_INFO; ?></h2>
                        </div>
                        <div class="body card-panel-body" id="contact_information_body">
                        	<div class="row">
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_P_O_BOX; ?></small>
                                    <p><?php echo $details['post_box_no'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_BUILDING_NO; ?> </small>
                                    <p><?php echo $details['building_no'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_STREET_NAME; ?>  </small>
                                    <p><?php echo $details['street_name'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_REGION; ?> </small>
                                    <p><?php echo $details['region_name'] ?></p>
                                </div>
                            </div>
                            <hr> 
                            <div class="row">
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_CITY; ?></small>
                                    <p><?php echo $details['city_name'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_ZIP_CODE; ?> </small>
                                    <p><?php echo $details['zip_code'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_ADDITONAL_NO; ?>  </small>
                                    <p><?php echo $details['addional_no'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_TEL; ?> </small>
                                    <p><?php echo $details['telephone_no'] ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_FAX; ?></small>
                                    <p><?php echo $details['fax_no'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_EMAIL; ?></small>
                                    <p><?php echo $details['email'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_WELCOME; ?></small>
                                    <p><?php echo $details['website'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_CONTACT_PERSON_NAME; ?> </small>
                                    <p><?php echo $details['contact_person_name'] ?></p>
                                </div>
                            </div>
                            <hr> 
                            <div class="row">
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_CONTACT_PERSON_NO; ?></small>
                                    <p><?php echo $details['contact_person_mobile'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_CONTACT_PERSON_EMAIL; ?> </small>
                                    <p><?php echo $details['contact_person_email'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted"><?php echo CLIENTS_COMPANY_CONTACT_PERSON_TEL; ?></small>
                                    <p><?php echo $details['contact_person_tel_ext'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card planned_task">
                        <div class="header">
                            <h2 class="card-panel-header" style="cursor: pointer;" data-target-body="property_information_body"><i class="fa fa-plus"></i> <?php echo CLIENTS_COMPANY_CONTACT_PROPERTY_INFORMATION; ?></h2>
                        </div>
                        <div class="body card-panel-body" id="property_information_body">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped js-basic-example dataTable table-custom">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th><?php echo CLIENTS_COMPANY_OWNER_NAME; ?></th>
                                                <th><?php echo CLIENTS_COMPANY_NATIONALITY; ?></th>
                                                <th><?php echo CLIENTS_COMPANY_STATUS; ?></th>
                                                <th><?php echo CLIENTS_COMPANY_PERCENTAGE; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!empty($properties)){
                                            foreach ($properties as $key => $value) {
                                            ?>
                                            <tr>
                                                <td><?php echo $value['owner_name']; ?></td>
                                                <td><?php echo $value['nationality_name']; ?></td>
                                                <td><?php echo $value['company_status']; ?></td>
                                                <td><?php echo $value['property_percentage']; ?></td>
                                            </tr>
                                            <?php
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card planned_task">
                        <div class="header">
                            <h2 class="card-panel-header" style="cursor: pointer;" data-target-body="executive_management_body"><i class="fa fa-plus"></i> <?php echo CLIENTS_COMPANY_EXECUTIVE; ?></h2>
                        </div>
                        <div class="body card-panel-body" id="executive_management_body">
                            <table class="table table-hover table-striped js-basic-example dataTable table-custom">
                                <thead class="thead-dark">
                                    <tr>
                                        <th><?php echo CLIENTS_COMPANY_EXECUTIVE_NAME; ?></th>
                                        <th><?php echo CLIENTS_COMPANY_JOB_POSSITIONS; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!empty($executives)){
                                    foreach ($executives as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $value['executive_name']; ?></td>
                                        <td><?php echo $value['job_position']; ?></td>
                                    </tr>
                                    <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card planned_task">
                        <div class="header">
                            <h2 class="card-panel-header" style="cursor: pointer;" data-target-body="branches_subsidiary_body"><i class="fa fa-plus"></i> <?php echo CLIENTS_COMPANY_BRANCH; ?></h2>
                        </div>
                        <div class="body card-panel-body" id="branches_subsidiary_body">
                        <?php
                        if(!empty($branches)){
                            foreach ($branches as $key => $value) {
                        ?>                                         
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="text-muted"><?php echo CLIENTS_COMPANY_TRADING_NAME; ?> </small>
                                        <p><?php echo $value['trading_name']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="text-muted"><?php echo CLIENTS_COMPANY_BRANCH_TYPE; ?> </small>
                                        <p><?php echo $value['branch_type']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="text-muted" class="d-block"><?php echo CLIENTS_COMPANY_P_O_BOX; ?></small>
                                        <p><?php echo $value['po_box']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="text-muted" class="d-block"><?php echo CLIENTS_COMPANY_BUILDING_NO; ?></small>
                                        <p><?php echo $value['building_no']; ?></p>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="text-muted"><?php echo CLIENTS_COMPANY_STREET_NAME; ?></small>
                                        <p><?php echo $value['street_name']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="text-muted"><?php echo CLIENTS_COMPANY_REGION; ?></small>
                                        <p><?php echo $value['region_name']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted"><?php echo CLIENTS_COMPANY_CITY; ?></small>
                                        <p><?php echo $value['city_name']; ?></p>
                                    </div>                                  
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted"><?php echo CLIENTS_COMPANY_ZIP_CODE; ?></small>
                                        <p><?php echo $value['zip_code']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted"><?php echo CLIENTS_COMPANY_ADDITONAL_NO; ?></small>
                                        <p><?php echo $value['addional_no']; ?></p>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted"><?php echo CLIENTS_COMPANY_TEL; ?></small>
                                        <p><?php echo $value['tel_no']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted"><?php echo CLIENTS_COMPANY_FAX; ?></small>
                                        <p><?php echo $value['fax_no']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted"><?php echo CLIENTS_COMPANY_EMAIL; ?></small>
                                        <p><?php echo $value['email']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted"><?php echo CLIENTS_COMPANY_WEBSITE; ?></small>
                                        <p><?php echo $value['website']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted"><?php echo CLIENTS_COMPANY_CONTACT_PERSON_NAME; ?></small>
                                        <p><?php echo $value['contact_person_name']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted"><?php echo CLIENTS_COMPANY_CONTACT_PERSON_NO; ?></small>
                                        <p><?php echo $value['contact_person_mobile']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted"><?php echo CLIENTS_COMPANY_CONTACT_PERSON_EMAIL; ?></small>
                                        <p><?php echo $value['contact_person_email']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted"><?php echo CLIENTS_COMPANY_CONTACT_PERSON_TEL; ?></small>
                                        <p><?php echo $value['contact_person_tel_ext']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        <?php 
                            }
                        }
                        ?>
                        </div>
                    </div>

                    <div class="card planned_task">
                        <div class="header">
                            <h2 class="card-panel-header" style="cursor: pointer;" data-target-body="company_documents_body"><i class="fa fa-plus"></i> <?php echo CLIENTS_COMPANY_DOCUMENTS; ?></h2>
                        </div>
                        <div class="body card-panel-body" id="company_documents_body">
                            <table class="table table-hover table-striped js-basic-example dataTable table-custom">
                                <thead class="thead-dark">
                                    <tr>
                                        <th><?php echo CLIENTS_COMPANY_DOCUMENT_TITLE; ?></th>
                                        <th><?php echo CLIENTS_COMPANY_DOCUMENT_DATE; ?></th>
                                        <th><?php echo CLIENTS_COMPANY_DOCUMENT_EXPIRY_DATE; ?></th>
                                        <th><?php echo CLIENTS_COMPANY_ADDED_DOC; ?></th>
                                        <th><?php echo CLIENTS_COMPANY_NOTES; ?></th>
                                        <th>***</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                    if(!empty($documents)){
                                    foreach ($documents as $key => $value) {

                                        $date = (isset($value) && $value['date'] != "") ? $value['date'] : '0000-00-00';
                                        $date = explode("-", $date);
                                        $date = $date[2]."/".$date[1]."/".$date[0];
                                        if($date == '00/00/0000'){
                                            $date = "-";
                                        }

                                        $expire_date = (isset($value) && $value['expire_date'] != "") ? $value['expire_date'] : '0000-00-00';
                                        $expire_date = explode("-", $expire_date);
                                        $expire_date = $expire_date[2]."/".$expire_date[1]."/".$expire_date[0];
                                        if($expire_date == '00/00/0000'){
                                            $expire_date = "-";
                                        }

                                        $created_at = (isset($value) && $value['created_at'] != "") ? $value['created_at'] : '0000-00-00 00:00:00';
                                        
                                        $created_at = explode(" ", $created_at);


                                        $created_at_date = $created_at[0];
                                        $created_at_date = explode("-", $created_at_date);

                                        $created_at_date = $created_at_date[2]."/".$created_at_date[1]."/".$created_at_date[0];
                                        if($created_at_date == '00/00/0000'){
                                            $created_at_date = "-";
                                        }
                                    ?>

                                    
                                    <tr>
                                        <td><?php echo $value['title']; ?></td>
                                        <td><?php echo $date; ?></td>   
                                        <td><?php echo $expire_date; ?></td>
                                        <td>
                                            <h6 class="mb-0"><?php echo $value['created_by_first_name']." ".$value['created_by_last_name']." ".$value['created_by_surname']; ?></h6>
                                            <span><?php echo $created_at_date; ?></span>
                                        </td>
                                        <td><?php echo $value['note']; ?></td>
                                        <td>
                                            <a href="<?= site_url(); ?>uploads/<?php echo $value['document_file']; ?>" target="_blank" class="btn btn-sm btn-outline-primary" download="<?php echo $value['document_file']; ?>" style="font-size:smaller;" ><i class="fa fa-download"></i></a>
                                        </td>
                                    </tr>
                                    <?php 
                                    }
                                    }
                                    ?>
                                    
                                    
                                   
                                </tbody>
                            </table>
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
        
        $('.card-panel-header').click(function(){
        	var target_id = $(this).attr("data-target-body");
        	$("#"+target_id).toggle('slow');
        	if($(this).children().hasClass('fa-plus')){
        		$(this).find('.fa-plus').addClass('fa-minus');
        		$(this).find('.fa-plus').removeClass('fa-plus');
        	}else{
        		$(this).find('.fa-minus').addClass('fa-plus');
        		$(this).find('.fa-minus').removeClass('fa-minus');
        	}
        });

    });
</script>