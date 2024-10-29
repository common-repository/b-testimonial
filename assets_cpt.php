<?php
if(!class_exists('BTS_Assets_CPT')){

class BTS_Assets_CPT{
    public function __construct(){
        add_action('admin_enqueue_scripts', [$this, 'bts_admin_assets']);
        add_action('wp_enqueue_scripts', [$this, 'bts_assets']);
        add_action('init', [$this, 'bts_do_alltime_init']);
    }

    /**
     * Admin Assets
     */
    public function bts_admin_assets(){
        global $post;
        
        if(isset($post) && $post->post_type == 'btsshortcode'){
            wp_enqueue_style('bts-spt-class', plugin_dir_url(__FILE__).'assets/css/csf.min.css');
            wp_enqueue_script('bts-admin-script', plugin_dir_url(__FILE__) . 'admin/assets/js/script.js');
        }
        
    }

     /**
     * Assets
     */
    public function bts_assets(){
        //js
        wp_register_script('bplugins-owl-carousel', plugin_dir_url(__FILE__).'assets/js/carousel.min.js', array('jquery'), BTS_VER, true);
        wp_register_script('bts-script', plugin_dir_url(__FILE__).'assets/js/script.js', array('jquery', 'bplugins-owl-carousel'), BTS_VER, true);

        //css
        wp_register_style('bplugins-owl-carousel', plugin_dir_url(__FILE__). 'assets/css/carousel.min.css', array(), BTS_VER);
        wp_register_style('bplugins-owl-theme', plugin_dir_url(__FILE__). 'assets/css/theme.min.css', array(), BTS_VER);
        wp_register_style('bts-style', plugin_dir_url(__FILE__). 'assets/css/style.css', array(), BTS_VER);

        wp_register_style('bts-template-style', plugin_dir_url(__FILE__).'./src/assets/css/template.style.css', array(), BTS_VER);
    }

    
    /**
     * init
     * @ Register Custom Post Type
     */
    public function bts_do_alltime_init(){

        // Register Testimonial Post type
        $labels = array(
            'name'                  => _x( 'Testimonial', 'Post type general name', 'bts' ),
            'singular_name'         => _x( 'Testimonial', 'Post type singular name', 'bts' ),
            'menu_name'             => _x( 'Testimonial', 'Admin Menu text', 'bts' ),
            'name_admin_bar'        => _x( 'Testimonial', 'Add New on Toolbar', 'bts' ),
            'add_new'               => __( 'Add New', 'bts' ),
            'add_new_item'          => __( 'Add New Testimonial', 'bts' ),
            'new_item'              => __( 'New Testimonial', 'bts' ),
            'edit_item'             => __( 'Edit Testimonial', 'bts' ),
            'view_item'             => __( 'View Testimonial', 'bts' ),
            'all_items'             => __( 'All Testimonials', 'bts' ),
            'search_items'          => __( 'Search Testimonials', 'bts' ),
            'parent_item_colon'     => __( 'Parent Testimonial:', 'bts' ),
            'not_found'             => __( 'No Testimonial found.', 'bts' ),
            'not_found_in_trash'    => __( 'No Testimonial found in Trash.', 'bts' ),
            'featured_image'        => _x( 'Testimonial Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'bts' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'bts' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'bts' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'bts' ),
            'archives'              => _x( 'Testimonial archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'bts' ),
            'insert_into_item'      => _x( 'Insert into Testimonial', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'bts' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this Testimonial', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'bts' ),
            'filter_items_list'     => _x( 'Filter Testimonial list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'bts' ),
            'items_list_navigation' => _x( 'Testimonial list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'bts' ),
            'items_list'            => _x( 'Testimonial list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'bts' ),
        );     
        $args = array(
            'labels'             => $labels,
            'description'        => 'B Testimonial. this plugin also support slider and widget',
            'public'             => false,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'bts-testimonial'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 20,
            'menu_icon'          => 'dashicons-testimonial',
            'supports'           => array( 'title'),
            'show_in_rest'       => true
        );          
        register_post_type( 'btstestimonial', $args );

        //register custom taxonomy
        register_taxonomy( 'btscategory', 'btstestimonial', array(
            'label'        => __( 'Category', 'bts' ),
            'rewrite'      => array( 'slug' => 'btscategory' ),
            'hierarchical' => true,
        ) );

        //Register Generate shortcode Post type
        $labels = array(
            'name'                  => _x( 'Shortcode', 'Post type general name', 'bts' ),
            'singular_name'         => _x( 'Shortcode', 'Post type singular name', 'bts' ),
            'menu_name'             => _x( 'Shortcode', 'Admin Menu text', 'bts' ),
            'name_admin_bar'        => _x( 'Shortcode', 'Add New on Toolbar', 'bts' ),
            'add_new'               => __( 'Generate New Shortcode', 'bts' ),
            'add_new_item'          => __( 'Generate New Shortcode', 'bts' ),
            'new_item'              => __( 'New Shortcode', 'bts' ),
            'edit_item'             => __( 'Edit Shortcode', 'bts' ),
            'view_item'             => __( 'View Shortcode', 'bts' ),
            'all_items'             => __( 'Shortcode Generator', 'bts' ),
            'search_items'          => __( 'Search Shortcodes', 'bts' ),
            'parent_item_colon'     => __( 'Parent Shortcode:', 'bts' ),
            'not_found'             => __( 'No Shortcode found.', 'bts' ),
            'not_found_in_trash'    => __( 'No Shortcode found in Trash.', 'bts' ),
            'featured_image'        => _x( 'Shortcode Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'bts' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'bts' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'bts' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'bts' ),
            'archives'              => _x( 'Shortcode archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'bts' ),
            'insert_into_item'      => _x( 'Insert into Shortcode', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'bts' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this Shortcode', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'bts' ),
            'filter_items_list'     => _x( 'Filter Shortcode list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'bts' ),
            'items_list_navigation' => _x( 'Shortcode list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'bts' ),
            'items_list'            => _x( 'Shortcode list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'bts' ),
        );     
        $args = array(
            'labels'             => $labels,
            'description'        => 'B Testimonial Shortcode. this plugin also support slider and widget',
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => 'edit.php?post_type=btstestimonial',
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'bts-generate-shortcode'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 20,
            'menu_icon'          => 'dashicons-shortcode',
            'supports'           => array( 'title'),
            'show_in_rest'       => true
        );

        register_post_type('btsshortcode', $args);
    }
}
new BTS_Assets_CPT();
}