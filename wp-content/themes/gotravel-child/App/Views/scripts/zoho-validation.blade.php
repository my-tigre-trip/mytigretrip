<script>
/*
 jQuery('.mtt-button').click(function(e){
   e.preventDefault();
   checkMandatory();


 });
*/
function dayOfWeek(year, month, day) {
      var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      var days  =    ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
      var d = new Date(year, months.indexOf(month), day);
      var n = days[d.getDay()];

      jQuery("#mtt-dayOfWeek").val(n);

    //	var dateGoogle =
      jQuery('#mtt-google-calendar').val(getFormattedDate(new Date(month+" "+day+" "+ year)));
  //    console.log(n  + 'indice '+d);
}
//
//date
function getFormattedDate(date) {
    var year = date.getFullYear();

    var month = (1 + date.getMonth()).toString();
    month = month.length > 1 ? month : '0' + month;

    var day = date.getDate().toString();
    day = day.length > 1 ? day : '0' + day;

    return month + '/' + day + '/' + year;
}

  var mndFileds=new Array('email','day','month','year','firstName','lastName');
  var fldLangVal=new Array('Month','Year','First Name','Last Name');
  var name='';
  var email='';

  function checkMandatory() {

  //deal name

  //goog calendar
  dayOfWeek(jQuery('select[name="day"]').val(), jQuery('select[name="month"]').val(), jQuery('select[name="year"]').val() );

  for(i=0;i<mndFileds.length;i++) {
    var fieldObj=document.forms['WebToLeads3070482000000213007'][mndFileds[i]];
    if(fieldObj) {
    if (((fieldObj.value).replace(/^\s+|\s+$/g, '')).length==0) {
     if(fieldObj.type =='file')
      {
       alert('Please select a file to upload.');
       fieldObj.focus();
       return false;
      }
    alert(fldLangVal[i] +' cannot be empty.');
            fieldObj.focus();
            return false;
    }  else if(fieldObj.nodeName=='SELECT') {
           if(fieldObj.options[fieldObj.selectedIndex].value=='-None-') {
      alert(fldLangVal[i] +' cannot be none.');
      fieldObj.focus();
      return false;
       }
    } else if(fieldObj.type =='checkbox'){
     if(fieldObj.checked == false){
      alert('Please accept  '+fldLangVal[i]);
      fieldObj.focus();
      return false;
       }
     }
     try {
         if(fieldObj.name == 'Last Name') {
      name = fieldObj.value;
        }
    } catch (e) {
      console.log(e);
    }
      }
  }
     }

</script>
