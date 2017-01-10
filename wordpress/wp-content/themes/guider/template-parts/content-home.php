<?php
	// 要約フィールド
	$digest1 = get_field('digest1',$post->ID);
	$digest2 = get_field('digest2',$post->ID);
	$digest3 = get_field('digest3',$post->ID);

	foreach((get_the_category()) as $cat) {
		$cat_id = $cat->cat_ID ;
		break ;
	}
	$category_link = get_category_link( $cat_id );
?>

<section class="m-new-section layout bg design">
	<div class="m-new-section-meta layout">
		<ul class="m-new-section-list">
			<li class="m-new-section-list-item"><a class="m-new-list-item-link font-category" href="<?php echo $category_link; ?>" title="<?php echo $cat->cat_name; ?>"> <?php echo $cat->cat_name; ?></a></li>
		</ul>
		<time class="m-new-section-time layout font-time"><?php the_time('o-m-d'); ?></time>
	</div>
	<div class="m-new-section-header layout">
		<div class="m-new-section-thumbnail layout design"><?php the_post_thumbnail(); ?></div>
		<div class="m-new-section-title layout design">
			<h1 class="m-new-section-title-h1"><a class="font-item-title" href="<?php the_permalink(); ?>"><?php trim_title(26); ?></a></h1>
		</div>
	</div>
	<div class="m-new-section-digest layout">
		<ul class="m-new-section-digest-list">
			<?php if(!empty($digest1)) echo '<li class="m-new-section-digest-list-item layout bg font-digest design">'.$digest1.'</li>'; ?>
			<?php if(!empty($digest2)) echo '<li class="m-new-section-digest-list-item layout bg font-digest design">'.$digest2.'</li>'; ?>
			<?php if(!empty($digest3)) echo '<li class="m-new-section-digest-list-item layout bg font-digest design">'.$digest3.'</li>'; ?>
		</ul>
	</div>
</section>