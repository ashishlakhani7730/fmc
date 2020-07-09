<?php
    $CI =& get_instance();
    $CI->load->model('clients_model');
    $CI->load->model('notifications_model');

    $clients_array = $CI->clients_model->get_clients_for_drodown();  
    
    $fmc_language = get_cookie('fmc_language')?get_cookie('fmc_language'):"english";    
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
                        <?php 
                            $client_login_url = site_url('dashboard/start_client_login'); 
                            $redirect_url = site_url('dashboard'); 
                        ?>
                        <select style="width: 200px;" name="current_client" id="current_client" class="form-control show-tick ms select2" data-placeholder="Select Legal entity" onchange="start_client_login(this,'<?php echo $client_login_url; ?>','<?php echo $redirect_url; ?>');">
                            <option value=""><?php echo NAVBAR_START_CLIENT_LOGIN; ?></option>
                            <?php foreach ($clients_array as $key => $value): ?>
                                <option value="<?php echo $value['id']; ?>"><?php echo $value['company_name_english']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                        <i class="icon-equalizer"></i> 
                        <span class="hidden-sm hidden-xs"><?php echo NAVBAR_QUICK_ACCESS; ?></span></a>
                        <?php 
                        $quick_menu_top = $this->session->userdata['fmc_user_data']['quick_menu'];
                        $quick_menu_top = explode(',', $quick_menu_top);
                        if(count($quick_menu_top) > 0){
                        ?>
                        <ul class="dropdown-menu user-menu menu-icon animated bounceIn">
                            <?php 
                            foreach ($quick_menu_top as $value) { 
                                $quick_menu_link = $value;
                                $quick_menu_title = "";
                                if($quick_menu_link == 'clients/create_general_information'){
                                    $quick_menu_title = "Create New Client";
                                }elseif($quick_menu_link == 'fmcusers/create'){
                                    $quick_menu_title = "Create User";
                                }elseif($quick_menu_link == 'dashboard'){
                                    $quick_menu_title = "Dashboard";
                                }elseif($quick_menu_link == 'requests'){
                                    $quick_menu_title = "Request";
                                }elseif($quick_menu_link == 'clients'){
                                    $quick_menu_title = "Clients";
                                }
                            ?>
                            <li><a href="<?= site_url(); ?><?php echo $quick_menu_link; ?>"><span><?php echo $quick_menu_title; ?></span></a></li>    
                            <?php } ?>
                           
                        </ul>
                        <?php } ?>
                    </li>
                    
                    <li><a href="<?= site_url(); ?>fmc_calendar" class="icon-menu  d-sm-block d-md-none d-lg-block"><i class="icon-calendar"></i> <span class="hidden-sm hidden-xs"><?php echo NAVBAR_CALENDAR; ?></span></a></li>

                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                            <i class="icon-bell"></i>
                            <span class="notification-dot"></span>
                            <span class="hidden-sm hidden-xs"><?php echo NAVBAR_NORTIFICATION; ?></span>
                        </a>
                        <?php  
                        $fmc_login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);
                        $top_notifications = $CI->notifications_model->get_unread_fmc_notifications($fmc_login_user_id);

                        ?>

                        <ul class="dropdown-menu notifications animated shake">
                            <li class="header"><strong>You have <?php echo count($top_notifications); ?> new Notifications</strong></li>
                            <?php 
                            foreach ($top_notifications as $notification) { 
                                $created_at = $notification['created_at'];
                                $created_at_short = date('Y-m-d',strtotime($created_at));
                            ?>
                            <li>
                                <?php if($notification['type'] == 'client_confirmation'){ ?>
                                <a href="<?= site_url(); ?>confirm-client-request-details/<?= base64_encode($notification['request_id']);?>">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text"><strong>Client-Confirmation</strong> <?php echo ($fmc_language == 'english') ? $notification['title_en'] : $notification['title_ar']; ?></p>
                                            <?php ?>
                                            <?php if($today == $created_at_short){ ?>
                                            <span class="timestamp"><?php echo date("h:i A",strtotime($created_at)); ?> Today</span>
                                            <?php }else{ ?>
                                            <span class="timestamp"><?php echo date("d-m-Y h:i A",strtotime($created_at)); ?></span>    
                                            <?php } ?>    
                                        </div>
                                    </div>
                                </a>
                                <?php }elseif($notification['type'] == 'client_confirmation_request_update'){ ?>
                                <a href="<?= site_url(); ?>clients/view/<?= base64_encode($notification['company_id']);?>">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text"><strong>Client-Confirmation</strong> <?php echo ($fmc_language == 'english') ? $notification['title_en'] : $notification['title_ar']; ?></p>
                                            <?php ?>
                                            <?php if($today == $created_at_short){ ?>
                                            <span class="timestamp"><?php echo date("h:i A",strtotime($created_at)); ?> Today</span>
                                            <?php }else{ ?>
                                            <span class="timestamp"><?php echo date("d-m-Y h:i A",strtotime($created_at)); ?></span>    
                                            <?php } ?>    
                                        </div>
                                    </div>
                                </a>
                                <?php }elseif($notification['type'] == 'employee_confirmation'){ ?>
                                <a href="<?= site_url(); ?>requests/confirm_employee_request_details/<?= base64_encode($notification['request_id']);?>">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text"><strong>Employee-Confirmation</strong> <?php echo ($fmc_language == 'english') ? $notification['title_en'] : $notification['title_ar']; ?></p>
                                            <?php ?>
                                            <?php if($today == $created_at_short){ ?>
                                            <span class="timestamp"><?php echo date("h:i A",strtotime($created_at)); ?> Today</span>
                                            <?php }else{ ?>
                                            <span class="timestamp"><?php echo date("d-m-Y h:i A",strtotime($created_at)); ?></span>    
                                            <?php } ?>    
                                        </div>
                                    </div>
                                </a>
                                <?php }elseif($notification['type'] == 'employee_confirmation_request_update'){ ?>
                                <a href="<?= site_url(); ?>employees">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text"><strong>Employee-Confirmation</strong> <?php echo ($fmc_language == 'english') ? $notification['title_en'] : $notification['title_ar']; ?></p>
                                            <?php ?>
                                            <?php if($today == $created_at_short){ ?>
                                            <span class="timestamp"><?php echo date("h:i A",strtotime($created_at)); ?> Today</span>
                                            <?php }else{ ?>
                                            <span class="timestamp"><?php echo date("d-m-Y h:i A",strtotime($created_at)); ?></span>    
                                            <?php } ?>    
                                        </div>
                                    </div>
                                </a>
                                <?php }elseif($notification['type'] == 'payroll_confirmation'){ ?>
                                <a href="<?= site_url(); ?>confirm-company-payroll-request/<?= base64_encode($notification['request_id']);?>">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text"><strong>Payroll-Confirmation</strong> <?php echo ($fmc_language == 'english') ? $notification['title_en'] : $notification['title_ar']; ?></p>
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
                            <li class="footer"><a href="<?= site_url(); ?>notifications" class="more">See all notifications</a></li>
                        </ul>
                    </li>
                    <li  class="hidden-sm hidden-xs">|</li>
                    
                    <li>
                        <a href="<?= site_url(); ?>dashboard/logout" class="icon-menu"><i class="icon-login"></i> <span class="hidden-sm hidden-xs"><?php echo NAVBAR_LOGOUT; ?></span></a>
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

                    <li class="hidden-xs"><a href="<?= site_url(); ?>support"" class="icon-menu d-none d-sm-block"><i class="icon-bubbles"></i> <span class="hidden-sm hidden-xs"> <?php echo NAVBAR_SUPPORT; ?></span></a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>