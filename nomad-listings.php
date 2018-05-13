<?php
/**
 *
 * @link              http://jayanoris.com
 * @since             1.0.0
 * @package           Nomad_Listings
 *
 * @wordpress-plugin
 * Plugin Name:       Nomad Listings
 * Plugin URI:        https://nomadmagazine.co/
 * Description:       A listings plugin for Nomad Magazine
 * Version:           0.0.1
 * Author:            Kelvin Jayanoris
 * Author URI:        http://jayanoris.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       nomad-listings
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined( 'ABSPATH')) {
	die;
}

define('PLUGIN_NAME_VERSION', '0.0.1');
define('BASE', 'nomad-listing');
define('TAX_BASE', 'nomad-');

// Our custom post type function
function create_post_types() {
    register_post_type(
		BASE,
		array(
			'labels' => array(
				'name' => __( 'Listing','nomad_listing' ),
				'singular_name' => __( 'Listing Item','nomad_listing' ),
				'add_item' => __('New Listing Item','nomad_listing'),
				'add_new_item' => __('Add New Listing Item','nomad_listing'),
				'edit_item' => __('Edit Listing Item','nomad_listing'),
				'all_items' => __( 'All Listings','nomad_listing' ),
				'menu_name' => __( 'Nomad Listings','nomad_listing' ),
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'listing'),
			'menu_position' => 5,
			'show_ui' => true,
			'supports' => array(
				'author',
				'title',
				'editor',
				'thumbnail',
				'excerpt',
				'page-attributes',
				'comments'
			),
			'menu_icon'  =>  'dashicons-palmtree'
		)
    );
}

function register_cat_tax() {
	$labels = array(
		'name' => __( 'Listing Categories', 'nomad_listing' ),
		'singular_name' => __( 'Listing Category', 'nomad_listing' ),
		'search_items' =>  __( 'Search Listing Categories','nomad_listing' ),
		'all_items' => __( 'All Listing Categories','nomad_listing' ),
		'parent_item' => __( 'Parent Listing Category','nomad_listing' ),
		'parent_item_colon' => __( 'Parent Listing Category:','nomad_listing' ),
		'edit_item' => __( 'Edit Listing Category','nomad_listing' ),
		'update_item' => __( 'Update Listing Category','nomad_listing' ),
		'add_new_item' => __( 'Add New Listing Category','nomad_listing' ),
		'new_item_name' => __( 'New Listing Category Name','nomad_listing' ),
		'menu_name' => __( 'Listing Categories','nomad_listing' ),
	);
	register_taxonomy(
		TAX_BASE . 'listing-item-category',
		array(BASE),
			array(
				'hierarchical' => true,
				'labels' => $labels,
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'listing-item-category'
			),
		)
	);
}

function register_tag_tax() {
	$labels = array(
		'name' => __( 'Listing Tags', 'nomad_listing' ),
		'singular_name' => __( 'Listing Tag', 'nomad_listing' ),
		'search_items' =>  __( 'Search Listing Tags','nomad_listing' ),
		'all_items' => __( 'All Listing Tags','nomad_listing' ),
		'parent_item' => __( 'Parent Listing Tag','nomad_listing' ),
		'parent_item_colon' => __( 'Parent Listing Tags:','nomad_listing' ),
		'edit_item' => __( 'Edit Listing Tag','nomad_listing' ),
		'update_item' => __( 'Update Listing Tag','nomad_listing' ),
		'add_new_item' => __( 'Add New Listing Tag','nomad_listing' ),
		'new_item_name' => __( 'New Listing Tag Name','nomad_listing' ),
		'menu_name' => __( 'Listing Tags','nomad_listing' ),
	);

	register_taxonomy(
		TAX_BASE . 'listing-item-tag',
		array(BASE),
			array(
				'hierarchical' => false,
				'labels' => $labels,
				'show_ui' => true,
				'query_var' => true,
				'sort'	=> true,
				'args' => array('orderby' => 'term_order'),
				'rewrite' => array( 'slug' => 'listing-item-tag'
			),
		)
	);
}
/**
 * Registers custom tag taxonomy with WordPress
 */
function register_location_tax() {
	$labels = array(
		'name' => __( 'Listing Locations', 'nomad_listing' ),
		'singular_name' => __( 'Listing Location', 'nomad_listing' ),
		'search_items' =>  __( 'Search Listing Locations','nomad_listing' ),
		'all_items' => __( 'All Listing Locations','nomad_listing' ),
		'parent_item' => __( 'Parent Listing Locations','nomad_listing' ),
		'parent_item_colon' => __( 'Parent Listing Locations:','nomad_listing' ),
		'edit_item' => __( 'Edit Listing Location','nomad_listing' ),
		'update_item' => __( 'Update Listing Location','nomad_listing' ),
		'add_new_item' => __( 'Add New Listing Location','nomad_listing' ),
		'new_item_name' => __( 'New Listing Locations Name','nomad_listing' ),
		'menu_name' => __( 'Listing Locations','nomad_listing' ),
	);

	register_taxonomy(
		TAX_BASE . 'listing-item-location',
		array(BASE),
			array(
				'hierarchical' => true,
				'labels' => $labels,
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'listing-item-location'
			),
		)
	);
}


// Hooking up our function to register post types
add_action('init', 'create_post_types');
add_action('init', 'register_cat_tax', 0);
add_action('init', 'register_tag_tax', 0);
add_action('init', 'register_location_tax', 0);