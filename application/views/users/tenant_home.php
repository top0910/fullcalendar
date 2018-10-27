<style>
.event-tooltip {
    width:150px;
    background: rgba(0, 0, 0, 0.85);
    color:#FFF;
    padding:10px;
    position:absolute;
    z-index:10001;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 11px;

}

.notics{
    background-color: #ffffff;
    max-height: 647px;
    height: 647px;
    overflow-y:scroll;
}

.label-lg{
    font-size: 15px;
    text-align: center;
}

</style>
<link href='<?php echo base_url();?>assets/css/fullcalendar.css' rel='stylesheet' />
<link href="<?php echo base_url();?>assets/css/bootstrapValidator.min.css" rel="stylesheet" />        
<link href="<?php echo base_url();?>assets/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
<!-- Custom css  -->


<?php if($this->session->userdata('user_role') == '0' OR $this->session->userdata('user_role') == '1'): ?>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<?php endif; ?>

<script src="<?php echo base_url();?>assets/js/bootstrapValidator.min.js"></script>
<script src="<?php echo base_url();?>assets/js/fullcalendar.min.js"></script>
<script src='<?php echo base_url();?>assets/js/bootstrap-colorpicker.min.js'></script>
<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />



<!-- Content Wrapper. Contains page content -->
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <center>
                    <?php    
                    if((isset($msg))&& (isset($alert_class)))
                    {
                        echo "<div class=\"alert ". $alert_class ."\">";
                        echo $msg;
                        echo "<a class=\"alink\" href=\"#\" aria-label=\"close\">&times;</a>";
                        echo "</div>";
                    }
                    ?> 
                </center>  
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <div class="notics">
                            <label class="label label-info label-lg".  style="width: 100%; text-align: left; padding-top: 5px;padding-bottom: 5px;" >Building Notice</label>
                            <!-- <p>Scroll Down</p> -->
                            <ul>
                                <br>
                                <?php foreach ($building_notices as $building_notice) :?>
                                    <?php echo  "<li><strong>".$building_notice['created_at']."</strong> <br/> ".$building_notice['notice']."</li>"?>

                                    <?php if(!empty( $building_notice['file_name']))
                                    {?>
                                        <a href="<?php echo $building_notice['file_name']; ?>" class="btn btn-primary btn-xs" >Download File</a><br/>
                                        <?php }?>

                                        <?php echo  "-----------------------"?>
                                    <?php endforeach; ?>
                                </ul>

                            </div>
                            <!-- <p>Scroll Down</p>  -->

                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="box box-info">
                        <div class="box-header with-border">


                            <!-- ****************************************** Request Booking *************************-->

                            <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add"><span class="glyphicon glyphicon-edit"></span> &nbsp;Request Booking</button></td>

                            <div id="add" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add Event/Booking</h4>

                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>


                                        <div class="modal-body">
                                            <?= form_open('user/request_booking') ?>

                                            <div class="form-group">
                                                <label for="">Type of Event/Booking</label>
                                                <select name="title" class="form-control" required/>
                                                <option value="Building Meeting">Building Meeting</option>
                                                <option value="Building Maintenance">Building Maintenance</option>
                                                <option value="Annual General Meeting">Annual General Meeting</option>
                                                <option value="Book Amenity Room">Book Amenity Room</option>
                                                <option value="Move-in/out">Move-in/out</option>
                                                <option value="Other">Other [Describe below]</option>
                                            </select>
                                        </div>                  

                                        <div class="form-group">
                                            <label for="">Description</label>
                                            <input type="text" name="description" class="form-control" placeholder='Please enter contact details or any other useful information' required>
                                        </div>  

<!--                 <div class="form-group">
<label for="">Color</label>
<input type="color" name="color" class="form-control" value="#ff0000" required>
</div>  -->

<div class="form-group">
    <label for="">Select Interval</label>
    <input type="text" name="start_date" value="" />
    <!-- <input type="date" name="start_date" id="datetimepicker" class="form-control" required> -->
</div> 
<!--                                             <div class="form-group">
<label for="">Start Time</label>
<input type="text" name="start_time" class="form-control" placeholder="hh:mm AM/PM" required>
</div> 


<div class="form-group">
<label for="">End Date</label>
<input type="date" name="end_date" id="datepicker" class="form-control" required>
</div> 
<div class="form-group">
<label for="">End Time</label>
<input type="text" name="end_time" class="form-control"  placeholder="hh:mm AM/PM" required>
</div>  -->

<div class="buttons-box clearfix">
    <button class="btn btn-success" type="submit">Submit </button>              
</div>
<?= form_close() ?>
</div>
</div>
</div>
</div>
<!-- ****************************************** Request Booking ******************************************* -->


<div id='calendar'></div>       
<div class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="error"></div>
                <form class="form-horizontal" id="crud-form">
                    <input type="hidden" id="start">
                    <input type="hidden" id="end">
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="title">Title</label>
                        <div class="col-md-4">
                            <input id="title" name="title" type="text" class="form-control input-md" />
                        </div>
                    </div>                            
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="description">Description</label>
                        <div class="col-md-4">
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="color">Color</label>
                        <div class="col-md-4">
                            <input id="color" name="color" type="text" class="form-control input-md" readonly="readonly" />
                            <span class="help-block">Click to pick a color</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
</div>
</div></div></div></div>
</div>      
</div>  




<script>
    $(function(){

var currentDate; // Holds the day clicked when adding a new event
var currentEvent; // Holds the event object when editing an event

$('#color').colorpicker(); // Colopicker


var base_url='<?= base_url(); ?>'; // Here i define the base_url

// Fullcalendar
$('#calendar').fullCalendar({
    header: {
        left: 'prevYear , prev ,today , next, nextYear',
        center: 'title',
        right: 'month, basicWeek, basicDay'
    },
    firstDay:1,
// Get all events stored in database
eventLimit: true, // allow "more" link when too many events
events: base_url+'calendar/getEvents',
selectable: false,
selectHelper: true,
editable: false, // Make the event resizable true           




// Event Mouseover
eventMouseover: function(calEvent, jsEvent, view){

    var tooltip = '<div class="event-tooltip">' + calEvent.description + '</div>';
    $("body").append(tooltip);

    $(this).mouseover(function(e) {
        $(this).css('z-index', 10000);
        $('.event-tooltip').fadeIn('500');
        $('.event-tooltip').fadeTo('10', 1.9);
    }).mousemove(function(e) {
        $('.event-tooltip').css('top', e.pageY + 10);
        $('.event-tooltip').css('left', e.pageX + 20);
    });
},
eventMouseout: function(calEvent, jsEvent) {
    $(this).css('z-index', 8);
    $('.event-tooltip').remove();
},
// Handle Existing Event Click
eventClick: function(calEvent, jsEvent, view) {
// Set currentEvent variable according to the event clicked in the calendar
currentEvent = calEvent;

}

});

// Prepares the modal window according to data passed
function modal(data) {
// Set modal title
$('.modal-title').html(data.title);
// Clear buttons except Cancel
$('.modal-footer button:not(".btn-default")').remove();
// Set input values
$('#title').val(data.event ? data.event.title : '');        
$('#description').val(data.event ? data.event.description : '');
$('#color').val(data.event ? data.event.color : '#3a87ad');
// Create Butttons
$.each(data.buttons, function(index, button){
    $('.modal-footer').prepend('<button type="button" id="' + button.id  + '" class="btn ' + button.css + '">' + button.label + '</button>')
})
//Show Modal
$('.modal').modal('show');
}

// Handle Click on Add Button
$('.modal').on('click', '#add-event',  function(e){
    if(validator(['title', 'description'])) {
        $.post(base_url+'calendar/addEvent', {
            title: $('#title').val(),
            description: $('#description').val(),
            color: $('#color').val(),
            start: $('#start').val(),
            end: $('#end').val()
        }, function(result){
            $('.alert').addClass('alert-success').text('Event added successfuly');
            $('.modal').modal('hide');
            $('#calendar').fullCalendar("refetchEvents");
            hide_notify();
        });
    }
});


// Handle click on Update Button
$('.modal').on('click', '#update-event',  function(e){
    if(validator(['title', 'description'])) {
        $.post(base_url+'calendar/updateEvent', {
            id: currentEvent._id,
            title: $('#title').val(),
            description: $('#description').val(),
            color: $('#color').val()
        }, function(result){
            $('.alert').addClass('alert-success').text('Event updated successfuly');
            $('.modal').modal('hide');
            $('#calendar').fullCalendar("refetchEvents");
            hide_notify();

        });
    }
});



// Handle Click on Delete Button
$('.modal').on('click', '#delete-event',  function(e){
    $.get(base_url+'calendar/deleteEvent?id=' + currentEvent._id, function(result){
        $('.alert').addClass('alert-success').text('Event deleted successfully !');
        $('.modal').modal('hide');
        $('#calendar').fullCalendar("refetchEvents");
        hide_notify();
    });
});

function hide_notify()
{
    setTimeout(function() {
        $('.alert').removeClass('alert-success').text('');
    }, 2000);
}


// Dead Basic Validation For Inputs
function validator(elements) {
    var errors = 0;
    $.each(elements, function(index, element){
        if($.trim($('#' + element).val()) == '') errors++;
    });
    if(errors) {
        $('.error').html('Please insert title and description');
        return false;
    }
    return true;
}
});    
</script>
<script type="text/javascript">
    $(function() {
        $('input[name="start_date"]').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'DD/MM/YYYY h:mm A'
            }
        });
    });
</script>

