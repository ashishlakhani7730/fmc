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
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Clients</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>clients">Clients</a></li>
                            <li class="breadcrumb-item active">Confirm Client Details</li>
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
                            <h2 class="card-panel-header" style="cursor: pointer;" data-target-body="general_information_body"><i class="fa fa-plus"></i>  General Information</h2>
                            <ul class="header-dropdown">
                                <li class="remove">
                                    <a role="button" href="<?= site_url(); ?>clients/create_general_information/<?php echo base64_encode($details['id']); ?>"><i class="fa fa-edit"></i></a>
                                </li>
                            </ul>
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
                                    <small class="text-muted">Company Name - English: </small>
                                    <p><?php echo $details['company_name_english'] ?></p>
                                </div>
                                <div class="col-md-4">
                                    <small class="text-muted">Company Name - Arabic: </small>
                                    <p><?php echo $details['company_name_arabic'] ?></p>
                                </div>
                                <div class="col-md-4">
                                    <small class="text-muted">All CIS: </small>
                                    <p><?php echo $details['all_cis'] ?></p>
                                </div>
                            </div>
                            <hr>                            
                            <div class="row">
                                <div class="col-md-3">
                                    <small class="text-muted">C.R Number: </small>
                                    <p><?php echo $details['cr_number'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">From: </small>
                                    <p><?php echo $cr_number_from_date; ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Date of issue: </small>
                                    <p><?php echo $cr_number_issue_date; ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Date of expiry: </small>
                                    <p><?php echo $cr_number_expiry_date; ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <small class="text-muted">Legal entity: </small>
                                    <p><?php echo $details['legal_entity_name'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Date established: </small>
                                    <p><?php echo $cr_number_from_date; ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Main activity: </small>
                                    <p><?php echo $details['main_activity_name']; ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Country of Origin: </small>
                                    <p><?php echo $details['country_name']; ?></p>
                                </div>                                
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <small class="text-muted">About Company: </small>
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
                            <h2 class="card-panel-header" style="cursor: pointer;" data-target-body="contract_detail_body"><i class="fa fa-plus"></i>  Contract Detail</h2>
                            <ul class="header-dropdown">
                                <li class="remove">
                                    <a role="button" href="<?= site_url(); ?>clients/create_contract_details/<?php echo base64_encode($details['id']); ?>"><i class="fa fa-edit"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body card-panel-body" id="contract_detail_body">
                            <div class="row">
                                <div class="col-md-3">
                                    <small class="text-muted">Contract No.: </small>
                                    <p><?php echo $details['contract_number'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Contract date: </small>
                                    <p><?php echo $contract_date; ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Contract start date: </small>
                                    <p><?php echo $contract_start_date; ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Contract end date: </small>
                                    <p><?php echo $contract_end_date; ?></p>
                                </div>
                            </div>
                            <hr> 
                            <div class="row"> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">Contract created by</small>
                                        <p><?php echo $details['contract_created_by'] ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">Contract signed by ( FMC )</small>
                                        <p><?php echo $details['contract_signed_by_fmc'] ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">Contract signed by ( Client )</small>
                                        <p><?php echo $details['contract_signed_by_client'] ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">Contract signed location</small>
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
                                    <small class="text-muted"><?php echo REQUESTS_CONTACT_AGREEMENT_FILE; ?></small>
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
                                    <small class="text-muted">Contract Notes: </small>
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
                            <h2 class="card-panel-header" style="cursor: pointer;" data-target-body="contact_information_body"><i class="fa fa-plus"></i>  Contact Information</h2>
                            <ul class="header-dropdown">
                                <li class="remove">
                                    <a role="button" href="<?= site_url(); ?>clients/create_contact_information/<?php echo base64_encode($details['id']); ?>"><i class="fa fa-edit"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body card-panel-body" id="contact_information_body">
                            <div class="row">
                                <div class="col-md-3">
                                    <small class="text-muted">P,O,Box: </small>
                                    <p><?php echo $details['post_box_no'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Building No: </small>
                                    <p><?php echo $details['building_no'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Street Name: </small>
                                    <p><?php echo $details['street_name'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Region: </small>
                                    <p><?php echo $details['region_name'] ?></p>
                                </div>
                            </div>
                            <hr> 
                            <div class="row">
                                <div class="col-md-3">
                                    <small class="text-muted">City: </small>
                                    <p><?php echo $details['city_name'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Zip Code: </small>
                                    <p><?php echo $details['zip_code'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Addional No: </small>
                                    <p><?php echo $details['addional_no'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Tel: </small>
                                    <p><?php echo $details['telephone_no'] ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <small class="text-muted">Fax: </small>
                                    <p><?php echo $details['fax_no'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Email: </small>
                                    <p><?php echo $details['email'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Website: </small>
                                    <p><?php echo $details['website'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Contact person name: </small>
                                    <p><?php echo $details['contact_person_name'] ?></p>
                                </div>
                            </div>
                            <hr> 
                            <div class="row">
                                <div class="col-md-3">
                                    <small class="text-muted">Contact person mobile number: </small>
                                    <p><?php echo $details['contact_person_mobile'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Contact person email: </small>
                                    <p><?php echo $details['contact_person_email'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Contact person Tel/ext: </small>
                                    <p><?php echo $details['contact_person_tel_ext'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card planned_task">
                        <div class="header">
                            <h2 class="card-panel-header" style="cursor: pointer;" data-target-body="property_information_body"><i class="fa fa-plus"></i>  Property Information</h2>
                            <ul class="header-dropdown">
                                <li class="remove">
                                    <a role="button" href="<?= site_url(); ?>clients/create_property_information/<?php echo base64_encode($details['id']); ?>"><i class="fa fa-edit"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body card-panel-body" id="property_information_body">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped js-basic-example dataTable table-custom">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Owner Name</th>
                                                <th>Nationality</th>
                                                <th>Status</th>
                                                <th>Percentage</th>
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
                            <h2 class="card-panel-header" style="cursor: pointer;" data-target-body="executive_management_body"><i class="fa fa-plus"></i>  Executive Management</h2>
                            <ul class="header-dropdown">
                                <li class="remove">
                                    <a role="button" href="<?= site_url(); ?>clients/create_executive_management/<?php echo base64_encode($details['id']); ?>"><i class="fa fa-edit"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body card-panel-body" id="executive_management_body">
                            <table class="table table-hover table-striped js-basic-example dataTable table-custom">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Executive Name</th>
                                        <th>Job-Position</th>
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
                            <h2 class="card-panel-header" style="cursor: pointer;" data-target-body="branches_subsidiary_body"><i class="fa fa-plus"></i>  Branches / Subsidiary</h2>
                            <ul class="header-dropdown">
                                <li class="remove">
                                    <a role="button" href="<?= site_url(); ?>clients/create_branch_subsidiary/<?php echo base64_encode($details['id']); ?>"><i class="fa fa-edit"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body card-panel-body" id="branches_subsidiary_body">
                        <?php
                        if(!empty($branches)){
                            foreach ($branches as $key => $value) {
                        ?>                                         
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="text-muted">Trading name: </small>
                                        <p><?php echo $value['trading_name']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="text-muted">Branch Type: </small>
                                        <p><?php echo $value['branch_type']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="text-muted" class="d-block">P,O,Box:</small>
                                        <p><?php echo $value['po_box']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="text-muted" class="d-block">Building No:</small>
                                        <p><?php echo $value['building_no']; ?></p>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="text-muted">Street Name:</small>
                                        <p><?php echo $value['street_name']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="text-muted">Regions:</small>
                                        <p><?php echo $value['region_name']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">City:</small>
                                        <p><?php echo $value['city_name']; ?></p>
                                    </div>                                  
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">Zip Code:</small>
                                        <p><?php echo $value['zip_code']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">Addional No:</small>
                                        <p><?php echo $value['addional_no']; ?></p>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">Tel:</small>
                                        <p><?php echo $value['tel_no']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">Fax:</small>
                                        <p><?php echo $value['fax_no']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">Email:</small>
                                        <p><?php echo $value['email']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">Website:</small>
                                        <p><?php echo $value['website']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">Contact person name:</small>
                                        <p><?php echo $value['contact_person_name']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">Contact person mobile number:</small>
                                        <p><?php echo $value['contact_person_mobile']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">Contact person email:</small>
                                        <p><?php echo $value['contact_person_email']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">Contact person Tel/ext:</small>
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
                            <h2 class="card-panel-header" style="cursor: pointer;" data-target-body="company_documents_body"><i class="fa fa-plus"></i>  Company Documents</h2>
                            <ul class="header-dropdown">
                                <li class="remove">
                                    <a role="button" href="<?= site_url(); ?>clients/create_company_documents/<?php echo base64_encode($details['id']); ?>"><i class="fa fa-edit"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body card-panel-body" id="company_documents_body">
                            <table class="table table-hover table-striped js-basic-example dataTable table-custom">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo CLIENTS_DOCUMENT_TITLE; ?></th>
                                        <th><?php echo CLIENTS_DOCUMENT_NOTE; ?></th>
                                        <th><?php echo CLIENTS_DOCUMENT_EXPIARY_DATE; ?></th>
                                        <th>***</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                    if(!empty($documents)){
                                    $doc_index = 1;
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
                                        <td><?php echo $doc_index; ?></td>
                                        <td><?php echo $value['title']; ?></td>
                                        <td><?php echo substr($value['note'],0,50); ?></td>
                                        <td><?php echo $expire_date; ?></td>
                                        <td>
                                            <a href="<?= site_url(); ?>uploads/<?php echo $value['document_file']; ?>" target="_blank" class="btn btn-sm btn-outline-primary" download="<?php echo $value['document_file']; ?>" style="font-size:smaller;" ><i class="fa fa-download"></i></a>
                                        </td>
                                    </tr>
                                    <?php 
                                    $doc_index++;
                                    }
                                    }
                                    ?>
                                    
                                    
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php if($details['status'] == 'draft'){ ?>
                    <div class="card planned_task">
                        <div class="header">
                            <h2>Confirm All Client Details</h2>
                        </div>
                        <div class="body">
                            <form action="<?= base_url('clients/validate_client_detail/'.base64_encode($id));?>" id="create-client" method="post" novalidate>
                            <input type="hidden" name="id" value="<?php echo base64_encode($id); ?>">
                                <div class="row">
                                    <?php 
                                    $error_count = 0;
                                    if($details['company_name_english'] == ""){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">Company English name should not blank.</div>';
                                    }
                                    if($details['company_name_arabic'] == ""){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">Company Arabic name should not blank.</div>';
                                    }
                                    if($details['primary_hr'] == "0"){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">Please select primary-HR.</div>';
                                    }
                                    if($details['all_cis'] == ""){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">All CIS should not blank.</div>';
                                    }
                                    if($details['cr_number'] == ""){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">CR-Number should not blank.</div>';
                                    }
                                    if($details['cr_number_from_date'] == ""){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">CR-Number from-date should not blank.</div>';
                                    }
                                    if($details['cr_number_issue_date'] == ""){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">CR-Number issue date should not blank.</div>';
                                    }
                                    if($details['cr_number_expiry_date'] == ""){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">CR-Number expiry date should not blank.</div>';
                                    }
                                    if($details['country_of_origin'] == "0"){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">Please select Country of Origin.</div>';
                                    }


                                    if($details['contract_number'] == ""){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">Contact-Number should not blank.</div>';
                                    }
                                    if($details['contract_date'] == "0000-00-00"){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">Contact-Date should not blank.</div>';
                                    }
                                    if($details['contract_agreement_file'] == ""){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">Contract-Agreement file should not blank.</div>';
                                    }
                                    

                                    if($details['post_box_no'] == ""){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">Contract-Information - PO. Box should not blank.</div>';
                                    }
                                    if($details['building_no'] == ""){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">Contract-Information - Building-no should not blank.</div>';
                                    }
                                    if($details['street_name'] == ""){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">Contract-Information - Street-name should not blank.</div>';
                                    }
                                    if($details['region_id'] == "0"){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">Contract-Information - Region should not blank.</div>';
                                    }
                                    if($details['city_id'] == "0"){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">Contract-Information - City should not blank.</div>';
                                    }
                                    if($details['contact_person_name'] == ""){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">Contract-Information - Contact person name should not blank.</div>';
                                    }
                                    if($details['contact_person_mobile'] == ""){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">Contract-Information - Contact person mobile number should not blank.</div>';
                                    }
                                    if($details['contact_person_email'] == ""){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">Contract-Information - Contact person email should not blank.</div>';
                                    }
                                    if($details['contact_person_tel_ext'] == ""){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">Contract-Information - Contact person Tel/ext should not blank.</div>';
                                    }

                                    if(count($properties) == 0){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">Property-Information should not blank.</div>';
                                    }

                                    if(count($executives) == 0){
                                        $error_count++;
                                        echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">Executive-Information should not blank.</div>';
                                    }

                                    $document_title = array_column($documents, 'title');
                                    foreach ($required_documents as $value) {
                                        if(!in_array($value,$document_title)){
                                            $error_count++;
                                            echo '<div class="col-lg-12 col-md-12 alert alert-warning login-alert has-error">Documents - '.$value.' is required.</div>';       
                                        }
                                    }

                                    ?>
                                </div>
                                <div class="row">
                                    <?php if($error_count == 0){ ?>
                                    <div class="col-md-12">
                                        <p>All above client details are validate</p>
                                    </div>
                                    <?php } ?>
                                    <div class="col-md-12">
                                        <div class="float-right">
                                            <a href="<?= site_url(); ?>clients/create_company_documents/<?php echo base64_encode($id); ?>">
                                                <button type="button" name="previous" class="btn btn-default">Previous</button>
                                            </a>
                                            <button <?php echo ($error_count > 0) ? "disabled" : ""; ?> type="submit" name="save" class="btn btn-info">Validate & Save</button>
                                        </div>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if($details['status'] == 'detail_validated'){ ?>
                    <div class="card planned_task">
                        <div class="header">
                            <h2>Assign Verifier</h2>
                        </div>
                        <div class="body">
                            <form action="<?= base_url('clients/confirm_client_details/'.base64_encode($id));?>" id="create-client" method="post" novalidate>
                            <input type="hidden" name="id" value="<?php echo base64_encode($id); ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Verifier:</label>
                                            <select name="assigned_fmc_user_id" class="form-control show-tick ms select2" data-placeholder="Select Legal entity" required>
                                                <option value="">Select Verifier</option>  
                                                <?php
                                                if(!empty($fmc_users)){
                                                    foreach ($fmc_users as $key => $value) { 
                                                ?>
                                                        <option value="<?php echo $value['id']; ?>">
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
                                            <label>Note:</label>
                                            <textarea class="form-control" name="note"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="float-right">
                                            <a href="<?= site_url(); ?>clients/create_company_documents/<?php echo base64_encode($id); ?>">
                                                <button type="button" name="previous" class="btn btn-default">Previous</button>
                                            </a>
                                            <button type="submit" name="save" class="btn btn-info">Assign</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <?php } ?>                   

                    <?php if(isset($request_details)){ ?>
                    <div class="card planned_task">
                        <div class="header">
                            <h2>Request Timeline</h2>
                        </div>
                        <div class="body">
                            <?php 
                            foreach($request_threads as $value){
                                $color = 'blue';
                                if($value['status'] == 'created'){
                                    $color = 'blue';
                                }
                                if($value['status'] == 'in_approval'){
                                    $color = 'blue';
                                }
                                if($value['status'] == 'declined'){
                                    $color = 'warning';
                                }
                                if($value['status'] == 'approved'){
                                    $color = 'green';
                                }
                            ?>
                            <div class="timeline-item animated fadeIn faster <?php echo $color; ?>">
                                <span class="date"><?php echo date('d-m-Y h:i A',strtotime($value['created_at'])); ?></span>
                                <span><?php echo $value['log_text']; ?></span>
                                <div class="msg">
                                    <p><?php echo $value['note']; ?></p>
                                </div>                                
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>    
                    <?php } ?>                   
                    <?php if($details['status'] == 'in_confirmation'){ ?>
                    <div class="card planned_task">
                        <div class="header">
                            <h2>Request Comments</h2>
                        </div>
                        <div class="body">
                            <ul class="comment-reply list-unstyled">
                                <?php foreach ($request_details['request_comments'] as $comment) {
                                ?>                                    
                                <li class="row clearfix" style="margin-left: 0px;">
                                    <div class="text-box col-md-10 col-8 p-l-0 p-r0">
                                        <h5 class="m-b-0"><?php echo $comment['comment_by']; ?></h5>
                                        <p><?php echo $comment['description']; ?></p>
                                        <ul class="list-inline">
                                            <?php foreach ($comment['documents'] as $document) { ?>
                                            <li>
                                                <a download="<?php echo $document['document_file']; ?>" href="<?= site_url(); ?>uploads/<?php echo $document['document_file']; ?>">Download</a>
                                            </li>
                                            <?php 
                                            } ?>
                                        </ul>
                                        <ul class="list-inline">
                                            <li><?php echo date('d M Y h:i A',strtotime($comment['created_at'])); ?></li>
                                        </ul>
                                    </div>                                  
                                </li>
                                <hr>
                                <?php } ?>
                            </ul> 
                            <h6>Leave a comment</h6>
                            <div class="comment-form">
                                <form class="row clearfix" action="<?= base_url('requests/create_request_comment');?>" id="create-comment-form" method="post" novalidate>
                                <input type="hidden" name="request_id" id="request_id" value="<?php echo $request_details['id']; ?>">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea required rows="4" name="description" id="description" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                                        </div>
                                    </div>  
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">    
                                            <label for="documents" class="dragndrop">
                                                <img src="<?= site_url(); ?>assets/images/upload.png" alt="" /><br />
                                                Select document & image files here<br />
                                                size : 200 x 200 px <br />
                                                PDF.DOC.DOCX.PNG.JPG.JPEG </br>
                                                <a style="cursor: pointer;" class="btn btn-sm btn-outline-primary">Browse Files</a>
                                                <input type="file" name="documents" id="documents" multiple style="display: none;">
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" col-md-12 col-sm-12">
                                        <div class="row clearfix file_manager" id="item-documents-list" style="padding-right: 15px;padding-left: 15px;">
                                        
                                        </div>                              
                                    </div>
                                    <div class=" col-md-12 col-sm-12">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>   
                        </div>
                    </div>
                    <?php } ?>                   

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

<!--moment js-->
<script src="<?= site_url(); ?>assets/js/moment.js"></script> 

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

<script type="text/javascript">
    $(function() {      
        $('#request-details-form').parsley();        
        var form_instance = $('#create-comment-form').parsley();        
    }); 
</script>

<script type="text/javascript">
    
    var fileList = [];
    var fileInput = document.querySelector('input[name="documents"]');

    fileInput.addEventListener('change', setList);
    document.querySelector('#create-comment-form').addEventListener('submit', sendModifiesList);
    
    function setList() {
        //Convert the FileList Object to an Array of File Objects
        fileList = fileList.concat(Array.from(fileInput.files));

        outputList();
    }

    function outputList() {
        var output = document.getElementById('item-documents-list');        
        
        var file_list_doc = "";

        fileList.forEach((file, i) => {
            
            var file_type_icon = getFontAwesomeIconFromMIME(file.type);
            var lastModified = moment(file.lastModified).format('MMM D , YYYY');

            file_list_doc += '<div class="col-lg-3 col-md-4 col-sm-12">';
                file_list_doc += '<div class="card">';
                    file_list_doc += '<div class="file">';
                        file_list_doc += '<a href="javascript:void(0);">';
                            file_list_doc += '<div class="hover">';
                                file_list_doc += '<button onclick="remove_file('+i+')" type="button" class="btn btn-icon btn-danger">';
                                    file_list_doc += '<i class="fa fa-trash"></i>';
                                file_list_doc += '</button>';
                            file_list_doc += '</div>';
                            file_list_doc += '<div class="icon">';
                                file_list_doc += '<i class="fa '+file_type_icon+'"></i>';
                            file_list_doc += '</div>';
                            file_list_doc += '<div class="file-name">';
                                file_list_doc += '<p class="m-b-5 text-muted">'+file.name+'</p>';
                                file_list_doc += '<small>Size: '+file.size+'KB <span class="date text-muted">'+lastModified+'</span></small>';
                            file_list_doc += '</div>';

                        file_list_doc += '</a>';
                    file_list_doc += '</div>';
                file_list_doc += '</div>';
            file_list_doc += '</div>';

            
        });

        output.innerHTML = '';
        output.innerHTML = file_list_doc;
    }  

    function sendModifiesList(e) {
        var form_instance = $('#create-comment-form').parsley();        
        console.log(form_instance.isValid());
        if(form_instance.isValid()){        
            e.preventDefault();
            var formData = new FormData();

            fileList.forEach(function(file) {
              formData.append('documents[]', file);
            });  

            formData.append("description",$('#description').val());            
            formData.append("request_id",$('#request_id').val());            

            let url = document.forms[0].action;
            let request = new XMLHttpRequest();

            request.open("POST", url);

            //response
            request.onload = function() {
                window.location.href = "<?= site_url('clients/confirm_client_details/'.base64_encode($id)); ?>";
            };

            request.send(formData);
        }else{
            return false;
        }
    }

    function remove_file(i){
        fileList.splice(i, 1);
        outputList();
    }
</script>