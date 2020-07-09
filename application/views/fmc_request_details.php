<div id="wrapper">
    
    <?php include("inc/navbar.php") ?>
    <?php include("inc/sidebar.php") ?>    
    
    <?php 
    
    function get_file_icon($ext) {
        $idx = $ext;

        $mimet = array( 
            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'fa-file-image-o',
            'jpe' => 'fa-file-image-o',
            'jpeg' => 'fa-file-image-o',
            'jpg' => 'fa-file-image-o',
            'gif' => 'fa-file-image-o',
            'bmp' => 'fa-file-image-o',
            'ico' => 'fa-file-image-o',
            'tiff' => 'fa-file-image-o',
            'tif' => 'fa-file-image-o',
            'svg' => 'fa-file-image-o',
            'svgz' => 'fa-file-image-o',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'fa-file-audio-o',
            'qt' => 'fa-file-video-o',
            'mov' => 'fa-file-video-o',

            // adobe
            'pdf' => 'fa-file-pdf-o',
            'psd' => 'fa-file-o',
            'ai' => 'fa-file-o',
            'eps' => 'fa-file-o',
            'ps' => 'fa-file-o',

            // ms office
            'doc' => 'fa-file-word-o',
            'xls' => 'fa-file-excel-o',
            'ppt' => 'fa-file-powerpoint-o',
            'docx' => 'fa-file-word-o',
            'xlsx' => 'fa-file-excel-o',
            'pptx' => 'fa-file-powerpoint-o',


            // open office
            'odt' => 'fa-file-word-o',
            'ods' => 'fa-file-excel-o',
        );

        if (isset( $mimet[$idx] )) {
            return $mimet[$idx];
        } else {
            return 'fa-file-o';
        }
    }
    ?>

    <div id="main-content">        
        <div class="container-fluid">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-sm-12">
                            <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Request Details</h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                                <li class="breadcrumb-item active">Request Details</li>
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
                        ?>
                        
                        <div class="card planned_task">
                            <div class="header">
                                <h2>Request Details</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <small class="text-muted">Request Type</small>
                                        <p><?php echo ucfirst($request_details['request_type']) ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <small class="text-muted">Employee Name</small>
                                        <p><?php echo $request_details['emp_fullname_english']; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <small class="text-muted">Created-At</small>
                                        <p><?php echo date('d-m-Y h:i A',strtotime($request_details['created_at'])); ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <small class="text-muted">Status</small>
                                        <p><?php echo ucfirst($request_details['status']); ?></p>
                                    </div>
                                </div>
                                                                
                            </div>
                        </div>
                        

                        <?php if($request_details['request_type'] == 'overtime'){ ?>
                        <div class="card planned_task">
                            <div class="header">
                                <h2>Overtime Request Details</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <small class="text-muted">Date</small>
                                        <p><?php echo $overtime_request_details['date'] ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <small class="text-muted">Time</small>
                                        <p><?php echo $overtime_request_details['from_time']." - ".$overtime_request_details['to_time']; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <small class="text-muted">Description</small>
                                        <p><?php echo $overtime_request_details['description'] ?></p>
                                    </div>
                                </div>
                                <?php if(!empty($overtime_request_details['document_file'])){ ?>
                                <div class="row file_manager">
                                    <div class="col-lg-3 col-md-12 col-sm-6">
                                        <div class="card">
                                            <div class="file">
                                                <a href="javascript:void(0);">
                                                    <?php 
                                                    $pathinfo = pathinfo(site_url().'uploads/'.$overtime_request_details['document_file']);
                                                    $file_icon = get_file_icon($pathinfo['extension']);
                                                    ?>
                                                    <div class="icon">
                                                        <i class="fa <?php echo $file_icon; ?> text-info"></i>
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted"><a download="<?php echo $overtime_request_details['document_file']; ?>" href="<?= site_url(); ?>uploads/<?php echo $overtime_request_details['document_file']; ?>">Download</a></p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if($request_details['request_type'] == 'leave'){ ?>
                        <div class="card planned_task">
                            <div class="header">
                                <h2>Leave Request Details</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <small class="text-muted">Title</small>
                                        <p><?php echo $leave_request_details['title'] ?></p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <small class="text-muted">Leave-Type</small>
                                        <p><?php echo $leave_request_details['leave_type_name']; ?></p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <small class="text-muted">From Date</small>
                                        <p><?php echo date('d-m-Y',strtotime($leave_request_details['from_date'])); ?></p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <small class="text-muted">To Date</small>
                                        <p><?php echo date('d-m-Y',strtotime($leave_request_details['to_date'])); ?></p>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <small class="text-muted">Description</small>
                                        <p><?php echo $leave_request_details['description'] ?></p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <small class="text-muted"><?php echo REQUESTS_LEAVE_ENTRY_VISA_REAUIRED; ?></small>
                                        <p><?php echo strtoupper($leave_request_details['is_entry_visa_required']); ?></p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <small class="text-muted"><?php echo REQUESTS_LEAVE_EXIT_VISA_REAUIRED; ?></small>
                                        <p><?php echo strtoupper($leave_request_details['is_exit_visa_required']); ?></p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <small class="text-muted"><?php echo REQUESTS_LEAVE_TRAVEL_TICKET; ?></small>
                                        <p><?php echo strtoupper($leave_request_details['is_travel_ticket_required']); ?></p>
                                    </div>
                                </div>
                                
                                <?php if(!empty($leave_details['document_file'])){ ?>
                                <div class="row file_manager">
                                    <div class="col-lg-3 col-md-12 col-sm-6">
                                        <div class="card">
                                            <div class="file">
                                                <a href="javascript:void(0);">
                                                    <?php 
                                                    $pathinfo = pathinfo(site_url().'uploads/'.$leave_details['document_file']);
                                                    $file_icon = get_file_icon($pathinfo['extension']);
                                                    ?>
                                                    <div class="icon">
                                                        <i class="fa <?php echo $file_icon; ?> text-info"></i>
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted"><a download="<?php echo $leave_details['document_file']; ?>" href="<?= site_url(); ?>uploads/<?php echo $leave_details['document_file']; ?>">Download</a></p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if($request_details['request_type'] == 'employee_education'){ ?>
                        <div class="card planned_task">
                            <div class="header">
                                <h2>Education Request Details</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <?php foreach($education_request_details as $details){ ?>
                                        <div class="col-lg-12 col-md-12">
                                            <small class="text-muted">Specialization</small>
                                            <p><?php echo $details['specialization'] ?></p>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <small class="text-muted">Institute Name</small>
                                            <p><?php echo $details['institute_name']; ?></p>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <small class="text-muted">From Year</small>
                                            <p><?php echo $details['from_year']; ?></p>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <small class="text-muted">To Year</small>
                                            <p><?php echo $details['to_year']; ?></p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if($request_details['request_type'] == 'work_experience'){ ?>
                        <div class="card planned_task">
                            <div class="header">
                                <h2>Work Experience Request Details</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <?php foreach($experience_request_details as $details){ ?>
                                        <div class="col-lg-12 col-md-12">
                                            <small class="text-muted">Position</small>
                                            <p><?php echo $details['position'] ?></p>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <small class="text-muted">Institute Name</small>
                                            <p><?php echo $details['institute_name']; ?></p>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <small class="text-muted">Employer Name</small>
                                            <p><?php echo $details['employer_name']; ?></p>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <small class="text-muted">Job Task</small>
                                            <p><?php echo $details['job_task']; ?></p>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <small class="text-muted">Address</small>
                                            <p><?php echo $details['address']; ?></p>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <small class="text-muted">Salary</small>
                                            <p><?php echo $details['total_salary']; ?></p>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <small class="text-muted">From Date</small>
                                            <p><?php echo date('d-m-Y',strtotime($details['from_date'])); ?></p>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <small class="text-muted">To Date</small>
                                            <p><?php echo date('d-m-Y',strtotime($details['to_date'])); ?></p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <?php if($request_details['request_type'] == 'business_trip'){ ?>
                        <div class="card planned_task">
                            <div class="header">
                                <h2>Business-Trip Request Details</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <small class="text-muted">Title</small>
                                        <p><?php echo $business_trip_request_details['title'] ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <small class="text-muted">From Date</small>
                                        <p><?php echo date('d-m-Y',strtotime($business_trip_request_details['from_date'])); ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <small class="text-muted">To Date</small>
                                        <p><?php echo date('d-m-Y',strtotime($business_trip_request_details['to_date'])); ?></p>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <small class="text-muted">Description</small>
                                        <p><?php echo $business_trip_request_details['description'] ?></p>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <small class="text-muted">Trip Route</small>
                                        <p><?php echo $business_trip_request_details['trip_route'] ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <small class="text-muted">Project Name</small>
                                        <p><?php echo $business_trip_request_details['project_name']; ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <small class="text-muted">Destination</small>
                                        <p><?php echo $business_trip_request_details['destination']; ?></p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <small class="text-muted"><?php echo REQUEST_BUSINESS_ACCOMODATION; ?></small>
                                        <p><?php echo strtoupper($business_trip_request_details['is_accommodation_required']); ?></p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <small class="text-muted"><?php echo REQUEST_BUSINESS_ENTRY_VISA; ?></small>
                                        <p><?php echo strtoupper($business_trip_request_details['is_entry_visa_required']); ?></p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <small class="text-muted"><?php echo REQUEST_BUSINESS_EXIT_VISA; ?></small>
                                        <p><?php echo strtoupper($business_trip_request_details['is_exit_visa_required']); ?></p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <small class="text-muted"><?php echo REQUEST_BUSINESS_TRAVEL_TICKET; ?></small>
                                        <p><?php echo strtoupper($business_trip_request_details['is_travel_ticket_required']); ?></p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <small class="text-muted"><?php echo REQUEST_BUSINESS_ON_HAND_CASH; ?></small>
                                        <p><?php echo strtoupper($business_trip_request_details['is_on_hand_cash_required']); ?></p>
                                    </div>
                                    <?php if($business_trip_request_details['is_on_hand_cash_required'] == 'yes'){ ?>
                                    <div class="col-lg-4 col-md-12">
                                        <small class="text-muted"><?php echo REQUEST_BUSINESS_ON_HAND_AMMOUNT; ?></small>
                                        <p><?php echo $business_trip_request_details['cash_amount']; ?></p>
                                    </div>
                                    <?php } ?>
                                    <div class="col-lg-4 col-md-12">
                                        <small class="text-muted"><?php echo REQUEST_BUSINESS_CAR; ?></small>
                                        <p><?php echo strtoupper($business_trip_request_details['is_car_required']); ?></p>
                                    </div>
                                </div>                                
                                
                           
                            </div>
                        </div>
                        <?php } ?>

                        <?php if($request_details['request_type'] == 'eccr'){ ?>
                        <div class="card planned_task">
                            <div class="header">
                                <h2>ECCR Request Details</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <small class="text-muted"><?php echo REQUESTS_ECCR_TYPE; ?></small>
                                        <p>
                                        <?php
                                            if($eccr_request_details['request_type'] == 'position_change'){
                                                echo "POSITION CHANGE";
                                            }
                                            if($eccr_request_details['request_type'] == 'allowances_add'){
                                                echo "ADD ALLOWANCES";
                                            }
                                            if($eccr_request_details['request_type'] == 'allowances_descrease'){
                                                echo "DESCREASE ALLOWANCES";
                                            }
                                            if($eccr_request_details['request_type'] == 'salary_increment'){
                                                echo "SALARY INCREMENT";
                                            }
                                            if($eccr_request_details['request_type'] == 'location_change'){
                                                echo "LOCATION CHANGE";
                                            }
                                            if($eccr_request_details['request_type'] == 'department_change'){
                                                echo "DEPARTMENT CHANGE";
                                            }
                                            if($eccr_request_details['request_type'] == 'temporary_relocation'){
                                                echo "TEMPORARY RELOCATION";
                                            }
                                        ?>
                                        </p>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <small class="text-muted"><?php echo REQUESTS_ECCR_TITLE; ?></small>
                                        <p><?php echo $eccr_request_details['title'] ?></p>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <small class="text-muted"><?php echo REQUESTS_ECCR_DESCRIPTION; ?></small>
                                        <p><?php echo $eccr_request_details['description'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if($request_details['request_type'] == 'general'){ ?>
                        <div class="card planned_task">
                            <div class="header">
                                <h2>General Request Details</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <small class="text-muted"><?php echo GENERAL_REQUEST_TYPE; ?></small>
                                        <p>
                                        <?php echo $general_request_details['request_type_name']; ?>
                                        </p>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <small class="text-muted"><?php echo GENERAL_REQUEST_TITLE; ?></small>
                                        <p><?php echo $general_request_details['title'] ?></p>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <small class="text-muted"><?php echo GENERAL_REQUEST_DESCRIPTION; ?></small>
                                        <p><?php echo $general_request_details['description'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="row clearfix file_manager">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>Comments</h2>
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
                    </div>
                </div>  

                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
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
                    </div>
                </div>

                <?php if($request_details['status'] == 'in_approval'){ ?>
                <form action="<?= base_url('requests/approve_decline');?>" id="request-details-form" method="post" novalidate>
                <input type="hidden" name="request_id" value="<?php echo base64_encode($request_details['id']); ?>">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label>Approve/Decline Notes</label>
                                        <textarea class="form-control" name="description" placeholder="Approve/Decline Notes" required></textarea>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-6 col-md-12">
                                        <label>Select Request Status</label>
                                        <select class="form-control show-tick ms select2" data-placeholder="Request Status" name="status" id="status" required>
                                            <option value="approved">Approved</option>
                                            <option value="declined">Declined</option>
                                            <option value="re_approval">Need Re-Approval From Company</option>
                                        </select>
                                    </div>    
                                    <div class="form-group col-lg-6 col-md-12" style="display: none;" id="select-employee">
                                        <label>Select Employee</label>
                                        <select class="form-control show-tick ms select2" data-placeholder="Select Employee" name="employee_id" id="employee_id">
                                                
                                            <option value="">Select Employee</option>
                                            <?php
                                            foreach ($employees as $key => $value) {
                                                $selected = "";
                                            ?>
                                                <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['fullname_english']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>                           
                                    </div>             
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row clearfix">
                    <div class="col-lg-7">
                        <div class="float-right">
                            <button type="submit" name="submit" value="
                            submit_btn" class="btn btn-success">Submit</button>
                            <a href="<?= site_url(); ?>dashboard"><button type="button" name="cancel" value="next_btn" class="btn btn-danger">Cancel</button></a>
                        </div>
                    </div>
                </div>
                </form>
                <?php } ?>

                <br>
                <br>
            </form>
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

<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 

<!-- Ckeditor --> 
<script src="<?= site_url(); ?>assets/vendor/ckeditor/ckeditor.js"></script> 

<!--moment js-->
<script src="<?= site_url(); ?>assets/js/moment.js"></script> 

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script>

<script type="text/javascript">
    $(function() {      
        $('#request-details-form').parsley();        
        var form_instance = $('#create-comment-form').parsley();        

        $("#status").change(function(){
            if(this.value == 're_approval'){
                $("#select-employee").show();
                $('#employee_id').attr('data-parsley-required',true);
            }else{
                $("#select-employee").hide();
                $('#employee_id').removeAttr('data-parsley-required');
            }
        });
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
                window.location.href = "<?= site_url('compnay-request-details/'.base64_encode($request_details['id'])); ?>";
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