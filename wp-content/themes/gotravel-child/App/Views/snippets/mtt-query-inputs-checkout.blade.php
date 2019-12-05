@if(isset($_GET['adults']))
<input type="hidden" name="checkout[adults]" value="{{$_GET['adults']}}" >
@endif
@if(isset($_GET['children']))
<input type="hidden" name="checkout[children]" value="{{$_GET['children']}}" >
@endif
@if(isset($_GET['specialActivityPeople']))
<input type="hidden" name="checkout[specialActivityPeople]" value="{{$_GET['specialActivityPeople']}}" >
@endif

@if(isset($_GET['mood1']))
<input type="hidden" name="checkout[mood1]" value="{{$_GET['mood1']}}" >
@endif
@if(isset($_GET['mood2']))
<input type="hidden" name="checkout[mood2]" value="{{$_GET['mood2']}}" >
@endif
@if(isset($_GET['optional']))
<input type="hidden" name="checkout[optional]" value="{{$_GET['optional']}}" >
@endif

@if(isset($_GET['date']))
<input type="hidden" name="checkout[date]" value="{{$_GET['date']}}" >
@endif

@if(isset($_GET['car']))
<input type="hidden" name="checkout[car]" value="{{$_GET['car']}}" >
@endif
@if(isset($_GET['payOnIsland']))
<input type="hidden" name="checkout[payOnIsland]" value="{{$_GET['payOnIsland']}}" >
@endif

@if(isset($_GET['duration']))
<input type="hidden" name="checkout[duration]" value="{{$_GET['duration']}}" >
@endif

@if(isset($_GET['agency']))
<input type="hidden" name="checkout[agency]" value="{{$_GET['agency']}}" >
@endif

@if(isset($_GET['agencyContext']))
<input type="hidden" name="checkout[agencyContext]" value="{{$_GET['agencyContext']}}" >
@endif

@if(isset($_GET['guide']))
<input type="hidden" name="checkout[guide]" value="{{$_GET['guide']}}" >
@endif

@if(isset($_GET['type']))
<input type="hidden" name="checkout[type]" value="{{$_GET['type']}}" >
@endif