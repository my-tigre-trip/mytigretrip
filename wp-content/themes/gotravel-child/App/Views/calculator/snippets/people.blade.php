@if($tour->boat ==='speedboat' || $tour->mood === '1')
<div class="" >
<label for="adults">Adults </label>
  <select disabled name="_adults" id="adults" class="form-control">
    <option > </option>
    <option value="2" <?php echo $adults == 2? 'selected':'';?> >2</option>
    <option value="3" <?php echo $adults == 3? 'selected':'';?> >3</option>
    <option value="4" <?php echo $adults == 4? 'selected':'';?> >4</option>
    <option value="5" <?php echo $adults == 5? 'selected':'';?> >5</option>
  </select>
</div>
<br>

<div class="" >
@if($tour->areChildrenAllowed())
<label for="children"><div class="tooltip">Children<span class="tooltiptext">Paying children are more than 2 and under 10 years of age.</span></div></label>
<select disabled name="_children" id="children" class="form-control" >
    <option value="0" <?php echo ($children == '0' || !$tour->areChildrenAllowed() )? 'selected':'';?> >0</option>
    <option value="1" <?php echo $children == '1'? 'selected':'';?> >1</option>
    <option value="2" <?php echo $children == '2'? 'selected':'';?> >2</option>
    <option value="3" <?php echo $children == '3'? 'selected':'';?> >3</option>
  </select>
@else
  <small>Children are not allowed</small>
  <input id="children" type="hidden" name="children" value="0"/>
@endif
</div>
@elseif($tour->mood === '2')

@endif

<input id="children" type="hidden" name="children" value="{{$children}}"/>
<input id="adults" type="hidden" name="adults" value="{{$adults}}"/>
