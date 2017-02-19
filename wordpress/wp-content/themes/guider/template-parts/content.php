<?php
	$post_array = array(
		'content',
	);
?>
<div id="post-<?php the_ID(); ?>" <?php post_class($post_array); ?>>
	<?php
		if( is_home() ):
			get_template_part( 'template-parts/content-home', get_post_format() );
		endif;

		if( is_single() ):
			get_template_part( 'template-parts/content-single', get_post_format() );
		endif;

		if( is_search() ):
			get_template_part( 'template-parts/content-search', get_post_format() );
		endif;

		if( is_category() ):
			get_template_part( 'template-parts/content-category', get_post_format() );
		endif;

		if( is_page() ):
			get_template_part( 'template-parts/content-page', get_post_format() );
		endif;
	?>
</div>
