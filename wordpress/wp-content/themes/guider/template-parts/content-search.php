<div class="search">
	<?php
		echo '<a class="search-link" href="' . get_permalink() . '" title="'. get_the_title() . '">' . get_the_post_thumbnail() . '</a>';
		echo '<div class="search-category">'.the_category().'</div>';
		echo '<p class="">'. get_the_title() . '</p>';
	?>
</div>