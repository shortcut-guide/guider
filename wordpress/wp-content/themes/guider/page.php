<?php
	get_template_part( 'template-parts/content-head', 'none' );
?>
<?php get_header(); ?>
<?php

	if( have_posts() ):

		echo '<article class="m-article layout design">';

		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', get_post_format() );
		endwhile;

		echo '</article>';

		wp_simple_pagination();

	else:
		get_template_part( 'template-parts/content-error' );
	endif;
?>

<?php

	get_sidebar();

	get_footer();
?>