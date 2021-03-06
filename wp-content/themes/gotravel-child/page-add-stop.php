<?php
use App\Models\Wordpress;
use App\Models\Calculator;
use App\Controllers\SearchController;
use App\Models\ZohoHelpers\Product as ZohoProduct;
use App\Models\ZohoHelpers\ZohoHandler;

// ZohoHandler::getInstance()->auth();
$c = new SearchController();
//renders the trip seach page

$home = home_url().'/';
$section = 'tour-item/';
$column = 6;
$results = $c->tripSearchPage($_GET, ZohoProduct::getInstance());
// aslo we should check if the trip is valid with a single stop
if (count($results) === 0) {
  Wordpress::redirectCheckout();
}

$isAdmin = false; // the admin need quick access to options
if(is_user_logged_in() && current_user_can('administrator')) {
  $isAdmin = true;
}
// this query should not have mood1
$query = '';
?>
<?php get_header(); ?>

<?php get_template_part('slider'); ?>

	<div class="mkdf-container mtt-tour-list">

		<div class="mkdf-container-inner clearfix">
      <div><?php the_content(); ?></div>
      <div class="vc_col-sm-12 ">
        <p>Do you want to add a stop see the options below</p>
        <p>No, <a href="<?php echo $home.'/my-trip/?'.$_SERVER['QUERY_STRING']; ?>"> continue with checkout</p>
      </div>
      <div class="wpb_wrapper ">
      <?php  foreach ($results as  $t) :  ?>
        <?php 
        if ($isAdmin) {
          $adminTitle = $t['name_en'];
          $adminLink = $home.'my-trip/?mood2='.$t['sku'].'&'.$_SERVER['QUERY_STRING'];
        }          
        ?>
        <?php if(!$isAdmin): // // show/hide mtt-tour-container ?> 
        <div class="vc_col-sm-12 vc_col-md-<?php echo $column; ?> mtt-tour-item">
        <a href="<?php echo $home.$section.$t['sku'].'?'.$_SERVER['QUERY_STRING'].'&action=add'; ?>">
          <div class="mtt-tour-container">
            <div class="mtt-tour-wrapper">
              <div class="mtt-tour-thumbnail">
                <img src="<?php echo get_the_post_thumbnail_url($t['thumbnail']);  ?>" >
              </div>

              <h3>
              <?php echo $t['name_en'];?>
              <?php if($t['promoted']): ?>
              <span><i class="fa fa-star" style="color:#fbdd55"></i></span>
              <?php  endif; ?>
              <?php //if ( strpos($t['link'], 'build-your-own-trip-lunch' ) !== false ) : ?>
              <!-- <br>- 2 island stops -->
              <?php //endif; ?>
              </h3>
            </div>
          </div>
        </a>
        </div>
        <?php else: ?>
          <div>
            <a href="<?php echo $adminLink ?>">
             <p><?php echo $adminTitle ?></p>
            </a>
        </div>
        <?php endif; ?> 
      <?php endforeach; ?>
      </div>
      <div class="mtt-goback vc_col-12">
     <a href="<?php echo $goBack; ?>"><i class="fa fa-arrow-circle-o-left"></i></a>
   </div>
		</div>

	</div>
  <div id="mtt-scroll-down">
    <span>Scroll down to see more options</span>  
    <span class="mkdf-icon-stack">
      <?php echo gotravel_mikado_icon_collections()->renderIcon('lnr-chevron-down', 'linear_icons'); ?>
    </span>
  </div>
<?php get_footer(); ?>