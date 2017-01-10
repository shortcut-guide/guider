<div class="m-search layout bg">
	<?php

		echo '<a class="m-search-link layout design" href="' . get_permalink() . '" title="'. get_the_title() . '">' . get_the_post_thumbnail() . '</a>';
		echo '<div class="m-search-category layout bg design font-category">'.the_category().'</div>';
		echo '<p class="wp_rp_title">'. get_the_title() . '</p>';
	?>
</div>