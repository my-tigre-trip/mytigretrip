jQuery(document).ready(function($) {
	 $(".clear-option").click(function (e) {
		   e.preventDefault()
			 if (confirm('Your trip options will be deleted. Are you sure to restart?')) {
					 location.href = $(this).attr('href');
			 }
	 });
/*
	adjustSliderHeight();
	$(window).resize(function(){
		adjustSliderHeight();
	});*/
  $(window).on( "scroll", function(){
		if ($('body').hasClass('home')) {			
			scrollLabel(($('#mtt-home-tour-list').height()))
		} else {		
			scrollLabel(($('.mtt-tour-list').height() - 900))
		}
	})

	function scrollLabel(limit) {
		if ($(window).scrollTop() > limit) {
      $("#mtt-scroll-down").hide()
		} else {
      $("#mtt-scroll-down").show() 
		}
	}

  /*collapse good to know*/
	$('.mtt-collapse').click(function(e){
    e.preventDefault();
    var collapse = $(this).data('collapse');
    $('#'+collapse).toggle(200);
    if (!$(this).hasClass('collapsed')) {
      $(this).addClass('collapsed');
    } else {
      $(this).removeClass('collapsed');
    }
	});
	//console.log(jQuery('input[name="adults"]').val());
	validatePassengers();
	
	//checkTerms();
  //si tiene un opcional horario de pick
	//pickOptions();

	if(jQuery('#mkdf-tour-booking-form').length > 0){
		if( jQuery('select[name="adults"]').val() !== '' ){
			calculatorRequest();
		}
	}

	$('#calculate').on('click',function(e){
		e.preventDefault();
		calculatorRequest();
		toogleCalculate();
	});
	$('#next-step-button').on('click',function(e){
		$('#calculate').hide();
		e.preventDefault();
		calculatorRequest(true);
		//toogleCalculate();
	});
	//actualizar con opcionales en calculadora
	jQuery('.update-calculator').on('click',function(e){
		erasePriceDetails();
		calculatorRequest();
	// toogleCalculate();
	});

	jQuery('#mtt-get-my-trip').on('click',function(e){
		e.preventDefault();
		getMyTrip();
	});

	jQuery('select').on('change',function(e){
			validatePassengers();
			jQuery('#next-step-button').hide();
			$('#lockTrip').remove();
	});

/**
 * Handles the price request
 * @param {boolean} nextStep 
 * 
 */
function calculatorRequest_(nextStep = false) {
	
	var formElement = document.getElementById("mkdf-tour-booking-form");
	var formData = new FormData( formElement );
	if (nextStep !== false) {
		formData.append('nextStep', nextStep);
	}
	erasePriceDetails();
	jQuery('.mtt-loading').show();
	jQuery.ajax({
		url: "/mytigretrip/price-calculator.php",
		type: "get", //send it through get method
		data: { 
			_token: formData.get("_token"), 
			back: formData.get("back"), 
			tourSlug: formData.get("tourSlug"),
			adults: formData.get("adults"),
			children: formData.get("children"),
			lock : formData.get("lock"),
			optional : formData.get("optional"),
			specialActivityPeople : formData.get("specialActivityPeople"),
			nextStep: formData.get("nextStep")
		},
		success: calculatorUpdate,
		error: function(err) {
			console.error("response", err);
		}
	});
}

function calculatorUpdate_(res) {
	console.log(res);
	jQuery('.mtt-loading').hide();	
	res = res.message;	
	var messages= res.messages ;
	var view = res.view;
	var nextStep = res.nextStep;
	var valid = res.valid;
	var redirect = res.redirect;
	var nextStepText = res.nextStepText;
	//console.log('valid '+valid+' -- lockCollision '+lockCollision);
	jQuery('#mtt-messages').empty();
	//console.log('MENSAJE:  '+messages);
	toogleCalculate();
	if (valid){
		$('#calculate').hide();

		if (nextStep != false && redirect) {
			window.location.replace(nextStep);
		} else {			
			erasePriceDetails();
			$('#mtt-price-detail').append(view);
			// agregar input nextStep
			$('#next-step-button').html(nextStepText);		
			$('#next-step-button').show();
		}
	}else {		
		$('#mtt-messages').append(messages);
		$('#calculate').hide();
		$('select').attr('disabled','disabled');
	}
}

function calculatePrice() {
  
}

jQuery("#rev_slider_26_1_wrapper").click(function(e){
	console.log(jQuery("#plan-your-trip").scrollTop());
	jQuery('html, body').animate({
		scrollTop:  jQuery("#plan-your-trip").offset().top
	}, 1500);
});

  const  today = new Date();
  var  tomorrow = new Date();
  tomorrow.setDate(today.getDate() + 1); 
	jQuery("#datepicker-div").datepicker({
			inline: true,
      defaultDate: null,
      minDate: tomorrow,
      maxDate: "+1y +1m",
      altFormat: "yy-mm-dd",
      altField: "#date"
  });
  // autocomplete off
  $('#datepicker-div').on('click', function(e) {
    e.preventDefault();
    $(this).attr("autocomplete", "off");  
 });

  // check date availability
  checkAvailability();
}); // ready

function passengersLimit(){
	var limit = 5;
	var count = parseInt(jQuery('select[name="adults"]').val()) + parseInt(jQuery('select[name="children"]').val());
	return count >limit ?true :false ;
}

function waterSportLimit(){
	if( jQuery('select[name="specialActivityPeople"]').length > 0 ){
		var limit = parseInt(jQuery('#adults').val()) + parseInt(jQuery('#children').val());
		var count = parseInt(jQuery('select[name="specialActivityPeople"]').val()) ;
		return count >limit ? true :false ;
	}
	return false;
}

/**
 * @todo separate the logic of calculator from trip search
 */
function validatePassengers() {
  var error = 0;
	var message = "";
	erasePassengersLimitMessage();

  if (!areThereAdults()) {
	//	message = "<p><br>How many guest will join in?</p>";
		error++;
	} else	if (passengersLimit()) {
		message = "<p>Private speedboat trips have been designed for a minimum of 2 passengers and a maximum of 5 passengers per trip. However, if you place a request before checkout we will admit up to 6 passengers on a single trip. If you are part of a group of 6 to 25 people, please check our Cruise or Yacht Trips</p>";
		error++;
	} else if ( waterSportLimit() ){
		message = "<p>Error. Please double-check the number of people skiing/flyboard</p>";
		error++;
	}
  console.log("err "+error+ " men "+message);
	if (error > 0) {    
    displayMessage(message); 
    //jQuery('#mtt-large-group-message').append(message);
  	jQuery('#calculate').hide();
    erasePriceDetails();
    error = 0;
	} else {
    jQuery('#calculate').show();
    displayMessage("");
	}

}

/**/
function toogleCalculate(){
	if( isEmpty(jQuery("#mtt-price-detail"))  &&
			isEmpty(jQuery("#mtt-large-group-message")) &&
			isEmpty(jQuery("#mtt-messages") )
		){
				jQuery('#calculate').show();
	}else {
			jQuery('#calculate').hide();
	}
}

//////
function isEmpty(el) {
	return !jQuery.trim(el.html())
}

function erasePriceDetails() {
	jQuery('#mtt-price-detail').empty();
}

function erasePassengersLimitMessage() {
  jQuery('#mtt-large-group-message').empty();
}

function areThereAdults() {
  var i = false;
  if(jQuery('select[name="adults"]').val() !== ''){
    i = true;
  }
  return i;
}

/**
 * 
 * @param {String} message 
 * for error and validation messages in calculator
 */
function displayMessage(message) {
  jQuery('#mtt-validator-messages').empty();
  jQuery('#mtt-validator-messages').html('<p style="color:red">'+message+'</p>');
}

/**
 * handles the trip search submit
 */
function checkAvailability () {
	jQuery('#mtt-trip-search-home').on('submit', function(e) {
		e.preventDefault();
		
    if (validateRequest()) {
      formElement = document.getElementById("mtt-trip-search-home");
			var formData = new FormData( formElement );
			jQuery(".mtt-loading").show();
	    standardRequest('checkAvailability', 'get', formDataToObject(formData), successCb, 15000, errorCb);
    }
  });
  
  var successCb = function (response) {		
	var data = response.data;
	console.log('response', data);
	jQuery(".mtt-loading").hide();
    if (data.available) {
      // redirect if available is true
	  displayMessage('Redirecting');
	  window.location = data.redirect;
    } else {
      displayMessage(data.message);
    }
    
  }

  var errorCb = function (err) {
		jQuery(".mtt-loading").hide();
    console.error('error', err);
    displayMessage('An error ocurred during search. Please try again')
  }  

  function validateRequest() {
    var adults = jQuery("#adults").val();
    var children = jQuery("#children").val();
    var date = jQuery("#date").val();
    var duration = jQuery("#duration").val();

    if (!adults || !children || !date || !duration) {
      displayMessage("All fields are required");
      return false;
    }

    return true;
  }
}

/**
 * Handle the price calculation for tour pages
 */
function calculatorRequest(nextStep = false) {
  var formElement = document.getElementById("mkdf-tour-booking-form");
  var formData = new FormData( formElement );
  if (nextStep !== false) {
    formData.append('nextStep', nextStep);
  }
  standardRequest('price-calculator', 'get', formDataToObject(formData), successCb, 15000, errorCb);

  function successCb (res) {
    console.log(res);
    jQuery('.mtt-loading').hide();
    res = res.data;	
    var messages= res.messages ;
    var view = res.view;
    var nextStep = res.nextStep;
    var valid = res.valid;
    var redirect = res.redirect;
    var nextStepText = res.nextStepText;
    
    jQuery('#mtt-messages').empty();
    
    toogleCalculate();
    if (valid){
      console.log("next "+res.nextStep);
      jQuery('#calculate').hide();

      if (nextStep != false && redirect) {
        window.location.replace(nextStep);
      } else {			
        erasePriceDetails();
        jQuery('#mtt-price-detail').append(view);
        // agregar input nextStep
        jQuery('#next-step-button').html(nextStepText);		
        jQuery('#next-step-button').show();
      }
    }else {		
      jQuery('#mtt-messages').append(messages);
      jQuery('#calculate').hide();
      jQuery('select').attr('disabled','disabled');
    }
  }

  function errorCb (res) {
    console.error("response", err);
    // improve this
  }
}

// behaviour of form
jQuery('#mtt-trip-search-home select[name="type"]').on('change', function(e) {
	var option = '<option id="single_adult" name="adults" value="1">1</option>';
	var fullDay = '<option id="option_full_day" value="full-day">Full Day</option>'
	// alert(jQuery(this).val());
	if (jQuery(this).val() === "group") {
		jQuery('select[name="adults"] option:eq(0)').after(option);
		jQuery("#option_full_day").remove();
	} else {
		jQuery("#single_adult").remove();
		jQuery('select[name="duration"]').prepend(fullDay);
	}
	
});
