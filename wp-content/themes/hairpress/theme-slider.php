<div class="rev_slider_wrapper fullwidthbanner-container fullwidthbanner-container-custom">
	<div class="rev_slider fullwidthabanner">
		<ul>
			<?php
			$slider = new WP_Query( array(
				'post_type' => 'slider',
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'nopaging' => true,
			) );
			$slider_transition = ot_get_option( 'theme_slider_transition', 'random' );
			while ( $slider->have_posts() ) :
				$slider->the_post();
			?>
		 <li data-transition="<?php echo $slider_transition; ?>" data-slotamount="7">
			<?php $attr = array(
				'data-fullwidthcentering' => 'on',
			);
			the_post_thumbnail( 'slider', $attr ); ?>
		   <div class="custom-cap"><?php echo strip_tags( get_the_title() ); ?></div>
		 </li>
		 <?php endwhile; ?>
		</ul>
		<?php wp_reset_postdata(); ?>
	</div>
	<div class="container">
		<div class="row">
			<div class="span9">
				<div class="slider-title">
					<!-- <div class="icon icons-double-line"></div> -->
					<div class="semi-white-bg" id="custom-caption-container">

					</div>
					<nav class="nav-icons">
						<a href="#" class="icon icons-slider-nav-left" id="slider-nav-left"></a>
						<a href="#" class="icon icons-slider-nav-right" id="slider-nav-right"></a>
					</nav>
				</div>
			</div>
			<div class="span3">
				<?php dynamic_sidebar( 'above-slider' ); ?>
			</div>
			<?php get_template_part( 'social-icons' ); ?>
		</div>
	</div>
</div>