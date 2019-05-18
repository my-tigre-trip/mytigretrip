
<?php

function open_info_section_shortcode(){
    ?>

    <div class="vc_row wpb_row vc_row-fluid mkdf-section mkdf-content-aligment-left" style="">
      <div class="clearfix mkdf-full-section-inner">
        <div class="wpb_column vc_column_container vc_col-sm-12">
          <div class="vc_column-inner ">
            <div class="wpb_wrapper">


        <div class="mkdf-info-section-part mkdf-tour-item-main-info">
         <h3 >Trip Details <a class="mtt-collapse mtt-green" data-collapse="collapseGoodToKnow" href="#" aria-expanded="false" aria-controls="collapseGoodToKnow"></a></h3> 
         <ul id="collapseGoodToKnow" class="mkdf-tour-main-info-holder clearfix">


    <?php
}
add_shortcode( 'abrir-seccion-info', 'open_info_section_shortcode' );
function close_info_section_shortcode(){
    ?>
        </ul>
        </div>
                </div>
              </div>
            </div>
          </div>
        </div>


    <?php
}
add_shortcode( 'cerrar-seccion-info', 'close_info_section_shortcode' );
//fila
function info_row_shortcode($atts){
    $atts = shortcode_atts( array(

        'titulo' =>  '','info' => ''

    ), $atts, 'info-fila' );

?>
<li class="clearfix ">
    <div class="col6 mkdf-info"><?php echo $atts['titulo'];?></div>
    <div class="col6 mkdf-value"><?php echo $atts['info'];?></div>
</li>
<?php //vc_col-md-6 vc_col-sm-12
}
add_shortcode( 'info-fila', 'info_row_shortcode' );

//include
function tour_includes_shortcode($atts){
    $atts = shortcode_atts( array(

        'titulo' =>  '','info' => ''

    ), $atts, 'tour-incluye' );


?>
<li class="clearfix mkdf-tours-checked-attributes">
    <div class="col6 mkdf-info"><?php echo $atts['titulo'];?></div>

    <div class="vc_col-md-6 vc_col-sm-12 mkdf-value">
        <?php foreach( explode('::', $atts['info']) as $info ): ?>
        <div class="mkdf-tour-main-info-attr"><?php echo $info;?></div>
        <?php endforeach; ?>
    </div>

</li>
<?php
}
add_shortcode( 'tour-incluye', 'tour_includes_shortcode' );

//not include

//include
function tour_not_includes_shortcode($atts){
    $atts = shortcode_atts( array(

        'titulo' =>  '','info' => ''

    ), $atts, 'tour-no-incluye' );


?>
<li class="clearfix mkdf-tours-unchecked-attributes">
    <div class="col6 mkdf-info"><?php echo $atts['titulo'];?></div>

    <div class="vc_col-md-6 vc_col-sm-12 mkdf-value">
        <?php foreach( explode('::', $atts['info']) as $info ): ?>
        <div class=" mkdf-tour-main-info-attr"><?php echo $info;?></div>
        <?php endforeach; ?>
    </div>

</li>
<?php
}
add_shortcode( 'tour-no-incluye', 'tour_not_includes_shortcode' );


function tour_yes_no_includes_shortcode($atts){
    $atts = shortcode_atts( array(

        'titulo' =>  '','info-si' => '','info-no'=> ''

    ), $atts, 'tour-si-no-incluye' );


?>
<li class="clearfix mkdf-tours-checked-attributes" style="padding-bottom:0">
    <div class="col6 mkdf-info"><?php echo $atts['titulo'];?></div>

    <div class="vc_col-md-6 vc_col-sm-12 mkdf-value">
        <?php foreach( explode('::', $atts['info-si']) as $info ): ?>
        <div class="col6 mkdf-tour-main-info-attr"><?php echo $info;?></div>
        <?php endforeach; ?>
    </div>

</li>
<li class="clearfix mkdf-tours-unchecked-attributes" style="border-top:none;padding-top:0">
    <div class="col6 mkdf-info" style="visibility:hidden"><?php echo $atts['titulo'];?></div>

    <div class="vc_col-md-6 vc_col-sm-12 mkdf-value">
        <?php foreach( explode('::', $atts['info-no']) as $info ): ?>
        <div class="mkdf-tour-main-info-attr"><?php echo $info;?></div>
        <?php endforeach; ?>
    </div>

</li>

<?php
}
add_shortcode( 'tour-si-no-incluye', 'tour_yes_no_includes_shortcode' );

?>
