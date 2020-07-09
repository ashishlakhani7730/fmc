<div id="wrapper">

    <?php include("inc/company_navbar.php") ?>

    <?php include("inc/company_sidebar.php") ?>
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
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Assign Assets Item</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>assets-assign">List</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ul>                        
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right"></div>
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
                    <div class="card">
                        <div class="body">
                        <form action="<?= base_url('assets_assign/update/'.base64_encode($details['id']));?>" id="update-form" method="post" novalidate>
                            <div class="row clearfix">
                                <div class="form-group col-lg-12 col-md-6">
                                    <label>Select Employee<span class="text-danger">*</span></label>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select Employee" name="employee_id" id="employee_id" required>
                                            
                                        <option value="">Select Employee</option>
                                        <?php
                                        foreach ($employees as $key => $value) {
                                            $selected = "";
                                            if($details['employee_id'] == $value['id']){
                                                $selected = "selected";
                                            }
                                        ?>
                                            <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['fullname_english']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>                                    
                                </div>                
                            </div>
                            <div class="row clearfix">
                                <div class="form-group col-lg-12 col-md-6">
                                    <label>Select Assets Item <span class="text-danger">*</span></label>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="assets_item_id" id="assets_item_id" required>
                                        <option value="">Select assets item</option>
                                        <?php
                                        foreach ($assets_item as $key => $value) {
                                            $selected = "";
                                            if($details['assets_item_id'] == $value['id']){
                                                $selected = "selected";
                                            }
                                            if(($value['status_assign'] == 'no') || $details['assets_item_id'] == $value['id']){
                                        ?>
                                            <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['item_name']; ?> / <?php echo $value['serial_number']; ?> / <?php echo $value['model']; ?> / <?php echo $value['conditions']; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>                
                            </div>
                            <div class="row clearfix">
                                <div class="form-group col-lg-12 col-md-6">
                                    <label>Select Condition <span class="text-danger">*</span></label>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="conditions" id="conditions" required>
                                        <option value=""><?php echo ASSETS_SELECT_CONDITIONS; ?></option>
                                        <option value="new" <?php echo ($details['conditions'] == 'new') ? 'selected' : ''; ?>><?php echo ASSETS_NEW; ?></option>
                                        <option value="used" <?php echo ($details['conditions'] == 'used') ? 'selected' : ''; ?>><?php echo ASSETS_USED; ?></option>
                                        <option value="partially_damaged" <?php echo ($details['conditions'] == 'partially_damaged') ? 'selected' : ''; ?>><?php echo ASSETS_PARTIALLY_DAMAGED; ?></option>
                                        <option value="fully_damaged" <?php echo ($details['conditions'] == 'fully_damaged') ? 'selected' : ''; ?>><?php echo ASSETS_FULLY_DAMAGED; ?></option>
                                    </select>                                   
                                </div>                
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Assign Date</label>
                                        <?php 
                                        $assign_date = date('d/m/Y',strtotime($details['assign_date']));
                                        ?>
                                        <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="assign_date" id="assign_date" placeholder="Assign Date" autocomplete="off"  readonly required value="<?php echo $assign_date; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="form-group col-lg-12 col-md-6">
                                    <label>Note</label>
                                    <textarea class="form-control" placeholder="Note" name="note" id="note"><?php echo $details['note']; ?></textarea>
                                </div>                
                            </div>
                            <div class="row clearfix">
                                <div class="form-group col-md-12 col-sm-12">    
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

                            <div class="row clearfix file_manager">
                            <?php 
                            if(isset($details['documents'])){
                            foreach ($details['documents'] as $key => $value) {
                                $pathinfo = pathinfo(site_url().'uploads/'.$value['document_file']);
                                $file_icon = get_file_icon($pathinfo['extension']);
                            ?>
                                <div class="col-lg-3 col-md-4 col-sm-12" id="document-<?php echo $value['id']; ?>">
                                    <div class="card">
                                        <div class="file">
                                            <a href="javascript:void(0);">
                                                <div class="hover">
                                                    <button onclick="deleteDocument(<?php echo $value['id']; ?>);" type="button" class="btn btn-icon btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa <?php echo $file_icon; ?> text-info"></i>
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted"><a download="<?php echo $value['document_file']; ?>" href="<?= site_url(); ?>uploads/<?php echo $value['document_file']; ?>"><?php echo $value['document_file']; ?></a></p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php    
                            }
                            }
                            ?>
                            </div>
                            <div class="row clearfix file_manager" id="documents-list">
                                
                            </div>
                            <br>
                            <button type="submit" class="btn btn-success">Save</button>
                            <a href="<?= site_url(); ?>assets-assign"><button type="button" class="btn btn-danger">Cancel</button></a>
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

<!-- SweetAlert For Dialog Box --> 
<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script> 

<!--moment js-->
<script src="<?= site_url(); ?>assets/js/moment.js"></script> 

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
    $(function() {      
        var form_instance = $('#create-form').parsley();        
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
        var output = document.getElementById('documents-list');        
        
        var file_list_doc = "";

        fileList.forEach((file, i) => {
            
            console.log(file.type);
            var file_type_icon = getFontAwesomeIconFromMIME(file.type);
            console.log(file_type_icon);
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
        var form_instance = $('#update-form').parsley();        
        
        if(form_instance.isValid()){        
            e.preventDefault();
            var formData = new FormData();

            fileList.forEach(function(file) {
              formData.append('documents[]', file);
            });  

            formData.append("employee_id",$('#employee_id').val());
            formData.append("assets_item_id",$('#assets_item_id').val());
            formData.append("conditions",$('#conditions').val());
            formData.append("assign_date",$('#assign_date').val());            
            formData.append("note",$('#note').val());

            let url = document.forms[0].action;
            let request = new XMLHttpRequest();

            request.open("POST", url);

            //response
            request.onload = function() {
                window.location.href = "<?= site_url('assets_assign'); ?>";
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

    function deleteDocument(id){
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true
        }, function () {
            $.ajax({
                url: "<?= site_url('assets_items/delete_document'); ?>",
                type: 'post',
                data: {'id': id},
                success: function (data) {
                    $("#document-"+id).remove();
                },
                error: function () {
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = 'toast-bottom-right';    
                    toastr['error']('something went wrong!.');                    
                }
            });            
        });
    }
</script>