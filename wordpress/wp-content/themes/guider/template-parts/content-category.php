<div class="m-category layout bg">
	<?php
		echo '<a class="m-category-link layout design" href="' . get_permalink() . '" title="'. get_the_title() . '">' . get_the_post_thumbnail() . '</a>';
		echo '<div class="m-category-name layout bg design font-category">'.the_category().'</div>';
		echo '<p class="wp_rp_title">'. get_the_title() . '</p>';
	?>
</div>