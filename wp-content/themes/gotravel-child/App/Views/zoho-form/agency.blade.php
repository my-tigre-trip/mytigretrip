@if(isset($_GET['agencyContext']) && $_GET['agencyContext'] === 'true')
<p>For Agency:</p>
<div class="form-row mt-4">
  <div class="col-sm-6 pb-3">
    <label for="guide_name" class="d-none">Guide First/Last Name</label>
    <input type="text" class="form-control" id="guide_name" placeholder="Guide First/Last Name" name="guide_name"  required>
    <!--<input type="hidden" id="hidden_guide_name"   name="firsName" >-->
  </div>
  <div class="col-sm-6 pb-3">
    <label for="guide_phone" class="d-none">Guide Phone</label>
    <input type="text" class="form-control" id="guide_phone" placeholder="Guide Phone" name="guide_phone"  required>
    <!--<input type="hidden" id="hidden_first_name"   name="firsName" >-->
  </div>
</div>
@if(!empty($agency['operators']))
<div class="form-row my-4">
<label for="operator">Operator</label>
<select id="operator" name="operator" class="form-control" >
  @foreach (explode(',', $agency['operators']) as $o)
      <option value="">{{$o}}</option>
  @endforeach
</select>
</div>
@endif
<p>Passenger Data:</p>
@endif