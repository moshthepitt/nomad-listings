<?php
/**
 * Nomad Listings
 *
 * Nomad Listings plugin.
 *
 * @category Plugin
 * @package  Nomad_Listings
 * @author   Kelvin Jayanoris <kelvin@jayanoris.com>
 * @license  https://github.com/moshthepitt/nomad-listings/blob/master/LICENSE GPL-2.0+
 * @link     https://github.com/moshthepitt/nomad-listings
 *
 * @wordpress-plugin
 * Plugin Name:       Nomad Listings
 * Plugin URI:        https://nomadmagazine.co/
 * Description:       A listings plugin for Nomad Magazine
 * Version:           0.0.1
 * Author:            Kelvin Jayanoris
 * Author URI:        http://jayanoris.com
 * License:           GPL-2.0+
 * License URI:       https://github.com/moshthepitt/nomad-listings/blob/master/LICENSE
 */

// include composer packages
require plugin_dir_path(__FILE__) . 'vendor/autoload.php';

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    die;
}

define('PLUGIN_NAME_VERSION', '0.0.1');
define('BASE', 'nomad-listing');
define('TAX_BASE', 'nomad-');
define('PREFIX', 'nomad_');

/**
 * Register custom post types and taxonomies with WordPress
 */

// Our custom post type function
function create_post_types()
{
    register_post_type(
        BASE,
        array(
            'labels' => array(
                'name' => __('Listing', 'nomad_listing'),
                'singular_name' => __('Listing Item', 'nomad_listing'),
                'add_item' => __('New Listing Item', 'nomad_listing'),
                'add_new_item' => __('Add New Listing Item', 'nomad_listing'),
                'edit_item' => __('Edit Listing Item', 'nomad_listing'),
                'all_items' => __('All Listings', 'nomad_listing'),
                'menu_name' => __('Nomad Listings', 'nomad_listing'),
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
                'comments',
            ),
            'menu_icon' => 'dashicons-palmtree',
        )
    );
}

// Custom taxonomies
function register_cat_tax()
{
    $labels = array(
        'name' => __('Listing Categories', 'nomad_listing'),
        'singular_name' => __('Listing Category', 'nomad_listing'),
        'search_items' => __('Search Listing Categories', 'nomad_listing'),
        'all_items' => __('All Listing Categories', 'nomad_listing'),
        'parent_item' => __('Parent Listing Category', 'nomad_listing'),
        'parent_item_colon' => __('Parent Listing Category:', 'nomad_listing'),
        'edit_item' => __('Edit Listing Category', 'nomad_listing'),
        'update_item' => __('Update Listing Category', 'nomad_listing'),
        'add_new_item' => __('Add New Listing Category', 'nomad_listing'),
        'new_item_name' => __('New Listing Category Name', 'nomad_listing'),
        'menu_name' => __('Listing Categories', 'nomad_listing'),
    );
    register_taxonomy(
        TAX_BASE . 'listing-item-category',
        array(BASE),
        array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'listing-item-category',
            ),
        )
    );
}

function register_tag_tax()
{
    $labels = array(
        'name' => __('Listing Tags', 'nomad_listing'),
        'singular_name' => __('Listing Tag', 'nomad_listing'),
        'search_items' => __('Search Listing Tags', 'nomad_listing'),
        'all_items' => __('All Listing Tags', 'nomad_listing'),
        'parent_item' => __('Parent Listing Tag', 'nomad_listing'),
        'parent_item_colon' => __('Parent Listing Tags:', 'nomad_listing'),
        'edit_item' => __('Edit Listing Tag', 'nomad_listing'),
        'update_item' => __('Update Listing Tag', 'nomad_listing'),
        'add_new_item' => __('Add New Listing Tag', 'nomad_listing'),
        'new_item_name' => __('New Listing Tag Name', 'nomad_listing'),
        'menu_name' => __('Listing Tags', 'nomad_listing'),
    );

    register_taxonomy(
        TAX_BASE . 'listing-item-tag',
        array(BASE),
        array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'sort' => true,
            'args' => array('orderby' => 'term_order'),
            'rewrite' => array('slug' => 'listing-item-tag',
            ),
        )
    );
}

function register_location_tax()
{
    $labels = array(
        'name' => __('Listing Locations', 'nomad_listing'),
        'singular_name' => __('Listing Location', 'nomad_listing'),
        'search_items' => __('Search Listing Locations', 'nomad_listing'),
        'all_items' => __('All Listing Locations', 'nomad_listing'),
        'parent_item' => __('Parent Listing Locations', 'nomad_listing'),
        'parent_item_colon' => __('Parent Listing Locations:', 'nomad_listing'),
        'edit_item' => __('Edit Listing Location', 'nomad_listing'),
        'update_item' => __('Update Listing Location', 'nomad_listing'),
        'add_new_item' => __('Add New Listing Location', 'nomad_listing'),
        'new_item_name' => __('New Listing Locations Name', 'nomad_listing'),
        'menu_name' => __('Listing Locations', 'nomad_listing'),
    );

    register_taxonomy(
        TAX_BASE . 'listing-item-location',
        array(BASE),
        array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'listing-item-location',
            ),
        )
    );
}

function register_feature_tax()
{
    $labels = array(
        'name' => __('Listing Features', 'nomad_listing'),
        'singular_name' => __('Listing Feature', 'nomad_listing'),
        'search_items' => __('Search Listing Features', 'nomad_listing'),
        'all_items' => __('All Listing Features', 'nomad_listing'),
        'parent_item' => __('Parent Listing Feature', 'nomad_listing'),
        'parent_item_colon' => __('Parent Listing Features:', 'nomad_listing'),
        'edit_item' => __('Edit Listing Feature', 'nomad_listing'),
        'update_item' => __('Update Listing Feature', 'nomad_listing'),
        'add_new_item' => __('Add New Listing Feature', 'nomad_listing'),
        'new_item_name' => __('New Listing Feature Name', 'nomad_listing'),
        'menu_name' => __('Listing Features', 'nomad_listing'),
        'choose_from_most_used' => __('Choose from common features', 'nomad_listing'),
    );

    register_taxonomy(
        TAX_BASE . 'listing-item-feature',
        array(BASE),
        array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'sort' => true,
            'args' => array('orderby' => 'term_order'),
            'rewrite' => array('slug' => 'listing-item-feature',
            ),
        )
    );
}

function register_amenity_tax()
{
    $labels = array(
        'name' => __('Listing Amenities', 'nomad_listing'),
        'singular_name' => __('Listing Amenity', 'nomad_listing'),
        'search_items' => __('Search Listing Amenities', 'nomad_listing'),
        'all_items' => __('All Listing Amenities', 'nomad_listing'),
        'parent_item' => __('Parent Listing Amenity', 'nomad_listing'),
        'parent_item_colon' => __('Parent Listing Amenities:', 'nomad_listing'),
        'edit_item' => __('Edit Listing Amenity', 'nomad_listing'),
        'update_item' => __('Update Listing Amenity', 'nomad_listing'),
        'add_new_item' => __('Add New Listing Amenity', 'nomad_listing'),
        'new_item_name' => __('New Listing Amenity Name', 'nomad_listing'),
        'menu_name' => __('Listing Amenities', 'nomad_listing'),
        'choose_from_most_used' => __('Choose from common amenities', 'nomad_listings'),
    );

    register_taxonomy(
        TAX_BASE . 'listing-item-amenity',
        array(BASE),
        array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'sort' => true,
            'args' => array('orderby' => 'term_order'),
            'rewrite' => array('slug' => 'listing-item-amenity',
            ),
        )
    );
}

// Hooking up our functions to register post types and taxonomies
add_action('init', 'create_post_types');
add_action('init', 'register_cat_tax', 0);
add_action('init', 'register_tag_tax', 0);
add_action('init', 'register_location_tax', 0);
add_action('init', 'register_feature_tax', 0);
add_action('init', 'register_amenity_tax', 0);

/**
 * Register custom meta input boxes
 */
add_filter('rwmb_meta_boxes', 'prefix_register_meta_boxes');
function prefix_register_meta_boxes($meta_boxes)
{
    $prefix = PREFIX;

    // contact information
    $meta_boxes[] = array(
        'id' => 'contact',
        'title' => __('Contact Information', 'nomad_listings'),
        'post_types' => BASE,
        'context' => 'normal',
        'priority' => 'high',

        'fields' => array(
            array(
                'name' => __('Website', 'nomad_listings'),
                'desc' => __('Website URL', 'nomad_listings'),
                'id' => $prefix . 'website',
                'type' => 'url',
            ),
            array(
                'name' => __('Email Address', 'nomad_listings'),
                'desc' => __('Email address', 'nomad_listings'),
                'id' => $prefix . 'email',
                'type' => 'text',
            ),
            array(
                'name' => __('Phone Number', 'nomad_listings'),
                'desc' => __('Phone numbers', 'nomad_listings'),
                'id' => $prefix . 'phone_number',
                'type' => 'text_list',
                'clone' => true,
                'options' => array(
                    __('+254 xxx xxxxxx', 'nomad_listings') => __('', 'nomad_listings'),
                ),
            ),
            array(
                'name' => __('Facebook URL', 'nomad_listings'),
                'desc' => __('Tacebook Page URL', 'nomad_listings'),
                'id' => $prefix . 'facebook',
                'type' => 'url',
            ),
            array(
                'name' => __('Twitter Handle', 'nomad_listings'),
                'desc' => __('Twitter handle', 'nomad_listings'),
                'id' => $prefix . 'twitter',
                'type' => 'text',
            ),
            array(
                'name' => __('Instagram Handle', 'nomad_listings'),
                'desc' => __('Instagram handle', 'nomad_listings'),
                'id' => $prefix . 'instagram',
                'type' => 'text',
            ),
            array(
                'name' => __('LinkedIn Profile', 'nomad_listings'),
                'desc' => __('LinkedIn Profile URL', 'nomad_listings'),
                'id' => $prefix . 'linkedin',
                'type' => 'url',
            ),
        ),

        'validation' => array(
            'rules' => array(
                $prefix . 'email' => array(
                    'email' => true,
                ),
            ),
        ),
    );

    // Additional Info
    $meta_boxes[] = array(
        'id' => 'additional_info',
        'title' => __('Additional Information', 'nomad_listings'),
        'post_types' => BASE,
        'context' => 'normal',
        'priority' => 'high',

        'fields' => array(
            array(
                'name' => __('Number of rooms', 'nomad_listings'),
                'id'   => $prefix . 'number_of_rooms',
                'type' => 'number',
                'min'  => 1,
                'step' => 1,
            ),
            array(
                'name'       => __('Check In Time', 'nomad_listings'),
                'id'         => $prefix . 'checkin_time',
                'type'       => 'time',
                // Time options, see here http://trentrichardson.com/examples/timepicker/
                'js_options' => array(
                    'stepMinute'      => 15,
                    'controlType'     => 'select',
                    'showButtonPanel' => false,
                    'oneLine'         => true,
                ),
                // Display inline?
                'inline'     => false,
            ),
            array(
                'name'       => __('Check Out Time', 'nomad_listings'),
                'id'         => $prefix . 'checkout_time',
                'type'       => 'time',
                // Time options, see here http://trentrichardson.com/examples/timepicker/
                'js_options' => array(
                    'stepMinute'      => 15,
                    'controlType'     => 'select',
                    'showButtonPanel' => false,
                    'oneLine'         => true,
                ),
                // Display inline?
                'inline'     => false,
            ),
            array(
                'name'            => __('Pricing', 'nomad_listings'),
                'id'              => $prefix . 'pricing',
                'type'            => 'select',
                // Array of 'value' => 'Label' pairs
                'options'         => array(
                    '$'       => '$',
                    '$$' => '$$',
                    '$$$'        => '$$$',
                    '$$$$'     => '$$$$',
                    '$$$$$' => '$$$$$',
                ),
                // Allow to select multiple value?
                'multiple'        => false,
                // Placeholder text
                'placeholder'     => __('Select Pricing', 'nomad_listings'),
                // Display "Select All / None" button?
                'select_all_none' => false,
            ),
            array(
                'name' => __('Nearby', 'nomad_listings'),
                'desc' => __('Nearby attractions', 'nomad_listings'),
                'id' => $prefix . 'nearby',
                'type' => 'text_list',
                'clone' => true,
                'options' => array(
                    __('Art gallery', 'nomad_listings') => __('', 'nomad_listings'),
                ),
            ),
            array(
                'name' => __('Video', 'nomad_listings'),
                'desc' => __('Video URL', 'nomad_listings'),
                'id' => $prefix . 'video',
                'type'  => 'oembed',
                'size'  => 50,
            ),
            array(
                'name' => __('Awards', 'nomad_listings'),
                'desc' => __('Awards', 'nomad_listings'),
                'id' => $prefix . 'awards',
                'type'  => 'wysiwyg',
                'raw'  => false,
                'options' => array(
                    'textarea_rows' => 15,
                    'teeny'         => false,
                ),
            ),
            array(
                'name' => __('Events & Offers', 'nomad_listings'),
                'desc' => __('Events and offers', 'nomad_listings'),
                'id' => $prefix . 'events_offers',
                'type'  => 'wysiwyg',
                'raw'  => false,
                'options' => array(
                    'textarea_rows' => 15,
                    'teeny'         => false,
                ),
            ),
        ),
    );

    // Map
    $meta_boxes[] = array(
        'id' => 'location',
        'title' => __('Location', 'nomad_listings'),
        'post_types' => BASE,
        'context' => 'normal',
        'priority' => 'high',

        'fields' => array(
            // Map requires at least one address field (with type = text).
            array(
                'id' => 'address',
                'name' => __('Address', 'nomad_listings'),
                'type' => 'text',
                'std' => __('Mombasa, Kenya', 'nomad_listings'),
            ),
            array(
                'id' => 'map',
                'name' => __('Location', 'nomad_listings'),
                'type' => 'map',
                // Your Google Maps API key. Required.
                'api_key' => 'AIzaSyBsluxqPpbTceWH3KnFCved2z-My_qBPxk',
                // Address field ID. Can be a string or list of text fields, separated by commas (for ex. city, state).
                'address_field' => 'address',
                // Map language.
                'language' => 'en_GB',
                // The region code, specified as a country code top-level domain. For better autocomplete address.
                'region' => 'KE',
                // Default location: 'latitude,longitude[,zoom]' (zoom is optional).
                'std' => '-4.036878,39.669571,15',
            ),
        ),
    );

    return $meta_boxes;
}

// listings sidebar
function nomad_custom_sidebar()
{
    if (function_exists('register_sidebar')) {
        register_sidebar(
            array(
                'id' => 'single-nomad-listings-sidebar',
                'name' => 'Single Nomad Listing Sidebar',
                'description' => 'The default sidebar for single nomad listing')
        );
    }
}
add_action('widgets_init', 'nomad_custom_sidebar');
