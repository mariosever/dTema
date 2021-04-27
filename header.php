<?php /* header.php */ ?>
<!DOCTYPE html>
<html lang="hr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Red+Hat+Text:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- topbar -->
<div class="topbar">
	<div class="container">
		<span class="email"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/email.svg"> info@dtema.com</span>
		<span class="location"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/lokacija.svg"> Ulica Ivana Horvata 18/a 10000 Zagreb</span>
	</div>
</div>

<!-- navigacija -->
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="<?php echo get_option('siteurl'); ?>">
            <!-- <img src="<?php // echo get_template_directory_uri(); ?>/assets/images/logo.svg" alt="Logo"> -->
            dTema
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="main-menu">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'main-menu',
                'container' => false,
                'menu_class' => '',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
                'depth' => 2,
                'walker' => new bootstrap_5_wp_nav_menu_walker()
            ));
            ?>
        </div>
    </div>
</nav>