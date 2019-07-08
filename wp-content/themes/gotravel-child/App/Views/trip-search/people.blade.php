<div class="vc_col-md-4  vc_col-sm-12" >
<label for="adults">Adults </label>
  <select name="adults" id="adults" class="form-control" required>
    <option > </option>
    <option value="2" <?php echo $req['adults'] == 2? 'selected':'';?> >2</option>
    <option value="3" <?php echo $req['adults'] == 3? 'selected':'';?> >3</option>
    <option value="4" <?php echo $req['adults'] == 4? 'selected':'';?> >4</option>
    <option value="5" <?php echo $req['adults'] == 5? 'selected':'';?> >5</option>
  </select>
</div>


<div class="vc_col-md-4  vc_col-sm-12" >
<label for="children"><div class="tooltip">Children<span class="tooltiptext">Paying children are more than 2 and under 10 years of age.</span></div></label>
<select name="children" id="children" class="form-control" required >
    <option value="0" <?php echo $req['children'] == '0'? 'selected':'';?> >0</option>
    <option value="1" <?php echo $req['children'] == '1'? 'selected':'';?> >1</option>
    <option value="2" <?php echo $req['children'] == '2'? 'selected':'';?> >2</option>
    <option value="3" <?php echo $req['children'] == '3'? 'selected':'';?> >3</option>
  </select>
</div>

<div class="vc_col-md-4  vc_col-sm-12" >
<label for="duration"><div class="tooltip">Trip Duration<span class="tooltiptext">Full day is about 7 hs // Half Day is about 5 hs </span></div></label>
<select name="duration" id="duration" class="form-control" required>
    <option value="full-day" <?php echo $req['duration'] == 'full-day'? 'selected':'';?> >Full Day</option>
    <option value="half-day_morning" <?php echo $req['duration'] == 'half-day_morning'? 'selected':'';?> >Half Day Morning</option>
    <option value="half-day_afternoon" <?php echo $req['duration'] == 'half-day_afternoon'? 'selected':'';?> >Half Day Afternoon</option>    
  </select>
</div>

<div class="vc_col-md-4  vc_col-sm-12" >
  <label for="datepicker">Date</label>
  <input id="datepicker" class="form-control" name="datepicker" required autocomplete="off">
  <input id="date" type="hidden" name="date">
</div>


