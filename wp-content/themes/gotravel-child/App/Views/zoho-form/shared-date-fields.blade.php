<div class="col-sm-12 pb-3 mx-auto" id="datepickerContainer">
  <div class="mtt-loading">
    <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
    <span class="sr-only">Loading...</span>
    <p class="mt-3">Loading calendars. Please wait</p>
	</div>
  <!-- <input data-toggle="datepicker"> -->
  <!-- <input data-toggle="datepicker"> -->  
  {{-- <div id="datepicker"></div> --}}
  <meta name="mtt-events" content="">
  @if($myBoat->boat === 'speedboat')
  <meta name="datepickerLoaded" content="0">
  <div class="multiDatePicker d-none">
  
    <div class="form-row mt-4">
      @include('zoho-form.time-selector')
    </div>
    <div class="calendarMorning">
      <p class="my-2">Please pick a date for the morning</p>
      <div id="datepickerMorning" class="datepicker" ></div>    
      
    </div>
    <div class="calendarAfternoon">
      <p class="my-2">Please pick a date for the afternoon</p>
      <div id="datepickerAfternoon" class="datepicker "></div>
      
    </div>
    

  </div>
  @else
  <div id="datepicker" class="datepicker"></div>
  @endif
</div>
<div class="w-100"></div>
<div class="col-sm-4 pb-3">

  <!-- <textarea data-toggle="datepicker"></textarea>
  <div data-toggle="datepicker" name="date"></div> -->

  <label for="day" class="d-none">Day *</label>
  <select class="form-control" id="day" name="day" required style="display:none">
    <option value=''>Day *</option>
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
</div>
<div class="col-sm-4 pb-3">
  <label for="month" class="d-none">Month *</label>
  <select class="form-control" id="month" name="month" required style="display:none">
    <option value=''>Month *</option>
    <option value='1'>January</option>
    <option value='2'>February</option>
    <option value='3'>March</option>
    <option value='4'>April</option>
    <option value='5'>May</option>
    <option value='6'>June</option>
    <option value='7'>July</option>
    <option value='8'>August</option>
    <option value='9'>September</option>
    <option value='10'>October</option>
    <option value='11'>November</option>
    <option value='12'>December</option>
  </select>
</div>

<div class="col-sm-4 ">
  <label for="year" class="d-none">Year *</label>
  <select class="form-control" id="year" name="year" required style="display:none">
    <option value=''>Year *</option>
    <option value='2018'>2018</option>
    <option value='2019'>2019</option>
  </select>
</div>

@include('zoho-form.snippets.calendar-notes')

<div class="col-md-12 pb-3">
 <p class="mt-2" >Please select your prefered time:</p>
    <div class="custom-control custom-radio custom-control-inline">
    <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
    <label class="custom-control-label" for="customRadioInline1">Morning 10 am</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
    <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
    <label class="custom-control-label" for="customRadioInline2">Afternoon 3 pm</label>
    </div>
</div>





    