<div class="single-recent">
	<h3 class="single-recent-title">
		<span class="">RECENT POSTS</span>
		<span class="">新しい記事</span>
	</h3>
	<div class="single-recent-slider">
		<ul class="single-recent-list">
			<?php query_posts('posts_per_page=5&ignore_sticky_posts=1'); ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<li class="single-recent-list-item">
				<?php if ( has_post_thumbnail() ): ?>
					<a href="<?php the_permalink(); ?>" class="single-recent-list-item-thumb"><?php the_post_thumbnail( 'thumb75' ); ?></a>
				<?php else: ?>
					<a href="<?php the_permalink(); ?>" class="single-recent-list-item-thumb"><img src="<?php echo get_template_directory_uri(); ?>/images/no-image.png" alt="NO IMAGE" title="NO IMAGE" width="75px" height="75" /></a>
				<?php endif; ?>
				 <a href="<?php the_permalink(); ?>" class="single-recent-list-item-title"><?php the_title();?></a>
				</li>
			<?php endwhile; endif; ?>
			<?php wp_reset_query(); ?>
		</ul>
	</div>
</div>