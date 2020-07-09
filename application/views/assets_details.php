<div id="wrapper">

    <?php include("inc/company_employee_navbar.php") ?>

    <?php include("inc/company_employee_sidebar.php") ?>
 

    <div id="main-content" class="profilepage_1">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> <?php echo ASSETS_DETAILS ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo site_url() ?>"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active"><?php echo ASSETS_DETAILS ?></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="timeline-item animated fadeIn slower warning">
                                <span class="date">Assign Date : <?php echo $assets_details['assign_date'] ?></span>
                                <h5><?php echo $assets_details['item_name'] ?> (<?php echo $assets_details['conditions'] ?>)</h5>
                                <span><a href="javascript:void(0);" title=""><?php echo $assets_details['emp_fullname_english'].' '.$assets_details['emp_fullname_arabic'] ?></a> </span>
                                <div class="msg">
                                    <p><?php echo $assets_details['note'] ?></p>
                                    <div class="timeline_img m-b-20">
                                        <?php if(!empty($assets_details['assets_item_assign_document'])){
                                            foreach($assets_details['assets_item_assign_document'] as $document){ ?>
                                                <img class="" style="width: 10%" src="<?php echo site_url() ?>/uploads/<?php echo $document['document_file'] ?>" alt="Asset Assign Image">
                                            <?php }
                                        } ?>
                                    </div>
                                </div>
                            </div>
                            <?php if($assets_details['is_return'] == 'yes'){ ?>
                                <div class="timeline-item animated fadeIn slower warning">
                                    <span class="date">Return Date : <?php echo $assets_details['return_date'] ?></span>
                                    <h5><?php echo $assets_details['item_name'] ?> (<?php echo $assets_details['return_conditions'] ?>)</h5>
                                    <span><a href="javascript:void(0);" title=""><?php echo $assets_details['emp_fullname_english'].' '.$assets_details['emp_fullname_arabic'] ?></a> </span>
                                    <div class="msg">
                                        <p><?php echo $assets_details['note'] ?></p>
                                        <div class="timeline_img m-b-20">
                                            <?php if(!empty($assets_details['assets_item_return_document'])){
                                                foreach($assets_details['assets_item_return_document'] as $document){ ?>
                                                    <img class="" style="width: 10%" src="<?php echo site_url() ?>/uploads/<?php echo $document['document_file'] ?>" alt="Asset Return Image">
                                                <?php }
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
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


<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 



