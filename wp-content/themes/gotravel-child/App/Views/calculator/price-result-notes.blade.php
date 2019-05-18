
@if(count($notes) > 0)

  <div class="card-header">
    <p> <b>Please note:</b> </p>
    <ul class="list-group list-style px-3">
    @foreach($notes as $note)
      <li class="p-2">{!!$note!!}</li>
    @endforeach
    </ul>
  </div>
</div>
@endif
