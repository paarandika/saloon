<?php

if ( 'services' == get_post_type() && ! is_single() ) {
    $title_bg = ot_get_option( 'services_bg', '' );
} elseif ( 'gallery' == get_post_type() ) {
    $title_bg = get_post_meta( get_the_ID(), 'title_bg', true );

    if ( ! is_single() || empty( $title_bg ) ) {
        $title_bg = ot_get_option( 'gallery_bg', '' );
    }
} elseif ( 'team' == get_post_type() ) {
    $title_bg = ot_get_option( 'team_bg', '' );
} elseif ( is_home() || ( is_single() && 'post' === get_post_type() ) || is_category() || is_tag() || is_search() ) {
    $title_bg = get_post_meta( (int)get_option( 'page_for_posts' ), 'title_bg', true );
} elseif ( is_woocommerce_active() && is_woocommerce() ) {
    $title_bg = get_post_meta( (int)get_option( 'woocommerce_shop_page_id' ), 'title_bg', true );
} else {
    $title_bg = get_post_meta( get_the_ID(), 'title_bg', true );
}

$bg_style = create_style_attr($title_bg);
?>
<div class="title-area<?php echo 'navbar-fixed-top' === get_theme_mod( 'navbar_position', 'navbar-fixed-top' ) ? '' : ' shallow'; ?>"<?php echo $bg_style; ?>>
    <div class="container">
        <div class="row">
            <div class="span10">
                <?php
                if ( is_home() ) {
                    $title = ot_get_option( 'blog_page_title', get_bloginfo( 'title' ) );
                } elseif ( is_category() ) {
                    $title = __( 'Category', 'proteusthemes' ) . ': ' . single_cat_title( '', false );
                } elseif ( is_tag() ) {
                    $title = __( 'Tag', 'proteusthemes' ) . ': ' . single_tag_title( '', false );
                } elseif ( is_search() ) {
                    $title = __( 'Search Results For', 'proteusthemes' ) . ' &quot;' . get_search_query() . '&quot;';
                } elseif ( 'services' == get_post_type() ) {
                    $title = ot_get_option( 'services_page_title', __( 'Services' , 'proteusthemes') );
                } elseif ( 'gallery' == get_post_type() ) {
                    $title = ot_get_option( 'gallery_page_title', __( 'Gallery' , 'proteusthemes') );
                } elseif ( 'team' == get_post_type() ) {
                    $title = ot_get_option( 'team_page_title', __( 'Meet the Team' , 'proteusthemes') );
                } elseif ( is_woocommerce_active() && is_woocommerce() ) {
                    ob_start();
                    woocommerce_page_title();
                    $title = ob_get_contents();
                    ob_end_clean();
                } else {
                    $title = get_the_title();
                }

                ?>
                <h1><?php echo strip_tags( $title ); ?></h1>
            </div>
            <?php get_template_part( 'social-icons' ); ?>
        </div>
    </div>
</div>