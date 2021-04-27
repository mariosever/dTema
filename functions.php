<?php

if ( ! function_exists( 'dtema_setup' ) ) {

    function dtema_setup() {
     
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'title-tag' );

        register_nav_menu( 'primary', 'Primary Menu' );

        add_theme_support( 'post-formats', array ( 'aside', 'gallery', 'quote', 'image', 'video' ) );

    }

}

add_action( 'after_setup_theme', 'dtema_setup' );


// učitaj skripte i css 
if ( ! function_exists( 'dtema_scripts_and_styles' ) ) {

	function dtema_scripts_and_styles() {

		$cache_ver = '1.0';

		wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css?v='.time(), array(), false, 'all' );

		wp_register_style( 'global', get_template_directory_uri() . '/assets/css/main.css?v='.time(), array(), false, 'all' );

		wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), $cache_ver, true );

		wp_register_script( 'global', get_template_directory_uri() . '/assets/js/main.js', array(), $cache_ver, true );

		wp_enqueue_style( 'bootstrap' );
		wp_enqueue_style( 'global' );
		wp_enqueue_script( 'bootstrap' );
		wp_enqueue_script( 'global' );

	}

}

add_action( 'wp_enqueue_scripts', 'dtema_scripts_and_styles' );


// bootstrap 5 wp_nav_menu walker
class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_menu
{
  private $current_item;
  private $dropdown_menu_alignment_values = [
    'dropdown-menu-start',
    'dropdown-menu-end',
    'dropdown-menu-sm-start',
    'dropdown-menu-sm-end',
    'dropdown-menu-md-start',
    'dropdown-menu-md-end',
    'dropdown-menu-lg-start',
    'dropdown-menu-lg-end',
    'dropdown-menu-xl-start',
    'dropdown-menu-xl-end',
    'dropdown-menu-xxl-start',
    'dropdown-menu-xxl-end'
  ];

  function start_lvl(&$output, $depth = 0, $args = array())
  {
    $dropdown_menu_class[] = '';
    foreach($this->current_item->classes as $class) {
      if(in_array($class, $this->dropdown_menu_alignment_values)) {
        $dropdown_menu_class[] = $class;
      }
    }
    $indent = str_repeat("\t", $depth);
    $submenu = ($depth > 0) ? ' sub-menu' : '';
    $output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ",$dropdown_menu_class)) . " depth_$depth\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
  {
    $this->current_item = $item;

    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $li_attributes = '';
    $class_names = $value = '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
    $classes[] = 'nav-item';
    $classes[] = 'nav-item-' . $item->ID;
    if ($depth && $args->walker->has_children) {
      $classes[] = 'dropdown-menu dropdown-menu-end';
    }

    $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = ' class="' . esc_attr($class_names) . '"';

    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
    $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

    $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

    $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    $active_class = ($item->current || $item->current_item_ancestor) ? 'active' : '';
    $attributes .= ($args->walker->has_children) ? ' class="nav-link ' . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="nav-link ' . $active_class . '"';

    $item_output = $args->before;
    $item_output .= ($depth > 0) ? '<a class="dropdown-item"' . $attributes . '>' : '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}
// register a new menu
register_nav_menu('main-menu', 'Main menu');


/* excerpt options */
function dtema_excerpt_length( $length ) {
  return 35;
}

add_filter( 'excerpt_length', 'dtema_excerpt_length');

function new_excerpt_more( $more ) {
  return '...'; // replace the normal [.....] with a empty string
}  

add_filter('excerpt_more', 'new_excerpt_more');




// Our custom post type function
function create_posttype() {
 
    register_post_type( 'proizvodi',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Proizvodi' ),
                'singular_name' => __( 'Proizvod' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'proizvodi'),
            'show_in_rest' => true,
            'menu_icon'     => 'dashicons-cart',
            'menu_position'     => 4,
 
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

function custom_post_type() {
 
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Proizvodi', 'Post Type General Name', 'dtema' ),
        'singular_name'       => _x( 'Proizvod', 'Post Type Singular Name', 'dtema' ),
        'menu_name'           => __( 'Proizvods', 'dtema' ),
        'parent_item_colon'   => __( 'Parent Proizvod', 'dtema' ),
        'all_items'           => __( 'Svi Proizvodi', 'dtema' ),
        'view_item'           => __( 'Pregledaj Proizvod', 'dtema' ),
        'add_new_item'        => __( 'Dodaj novi Proizvod', 'dtema' ),
        'add_new'             => __( 'Dodaj novi', 'dtema' ),
        'edit_item'           => __( 'Uredi Proizvod', 'dtema' ),
        'update_item'         => __( 'Ažuriraj Proizvod', 'dtema' ),
        'search_items'        => __( 'Pretraži Proizvode', 'dtema' ),
        'not_found'           => __( 'Nije pronađeno', 'dtema' ),
        'not_found_in_trash'  => __( 'Nije pronađeno u smeću', 'dtema' ),
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'Proizvodi', 'dtema' ),
        'description'         => __( 'Proizvod news and reviews', 'dtema' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'category' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
        'menu_icon'     => 'dashicons-cart',
 
    );
     
    // Registering your Custom Post Type
    register_post_type( 'Proizvodi', $args );
 
}
 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
 
add_action( 'init', 'custom_post_type', 0 );


?>