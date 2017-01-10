<header id="header" class="center col-12 banner">
	<div id="header-logo" class="col-8 push-2 no-padding">
		<h1 id="header-logo-h1" class="no-margin center"><a id="header-logo-h1-link" class="brand pure-svg-box" href="<?= esc_url(home_url('/')); ?>"><svg class="pure-svg icon icon-Shortcut-Blog"><use xlink:href="#icon-Shortcut-Blog"></use></svg></a></h1>
	</div>

	<?php
		//global nav
		//drwer menu left
	?>
	<div id="header-globalnav" class="col-2 pull-8 no-padding">
		<input type="checkbox" id="pure-toggle-left" class="pure-toggle" data-toggle="left">
		<label class="left pure-toggle-label" for="pure-toggle-left" data-toggle-label="left">
			<div class="pure-svg-box"><svg class="pure-svg icon icon-MENU"><use xlink:href="#icon-MENU"></use></svg></div>
		</label>
		<nav id="header-globalnav-nav" class="nav-primary pure-drawer" data-position="left">
			<div id="header-globalnav-nav-inner" class="row">
				<?php
					//検索フォーム出力
					get_search_form();
				?>

				<h3 id="header-globalnav-nav-inner-category" class="font-en">CATEGORY</h3>
				<?php
					// カテゴリメニュー
					wp_nav_menu( array('menu' => 'categories', 'container' => ''));
				?>
				<div class="bgf6f5ef">
					<h3 id="header-globalnav-nav-inner-contents" class="font-en">CONTENTS</h3>
					<?php
						// 固定ページメニューの表示
						if (has_nav_menu('primary_navigation')) :
							wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
						endif;
					?>
					<?php
						// SNS
						get_template_part('partials/content-sns');
					?>
				</div>
			</div>
		</nav>

		<?php //drwer menu left ?>
		<label class="pure-overlay" for="pure-toggle-left" data-overlay="left"></label>
	</div>

	<?php
		//local link
		//drwer menu right
	?>
	<?php if( !is_home() ): ?>
		<div id="header-locallink" class="col-2 no-padding">
			<input type="checkbox" id="pure-toggle-right" class="pure-toggle" data-toggle="right">
			<label class="right pure-toggle-label" for="pure-toggle-right" data-toggle-label="right">
				<div class="pure-svg-box"><svg class="pure-svg icon icon-INDEX"><use xlink:href="#icon-INDEX"></use></svg></div>
			</label>

			<nav id="header-locallink-nav" class="nav-primary pure-drawer" data-position="right">
				<?php
					// ページ内リンク
					// wp_nav_menu( array('menu' => 'categories', 'container' => ''));
				?>
				<?php
					// SNS
					// get_template_part('partials/content-sns');
				?>
			</nav>

			<?php //drwer menu right ?>
			<label class="pure-overlay" for="pure-toggle-right" data-overlay="right"></label>
		</div>
	<?php endif; ?>
</header>