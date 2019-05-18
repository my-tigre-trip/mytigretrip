/**
* Handle the checkout request
*
*/
function checkoutSharedRequest() {
  formElement = document.getElementById("mtt-checkout-form");
  var formData = new FormData( formElement );
  standardRequest(
    "checkoutShared",
    "post",
    formDataToObject(formData),
    checkoutSharedSuccess
    );
  }
  
/**
* Handle the checkout success response
*
*/
function checkoutSharedSuccess(res) {  
  newResponse = res.data;
  
  if (newResponse.status === "success") {
      window.location.replace(newResponse.redirect);
  } else {
      console.log(newResponse);
      alert(newResponse.message);
  }
}
  
// checkout
/**
* Handle the checkout request
*
*/
function checkoutRequest() {  
  formElement = document.getElementById("mtt-checkout-form");
  var formData = new FormData( formElement );
  standardRequest(
    "checkout",
    "post",
    formDataToObject(formData),
    checkoutSuccess
    );
  }
  
/**
* Handle the checkout success response
*
*/
function checkoutSuccess(res) {  
  newResponse = res.data;
  
  if (newResponse.status === "success") {
      window.location.replace(newResponse.redirect);
  } else {
      console.log(newResponse);
      alert(newResponse.message);
  }
}
  

  /**
  * Handles the request to calendar in the cloud
  */
  function calendarRequest(schedule = '', datepicker = "#datepicker") {   
    var cal = false;
    standardRequest(
      "calendar",
      "get",
      {schedule: schedule},
      function(res){  cal = calendarUpdate(res, datepicker) }
    );
  }
  
  /**
  * render the datepicker calendar 
  *
  */
  function calendarUpdate (res, datepicker) {
    //console.log(res);
    //console.log(datepicker);     
         
    var events = res.message.data;
    const  today = new Date();
    var  tomorrow = new Date();
    tomorrow.setDate(today.getDate() + 1);        
          
    $(datepicker).datepicker({
      defaultDate: null,
      minDate: tomorrow,
      maxDate: "+1y +1m",
      beforeShowDay: function(date) {
        var cDate = dateToString(new Date(date))
        for(var i = 0; i < events.length; i++) {
          var eDate = dateToString(new Date(events[i].start))               
          if (eDate === cDate) {              
            if((events[i].available)) {  
              return [true,"mtt-available "+events[i].schedule+" "+events[i].status]; 
            } else {
              return [false,"mtt-not-available "+ events[i].schedule+" "+events[i].status];
            }                  
          } 
        }
        return [true,"mtt-available"];              
      },
      onSelect: function(selected, dp) {           
        var date = new Date(selected);      
        $("select[name='day']").val(date.getDate())
        $("select[name='month']").val(date.getMonth()+1)
        $("select[name='year']").val(date.getFullYear()) 
      }
    });
    $( datepicker ).find(".ui-datepicker-current-day").removeClass("ui-datepicker-current-day");
    $( datepicker ).find(".ui-state-active").removeClass("ui-state-active");

    if (!window.calendarLoaded) {
      window.calendarLoaded = [datepicker];
    } else {
      window.calendarLoaded.push(datepicker);
    };

    if(datepicker === "#datepicker" && window.calendarLoaded.length == 1) {
      $(".multiDatePicker").removeClass("d-none");
      $('.mtt-loading').hide();
    } else if(window.calendarLoaded.length == 2) {
      $(".multiDatePicker").removeClass("d-none");
      $('.mtt-loading').hide();
    }  
    console.log(window.calendarLoaded.length);
  }

/**
 * *
 */ 
function summaryRequest() {
  var checkboxes = $('#mtt-my-trip-form input[type="checkbox"]')
  //checkboxes.off();
  formElement = document.getElementById("mtt-my-trip-form");
  var formData = new FormData(formElement);
  $('#mtt-summary').empty();
  $('.mtt-loading').show();
  $("#mtt-my-trip-form").hide();

  //scroll arriba
  $('html, body').animate({
        scrollTop:  0
      }, 500);

  standardRequest(
    "summary",
    "post",
    formDataToObject(formData),
    summarySuccess
    );
}

/**
 * 
 */
function summarySuccess(res) {  
  newResponse = res.message;
  var payOnIsland= newResponse.payOnIsland ;
  var view = newResponse.view;

  $('#mtt-summary').append(view);
  $('.mtt-loading').hide();
  $("#mtt-my-trip-form").show();

  if(payOnIsland){
    $('.mtt-tour-detail .mtt-price').css('text-decoration','line-through');
  }else{
    $('.mtt-tour-detail .mtt-price').css('text-decoration','none');
  }
}
/**
 * 
 */
function getTheTripRequest() {
  formElement = document.getElementById("mtt-my-trip-form");
  var formData = new FormData( formElement );
  standardRequest(
    "get-the-trip",
    "post",
    formDataToObject(formData),
    getTheTripSuccess
    );
}
/**
 * 
 */
function getTheTripSuccess(res) {
  // borramos mensajes de validacion existentes
  $('.mtt-validation').remove();
 
  if (res.errors == false) {
      window.location.replace(res.redirect);
      console.log(res.redirect);
  } else {
    var errors = res.errors;
    //console.log(errors);
    if( errors !== true ){
      for (var i=0; i < errors.length; i++ ) {
        //console.log('error '+errors[i]);
        jQuery('#'+errors[i]).after('<p class="mtt-alert mtt-validation">Please check this required field</p>');
      }
      jQuery('html, body').animate({
        scrollTop: jQuery('#'+errors[0]).offset().top - 200
      }, 500);
    }
  }
}

function toogleCalendars() {
  function clearDateVal() {
    $("select[name='day']").val("");
    $("select[name='month']").val("");
    $("select[name='year']").val("");
  }
  clearDateVal();
  var val = $("select[name=mttTimeSelector]").val();
  console.log(val);
  //schedule = $('input[name="schedule"]').val(schedule);
  if (val === "morning") {
    $(".calendarMorning").show();
    $(".calendarAfternoon").hide();
    $("#datepickerAfternoon").find(".ui-state-active").removeClass("ui-state-active");
    
  } else {
    $(".calendarMorning").hide();
    $("#datepickerMorning").find(".ui-state-active").removeClass("ui-state-active");
    $(".calendarAfternoon").show();    
  }  
}
