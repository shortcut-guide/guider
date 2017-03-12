<?php

// ------------------------------
//=pre_get_posts の設定
// ------------------------------

function myPreGetPosts( $query,
	$home_num		 =3,
	$archive_num	 =5,
	$date_num		 =5,
	$year_num		 =10,
	$month_num		 =10,
	$author_num		 =3,
	$tag_num		 =10,
	$single_num		 =1,
	$page_num		 =1,
	$custom_post_num =1,
	$tax_num		 =10,
	$search_num		 =10,
	$feed_num		 =10,
	$num_404		 =1
) {

	if ( is_admin() || ! $query->is_main_query() ){
		return;
	}

	/* TOPページ */
	if( $query->is_home() ){
		$query->set('posts_per_page', $home_num);
		$query->set('post_type', array('post') );
		return;
	}

	/* NEWS カテゴリページ */
	if ( $query->is_archive('news') ) {
		$query->set('posts_per_page', $archive_num);
		return;
	}

	/* 日付アーカイブページ */
	if( $query->is_date() ){
		$query->set('posts_per_page', $date_num);
	}

	/* 年別アーカイブページ */
	if( $query->is_year() ){
		$query->set('posts_per_page', $year_num);
	}

	/* 月別アーカイブページ */
	if( $query->is_month() ){
		$query->set('posts_per_page', $month_num);
	}

	/* 制作者アーカイブページ */
	if( $query->is_author() ){
		$query->set('posts_per_page', $author_num);
	}

	/* タグページ */
	if( $query->is_tag() ){
		$query->set('posts_per_page', $tag_num);
	}

	/* 詳細ページ */
	if ( $query->is_single() ){
		$query->set('posts_per_page', $single_num);
	}

	/* 固定ページ */
	if( $query->is_page() ){
		$query->set('posts_per_page', $page_num);
	}

	/* カスタム投稿タイプアーカイブページ カスタム投稿タイプを入れてください */
	if( $query->is_post_type_archive( 'post_type' ) ){
		$query->set('posts_per_page', $custom_post_num);
	}

	/* タクソノミーページ */
	if( $query->is_tax() ){
		$query->set('posts_per_page', $tax_num);
	}

	/* 検索結果ページ */
	if( $query->is_search() ){
		$query->set('posts_per_page', $search_num);
	}

	/* フィードページ */
	if( $query->is_feed() ){
		$query->set('posts_per_page', $feed_num);
	}

	/* 404ページ */
	if( $query->is_404() ){
		$query->set('posts_per_page', $num_404);
	}
}

// ------------------------------
//=JS enqueue
// ------------------------------

function load_external_jQuery() {
	wp_deregister_script( 'jquery' );
	wp_register_script('yqn0wze', 'https://use.typekit.net/yqn0wze.js',array(), NULL, true);
	wp_register_script('iscroll', 'https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.1.3/iscroll.min.js',array(), NULL, true);
	wp_register_script('drawer', 'https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.1/js/drawer.min.js',array(), NULL, true);
	wp_register_script('prefixfree', get_template_directory_uri().'/lib/js/prefixfree.min.js',array(), NULL, true);
	wp_register_script('smooth', get_template_directory_uri().'/lib/js/smooth.js',array(), NULL, true);
	wp_register_script('main', get_template_directory_uri().'/lib/js/main.js',array(), NULL, true);

	wp_enqueue_script('yqn0wze');
	wp_enqueue_script('iscroll');
	wp_enqueue_script('drawer');
	wp_enqueue_script('prefixfree');
	wp_enqueue_script('smooth');
	wp_enqueue_script('main');
}

function theme_strip_tags_content($text, $tags = '', $invert = false) {

	preg_match_all( '/<(.+?)[\s]*\/?[\s]*>/si', trim( $tags ), $tags );
	$tags = array_unique( $tags[1] );

	if ( is_array( $tags ) AND count( $tags ) > 0 ) {
		if ( false == $invert ) {
			return preg_replace( '@<(?!(?:'. implode( '|', $tags ) .')\b)(\w+)\b.*?>.*?</\1>@si', '', $text );
		}
		else {
			return preg_replace( '@<('. implode( '|', $tags ) .')\b.*?>.*?</\1>@si', '', $text );
		}
	}
	elseif ( false == $invert ) {
		return preg_replace( '@<(\w+)\b.*?>.*?</\1>@si', '', $text );
	}

	return $text;
}

// ------------------------------
//=Delete
// ------------------------------

// Remove Recent comments
function remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}

// Remove Open Sans
function remove_wp_open_sans() {
	wp_deregister_style( 'open-sans' );
	wp_register_style( 'open-sans', false );
}

// ------------------------------
//=Adds
// ------------------------------

// ページに、カテゴリメタボックスを追加する
function add_categories_for_pages(){
	register_taxonomy_for_object_type('category', 'page');
}

// ------------------------------
//=bread list
// ------------------------------

function breadcrumb(){
	global $post;
	$str ='';
	if(!is_home()&&!is_admin()){ /* !is_admin は管理ページ以外という条件分岐 */
		$str.= '<div class="m-breadcrumb layout bg design transition">';
		$str.= '<ul class="m-breadcrumb-list layout bg design transition">';
		$str.= '<li class="m-breadcrumb-list-item layout bg design transition" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="m-breadcrumb-list-item-link layout font bg design transition" href="' . home_url('/') .'" itemprop="url"><span class="m-breadcrumb-list-item-link-span layout font bg design transition" itemprop="title">HOME</span></a></li>';
		/* 投稿のページ */
		if(is_single()){
			$categories = get_the_category($post->ID);
			$cat = $categories[0];
			if($cat -> parent != 0){
				$ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
				foreach($ancestors as $ancestor){
					$str.='<li class="m-breadcrumb-list-item layout font bg design transition" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="m-breadcrumb-list-item-link layout font bg design transition" href="'. get_category_link($ancestor).'"  itemprop="url" ><span class="m-breadcrumb-list-item-link-span layout font bg design transition" itemprop="title">'. get_cat_name($ancestor). '</span></a></li>';
				}
			}
			$str.='<li class="m-breadcrumb-list-item layout font bg design transition" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="m-breadcrumb-list-item-link layout font bg design transition" href="'. get_category_link($cat -> term_id). '" itemprop="url" ><span class="m-breadcrumb-list-item-link-span layout font bg design transition" itemprop="title">'. $cat-> cat_name . '</span></a></li>';
			// $str.= '<li class="m-breadcrumb-list-item layout font bg design transition" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span class="m-breadcrumb-list-item-span" itemprop="title">'. $post -> post_title .'</span></li>';
		}
		/* 固定ページ */
		elseif(is_page()){
			if($post -> post_parent != 0 ){
				$ancestors = array_reverse(get_post_ancestors( $post->ID ));
				foreach($ancestors as $ancestor){
					$str.='<li class="m-breadcrumb-list-item layout font bg design transition" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="m-breadcrumb-list-item-link layout font bg design transition" href="'. get_permalink($ancestor).'" itemprop="url" ><span class="m-breadcrumb-list-item-link-span layout font bg design transition" itemprop="title">'. get_the_title($ancestor) .'</span></a></li>';
				}
			}
			// $str.= '<li class="m-breadcrumb-list-item layout font bg design transition" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span class="m-breadcrumb-list-item-span" itemprop="title">'. $post -> post_title .'</span></li>';
		}
		/* カテゴリページ */
		elseif(is_category()) {
			$cat = get_queried_object();
			if($cat -> parent != 0){
				$ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
				foreach($ancestors as $ancestor){
					$str.='<li class="m-breadcrumb-list-item layout font bg design transition" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="m-breadcrumb-list-item-link layout font bg design transition" href="'. get_category_link($ancestor) .'" itemprop="url" ><span class="m-breadcrumb-list-item-link-span layout" itemprop="title">'. get_cat_name($ancestor) .'</span></a></li>';
				}
			}
			$str.='<li class="m-breadcrumb-list-item layout font bg design transition" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span class="m-breadcrumb-list-item-span layout" itemprop="title">'. $cat -> name . '</span></li>';
		}
		/* タグページ */
		elseif(is_tag()){
			$str.='<li class="m-breadcrumb-list-item layout font bg design transition" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span class="m-breadcrumb-list-span layout font bg design transition" itemprop="title">'. single_tag_title( '' , false ). '</span></li>';
		}
		/* 時系列アーカイブページ */
		elseif(is_date()){
			if(get_query_var('day') != 0){
				$str.='<li class="m-breadcrumb-list-item layout font bg design transition" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="m-breadcrumb-list-item-link layout font bg design transition" href="'. get_year_link(get_query_var('year')). '" itemprop="url" ><span class="m-breadcrumb-list-item-link-span layout font bg design transition" itemprop="title">' . get_query_var('year'). '年</span></a></li>';
				$str.='<li class="m-breadcrumb-list-item layout font bg design transition" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="m-breadcrumb-list-item-link layout font bg design transition" href="'. get_month_link(get_query_var('year'), get_query_var('monthnum')). '" itemprop="url" ><span class="m-breadcrumb-list-item-link-span layout font bg design transition" itemprop="title">'. get_query_var('monthnum') .'月</span></a></li>';
				$str.='<li class="m-breadcrumb-list-item layout font bg design transition" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span class="m-breadcrumb-list-item-link-span layout font bg design transition" itemprop="title">'. get_query_var('day'). '</span>日</li>';
			} elseif(get_query_var('monthnum') != 0){
				$str.='<li class="m-breadcrumb-list-item layout font bg design transition" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="m-breadcrumb-list-item-link layout font bg design transition" href="'. get_year_link(get_query_var('year')) .'" itemprop="url" ><span class="m-breadcrumb-list-item-link-span layout font bg design transition" itemprop="title">'. get_query_var('year') .'年</span.</a></li>';
				$str.='<li class="m-breadcrumb-list-item layout font bg design transition" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span class="m-breadcrumb-list-item-link-span layout font bg design transition" itemprop="title">'. get_query_var('monthnum'). '</span>月</li>';
			} else {
				$str.='<li class="m-breadcrumb-list-item layout font bg design transition" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span class="m-breadcrumb-list-span layout font bg design transition" itemprop="title">'. get_query_var('year') .'年</span></li>';
			}
		}

		/* 投稿者ページ */
		elseif(is_author()){
			$str .='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span class="m-breadcrumb-list-span layout font bg design transition" itemprop="title">投稿者 : '. get_the_author_meta('display_name', get_query_var('author')).'</span></li>';
		}
		/* 添付ファイルページ */
		elseif(is_attachment()){
			if($post -> post_parent != 0 ){
				$str.= '<li class="m-breadcrumb-list-item layout font bg design transition" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="m-breadcrumb-list-item-link layout font bg design transition" href="'. get_permalink($post -> post_parent).'" itemprop="url" ><span class="m-breadcrumb-list-item-link-span layout font bg design transition" itemprop="title">'. get_the_title($post -> post_parent) .'</span></a></li>';
			}
			// $str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span class="m-breadcrumb-list-span layout font bg design transition" itemprop="title">' . $post -> post_title . '</span></li>';
		}

		/* 検索結果ページ */
		elseif(is_search()){
			$str.='<li class="m-breadcrumb-list-item layout font bg design transition" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span class="m-breadcrumb-list-span layout font bg design transition" itemprop="title">「'. get_search_query() .'」で検索した結果</span></li>';
		}
		/* 404 Not Found ページ */
		elseif(is_404()){
			$str.='<li class="m-breadcrumb-list-item layout font bg design transition" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span class="m-breadcrumb-list-span layout font bg design transition" itemprop="title">お探しの記事は見つかりませんでした。</span></li>';
		}
		/* その他のページ */
		else{
			$str.='<li class="m-breadcrumb-list-item layout font bg design transition" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span class="m-breadcrumb-list-span layout font bg design transition" itemprop="title">'. wp_title('', false) .'</span></li>';
		}
		$str.='</ul>';
		$str.='</div>';
	}
	echo $str;
}


// ------------------------------
//=widget
// ------------------------------

function myWidget(){
	register_sidebar(array(
		'name' => 'main menu',
		'id' => 'main-menu',
		'description' => '',
		'before_widget' => '<div class="m-widget layout bg design transition">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="m-widget-h3 layout font bg design transition">',
		'after_title' => '</h3>'
	));
}

function formWidget(){
	register_sidebar(array(
		'name' => 'footer',
		'id' => 'm-footer',
		'description' => '',
		'before_widget' => '<div class="m-footer layout bg design transition">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="m-footer-h3 layout font bg design transition">',
		'after_title' => '</h3>'
	));
}

// ------------------------------
//=search form
// ------------------------------

function my_search_form( $form ){
	$form = '<div class="m-search layout bg design transition"><form class="m-search-form layout bg design transition" role="search" method="get" action="'.home_url( '/' ).'" ><div class="layout bg design transition"><input class="m-search-form-input layout font bg design transition" type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Search Keyword"><button class="m-search-form-submit layout font bg design transition" type="submit" value=""><i class="fa fa-search layout font bg design transition" aria-hidden="true"></i></button></div></form></div>';
	return $form;
}

// ------------------------------
//= アーカイブページで現在のカテゴリー・タグ・タームを取得する
// ------------------------------
function get_current_term(){

	$id;
	$tax_slug;

	if(is_category()){
		$tax_slug = "category";
		$id = get_query_var('cat');	
	}else if(is_tag()){
		$tax_slug = "post_tag";
		$id = get_query_var('tag_id');	
	}else if(is_tax()){
		$tax_slug = get_query_var('taxonomy');	
		$term_slug = get_query_var('term');	
		$term = get_term_by("slug",$term_slug,$tax_slug);
		$id = $term->term_id;
	}

	return get_term($id,$tax_slug);
}

// ------------------------------
//=JSON-LD
// ------------------------------

function insert_json_ld(){
	if (is_single()) {
		global $post;
		$context = 'http://schema.org';
		$type = 'Article';

		//記事のタイトル
		$name = get_the_title();

		// 著者情報
		$authorType = 'Person';
		$authorName = get_the_author();

		// 記事が公開された日付
		$dataPublished = get_the_date('Y-n-j');

		// 記事の画像
		$thumbnail_id = get_post_thumbnail_id($post->ID);
		$image = wp_get_attachment_image_src( $thumbnail_id, 'full' );
		$imageurl = $image[0];

		// 記事のカテゴリ
		$category_info = get_the_category();
		$articleSection = $category_info[0]->name;

		// 記事内容
		$articleBody = get_the_content();

		//記事のURL
		$url = get_permalink();

		// 記事を発行元
		$publisherType = 'Organization';
		$publisherName = get_bloginfo('name');

		$json= "
		\"@context\" : \"{$context}\",
		\"@type\" : \"{$type}\",
		\"name\" : \"{$name}\",
		\"author\" : {
			\"@type\" : \"{$authorType}\",
			\"name\" : \"{$authorName}\"
		},
		\"datePublished\" : \"{$dataPublished}\",
		\"image\" : \"{$imageurl}\",
		\"articleSection\" : \"{$articleSection}\",
		\"url\" : \"{$url}\",
		\"publisher\" : {
			\"@type\" : \"{$publisherType}\",
			\"name\" : \"{$publisherName}\"
		}
		";
		echo '<script type="application/ld+json">{'.$json.'}</script>';
	}
}

// ------------------------------
//=the_category
// ------------------------------
// the_category にclassを付与
function add_class_to_category( $thelist ){

	$class_to_add = 'm-new-list-item-link font-category';
	return str_replace('<a href="', '<a class="' . $class_to_add . '" href="', $thelist);
}

// ------------------------------
//=trim_title
// ------------------------------
// 記事タイトルの文字数制限
function trim_title($num){
	$base_title = get_the_title();
	$trim_title = mb_substr($base_title, 0, $num ,"utf-8");
	$count_title = mb_strlen($trim_title,"utf-8");
	if($count_title > $num-1) {
		echo $trim_title . '…';
	} else {
		echo $trim_title;
	}
}

// ------------------------------
//=trim_excerpt
// ------------------------------
// オリジナルの抜粋記事
function trim_excerpt($a) {

	if(has_excerpt()) {

		$base_content = get_the_excerpt();
		$base_content = str_replace(array("\r\n", "\r", "\n"), "", $base_content);
		$trim_content = mb_substr($base_content, 0, $a ,"utf-8");

	} else {

		$base_content = get_the_content();
		$base_content = preg_replace('!<style.*?>.*?</style.*?>!is', '', $base_content);
		$base_content = preg_replace('!<script.*?>.*?</script.*?>!is', '', $base_content);
		$base_content = strip_tags($base_content);
		$trim_content = mb_substr($base_content, 0, $a ,"utf-8");
		$trim_content = mb_ereg_replace('&nbsp;', '', $trim_content);

	}

	if(mb_strlen($trim_content)>($a-1)){
		echo $trim_content . '…';
	}else{
		echo $trim_content;
	}
}

// ------------------------------
//=Pagging
// ------------------------------
function get_pagination($pages = '', $range = 2){
	 // $showitems = ($range * 2)+1;
	$showitems = $range+1;
	global $paged;
	if(empty($paged)) $paged = 1;
	if($pages == ''){
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages){
			$pages = 1;
		}
	}
	if(1 != $pages){
		echo "<div class='m-pagination layout design'>";
		echo "<ul class=\"m-pagination-list layout bg design transition\">";
		if($paged > 1 && $showitems < $pages) echo "<li class=\"m-pagination-list-item previous layout bg design transition\"><a class=\"m-pagination-list-item-link layout font-pagination bg design transition\" href='".get_pagenum_link($paged - 1)."'>PREVIOUS<i class=\"fa fa-angle-double-left\" aria-hidden=\"true\"></i></a></li>";
		for ($i=1; $i <= $pages; $i++){

			if( ( ( $pages >= 5 ) && ( $i == 4 ) ) || $pages <= $showitems ){
				echo "<li class=\"m-pagination-list-item is-current layout font-pagination bg design transition\">...</li>";
			}else{
				if ( ( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ) ){
					echo ($paged == $i)? "<li class=\"m-pagination-list-item is-current layout font-pagination bg design transition\">".$i."</li>":"<li class=\"m-pagination-list-item is-active layout font-pagination bg design transition\"><a class=\"m-pagination-list-item-link layout font-pagination bg design transition\" href='".get_pagenum_link($i)."'>".$i."</a></li>";
				}
			}
		}
		if ($paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages){

			echo "<li class=\"m-pagination-list-item layout bg design transition\"><a class=\"m-pagination-list-item-link layout font-pagination bg design transition\" href='".get_pagenum_link($pages)."'>".$pages."</a></li>";
		}
		if ($paged < $pages && $showitems < $pages) echo "<li class=\"m-pagination-list-item layout bg design transition\"><a class=\"m-pagination-list-item-link layout font-pagination bg design transition\" href=\"".get_pagenum_link($paged + 1)."\">NEXT<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i></a></li>";
		echo "</ul>";
		echo "</div>";
	}
}

// ------------------------------
//=toc
// ------------------------------
// 記事の目次を作成する
function make_toc($atts){
	$atts = shortcode_atts(array(
		'id'          => '',
		'class'       => 'toc',
		'title'       => '目次',
		'showcount'   => 2,
		'depth'       => 0,
		'toplevel'    => 1,
		'targetclass' => 'article-main'
	),$atts);

	$content     = get_the_content();
	$headers     = array();
	$html        = '';
	$toc_list    = '';
	$id          = $atts['id'];
	$toggle      = '';
	$counter     = 0;
	$counters    = array(0,0,0,0,0,0);
	$top_level   = intval($atts['toplevel']);
	$harray      = array();
	$targetclass = trim($atts['targetclass']);
	if($targetclass===''){$targetclass = get_post_type();}
	for($h = $atts['toplevel']; $h <= 6; $h++){$harray[] = '"h' . $h . '"';}
	$harray = implode(',',$harray);

	preg_match_all('/<([hH][1-3]).*?>(.*?)<\/[hH][1-3].*?>/u',$content,$headers);
	$header_count = count($headers[0]);
	if($header_count > 0){
		$level = strtolower($headers[1][0]);
		if($top_level < $level){$top_level = $level;}
	}
	if($top_level < 1){$top_level = 1;}
	if($top_level > 3){$top_level = 3;}
	$atts['toplevel'] = $top_level;
	$current_depth = $top_level - 1;
	$prev_depth = $top_level - 1;
	$max_depth = (($atts['depth'] == 0) ? 3 : intval($atts['depth'])) - $top_level + 1;

	for($i=0;$i < $header_count;$i++){
		$depth = 0;
		switch(strtolower($headers[1][$i])){
			// case 'h1': $depth = 1 - $top_level + 1; break;
			case 'h2': $depth = 1 - $top_level + 1; break;
			case 'h3': $depth = 2 - $top_level + 1; break;
			// case 'h4': $depth = 4 - $top_level + 1; break;
			// case 'h5': $depth = 5 - $top_level + 1; break;
			// case 'h6': $depth = 6 - $top_level + 1; break;
		}
		if($depth >= 1 && $depth <= $max_depth){
			if($current_depth == $depth){$toc_list .= '</li>';}
			while($current_depth > $depth){
				$toc_list .= '</li></ol>';
				$current_depth--;
				$counters[$current_depth] = 0;
			}
			if($current_depth != $prev_depth){$toc_list .= '</li>';}
			if($current_depth < $depth){
				$toc_list .= '<ol' . (($current_depth == $top_level - 1) ? ' class="toc-list open"' : '') . '>';
				$current_depth++;
			}
			$counters[$current_depth - 1] ++;
			$counter++;
			$toc_list .= '<li><a href="#toc' . $counter . '" tabindex="0">' . $headers[2][$i] . '</a>';
			$prev_depth = $depth;
		}
	}
	while($current_depth >= 1 ){
		$toc_list .= '</li></ol>';
		$current_depth--;
	}
	if($counter >= $atts['showcount']){
		if($id!==''){$id = ' id="' . $id . '"';}else{$id = '';}
		$html .= '
		<div' . $id . ' class="' . $atts['class'] . '">' . $toc_list .'</div>
		<script>
			window.onload = function () {
				var idCounter = 0;
				var sub = [' . $harray . '];
				var targetClasses = document.getElementsByClassName("' . $targetclass . '");
				for (var i = 0; i < targetClasses.length; i++) {
					var targetClass = targetClasses[i];
					for (var m = 0; m < sub.length; m++) {
						var targetHx = String(sub[m]);
						var targetElements = targetClass.getElementsByTagName(targetHx);
						for (var n = 0; n < targetElements.length; n++) {
							var targetElement = targetElements[n];
							if (targetElement.hasAttribute("class") === false) {
								idCounter++;
								targetElement.id = "toc" + idCounter;
							}
						}
					}
				}
			};
		</script>';
	}
	return $html;
}

function wkwkrnht_add_quicktags(){
	if(wp_script_is('quicktags')===true){ ?>
	<script>
		QTags.addButton('qt-toc','目次','[toc id= class=toc title=目次 showcount=2 depth=0 toplevel=1 targetclass=article-main offset=]');
	</script>
	<?php }
}


// ------------------------------
//=UA
// ------------------------------
// ユーザーエージェントを判定するための関数
// if(is_mobile)
function is_mobile() {

	$match = 0;

	$ua = array(
	 'iPhone', // iPhone
	 'iPod', // iPod touch
	 'Android.*Mobile', // 1.5+ Android *** Only mobile
	 'Windows.*Phone', // *** Windows Phone
	 'dream', // Pre 1.5 Android
	 'CUPCAKE', // 1.5+ Android
	 'BlackBerry', // BlackBerry
	 'webOS', // Palm Pre Experimental
	 'incognito', // Other iPhone browser
	 'webmate' // Other iPhone browser
	 );

	$pattern = '/' . implode( '|', $ua ) . '/i';
	$match   = preg_match( $pattern, $_SERVER['HTTP_USER_AGENT'] );

	if ( $match === 1 ) {
		return TRUE;
	} else {
		return FALSE;
	}

}

// ------------------------------
// ウィジウィグ制御
// ------------------------------
function wpautop_filter($content) {
	global $post;
	$remove_filter = false;
	$arr_types = array('page','facility','special','shinryouka'); //自動整形を無効にする投稿タイプを記述
	$post_type = get_post_type( $post->ID );
	if (in_array($post_type, $arr_types)) $remove_filter = true;
	if ( $remove_filter ) {
		remove_filter('the_content', 'wpautop');
		remove_filter('the_excerpt', 'wpautop');
	}
	return $content;
}

// ------------------------------
//=add_actions
// ------------------------------

add_action( 'widgets_init', 'remove_recent_comments_style');
add_action( 'login_init', 'login_change_init' );
add_action( 'pre_get_posts','myPreGetPosts');
add_action( 'widgets_init', 'myWidget' );
add_action( 'widgets_init', 'formWidget' );
add_action( 'wp_head','insert_json_ld');
add_action( 'init','add_categories_for_pages');
add_action( 'admin_print_footer_scripts','wkwkrnht_add_quicktags');

if(!is_admin()):
	add_action('wp_enqueue_scripts', 'load_external_jQuery');
endif;

if (!function_exists('remove_wp_open_sans')):
	add_action( 'wp_enqueue_scripts', 'remove_wp_open_sans');
endif;

// ------------------------------
//=add_filter
// ------------------------------

add_filter( 'widget_text', 'do_shortcode');
add_filter( 'get_search_form', 'my_search_form' );
add_filter( 'the_content', 'wpautop_filter', 9);

if(!is_admin()):
	add_filter( 'the_category','add_class_to_category');
endif;
// ------------------------------
//=add_shortcode
// ------------------------------
add_shortcode('toc','make_toc');

// ------------------------------
//=remove_action
// ------------------------------

//rsd
remove_action('wp_head', 'rsd_link');

//fest_link
remove_action('wp_head', 'wlwmanifest_link');

//generator
remove_action('wp_head', 'wp_generator');

//shortlink
remove_action('wp_head','wp_shortlink_wp_head',10,0);

// emoji
remove_action( 'wp_head', 'print_emoji_detection_script',7);
remove_action( 'wp_print_styles', 'print_emoji_styles' );