<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.1/css/drawer.min.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri().'/lib/css/base.css'; ?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri().'/lib/css/module.css'; ?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri().'/lib/css/state.css'; ?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri().'/lib/css/theme.css'; ?>">
<!--[if lt IE 9]><script src="<?php echo get_template_directory_uri().'/lib/js/'; ?>html5.js"></script><![endif]-->

<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri().'/lib/img/favicons/apple-touch-icon.png'; ?>/">
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri().'/lib/img/favicons/favicon-32x32.png'; ?>" sizes="32x32">
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri().'/lib/img/favicons/favicon-16x16.png'; ?>" sizes="16x16">
<link rel="manifest" href="<?php echo get_template_directory_uri().'/lib/img/favicons/manifest.json'; ?>/">
<link rel="mask-icon" href="<?php echo get_template_directory_uri().'/lib/img/favicons/safari-pinned-tab.svg'; ?>/" color="#5bbad5">
<meta name="theme-color" content="#ffffff">

<?php
	ob_start();
	wp_head();
	$themeHead = ob_get_contents();
	ob_end_clean();
	define( 'HEAD_CONTENT', $themeHead );

	$allowedTags = '<style><link><meta><title>';
	print theme_strip_tags_content( HEAD_CONTENT, $allowedTags );
?>
</head>