<div id="left-sidebar" class="sidebar">
    <div class="sidebar-scroll">
        <div class="user-account">
            <?php 

                if(!empty($this->session->userdata['fmc_user_data']['profile_picture'])){
                    $profile_pic = "uploads/".$this->session->userdata['fmc_user_data']['profile_picture'];
                }else{
                    $profile_pic = "assets/profiles/user_default.png";
                }
            ?>
            <img src="<?= site_url(); ?><?php echo $profile_pic; ?>" class="rounded-circle user-photo" alt="User Profile Picture">
            <div class="dropdown">
                <span><?php echo SIDEBAR_PROFILE_TITLE; ?>,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown">
                    <strong><?php echo $this->session->userdata['fmc_user_data']['first_name']." ".$this->session->userdata['fmc_user_data']['last_name']; ?></strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-right account animated flipInY">
                    <li><a href="<?= site_url(); ?>fmcusers/myprofile"><i class="icon-user"></i><?php echo  SIDEBAR_MY_PROFILE; ?></a></li>
                    <li class="divider"></li>
                    <li><a href="<?= site_url(); ?>dashboard/logout"><i class="icon-power"></i><?php echo  SIDEBAR_LOGOUT; ?></a></li>
                </ul>              
            </div>
            <?php 
            if(isset($this->session->userdata['fmc_client_login'])){
            ?>
            <hr>
            <div class="row">
                <div class="col-6">
                    <h6><?php echo $this->session->userdata['fmc_client_login']['company_name_english'];  ?></h6>
                    <small><?php echo  SIDEBAR_CLIENT_LOGIN; ?></small>
                </div>
                <div class="col-6">
                    <a href="<?= site_url(); ?>dashboard/client_logout" class="badge badge-primary"><?php echo  SIDEBAR_CLIENT_LOGOUT; ?></a>
                </div>
            </div>
            <?php } ?>
        </div>
        
        <ul class="nav nav-tabs"></ul>

        <!-- Tab panes -->
        <div class="tab-content p-l-0 p-r-0">
            <div class="tab-pane animated fadeIn active" id="hr_menu">
                <nav class="sidebar-nav">
                    <ul class="main-menu metismenu">
                        <?php 
                            $controller = $this->router->fetch_class();
                            $method = $this->router->fetch_method();
                        ?>

                        <?php if(isset($this->session->userdata['fmc_user_data'])){ ?>


                                <li class="<?php echo ($controller == 'dashboard') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>dashboard"><i class="icon-speedometer"></i><span><?php echo  SIDEBAR_DASHBOARD; ?></span></a></li>
                                <li class="<?php echo ($controller == 'departments' && $method == 'index') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>departments"><i class="icon-list"></i><span><?php echo  SIDEBAR_DEPARTMENTS; ?></span></a>
                                    <!-- <ul>
                                        <li class="<?php echo ($controller == 'departments' && $method == 'index') ? 'active' : ''; ?>""><a href="<?= site_url(); ?>departments"><?php echo  SIDEBAR_DEPARTMENTS; ?></a></li>
                                        <li class="<?php echo ($controller == 'division' && $method == 'index') ? 'active' : ''; ?>""><a href="<?= site_url(); ?>division"><?php echo  SIDEBAR_DIVISION; ?></a></li> 
                                    </ul> -->
                                </li>
                                <li class="<?php echo ($controller == 'fmcusers') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>fmcusers"><i class="icon-users"></i><span><?php echo  SIDEBAR_FMC_USERS; ?></span></a></li>

                                <li class="<?php echo ($controller == 'clients') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>clients"><i class="icon-list"></i><span><?php echo  SIDEBAR_CLIENTS; ?></span></a></li>

                                <li class="<?php echo ($controller == 'requests') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>requests"><i class="icon-list"></i><span>Requests</span></a></li>

                                <li class="<?php echo ($controller == 'notifications') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>notifications"><i class="icon-bell"></i><span>Notifications</span></a></li>

                                <li class="<?php echo ($controller == 'document_categories' || $controller == 'company_structure_type' || $controller == 'legal_entities' || $controller == 'countries' || $controller == 'regions' || $controller == 'cities' || $controller == 'main_activities') || $controller == 'warning_categories' ? 'active' : ''; ?>">
                                    <a href="#clients" class="has-arrow"><i class="icon-settings"></i><span><?php echo  SIDEBAR_SETTINGS; ?></span></a>
                                    <ul>
                                        <li class="<?php echo ($controller == 'document_categories' && $method == 'index') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>document_categories"><?php echo  SIDEBAR_DOCUMENT_CATEGORY; ?></a></li>
                                        <li class="<?php echo ($controller == 'company_structure_type' && $method == 'index') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>company_structure_type"><?php echo  SIDEBAR_COMPANY_STRUCTURE_TYPE; ?></a></li>
                                        <li class="<?php echo ($controller == 'legal_entities' && $method == 'index') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>legal_entities"><?php echo  SIDEBAR_LEGAL_ENTITIES; ?></a></li>
                                        <li class="<?php echo ($controller == 'countries' && $method == 'index') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>countries"><?php echo  SIDEBAR_COUNTRIES; ?></a></li>
                                        <li class="<?php echo ($controller == 'regions' && $method == 'index') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>regions"><?php echo  SIDEBAR_REGIONS; ?></a></li>
                                        <li class="<?php echo ($controller == 'cities' && $method == 'index') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>cities"><?php echo  SIDEBAR_CITY; ?></a></li>
                                        <li class="<?php echo ($controller == 'main_activities' && $method == 'index') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>main_activities"><?php echo  SIDEBAR_MAIN_ACTIVITIES; ?></a></li>
                                        <li class="<?php echo ($controller == 'client_document_types' && $method == 'index') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>client-required-documents"><?php echo  SIDEBAR_CLIENT_REQUIRED_DOCUMENTS; ?></a></li>
                                        <li class="<?php echo ($controller == 'fmc_Salarycomponents' && $method == 'index') ? 'active' : ''; ?>">
                                            <a href="<?= site_url(); ?>fmc-salary-components"><?php echo  SIDEBAR_FMC_SALARY_COMPONENT; ?></a>
                                        </li>
                                        <li class="<?php echo ($controller == 'fmc_leave_management' && $method == 'index') ? 'active' : ''; ?>">
                                            <a href="<?= site_url(); ?>fmc-leave-management"><?php echo  SIDEBAR_FMC_LEAVE_MANAGEMENT; ?></a>
                                        </li>
                                        <li class="<?php echo ($controller == 'medical_categories' && $method == 'index') ? 'active' : ''; ?>">
                                            <a href="<?= site_url(); ?>medical-categories"><?php echo  SIDEBAR_MEDICAL_CATEGORIES; ?></a>
                                        </li>
                                        <li class="<?php echo ($controller == 'warning_categories' && $method == 'index') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>warning_categories"><?php echo  SIDEBAR_WARNING_CATEGORY; ?></a></li>
                                    </ul>
                                </li>                       

                        <?php } ?>

                        <!--
                        
                        <li><a href="<?= site_url(); ?>leavemanagement"><i class="icon-list"></i><span>Leave Management</span></a></li>
                        
                        <li><a href="<?= site_url(); ?>assets-management"><i class="icon-list"></i>Assets</a></li>-->                        
                    </ul>
                </nav>
            </div>
          
        </div>
    </div>
</div>