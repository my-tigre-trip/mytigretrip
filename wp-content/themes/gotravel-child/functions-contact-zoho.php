<?php
use MyTigreTrip\Translation;

//$t->printJson();

function contact_form_zoho_shortcode($atts){
	$t = new Translation('contact-form-en');
	//$t->mtt('departure-time');
	$myTrip = unserialize($_SESSION['myTrip']);
	$myTrip->calculatePrice();
	//$myTrip->isLuxury();
	//$myTrip->isRanch();
	//$_SESSION['myTrip']
 //Texto preformateado
	$selfPaidText = '';
?>
<div class="mkdf-tour-booking-form-holder mkdf-boxed-widget">
	<h5 class="mkdf-tour-booking-title"><?php esc_html_e('My Tigre Trip Summary', 'mtt'); ?></h5>
	<div class="mtt-loading">
			<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
			<span class="sr-only">Loading...</span>
	</div>
	<div id="mtt-summary"><?php echo $myTrip->priceDetail() ?></div>


	<!-- Note :
	   - You can modify the font style and form style to suit your website.
	   - Code lines with comments ���Do not remove this code���  are required for the form to work properly, make sure that you do not remove these lines of code.
	   - The Mandatory check script can modified as to suit your business needs.
	   - It is important that you test the modified form before going live.-->
	<div id='crmWebToEntityForm' >
	   <META HTTP-EQUIV ='content-type' CONTENT='text/html;charset=UTF-8'>
	   <form action='https://crm.zoho.com/crm/WebToLeadForm' name=WebToLeads3070482000000213007 method='POST' onSubmit='javascript:document.charset="UTF-8"; return checkMandatory()' accept-charset='UTF-8'>
  <!--   <form id="mtt-checkout-form" name=WebToLeads3070482000000213007 method='POST' accept-charset='UTF-8'>  -->
		 <!-- Do not remove this code. -->
		<input type='text' style='display:none;' name='xnQsjsdp' value='25a6e6faa48f5796f1a012c0a9da16b6342bc22cbaa6d811a878ec6e7225793e'/>
		<input type='hidden' name='zc_gad' id='zc_gad' value=''/>
		<input type='text' style='display:none;' name='xmIwtLD' value='38ed720f763c9041252c49fa7c2478a7d7ffce22ed8b60b0f9b1c039771c1d26'/>
		<input type='text' style='display:none;'  name='actionType' value='TGVhZHM='/>

		<input type='text' style='display:none;' name='returnURL' value='http&#x3a;&#x2f;&#x2f;tigre-private-boat-tours.com&#x2f;my-trip-checkout' />
		 <!-- Do not remove this code. -->
		<div  class="mtt-input" >
			<label for="firstName" >First Name *:</label></br>
			<input id="firstName" type='text'  maxlength='40' name='First Name'  required />
		</div>

		<div class="mtt-input" >
			<label for="lastName" >Last Name *:</label></br>
			<input id="lastName" type='text'   maxlength='80' name='Last Name' required />
		</div>
    <input type="hidden"    name="LEADCF47" >
		<input type="hidden"    name="LEADCF48" >
		<div class="mtt-input" >
			<label for="contactEmail" >E-mail *:</label></br>
			<input id="contactEmail" type='text'  maxlength='100' name='Email' required />
		</div>

		<div class="mtt-input" >
			<label for="contactPhone" >WhatsApp / SMS *:</label></br>
			<input id="contactPhone" type='text'  maxlength='255' name='LEADCF121' required />
		</div>

		<div class="mtt-textarea">
			<label for="mtt-aditional-contact">Alternative Contact Information (optional)</label>
			<textarea id="mtt-aditional-contact" name='LEADCF33' ></textarea>
		</div>

		<div class="mtt-date-select">
			<label for="day">Day *</label>
			<select id="day" name="LEADCF24" required>
				<option value=''>-None-</option>
				<option value='1'>1</option>
				<option value='2'>2</option>
				<option value='3'>3</option>
				<option value='4'>4</option>
				<option value='5'>5</option>
				<option value='6'>6</option>
				<option value='7'>7</option>
				<option value='8'>8</option>
				<option value='9'>9</option>
				<option value='10'>10</option>
				<option value='11'>11</option>
				<option value='12'>12</option>
				<option value='13'>13</option>
				<option value='14'>14</option>
				<option value='15'>15</option>
				<option value='16'>16</option>
				<option value='17'>17</option>
				<option value='18'>18</option>
				<option value='19'>19</option>
				<option value='20'>20</option>
				<option value='21'>21</option>
				<option value='22'>22</option>
				<option value='23'>23</option>
				<option value='24'>24</option>
				<option value='25'>25</option>
				<option value='26'>26</option>
				<option value='27'>27</option>
				<option value='28'>28</option>
				<option value='29'>29</option>
				<option value='30'>30</option>
				<option value='31'>31</option>
			</select>

		  <label for="month">Month *</label>
			<select id="month" name='LEADCF27'>
				<option value='-None-'>-None-</option>
				<option value='January'>January</option>
				<option value='February'>February</option>
				<option value='March'>March</option>
				<option value='April'>April</option>
				<option value='May'>May</option>
				<option value='June'>June</option>
				<option value='July'>July</option>
				<option value='August'>August</option>
				<option value='September'>September</option>
				<option value='October'>October</option>
				<option value='November'>November</option>
				<option value='December'>December</option>
			</select>

			<label for="year">Year *</label>
			<select id="year" name='LEADCF26'>
				<option value='-None-'>-None-</option>
				<option value='2018'>2018</option>
				<option value='2019'>2019</option>
			</select>

		</div>

		<div class="mtt-textarea">
 	  <label for="mtt-altenative-dates">Alternative Dates (optional)</label>
 	  <textarea id="mtt-altenative-dates" name='LEADCF1' ></textarea>
 	 </div>


	   <!-- Horarios de lancha o pick up -->
    <div class="mtt-select clear">
			<?php  if ($myTrip->boat === 'full-day') : ?>
			<label for="mtt-pick-time" ><?php $t->mtt('pick-up-time')?>. <?php $t->mtt('pick-up-time-info');?>:</label>
	  	<?php  elseif ($myTrip->car) : ?>
      <label for="mtt-pick-time" ><?php $t->mtt('departure-time')?>: </label>
			<?php  else : ?>
			<label for="mtt-pick-time" >I´d like to start my boat trip from Tigre´s Public Pier at: </label>
			<?php  endif; ?>

		  <?php if($myTrip->boat == 'full-day'):
          //LEADCF123   boat Departure time
					//LEADCF29   car pick up time
			?>

    	<select class="" name="LEADCF29">
				<option value="10 am">10 am</option>
				<option value="10.30 am">10.30 am</option>
				<option value="11 am">11 am</option>
    	</select>
		  <?php else: //no es full day?>

			<select id="timeOptions" class="" name="<?php echo $myTrip->car? 'LEADCF123': 'LEADCF29' ?>">
				<?php  if ($myTrip->car) : ?><option value="10 am">10 am</option><?php endif; ?>
				<option value="10.30 am">10.30 am</option>
				<option value="11 am">11 am</option>
				<option class="mtt-pickme" value="3 pm">3 pm</option>
				<option class="mtt-pickme" value="3.30 pm">3.30 pm</option>
	   	</select>
			<?php endif; ?>
    </div>

		<?php if($myTrip->boat !== 'full-day' && $myTrip->car):
      // si sale a la tarde diferenciamos el pickme
	  ?>
    <div class="mtt-select clear">
			<label class="mtt-hide-with-pick"> If you want to stay in Continental Tigre a little longer, just tell us so on the day of your trip.</label>
      <label class="mtt-show-with-pick" for="mtt-pickme-extra">Knowing that there is a 40-minute drive from BA City to Tigre, please pick me up from my requested address at.</label>
			<select id="mtt-pickme-extra"  class="mtt-show-with-pick" name="LEADCF29">
			 <option value="10 am">10 am</option>
			 <option value="10.30 am">10.30 am</option>
			 <option value="11 am">11 am</option>
			 <option value="11.30 am">11.30 am</option>
			 <option value="12 pm">12 pm</option>
			 <option value="12.30 pm">12.30 pm</option>
			 <option value="1 pm">1 pm</option>
			 <option value="1.30 pm">1.30 pm</option>
			 <option value="2 pm">2 pm</option>
			 <option value="2.30 pm">2.30 pm</option>
		 </select>
		 <br>
		 <p class="mtt-show-with-pick"><i>* Please remember, our boat trip will start at 3 pm from Tigre´s Public Pier. We will meet you there!</i></p>
		</div>
    <?php endif; ?>

		<?php if( $myTrip->car || $myTrip->boat == 'full-day' ): ?>
		 <div class="mtt-textarea" >
			 <label for="mtt-pickup-address" >Car Pick-up Address *:</label></br>
			 <textarea id="mtt-pickup-address" name='LEADCF28' maxlength='2000' required></textarea>
		 </div>
		<!--Car Pick-up Time <input type='text' style='width:250px;'  maxlength='255' name='LEADCF29' /> -->
		<?php endif; ?>


		<div class="mtt-select clear">
		 <label for="menu-requirements">Special Menu Requests <small>-please tell us more under the "Notes & Comments” section</small></label>
		 <select id="menu-requirements" name='LEADCF32'>
			 <option value='-None-'>-None-</option>
			 <option value='Gluten&#x20;Free&#x20;Meal'>Gluten Free Meal</option>
			 <option value='Vegetarian&#x20;Meal'>Vegetarian Meal</option>
		 </select>
		</div>

	 <div class="mtt-textarea">
	 <label for="mtt-notes-comments">Notes &amp; Comments (optional)</label>
	 <textarea id="mtt-notes-comments" name='LEADCF3' ></textarea>
	</div>


		<select id="mtt-include-car" style='display:none;' name='LEADCF124'>

			<option value='Included' <?php echo ($myTrip->car || $myTrip->boat == 'full-day' )?'selected':''; ?> >Included</option>
			<option value='Not&#x20;Included' <?php echo !$myTrip->car?'selected':''; ?> >Not Included</option>
			<option value='Included&#x20;in&#x20;&#x20;Price'>Included in  Price</option>
		</select>

		<select id="mtt-include-car" style='display:none;' name='LEADCF9'>

			<option value='Included' <?php echo ($myTrip->car || $myTrip->boat == 'full-day' )?'selected':''; ?> >Included</option>
			<option value='Not&#x20;Included' <?php echo !$myTrip->car?'selected':''; ?> >Not Included</option>
			<option value='Included&#x20;in&#x20;&#x20;Price'>Included in  Price</option>
		</select>


    <input id="mtt-ticket-number" type='hidden'   maxlength='255' name='LEADCF40' value="<?php echo $myTrip->id ?>"/>
		<input id="mtt-adults" type='hidden'  name='LEADCF5' value="<?php echo $myTrip->adults ?>" />
		<input id="mtt-children" type='hidden'  name='LEADCF4' value="<?php echo $myTrip->children ?>"/>
    <input id="mtt-water-spot" type='hidden'   maxlength='255' name='LEADCF41' value="<?php echo $myTrip->specialActivity ?>" />
	   <input id="mtt-island-expenses" type='hidden'  name='LEADCF36' value="<?php echo $myTrip->payOnIsland?'Not Included in Price':'Included in price' ?>" />


	    <input id="mtt-dayOfWeek" type='hidden'  name='LEADCF23'  />
			<!--
				<option value='-None-'>-None-</option>
				<option value='Sunday'>Sunday</option>
				<option value='Monday'>Monday</option>
				<option value='Tuesday'>Tuesday</option>
				<option value='Wednesday'>Wednesday</option>
				<option value='Thursday'>Thursday</option>
				<option value='Friday'>Friday</option>
				<option value='Saturday'>Saturday</option>
			-->
		 <!-- google calendarMM/dd/yyyy -->
     <input id="mtt-google-calendar" type="hidden"  name='LEADCF82'  />
		 <input type='hidden'  name='LEADCF6' value="<?php echo $myTrip->boatName() ?>" />
		 <input id="mtt-mood-1" type="hidden" name="LEADCF15" value="<?php echo $myTrip->mainTour()->name;  ?>" >

		 <?php if ($myTrip->boat == 'full-day'  && $myTrip->preBuilt === null) :		 ?>
			<input id="mtt-mood-2" type="hidden" name="LEADCF17" value="<?php echo $myTrip->additionalTour()->name;  ?>" >
		 <?php endif ?>

	   <?php if ($myTrip->payOnIsland) :
					$price = $myTrip->tourPrice + $myTrip->waterSportPrice ;
					$selfPaidText = "additionally,  you have asked to pay for your own expenses in the islands -estimated at USD $price
					Bare in mind that you will be needing extra cash; credit cards are rarely accepted on the islands.";
			?>
		  <input id="mtt-estimated-island-expenses" type='hidden' maxlength='255' name='LEADCF38' value="<?php echo $price?>" />
			<input type="hidden" name="LEADCF50" value="<?php echo $selfPaidText;  ?>" />
	  <?php endif ?>

		<?php if($myTrip->boat == 'full-day'  && $myTrip->preBuilt !== null):
			$mainTour = $myTrip->mainTour();
			$isLuxury = $mainTour->optional == 'luxury'?true:false;
      $isRanch = $mainTour->optional == 'ranch'?true:false;
			?>
		<select  name='LEADCF18' style="display:none">
			<option value='-None-'>-None-</option>
			<option value='Lunch&#x20;&#x2b;&#x20;1&#x20;Activity' <?php echo ($isRanch && $myTrip->ranch)? 'selected' :'' ;?> >Lunch &#x2b; 1 Activity</option>
			<option value='Lunch&#x20;&#x2b;&#x20;2&#x20;Activities&#x20;&#x2b;&#x20;Tea' <?php echo ($isRanch && !$myTrip->ranch)? 'selected' :'' ;?>>Lunch &#x2b; 2 Activities &#x2b; Tea</option>
			<option value='Use&#x20;of&#x20;Lodge&acute;s&#x20;Facilities&#x20;Included' <?php echo ($isLuxury && $myTrip->luxury)? 'selected' :'' ;?>>Use of Lodge&acute;s Facilities Included</option>
			<option value='Use&#x20;of&#x20;Lodge&acute;s&#x20;Facilities&#x20;Not&#x20;Included' <?php echo ($isLuxury && !$myTrip->luxury)? 'selected' :'' ;?>>Use of Lodge&acute;s Facilities Not Included</option>

		</select>
	<?php endif; ?>


		<input id="mtt-final-price" type='hidden'   maxlength='255' name='LEADCF37' value="<?php echo $myTrip->price?>"/>
		<input  type="hidden" name='LEADCF66' value="<?php echo $myTrip->price?>" />
    <button type="submit" class="mtt-button mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-btn-hover-solid mtt-get-price mtt-button">BOOK NOW!!</button>

<!--
  <input  type='submit' value='Submit' />
			<input style='font-size:12px;color:#131307' type='submit' value='Submit' />
			<input type='reset' style='font-size:12px;color:#131307' value='Reset' />
-->
		<script>
		/*
     jQuery('.mtt-button').click(function(e){
			 e.preventDefault();
			 checkMandatory();


		 });
*/
		function dayOfWeek(year, month, day) {
			    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        	var days  =    ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
	        var d = new Date(year, months.indexOf(month), day);
        	var n = days[d.getDay()];

         	jQuery("#mtt-dayOfWeek").val(n);

				//	var dateGoogle =
					jQuery('#mtt-google-calendar').val(getFormattedDate(new Date(month+" "+day+" "+ year)));
					console.log(n  + 'indice '+d);
		}
   //
	 //date
	  function getFormattedDate(date) {
        var year = date.getFullYear();

        var month = (1 + date.getMonth()).toString();
        month = month.length > 1 ? month : '0' + month;

        var day = date.getDate().toString();
        day = day.length > 1 ? day : '0' + day;

        return month + '/' + day + '/' + year;
    }

	 	  var mndFileds=new Array('LEADCF27','LEADCF26','First Name','Last Name');
	 	  var fldLangVal=new Array('Month','Year','First Name','Last Name');
			var name='';
			var email='';

	 	  function checkMandatory() {

			//deal name
 			jQuery('input[name="LEADCF47"]').val(jQuery('#lastName').val());
      jQuery('input[name="LEADCF48"]').val(jQuery('#firstName').val());
      //goog calendar




			dayOfWeek(jQuery('select[name="LEADCF26"]').val(), jQuery('select[name="LEADCF27"]').val(), jQuery('select[name="LEADCF24"]').val() );

			for(i=0;i<mndFileds.length;i++) {
			  var fieldObj=document.forms['WebToLeads3070482000000213007'][mndFileds[i]];
			  if(fieldObj) {
				if (((fieldObj.value).replace(/^\s+|\s+$/g, '')).length==0) {
				 if(fieldObj.type =='file')
					{
					 alert('Please select a file to upload.');
					 fieldObj.focus();
					 return false;
					}
				alert(fldLangVal[i] +' cannot be empty.');
	   	   	  	  fieldObj.focus();
	   	   	  	  return false;
				}  else if(fieldObj.nodeName=='SELECT') {
	  	   	   	 if(fieldObj.options[fieldObj.selectedIndex].value=='-None-') {
					alert(fldLangVal[i] +' cannot be none.');
					fieldObj.focus();
					return false;
				   }
				} else if(fieldObj.type =='checkbox'){
	 	 	 	 if(fieldObj.checked == false){
					alert('Please accept  '+fldLangVal[i]);
					fieldObj.focus();
					return false;
				   }
				 }
				 try {
				     if(fieldObj.name == 'Last Name') {
					name = fieldObj.value;
	 	 	 	    }
				} catch (e) {
					console.log(e);
				}
			    }
			}
		     }

	</script>
		</form>
	</div>
</div>

<?php

}#fin shortcode

add_shortcode( 'formulario_contacto_zoho_bk', 'contact_form_zoho_shortcode_bk' );
