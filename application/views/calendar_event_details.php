<div id="wrapper">

    <?php include("inc/navbar.php") ?>

    <?php include("inc/sidebar.php") ?>    
 
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> <?php echo  EVENTS_DETAIL_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>calender"><?php echo EVENTS_DETAIL_FMC_CALENDAR; ?></a></li>                                                       
                            <li class="breadcrumb-item active"><?php echo EVENTS_DETAIL_SUB_TITLE; ?></li>
                        </ul>
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                                             
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body card-panel-body" id="general_information_body">
                            <div class="row">
                                <div class="col-md-12">
                                    <small class="text-muted"><?php echo EVENTS_DETAIL_TITLES; ?> </small>
                                    <p><?php echo $details['event_title']; ?></p>
                                </div>
                            </div>
                            <hr>  
                            <div class="row">
                                <div class="col-md-4">
                                    <small class="text-muted"><?php echo EVENTS_DETAIL_START_DATE; ?> </small>
                                    <p><?php echo date('d/m/Y',strtotime($details['event_start_date'])); ?></p>
                                </div>
                                <div class="col-md-4">
                                    <small class="text-muted"><?php echo EVENTS_DETAIL_START_TIME; ?></small>
                                    <p><?php echo $details['event_start_time']; ?></p>
                                </div>
                            </div>
                            <hr>  
                            <div class="row">
                                <div class="col-md-4">
                                    <small class="text-muted"><?php echo EVENTS_DETAIL_END_DATE; ?> </small>
                                    <p><?php echo date('d/m/Y',strtotime($details['event_end_date'])); ?></p>
                                </div>
                                <div class="col-md-4">
                                    <small class="text-muted"><?php echo EVENTS_DETAIL_END_TIME; ?></small>
                                    <p><?php echo $details['event_end_time']; ?></p>
                                </div>
                            </div>
                            <hr>  
                            <div class="row">
                                <div class="col-md-4">
                                    <small class="text-muted"><?php echo EVENTS_DETAIL_COLOR; ?> </small>
                                    <div id="tblFruits" style="margin-top: 3px;">
                                        <?php if($details['event_color'] == 'bg-info'){ ?>
                                        <div class="fancy-checkbox">
                                            <label><input name="event_color" style="background-color: #17a2b8 !important;" value="bg-info" disabled checked type="checkbox"><span>Cyan</span></label>
                                        </div>
                                        <?php } ?>
                                        <?php if($details['event_color'] == 'bg-danger'){ ?>
                                        <div class="fancy-checkbox">
                                            <label><input name="event_color" disabled checked value="bg-danger" type="checkbox"><span>Red</span></label>
                                        </div>
                                        <?php } ?>
                                        <?php if($details['event_color'] == 'bg-dark'){ ?>
                                        <div class="fancy-checkbox">
                                            <label><input name="event_color" disabled checked value="bg-dark" type="checkbox"><span>Black</span></label>
                                        </div>
                                        <?php } ?>
                                        <?php if($details['event_color'] == 'bg-success'){ ?>
                                        <div class="fancy-checkbox">
                                            <label><input name="event_color" disabled checked value="bg-success" type="checkbox"><span>Green</span></label>
                                        </div>
                                        <?php } ?>
                                        <?php if($details['event_color'] == 'bg-primary'){ ?>
                                        <div class="fancy-checkbox">
                                            <label><input name="event_color" disabled checked value="bg-primary" type="checkbox"><span>Blue</span></label>
                                        </div>
                                        <?php } ?>
                                        <?php if($details['event_color'] == 'bg-warning'){ ?>
                                        <div class="fancy-checkbox">
                                            <label><input name="event_color" disabled checked value="bg-warning" type="checkbox"><span>Yellow</span></label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>                            
                            
                            <?php if(!empty($details['document_file']) && file_exists("uploads/".$details['document_file'])){ ?>
                            <hr>  
                            <div class="row">
                                <div class="col-md-12">
                                    <small class="text-muted"><?php echo EVENTS_DETAIL_ATTACH_EVENT_DOC; ?> </small>
                                    <p><a target="_blank" href="<?= site_url(); ?>/uploads/<?php echo $details['document_file']; ?>" alt="" width="50" height="50"><?php echo EVENTS_DETAIL_CLICK_HERE_TO_DOWNLOAD; ?></a></p>
                                </div>
                            </div>
                            <?php } ?>
                            <hr>  
                            <div class="row">
                                <div class="col-md-12">
                                    <small class="text-muted"><?php echo EVENTS_DETAIL_DESCRIPTION; ?></small>
                                    <div class="testimonial4">
                                        <div class="active item">
                                            <blockquote class="primary"><p><?php echo $details['discriptions'] ?></p></blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>                                                  
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
        $('.time12').inputmask('hh:mm t', { placeholder: '__:__ _m', alias: 'time12', hourFormat: '12' });
    });
</script>
<script type="text/javascript">

    $(function () {
        //initialize Form Validation
        $('#add_new_event_form').parsley();

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