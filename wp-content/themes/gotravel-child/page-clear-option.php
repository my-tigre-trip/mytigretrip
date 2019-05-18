<p></p>
<?php
require 'wp-load.php';
\App\Models\Session::clear();
wp_redirect( home_url().'/#boat-selection' );
