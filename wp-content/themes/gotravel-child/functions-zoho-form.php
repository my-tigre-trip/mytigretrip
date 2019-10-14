<?php
use Jenssegers\Blade\Blade;
use App\Models\Calculator;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;

/**
*
*/
function options_form_zoho_shortcode($atts){
$blade = new Blade(__DIR__.'/App/Views', __DIR__.'/App/Cache');

echo $blade->make('zoho-options-form', ['name' => 'Jose']);
}#fin shortcode

add_shortcode( 'formulario_opciones_zoho', 'options_form_zoho_shortcode' );

/**
*
*/
function contact_form_zoho_shortcode($atts){
$blade = new Blade(__DIR__.'/App/Views', __DIR__.'/App/Cache');

echo $blade->make('zoho-form', ['name' => 'Jose']);
}#fin shortcode

add_shortcode( 'formulario_contacto_zoho', 'contact_form_zoho_shortcode' );

/**
*
*
*/
//check list include - not includes
function include_not_include_shortcode($atts){
$blade = new Blade(__DIR__.'/App/Views', __DIR__.'/App/Cache');

echo $blade->make('checklist', ['name' => 'Jose']);
}#fin shortcode

add_shortcode( 'include_not_include', 'include_not_include_shortcode' );

/**
* formulario de opciones (auto , pagar en la isla) previa a entrada de data
* @deprecated
*/
function renderZohoOptionsForm()
{
    $blade = new Blade(__DIR__.'/App/Views', __DIR__.'/App/Cache');
    $myTrip = Session::getMyTrip();

    if ($myTrip === false) {
        wp_redirect(home_url());
        die();
    }

    $myBoat = $myTrip->lock;
    $price = Calculator::calculatePrice($myBoat, $myTrip);

    echo $blade->make('zoho-options-form', ['myTrip' => $myTrip, 'myBoat' => $myBoat]);
}

/**
*
*
*/
function renderZohoForm()
{
  $blade = new Blade(__DIR__.'/App/Views', __DIR__.'/App/Cache');
  $myTrip = unserialize($_SESSION['myTrip']);
  if ($myTrip === false) {
     wp_redirect(home_url());
     die();
  } else {
    $myBoat = $myTrip->lock;
    $price = Calculator::calculatePrice($myBoat, $myTrip);
    $notes = $myTrip->getNotes($myBoat, $price['tourDetail']['price']);
    echo $blade->make('zoho-form', ['myTrip' => $myTrip,
       'myBoat' => $myBoat,
       'boatDetail' => $price['boatDetail'],
       'tourDetail' => $price['tourDetail'],
       'finalPrice' => $price['finalPrice'],
       'price' => $price,
       'notes' => $notes
     ]);
  }

}
/**
*
*
*/
function renderSummary()
{
    $blade = new Blade(__DIR__.'/App/Views', __DIR__.'/App/Cache');
    $myTrip = unserialize($_SESSION['myTrip']);

    $myBoat = $myTrip->lock;
    $price = Calculator::calculatePrice($myBoat, $myTrip);
    $notes = $myTrip->getNotes($myBoat, $price['tourDetail']['price']);
    return $blade->make('calculator.summary', ['myTrip' => $myTrip,
       'myBoat' => $myBoat,
       'boatDetail' => $price['boatDetail'],
       'tourDetail' => $price['tourDetail'],
       'finalPrice' => $price['finalPrice'],
       'price' => $price,
       'notes' => $notes
       ]).'';
}

/**
* 
* @param $boat
* @param $calculator
* @param $productHandler
*/
function renderPriceResult($myTrip, $boat, $calculator, $zohoProduct) {

    $blade = new Blade(__DIR__.'/App/Views', __DIR__.'/App/Cache');
    // $myTrip = unserialize($_SESSION['myTrip']);
    
    // $myTrip = \App\Utils\QueryHelper::queryToMyTrip($req, $zohoProduct);
    # construc myTrip from query
    $currentBoat = $myTrip->getBoat($boat);
    $date = $myTrip->dateFormatted();
    $price = $calculator->calculatePrice($currentBoat, $myTrip);
    $notes = $myTrip->getNotes($currentBoat, $price['tourDetail']['price']);
    return $blade->make('calculator.price-result', [
      'currentBoat' => $currentBoat,
      'boatDetail' => $price['boatDetail'],
      'tourDetail' => $price['tourDetail'],
      'finalPrice' => $price['finalPrice'],
      'price' => $price,
      'notes' => $notes,
      'date'  => $date
      ]
    ).'';
}

/**
* mensages de error: summary-stage
*
*/
function renderMessage($message)
{
  $blade = new Blade(__DIR__.'/App/Views', __DIR__.'/App/Cache');

  return $blade->make('calculator.messages.'.$message).'';
}

//validacion
function validateRequiredFields()
{

    $myTrip = unserialize($_SESSION['myTrip']);
    $myBoat = $myTrip->lock;
//  $response['status'] = 'error';
    $response['status'] = 'valid';
    $break = false;
    if (empty($_POST['firstName']) || empty($_POST['lastName'])) {
        $break = true;
        $response['status'] = 'error';
        $response['message'] = 'First name and last name are required';
    } elseif (!$break && (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
        $break = true;
        $response['status'] = 'error';
        $response['message'] = 'email is empty or no valid';
    } elseif (!$break && empty($_POST['day'])) { // revisar
        $break = true;
        $response['status'] = 'error';
        $response['message'] = 'date is no valid';
    } elseif (!$break && empty($_POST['month'])) { // revisar
        $break = true;
        $response['status'] = 'error';
        $response['message'] = 'date is no valid';
    } elseif (!$break && empty($_POST['year'])) { // revisar
        $break = true;
        $response['status'] = 'error';
        $response['message'] = 'date is no valid';
    } elseif (!$break && ( ($myTrip->car || $myBoat->boat === 'full-day') && empty($_POST['pickupAddress']))) {
        $break = true;
        $response['status'] = 'error';
        $response['message'] = 'pick up address is required';
    }

    if ($break) {
        echo jsonResponse($response);
        die();
    }
}