/**
* Handles simply ajax requests
* requires jQuery
*/
function standardRequest(resource, type, data, successCb, timeout = 28000, errorCb = null) {
  jQuery.ajax({
    //ie surely doesn't support shorhand def :)
    url: "/mytigretrip/"+resource+".php",
    type: type,
    data: data,
    success: successCb,
    error: errorCb ? errorCb : function(err) {
      if(err.statusText === "timeout") {
        alert("Please, check your internet connection and try again");
      }
    },
    timeout: timeout    
  });
}

/**
 *
 * 
 */
function formDataToObject(formData) {
  var object = {};
  formData.forEach(function(value, key){
    object[key] = value;
  });
  return object;
}

/**
 *
 */
function queryStringToJSON() {            
  var pairs = location.search.slice(1).split('&');
  
  var result = {};
  pairs.forEach(function(pair) {
      pair = pair.split('=');
      result[pair[0]] = decodeURIComponent(pair[1] || '');
  });

  return JSON.parse(JSON.stringify(result));
}

/**
 * converts date to string
 * 
 */
function dateToString(eDate) {
  var eMonth = eDate.getUTCMonth() + 1; //months from 1-12
  var eDay = eDate.getUTCDate();
  var eYear = eDate.getUTCFullYear();
  return  eDay+''+eMonth+''+eYear;
}
/**
 * 
 * @param {*} el 
 */
function isEmpty( el ){
  return !jQuery.trim(el.html())
}