<div class="m-single-recent layout design">
	<h3 class="m-single-recent-title layout design font-title">
		<span class="en layout design font-title">RECENT POSTS</span>
		<span class="jp layout design font-sub-title">新しい記事</span>
	</h3>
	<div class="m-single-recent-slider layout design">
		<ul class="m-single-recent-list layout design">
			<?php query_posts('posts_per_page=5&ignore_sticky_posts=1'); ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<li class="m-single-recent-list-item layout design">
				<?php if ( has_post_thumbnail() ): ?>
					<a href="<?php the_permalink(); ?>" class="m-single-recent-list-item-thumb layout design"><?php the_post_thumbnail( 'thumb75' ); ?></a>
				<?php else: ?>
					<a href="<?php the_permalink(); ?>" class="m-single-recent-list-item-thumb layout design"><img src="<?php echo get_template_directory_uri(); ?>/images/no-image.png" alt="NO IMAGE" title="NO IMAGE" width="75px" height="75" /></a>
				<?php endif; ?>
				 <a href="<?php the_permalink(); ?>" class="m-single-recent-list-item-title layout design font"><?php the_title();?></a>
				</li>

			<?php endwhile; endif; ?>
			<?php wp_reset_query(); ?>
		</ul>
	</div>
</div>