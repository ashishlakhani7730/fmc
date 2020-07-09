<div id="wrapper">

    <?php include("inc/company_employee_navbar.php") ?>    
    <?php include("inc/company_employee_sidebar.php") ?>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a><?php echo CALENDER_TITLE; ?></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(); ?>dashboard"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">
                                <a href="<?= site_url(); ?>calender" class="active"><i class="icon-calendar"></i> <?php echo CALENDER_VIEW; ?></a>
                            </li>                            
                        </ul>
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                                             
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="body">
                            <?php foreach ($items as $value) { ?>
                            <div class="event-name row">
                                <div class="col-2 text-center">
                                    <h4><?php echo date('d',strtotime($value['event_start_date'])); ?><span><?php echo date('M',strtotime($value['event_start_date'])); ?></span><span><?php echo date('Y',strtotime($value['event_start_date'])); ?></span></h4>
                                </div>
                                <div class="col-10">
                                    <h6><?php echo $value['event_title']; ?></h6>
                                    <p><?php echo strip_tags($value['event_title']); ?></p>
                                </div>
                            </div>                            
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Javascript -->
<script src="<?= site_url(); ?>assets/bundles/libscripts.bundle.js"></script>
<script src="<?= site_url(); ?>assets/bundles/vendorscripts.bundle.js"></script>
<script src="<?= site_url(); ?>assets/bundles/fullcalendarscripts.bundle.js"></script>
<script src="<?= site_url(); ?>assets/vendor/fullcalendar/fullcalendar.js"></script>
<script src="<?= site_url(); ?>assets/vendor/toastr/toastr.js"></script>
<script src="<?= site_url(); ?>assets/bundles/mainscripts.bundle.js"></script>

<script type="text/javascript">
    var events = <?php echo json_encode($events) ?>;
    
    var date = new Date();
    var y    = date.getFullYear()
        m    = date.getMonth(),
        d    = date.getDate();
           
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listWeek'
        },
        defaultDate: date,
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar
        drop: function() {
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove();
            }
        },
        eventLimit: true, // allow "more" link when too many events

        events: events
    });
</script>