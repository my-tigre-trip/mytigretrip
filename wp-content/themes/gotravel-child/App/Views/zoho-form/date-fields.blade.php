<div class="w-100"></div>
<div class="card mx-auto  mb-3">
  <div class="card-body">
    <table class="table table-hover">
      <tbody>
        <tr>
          <th scope="row" class="text-left border-top-0" >Your Date</th>
          <td class="border-top-0">{{$myTrip->dateFormatted()}}</td>
          <input type="hidden" name="date" value="{{$myTrip->date}}" />
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="col-md-12 pb-3">
  <label for="mtt-altenative-dates" class="d-none">Alternative Dates (optional)</label>
  <textarea class="form-control" id="mtt-altenative-dates" name="alternativeDates" placeholder="Alternative Dates (optional)"></textarea>
  <!-- <small class="text-info">Alternative Dates (optional) </small> -->
</div>