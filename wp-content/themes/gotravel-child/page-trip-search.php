<?php
use App\Models\Wordpress;
use App\Models\Calculator;
use App\Controllers\SearchController;
use App\Models\ZohoHelpers\Product as ZohoProduct;
use App\Models\ZohoHelpers\ZohoHandler;

ZohoHandler::getInstance()->auth();
$c = new SearchController();
//renders the trip seach page

$home = home_url().'/';
$section = 'tour-item/';
$column = 6;
$results = $c->tripSearchPage($_GET, ZohoProduct::getInstance());

$isAdmin = false; // the admin need quick access to option
if(is_user_logged_in() && current_user_can('administrator')) {
  $isAdmin = true;
}

// foreach ($results as $r) {
//     echo "$r[name]<br>";
// }
// this query should not have mood1
$query = '';
?>
<?php get_header(); ?>

<?php get_template_part('slider'); ?>

	<div class="mkdf-container mtt-tour-list">

		<div class="mkdf-container-inner clearfix">
      <div><?php the_content(); ?></div>

      <div class="wpb_wrapper ">
      <?php  foreach ($results as  $t) :  ?>
        <?php 
        if ($isAdmin) {
          $adminTitle = $t['name_en'];
          $adminLink = $home.'add-stop/?mood1='.$t['sku'].'&'.$_SERVER['QUERY_STRING'];
        }          
        ?>
        <?php if(!$isAdmin): // // show/hide mtt-tour-container ?>  
        <div class="vc_col-sm-12 vc_col-md-<?php echo $column; ?> mtt-tour-item">       
          <a href="<?php echo $home.$section.$t['sku'].'?'.$_SERVER['QUERY_STRING']; ?>">       
          <div class="mtt-tour-container">
            <div class="mtt-tour-wrapper">
            
            <div class="mtt-tour-thumbnail">
              <img src="<?php echo $t['picUrl']  ?>" >
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
        <?php endif; // show/hide mtt-tour-container  ?>    
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