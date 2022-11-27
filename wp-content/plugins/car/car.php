<?php
/**
 * Plugin Name: Car
 * Plugin URI: https://wordpress.com/
 * Description: An Car toolkit that helps you sell anything. Beautifully.
 * Version: 6.3.1
 * Author: Automattic
 * Author URI: https://wordpress.com/
 * Text Domain:
 * Domain Path: /languages/
 * Requires at least: 5.7
 * Requires PHP: 7.0
 *
 * @package Car
 */
$dirname = dirname(__FILE__);
function hcf_display_callback()
{
    include dirname(__FILE__) . '/meta/form.php';
}

include dirname(__FILE__) . '/widget/tel-create-widget.php';

function hcf_register_meta_boxes()
{
    add_meta_box('hcf-1', __('Addition', 'hcf'), 'hcf_display_callback', 'car');
}


add_action('add_meta_boxes', 'hcf_register_meta_boxes');
/**
 * Save meta box content.
 *
 * @param int $event_id
 */
function hcf_save_meta_box(int $event_id)
{
    $fields = [
        'hcf_color',
        'hcf_power',
        'hcf_fuel',
        'hcf_price'
    ];
    foreach ($fields as $field) {
        if (array_key_exists($field, $_POST)) {
            update_post_meta($event_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}

add_action('save_post', 'hcf_save_meta_box');
/**
 * car register
 */
function car_register()
{
    $labels = array(
        'name' => _x('Car', 'wl-test-theme'),
        'singular_name' => _x('Car Item', 'wl-test-theme'),
        'add_new' => _x('Add New', 'wl-test-theme'),
        'add_new_item' => __('Add New Car Item', 'wl-test-theme'),
        'edit_item' => __('Edit Car Item', 'wl-test-theme'),
        'new_item' => __('New Car Item', 'wl-test-theme'),
        'view_item' => __('View Car Item', 'wl-test-theme'),
        'search_items' => __('Search Car Items', 'wl-test-theme'),
        'not_found' => __('Nothing found', 'wl-test-theme'),
        'not_found_in_trash' => __('Nothing found in Trash', 'wl-test-theme'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 8,
        'supports' => array('title', 'editor', 'thumbnail')
    );
    register_post_type('car', $args);
}

add_action('init', 'car_register');

/**
 * create taxonomies brand
 */
function create_brand_taxonomies()
{
    $labels = array(
        'name' => _x('Brand', 'wl-test-theme'),
        'singular_name' => _x('Option', 'wl-test-theme'),
        'search_items' => __('Search Brand', 'wl-test-theme'),
        'all_items' => __('All Brand', 'wl-test-theme'),
        'parent_item' => __('Parent Option', 'wl-test-theme'),
        'parent_item_colon' => __('Parent Option:', 'wl-test-theme'),
        'edit_item' => __('Edit Option', 'wl-test-theme'),
        'update_item' => __('Update Option', 'wl-test-theme'),
        'add_new_item' => __('Add New Option', 'wl-test-theme'),
        'new_item_name' => __('New Option Name', 'wl-test-theme'),
        'menu_name' => __('Brand', 'wl-test-theme'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'brand'),
    );

    register_taxonomy('cart_brand', array('car'), $args);
}

add_action('wp_loaded', 'create_brand_taxonomies');
/**
 * create taxonomies country of production
 */
function create_country_taxonomies()
{
    $labels = array(
        'name' => _x('Country', 'wl-test-theme'),
        'singular_name' => _x('Option', 'wl-test-theme'),
        'search_items' => __('Search Country', 'wl-test-theme'),
        'all_items' => __('All Country', 'wl-test-theme'),
        'parent_item' => __('Parent Option', 'wl-test-theme'),
        'parent_item_colon' => __('Parent Option:', 'wl-test-theme'),
        'edit_item' => __('Edit Option', 'wl-test-theme'),
        'update_item' => __('Update Option', 'wl-test-theme'),
        'add_new_item' => __('Add New Option', 'wl-test-theme'),
        'new_item_name' => __('New Option Name', 'wl-test-theme'),
        'menu_name' => __('Country', 'wl-test-theme'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'country'),
    );

    register_taxonomy('cart_country', array('car'), $args);
}

add_action('wp_loaded', 'create_country_taxonomies');
/**
 * add in Home Page shortcode [car]
 * @return string
 */
function recent_posts_function()
{
    $args = [
        'post_type' => 'car',
        'posts_per_page' => '10'
    ];
    $carQuery = new WP_Query($args);

    if ($carQuery->have_posts()) :
        while ($carQuery->have_posts()) : $carQuery->the_post();
            $title .= '<li>' . get_the_title() . '</li>';
        endwhile;
    else:

        return '<p><strong>' . _e('not found', 'wl-test-theme') . '</strong></p>';
    endif;
    wp_reset_query();
    return $title;
}

add_shortcode('car', 'recent_posts_function');

function plugin_load_textdomain()
{
    load_plugin_textdomain('wl-test-theme', false, basename(dirname(__FILE__)) . '/languages/');
}

add_action('init', 'plugin_load_textdomain');