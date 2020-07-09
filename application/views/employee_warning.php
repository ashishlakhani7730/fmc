<div id="wrapper">

    <?php include("inc/company_employee_navbar.php") ?>

    <?php include("inc/company_employee_sidebar.php") ?>
 

    <div id="main-content" class="profilepage_1">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> <?php echo WARNING_TITLE ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo site_url() ?>"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active"><?php echo WARNING_TITLE ?></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <input type="hidden" id="offset" value="1">
                        <div class="body" id="warning_list">
                        
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

<script>
$(document).ready(function(){
    var offset = $('#offset').val();
    get_ajax_data(offset);
});
// $('#div1').scrollTop( $('#div1').height() )

// $(window).bind('scroll', function() {
//     if($(window).scrollTop() >= $('#warning_list').offset().top + $('#warning_list').outerHeight() - window.innerHeight) {
//         alert($(window).scrollTop());
//         var offset = $('#offset').val();
//         get_ajax_data(offset);
//     }
// });
function get_ajax_data(offset){
    show_page_loader();
    
        $.ajax({
            url: "<?= base_url('employee_warning/get_warning_list');?>",
            method: "POST",
            data: { offset :offset },
            success : function(response){
                hide_page_loader();
                var obj = JSON.parse(response);
                console.log(obj);
                if(obj.status == 'true'){
                    $('#offset').val(parseInt(offset)+1);
                    $.each( obj.warning_list, function( key, value ) {
                        var html = "";
                        var img = "";
                        $.each( value.document, function( documentkey, document ) {
                            img += '<img class="" style="width: 10%" src="<?php echo site_url() ?>/uploads/'+document.document_file+'" alt="Warning Image">';
                        });
                        html += '<div class="timeline-item animated fadeIn slower warning">'+
                                    '<span class="date">'+value.date_time+'</span>'+
                                    '<h5>'+value.title+'</h5>'+
                                    '<span><a href="javascript:void(0);" title="">'+value.title_en+' '+value.title_ar+'</a> </span>'+
                                    '<div class="msg">'+
                                        '<p>'+value.description+'</p>'+
                                        '<div class="timeline_img m-b-20">'+
                                            img+
                                        '</div>'+
                                    '<div>'+
                                '</div>';
                        $('#warning_list').append(html);
                    });
                }else{

                }
                
            },
            error : function(){
                // notification popup
                // toastr.options.closeButton = true;
                // toastr.options.positionClass = 'toast-bottom-right';    
                // toastr['error']('something went wrong!.');
                hide_page_loader();
            }
        });
}
</script>


