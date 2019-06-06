<div class="vc_col-md-6  vc_col-sm-12" >
<label for="adults">Adults </label>
  <select name="adults" id="adults" class="form-control">
    <option > </option>
    <option value="2" <?php echo $req['adults'] == 2? 'selected':'';?> >2</option>
    <option value="3" <?php echo $req['adults'] == 3? 'selected':'';?> >3</option>
    <option value="4" <?php echo $req['adults'] == 4? 'selected':'';?> >4</option>
    <option value="5" <?php echo $req['adults'] == 5? 'selected':'';?> >5</option>
  </select>
</div>


<div class="vc_col-md-6  vc_col-sm-12" >
<label for="children"><div class="tooltip">Children<span class="tooltiptext">Paying children are more than 2 and under 10 years of age.</span></div></label>
<select name="children" id="children" class="form-control" >
    <option value="0" <?php echo $req['children'] == '0'? 'selected':'';?> >0</option>
    <option value="1" <?php echo $req['children'] == '1'? 'selected':'';?> >1</option>
    <option value="2" <?php echo $req['children'] == '2'? 'selected':'';?> >2</option>
    <option value="3" <?php echo $req['children'] == '3'? 'selected':'';?> >3</option>
  </select>
</div>
<br>
<div class="vc_col-md-6  vc_col-sm-12">
  <label for="day">Day</label>
  <select name="day" id="day" class="form-control" >
      <option value="0" <?php echo $req['children'] == '0'? 'selected':'';?> >0</option>
      <option value="1" <?php echo $req['children'] == '1'? 'selected':'';?> >1</option>
      <option value="2" <?php echo $req['children'] == '2'? 'selected':'';?> >2</option>
      <option value="3" <?php echo $req['children'] == '3'? 'selected':'';?> >3</option>
    </select>
</div>
<div class="vc_col-md-6  vc_col-sm-12">
  <label for="month">Month</label>
  <select name="month" id="month" class="form-control" >
      <option value="0" <?php echo $req['children'] == '0'? 'selected':'';?> >0</option>
      <option value="1" <?php echo $req['children'] == '1'? 'selected':'';?> >1</option>
      <option value="2" <?php echo $req['children'] == '2'? 'selected':'';?> >2</option>
      <option value="3" <?php echo $req['children'] == '3'? 'selected':'';?> >3</option>
  </select>
</div>
