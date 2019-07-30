<?php

session_start();

use MyTigreTrip\Translation;
use App\Models\Calculator;
use App\Models\MyTrip;
use App\Models\Tour;
use App\Models\Session;
use App\Models\ZohoHelpers\Product as ZohoProduct;
use App\Utils\QueryHelper;


/**
*
*/
function getTheTrip() {
    session_start();
    $myTrip = QueryHelper::queryToMyTrip($_POST, ZohoProduct::getInstance());
    $response = [];

    if ($_POST['_token'] === session_id()) {
      //  $valid = $myTrip->validateFields();
      //zoho hace una validacion
      $valid = true;
      if ($valid === true) {
        $myTrip->save();
        $_SESSION['myTrip'] =  serialize($myTrip);
        //completada la primera parte pasamos al formulario de contacto
        $response = [
          'errors' => false,
          // 'redirect' => home_url().'/my-trip-checkout'
          'redirect' => home_url().'/my-trip-contact-information'
        ];
      } else {
          $response = ['errors' => $valid ];
      }
    }

    $json = json_encode($response);
    if ($json === false) {
      // Avoid echo of empty string (which is invalid JSON), and
      // JSONify the error message instead:
      $json = json_encode(array("jsonError", json_last_error_msg()));
      if ($json === false) {
        // This should not happen, but we go all the way now:
        $json = '{"jsonError": "unknown"}';
      }
      // Set HTTP response status code to: 500 - Internal Server Error
      http_response_code(500);
    }
    header("Content-Type: application/json;charset=utf-8");
    echo trim($json);
}

function tourType($tourId){

    $categories = wp_get_post_terms($tourId, 'tour-category');

    foreach($categories as $c){
        echo "<br> $c->slug";
    }
}

/**
*
*
*/
function jsonResponse($message = null, $code = 200)
{
    // clear the old headers
    header_remove();
    // set the actual code
    http_response_code($code);
    // set the header to make sure cache is forced
    header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
    // treat this as json
    header('Content-Type: application/json');
    $status = array(
        200 => '200 OK',
        400 => '400 Bad Request',
        422 => 'Unprocessable Entity',
        500 => '500 Internal Server Error'
        );
    // ok, validation error, or failure
    header('Status: '.$status[$code]);
    // return the encoded json
    return json_encode(array(
        'status' => $code < 300, // success or not?
        'message' => $message
        ));
}
