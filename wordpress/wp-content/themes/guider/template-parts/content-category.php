<?php
$cat = get_categories();
    query_posts('cat='.$category);
    if(have_posts()):while(have_posts()):the_post();
        the_content();
    endwhile; wp_reset_query();
endforeach;
?>
