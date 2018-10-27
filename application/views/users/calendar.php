
<style>
.event-tooltip {
    width:150px;
    background: #f3f4f8;
    /*background: rgba(240, 240, 240, 0.85);*/
    color:#000;
    
    border: 1px solid black;
    padding:10px;

    position:absolute;
    z-index:10001;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    /*font-family: Times-new-roman;*/

}

.notics{
    background-color: #ffffff;
    max-height: 618px;
    height: 618px;
    overflow-y:scroll;
}

.label-lg{
    font-size: 15px;
    text-align: center;
}


</style>

<!-- Date picker plugins css -->
    <link href="<?= base_url()?>assets/material-pro/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <script src="<?= base_url()?>assets/material-pro/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>



<div class="page-wrapper">
    <div class="container-fluid">

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-lg-4">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <?php if($this->current_user_role== 2 OR $this->current_user_role== 3 ): ?>
                                <!-- ****************************************** Request Booking *************************-->
                                <div class="notics">    
                                    <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add" ><span class="glyphicon glyphicon-edit"></span> &nbsp; Request Booking</button></td>

                                    <div id="add" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myLargeModalLabel">Add Event/Booking</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
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

<div class="form-group">
    <label for="">Start Date</label>
    <input type="date" name="start_date" id="datetimepicker" class="form-control" required>
</div> 
<div class="form-group">
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
</div> 
<div class="buttons-box clearfix">
    <button class="btn btn-success" type="submit">Submit </button>              
</div>
<?= form_close() ?>
</div>
</div>
</div>
</div> 
<!-- <p>Scroll Down</p> -->
<ul>
    <br>
    <?php foreach ($current_user_e_req as $value) :?>
        <?php echo  "<li>".$value['title']."</li>"?>
        <?php  if($value['status'] == 0){$status = 'Rejected';}elseif($value['status'] == 1){$status = 'Accepted';}elseif($value['status'] == 2){$status = 'Waiting';}   ?>
        <strong>Status: </strong><?= $status; ?><br/>
        <?php echo  "-----------------------"?>
    <?php endforeach; ?>
</ul>

</div>
<!-- ****************************************** Request Booking ******************************************* -->



<?php endif; ?>
<?php if($this->current_user_role== 0 OR $this->current_user_role== 1   OR $this->current_user_role == '4'): ?>
    <div class="notics">
        <label class="label label-info label-lg"  style="width: 100%; text-align: left; padding-top: 5px;padding-bottom: 5px;"> Booking Requests</label>
        <!-- <p>Scroll Down</p> -->
        <ul>
            <br>
            <?php foreach ($event_requests as $value) :?>
                <?php  $unit = $this->global_model->select_single('users',['user_id'=>$value['user_id']]); ?>
                <?php echo  "<li><strong>Unit: ".$unit['building_unit']."</strong> <br/> ".$value['title']."</li>"?>
                <?php  if($value['status'] == 0){$status = 'Rejected';}elseif($value['status'] == 1){$status = 'Accepted';}elseif($value['status'] == 2){$status = 'Waiting';}   ?>
                <strong>Status: </strong><?= $status; ?><br/>
                <?php echo  "-----------------------"?>
            <?php endforeach; ?>
        </ul>

    </div>
<?php endif; ?>
</div>
</div>
</div>

<div class="col-lg-8">
    <div class="box box-info">

<!-- ****************************************** Request Booking *************************-->

<td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add">
    <i class="mdi mdi-pencil-box-outline"></i> &nbsp;Add Event/Booking</button></td>

    <div id="add" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Event/Booking</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <?= form_open('user/admin_request_booking') ?>
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
                <div class="form-group">
                    <label for="">Select Interval</label>
                    <input type="date" name="startdate" id='date' class="form-control" required="true">
                </div> 
                <div class="form-group">
                    <span class="help-block">Pick a color</span>
                    <select  name="color" class="form-control input-md" readonly="readonly" />
                    <option value="#e6194b">Red</option>
                    <option value="#3cb44b">Green</option>
                    <option value="#ffe119">Yellow</option>
                    <option value="#0082c8">Blue</option>
                    <option value="#f58231">Orange</option>
                    <option value="#46f0f0">Cyan</option>
                    <option value="#008080">Teal</option>
                    <option value="#aa6e28">Brown</option>
                    <option value="#808000">Olive</option>
                    <option value="#808080">Grey</option>
                </select>
            </div>

            <div class="buttons-box clearfix">
                <button class="btn btn-success" type="submit">Submit </button>              
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
</div>
<!-- ****************************************** Request Booking ******************************************* -->

        <div class="box-header with-border">
            <div id='calendar'></div>
        </div>
    </div>
</div>

</div>
</section>
</div>    

<!-- ****************** PAGE ENDS - POPUP MODEL STARTS *************** -->
<div class="modal fade add_event">
    <div class="modal-dialog">
        <div class="modal-content">
<!--                         <div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title"></h4>
</div> -->

<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">Add Event/Booking</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>


<div class="modal-body">
    <div class="error"></div>
    <form class="form-horizontal" id="crud-form">
        <input type="hidden" id="start">
        <input type="hidden" id="end">
        <div class="form-group">
            <label class="col-md-4 control-label" for="title">Title</label>
            <div class="col-md-12">
                <input id="title" name="title" type="text" class="form-control input-md" />
            </div>
        </div>                            
        <div class="form-group">
            <label class="col-md-12 control-label" for="description">Description</label>
            <div class="col-md-12">
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="color">Color</label>
            <div class="col-md-12">
                <!-- <input id="color" name="color" type="text" class="form-control input-md" readonly="readonly" /> -->
                <span class="help-block">Click to pick a color</span>
                <select  name="color" id="color" class="form-control input-md" readonly="readonly" />
                <option value="#e6194b">Red</option>
                <option value="#3cb44b">Green</option>
                <option value="#ffe119">Yellow</option>
                <option value="#0082c8">Blue</option>
                <option value="#f58231">Orange</option>
                <option value="#46f0f0">Cyan</option>
                <option value="#008080">Teal</option>
                <option value="#aa6e28">Brown</option>
                <option value="#808000">Olive</option>
                <option value="#808080">Grey</option>
            </select>
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
<!-- ********************************* ********* -->


<script>
    $(function(){

var currentDate; // Holds the day clicked when adding a new event
var currentEvent; // Holds the event object when editing an event

// $('#color').colorpicker(); // Colopicker


var base_url='<?= base_url(); ?>'; // Here i define the base_url
// var base_url='http://127.0.0.1/strata_new/'; // Here i define the base_url

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
selectable: true,
selectHelper: true,
editable: true, // Make the event resizable true           
select: function(start, end) {

    $('#start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
    $('#end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
// Open modal to add event
modal({
// Available buttons when adding
buttons: {
    add: {
id: 'add-event', // Buttons id
css: 'btn-success', // Buttons class
label: 'Add' // Buttons label
}
},
title: 'Add Event' // Modal title
});
}, 

eventDrop: function(event, delta, revertFunc,start,end) {  

    start = event.start.format('YYYY-MM-DD HH:mm:ss');
    if(event.end){
        end = event.end.format('YYYY-MM-DD HH:mm:ss');
    }else{
        end = start;
    }         

    $.post(base_url+'calendar/dragUpdateEvent',{                            
        id:event.id,
        start : start,
        end :end
    }, function(result){
        $('.alert').addClass('alert-success').text('Event updated successfuly');
        hide_notify();


    });



},
eventResize: function(event,dayDelta,minuteDelta,revertFunc) { 

    start = event.start.format('YYYY-MM-DD HH:mm:ss');
    if(event.end){
        end = event.end.format('YYYY-MM-DD HH:mm:ss');
    }else{
        end = start;
    }         

    $.post(base_url+'calendar/dragUpdateEvent',{                            
        id:event.id,
        start : start,
        end :end
    }, function(result){
        $('.alert').addClass('alert-success').text('Event updated successfuly');
        hide_notify();

    });
},

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

// Open modal to edit or delete event
modal({
// Available buttons when editing
buttons: {
    delete: {
        id: 'delete-event',
        css: 'btn-danger',
        label: 'Delete'
    },
    update: {
        id: 'update-event',
        css: 'btn-success',
        label: 'Update'
    }
},
title: 'Edit Event "' + calEvent.title + '"',
event: calEvent
});
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
// $('#color').val(data.event ? data.event.color : '#3a87ad');
// Create Butttons
$.each(data.buttons, function(index, button){
    $('.modal-footer').prepend('<button type="button" id="' + button.id  + '" class="btn ' + button.css + '">' + button.label + '</button>')
})
//Show Modal
$('.add_event').modal('show');
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


<script>
    $(document).ready(){
        jQuery('#datetimepicker').datetimepicker();
    }
</script>

