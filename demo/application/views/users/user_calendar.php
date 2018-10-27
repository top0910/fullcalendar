
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
<link href='<?php echo base_url();?>assets/css/fullcalendar.css' rel='stylesheet' />
<link href="<?php echo base_url();?>assets/css/bootstrapValidator.min.css" rel="stylesheet" />        
<link href="<?php echo base_url();?>assets/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
<link href="<?= base_url()?>assets/material-pro/assets/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">

<!-- <link href="<?= base_url()?>assets/material-pro/assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"> -->
<!-- Custom css  -->

<script src="<?php echo base_url();?>assets/js/bootstrapValidator.min.js"></script>
<script src="<?php echo base_url();?>assets/js/fullcalendar.min.js"></script>
<script src='<?php echo base_url();?>assets/js/bootstrap-colorpicker.min.js'></script>

<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<script src="<?= base_url()?>assets/material-pro/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<script src="<?= base_url()?>assets/material-pro/assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Clock Plugin JavaScript -->
<script src="<?= base_url()?>assets/material-pro/assets/plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
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
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add" 
                                            style="width: 100%; text-align: left; padding-top: 5px;padding-bottom: 5px;">&nbsp;
                                            <i class="mdi mdi-calendar-plus"></i> 
                                            Request Booking</button>
                            </td>

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
                                                <input type="text" name="description" class="form-control" placeholder='Please enter your Event/Booking details' required>
                                            </div>  


                                            <div class="form-group">
                                                <label for="">Same day event/booking</label>
                                                <input type="radio" id='startdate' name="sameday" value="1" class="form-control"
                                                onclick="enableSameDay()">
                                                <label for="startdate">Yes</label>
                                                <input type="radio" id='startno' name="sameday" value="0" class="form-control"
                                                onclick="disableSameDay()">
                                                <label for="startno">No</label>

                                            </div>

                                        <div class="form-group" id="samedaytime">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">Start Time</label>
                                                    <input type='time' name="start_time" id="start_time" class="form-control ">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">End Time</label>
                                                    <input type='time' name="end_time" id="end_time" class="form-control ">
                                                </div>    
                                            </div>
                                        </div>


                                            <div class="form-group start_date">
                                                <p>Note: To schedule your Event/Booking on the same day click the requested day again to highlight the top right section - this allows you to set your time.</p>
                                                <label for="">Select Interval</label>
                                                <input type="text" name="start_date" value="" id="start_date" />
                                            </div> 

<script>
// hide interval
$('#start_date').attr('disabled','disabled');
$('.start_date').css("display","none");

// hide same day
$('#samedaytime').css("display","none");
$('#start_time').attr('disabled','disabled');
$('#end_time').attr('disabled','disabled');

function enableSameDay()
{
    // hide interval
    document.getElementById("start_date").disabled = true;
    $('.start_date').css("display","none");

    // show same day
    document.getElementById("start_time").disabled = false;
    document.getElementById("end_time").disabled = false;
    $('#samedaytime').css("display","block");
}
function disableSameDay()
{
    // show interval
    document.getElementById("start_date").disabled = false;
    $('.start_date').css("display","block");

    // hide same day
    document.getElementById("start_time").disabled = true;
    document.getElementById("end_time").disabled = true;
    $('#samedaytime').css("display","none");
}
</script>

            <div class="buttons-box clearfix">
                <?php if ($this->current_user_id == 64): ?>
                    <button class="btn btn-success" disabled="true" type="submit">Submit </button>  
                <?php else: ?>
                    <button class="btn btn-success" type="submit">Submit </button> 
                <?php endif; ?>            
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
                        <?php if($this->current_user_role== 0 OR $this->current_user_role== 1 ): ?>
                            <div class="notics">
                                <label class="label label-success label-lg">Booking Requests</label>
                                <!-- <p>Scroll Down</p> -->
                                <ul>
                                    <br>
                                    <?php foreach ($event_requests as $value) :?>
                                        <?php  $unit = $this->global_model->select_single('users',['user_id'=>$value['user_id']]); ?>
                                        <?php echo  "<li><strong>Building Unit: ".$unit['building_unit']."</strong> <br/> ".$value['title']."</li>"?>
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
                    <div class="box-header with-border">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>    

<!-- ********************************* -->
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
                                    <div class="col-md-12">
                                        <input id="title" name="title" type="text" class="form-control input-md" />
                                    </div>
                                </div>                            
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="description">Description</label>
                                    <div class="col-md-12">
                                        <textarea class="form-control" id="description" name="description"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="color">Color</label>
                                    <div class="col-md-12">
                                        
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
editable: false, // Make the event resizable true           
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

eventDrop: false,
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
        $('.event-tooltip').css('left', e.pageX + 0);
    });
},
eventMouseout: function(calEvent, jsEvent) {
    $(this).css('z-index', 8);
    $('.event-tooltip').remove();
},
// Handle Existing Event Click
eventClick: false,

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


        // MAterial Date picker    
        $('#mdate').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
        $('#timepicker').bootstrapMaterialDatePicker({ format: 'HH:mm', time: true, date: false });
        $('#date-format').bootstrapMaterialDatePicker({ format: 'dddd DD MMMM YYYY - HH:mm' });

        $('#min-date').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY HH:mm', minDate: new Date() });


        $('#single-input').clockpicker({
            placement: 'bottom',
            align: 'left',
            autoclose: true,
            'default': 'now'
        });
        $('.clockpicker').clockpicker({
            donetext: 'Done',
        }).find('input').change(function() {
            console.log(this.value);
        });
        $('#check-minutes').click(function(e) {
            // Have to stop propagation here
            e.stopPropagation();
            input.clockpicker('show').clockpicker('toggleView', 'minutes');
        });
        if (/mobile/i.test(navigator.userAgent)) {
            $('input').prop('readOnly', true);
        }

</script>
