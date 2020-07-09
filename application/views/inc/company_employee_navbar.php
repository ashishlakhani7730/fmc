<?php
    $fmc_language = get_cookie('fmc_language')?get_cookie('fmc_language'):"english";    

    $CI =& get_instance();
    $CI->load->model('notifications_model');
    $today = date('Y-m-d');
?>
<nav class="navbar navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-btn">
            <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
        </div>

        <div class="navbar-brand">
            <a href="<?= site_url(); ?>dashboard"><img src="<?= site_url(); ?>assets/images/mainlogo.png" alt="Lucid Logo" class="img-responsive logo"></a>
        </div>

        <div class="navbar-right">
            <!--<form id="navbar-search" class="navbar-form search-form">
                <input value="" class="form-control" placeholder="Search here..." type="text">
                <button type="button" class="btn btn-default"><i class="icon-magnifier"></i></button>
            </form>-->

            <div id="navbar-menu">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?= site_url(); ?>employee-calendar" class="icon-menu  d-sm-block d-md-none d-lg-block"><i class="icon-calendar"></i> <span class="hidden-sm hidden-xs"><?php echo COMPANY_NAVBAR_CALENDAR; ?></span></a>
                    </li>
                    <?php
                    $employee_login_user_id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);

                    $top_notifications = $CI->notifications_model->get_employee_unread_fmc_notifications($employee_login_user_id);

                    ?>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                            <i class="icon-bell"></i>
                            <span class="notification-dot"></span>
                            <span class="hidden-sm hidden-xs"><?php echo COMPANY_NAVBAR_NORTIFICATION; ?></span>
                        </a>
                        <ul class="dropdown-menu notifications animated shake">
                            <li class="header"><strong>You have <?php echo count($top_notifications); ?> new Notifications</strong></li>

                            <?php 
                            foreach ($top_notifications as $notification) { 
                                $created_at = $notification['created_at'];
                                $created_at_short = date('Y-m-d',strtotime($created_at));
                            ?>
                            <li>
                                <?php if($notification['type'] == 'overtime_request' || $notification['type'] == 'leave_request' || $notification['type'] == 'business_trip' || $notification['type'] == 'eccr' || $notification['type'] == 'general'){ ?>
                                <a href="<?= site_url(); ?>employee-request/<?= base64_encode($notification['request_id']);?>">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text"><strong>Overtime</strong> <?php echo ($fmc_language == 'english') ? $notification['title_en'] : $notification['title_ar']; ?></p>
                                            <?php ?>
                                            <?php if($today == $created_at_short){ ?>
                                            <span class="timestamp"><?php echo date("h:i A",strtotime($created_at)); ?> Today</span>
                                            <?php }else{ ?>
                                            <span class="timestamp"><?php echo date("d-m-Y h:i A",strtotime($created_at)); ?></span>    
                                            <?php } ?>    
                                        </div>
                                    </div>
                                </a>
                                <?php }elseif($notification['type'] == 'overtime_request_update'){ ?>
                                <a href="<?= site_url(); ?>overtime-request/details/<?= base64_encode($notification['record_id']);?>">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text"><strong>Overtime</strong> <?php echo ($fmc_language == 'english') ? $notification['title_en'] : $notification['title_ar']; ?></p>
                                            <?php ?>
                                            <?php if($today == $created_at_short){ ?>
                                            <span class="timestamp"><?php echo date("h:i A",strtotime($created_at)); ?> Today</span>
                                            <?php }else{ ?>
                                            <span class="timestamp"><?php echo date("d-m-Y h:i A",strtotime($created_at)); ?></span>    
                                            <?php } ?>    
                                        </div>
                                    </div>
                                </a>
                                <?php }elseif($notification['type'] == 'leave_request_update'){ ?>
                                <a href="<?= site_url(); ?>leave-request/details/<?= base64_encode($notification['record_id']);?>">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text"><strong>Overtime</strong> <?php echo ($fmc_language == 'english') ? $notification['title_en'] : $notification['title_ar']; ?></p>
                                            <?php ?>
                                            <?php if($today == $created_at_short){ ?>
                                            <span class="timestamp"><?php echo date("h:i A",strtotime($created_at)); ?> Today</span>
                                            <?php }else{ ?>
                                            <span class="timestamp"><?php echo date("d-m-Y h:i A",strtotime($created_at)); ?></span>    
                                            <?php } ?>    
                                        </div>
                                    </div>
                                </a>
                                <?php }elseif($notification['type'] == 'leave_request_update'){ ?>
                                <a href="<?= site_url(); ?>leave-request/details/<?= base64_encode($notification['record_id']);?>">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text"><strong>Overtime</strong> <?php echo ($fmc_language == 'english') ? $notification['title_en'] : $notification['title_ar']; ?></p>
                                            <?php ?>
                                            <?php if($today == $created_at_short){ ?>
                                            <span class="timestamp"><?php echo date("h:i A",strtotime($created_at)); ?> Today</span>
                                            <?php }else{ ?>
                                            <span class="timestamp"><?php echo date("d-m-Y h:i A",strtotime($created_at)); ?></span>    
                                            <?php } ?>    
                                        </div>
                                    </div>
                                </a>
                                <?php } ?>

                            </li>
                            <?php } ?>
                           
                            <li class="footer"><a href="javascript:void(0);" class="more"><?php echo COMPANY_NAVBAR_SEE_ALL; ?></a></li>
                        </ul>
                    </li>
                    <li  class="hidden-sm hidden-xs">|</li>
                    <li>
                        <a href="<?= site_url(); ?>dashboard/logout" class="icon-menu"><i class="icon-login"></i> <span class="hidden-sm hidden-xs"><?php echo COMPANY_NAVBAR_LOGOUT; ?></span></a>
                    </li>
                    <li class="hidden-xs">
                        <a style="cursor: pointer;" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                            <i class="icon-disc"></i>
                            <span  class="hidden-sm hidden-xs"><?php echo NAVBAR_LANGUAGE; ?></span>
                        </a>
                        <ul class="dropdown-menu user-menu menu-icon animated bounceIn">
                            <li>
                                <a href="<?= site_url(); ?>dashboard/change_language/english"><span>
                                <?php echo ($fmc_language == 'english') ? "<b>English</b>" : "English"; ?>
                                </span></a>
                            </li>
                            <li>
                                <a href="<?= site_url(); ?>dashboard/change_language/arabic"><span>
                                <?php echo ($fmc_language == 'arabic') ? "<b>Arabic</b>" : "Arabic"; ?></span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="hidden-xs"><a href="<?= site_url(); ?>support" class="icon-menu d-none d-sm-block"><i class="icon-bubbles"></i> <span class="hidden-sm hidden-xs"><?php echo COMPANY_NAVBAR_SUPPORT; ?></span></a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>