<div id="wrapper">

    <?php include("inc/navbar.php") ?>

    <?php include("inc/sidebar.php") ?>    

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo LEAVE_MANAGEMENT_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active"><?php echo LEAVE_MANAGEMENT_TITLE; ?></li>
                        </ul>                        
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                                             
                    </div>
                </div>
            </div>
            
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <?php
                        if($this->session->flashdata('flashError'))
                        {
                            echo '<div class="alert alert-warning login-alert has-error">'.$this->session->flashdata('flashError').'</div>';
                        }
                        if($this->session->flashdata('flashSuccess'))
                        {
                            echo '<div class="alert alert-success login-alert has-error">'.$this->session->flashdata('flashSuccess').'</div>';
                        }
                    ?>
                    <div class="card">                        
                        <div class="body">
                            <ul class="nav nav-tabs-new2">
                                <li class="nav-item"><a class="nav-link <?php echo ($current_tab == 'leave-type') ? 'active show' : ''; ?>" data-toggle="tab" href="#Leave-Types"><?php echo LEAVE_MANAGEMENT_TYPES; ?></a></li>
                                <li class="nav-item"><a class="nav-link <?php echo ($current_tab == 'leave-group') ? 'active show' : ''; ?>" data-toggle="tab" href="#Leave-Groups"><?php echo LEAVE_MANAGEMENT_GROUPS; ?></a></li>
                                <li class="nav-item"><a class="nav-link <?php echo ($current_tab == 'holidays') ? 'active show' : ''; ?>" data-toggle="tab" href="#Holidays"><?php echo LEAVE_MANAGEMENT_HOLIDAYS; ?></a></li>
                                <li class="nav-item"><a class="nav-link <?php echo ($current_tab == 'holiday-group') ? 'active show' : ''; ?>" data-toggle="tab" href="#Holiday-Group"><?php echo LEAVE_MANAGEMENT_HOLIDAYS_GROUP; ?></a></li>
                                <li class="nav-item"><a class="nav-link <?php echo ($current_tab == 'workweek') ? 'active show' : ''; ?>" data-toggle="tab" href="#Work-Week"><?php echo LEAVE_MANAGEMENT_WORK_WEEK; ?></a></li>

                                <li class="nav-item"><a class="nav-link <?php echo ($current_tab == 'workshift') ? 'active show' : ''; ?>" data-toggle="tab" href="#Work-Shift"><?php echo LEAVE_MANAGEMENT_WORK_SHIFT; ?></a></li>
                                
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane <?php echo ($current_tab == 'leave-type') ? 'active show' : ''; ?>" id="Leave-Types">
                                    <div class="header">
                                        <h2><?php echo LEAVE_MANAGEMENT_TYPES; ?></h2>
                                        <ul class="header-dropdown">
                                            <li>
                                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_new_leave_type"><?php echo LEAVE_MANAGEMENT_ADD_NEW; ?></button>
                                            </li>                                            
                                        </ul>                            
                                    </div>  
                                    <div class="table-responsive">
                                        <table class="table table-hover js-basic-example dataTable table-custom" id="leave-types-table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th><?php echo LEAVE_MANAGEMENT_NAME; ?></th>
                                                    <th><?php echo LEAVE_MANAGEMENT_COLOR; ?></th>
                                                    <th><?php echo LEAVE_MANAGEMENT_GROUPS; ?></th>
                                                    <th>***</th>
                                                </tr>
                                            </thead>                                           
                                            <tbody>
                                                <?php
                                                if(!empty($leave_types)){
                                                    foreach ($leave_types as $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $value['name']; ?></td>  
                                                    <td>
                                                        <span>
                                                            <i style="display: inline-block;height: 16px;width: 16px;background-color: <?php echo $value['leave_type_color']; ?>;"></i>
                                                        </span>
                                                    </td> 
                                                    <td>
                                                        <?php 
                                                        if(!empty($value['leave_groups'])){
                                                            foreach ($value['leave_groups'] as $leave_group_value) {
                                                            ?>
                                                                <a style="cursor: pointer;" class="badge badge-success"><?php echo $leave_group_value['leave_type_group_name']; ?></a>
                                                            <?php
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="getLeaveType('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-edit"></i></button>
                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteLeaveType('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-trash"></i></button>
                                                    </td> 
                                                </tr>    
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane <?php echo ($current_tab == 'leave-group') ? 'active show' : ''; ?>" id="Leave-Groups">
                                    <div class="header">
                                        <h2>Leave Groups</h2>
                                        <ul class="header-dropdown">
                                            <li>
                                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_new_leave_group"><?php echo LEAVE_MANAGEMENT_ADD_NEW_L_GROUP; ?></button>
                                            </li>
                                        </ul>                            
                                    </div>  
                                    <div class="table-responsive">
                                        <table class="table table-hover js-basic-example dataTable table-custom">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th><?php echo LEAVE_MANAGEMENT_NAME; ?></th>
                                                    <th><?php echo LEAVE_MANAGEMENT_TYPES; ?></th>
                                                    <th>***</th>               
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if(!empty($leave_types_groups)){
                                                    foreach ($leave_types_groups as $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $value['name']; ?></td>  
                                                    <td>
                                                        <?php 
                                                        if(!empty($value['leave_types'])){
                                                            foreach ($value['leave_types'] as $leave_type) {
                                                            ?>
                                                                <a style="cursor: pointer;" class="badge badge-success"><?php echo $leave_type['leave_type_name']; ?></a>
                                                            <?php
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="getLeaveGroup('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-edit"></i></button>

                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteLeaveGroup('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-trash"></i></button>

                                                    </td> 
                                                </tr>    
                                                <?php
                                                    }
                                                }
                                                ?>    
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane <?php echo ($current_tab == 'holidays') ? 'active show' : ''; ?>" id="Holidays">
                                    <div class="header">
                                        <h2><?php echo LEAVE_MANAGEMENT_HOLIDAYS; ?></h2>
                                        <ul class="header-dropdown">
                                            <li>
                                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_new_holiday"><?php echo LEAVE_MANAGEMENT_ADD_NEW_HOLIDAY; ?></button>
                                            </li>
                                        </ul>                            
                                    </div>  
                                    <div class="table-responsive">
                                        <table class="table table-hover js-basic-example dataTable table-custom">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th><?php echo LEAVE_MANAGEMENT_NAME; ?></th>
                                                    <th><?php echo LEAVE_MANAGEMENT_DATE; ?></th>
                                                    <th><?php echo LEAVE_MANAGEMENT_HOLIDAYS_GROUP; ?></th>
                                                    <th>***</th>
                                                </tr>
                                            </thead>                                            
                                            <tbody>                                     
                                                <?php
                                                if(!empty($holidays)){
                                                    foreach ($holidays as $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $value['name']; ?></td>  
                                                    <td><?php echo  date('d/m/y', strtotime($value['date'])); ?></td> 
                                                    <td>
                                                        <?php 
                                                        if(!empty($value['holiday_groups'])){
                                                            foreach ($value['holiday_groups'] as $holiday_group) {
                                                            ?>
                                                                <a style="cursor: pointer;" class="badge badge-success"><?php echo $holiday_group['holiday_group_name']; ?></a>
                                                            <?php
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="getHoliday('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-edit"></i></button>
                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteHoliday('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-trash"></i></button>
                                                    </td> 
                                                </tr>    
                                                <?php
                                                    }
                                                }
                                                ?> 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane <?php echo ($current_tab == 'holiday-group') ? 'active show' : ''; ?>" id="Holiday-Group">
                                    <div class="header">
                                        <h2><?php echo LEAVE_MANAGEMENT_HOLIDAYS_GROUP; ?></h2>
                                        <ul class="header-dropdown">
                                            <li>
                                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_new_holiday_group"><?php echo LEAVE_MANAGEMENT_ADD_NEW_H_GROUP; ?></button>
                                            </li>
                                        </ul>                            
                                    </div>  
                                    <div class="table-responsive">
                                        <table class="table table-hover js-basic-example dataTable table-custom">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th><?php echo LEAVE_MANAGEMENT_NAME; ?></th>
                                                    <th><?php echo LEAVE_MANAGEMENT_HOLIDAYS; ?></th>
                                                    <th>***</th>               
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if(!empty($holiday_groups)){
                                                    foreach ($holiday_groups as $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $value['name']; ?></td>  
                                                    <td>
                                                        <?php 
                                                        if(!empty($value['holidays'])){
                                                            foreach ($value['holidays'] as $holiday) {
                                                            ?>
                                                                <a style="cursor: pointer;" class="badge badge-success"><?php echo $holiday['holiday_name']; ?></a>
                                                            <?php
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="getHolidayGroup('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-edit"></i></button>
                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteHolidayGroup('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-trash"></i></button>
                                                    </td> 
                                                </tr>    
                                                <?php
                                                    }
                                                }
                                                ?>    
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane <?php echo ($current_tab == 'workweek') ? 'active show' : ''; ?>" id="Work-Week">
                                    <div class="header">
                                        <h2><?php echo LEAVE_MANAGEMENT_WORK_WEEK; ?></h2>
                                        <ul class="header-dropdown">
                                            <li>
                                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_new_workweek"><?php echo LEAVE_MANAGEMENT_ADD_NEW_WORK_WEEK; ?></button>
                                            </li>
                                        </ul>                            
                                    </div>  
                                    <div class="table-responsive">
                                        <table class="table table-hover js-basic-example dataTable table-custom">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th><?php echo LEAVE_MANAGEMENT_WORK_WEEK_NAME; ?></th>
                                                    <th><?php echo LEAVE_MANAGEMENT_DAY; ?></th>
                                                    <th>***</th>
                                                </tr>
                                            </thead>                                            
                                            <tbody>
                                                <?php
                                                if(!empty($workweek)){
                                                    foreach ($workweek as $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $value['name']; ?></td>  
                                                    <td>
                                                        <?php 
                                                        echo ($value['sunday'] == 'yes') ? '<a style="cursor: pointer;" class="badge badge-success">Sunday</a>' : '';
                                                        echo ($value['monday'] == 'yes') ? '<a style="cursor: pointer;" class="badge badge-success">Monday</a>' : '';
                                                        echo ($value['tuesday'] == 'yes') ? '<a style="cursor: pointer;" class="badge badge-success">Tuesday</a>' : '';
                                                        echo ($value['wednesday'] == 'yes') ? '<a style="cursor: pointer;" class="badge badge-success">Wednesday</a>' : '';
                                                        echo ($value['thursday'] == 'yes') ? '<a style="cursor: pointer;" class="badge badge-success">Thursday</a>' : '';
                                                        echo ($value['friday'] == 'yes') ? '<a style="cursor: pointer;" class="badge badge-success">Friday</a>' : '';
                                                        echo ($value['saturday'] == 'yes') ? '<a style="cursor: pointer;" class="badge badge-success">Saturday</a>' : ''; 
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="getWorkweek('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-edit"></i></button>
                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteWorkweek('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-trash"></i></button>
                                                    </td> 
                                                </tr>    
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane <?php echo ($current_tab == 'workshift') ? 'active show' : ''; ?>" id="Work-Shift">
                                    <div class="header">
                                        <h2><?php echo LEAVE_MANAGEMENT_WORK_SHIFT; ?></h2>
                                        <ul class="header-dropdown">
                                            <li>
                                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_new_workshift"><?php echo LEAVE_MANAGEMENT_ADD_WORK_SHIFT; ?></button>
                                            </li>
                                        </ul>                            
                                    </div>  
                                    <div class="table-responsive">
                                        <table class="table table-hover js-basic-example dataTable table-custom">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th><?php echo LEAVE_MANAGEMENT_WORK_SHIFT_NAME; ?></th>
                                                    <th><?php echo LEAVE_MANAGEMENT_START_TIME; ?></th>
                                                    <th><?php echo LEAVE_MANAGEMENT_END_TIME; ?></th>
                                                    <th>***</th>
                                                </tr>
                                            </thead>                                            
                                            <tbody>
                                                <?php
                                                if(!empty($workshift)){
                                                    foreach ($workshift as $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $value['shift_name']; ?></td>  
                                                    <td><?php echo $value['start_time']; ?></td> 
                                                    <td><?php echo $value['end_time']; ?></td> 
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="getWorkShift('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-edit"></i></button>

                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteWorkShift('<?php echo $value['id']; ?>');" title="Edit"><i class="fa fa-trash"></i></button>
                                                    </td> 
                                                </tr>    
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
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

<!--CSS For Color Picker z-index-->
<style type="text/css">
.dropdown-menu{
    z-index: 9999!important;
}    
</style>

<!-- Add New Leave Type -->
<div class="modal animated jello" id="add_new_leave_type" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="add_new_leave_type_form" action="<?= base_url('fmc_leave_management/create_leave_type');?>">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel"><?php echo LEAVE_MANAGEMENT_ADD_NEW; ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="name" class="form-control" placeholder="<?php echo LEAVE_MANAGEMENT_LEAVE_TYPE_TITLE; ?>" required>
                        </div>
                    </div>  
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" name="days" class="form-control" placeholder="<?php echo LEAVE_MANAGEMENT_LEAVE_DAYS; ?>" required>
                        </div>
                    </div>   
                    <div class="form-group">     
                        <div class="input-group colorpicker">
                            <input type="text" name="leave_type_color" class="form-control input-group-addon" value="#00AABB" autocomplete="off" placeholder="<?php echo LEAVE_MANAGEMENT_LEAVE_COLORS; ?>">
                            <div class="input-group-append">
                                <span class="input-group-text"><span class="input-group-addon"> <i></i> </span></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?php echo LEAVE_MANAGEMENT_GROUPS; ?>: </label>
                        <div class="row">
                        <?php 
                        if(!empty($leave_types_groups)){
                        foreach ($leave_types_groups as $value) {
                        ?>
                            <div class="col-lg-6 col-md-12">
                                <div class="fancy-checkbox">
                                    <label><input name="leave_type_group[]" value="<?php echo $value['id']; ?>" type="checkbox"><span><?php echo $value['name']; ?></span></label>
                                </div>
                            </div>
                        <?php
                        }
                        }
                        ?>
                        </div>
                    </div>                        
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?php echo LEAVE_MANAGEMENT_ADD; ?></button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo LEAVE_MANAGEMENT_CLOSE; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Leave Type -->
<div class="modal animated jello" id="update_leave_type" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="update_leave_type_form" action="<?= base_url('fmc_leave_management/update_leave_type');?>">
                <input type="hidden" name="id" value="">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel"><?php echo LEAVE_MANAGEMENT_UPDATE_LEAVE_TYPE; ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="name" class="form-control" placeholder="<?php echo LEAVE_MANAGEMENT_LEAVE_TYPE_TITLE; ?>" required>
                        </div>
                    </div>   
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" name="days" class="form-control" placeholder="<?php echo LEAVE_MANAGEMENT_LEAVE_DAYS; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">     
                        <div class="input-group colorpicker">
                            <input type="text" name="leave_type_color" class="form-control" value="#00AABB" autocomplete="off" placeholder="<?php echo LEAVE_MANAGEMENT_LEAVE_COLORS; ?>">
                            <div class="input-group-append">
                                <span class="input-group-text"><span class="input-group-addon"> <i></i> </span></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?php echo LEAVE_MANAGEMENT_GROUPS; ?>: </label>
                        <div class="row">
                        <?php
                        if(!empty($leave_types_groups)){
                        foreach ($leave_types_groups as $value) {
                        ?>
                            <div class="col-lg-6 col-md-12">
                                <div class="fancy-checkbox">
                                    <label><input name="leave_type_group[]" id="leave_group_<?php echo $value['id']; ?>" value="<?php echo $value['id']; ?>" type="checkbox"><span><?php echo $value['name']; ?></span></label>
                                </div>
                            </div>
                        <?php
                        }
                        }
                        ?>
                        </div>
                    </div>                        
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?php echo LEAVE_MANAGEMENT_SAVE; ?></button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo LEAVE_MANAGEMENT_CLOSE; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add New Leave Group -->
<div class="modal animated jello" id="add_new_leave_group" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="add_new_leave_group_form" action="<?= base_url('fmc_leavegroup/create');?>">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel"><?php echo LEAVE_MANAGEMENT_ADD_NEW_L_GROUP; ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="name" class="form-control" placeholder="<?php echo  LEAVE_MANAGEMENT_LEAVE_G_TITLE; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?php echo LEAVE_MANAGEMENT_TYPES; ?>: </label>
                        <div class="row">
                        <?php
                        if(!empty($leave_types)){
                        foreach ($leave_types as $value) {
                        ?>
                            <div class="col-lg-6 col-md-12">
                                <div class="fancy-checkbox">
                                    <label><input name="leave_types[]" value="<?php echo $value['id']; ?>" type="checkbox"><span><?php echo $value['name']; ?></span></label>
                                </div>
                            </div>
                        <?php
                        }
                        }
                        ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?php echo LEAVE_MANAGEMENT_ADD; ?></button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo LEAVE_MANAGEMENT_CLOSE; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Leave Group -->
<div class="modal animated jello" id="update_leave_group" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="update_leave_group_form" action="<?= base_url('fmc_leavegroup/update');?>">
                <input type="hidden" name="id" value="">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel"><?php echo LEAVE_MANAGEMENT_UPDATE_LEAVE_GROUP; ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="name" class="form-control" placeholder="<?php echo LEAVE_MANAGEMENT_LEAVE_TYPE_TITLE; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?php echo LEAVE_MANAGEMENT_TYPES; ?>: </label>
                        <div class="row">
                        <?php
                        if(!empty($leave_types)){
                            foreach ($leave_types as $value) {
                            ?>
                                <div class="col-lg-6 col-md-12">
                                    <div class="fancy-checkbox">
                                        <label><input name="leave_types[]" id="leave_type_<?php echo $value['id']; ?>" value="<?php echo $value['id']; ?>" type="checkbox"><span><?php echo $value['name']; ?></span></label>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        ?>
                        </div>
                    </div>   
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?php echo LEAVE_MANAGEMENT_SAVE; ?></button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo LEAVE_MANAGEMENT_CLOSE; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add New Holiday -->
<div class="modal animated jello" id="add_new_holiday" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="add_new_holiday_form" action="<?= base_url('fmc_holidays/create');?>">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel"><?php echo LEAVE_MANAGEMENT_ADD_NEW_HOLIDAY; ?></h4>
            </div>            
            <div class="modal-body">                
                <div class="row clearfix">
                    <div class="form-group col-lg-12 col-md-6">
                        <div class="form-line">
                            <input type="text" name="name" class="form-control" placeholder="<?php echo LEAVE_MANAGEMENT_HOLIDAY_TITLE; ?>" required>
                        </div>
                    </div>                    
                </div>   
                <div class="row clearfix">
                    <div class="form-group col-lg-12 col-md-6">
                        <div class="form-line">
                            <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="date" placeholder="<?php echo LEAVE_MANAGEMENT_DATE; ?>" autocomplete="off" value="" readonly required>
                        </div>
                    </div>                
                </div>
                <div class="row clearfix">
                    <div class="form-group col-lg-12 col-md-6">
                        <div class="form-line">
                            <textarea class="form-control" name="description" placeholder="<?php echo LEAVE_MANAGEMENT_DESCRIPTION; ?>"></textarea>
                        </div>
                    </div>                
                </div>
                <div class="row clearfix">
                    <div class="form-group col-lg-12 col-md-6">
                        <label><?php echo LEAVE_MANAGEMENT_HOLIDAYS_GROUP; ?>: </label>
                        <div class="row">
                        <?php
                        if(!empty($holiday_groups)){
                            foreach ($holiday_groups as $value) {
                            ?>
                                <div class="col-lg-6 col-md-12">
                                    <div class="fancy-checkbox">
                                        <label><input name="holiday_groups[]" value="<?php echo $value['id']; ?>" type="checkbox"><span><?php echo $value['name']; ?></span></label>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        ?>
                        </div>
                    </div>
                </div>       
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><?php echo LEAVE_MANAGEMENT_ADD; ?></button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo LEAVE_MANAGEMENT_CLOSE; ?></button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Holiday -->
<div class="modal animated jello" id="update_holiday" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="update_holiday_form" action="<?= base_url('fmc_holidays/update');?>">
            <input type="hidden" name="id" value="">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel"><?php echo LEAVE_MANAGEMENT_UPDATE_HOLIDAY; ?></h4>
            </div>            
            <div class="modal-body">                
                <div class="row clearfix">
                    <div class="form-group col-lg-12 col-md-6">
                        <div class="form-line">
                            <input type="text" name="name" class="form-control" placeholder="<?php echo LEAVE_MANAGEMENT_HOLIDAY_TITLE; ?>" required>
                        </div>
                    </div>                    
                </div>   
                <div class="row clearfix">
                    <div class="form-group col-lg-12 col-md-6">
                        <div class="form-line">
                            <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy" name="date" placeholder="<?php echo LEAVE_MANAGEMENT_DATE; ?>" autocomplete="off" value="" readonly required>
                        </div>
                    </div>                
                </div>
                <div class="row clearfix">
                    <div class="form-group col-lg-12 col-md-6">
                        <div class="form-line">
                            <textarea class="form-control" name="description" placeholder="<?php echo LEAVE_MANAGEMENT_DESCRIPTION; ?>"></textarea>
                        </div>
                    </div>                
                </div>
                <div class="row clearfix">
                    <div class="form-group col-lg-12 col-md-6">
                        <label><?php echo LEAVE_MANAGEMENT_HOLIDAYS_GROUP; ?>: </label>
                        <div class="row">
                        <?php
                        if(!empty($holiday_groups)){
                            foreach ($holiday_groups as $value) {
                            ?>
                                <div class="col-lg-6 col-md-12">
                                    <div class="fancy-checkbox">
                                        <label><input name="holiday_groups[]" value="<?php echo $value['id']; ?>" id="holiday_group_<?php echo $value['id']; ?>" type="checkbox"><span><?php echo $value['name']; ?></span></label>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        ?>
                        </div>
                    </div>
                </div> 
                  
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><?php echo LEAVE_MANAGEMENT_SAVE; ?></button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo LEAVE_MANAGEMENT_CLOSE; ?></button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Add New Holiday Group -->
<div class="modal animated jello" id="add_new_holiday_group" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="add_new_holiday_group_form" action="<?= base_url('fmc_holidaygroup/create');?>">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel"><?php echo LEAVE_MANAGEMENT_ADD_NEW_H_GROUP; ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="name" class="form-control" placeholder="<?php echo  LEAVE_MANAGEMENT_HOLIDAY_G_TITLE; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?php echo LEAVE_MANAGEMENT_HOLIDAYS; ?>: </label>
                        <div class="row">
                        <?php 
                        if(!empty($holidays)){
                        foreach ($holidays as $value) {
                        ?>
                            <div class="col-lg-6 col-md-12">
                                <div class="fancy-checkbox">
                                    <label><input name="holidays[]" value="<?php echo $value['id']; ?>" type="checkbox"><span><?php echo $value['name']; ?></span></label>
                                </div>
                            </div>
                        <?php
                        }
                        }
                        ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?php echo LEAVE_MANAGEMENT_ADD; ?></button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo LEAVE_MANAGEMENT_CLOSE; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Holiday Group -->
<div class="modal animated jello" id="update_holiday_group" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="update_holiday_group_form" action="<?= base_url('fmc_holidaygroup/update');?>">
                <input type="hidden" name="id" value="">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel"><?php echo LEAVE_MANAGEMENT_UPDATE_H_GROUP; ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="name" class="form-control" placeholder="<?php echo  LEAVE_MANAGEMENT_HOLIDAY_G_TITLE; ?>" required>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label><?php echo  LEAVE_MANAGEMENT_HOLIDAYS; ?>: </label>
                        <div class="row">
                        <?php 
                        if(!empty($holidays)){
                        foreach ($holidays as $value) {
                        ?>
                            <div class="col-lg-6 col-md-12">
                                <div class="fancy-checkbox">
                                    <label><input name="holidays[]" value="<?php echo $value['id']; ?>" id="holiday_<?php echo $value['id']; ?>" type="checkbox"><span><?php echo $value['name']; ?></span></label>
                                </div>
                            </div>
                        <?php
                        }
                        }
                        ?>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?php echo  LEAVE_MANAGEMENT_SAVE; ?></button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo  LEAVE_MANAGEMENT_CLOSE; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add New Work Week  -->
<div class="modal animated jello" id="add_new_workweek" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="add_new_workweek_form" action="<?= base_url('fmc_workweek/create');?>">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel"><?php echo  LEAVE_MANAGEMENT_ADD_NEW_WORK_WEEK; ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="name" class="form-control" placeholder="<?php echo  LEAVE_MANAGEMENT_WORK_WEEK_NAME; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <div class="fancy-checkbox">
                                    <label><input name="monday" type="checkbox"><span><?php echo  LEAVE_MANAGEMENT_MONDAY; ?></span></label>
                                </div>
                                <div class="fancy-checkbox">
                                    <label><input name="thursday" type="checkbox"><span><?php echo  LEAVE_MANAGEMENT_THURSDAY; ?></span></label>
                                </div>
                                <div class="fancy-checkbox">
                                    <label><input name="sunday" type="checkbox"><span><?php echo  LEAVE_MANAGEMENT_SUNDAY; ?></span></label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="fancy-checkbox">
                                    <label><input name="tuesday" type="checkbox"><span><?php echo  LEAVE_MANAGEMENT_TUESDAY; ?></span></label>
                                </div>
                                <div class="fancy-checkbox">
                                    <label><input name="friday" type="checkbox"><span><?php echo  LEAVE_MANAGEMENT_FRIDAY; ?></span></label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="fancy-checkbox">
                                    <label><input name="wednesday" type="checkbox"><span><?php echo  LEAVE_MANAGEMENT_WEDNESDAY; ?></span></label>
                                </div>
                                <div class="fancy-checkbox">
                                    <label><input name="saturday" type="checkbox"><span><?php echo  LEAVE_MANAGEMENT_SATURDAY; ?></span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?php echo  LEAVE_MANAGEMENT_ADD; ?></button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo  LEAVE_MANAGEMENT_CLOSE; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Upd Wateork Week  -->
<div class="modal animated jello" id="update_workweek" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="update_workweek_form" action="<?= base_url('fmc_workweek/update');?>">
            <input type="hidden" name="id" value="">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel"><?php echo  LEAVE_MANAGEMENT_UPDATE_WORK_WEEK; ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="name" class="form-control" placeholder="<?php echo  LEAVE_MANAGEMENT_WORK_WEEK_NAME; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <div class="fancy-checkbox">
                                    <label><input name="monday" type="checkbox"><span><?php echo  LEAVE_MANAGEMENT_MONDAY; ?></span></label>
                                </div>
                                <div class="fancy-checkbox">
                                    <label><input name="thursday" type="checkbox"><span><?php echo  LEAVE_MANAGEMENT_THURSDAY; ?></span></label>
                                </div>
                                <div class="fancy-checkbox">
                                    <label><input name="sunday" type="checkbox"><span><?php echo  LEAVE_MANAGEMENT_SUNDAY; ?></span></label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="fancy-checkbox">
                                    <label><input name="tuesday" type="checkbox"><span><?php echo  LEAVE_MANAGEMENT_TUESDAY; ?></span></label>
                                </div>
                                <div class="fancy-checkbox">
                                    <label><input name="friday" type="checkbox"><span><?php echo  LEAVE_MANAGEMENT_FRIDAY; ?></span></label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="fancy-checkbox">
                                    <label><input name="wednesday" type="checkbox"><span><?php echo  LEAVE_MANAGEMENT_WEDNESDAY; ?></span></label>
                                </div>
                                <div class="fancy-checkbox">
                                    <label><input name="saturday" type="checkbox"><span><?php echo  LEAVE_MANAGEMENT_SATURDAY; ?></span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?php echo  LEAVE_MANAGEMENT_ADD; ?></button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo  LEAVE_MANAGEMENT_CLOSE; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add New Work Shift  -->
<div class="modal animated jello" id="add_new_workshift" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="add_new_workshift_form" action="<?= base_url('fmc_workshift/create');?>">
                <div class="modal-header">
                    <h4 class="title"><?php echo  LEAVE_MANAGEMENT_ADD_WORK_SHIFT; ?></h4>
                </div>
                <div class="modal-body">
               <div class="row clearfix">
                    <div class="col-lg-12 col-md-6">
                         <div class="form-group">
                             <div class="form-line">
                                 <input type="text" name="shift_name" class="form-control" placeholder="<?php echo  LEAVE_MANAGEMENT_SIFT_NAME; ?>" required>
                             </div>
                         </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                         <div class="form-group">
                             <label><?php echo  LEAVE_MANAGEMENT_STARTTIME; ?></label>
                             <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-clock"></i></span>
                                </div>
                                <input type="text" name="start_time" class="form-control time12" placeholder="<?php echo  LEAVE_MANAGEMENT_PLACEHOLDER; ?>">
                             </div>
                         </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                         <div class="form-group">
                             <label><?php echo  LEAVE_MANAGEMENT_ENDTIME; ?></label>
                             <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-clock"></i></span>
                                </div>
                                <input type="text" name="end_time" class="form-control time12" placeholder="<?php echo  LEAVE_MANAGEMENT_PLACEHOLDER; ?>">
                             </div>
                         </div>
                    </div>
               </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?php echo  LEAVE_MANAGEMENT_ADD; ?></button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo  LEAVE_MANAGEMENT_CLOSE; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Work Shift  -->
<div class="modal animated jello" id="update_workshift" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="update_workshift_form" action="<?= base_url('fmc_workshift/update');?>">
            <input type="hidden" name="id" value="">
                <div class="modal-header">
                    <h4 class="title"><?php echo  LEAVE_MANAGEMENT_UPDATE_WORK_SHIFT; ?></h4>
                </div>
                <div class="modal-body">
               <div class="row clearfix">
                    <div class="col-lg-12 col-md-6">
                         <div class="form-group">
                             <div class="form-line">
                                 <input type="text" name="shift_name" class="form-control" placeholder="<?php echo  LEAVE_MANAGEMENT_SIFT_NAME; ?>" required>
                             </div>
                         </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                         <div class="form-group">
                             <label><?php echo  LEAVE_MANAGEMENT_STARTTIME; ?></label>
                             <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-clock"></i></span>
                                </div>
                                <input type="text" name="start_time" class="form-control time12" placeholder="<?php echo  LEAVE_MANAGEMENT_PLACEHOLDER; ?>">
                             </div>
                         </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                         <div class="form-group">
                             <label><?php echo  LEAVE_MANAGEMENT_ENDTIME; ?></label>
                             <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-clock"></i></span>
                                </div>
                                <input type="text" name="end_time" class="form-control time12" placeholder="<?php echo  LEAVE_MANAGEMENT_PLACEHOLDER; ?>">
                             </div>
                         </div>
                    </div>
               </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?php echo  LEAVE_MANAGEMENT_ADD; ?></button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo  LEAVE_MANAGEMENT_CLOSE; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Common Javascript Library Included jquery-3.3.1.min.js,popper.min.js,bootstrap.js -->
<script src="<?= site_url(); ?>assets/bundles/libscripts.bundle.js"></script>
<!-- Common Javascript Library metisMenu.js,jquery.slimscroll.min.js,bootstrap-progressbar.min.js,jquery.sparkline.min.js -->
<script src="<?= site_url(); ?>assets/bundles/vendorscripts.bundle.js"></script>

<!-- Search Drondown .select2 -->
<script src="<?= site_url(); ?>assets/vendor/select2/select2.min.js"></script>

<!-- Multi Select Dropdown -->
<script src="<?= site_url(); ?>assets/vendor/multi-select/js/jquery.multi-select.js"></script> 
<script src="<?= site_url(); ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>

<!-- Form Validation -->
<script src="<?= site_url(); ?>assets/vendor/parsleyjs/js/parsley.min.js"></script>

<!-- Date-Picker Time-Picker -->
<script src="<?= site_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= site_url(); ?>assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<!-- Ckeditor --> 
<script src="<?= site_url(); ?>assets/vendor/ckeditor/ckeditor.js"></script> 

<!-- Color Picker --> 
<script src="<?= site_url(); ?>assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> 

<!-- bootstrap treeview -->
<script src="<?= site_url(); ?>assets/vendor/bootstrap-treeview/bootstrap-treeview.min.js"></script>

<!-- SweetAlert For Dialog Box --> 
<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script> 

<!-- Toaster --> 
<script src="<?= site_url(); ?>assets/vendor/toastr/toastr.js"></script> 

<!-- Input Mask Plugin Js --> 
<script src="<?= site_url(); ?>assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js"></script> 
<script src="<?= site_url(); ?>assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js"></script>

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 

<script type="text/javascript">
    $(function () {
        $('.time12').inputmask('hh:mm t', { placeholder: '__:__ _m', alias: 'time12', hourFormat: '12' });
    });
</script>

<script type="text/javascript">
    //Get Leave Type For Update
    function getLeaveType(id){
        show_page_loader();
        $.ajax({
            url: "<?= base_url('fmc_leave_management/get_leave_type');?>",
            method: "POST",
            data: { id : id },
            success : function(response){
                hide_page_loader();
                var obj = JSON.parse(response);
                if(obj.success == 'true'){
                    $("#update_leave_type input[name*='id']").val(obj.data.id);
                    $("#update_leave_type input[name*='name']").val(obj.data.name);
                    $("#update_leave_type input[name*='days']").val(obj.data.days);
                    $("#update_leave_type input[name*='leave_type_color']").val(obj.data.leave_type_color);

                    $("#update_leave_type input[name*='leave_type_group']").prop('checked', false);

                    if(obj.data && obj.data.leave_types_groups){
                        obj.data.leave_types_groups.forEach(function(leave_types_group){
                            $("#leave_group_"+leave_types_group.leave_type_group_id).prop('checked', true);
                        });
                    }                    
                    $("#update_leave_type").modal("show");
                }else{
                    // notification popup
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = 'toast-bottom-right';    
                    toastr['error']('something went wrong!.');
                }
            },
            error : function(){
                // notification popup
                toastr.options.closeButton = true;
                toastr.options.positionClass = 'toast-bottom-right';    
                toastr['error']('something went wrong!.');
                hide_page_loader();
            }
        });
    }

    function deleteLeaveType(id){
        swal({
            title: "<?php echo R_U_SURE; ?>",
            text: "<?php echo RECOVER_RECORD; ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "<?php echo YES; ?>",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                url: "<?= site_url('fmc_leave_management/delete_leave_type/'); ?>",
                type: 'post',
                data: {'id': id,'status': 'deleted'},
                success: function (data) {
                    window.location.href = "<?= site_url('fmc-leave-management'); ?>";
                },
                error: function () {
                    window.location.href = "<?= site_url('fmc-leave-management'); ?>";
                }
            });            
        });
    }

    //Get Leave Group For Update
    function getLeaveGroup(id){
        show_page_loader();
        $.ajax({
            url: "<?= base_url('fmc_leavegroup/get');?>",
            method: "POST",
            data: { id : id },
            success : function(response){
                hide_page_loader();
                var obj = JSON.parse(response);
                if(obj.success == 'true'){
                    $("#update_leave_group_form input[name*='id']").val(obj.data.id);
                    $("#update_leave_group_form input[name*='name']").val(obj.data.name);
                    
                    $("#update_leave_group_form input[type*='checkbox']").prop('checked', false);

                    if(obj.data && obj.data.leave_types){
                        obj.data.leave_types.forEach(function(leave_type){
                            console.log(leave_type.leave_type_id);
                            $("#leave_type_"+leave_type.leave_type_id).prop('checked', true);
                        });
                    } 
                        
                    $("#update_leave_group").modal("show");
                }else{
                    // notification popup
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = 'toast-bottom-right';    
                    toastr['error']('something went wrong!.');
                }
            },
            error : function(){
                // notification popup
                toastr.options.closeButton = true;
                toastr.options.positionClass = 'toast-bottom-right';    
                toastr['error']('something went wrong!.');
                hide_page_loader();
            }
        });
    }

    //Delete Leave Group
    function deleteLeaveGroup(id){
        swal({
            title: "<?php echo R_U_SURE; ?>",
            text: "<?php echo RECOVER_RECORD; ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "<?php echo YES; ?>",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                url: "<?= site_url('fmc_leavegroup/delete/'); ?>",
                type: 'post',
                data: {'id': id,'status': 'deleted'},
                success: function (data) {
                    window.location.href = "<?= site_url('fmc-leave-group'); ?>";
                },
                error: function () {
                    window.location.href = "<?= site_url('fmc-leave-group'); ?>";
                }
            });            
        });
    }

    //Get Holiday For Update
    function getHoliday(id){
        show_page_loader();
        $.ajax({
            url: "<?= base_url('fmc_holidays/get');?>",
            method: "POST",
            data: { id : id },
            success : function(response){
                hide_page_loader();
                var obj = JSON.parse(response);
                if(obj.success == 'true'){
                    console.log(obj);
                    
                    $("#update_holiday_form input[name='id']").val(obj.data.id);
                    $("#update_holiday_form input[name='name']").val(obj.data.name);
                    $("#update_holiday_form input[name='date']").val(obj.data.date);
                    $("#update_holiday_form textarea[name='description']").val(obj.data.description);
                    
                    $("#update_holiday_form input[type='checkbox']").prop('checked', false);

                    if(obj.data && obj.data.holiday_groups){
                        obj.data.holiday_groups.forEach(function(holiday_group){
                            console.log(holiday_group);
                            $("#holiday_group_"+holiday_group.holiday_group_id).prop('checked', true);
                        });
                    } 
                    
                    $("#update_holiday").modal("show");
                }else{
                    // notification popup
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = 'toast-bottom-right';    
                    toastr['error']('something went wrong!.');
                }
            },
            error : function(){
                // notification popup
                toastr.options.closeButton = true;
                toastr.options.positionClass = 'toast-bottom-right';    
                toastr['error']('something went wrong!.');
                hide_page_loader();
            }
        });
    }
    
     //Delete Leave Group
    function deleteHoliday(id){
        swal({
            title: "<?php echo R_U_SURE; ?>",
            text: "<?php echo RECOVER_RECORD; ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "<?php echo YES; ?>",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                url: "<?= site_url('fmc_holidays/delete/'); ?>",
                type: 'post',
                data: {'id': id,'status': 'deleted'},
                success: function (data) {
                    window.location.href = "<?= site_url('fmc-holidays'); ?>";
                },
                error: function () {
                    window.location.href = "<?= site_url('fmc-holidays'); ?>";
                }
            });            
        });
    }

     //Get Holiday Group For Update
    function getHolidayGroup(id){
        show_page_loader();
        $.ajax({
            url: "<?= base_url('fmc_holidaygroup/get');?>",
            method: "POST",
            data: { id : id },
            success : function(response){
                hide_page_loader();
                var obj = JSON.parse(response);
                if(obj.success == 'true'){
                    $("#update_holiday_group_form input[name='id']").val(obj.data.id);
                    $("#update_holiday_group_form input[name='name']").val(obj.data.name);
                    
                    //holiday_id
                    $("#update_holiday_group_form input[type='checkbox']").prop('checked', false);

                    if(obj.data && obj.data.holidays){
                        obj.data.holidays.forEach(function(holiday){
                            $("#holiday_"+holiday.holiday_id).prop('checked', true);
                        });
                    }

                    $("#update_holiday_group").modal("show");
                }else{
                    // notification popup
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = 'toast-bottom-right';    
                    toastr['error']('something went wrong!.');
                }
            },
            error : function(){
                // notification popup
                toastr.options.closeButton = true;
                toastr.options.positionClass = 'toast-bottom-right';    
                toastr['error']('something went wrong!.');
                hide_page_loader();
            }
        });
    }

    //Delete Leave Group
    function deleteHolidayGroup(id){
        swal({
            title: "<?php echo R_U_SURE; ?>",
            text: "<?php echo RECOVER_RECORD; ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "<?php echo YES; ?>",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                url: "<?= site_url('fmc_holidaygroup/delete/'); ?>",
                type: 'post',
                data: {'id': id,'status': 'deleted'},
                success: function (data) {
                    window.location.href = "<?= site_url('fmc-holiday-group'); ?>";
                },
                error: function () {
                    window.location.href = "<?= site_url('fmc-holiday-group'); ?>";
                }
            });            
        });
    }

    //Get Workweek Group For Update
    function getWorkweek(id){
        show_page_loader();
        $.ajax({
            url: "<?= base_url('fmc_workweek/get');?>",
            method: "POST",
            data: { id : id },
            success : function(response){
                hide_page_loader();
                var obj = JSON.parse(response);
                if(obj.success == 'true'){
                    $("#update_workweek_form input[name*='id']").val(obj.data.id);
                    $("#update_workweek_form input[name*='name']").val(obj.data.name);

                    if(obj.data.monday == "yes"){
                        $("#update_workweek_form input[name*='monday']").prop('checked', true);
                    }
                    if(obj.data.tuesday == "yes"){
                        $("#update_workweek_form input[name*='tuesday']").prop('checked', true);
                    }
                    if(obj.data.wednesday == "yes"){
                        $("#update_workweek_form input[name*='wednesday']").prop('checked', true);
                    }
                    if(obj.data.thursday == "yes"){
                        $("#update_workweek_form input[name*='thursday']").prop('checked', true);
                    }
                    if(obj.data.friday == "yes"){
                        $("#update_workweek_form input[name*='friday']").prop('checked', true);
                    }
                    if(obj.data.saturday == "yes"){
                        $("#update_workweek_form input[name*='saturday']").prop('checked', true);
                    }
                    if(obj.data.sunday == "yes"){
                        $("#update_workweek_form input[name*='sunday']").prop('checked', true);
                    }
                    
                    
                    $("#update_workweek").modal("show");
                }else{
                    // notification popup
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = 'toast-bottom-right';    
                    toastr['error']('something went wrong!.');
                }
            },
            error : function(){
                // notification popup
                toastr.options.closeButton = true;
                toastr.options.positionClass = 'toast-bottom-right';    
                toastr['error']('something went wrong!.');
                hide_page_loader();
            }
        });
    }

    //Delete Workweek
    function deleteWorkweek(id){
        swal({
            title: "<?php echo R_U_SURE; ?>",
            text: "<?php echo RECOVER_RECORD; ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "<?php echo YES; ?>",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                url: "<?= site_url('fmc_workweek/delete/'); ?>",
                type: 'post',
                data: {'id': id,'status': 'deleted'},
                success: function (data) {
                    window.location.href = "<?= site_url('fmc-work-week'); ?>";
                },
                error: function () {
                    window.location.href = "<?= site_url('fmc-work-week'); ?>";
                }
            });            
        });
    }

    //Get Workweek Group For Update
    function getWorkShift(id){
        show_page_loader();
        $.ajax({
            url: "<?= base_url('fmc_workshift/get');?>",
            method: "POST",
            data: { id : id },
            success : function(response){
                hide_page_loader();
                var obj = JSON.parse(response);
                if(obj.success == 'true'){
                    $("#update_workshift_form input[name*='id']").val(obj.data.id);
                    $("#update_workshift_form input[name*='shift_name']").val(obj.data.shift_name);
                    $("#update_workshift_form input[name*='start_time']").val(obj.data.start_time);
                    $("#update_workshift_form input[name*='end_time']").val(obj.data.end_time);
                    
                    $("#update_workshift").modal("show");
                }else{
                    // notification popup
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = 'toast-bottom-right';    
                    toastr['error']('something went wrong!.');
                }
            },
            error : function(){
                // notification popup
                toastr.options.closeButton = true;
                toastr.options.positionClass = 'toast-bottom-right';    
                toastr['error']('something went wrong!.');
                hide_page_loader();
            }
        });
    }

    //Delete Workshift
    function deleteWorkShift(id){
        swal({
            title: "<?php echo R_U_SURE; ?>",
            text: "<?php echo RECOVER_RECORD; ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "<?php echo YES; ?>",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                url: "<?= site_url('fmc_workshift/delete/'); ?>",
                type: 'post',
                data: {'id': id,'status': 'deleted'},
                success: function (data) {
                    window.location.href = "<?= site_url('fmc-work-shift'); ?>";
                },
                error: function () {
                    window.location.href = "<?= site_url('fmc-work-shift'); ?>";
                }
            });            
        });
    }

</script>

<script type="text/javascript">
    $(function () {

        //Form Validation
        $('#add_new_leave_type_form').parsley();
        $('#update_leave_type_form').parsley();

        $('#add_new_leave_group_form').parsley();
        $('#update_leave_group_form').parsley();

        $('#add_new_holiday_form').parsley();
        $('#update_holiday_form').parsley();

        //Workshift Validation
        $('#add_new_workshift_form').parsley();
        $('#update_workshift_form').parsley();

        $('#add_new_holiday_group_form').parsley();
        $('#update_holiday_group_form').parsley();

        $('#add_new_workweek_form').parsley();
        $('#update_workweek_form').parsley();

        //Color Picker For Leave Type Color
        $('.colorpicker').colorpicker();

    });
</script>
