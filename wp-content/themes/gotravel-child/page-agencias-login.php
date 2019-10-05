<?php
use App\Models\Wordpress;
use App\Models\Session;
use App\Controllers\AgencyController;
use App\Models\ZohoHelpers\Agency as ZohoAgency;
use App\Models\ZohoHelpers\ZohoHandler;
use Jenssegers\Blade\Blade;
use App\Utils\ViewRenderer;

$c = new AgencyController();
$blade = new Blade(__DIR__.'/App/Views', __DIR__.'/App/Cache');
$view = new ViewRenderer($blade, $session);
$WP = Wordpress::getInstance();
//renders the agency login or realize the auth
echo $c->login($view, $WP);
