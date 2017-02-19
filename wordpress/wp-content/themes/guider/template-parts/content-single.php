<div class="single">
	<div class="single">
		<?php breadcrumb(); ?>
		<div class="single">
			<?php the_post_thumbnail(); ?>
		</div>
		<div class="single">
			<?php the_category(); ?>
		</div>
		<div class="single">
			<h1 class="font-single-title"><?php the_title(); ?></h1>
		</div>
		<div class="single">
			<?php the_time('o-d'); ?>
		</div>
	</div>
	<div class="single-content">
		<?php the_content(); ?>
	</div>
	<div class="single">
		<?php
			// SNS
			get_template_part('template-parts/content-sns');
		?>
	</div>
	<div class="single-prevnext">
		<div class="single-prevnext-box">
			<?php
				$prevpost = get_adjacent_post(false, '', true); //前の記事
				$nextpost = get_adjacent_post(false, '', false); //次の記事
				if( $prevpost or $nextpost ){ //前の記事、次の記事いずれか存在しているとき
			?>
			<?php
				if ( $prevpost ) { //前の記事が存在しているとき
					echo '<a class="single-prev" href="' . get_permalink($prevpost->ID) . '" title="' . get_the_title($prevpost->ID) . '" id="prev"><div class="single-prevnext-item"><i class="fa fa-angle-double-left" aria-hidden="true"></i><span class="font-prev">PREV</span>' . get_the_post_thumbnail($prevpost->ID, array(100,100)) . '<p class="wp_rp_title">' . get_the_title($prevpost->ID) . '</p></div></a>';
				} else { //前の記事が存在しないとき
					echo '<div id="prev_no"><a href="' .home_url('/'). '"><div id="prev_next_home"><i class="fa fa-home"></i></div></a></div>';
				}
				if ( $nextpost ) { //次の記事が存在しているとき
					echo '<a class="single-prevnext" href="' . get_permalink($nextpost->ID) . '" title="'. get_the_title($nextpost->ID) . '" id="next"><div class="single-prevnext-item"><span class="font-next">NEXT</span><i class="fa fa-angle-double-right" aria-hidden="true"></i>' . get_the_post_thumbnail($nextpost->ID, array(100,100)) . '<p class="wp_rp_title">'. get_the_title($nextpost->ID) . '</p></div></a>';
				}
			?>
			<?php } ?>
		</div>
	</div>
	<div class="single-related">
		<h3 class="single-related-title">
			<span class="">RELATED POSTS</span>
			<span class="">関連するカテゴリ記事</span>
		</h3>
		<div class="single-slider">
			<?php wp_related_posts()?>
		</div>
	</div>
	<?php get_template_part( 'template-parts/content-recent', get_post_format() ); ?>
</div>
