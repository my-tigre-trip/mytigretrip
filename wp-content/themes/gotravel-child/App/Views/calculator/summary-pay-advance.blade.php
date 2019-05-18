<div class="card">
  {{--
    <div class="card-header">
    <span class="d-none d-md-inline">My Tigre Trip Details</span>
    <span class="float-md-right float-sm-left"><b>{{$priceTitle}}</b>
    <span class="badge badge-success p-2">USD {{$finalPrice['finalPrice']}}</span></span>
    </div>
  --}}
  <div class="card-body">
    <table class="table table-hover">
      <tbody>
          <tr>
            <th scope="row" class="text-left border-top-0" >Trip duration</th>
            <td class="border-top-0">{{$myBoat->boatName($myBoat->boat)}}</td>
          </tr>
          @if ($myBoat->boat !== 'speedboat' )
          <tr>
            <th scope="row" >I'm in a mood for </th><td>{{$myBoat->mood1->name}}</td>
          </tr>
          @endif
          
          @if ($myBoat->boat === 'full-day' && $myBoat->mood2->category->slug === 'build-your-own-tigre-trip-stop')
          <tr>
            <th scope="row" >I'm also in a mood for </th><td>{{$myBoat->mood2->name}}</td>
          </tr>
          @endif

      </tbody>
    </table>

    <table class="table table-hover table-light border rounded mt-4 table-striped">
      <tbody>
        @if ($myTrip->car)
        <tr >
          <td scope="row" class="text-center">{{$price['priceCar']}}</td><td >Private Car </td>
        </tr>
        @endif
        <tr >
          <td scope="row" class="text-center">{{$price['priceAdults']}}</td><td  >{{$boatDetail['adults']}} Adults </td>
        </tr>
        @if($boatDetail['children'] > 0)
        <tr >
          <td scope="row" class="text-center">{{$price['priceChildren']}}</td><td>{{$boatDetail['children']}} Children </td>
        </tr>
        @endif

        @if($tourDetail['specialActivityPeople'] > 0)
        @php
          $countWater = $tourDetail['specialActivityPeople'] > 1? 'Classes':'Class';
        @endphp
        <tr >
          <td scope="row" class="text-center">{{$tourDetail['specialActivityPrice']}}</td><td>{{$tourDetail['specialActivityPeople']}} {{$tourDetail['specialActivity']}} {{$countWater}}</td>
        </tr>
        @endif

        @if($boatDetail['groupDiscount'] > 0)
        <tr class="font-italic">
          <td scope="row" class="text-center">- {{$boatDetail['groupDiscount']}}</td><th scope="row" >Group Discount</th>
        </tr>
        @endif
        <tr class="font-bold mtt-color">
          <td scope="row" class="text-center"><b>{{$finalPrice}}</b></td><th scope="row" >{{$priceTitle}}</th>
        </tr>

      </tbody>
    </table>
  </div>
</div>
