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

<section class="section">
	<div class="section-meta">
		<ul class="section-list">
			<li class="section-list-item"><a class="list-item-link" href="<?php echo $category_link; ?>" title="<?php echo $cat->cat_name; ?>"> <?php echo $cat->cat_name; ?></a></li>
		</ul>
		<time class="section-time"><?php the_time('o-m-d'); ?></time>
	</div>
	<div class="section-header">
		<div class="section-thumbnail"><?php the_post_thumbnail(); ?></div>
		<div class="section-title">
			<h1 class="section-title-h1"><a class="" href="<?php the_permalink(); ?>"><?php trim_title(26); ?></a></h1>
		</div>
	</div>
	<div class="section-digest">
		<ul class="section-digest-list">
			<?php if(!empty($digest1)) echo '<li class="section-digest-list-item">'.$digest1.'</li>'; ?>
			<?php if(!empty($digest2)) echo '<li class="section-digest-list-item">'.$digest2.'</li>'; ?>
			<?php if(!empty($digest3)) echo '<li class="section-digest-list-item">'.$digest3.'</li>'; ?>
		</ul>
	</div>
</section>