<div id="wrapper">

    <?php include("inc/company_navbar.php") ?>

    <?php include("inc/company_sidebar.php") ?>
    
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
                        <form action="<?= base_url('assets_assign/create');?>" id="create-form" method="post" novalidate>
                            <div class="row clearfix">
                                <div class="form-group col-lg-12 col-md-6">
                                    <label>Select Employee<span class="text-danger">*</span></label>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select Employee" name="employee_id" id="employee_id" required>
                                            
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
                            <div class="row clearfix">
                                <div class="form-group col-lg-12 col-md-6">
                                    <label>Select Assets Item <span class="text-danger">*</span></label>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="assets_item_id" id="assets_item_id" required>
                                        <option value="">Select assets item</option>
                                        <?php
                                        foreach ($assets_item as $key => $value) {
                                            $selected = "";
                                            if($value['status_assign'] == 'no'){
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
                                        <option value="">Select condition</option>
                                        <option value="new">New</option>
                                        <option value="used">Used</option>
                                        <option value="partially_damaged">Partially Damaged</option>
                                        <option value="fully_damaged">Fully Damaged</option>
                                    </select>                                   
                                </div>                
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Assign Date</label>
                                        <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="assign_date" id="assign_date" placeholder="Assign Date" autocomplete="off"  readonly required>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="form-group col-lg-12 col-md-6">
                                    <label>Note</label>
                                    <textarea class="form-control" placeholder="Note" name="note" id="note"></textarea>
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
                            <div class="row clearfix file_manager" id="documents-list">
                                
                            </div>
                            <br>
                            <button type="submit" class="btn btn-success">Create</button>
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
        var form_instance = $('#create-form').parsley();        
        
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
</script>