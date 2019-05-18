<p></p>
<?php
require 'wp-load.php';
session_start();
$redirect = home_url();
//require_once 'MyTrip.php';


if( isset( $_GET['boat']) && isset( $_GET['back'] )  &&
	( $_GET['boat'] == 'speedboat' || $_GET['boat'] == 'half-day' || $_GET['boat'] == 'full-day'  )
	){
    $myTrip = unserialize($_SESSION['myTrip']);
		if( $myTrip !== false  &&  $myTrip->boat !== $_GET['boat']) {
		  //  wp_redirect($redirect.'/#boat-change-alert');
				die();
		}



		 $myTrip = new MyTrip(session_id());
		 $myTrip->boat = $_GET['boat'];
		 $_SESSION['lockBoat'] = $_GET['boat'];
		  	//echo "id ".session_id();
		 $_SESSION['myTrip'] =  serialize($myTrip);


//	$redirect = $_GET['back'];

	switch ($_GET['boat']) {
		case 'speedboat':
			$redirect .= '/tour-item/private-boat-trip';
			break;
		case 'half-day':
			$redirect .= '/half-day-tour';
			break;
		case 'full-day':
			$redirect .= '/full-day-tour';
			break;

		default:
			$redirect = $_GET['back'];
			break;
	}

//	print_r($_SESSION);
	wp_redirect( $redirect );
}else{

	wp_redirect( home_url() );
}
