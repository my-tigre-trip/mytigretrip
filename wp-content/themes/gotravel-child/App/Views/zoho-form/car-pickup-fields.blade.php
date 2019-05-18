<!-- Horarios de lancha o pick up -->
<div class="col-md-6 form-group pb-3">
  @if($myBoat->boat === 'full-day')
    @include('zoho-form.car-included')
  @elseif($myBoat->boat !== 'full-day' && $myTrip->car)
    @include('zoho-form.car-included')
  @elseif($myBoat->boat !== 'full-day' && !$myTrip->car)
    @include('zoho-form.no-car')
  @endif
</div>
