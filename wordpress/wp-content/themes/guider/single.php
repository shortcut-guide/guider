<?php
	get_template_part( 'template-parts/content-head', 'none' );
?>
<?php get_header(); ?>
<?php

	if( have_posts() ):

		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', get_post_format() );
		endwhile;

		wp_simple_pagination();

	else:
		get_template_part( 'template-parts/content-error' );
	endif;

	get_sidebar();

	query_posts('posts_per_page=1');
	while ( have_posts() ) : the_post();
		echo do_shortcode( '[mwform_formkey key="15"]' );
	endwhile;

	get_footer();
?>