<div id="wrapper">

    <?php include("inc/navbar.php") ?>

    <?php include("inc/sidebar.php") ?>
 

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo DEPARTMENT_DIVISION; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>                                                       
                            <li class="breadcrumb-item active"><?php echo DEPARTMENT_UPDATE_DIVISION; ?></li>
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
                            <form id="create-division" method="post" novalidate>
                                <input type="hidden" name="id" value="<?php echo base64_encode($details['id']); ?>">
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo DEPARTMENTS_TITLE; ?></label>
                                        <select name="department_id" class="form-control show-tick ms select2" data-placeholder="Select" required>
                                            <option value=""><?php echo DEPARTMENT_SELECT_DEPARTMENT; ?></option>
                                            <?php
                                            if(!empty($departments)){
                                                foreach ($departments as $key => $value) { 
                                                    $selected = "";
                                                    if(!empty($details) && $details['department_id'] == $value['id']){
                                                        $selected = "selected";
                                                    }
                                            ?>                                                
                                                    <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['department_name']; ?></option>
                                                <?php 
                                                }
                                            } 
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <label><?php echo DEPARTMENT_DIVISION_NAME; ?></label>
                                        <input type="text" class="form-control" name="module_name" placeholder="<?php echo DEPARTMENT_DIVISION_NAME; ?>" value="<?php echo $details['module_name']; ?>" required>
                                    </div>
                                </div>
                                
                                
                                <br>
                                <button type="submit" class="btn btn-success"><?php echo DEPARTMENT_SAVE_DIVISION; ?></button>
                                <a href="<?= site_url(); ?>departments"><button type="button" class="btn btn-danger"><?php echo FMC_CANCEL; ?></button></a>
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

<!-- Form Validation -->
<script src="<?= site_url(); ?>assets/vendor/parsleyjs/js/parsley.min.js"></script>

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
    $(function() {      
        //initialize Form Validation
        $('#create-division').parsley();
    });
</script>