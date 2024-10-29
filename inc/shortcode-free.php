<?php
/**
 * BTS Shortcode Class
 */
if(!class_exists('BTS_Shortcode')){
class BTS_Shortcode{
    public function __construct(){
        add_shortcode('b_testimonial', [$this, 'bts_b_testimonial_shortcode_register']);
        // show all
        add_action('wp_ajax_show_all_review_content', [$this, 'show_all_content_callback']);
        add_action('wp_ajax_nopriv_show_all_review_content', [$this, 'show_all_content_callback']);
        // show less
        add_action('wp_ajax_show_less_review_content', [$this, 'show_less_review_content']);
        add_action('wp_ajax_nopriv_show_less_review_content', [$this, 'show_less_review_content']);
    }

    private function get_template($template = 'one'){
        return; 
    }

    /**
     * Show all review content ajax call
     */
    public function show_all_content_callback(){
        $id = sanitize_text_field( $_POST['data']);
        echo $this->get_testimonial($id, 'bts_feedback');
        //echo 'it\s working fine from ajax';
        die();
    }

    /**
     * show less review content ajax call
     */
    public function show_less_review_content(){
        $id = sanitize_text_field( $_POST['data']);
        echo $this->read_more($this->get_testimonial($id, 'bts_feedback', ''),150, __('Show All', 'bts'), 'class="bts3-show-all" data-id="'.$id.'"');
        die();
    }

    /**
     * Get shortcode settings
     */
    public function get_option($id, $key, $default=null, $true = false){
            $meta = metadata_exists( 'post', $id, 'btss_meta' ) ? get_post_meta( $id, 'btss_meta', true ) : '';
            if(isset($meta[$key]) && $meta != ''){
                if($true == true){
                    if($meta[$key] == '1'){
                        return true;
                    }else if($meta[$key] == '0'){
                        return false;
                    }
                }else {
                    return $meta[$key];
                }
                
            }else {
                return $default;
            }
    }

    /**
     * get testimonial
     */
    public function get_testimonial($id, $key, $default = null, $show = true){
        if($show == true){
            $meta = metadata_exists( 'post', $id, 'bts_meta' ) ? get_post_meta( $id, 'bts_meta', true ) : '';
            if(isset($meta[$key]) && $meta[$key] != ''){
                return $meta[$key];
            }else {
                return $default;
            }
        }
    }

    /**
     * read more 
     */
    private function read_more($content,$char = 100,$read_more_text = null ,$atts = null){
        $substr =  substr($content, 0, $char);
        if($read_more_text !== null && strlen($content) > $char){
            return $substr . '... <a href="#" '.$atts.'>' . $read_more_text . '</a>';
        }else {
            return $substr;
        }   
    }

    public function get_nav_style($id, $key, $default = null){
        $meta = metadata_exists( 'post', $id, 'btss_meta' ) ? get_post_meta( $id, 'btss_meta', true ) : '';
        if(isset($meta['bts_nav_style'][$key]) && $meta['bts_nav_style'][$key] != ''){
            return esc_html($meta['bts_nav_style'][$key]);
        }else {
            return esc_html($default);
        }
    }

    public function bts_b_testimonial_shortcode_register($atts){
        extract(shortcode_atts(array(
            'id' => null,
        ), $atts));

        $sid = $id;
        if($sid == null){
            return 'id not found';
        }

        // wp_enqueue_script('bplugins-owl-carousel');
        wp_enqueue_script('bts-script');

        //css
        wp_enqueue_style('bplugins-owl-carousel');
        // wp_enqueue_style('bplugins-owl-theme');
        wp_enqueue_style('bts-style');


        $limit = $this->get_option($sid, 'bts_limit', -1);
        $orderby = $this->get_option($sid, 'bts_orderby', 'date');
        $ordertype = $this->get_option($sid, 'bts_ordertype', 'DESC');

        $select = $this->get_option($sid, 'bts_testimonial_select', 'all');
        $post_query = array();
        $orderby = array('orderby' => $orderby);
        $order = array('order' => $ordertype);
        if($select == 'all'){
            $post_query = array('');
        } else if($select == 'manually'){
            $post_id = $this->get_option($sid, 'bts_testimonials_manually', null);
            $post_query = array(
                'post__in' => $post_id
            );
            $orderby = [''];
            $order = [''];
        } else if ($select == 'category') {
            $category = $this->get_option($sid, 'bts_testimonial_category', null);
            $post_query = array(
                'tax_query' => array(
                    array(
                        'taxonomy' => 'btscategory',
                        'field' => 'term_id',
                        'terms' => $category
                    )
                )
            );
        }
        // get testimonials by shortcode settings
        $query = new WP_Query(array(
            'post_type' => 'btstestimonial',
            'posts_per_page' => $limit,
            key($post_query) => $post_query[key($post_query)],
            key($order) => $order[key($order)],
            key($orderby) => $orderby[key($orderby)]
        ));

        //get all information from shortcode generator which will use in design
        $template = $this->get_option($sid, 'bts_template', 'one');
        wp_enqueue_style('bts-template-style');

        
        $nav_position =  $this->get_option($sid, 'bts_nav_position', 'nav_bottom');

        $title = $this->get_option($sid, 'bts_show_title', true, true);
        $name = $this->get_option($sid, 'bts_show_name', true, true);
        $picture = $this->get_option($sid, 'bts_show_picture', true, true);
        $designation = $this->get_option($sid, 'bts_show_designation', true, true);
        $content = $this->get_option($sid, 'bts_show_content', true, true);
        $rating = $this->get_option($sid, 'bts_show_rating', true, true);

        $read_more = $this->get_option($sid, 'bts_readmore_text', 'Read More');
        $read_less = $this->get_option($sid, 'bts_readless_text', 'Read Less');
        $char = $this->get_option($sid, 'bts_char_limit', 200);
        
        ob_start();

?>
<style>
<?php $class = '.bts' . $sid; ?>
<?php echo $class; ?> {
    padding : <?php echo $this->get_option($sid, 'bts_container_padding', '10') ?>px;
}
<?php echo $class; ?> .owl-dots .owl-dot span {
  display: none;
}
<?php echo $class; ?> .owl-nav .owl-prev:before,
<?php echo $class; ?> .owl-nav .owl-next:before{
    color: <?php echo $this->get_nav_style($sid, 'color', '#ffffff') ?> !important;
    font-size: <?php echo $this->get_option($sid, 'bts_nav_fontsize', '20') ?>px !important;
    background: <?php echo $this->get_nav_style($sid, 'background', '#444444') ?> !important;
    padding: 5px;
    border-radius: 3px;
}
<?php echo $class; ?> .owl-nav .owl-prev:hover:before,
<?php echo $class; ?> .owl-nav .owl-next:hover:before{
    color: <?php echo $this->get_nav_style($sid, 'hover', '#ffffff') ?> !important;
    background: <?php echo $this->get_nav_style($sid, 'hover_bg', '#4527A4') ?> !important;
}
</style>
<?php


        if(file_exists(plugin_dir_path(__FILE__) . 'theme/' . $template . '.php')){
            include 'theme/'.$template . '.php';
        }else {
            include 'theme/one.php';
        }
        
        return ob_get_clean();
    }





}
new BTS_Shortcode();
}
