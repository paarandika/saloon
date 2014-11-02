<?php
/*
Template Name: Front Page with Theme Slider
*/
?>


<?php get_header(); ?>

    <?php get_template_part( 'theme-slider' ); ?>
	
	<div class="main-content">
    	<div class="container">
    	
    	  <div class="row">
    	      
    	      <?php dynamic_sidebar( 'home-above-dark' ); ?>
    	      
    	  </div>
    	</div>
	</div><!-- /container -->
 
<?php

$display_team = ot_get_option('team_front_page', 'yes');
if( "yes" === $display_team ) :
?>
 
	<?php get_template_part( 'darkstripe' ); ?>
    
<?php endif; ?>

	<div class="container">
	
	  <div class="row">
	      
	      <?php dynamic_sidebar( 'home-under-dark' ); ?>
	      
	  </div>
	</div><!-- /container -->
    

<?php get_footer(); ?>
