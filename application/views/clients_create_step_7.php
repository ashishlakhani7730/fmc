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
                    <li class="breadcrumb-item"><a href="<?= site_url(); ?>clients"><?php echo CLIENTS_TITLE; ?></a></li>
                    <li class="breadcrumb-item active"><?php echo CLIENTS_BRANCH; ?></li>
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
                                    <div class="flex-container-custom">
                                        <a href="<?= site_url(); ?>clients/create_general_information/<?php echo base64_encode($id); ?>" class="flex-item-custom">1. <br /> <span><?php echo CLIENTS_GENERAL_INFO; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_contract_details/<?php echo base64_encode($id); ?>" class="flex-item-custom">2. <br /> <span><?php echo CLIENTS_CONTRACT_DETAILS; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_contact_information/<?php echo base64_encode($id); ?>" class="flex-item-custom">3. <br /> <span><?php echo CLIENTS_CONTACT_INFORMATIONS; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_property_information/<?php echo base64_encode($id); ?>" class="flex-item-custom">4. <br /> <span><?php echo CLIENTS_PROPERTY_INFORMATION; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_executive_management/<?php echo base64_encode($id); ?>" class="flex-item-custom">5. <br /> <span><?php echo CLIENTS_EXECUTIVE_MANAGEMENT; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_branch_subsidiary/<?php echo base64_encode($id); ?>" class="flex-item-custom">6. <br /> <span><?php echo CLIENTS_BRANCH_SUBSIDIARIES; ?></span></a>
                                        <a href="<?= site_url(); ?>clients/create_company_documents/<?php echo base64_encode($id); ?>" class="flex-item-custom active">7. <br /> <span><?php echo CLIENTS_COMPANY_DOCUMENTS; ?> </span></a>
                                    </div>
                                </div>
                                <div class="custom-hr"><hr /></div>
                            </div>
                        </div>
                        <form action="<?= base_url('clients/create_company_documents/'.base64_encode($id));?>" id="create-client" method="post" novalidate>
                        <input type="hidden" name="id" value="<?php echo base64_encode($id); ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-info m-b-10" data-toggle="modal" data-target="#add-new-document"><?php echo CLIENTS_ADD_DOCUMENT; ?> </button>
                                    <!-- The Modal -->
                                    <div class="modal fade" id="myModal">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?php echo CLIENTS_ADD_NEW_DOCUMENT; ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" required="" placeholder="Document title">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" required="" placeholder="Document date">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" required="" placeholder="Document expiry date">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <textarea name rows="3" placeholder="Note" class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <a href="#" class="dragndrop m-2">
                                                                    <img src="assets/images/upload.png" alt="">
                                                                    <br>
                                                                    <?php echo CLIENTS_DREG_DROP; ?>
                                                                    <br>
                                                                    <?php echo CLIENTS_OR; ?><br>
                                                                    <button type="button" class="btn btn-sm btn-outline-primary"><?php echo CLIENTS_BROWSE_FILES; ?></button>
                                                                </a>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>
                                                                       <span class="text-muted"><?php echo CLIENTS_PDF_DOC; ?><br><?php echo CLIENTS_MAX; ?></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary"><?php echo DEPARTMENTS_ADD; ?></button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo DEPARTMENTS_CLOSE; ?></button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="table-responsive">
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
                                                    $index = 1;
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
                                                    <td><?php echo $index; ?></td>
                                                    <td><?php echo $value['title']; ?></td>
                                                    <td><?php echo substr($value['note'],0,50); ?></td>
                                                    <td><?php echo $expire_date; ?></td>
                                                    <td>
                                                        <a href="<?= site_url(); ?>uploads/<?php echo $value['document_file']; ?>" target="_blank" class="btn btn-sm btn-outline-primary" download="<?php echo $value['document_file']; ?>" style="font-size:smaller;" ><i class="fa fa-download"></i></a>

                                                        <button onclick="deleteItem('<?php echo $value['id'] ?>')" type="button" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <?php 
                                                $index++;
                                                }
                                                }
                                                ?>
                                                
                                                
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="spacer"></div>
                                    <div class="float-right">
                                        
                                        <a href="<?= site_url(); ?>clients/create_branch_subsidiary/<?php echo base64_encode($id); ?>">
                                            <button type="button" name="previous" class="btn btn-default"><?php echo CLIENTS_CONTRACT_PREVIOUS; ?></button>
                                        </a>
                                        <a href="<?= site_url(); ?>clients/confirm_client_details/<?php echo base64_encode($id); ?>">
                                            <button type="button" name="skip" class="btn btn-default"><?php echo CLIENTS_NEXT; ?></button>
                                        </a>
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

<!-- Add New Document -->
<div class="modal fade" id="add-new-document">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <form class="form-auth-small" method="post" enctype="multipart/form-data" id="add-new-document-form">
            <input type="hidden" name="client_draft_id" value="<?php echo base64_encode($details['id']); ?>">
            <input type="hidden" name="client_id" value="<?php echo base64_encode($details['client_id']); ?>">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo CLIENTS_ADD_NEW_DOCUMENT; ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row" id="add-new-document-form-section">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select name="document_title_type" class="form-control show-tick ms select2" data-placeholder="Select Legal entity" required id="document_title_type">
                                    <option value="">Select Document Type</option>
                                    <?php
                                    if(!empty($required_documents)){
                                        foreach ($required_documents as $key => $value) { 
                                    ?>
                                            <option value="<?php echo $value['name']; ?>">
                                                <?php echo $value['name']; ?>
                                            </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-12" style="display: none;" id="document_title">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="<?php echo CLIENTS_DOCUMENT_TITLE; ?>" id="title" name="title">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control" name="date" id="date" placeholder="<?php echo CLIENTS_DOCUMENT_DATE; ?>" autocomplete="off" value="" readonly required>
                                    <div class="input-group-append calendar-open">
                                        <span class="input-group-text"><i class="icon-calendar"></i></span>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control" name="expire_date" id="expire_date" placeholder="Document Expiry Date" autocomplete="off" value="" readonly required>
                                    <div class="input-group-append calendar-open">
                                        <span class="input-group-text"><i class="icon-calendar"></i></span>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name="note" rows="3" placeholder="<?php echo CLIENTS_DOCUMENT_NOTE; ?>" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <label for="document">
                                <input type="file" class="dropify" name="document" id="document" required>
                            </label>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>
                                    <span class="text-muted">PDF,DOC,JPG,JPEG,PNG<br><?php echo CLIENTS_MAX; ?></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="add-new-document-progress-bar" style="display: none;">
                        <div class="col-md-12">
                            <div id="add-new-document-progress-bar-1" class="progress">
                                <div class="progress-bar" data-transitiongoal="0" aria-valuenow="0" style="width: 0%;">0%</div>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><?php echo DEPARTMENTS_ADD; ?></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo DEPARTMENTS_CLOSE; ?></button>
            </div>
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

<!-- Toaster --> 
<script src="<?= site_url(); ?>assets/vendor/toastr/toastr.js"></script> 

<!-- SweetAlert For Dialog Box --> 
<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script> 

<!-- Form Validation -->
<script src="<?= site_url(); ?>assets/vendor/parsleyjs/js/parsley.min.js"></script>

<!-- Date-Picker Time-Picker -->
<script src="<?= site_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<!-- Dropify -->
<script src="<?= site_url(); ?>assets/vendor/dropify/js/dropify.min.js"></script>

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>

<!-- Progress Bar -->
<script src="<?= site_url(); ?>assets/vendor/bootstrap-progressbar/js/bootstrap-progressbar.min.js"></script>

<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
    $(function() {      
        //initialize Form Validation
        $('#add-new-document-form').parsley();

        //Drag & Drop
        $('.dropify').dropify();
        
        //Open Upload Dialog On Btn Click
        $("#document_btn").click(function(){
            $('#document').trigger('click');
        });

        // Multiselect
        $('#departments').multiselect({
            maxHeight: 300
        });

        $("#document_title_type").change(function(){
          if(this.value == "other"){
            $("#document_title").show();
            $('#add-new-document-form').parsley('addItem', '#title');
          }else{
            $("#document_title").hide();
            $('#add-new-document-form').parsley('removeItem', '#title');
          }
        });

        $('#date').datepicker({
            format: 'dd/mm/yyyy',
            autoclose : true
        }).on('changeDate', function(e) {
            var issue_date = this.value;
            issue_date = issue_date.split("/");
            issue_date = new Date(+issue_date[2], issue_date[1] - 1, +issue_date[0]);   
            $("#expire_date").val(''); //Blank Expiry Date
            $("#expire_date").datepicker('remove'); //detach
            $('#expire_date').datepicker({
                format: 'dd/mm/yyyy',
                autoclose : true,
                startDate: issue_date
            });
        });

        $("#add-new-document-form").on("submit",function(event){
            event.preventDefault();

            var form_data = new FormData(this);

            $("#add-new-document-progress-bar").show();
            $("#add-new-document-form-section").hide();
            
            $.ajax({
                url: "<?= site_url('clients/upload_document/'); ?>",
                type: 'post',
                data: form_data,
                contentType: false,
                cache: false,
                processData:false,
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();

                    xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        
                        $("#add-new-document-progress-bar-1 .progress-bar").html(percentComplete + "%");
                        $("#add-new-document-progress-bar-1 .progress-bar").css("width", percentComplete + "%");
                      }
                    }, false);
                    return xhr;
                },
                success: function (data) {
                    window.location.reload();
                },
                error: function () {

                }
            });
        });
    });
</script>


<script type="text/javascript">
    var fileInput = document.querySelector('input[id="document"]');
    fileInput.addEventListener('change', changeFile);

    function changeFile(){
        $("#document_name").html(fileInput.files[0].name);
    }

    //Open Calander On Icon Click
    $('body').on('click', '.calendar-open', function() {
        var ele = $(this).prev("input")
        $(ele).focus();
    });

    //Display Selected Image 
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $("#document_selected").show();                
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#document").change(function(){
        readURL(this);
    });

    function deleteItem(id)
    {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {
            show_page_loader();
            $.ajax({
                url: "<?= site_url('clients/delete_document/'); ?>",
                type: 'post',
                data: {'id': id,'status': 'deleted'},
                success: function (data) {
                    hide_page_loader();
                    location.reload();
                },
                error: function () {    
                    hide_page_loader();
                }
            });    
        });    
        
    }
</script>