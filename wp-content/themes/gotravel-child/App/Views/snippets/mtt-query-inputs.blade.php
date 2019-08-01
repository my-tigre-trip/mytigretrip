@if(isset($_GET['adults']))
<input type="hidden" name="adults" value="{{$_GET['adults']}}" >
@endif
@if(isset($_GET['children']))
<input type="hidden" name="children" value="{{$_GET['children']}}" >
@endif
@if(isset($_GET['specialActivityPeople']))
<input type="hidden" name="specialActivityPeople" value="{{$_GET['specialActivityPeople']}}" >
@endif

@if(isset($_GET['mood1']))
<input type="hidden" name="mood1" value="{{$_GET['mood1']}}" >
@endif
@if(isset($_GET['mood2']))
<input type="hidden" name="mood2" value="{{$_GET['mood2']}}" >
@endif
@if(isset($_GET['optional']))
<input type="hidden" name="optional" value="{{$_GET['optional']}}" >
@endif

@if(isset($_GET['date']))
<input type="hidden" name="date" value="{{$_GET['date']}}" >
@endif
@if(isset($_GET['d']))
<input type="hidden" name="d" value="{{$_GET['d']}}" >
@endif

@if(isset($_GET['car']))
<input type="hidden" name="car" value="{{$_GET['car']}}" >
@endif
@if(isset($_GET['payOnIsland']))
<input type="hidden" name="payOnIsland" value="{{$_GET['payOnIsland']}}" >
@endif

@if(isset($_GET['duration']))
<input type="hidden" name="duration" value="{{$_GET['duration']}}" >
@endif