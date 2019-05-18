@php
//$notes = 
@endphp
@if(count($notes) > 0)
<div class="card">
  <div class="card-header">Notes
    <span class="float-right badge badge-danger p-2">{{count($notes)}}</span>
  </div>

  <div class="card-body">
    <ul class="list-group list-style px-3">
    @foreach($notes as $note)
      <li class="p-2">{!!$note!!}</li>
    @endforeach
    </ul>
  </div>
</div>
@endif
