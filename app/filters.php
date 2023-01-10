<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
		return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});


add_filter( 'get_the_archive_title', function ( $title, $original_title ) { 
		$title_to_go = $original_title;
	if(is_post_type_archive('in-depth')) {
			$title_to_go = 'In Depth with&hellip;';
	}
		return $title_to_go; 
}, 10, 2  );

	/**
	* Add <body> classes
	*/
function body_class($classes) {
	 // Add page slug if it doesn't exist
	 if (is_single() || is_page() && !is_front_page()) {
		 if (!in_array(basename(get_permalink()), $classes)) {
			 $classes[] = basename(get_permalink());
		 }
	 }
 
	 static $display;
	 $meta_query_val = get_query_var('artist_filter');
 
	 isset($display) || $display = !in_array(true, [
		 // The sidebar will NOT be displayed if ANY of the following return true.
		 // @link https://codex.wordpress.org/Conditional_Tags
		 is_404(),
		 is_front_page(),
		 is_shop(),
		 is_product(),
		 is_checkout(),
		 is_page_template('template-custom.php'),
		 is_page_template(['template-current_exhibitions.php', 'page-current-exhibition.blade.php']),
		 is_page_template(['template-previous_exhibitions.php', 'page-previous-exhibitions.blade.php']),
		 (is_page_template(['template-previous_exhibitions.php', 'page-previous-exhibitions.blade.php']) && empty($meta_query_val)),
		 is_page_template(['template-upcoming_exhibitions.php', 'page-upcoming-exhibitions.blade.php']),
		 is_page_template('template-viewing-room.php'),
		 is_page_template('page-shop.blade.php'),
		 is_post_type_archive(['artist', 'art_fair', 'in-depth']),
		 is_singular(['exhibition', 'in-depth', 'art_fair'])
	 ]);

	 // Add class if sidebar is active
	 if ($display) {
		 $classes[] = 'sidebar-primary';
	 }
 
	 return $classes;
 }
 add_filter('body_class', __NAMESPACE__ . '\\body_class');
 

function westex_scripts() {
	wp_enqueue_script( 'fontawesome', 'https://use.fontawesome.com/9846696b3f.js', array(), '20170328', false );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\westex_scripts' );

function add_query_vars_filter( $vars ){
	$vars[] = "artist_filter";
	return $vars;
}
add_filter( 'query_vars', __NAMESPACE__ .  '\\add_query_vars_filter' );

function wpsites_query( $query ) {
	if(is_admin() || !$query->is_main_query()) {
		return;
	}

	if( is_home() ) {
		$today = date('Ymd');
		$query->set( 'posts_per_page', 12 );
		$query->set( 'orderby', 'meta_value_num post_date' );
		$query->set( 'order', 'DESC' );
	}

	if ( $query->is_archive() && $query->is_main_query() && !is_admin() ) {
		$query->set( 'posts_per_page', 12 );

		if(is_post_type_archive('press')) {
			$meta_query_val = get_query_var('artist_filter');
			$meta_query = array();
			if($meta_query_val) {
				$meta_query = array(
					'key' => 'artist_press',
					'value' => $meta_query_val,
					'compare' => 'IN'
				);
				$filter = array(
					'meta_query' => array(
						$meta_query,
					)
				);
				$query->set('meta_query', $filter);
			}
		}

		if(is_post_type_archive('in-depth')) {
			$query->set('posts_per_page', -1 );
		}

		if(is_post_type_archive('artist')) {
			$query->set('posts_per_page', -1 );
			$query->set('meta_key', 'artist_sort_order');
			$query->set('orderby', 'meta_value_num');
			$query->set('order', 'ASC');
			return;
		}

		if(is_post_type_archive( 'art_fair' )) {
			$meta_query_val = get_query_var('artist_filter');
			$meta_query = array();
			if($meta_query_val) {
				$meta_query = array(
					'key' => 'western_exhibitions_artists',
					'value' => $meta_query_val,
					'compare' => 'LIKE'
				);
				$filter = array(
					'meta_query' => array(
						$meta_query,
					)
				);
				$query->set('meta_query', $filter);
			}

			$query->set('meta_key', 'start_date');
			$query->set('orderby', 'meta_value_num');
			$query->set('order', 'DESC');
			// return;
		}

	}
	return $query;
}
add_action( 'pre_get_posts', __NAMESPACE__ . '\\wpsites_query' );

function posts_link_attributes() {
	return 'class="w-50"';
}

add_filter('next_posts_link_attributes', __NAMESPACE__ . '\\posts_link_attributes');
add_filter('previous_posts_link_attributes', __NAMESPACE__ . '\\posts_link_attributes');

function theme_slug_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	* supported by Lora, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$gentium = _x( 'on', 'Gentium font: on or off', 'theme-slug' );

	/* Translators: If there are characters in your language that are not
	* supported by Open Sans, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$raleway = _x( 'on', 'Raleway font: on or off', 'theme-slug' );
	$sanchez = _x( 'on', 'Sanchez font: on or off', 'theme-slug' );
	$lato = _x( 'on', 'Lato font: on or off', 'theme-slug' );

	if ( 'off' !== $gentium || 'off' !== $raleway || 'off' !== $sanchez || 'off' !== $lato) {
		$font_families = array();

		if ( 'off' !== $gentium ) {
			$font_families[] = 'Gentium+Book+Basic:400,700,400ital';
		}

		if ( 'off' !== $raleway ) {
			$font_families[] = 'Raleway:400';
		}

		if ( 'off' !== $sanchez ) {
			$font_families[] = 'Sanchez:400';
		}

		if ( 'off' !== $lato ) {
			$font_families[] = 'Lato:400,700';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			// 'subset' => urlencode( 'latin,latin-ext' ),
		);

		// $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css2' );
		$fonts_url = add_query_arg( $query_args, 'https://fonts.bunny.net/css' );
	}

	return esc_url_raw( $fonts_url );
}

function theme_slug_scripts_styles() {
	wp_enqueue_style( 'theme-slug-fonts', theme_slug_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\theme_slug_scripts_styles' );

function theme_slug_editor_styles() {
	add_editor_style( array( 'editor-style.css', theme_slug_fonts_url() ) );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\\theme_slug_editor_styles' );

function westex_image_sizes() {
	add_image_size( 'viewing-room', 720, 720 );
	add_image_size( 'viewing-room-large', 1440, 810 );
	add_image_size( 'viewing-room-full', 2400, 500 );
	add_image_size( 'slide-show', 500, 500 );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\\westex_image_sizes' );

function theme_slug_custom_header_fonts() {
	wp_enqueue_style( 'theme-slug-fonts', theme_slug_fonts_url(), array(), null );
}
add_action( 'admin_print_styles-appearance_page_custom-header', __NAMESPACE__ . '\\theme_slug_custom_header_fonts' );


function westex_change_post_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'News';
	$submenu['edit.php'][5][0] = 'News';
	$submenu['edit.php'][10][0] = 'Add News';
	$submenu['edit.php'][16][0] = 'News Tags';
}

function westex_change_post_object() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'News';
	$labels->singular_name = 'News';
	$labels->add_new = 'Add News';
	$labels->add_new_item = 'Add News';
	$labels->edit_item = 'Edit News';
	$labels->new_item = 'News';
	$labels->view_item = 'View News';
	$labels->search_items = 'Search News';
	$labels->not_found = 'No News found';
	$labels->not_found_in_trash = 'No News found in Trash';
	$labels->all_items = 'All News';
	$labels->menu_name = 'News';
	$labels->name_admin_bar = 'News';
}

add_action( 'admin_menu', __NAMESPACE__ . '\\westex_change_post_label' );
add_action( 'init', __NAMESPACE__ . '\\westex_change_post_object' );

// add_filter('acf/settings/google_api_key', function ($value) {
// 	return GOOGLE_API_KEY;
// });

// remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');

// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart');
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta');

add_filter( 'alm_debug', '__return_true' );
