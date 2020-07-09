<div id="left-sidebar" class="sidebar">
    <div class="sidebar-scroll">
        <div class="user-account">
            <?php 

                if(!empty($this->session->userdata['fmc_user_data']['profile_picture'])){
                    $profile_pic = $this->session->userdata['fmc_user_data']['profile_picture'];
                }else{
                    $profile_pic = "user_default.png";
                }

            ?>
            <img src="<?= site_url(); ?>assets/profiles/<?php echo $profile_pic; ?>" class="rounded-circle user-photo" alt="User Profile Picture">
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
                        
                            <?php if(isset($this->session->userdata['fmc_client_login'])){ ?>    
                                
                                <li class="<?php echo ($controller == 'dashboard') ? 'active' : ''; ?>">
                                    <a href="<?= site_url(); ?>dashboard"><i class="icon-speedometer"></i><span><?php echo  COMPANY_SIDEBAR_DASHBOARD; ?></span></a>
                                </li>
                                <li class="<?php echo ($controller == 'salarycomponents' || $controller == 'leavemanagement' || $controller == 'Company_structure' || $controller == 'company_departments' || $controller == 'designation' || $controller == 'request_types') ? 'active' : ''; ?>">
                                    <a href="#clients" class="has-arrow"><i class="icon-settings"></i><span><?php echo  COMPANY_SIDEBAR_COMP_ADMIN_SETTINGS; ?></span></a>
                                    <ul>

                                        <li class="<?php echo ($controller == 'salarycomponents' && $method == 'index') ? 'active' : ''; ?>"">
                                            <a href="<?= site_url(); ?>salarycomponents"><?php echo  COMPANY_SIDEBAR_SALARY_COMPONENTS; ?></a>
                                        </li>

                                        <li class="<?php echo ($controller == 'leavemanagement') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>leavemanagement"><?php echo  COMPANY_SIDEBAR_LEAVE_MANAGEMENT; ?></a>
                                        </li>

                                        <li class="<?php echo ($controller == 'Company_structure') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>company-organization-chart"><?php echo  COMPANY_SIDEBAR_COMPANY_STRUCTURE; ?></a></li>
                                        <li class="<?php echo ($controller == 'company_departments') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>company_departments"><?php echo  COMPANY_SIDEBAR_COMPANY_DEPARTMENT; ?></a></li>
                                        <li class="<?php echo ($controller == 'designation') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>position-titles"><?php echo  COMPANY_SIDEBAR_COMPANY_DESIGNATION; ?></a></li>
                                        
                                        <li class="<?php echo ($controller == 'request_types') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>request_types"><?php echo  COMPANY_SIDEBAR_COMPANY_REQUEST_TYPE; ?></a></li>
                                    </ul>

                                </li>

                                <li class="<?php echo ($controller == 'jobpositions' || $controller == 'jobopenings') ? 'active' : ''; ?>">
                                    <a href="#recruitment" class="has-arrow"><i class="icon-users"></i><span><?php echo COMPANY_SIDEBAR_RECRUITMENT; ?></span></a>
                                    <ul>
                                        <li class="<?php echo ($controller == 'jobpositions') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>jobpositions"><?php echo COMPANY_SIDEBAR_JOB_POSITIONS; ?></a></li>
                                        <li class="<?php echo ($controller == 'jobopenings') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>jobopenings"><?php echo COMPANY_SIDEBAR_JOB_OPENINGS; ?></a></li>
                                    </ul>
                                </li>
                                    
                                <li class="<?php echo ($controller == 'employees') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>employees"><i class="icon-users"></i><span><?php echo  COMPANY_SIDEBAR_COMPANY_EMPLOYEE; ?></span></a>
                                </li>
                                
                                <li class="<?php echo ($controller == 'payroll') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>payroll"><i class="icon-credit-card"></i><span><?php echo  COMPANY_SIDEBAR_COMPANY_PAYROLL; ?></span></a>
                                </li>

                                
                                <li class="<?php echo ($controller == 'attendance') ? 'active' : ''; ?>">
                                    <a href="#attendance" class="has-arrow"><i class="icon-user"></i><span><?php echo COMPANY_SIDEBAR_ATTENDANCE; ?></span></a>
                                    <ul>
                                        <li class="<?php echo ($controller == 'attendance') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>attendance"><?php echo COMPANY_SIDEBAR_MANAGE_ATTENDANCE; ?></a></li>
                                    </ul>
                                </li>

                                <li class="<?php echo ($controller == 'assets') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>assets-management"><i class="icon-list"></i><?php echo COMPANY_SIDEBAR_ASSETS; ?></a></li>
                                <li class="<?php echo ($controller == 'warning') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>warning"><i class="icon-list"></i><?php echo COMPANY_SIDEBAR_WARNING; ?></a></li>

                                

                                <li class="<?php echo ($controller == 'company_documents') ? 'active' : ''; ?>"><a href="<?= site_url(); ?>company_documents"><i class="icon-list"></i><?php echo COMPANY_SIDEBAR_COMPANY_DOCUMENTS; ?></a></li>

                            <?php } ?>
                                           
                    </ul>
                </nav>
            </div>
          
        </div>
    </div>
</div>