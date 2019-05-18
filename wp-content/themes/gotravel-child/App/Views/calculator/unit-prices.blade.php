<div class="card">
  <div class="card-header">
    <span class="">Prices p/ person</span>
  </div>

  <div class="card-body">
    <table class="table">
       <tbody>
         <tr>
           <th>Price per Adult</th>
           <td>{{$myTrip->pricePerAdult}}</td>
         </tr>
         @if($myTrip->children > 0)
         <tr >
           <th scope="row">Price per Children</th><td  >{{$myTrip->pricePerChildren}}</td>
         </tr>
         @endif

         @if($myTrip->specialActivity > 0)
         @php
         $countWater = $myTrip->specialActivity > 1? 'Classes':'Class';
         @endphp
         <tr >
           <th scope="row">Price per {{$myTrip->waterSport}} {{$countWater}}</th><td>{{$myTrip->waterSportPrice/$myTrip->specialActivity}}</td>
         </tr>
         @endif
         @if($myTrip->car)
         <tr >
           <th scope="row">Private Car</th><td  >{{$myTrip->carPrice}}</td>
         </tr>
         @endif

       </tbody>
    </table>
  </div>
</div>
