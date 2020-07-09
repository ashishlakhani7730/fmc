<div id="wrapper">

    <?php include("inc/navbar.php") ?>

    <?php include("inc/sidebar.php") ?>
 

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo SALARY_COMPONENT; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>

                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>salarycomponents"><?php echo SALARY_COMPONENT; ?></a></li>                                                       
                            <li class="breadcrumb-item active"><?php echo SALARY_COMPONENT_UPDATE; ?></li>
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
                            <form action="<?= base_url('fmc-salary-components/update');?>" id="create-salary-component" method="post" novalidate>
                            <input type="hidden" name="id" value="<?php echo base64_encode($details['id']); ?>">
                                <div class="row clearfix">
                                    <div class="form-group  col-lg-12 col-md-6">
                                        <label><?php echo SALARY_COMPONENT_TYPE; ?></label>
                                        <br>
                                        <label class="fancy-radio">
                                            <input type="radio" name="component_type" value="earning" <?php echo ($details['component_type'] == "earning") ? 'checked' : ''; ?>>
                                            <span><i></i><?php echo SALARY_COMPONENT_EARNING; ?></span>
                                        </label>
                                        <label class="fancy-radio">
                                            <input type="radio" name="component_type" value="deduction" <?php echo ($details['component_type'] == "deduction") ? 'checked' : ''; ?>>
                                            <span><i></i><?php echo SALARY_COMPONENT_DEDUCTION; ?></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6 col-md-6">
                                        <label><?php echo SALARY_COMPONENT_NAME; ?><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" placeholder="<?php echo SALARY_COMPONENT_NAME; ?>" required value="<?php echo $details['name']; ?>">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6">
                                        <label><?php echo SALARY_COMPONENT_NAME_IN_PAYSLIP; ?><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name_in_payslip" placeholder="<?php echo SALARY_COMPONENT_NAME_IN_PAYSLIP; ?>" required value="<?php echo $details['name_in_payslip']; ?>">
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group  col-lg-12 col-md-6">
                                        <label><?php echo SALARY_COMPONENT_CALCULATION; ?></label>
                                        <br>
                                        <label class="fancy-radio">
                                            <input type="radio" name="calculation_type" value="flat_amount" <?php echo ($details['calculation_type'] == "flat_amount") ? 'checked' : ''; ?>>
                                            <span><i></i><?php echo SALARY_COMPONENT_FLATE_AMOUNT; ?></span>
                                        </label>
                                        <label class="fancy-radio">
                                            <input type="radio" name="calculation_type" value="percentage" <?php echo ($details['calculation_type'] == "percentage") ? 'checked' : ''; ?>>
                                            <span><i></i><?php echo SALARY_COMPONENT_PERCENTAGE; ?></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6 col-md-6">
                                        <label id="flatamount_div" style="<?php echo ($details['calculation_type'] == "flat_amount") ? '' : 'display: none;'; ?>"><?php echo SALARY_COMPONENT_ENTER_AMMOUNT; ?><span class="text-danger">*</span></label>
                                        <label id="percentage_div" style=""><?php echo SALARY_COMPONENT_ENTER_PER; ?><span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="value" placeholder="<?php echo ($details['calculation_type'] == "flat_amount") ? 'Enter Amount' : 'Enter Percentage'; ?>" value="<?php echo $details['value']; ?>" required>
                                    </div>
                                </div>                                
                                <br>
                                <button type="submit" class="btn btn-success"><?php echo SALARY_COMPONENT_SAVE_SALARY; ?></button>
                                <a href="<?= site_url(); ?>fmc-salary-components"><button type="button" class="btn btn-danger"><?php echo SALARY_COMPONENT_CANCEL; ?></button></a>
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
        $('#create-salary-component').parsley();

        $("#create-salary-component input[name='calculation_type']").change(function(){
            if(this.value == "flat_amount"){
                $("#flatamount_div").show();
                $("#percentage_div").hide();
                $("#create-salary-component input[name='value']").attr("placeholder","Enter Amount");
            }
            if(this.value == "percentage"){
                $("#flatamount_div").hide();
                $("#percentage_div").show();
                $("#create-salary-component input[name='value']").attr("placeholder","Enter Percentage");
            }
        });
    });
</script>