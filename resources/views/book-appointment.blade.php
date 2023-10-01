<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Book Appointment</title>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
    <link rel="stylesheet" href="{{ asset('back/assets/css/mark-your-calendar.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <style>
        .center {
            border-radius: 25px;
            margin: 10px;
            height: 650px;
            border: 2px solid #556ee6;
            padding: 20px;
            background:#fcfcfc;
        }
        .input {
            border-radius: 25px;
            border: 1px solid #495057;
            padding: 20px; 
            width: 300px;
            height: 10px;
            margin:20px;    
        }

        .button {
          background-color: #556ee6;
          border: none;
          color: white;
          padding: 20px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          margin: 4px 2px;
        }
        .alert {
          padding: 20px;
          background-color: #04AA6D; /* Red */
          color: white;
          margin-bottom: 15px;
          width:500px;
          margin-left:35%;
          border-radius: 12px;
        }

        /* The close button */
        .closebtn {
          margin-left: 15px;
          color: white;
          font-weight: bold;
          float: right;
          font-size: 22px;
          line-height: 20px;
          cursor: pointer;
          transition: 0.3s;
        }

        /* When moving the mouse over the close button */
        .closebtn:hover {
          color: black;
        }


        .button4 {border-radius: 12px;}

        .timezones {
          height:100%;
          padding:15px;
        }
        .picker {
          float:left;
        }
        .myc-date-header {
            width: auto;
        }
        .dt {
          padding:10px;
          font-weight:bold;
          display:block;
          margin-bottom:5px;
        }
        .error {
          color: red;
          margin-bottom: 10px;
          padding-left: 10px;
        }

        .alert-error {
          padding: 20px;
          background-color: #ff0000;
          color: white;
          margin-bottom: 15px;
          width: 500px;
          margin-left: 35%;
          border-radius: 12px;
        }
        .book_appointment {
          height:650px;
        }
        /* .slot-disabled {
          opacity:0.5;
          pointer-events:none;
          background-color: #d3d3d3;
          border: #d3d3d3;
        } */

        .heading-css {
          text-align:center;
          margin-bottom:20px;
        }
        .bookappointmentform {
            width: 70%;
        }
        .existingappointments {
            width: 30%;
        }
        .allappoimentsbox {
              display: flex;
          }
        .title-ea {
          text-align: center;
          margin-bottom: 0;
          margin-top: 45px;
        }
        .left{
          border-radius: 25px 10px 10px 25px;
          margin: 10px;
          height: 650px;
          max-height: 650px;
          border: 2px solid #556ee6;
          padding: 20px;
          background: #fff;
        }

        .appt-card {
          border: 2px solid #04AA6D;
          border-radius:10px;
          margin-bottom: 10px;
          background-color:#f7f7f7;
        }
        .appt-card-body {
          padding-left: 10px;
        }
        .appt-u-title {
          margin-bottom: 0px;
        }

        .left::-webkit-scrollbar {
          background: #eee;
          width: 10px;
          border-radius:10px;
        }
        .left::-webkit-scrollbar-track {
          margin-right:15px;
        }
        .left::-webkit-scrollbar-thumb {
          padding: 0 4px;
          border-right: 0px solid transparent;
          border-left: 0px solid transparent;
          background: #909090;
          background-clip: padding-box;
          border-radius: 100px;
          /* &:hover {
            background: #606060;
          } */
        }
        .c-inner-text {
          color: #04AA6D;
        }

        .appt-buttons {
          margin-bottom:10px;
          display: flex;
          justify-content: center;
        }

        .cancel-btn {
          border : 2px solid #ff0000;
          border-radius:25px;
          padding : 10px 20px 10px 20px;
          color: #ff0000;
          cursor: pointer;
          margin-right: 5px;
        }

        .reschedule-btn {
          border : 2px solid #04AA6D;
          border-radius:25px;
          padding : 10px 20px 10px 20px;
          color: #04AA6D;
          cursor: pointer;
          margin-left: 5px;
        }

        .hide {
          display:none;
        }
        .s-msg {
          background: #04AA6D;
          color: #fff;
          padding: 12px;
          border-radius: 10px;
          display:none;
          text-align: center;
          margin: 0 auto;
          width:40%;
        }
        .e-msg {
          background: #ff0000;
          color: #fff;
          padding: 12px;
          border-radius: 10px;
          display:none;
          text-align: center;
          margin: 0 auto;
          width:40%;
        }
        .cal-div {
          display:flex;
          justify-content:center;
        }
        .left.appointments-sec {
            border-radius: 25px;
        }
        .left.appointments-sec .appt-buttons {
            justify-content: flex-end;
            padding-right: 8px;
        }
        .mainbookappointment {
            display: flex;
        }
        .bookappominetimezone {
            width: 50%;
        }
        .bookappoimetform {
            width: 50%;
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            align-content: flex-end;
        }
        @media (max-width: 1200px) {
          .book_appointment {
            height: auto;
        }
        .mainbookappointment {
            display: flex;
            flex-direction: column;
        }
        .center.bookappimentform {
            height: auto ;
        }
        .bookappominetimezone {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            align-content: center;
        }
        .bookappoimetform {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            align-content: center;
            padding-top: 25px;
        }
        .bookappointmentform {
            width: 50%;
        }
        .existingappointments {
            width: 50%;
        }
        .bookappoimetform .form-group:last-child {
            display: flex;
            align-content: center;
            align-items: center;
            flex-direction: column;
        }
        }
        @media (max-width: 768.98px) {
          .allappoimentsbox {
            display: flex;
            flex-direction: column;
        }  
          .existingappointments {
            width: 100%;
        }
        .bookappointmentform {
            width: 100%;
        }
        .allappoimentsbox h1.heading-css {
            font-size: 24px;
        }

        .left.appointments-sec {
            height: auto;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            flex-direction: column;
        }
        .left.appointments-sec .appt-card {
            margin-bottom: 0px;
        }
        }
        @media (max-width: 425.98px) {
          .allappoimentsbox .picker {
            float: inherit;
        }
        .center.bookappimentform {
            padding: 25px 0px;
        }
        .allappoimentsbox .myc-day-time-container {
            width: 13%;
        }
        .allappoimentsbox #myc-next-week {
            border: 1px solid #000000;
            color: #000000;
            height: 20px;
            width: 20px;
            font-size: 1.1em;
        }
        .allappoimentsbox #myc-prev-week {
            border: 1px solid #000000;
            color: #000000;
            font-size: 1.1em;
            height: 20px;
            width: 20px;
        }
        .book_appointment {
            height: auto;
        }
        }
        @media (max-width: 400.98px) {
          .bookappoimetform  .form-group {
            display: flex;
            flex-direction: column;
            align-content: center;
        }
        .bookappoimetform .form-group .input {
            width: 280px;
        }
        .allappoimentsbox #myc-week-container {
            width: fit-content;
            margin: auto;
        }
        .bookappoimetform .form-group .input {
            margin: 0px 5px 14px 5px;
        }
        .allappoimentsbox #myc-nav-container {
            display: flex;
            justify-content: center;
        } 
        .mainbookappointment .bookappoimetform .input-group {
            text-align: center;
        }
        }
        @media (max-width: 375.98px) {
          .bookappoimetform .form-group .input {
            width: 260px;
        }
        .allappoimentsbox .myc-date-header {
            padding: 10px;
        }
        .allappoimentsbox #myc-prev-week-container {
            display: contents;
        }
        }
        @media (max-width: 320.98px) {
          .bookappoimetform .form-group .input {
            width: 215px;
          }
          .bookappominetimezone .form-group .input {
            width: 230px;
          }
          .allappoimentsbox .myc-date-header {
            padding: 6px;
          }
          .allappoimentsbox .myc-day-time-container {
            width: 12.7%;
          }
          .allappoimentsbox .myc-available-time {
            font-size: 10px;
            font-weight: 600;
          }
        }

    </style>
</head>

<body style="font-family: sans-serif;">
  <!-- <div class="main"> -->
    <div class="s-msg"></div>   
    <div class="e-msg"></div>
    @if(session('success'))
      <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{ session('success') }}
      </div>
    @elseif(session('error'))
      <div class="alert-error">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{ session('error') }}
      </div>
    @endif

    <div class="allappoimentsbox">
      <div class="existingappointments">
        <h1 class="heading-css">Existing Appointments</h3>
        <div class="left appointments-sec existing_appointments">
            
        </div>
      </div>
      <div class="bookappointmentform">
        <h1 class="heading-css">Book Appointment</h1>
        <div class="center bookappimentform">
          
          <form class="book_appointment" method="POST" action="{{ route('appointments.store') }}">
            @csrf
            <input type="hidden" class="uid" name="uid" value="{{$uid}}" required>
            <div class="mainbookappointment">
              <div class="bookappominetimezone">
                <div class="form-group">
                  <label style="padding:10px;font-weight:bold">Time Zone</label>
                  <div class="input-group">
                    <select class="input form-control timezones" name="timezone" required>
                    </select>
                    @error('timezone')
                      <div class="error">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div  class="form-group">
                  <label class="dt">Select Date Time</label>
                  <input type="hidden" class="appt_date" name="appt_date" value="{{old('appt_date')}}" required>
                  <input type="hidden" class="appt_time" name="appt_time" value="{{old('appt_time')}}" required>
                  <div class="calendar-div">
                  
                    @error('appt_date')
                              <div class="error">{{ $message }}</div>
                    @enderror
                    @error('appt_time')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <div class="picker"></div>

                  </div>
                </div>
              </div>
              <div class="bookappoimetform">
                <div  class="form-group">
                  <label style="padding:10px;font-weight:bold">Full Name</label>
                  <div class="input-group">
                    <input type="text"  class="input name" placeholder="Full Name"
                      name="name" id="name" value="{{old('name')}}"  required>
                    @error('name')
                      <div class="error">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <label style="padding:10px;font-weight:bold">Mobile</label>
                  <div class="input-group">
                    <input type="tel"  class="input mobile" placeholder="Mobile"
                      name="mobile" id="mobile" value="{{old('mobile')}}" minlength="11" maxlength="15" required>
                    @error('mobile')
                      <div class="error">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <label style="padding:10px;font-weight:bold">Email</label>
                  <div class="input-group">
                    <input type="email" class="input email" placeholder="Email"
                      name="email" id="email" value="{{old('email')}}" required>

                    @error('email')
                      <div class="error">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <label style="padding:10px;font-weight:bold">What do you hope to get out of this call?</label>
                  <div class="input-group">
                    <textarea type="text"  class="input description" style="height:100px" placeholder="What do you hope to get out of this call?"
                      name="description" id="description" required>{{old('description')}}</textarea>
                    
                    @error('description')
                      <div class="error">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="button button4">Confirm Booking</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Cancel appointment modal -->
    <div class="cancel_appt_modal hide" title="Cancel Appointment">
        <div class="modal-body">  
               
            <p>Are you sure you want to cancel this appointment?</p>
        </div>
    </div>
    <!-- End of Cancel appointment modal -->

    <!-- Reschedule Appointment modal -->
    <div class="reschedule_appt_modal hide" title="Reschedule Appointment">
        <div class="modal-body">  
          <p><strong>Please select date and time for reschedule appointment.</strong></p>
          <div class="cal-div">
            <!-- <input type="hidden" class="reschedule_time" name="reschedule_time" value="">
            <input type="hidden" class="reschedule_date" name="reschedule_date" value=""> -->
            <div class="picker"></div>
          </div>
        </div>
    </div>
    <!-- End of Reschedule Appointment modal -->
  <!-- </div> -->

  <script src="//code.jquery.com/jquery-3.7.1.min.js"></script> 
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script> -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
  <script src="{{ asset('back/assets/js/pages/timezones.full.js') }}"></script>
  <script src="{{ asset('back/assets/js/pages/mark-your-calendar.js') }}"></script>

  <script>
    $(document).ready(function() {

      console.log("timezone");
      console.log(moment().format('Z'));

      // setup ajax token
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      // init timezones
      $('.timezones').timezones();
      
      // booked slots are fetched from google calendar
      var bookingDays = {!! $bookedSlots !!};

      // slots to be shown to user in the calendar.
      var allSlots = [
        ['01:00', '02:00', '03:00', '04:00', '05:00'],
        ['01:00', '02:00', '03:00', '04:00', '05:00'],
        ['01:00', '02:00', '03:00', '04:00', '05:00'],
        ['01:00', '02:00', '03:00', '04:00', '05:00'],
        ['01:00', '02:00', '03:00', '04:00', '05:00'],
        ['01:00', '02:00', '03:00', '04:00', '05:00'],
        ['01:00', '02:00', '03:00', '04:00', '05:00']
      ];

      // function to hide booked time slots
      function hideBookedTimeSlots() {
        $.each(bookingDays, function(index, day) {
          $.each(day, function (key, slot) {
            // disbale slots based on attribute value of anchor tag
            $('.myc-day-time-container a[data-time="'+slot.appt_time+'"][data-date="'+slot.appt_date+'"]').hide();
          });
        });
      }

      // function of calendar
      (function($) {
        $('.picker').markyourcalendar({
          availability: allSlots,
          isMultiple: false,
          onClick: function(ev, data) {
            // data is a list of datetimes
            $('.myc-available-time').css({'pointer-events':'all', 'opacity':'1'});
            var html = ``;
            $.each(data, function() {
              var d = this.split(' ')[0];
              var t = this.split(' ')[1];
              // setting values of date & time in input fields
              $('.appt_date').val(d);
              $('.appt_time').val(t);
            });

            // $('#selected-dates').html(html);
          },
          onClickNavigator: function(ev, instance) {
            // var rn = Math.floor(Math.random() * 10) % 7;
            instance.setAvailability(allSlots);

            hideBookedTimeSlots();
          }

          
        });

        // Hide booked slots when the slot picker is rendered for the first time.
        hideBookedTimeSlots();

      })(jQuery);
        
        
    });
  </script>


  <script>
    
    // open modal when click on cancel button
    $(document).on('click','.cancel-btn',function(){
      var appt_id = $(this).attr('data-appt_id'); // appointment id
      $( ".cancel_appt_modal" ).dialog({
        width: 500,
        draggable: false,
        modal:true,
        create: function( event, ui ) {
          $('body').css({overflow: 'hidden'})
        },
        beforeClose: function(event, ui) {
          $('body').css({ overflow: 'inherit' })
        },
        buttons: {
          "Yes": function() {
            // alert(appt_id);
            // Ajax for cancelling appointment
            $.ajax({
                type: "POST",
                url: "{{ route('appointments.cancelAppointment') }}",
                data: {id: appt_id},
                dataType: "json",
                success: function(data) {
                      console.log(data);
                    // Ajax call completed successfully
                    if(data.success == 1) {
                        $('.cancel_appt_modal').dialog( "close" );
                        $('.s-msg').html(data.message);
                        $('.s-msg').show();
                        $('.e-msg').hide();

                        setTimeout(() => {
                          window.location.reload();
                          
                        }, 2500);

                        
                    } else {
                        $('.cancel_appt_modal').dialog( "close" );
                        $('.s-msg').hide();
                        $('.e-msg').html(data.message);
                        $('.e-msg').show();

                    }

                },
                error: function(data) {
                      
                    // Some error in ajax call
                    $('.cancel_appt_modal').dialog( "close" );
                    $('.s-msg').hide();
                    $('.e-msg').html(data.message);
                    $('.e-msg').show();
                }
            });


          },
          "No": function() {
            $( this ).dialog( "close" );
          }
        }
      });
      
    });


    // open modal when click on cancel button
    $(document).on('click','.reschedule-btn',function(){
      var appt_id = $(this).attr('data-appt_id'); // appointment id
      var previousDate = $('.previous_date').val();
      // alert(previousDate);
      var previousTime = $('.previous_time').val();
      // alert(previousTime);      
      // $('.reschedule_appt_modal modal-body').find('.myc-available-time').addClass('selected');
      $( ".reschedule_appt_modal" ).dialog({
        width: 500,
        draggable: false,
        modal:true,
        create: function( event, ui ) {
          $('body').css({overflow: 'hidden'});
          $(this).find('a[data-time="'+previousTime+'"][data-date="'+previousDate+'"]').removeAttr('style');
          $(this).find('a[data-time="'+previousTime+'"][data-date="'+previousDate+'"]').css({'pointer-events':'none','opacity':'0.5'});
          $(this).find('a[data-time="'+previousTime+'"][data-date="'+previousDate+'"]').addClass('selected');
        },
        beforeClose: function(event, ui) {
          $('body').css({ overflow: 'inherit' });
          $(this).find('a').removeClass('selected');
          $(this).find('a[data-time="'+previousTime+'"][data-date="'+previousDate+'"]').css({'pointer-events':'none','opacity':'0.5'});
          $(this).find('a[data-time="'+previousTime+'"][data-date="'+previousDate+'"]').addClass('selected');

        },
        buttons: {
          "Update": function() {
            
            
            var rescheduleDate = $('.appt_date').val(); // date
            var rescheduleTime = $('.appt_time').val(); // time
            // alert(appt_id);
            // Ajax for cancelling appointment
            $.ajax({
                type: "POST",
                url: "{{ route('appointments.reschduleAppointment') }}",
                data: {
                  id: appt_id,
                  appt_date: rescheduleDate,
                  appt_time: rescheduleTime,
                },
                dataType: "json",
                success: function(data) {
                      console.log(data);
                    // Ajax call completed successfully
                    if(data.success == 1) {
                        $('.reschedule_appt_modal').dialog( "close" );
                        $('.s-msg').html(data.message);
                        $('.s-msg').show();
                        $('.e-msg').hide();

                        setTimeout(() => {
                          window.location.reload();
                          
                        }, 2500);
  
                    } else {
                        $('.reschedule_appt_modal').dialog( "close" );
                        $('.s-msg').hide();
                        $('.e-msg').html(data.message);
                        $('.e-msg').show();

                    }

                },
                error: function(data) {
                      
                    // Some error in ajax call
                    $('.reschedule_appt_modal').dialog( "close" );
                    $('.s-msg').hide();
                    $('.e-msg').html(data.message);
                    $('.e-msg').show();
                }
            });


          },
          "Close": function() {
            $( this ).dialog( "close" );
          }
        }
      });

    });

    // fetching user existing bookings
    $('.mobile').on('keyup',function(){
      var mobile = $(this).val();
      var uid = $('.uid').val();
      if(mobile.length >= '11'){
        $.ajax({
            type: "POST",
            url: "{{ route('appointments.getAppointments') }}",
            data: {mobile: mobile,uid: uid},
            dataType: "json",
            success: function(data) {
                  console.log(data);
                // Ajax call completed successfully
                if(data.success == 1) {
                    $('.existing_appointments').html(data.html);
                }
            },
            error: function(data) {                  
                // Some error in ajax call
                $('.cancel_appt_modal').dialog( "close" );
                $('.s-msg').hide();
                $('.e-msg').html(data.message);
                $('.e-msg').show();
            }
        });
      }
    });

  </script>
</body>
</html>