@php
$agencyContext = isset($_GET['agencyContext']) && $_GET['agencyContext'] === 'true';
$guide = isset($_GET['guide']) && $_GET['guide'] === 'true';
@endphp
@if($agencyContext)
<input type="hidden" name="agencyName" value="{{$agency['Account_Name']}}" />
<p>For Agency:</p>
  @if($guide)
  <div class="form-row mt-4">
    <div class="col-sm-6 pb-3">
      <label for="guide_name" class="d-none">Guide First/Last Name</label>
      <input type="text" class="form-control" id="guide_name" placeholder="Guide First/Last Name" name="guideName"  required>
      <!--<input type="hidden" id="hidden_guide_name"   name="firsName" >-->
    </div>
    <div class="col-sm-6 pb-3">
      <label for="guide_phone" class="d-none">Guide Phone</label>
      <input type="text" class="form-control" id="guide_phone" placeholder="Guide Phone" name="guidePhone"  required>
      <!--<input type="hidden" id="hidden_first_name"   name="firsName" >-->
    </div>
  </div>
  @endif

@if(!empty($agency['operators']))
<div class="form-row my-4">
{{-- <label for="operator">Operator</label> --}}
  <div class="col-sm-6 pb-3">    
    <select id="operator" name="operator" class="form-control" >
      <option>- Select an operator-</option>
      @foreach (explode(',', $agency['operators']) as $o)
          <option value="{{$o}}">{{$o}}</option>
      @endforeach
    </select>
  </div>
  <div class="col-sm-6 pb-3">
        <label for="guide_phone" class="d-none">Operator Phone</label>
        <input type="text" class="form-control" id="operatorPhone" placeholder="Operator Phone" name="operatorPhone"  required>
        <!--<input type="hidden" id="hidden_first_name"   name="firsName" >-->
  </div>
</div>
@endif

<p>Passenger Data:</p>
@endif