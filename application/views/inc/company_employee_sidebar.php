<div id="left-sidebar" class="sidebar">
    <div class="sidebar-scroll">
        <div class="user-account">
            <?php 

                if(!empty($this->session->userdata['fmc_company_employee_data']['profile_pic'])){
                    $profile_pic = $this->session->userdata['fmc_company_employee_data']['profile_pic'];
                }else{
                    $profile_pic = "user_default.png";
                }

            ?>
            <img src="<?= site_url(); ?>uploads/<?php echo $profile_pic; ?>" class="rounded-circle user-photo" alt="User Profile Picture">
            <div class="dropdown">
                <span><?php echo  SIDEBAR_PROFILE_TITLE; ?>,</span>
                <a href="javascript:void(0);" class="user-name">
                    <strong><?php echo $this->session->userdata['fmc_company_employee_data']['fullname_english']; ?></strong>
                </a>
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
                        if(isset($this->session->userdata['fmc_company_employee_data'])){ 
                        ?>    
                        <li class="<?php echo ($controller == 'dashboard') ? 'active' : ''; ?>">
                            <a href="<?= site_url(); ?>dashboard"><i class="icon-speedometer"></i><span>Dashboard</span></a>
                        </li>

                        <li class="<?php echo ($controller == 'myprofile' && $method == 'index') ? 'active' : ''; ?>">
                            <a href="<?= site_url(); ?>my-profile"><i class="icon-user"></i><span>Basic Details</span></a>
                        </li>

                        <li class="<?php echo ($controller == 'myprofile' && $method == 'emergency_contacts') ? 'active' : ''; ?>">
                            <a href="<?= site_url(); ?>my-profile/emergency-contacts"><i class="icon-users"></i><span>Emergency Contacts</span></a>
                        </li>

                        <li class="<?php echo ($controller == 'myprofile' && $method == 'work_experience') ? 'active' : ''; ?>">
                            <a href="<?= site_url(); ?>my-profile/work-experience"><i class="icon-list"></i><span>Work Experience</span></a>
                        </li>

                        <li class="<?php echo ($controller == 'myprofile' && $method == 'qualification') ? 'active' : ''; ?>">
                            <a href="<?= site_url(); ?>my-profile/qualification"><i class="icon-list"></i><span>Qualification</span></a>
                        </li>

                        <li class="<?php echo ($controller == 'myprofile' && $method == 'documents') ? 'active' : ''; ?>">
                            <a href="<?= site_url(); ?>my-profile/documents"><i class="icon-list"></i><span>Personal Documents</span></a>
                        </li>

                        <li class="<?php echo ($controller == 'myprofile' && $method == 'leave_balance') ? 'active' : ''; ?>">
                            <a href="<?= site_url(); ?>leave-balance"><i class="icon-list"></i><span>Leave Balance</span></a>
                        </li>                        

                        <li class="<?php echo ($controller == 'myprofile_requests' && $method == 'overtime_requests') ? 'active' : ''; ?>">
                            <a href="<?= site_url(); ?>overtime-requests">
                                <i class="icon-list"></i>
                                <span>Overtime Request</span>
                            </a>
                        </li>

                        <li class="<?php echo ($controller == 'myprofile_requests' && $method == 'leave_requests') ? 'active' : ''; ?>">
                            <a href="<?= site_url(); ?>leave-requests">
                                <i class="icon-list"></i>
                                <span>Leave Request</span>
                            </a>
                        </li>

                        <li class="<?php echo ($controller == 'myprofile_requests' && $method == 'business_trip_requests') ? 'active' : ''; ?>">
                            <a href="<?= site_url(); ?>business-trip-requests">
                                <i class="icon-list"></i>
                                <span>Business Trip Request</span>
                            </a>
                        </li>

                        <li class="<?php echo ($controller == 'myprofile_requests' && $method == 'eccr_requests') ? 'active' : ''; ?>">
                            <a href="<?= site_url(); ?>eccr-requests">
                                <i class="icon-list"></i>
                                <span>ECCR Request</span>
                            </a>
                        </li>


                        <li class="<?php echo ($controller == 'myprofile_requests' && $method == 'general_requests') ? 'active' : ''; ?>">
                            <a href="<?= site_url(); ?>general-requests">
                                <i class="icon-list"></i>
                                <span>General Request</span>
                            </a>
                        </li>

                        <li class="<?php echo ($controller == 'myprofile' && $method == 'job_opening') ? 'active' : ''; ?>">
                            <a href="<?= site_url(); ?>job-opening">
                                <i class="icon-list"></i>
                                <span>Job Opening</span>
                            </a>
                        </li>

                        <li class="<?php echo ($controller == 'myprofile' && $method == 'annoucement') ? 'active' : ''; ?>">
                            <a href="<?= site_url(); ?>annoucement">
                                <i class="icon-list"></i>
                                <span>Annoucement</span>
                            </a>
                        </li>
                        <li class="<?php echo ($controller == 'employee_warning' && $method == 'index') ? 'active' : ''; ?>">
                            <a href="<?= site_url(); ?>employee_warning">
                                <i class="icon-list"></i>
                                <span>Warning</span>
                            </a>
                        </li>
                        <li class="<?php echo ($controller == 'assets_employee' && $method == 'index') ? 'active' : ''; ?>">
                            <a href="<?= site_url(); ?>assets_employee">
                                <i class="icon-list"></i>
                                <span>Assets</span>
                            </a>
                        </li>
                       
                        

                    <?php 
                        }
                    ?>     
                    </ul>
                </nav>
            </div>          
        </div>
    </div>
</div>