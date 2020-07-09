<div id="wrapper">

    <?php include("inc/company_employee_navbar.php") ?>    
    <?php include("inc/company_employee_sidebar.php") ?>
 
    <style type="text/css">
    .dropdown-menu{
        z-index: 9999!important;
    }    
    </style>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="<?= site_url(); ?>calender" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo  EVENTS_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                            <li class="breadcrumb-item active"><?php echo  EVENTS_CREATE; ?></li>
                        </ul>
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                                             
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <form id="add_new_event_form" method="post" action="<?= base_url('employee_calendar/create_event');?>" novalidate>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-3 col-md-6">
                                        <label><?php echo  EVENTS_START_DATE; ?></label>
                                         <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="event_start_date" placeholder="<?php echo  EVENTS_START_DATE; ?>" autocomplete="off" required readonly>
                                        
                                    </div>   
                                    <!-- <div class="form-group col-lg-3 col-md-6">
                                        <label><?php echo  EVENTS_START_TIME; ?></label>
                                        <div class="input-group mb-3 bootstrap-timepicker timepicker">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bootstrap-timepicker timepicker"><i class="icon-clock"></i></span>
                                            </div>
                                            <input type="text" class="form-control time24 fmc-timepicker" placeholder="<?php echo  EVENTS_START_TIME; ?>">
                                        </div>
                                    </div>  -->
                                    <div class="form-group col-lg-3 col-md-6">
                                         <div class="form-group">
                                             <label><?php echo  EVENTS_START_TIME; ?></label>
                                             <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="icon-clock"></i></span>
                                                </div>
                                                <input type="text" name="event_start_time" class="form-control time12" required placeholder="<?php echo  EVENTS_START_TIME; ?>">
                                             </div>
                                         </div>
                                    </div>
                                </div>   
                                <div class="row clearfix">
                                    <div class="form-group col-lg-3 col-md-6">
                                        <label><?php echo  EVENTS_END_DATE; ?></label>
                                         <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="event_end_date" placeholder="<?php echo  EVENTS_END_DATE; ?>" required autocomplete="off" readonly>
                                         
                                    </div>   
                                    <div class="form-group col-lg-3 col-md-6">
                                         <div class="form-group">
                                             <label><?php echo  EVENTS_END_TIME; ?></label>
                                             <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="icon-clock"></i></span>
                                                </div>
                                                <input type="text" name="event_end_time" class="form-control time12" required placeholder="<?php echo  EVENTS_END_TIME; ?>">
                                             </div>
                                         </div>
                                    </div>
                                </div>   
                                <div class="row clearfix">
                                    <div class="form-group col-lg-06 col-md-6">
                                        <label><?php echo  EVENTS_TITLES; ?></label>
                                        <input type="text" class="form-control" name="event_title" placeholder="<?php echo  EVENTS_TITLES; ?>" required>
                                    </div>

                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo  EVENTS_ATTACH_EVENT_DOC; ?></label>
                                        <input type="file" class="form-control" name="document_file" placeholder="<?php echo  EVENTS_ATTACH_EVENT_DOC; ?>">
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <textarea id="ckeditor" name="discriptions">
                                            
                                            
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div id="tblFruits" class="form-group col-lg-12 col-md-6">
                                        <label >Event Color</label>
                                        <div class="fancy-checkbox">
                                            <label><input name="event_color" style="background-color: #17a2b8 !important;" value="bg-info" checked type="checkbox"><span>Cyan</span></label>
                                        </div>
                                        <div class="fancy-checkbox">
                                            <label><input name="event_color" value="bg-danger" type="checkbox"><span>Red</span></label>
                                        </div>
                                        <div class="fancy-checkbox">
                                            <label><input name="event_color" value="bg-dark" type="checkbox"><span>Black</span></label>
                                        </div>
                                        <div class="fancy-checkbox">
                                            <label><input name="event_color" value="bg-success" type="checkbox"><span>Green</span></label>
                                        </div>
                                        <div class="fancy-checkbox">
                                            <label><input name="event_color" value="bg-primary" type="checkbox"><span>Blue</span></label>
                                        </div>
                                        <div class="fancy-checkbox">
                                            <label><input name="event_color" value="bg-warning" type="checkbox"><span>Yellow</span></label>
                                        </div>
                                        
                                        <!-- <ul class="skin list-unstyled">
                                            <li data-theme="purple" class="">
                                                <div class="purple"></div>
                                                <span>Purple</span>
                                            </li>
                                        </ul>
                                        <ul class="skin list-unstyled">
                                            <li data-theme="blue" class="">
                                                <div class="blue"></div>
                                                <span>Blue</span>
                                            </li>
                                        </ul>
                                        <ul class="skin list-unstyled">
                                            <li data-theme="cyan" class="">
                                                <div class="cyan"></div>
                                                <span>Cyan</span>
                                            </li>
                                        </ul>
                                        <ul class="skin list-unstyled">
                                            <li data-theme="green" class="">
                                                <div class="green"></div>
                                                <span>Green</span>
                                            </li>
                                        </ul>
                                        <ul class="skin list-unstyled">
                                            <li data-theme="orange" class="active">
                                                <div class="orange"></div>
                                                <span>Orange</span>
                                            </li>
                                        </ul>
                                        <ul class="skin list-unstyled">
                                            <li data-theme="blush" class="">
                                                <div class="blush"></div>
                                                <span>Blush</span>
                                            </li>
                                        </ul> -->
                                        
                                        
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-success"><?php echo  EVENTS_CREATE; ?></button>
                                <a href="<?= site_url(); ?>calender"><button type="button" class="btn btn-danger"><?php echo  EVENTS_CANCEL; ?></button></a>
                            </form>                           
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>


<!-- Javascript -->
<script src="<?= site_url(); ?>assets/bundles/libscripts.bundle.js"></script>
<script src="<?= site_url(); ?>assets/bundles/vendorscripts.bundle.js"></script>

<script src="<?= site_url(); ?>assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="<?= site_url(); ?>assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js"></script> 

<script src="<?= site_url(); ?>assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/multi-select/js/jquery.multi-select.js"></script>

<script src="<?= site_url(); ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="<?= site_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<script src="<?= site_url(); ?>assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

<script src="<?= site_url(); ?>assets/vendor/nouislider/nouislider.js"></script>
<script src="<?= site_url(); ?>assets/vendor/select2/select2.min.js"></script>

<script src="<?= site_url(); ?>assets/vendor/ckeditor/ckeditor.js"></script> <!-- Ckeditor --> 

<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- Form Validation -->
<script src="<?= site_url(); ?>assets/vendor/parsleyjs/js/parsley.min.js"></script>

<!-- Date-Picker Time-Picker -->
<script src="<?= site_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

   <script type="text/javascript">
    $(function () {
        $('#add_new_event_form').parsley();        

        $('.time12').inputmask('hh:mm t', { placeholder: '__:__ _m', alias: 'time12', hourFormat: '12' });
    });
</script>
<script type="text/javascript">

    $(function () {
        //CKEditor
        CKEDITOR.replace('ckeditor');
        CKEDITOR.config.height = 300;      
    });
</script>
<script type="text/javascript">
    window.onload = function () {
        var tblFruits = document.getElementById("tblFruits");
        var chks = tblFruits.getElementsByTagName("INPUT");
        for (var i = 0; i < chks.length; i++) {
            chks[i].onclick = function () {
                for (var i = 0; i < chks.length; i++) {
                    if (chks[i] != this && this.checked) {
                        chks[i].checked = false;
                    }
                }
            };
        }
    };
</script>