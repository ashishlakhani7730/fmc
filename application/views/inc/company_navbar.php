<?php
    $CI =& get_instance();
    $CI->load->model('clients_model');
    $clients_array = $CI->clients_model->get_clients_for_drodown();  
    
    $fmc_language = get_cookie('fmc_language')?get_cookie('fmc_language'):"english";    
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
                            $fmc_client_login_id = "";

                            if(($this->session->userdata['fmc_client_login']['is_client_login'] && $this->session->userdata['fmc_client_login']['client_id']))
                            {
                                $fmc_client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);
                            }

                            $client_login_url = site_url('dashboard/start_client_login'); 
                            $redirect_url = site_url('dashboard'); 
                        ?>
                        <select style="width: 200px;" name="current_client" id="current_client" class="form-control show-tick ms select2" data-placeholder="Select Legal entity" onchange="start_client_login(this,'<?php echo $client_login_url; ?>','<?php echo $redirect_url; ?>');">
                            <option value=""><?php echo COMPANY_NAVBAR_START_CLIENT_LOGIN; ?></option>
                            <?php 
                            foreach ($clients_array as $key => $value){ 
                                $selected = "";
                                if($fmc_client_login_id == $value['id']){
                                    $selected = "selected";
                                }
                            ?>
                                <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['company_name_english']; ?></option>
                            <?php 
                            } 
                            ?>
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
                    <li><a href="<?= site_url(); ?>calender" class="icon-menu  d-sm-block d-md-none d-lg-block"><i class="icon-calendar"></i> <span class="hidden-sm hidden-xs"><?php echo COMPANY_NAVBAR_CALENDAR; ?></span></a></li>
                   
                    <li  class="hidden-sm hidden-xs">|</li>
                    <li><a href="<?= site_url(); ?>dashboard/logout" class="icon-menu"><i class="icon-login"></i> <span class="hidden-sm hidden-xs"><?php echo COMPANY_NAVBAR_LOGOUT; ?></span></a></li>
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