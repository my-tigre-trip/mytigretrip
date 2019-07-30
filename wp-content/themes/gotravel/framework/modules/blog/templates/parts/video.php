<?php $_video_type = get_post_meta(get_the_ID(), "mkdf_video_type_meta", true); ?>
<?php if($_video_type == "youtube") { ?>
	<iframe src="https://www.youtube.com/embed/<?php echo esc_attr(get_post_meta(get_the_ID(), "mkdf_post_video_id_meta", true)); ?>?wmode=transparent" wmode="Opaque" width="800" height="600" allowfullscreen></iframe>
<?php } elseif($_video_type == "vimeo") { ?>
	<iframe src="https://player.vimeo.com/video/<?php echo esc_attr(get_post_meta(get_the_ID(), "mkdf_post_video_id_meta", true)); ?>?title=0&amp;byline=0&amp;portrait=0" width="800" height="600" allowFullScreen></iframe>
<?php } elseif($_video_type == "self") { ?>
	<div class="mkdf-self-hosted-video-holder">
		<div class="mkdf-mobile-video-image" style="background-image: url(<?php echo esc_url($meta_temp_image = get_post_meta(get_the_ID(), "mkdf_post_video_image_meta", true)); ?>);"></div>
		<div class="mkdf-video-wrap">
			<video class="mkdf-self-hosted-video" poster="<?php echo esc_url(get_post_meta(get_the_ID(), "video_format_image", true)); ?>" preload="auto">
				<?php if(($meta_temp_mp4 = get_post_meta(get_the_ID(), "mkdf_post_video_mp4_link_meta", true)) != "") { ?>
					<source type="video/mp4" src="<?php echo esc_url($meta_temp_mp4); ?>">
				<?php } ?>
				<object width="320" height="240" type="application/x-shockwave-flash" data="<?php echo esc_url(get_template_directory_uri().'/js/flashmediaelement.swf'); ?>">
					<param name="movie" value="<?php echo esc_url(get_template_directory_uri().'/assets/js/flashmediaelement.swf'); ?>"/>
					<param name="flashvars" value="controls=true&file=<?php echo esc_url($meta_temp_mp4); ?>"/>
					<img src="<?php echo esc_url($meta_temp_image); ?>" width="1920" height="800" title="<?php esc_html_e('No video playback capabilities', 'gotravel'); ?>" alt="<?php esc_html_e('Video thumb', 'gotravel'); ?>"/>
				</object>
			</video>
		</div>
	</div>
<?php } ?>