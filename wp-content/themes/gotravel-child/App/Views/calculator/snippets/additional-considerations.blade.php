@if ($tour->hasOptional())
<div class="mtt-optional">
  <input class="update-calculator" id="{{$tour->product['optionId']}}" name="optional" value="yes" type="checkbox"  >
  {{-- <input name="isLuxury" value="yes" type="hidden"  /> --}}
  <label for="{{$tour->product['optionId']}}" >{{$tour->product['optionLabel_en']}}</label>
</div>
@endif
