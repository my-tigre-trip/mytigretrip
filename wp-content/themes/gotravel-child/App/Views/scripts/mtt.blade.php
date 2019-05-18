<script type="text/javascript">
$(document).ready(function(){
  checkTerms(); 

  if(jQuery('#mtt-my-trip-form').length > 0){
    //updateSummaryRequest();
    summaryRequest();    
  }

//formcontacto
  $(".clear-confirm").on('click', function(e){
    if( !confirm('Your choices will be clear. Are you sure you want to continue?')) {
      return false;
    }
  })

  jQuery('#terms').on('click',function(e){
    checkTerms();
  });

  jQuery('#mtt-get-my-trip-disabled').on('click',function(e){
    e.preventDefault();
    if( !checkTerms() ){
      alert("Please acept Terms & Conditions");
    }
  });

  jQuery('#mtt-get-my-trip').one('click',function(e){
    e.preventDefault();
    //getMyTrip();
    getTheTripRequest();
  });

//boton hacia my  trip
  jQuery('#next-step-button').one('click',function(e){
    //e.preventDefault();
  });
    
  function checkboxActionUpdate() {
    $('#mtt-my-trip-form input[type="checkbox"]').on('click',function(e){
      //e.preventDefault();
      if($(this).hasClass('updateSummary')){
        //updateSummaryRequest();
        summaryRequest();
      }
    });
  }
  checkboxActionUpdate();  
});

/**/
function toogleCalculate() {
  if( isEmpty(jQuery("#mtt-price-detail"))  &&
      isEmpty(jQuery("#mtt-large-group-message")) &&
      isEmpty(jQuery("#mtt-messages") )
    ){
        jQuery('#calculate').show();
  }else {
      jQuery('#calculate').hide();
  }
}

function checkTerms() {
  var checked = false;
  if (jQuery('input[name="terms"]:checked').length > 0){
    jQuery("#mtt-get-my-trip").show();
    jQuery("#mtt-get-my-trip-disabled").hide();
    checked = true;
    //.log('terms');
  }else{
    jQuery("#mtt-get-my-trip").hide();
    jQuery("#mtt-get-my-trip-disabled").show();
    //console.log('NO terms');
  }
  return checked;
}
</script>
