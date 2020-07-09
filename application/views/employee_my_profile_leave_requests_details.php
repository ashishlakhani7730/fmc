<div id="wrapper">
    <?php include("inc/company_employee_navbar.php") ?>
    
    <?php include("inc/company_employee_sidebar.php") ?>
    
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
                            <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Leave Request Details</h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="<?= site_url(); ?>leave-requests">Leave Requests</a></li>   
                                <li class="breadcrumb-item active">Details</li>
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
                                <h2>Leave Request Details</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <small class="text-muted">Title</small>
                                        <p><?php echo $details['title'] ?></p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <small class="text-muted">Leave-Type</small>
                                        <p><?php echo $details['leave_type_name']; ?></p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <small class="text-muted">From Date</small>
                                        <p><?php echo date('d-m-Y',strtotime($details['from_date'])); ?></p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <small class="text-muted">To Date</small>
                                        <p><?php echo date('d-m-Y',strtotime($details['to_date'])); ?></p>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <small class="text-muted">Description</small>
                                        <p><?php echo $details['description'] ?></p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <small class="text-muted"><?php echo REQUESTS_LEAVE_ENTRY_VISA_REAUIRED; ?></small>
                                        <p><?php echo strtoupper($details['is_entry_visa_required']); ?></p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <small class="text-muted"><?php echo REQUESTS_LEAVE_EXIT_VISA_REAUIRED; ?></small>
                                        <p><?php echo strtoupper($details['is_exit_visa_required']); ?></p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <small class="text-muted"><?php echo REQUESTS_LEAVE_TRAVEL_TICKET; ?></small>
                                        <p><?php echo strtoupper($details['is_travel_ticket_required']); ?></p>
                                    </div>
                                </div>
                                                              
                                
                                <?php if(!empty($details['document_file'])){ ?>
                                <div class="row file_manager">
                                    <div class="col-lg-3 col-md-12 col-sm-6">
                                        <div class="card">
                                            <div class="file">
                                                <a href="javascript:void(0);">
                                                    <?php 
                                                    $pathinfo = pathinfo(site_url().'uploads/'.$details['document_file']);
                                                    $file_icon = get_file_icon($pathinfo['extension']);
                                                    ?>
                                                    <div class="icon">
                                                        <i class="fa <?php echo $file_icon; ?> text-info"></i>
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted"><a download="<?php echo $details['document_file']; ?>" href="<?= site_url(); ?>uploads/<?php echo $details['document_file']; ?>">Download</a></p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="body">
                                <?php 
                                foreach($details['request_threads'] as $value){
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
                                    <span class="date"><?php echo date('d-m-Y',strtotime($value['created_at'])); ?></span>
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

                <div class="row clearfix file_manager">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>Comments</h2>
                            </div>
                            <div class="body">
                                <ul class="comment-reply list-unstyled">
                                    <?php foreach ($details['request_comments'] as $comment) {
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
                                                <li><?php echo date('d M Y',strtotime($comment['created_at'])); ?></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <hr>
                                    <?php } ?>
                                </ul> 
                                <h6>Leave a comment</h6>
                                <div class="comment-form">
                                    <form class="row clearfix" action="<?= base_url('myprofile_requests/create_request_comment');?>" id="create-comment-form" method="post" novalidate>
                                    <input type="hidden" name="request_id" id="request_id" value="<?php echo $details['request_details']['id']; ?>">
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

                <br>
                <br>
            
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
    $(function(){
        var form_instance = $('#create-comment-form').parsley();
    });
</script>
<script type="text/javascript">
    
    var fileList = [];
    var fileInput = document.querySelector('input[name="documents"]');

    fileInput.addEventListener('change', setList);
    document.querySelector('form').addEventListener('submit', sendModifiesList);
    
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
                window.location.href = "<?= site_url('leave-request/details/'.base64_encode($details['id'])); ?>";
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