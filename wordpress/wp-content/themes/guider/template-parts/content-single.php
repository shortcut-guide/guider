<div class="m-single layout bg">
	<div class="m-single-header layout bg design">
		<?php breadcrumb(); ?>
		<div class="m-single-thumbnail layout bg design">
			<?php the_post_thumbnail(); ?>
		</div>
		<div class="m-single-category layout bg design font-category">
			<?php the_category(); ?>
		</div>
		<div class="m-single-title layout bg design">
			<h1 class="font-single-title"><?php the_title(); ?></h1>
		</div>
		<div class="m-single-time layout bg design font-time">
			<?php the_time('o-m-d'); ?>
		</div>
	</div>
	<div class="m-single-content layout bg design">
		<?php the_content(); ?>
	</div>
	<div class="m-single-sns layout bg design">
		<?php
			// SNS
			get_template_part('template-parts/content-sns');
		?>
	</div>
	<div class="m-single-prevnext layout design">
		<div class="m-single-prevnext-box layout design">
			<?php
				$prevpost = get_adjacent_post(false, '', true); //前の記事
				$nextpost = get_adjacent_post(false, '', false); //次の記事
				if( $prevpost or $nextpost ){ //前の記事、次の記事いずれか存在しているとき
			?>
			<?php
				if ( $prevpost ) { //前の記事が存在しているとき
					echo '<a class="m-single-prevnext-link layout bg design" href="' . get_permalink($prevpost->ID) . '" title="' . get_the_title($prevpost->ID) . '" id="prev"><div class="m-single-prevnext-item layout design"><i class="fa fa-angle-double-left" aria-hidden="true"></i><span class="font-prev">PREV</span>' . get_the_post_thumbnail($prevpost->ID, array(100,100)) . '<p class="wp_rp_title">' . get_the_title($prevpost->ID) . '</p></div></a>';
				} else { //前の記事が存在しないとき
					echo '<div id="prev_no"><a href="' .home_url('/'). '"><div id="prev_next_home"><i class="fa fa-home"></i></div></a></div>';
				}
				if ( $nextpost ) { //次の記事が存在しているとき
					echo '<a class="m-single-prevnext-link bg design" href="' . get_permalink($nextpost->ID) . '" title="'. get_the_title($nextpost->ID) . '" id="next"><div class="m-single-prevnext-item layout design"><span class="font-next">NEXT</span><i class="fa fa-angle-double-right" aria-hidden="true"></i>' . get_the_post_thumbnail($nextpost->ID, array(100,100)) . '<p class="wp_rp_title">'. get_the_title($nextpost->ID) . '</p></div></a>';
				}
			?>
			<?php } ?>
		</div>
	</div>
	<div class="m-single-related layout design">
		<h3 class="m-single-related-title layout design">
			<span class="en layout design font-title">RELATED POSTS</span>
			<span class="jp layout design font-sub-title">関連するカテゴリ記事</span>
		</h3>
		<div class="m-single-slider layout design">
			<?php wp_related_posts()?>
		</div>
	</div>
	<?php get_template_part( 'template-parts/content-recent', get_post_format() ); ?>
</div>
