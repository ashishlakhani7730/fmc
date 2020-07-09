<div id="wrapper">

 <?php include("inc/company_navbar.php") ?>

 <?php include("inc/company_sidebar.php") ?>
 
 <link rel="stylesheet" href="<?= site_url(); ?>assets/vendor/hierarchy/hierarchy-view.css">
 <link rel="stylesheet" href="<?= site_url(); ?>assets/vendor/hierarchy/main.css">

<?php
  function print_html(){
    $str = "";

    return $str;
  }
?>

  <div id="main-content">
    <div class="container-fluid">
      <div class="block-header">
        <div class="row">
          <div class="col-lg-6 col-md-8 col-sm-12">
            <h2><a class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo JOB_POSITIONS_TITLE; ?></h2>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item active"><?php echo JOB_POSITIONS_TITLE; ?></li>
            </ul>                        
          </div>            
          <div class="col-lg-6 col-md-4 col-sm-12 text-right">
            <a href="<?= site_url(); ?>jobpositions/create" class="btn btn-info"><?php echo JOB_POSITIONS_ADD; ?></a>
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
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#position_list_view"><?php echo JOB_POSITIONS_LIST_VIEW; ?></a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#position_tree_view"><?php echo JOB_POSITIONS_TREE_VIEW; ?></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane show active" id="position_list_view">
                  <div class="table-responsive">
                    <table class="table table-hover js-basic-example dataTable table-custom m-b-0">
                      <thead>
                        <tr>
                          <th><?php echo JOB_POSITIONS_JOB_TITLE; ?></th>
                          <th><?php echo JOB_POSITIONS_DESIGNATION; ?></th>
                          <th><?php echo JOB_POSITIONS_EMPLOYEE_NAME; ?></th>
                          <th><?php echo JOB_POSITIONS_STATUS; ?></th>
                          <th>***</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                      if(!empty($items)){
                      foreach ($items as $key => $value) { ?>
                        <tr>                                        
                        <td><?php echo $value['job_title']; ?></td>
                        <td>
                            <?php echo $value['designation_name'] ?>
                        </td>
                        <td><?php echo $value['emp_fullname_english'] ?></td>
                        <td>
                            <a style="cursor: pointer;" class="badge badge-default"><?php echo $value['status']; ?></a>
                        </td>
                        <td>
                             <a href="<?= site_url(); ?>jobpositions/update/<?= base64_encode($value['id']);?>" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>
                           
                            <button type="button" onclick="deleteItem('<?php echo $value['id']; ?>');" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fa fa-trash-o"></i></button>
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
                <div class="tab-pane show" id="position_tree_view">
                  <section class="management-hierarchy">
                    <style type="text/css">
                      .hv-container::-webkit-scrollbar { 
                          display: none; 
                      } 
                    </style>
                    <div class="hv-container">
                        <div class="hv-wrapper">
                          <?php
                         
                          function get_child($array){
                            $str = "";
                            if(is_array($array)){
                              
                              foreach ($array as $child_value) {

                                if($child_value['emp_profile_pic'] && file_exists("uploads/".$child_value['emp_profile_pic'])){
                                    $emp_profile_pic = $child_value['emp_profile_pic'];
                                }else{
                                    $emp_profile_pic = "user_default.png";
                                }

                                if($child_value['emp_fullname_english'] == null && $child_value['status'] == 'open'){
                                  $emp_fullname_english = '<a style="cursor: pointer;" class="badge badge-danger">OPEN POSITION</a>';
                                  $position_status = "open-position";  

                                  $a_link = site_url().'employees/company_employees_create_step_1';

                                }else{
                                  $emp_fullname_english = $child_value['emp_fullname_english'];
                                  $position_status = "";
                                  $a_link = site_url().'employees/view/'.base64_encode($child_value['emp_id']);
                                }
                                

                                $str .= '<div class="hv-item-child">';
                                if(!empty($child_value['children'])){
                                  $str .= '<div class="hv-item">';  
                                  $str .= '<div class="hv-item-parent">';
                                  $str .= '<div class="person '.$position_status.'">';

                                  $str .= '<a target="_blank" href="'.$a_link.'">';

                                  $str .= '<img src="'.site_url().'uploads/'.$emp_profile_pic.'" alt="">';
                                  
                                  $str .= '</a>';

                                  $str .= '<p class="name">'.$emp_fullname_english.'<b>/'.$child_value['designation_name'].' '.$child_value['job_id'].'</b></p>';
                                  $str .= '</div>';
                                  $str .= '</div>';

                                  $str .= '<div class="hv-item-children">';
                                  $str .= get_child($child_value['children']);
                                  $str .= "</div>"; //hv-item-children

                                  $str .= '</div>';  //hv-item
                                }else{
                                  $str .= '<div class="person '.$position_status.'">';

                                  $str .= '<a target="_blank" href="'.$a_link.'">';
                                  $str .= '<img src="'.site_url().'uploads/'.$emp_profile_pic.'" alt="">';
                                  $str .= '</a>';

                                  $str .= '<p class="name">'.$emp_fullname_english.'<b>/'.$child_value['designation_name'].' '.$child_value['job_id'].'</b></p>';
                                  $str .= '</div>';
                                }
                                $str .= '</div>';  //hv-item-child
                              }
                              
                            }else{
                              if($array['emp_profile_pic'] && file_exists("uploads/".$array['emp_profile_pic'])){
                                $emp_profile_pic = $array['emp_profile_pic'];
                              }else{
                                  $emp_profile_pic = "user_default.png";
                              }

                              if($array['emp_fullname_english'] == null || $array['status'] == 'open'){
                                $emp_fullname_english = '<a style="cursor: pointer;" class="badge badge-danger">OPEN POSITION</a>';  
                                $position_status = "open-position";  
                                $a_link = site_url().'employees/company_employees_create_step_1';
                              }else{
                                $emp_fullname_english = $array['emp_fullname_english'];
                                $position_status = ""; 
                                $a_link = site_url().'employees/view/'.base64_encode($array['emp_id']); 
                              }

                              $str .= '<div class="hv-item">';
                              
                                $str .= '<div class="person '.$position_status.'">';

                                  $str .= '<a target="_blank" href="'.$a_link.'">';

                                  $str .= '<img src="'.site_url().'uploads/'.$emp_profile_pic.'" alt="">';

                                  $str .= '</a>';

                                  $str .= '<p class="name">'.$emp_fullname_english.'<b>/'.$array['designation_name'].' '.$array['job_id'].'</b></p>';
                                $str .= '</div>'; //person

                                $str .= '<div class="hv-item-children">';

                                $str .= "</div>"; //hv-item-children

                              $str .= "</div>"; //hv-item
                            }
                            return $str;
                          }

                          //echo recursive($tree_view_data);



                          foreach ($tree_view_data as $value) {

                            if($value['emp_profile_pic'] && file_exists("uploads/".$value['emp_profile_pic'])){
                                $emp_profile_pic = $value['emp_profile_pic'];
                            }else{
                                $emp_profile_pic = "user_default.png";
                            }                 

                              

                            if(empty($value['emp_fullname_english']) || $value['status'] == 'open'){
                              $emp_fullname_english = '<a style="cursor: pointer;" class="badge badge-danger">OPEN POSITION</a>'; 
                              $position_status = "open-position";   
                              $a_link = site_url().'employees/company_employees_create_step_1';
                            }else{
                              $emp_fullname_english = $value['emp_fullname_english'];
                              $position_status = "";  
                              $a_link = site_url().'employees/view/'.base64_encode($value['emp_id']);
                            }          
                          ?>
                          <div class="hv-item">
                            <?php 
                            if(!empty($value['children'])){

                            ?>
                              <div class="hv-item-parent">
                                  <div class="person <?php echo $position_status; ?>">
                                      <a target="_blank" href="<?php echo $a_link; ?>">
                                      <img src="<?= site_url(); ?>uploads/<?php echo $emp_profile_pic; ?>" alt="">
                                      </a>
                                      <p class="name">
                                      <?php echo $emp_fullname_english; ?> <b>/ <?php echo $value['designation_name']; ?> <?php echo $value['job_id']; ?></b>
                                      </p>
                                  </div>
                              </div>
                              <div class="hv-item-children">
                              <?php 
                                echo get_child($value['children']);
                              ?>
                              </div>
                            <?php
                            }else{
                            ?>
                            <div class="person <?php echo $position_status; ?>">
                                <a target="_blank" href="<?php echo $a_link; ?>">
                                <img src="<?= site_url(); ?>uploads/<?php echo $emp_profile_pic; ?>" alt="">
                                </a>
                                <p class="name">
                                  <?php echo $emp_fullname_english; ?> <b>/ <?php echo $value['designation_name']; ?> <?php echo $value['job_id']; ?></b>
                                </p>
                            </div>
                            <?php } ?>
                          </div>
                          <?php
                          }

                          ?>

                        </div>
                    </div>
                  </section>
                </div>
              </div>
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

<!-- bootstrap treeview -->
<script src="<?= site_url(); ?>assets/vendor/bootstrap-treeview/bootstrap-treeview.min.js"></script>

<!-- SweetAlert For Dialog Box --> 
<script src="<?= site_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script> 

<!-- assets/js/common.js - Common Javascript Init Fnction -->
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
<!-- common Javascript Function -->
<script src="<?= site_url(); ?>assets/js/app.js"></script> 


<script type="text/javascript">

function deleteItem(id)
{
    swal({
            title: "<?php echo R_U_SURE; ?>",
            text: "<?php echo RECOVER_RECORD; ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "<?php echo YES; ?>",
            closeOnConfirm: false
    }, function () {
        show_page_loader();
        $.ajax({
            url: "<?= site_url('jobpositions/delete/'); ?>",
            type: 'post',
            data: {'id': id,'status': 'deleted'},
            success: function (data) {
                hide_page_loader();
                location.reload();
            },
            error: function () {    
                hide_page_loader();
            }
        });
    });
}
</script>
<script type="text/javascript">
    $(function () {      
        //display tree view data                 
    });
</script>