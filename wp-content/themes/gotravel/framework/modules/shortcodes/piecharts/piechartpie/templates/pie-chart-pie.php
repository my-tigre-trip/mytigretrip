<div <?php mkd_core_class_attribute($holder_classes); ?>>
	<div class="mkdf-pie-chart-pie">
		<canvas id="pie<?php echo esc_attr($id); ?>" class="mkdf-pie" height="<?php echo esc_html($height); ?>" width="<?php echo esc_html($width); ?>" <?php echo gotravel_mikado_get_inline_attrs($pie_chart_data)?>></canvas>
	</div>
	<div class="mkdf-pie-legend">
		<ul>
			<?php foreach ($legend_data as $legend_data_item) { ?>
			<li>
				<div class="mkdf-pie-color-holder" <?php if (isset($legend_data_item['color'])) gotravel_mikado_inline_style($legend_data_item['color']); ?> ></div>
				<p><?php if (isset($legend_data_item['legend'])) echo esc_html($legend_data_item['legend']); ?></p>
				<?php } ?>
			</li>
		</ul>
	</div>
</div>