<body <?php body_class('drawer drawer--left'); ?>>
<div class="container">
<header class="m-header layout bg design">
	<div class="m-header-box layout">
		<div class="m-header-globalnav layout">
			<button class="m-header-globalnav-box layout drawer-toggle" type="button">
				<span class="m-header-globalnav-h3 bg design">MENU</span>
			</button>
			<nav class="m-header-globalnav-nav layout drawer-nav">
				<div class="m-header-globalnav-nav-box layout drawer-menu">
					<?php
						//検索フォーム出力
						get_search_form();
					?>
					<div class="m-header-glonalnav-nav-in layout design">
						<h3 class="m-header-globalnav-nav-h3 layout design font-title">CATEGORY</h3>
						<?php
							//カテゴリメニュー
							wp_nav_menu( array('menu' => 'categories','container' => '' ) );
						?>
						<div class="m-header-globalnav-nav-content layout">

							<?php
								//固定ページメニューの表示
								if( has_nav_menu('primary_navigation') ):
									wp_nav_menu(['theme_location'=>'primary_navigation','menu_class' => 'nav']);
								endif;
							?>
						</div>
					</div>
					<div class="m-header-globalnav-nav-external layout design">
						<h3 class="m-header-globalnav-nav-external-h3 layout design font-title">CONTENTS</h3>
						<ul class="m-header-globalnav-nav-external-list layout design">
							<li class="m-header-globalnav-nav-external-list-item layout design"><a href="https://portfolio.shortcut.guide/#portfolio" class="m-header-globalnav-nav-external-list-item-link layout design" />Portfolio</li>
							<li class="m-header-globalnav-nav-external-list-item layout design"><a href="https://portfolio.shortcut.guide/#about" class="m-header-globalnav-nav-external-list-item-link layout design">About</a></li>
							<li class="m-header-globalnav-nav-external-list-item layout design"><a href="https://portfolio.shortcut.guide/#contact" class="m-header-globalnav-nav-external-list-item-link layout design">Contact</a></li>
						</ul>
						<?php
							// SNS
							get_template_part('template-parts/content-social');
						?>
					 </div>
				</div>
			</nav>
		</div>

		<div class="m-header-logo layout">
			<h1 class="m-header-logo-h1 layout">
				<a href="<?= esc_url(home_url('/')); ?>" class="m-header-logo-h1-link bg trantision design">ショートカットブログ</a>
			</h1>
		</div>

		<?php //local Link ?>
		<?php if( is_single() ): ?>
			<div class="m-header-locallink layout design">
				<button class="m-header-locallink-box layout" type="button">
					<span class="m-header-locallink-button bg design">INDEX</span>
				</button>
				<button class="m-header-locallink-box layout close" type="button">
					<span class="m-header-locallink-button bg design">CLOSE</span>
				</button>
				<nav class="m-header-locallink-nav layout design overlay">
					<div class="m-header-locallink-nav-box layout design">

						<h3 class="m-header-locallink-h3 layout design">
							<span class="en layout design font-title">INDEX</span>
							<span class="jp layout design font-sub-title">記事の目次になります</span>
						</h3>
						<?php
							//目次
							while ( have_posts() ) : the_post();
								echo do_shortcode('[toc]');
							endwhile;
						?>
						<?php
							// SNS
							get_template_part('template-parts/content-sns');
						?>
					</div>
				</nav>
			</div>
		<?php endif; ?>
	</div>
</header>