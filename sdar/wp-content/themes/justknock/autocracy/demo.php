<?php

/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 */
/* * ******************* META BOX DEFINITIONS ********************** */

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'YOUR_PREFIX_';

global $meta_boxes;

$meta_boxes = array();
$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'neighborhoodsinfo',
    // Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => 'Neighborhoods Info',
    // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array('neighborhoods'),
    // Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'normal',
    // Order of meta box: high (default), low. Optional.
    'priority' => 'high',
    // List of meta fields
    'fields' => array(
    array(
            'name' => 'API Location',
            'id' => 'apilocation',
            'type' => 'text',
        ),
     array(
            'name' => 'Lat, Long',
            'id' => 'latlong',
            'type' => 'text'
     ),
     array(
            'name'             => 'Neighborhood Images',
            'id'               => 'featuredimages',
            'type'             => 'plupload_image',
            'max_file_uploads' => 3,
            ),
     ),
    );

$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'dealsinfo',
    // Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => 'Deals Info',
    // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array('deals'),
    // Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'normal',
    // Order of meta box: high (default), low. Optional.
    'priority' => 'high',
    // List of meta fields
    'fields' => array(
        array(
            'name' => 'Deal Blurb',
            'id' => 'blurb',
            'type' => 'text',
        ),
        array(
            'name' => 'Deal Price',
            'id' => 'price',
            'type' => 'text',
        ),
        array(
            'name' => 'Deal URL',
            'id' => 'url',
            'type' => 'text',
        ),
        array(
            'name' => 'Deal Ends(MM-DD-YYYY)',
            'id' => 'dealends',
            'type' => 'text',
        ),
        array(
            'name'             => 'Company Logo',
            'id'               => 'companylogo',
            'type'             => 'plupload_image',
            'max_file_uploads' => 3,
        ),
     ),
);

$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'resourcesinfo',
    // Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => 'Resources Info',
    // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array('resources'),
    // Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'normal',
    // Order of meta box: high (default), low. Optional.
    'priority' => 'high',
    // List of meta fields
    'fields' => array(
        array(
            'name' => 'Category',
            'id' => 'category',
            'type' => 'text',
        ),
        array(
            'name' => 'Contact Person',
            'id' => 'person',
            'type' => 'text',
        ),
        array(
            'name' => 'Street Address',
            'id' => 'stadd',
            'type' => 'text',
        ),
        array(
            'name' => 'City, ST ZIP',
            'id' => 'citystzip',
            'type' => 'text',
        ),
        array(
            'name' => 'Email',
            'id' => 'email',
            'type' => 'text',
        ),
        array(
            'name' => 'Website Address',
            'id' => 'website',
            'type' => 'text',
        ),
        array(
            'name' => 'Phone Number',
            'id' => 'phone',
            'type' => 'text',
        )
     ),
);


/* * ******************* META BOX REGISTERING ********************** */

/**
 * Register meta boxes
 *
 * @return void
 */
function YOUR_PREFIX_register_meta_boxes() {
    global $meta_boxes;

    // Make sure there's no errors when the plugin is deactivated or during upgrade
    if (class_exists('RW_Meta_Box')) {
        foreach ($meta_boxes as $meta_box) {
            new RW_Meta_Box($meta_box);
        }
    }
}

// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action('admin_init', 'YOUR_PREFIX_register_meta_boxes');