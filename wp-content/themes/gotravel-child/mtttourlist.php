<?php /* Template Name: MyTigreTrip Listado de Tours */
session_start();
$myTrip = unserialize($_SESSION['myTrip']);

if( $myTrip )
{
  $myTrip = $myTrip->getBoat('full-day');
  //print_r($myTrip->mood1->notCompatible);
}

//global $product
$queryCat = '';
$type = 'tour-item';
$url = '';
$priceMessage = __('less automated group discount', 'mtt');
$goBack = home_url().'/';
$column = 6;

  //query_posts( 'post_type=tour-item&tour-category='.$queryCat );build-you-own-trip-lunch
if (is_page('full-day-tour')) {
    $goBack .= '#boat-selection';
    $type = 'multi';
    $column = 4;
    $queryCat = 'pre-built-tours';
    $the_query = new WP_Query(
       ['post_type'=>'page',
        'post_name__in' =>  ['build-your-own-trip-lunch'],
        'order' => 'ASC'
        ] );

} elseif (is_page('half-day-tour')){
    $goBack .= '#boat-selection';
    $type = 'page';
    $queryCat = 'pre-built-tours';
    $the_query = new WP_Query(
       ['post_type'=>'page',
        'post_name__in' =>  ['half-day-delta-experiences','half-day-lunch-options'],
        'order' => 'ASC'
        ] );

} elseif (is_page('pre-built-tours')) {
    $goBack .= 'full-day-tour';
    $queryCat = 'pre-built-tours';

  }elseif( is_page('build-your-own-trip-lunch') ){
    $goBack .= 'full-day-tour';
    $queryCat = 'build-your-own-trip-lunch';

  }elseif( is_page('build-you-own-trip-add-stop') ){//
    $goBack .= 'build-your-own-trip-lunch';
    $queryCat = 'build-your-own-tigre-trip-stop';
    $priceMessage = __('additional', 'mtt');

  }
  elseif( is_page('half-day-delta-experiences') ){
    $goBack .= 'half-day-tour';
    $queryCat = 'half-day-trip-stop';

  }elseif( is_page('half-day-lunch-options') ){
    $goBack .= 'half-day-tour';
    $queryCat = 'half-day-trip-lunch';

  }else {
  // query_posts( 'post_type=tour-item&tour-category='.$queryCat );
  }

if ($type == 'tour-item' || $type == 'multi') {
    query_posts('post_type=tour-item&tour-category='.$queryCat );
    $results = [];
    while (have_posts() ) : the_post();
     //filtramos para no ofrecer la misma parada
        $fullDayCompatible = true;
        $secondStop = basename(get_permalink());
        if ($myTrip != null && $myTrip->mood1 !== null) {         
            //echo 'NOT: '.$myTrip->mood1->notCompatible;
            if ($myTrip->mood1->notCompatible === $secondStop) {
                $fullDayCompatible = false;
            }
        }

        if ($fullDayCompatible) {
            $results [get_the_ID()] = [
                'id'=> get_the_ID() ,
                'title' => get_the_title(),
                'price' => getTourPrice(get_the_ID()),
                'link' => get_permalink(),
                'recommended' => intval(get_post_meta(get_the_ID(), 'mkdf_tours_custom_label')[0])
            ];
            //print_r( get_post_meta(get_the_ID(), 'mkdf_tours_custom_label'));
        }
    endwhile;
    wp_reset_query();

  //orden por recommended de menor a mayor
   $recommendedResults = array();
   foreach ($results as $tour) {
       $recommendedResults[] = $tour['recommended'];
   }

array_multisort($recommendedResults, SORT_ASC, $results);
//ksort($results);
//print_r($results);
}
if ($type == 'page' || $type == 'multi') {
  while ( $the_query->have_posts() ) : $the_query->the_post();
      $results [get_the_ID()] = ['id'=> get_the_ID() ,'title' => get_the_title(),'link' => get_page_link()  ];
  endwhile;
  //wp_reset_query();
  wp_reset_postdata();
}

?>
<?php get_header(); ?>

<?php get_template_part( 'slider' ); ?>

	<div class="mkdf-container mtt-tour-list">

		<div class="mkdf-container-inner clearfix">
      <div><?php the_content(); ?></div>

      <div class="wpb_wrapper ">
      <?php  foreach ($results as  $t) :  ?>
        <div class="vc_col-sm-12 vc_col-md-<?php echo $column; ?> mtt-tour-item">
        <a href="<?php echo $t['link']; ?>">
          <div class="mtt-tour-container">
            <div class="mtt-tour-wrapper">

            <div class="mtt-tour-thumbnail">
              <img src="<?php echo get_the_post_thumbnail_url($t['id']);  ?>" >
            </div>

            <h3>
            <?php echo $t['title'];?>
            <?php if(get_post_meta($t['id'], 'mkdf_tours_custom_label_skin')[0] === 'skin3'): ?>
            <span><i class="fa fa-star" style="color:#fbdd55"></i></span>
            <?php endif; ?>
            <?php if ( strpos($t['link'], 'build-your-own-trip-lunch' ) !== false ) : ?>
            <!-- <br>- 2 island stops -->
            <?php endif; ?>
            </h3>

            </div>

          </div>

        </a>
        </div>
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
