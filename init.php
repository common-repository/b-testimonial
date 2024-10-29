<?php
/*
 * Plugin Name: B Testimonial
 * Plugin URI:  http://bplugins.com
 * Description: This is a testimonial plugin where you can create testimonial and you can show it by shortcode. you can also create testimonial slider. The B Testimonial WordPress Plugin is the best solution for those who want to create Testimonial section for his/her webstie. also gutenberg block available to get live design changes.
 * Version: 1.2.2
 * Author: bPlugins
 * Author URI: http://bPlugins.com
 * License: GPLv3
 * Text Domain:  bts
 * Domain Path:  /languages
 * @fs_premium_only /premium-files/
 */

 // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Defined Version
 */
$ver = null;
$host = $_SERVER['HTTP_HOST'];
if($host == 'localhost'){
    $ver = time();
}else {
    $ver = '1.2.2';
}
if ( ! defined( 'BTS_VER' ) ) {
    define('BTS_VER', $ver);
}

 /**
  * Required essential files
  */
  // register block 
if(file_exists(plugin_dir_path( __FILE__ ) . 'src/init.php')){
    require_once plugin_dir_path( __FILE__ ) . 'src/init.php';
}
// register custom cpt and enqueue files hrere
if(file_exists(plugin_dir_path( __FILE__ ) . 'assets_cpt.php')){
    require_once plugin_dir_path( __FILE__ ) . 'assets_cpt.php';
}
// require codestar frameword
if(file_exists(plugin_dir_path( __FILE__ ) . 'admin/codestar-framework/codestar-framework.php')){
    require_once plugin_dir_path( __FILE__ ) . 'admin/codestar-framework/codestar-framework.php';
}

if(!class_exists('BTS')){
class BTS{
    public $version = 'free';
    public function __construct(){
        //add_shortcode('b_testimonial', [$this, 'bts_testimonial_shortcode']);
        add_action('wp_head', [$this, 'bts_send_data_to_script']);
        add_action('edit_form_after_title',[$this,'bts_shortcode_area']);
        add_filter( 'admin_footer_text',[$this, 'bts_admin_footer']);	
    }

    /**
     * get shortcode meta
     */
    public function get_shortcode_meta($id, $key, $default = null, $true = false){
        $meta = metadata_exists( 'post', $id, 'btss_meta' ) ? get_post_meta($id, 'btss_meta', true) : '';

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

    // Footer Review Request 
	function bts_admin_footer( $text ) {
		if ( ('btstestimonial' || 'btsshortcode') == get_post_type() ) {
			$url = 'https://wordpress.org/support/plugin/b-testimonial/reviews/?filter=5#new-post';
			$text = sprintf( __( 'If you like <strong>B Testimonial</strong> please leave us a <a href="%s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. Your Review is very important to us as it helps us to grow more. ', 'bts' ), $url );
		}

		return $text;
	}

    /**
     * Send Data To Script File as a loop how many time shortcode is used
     */
    public function bts_send_data_to_script(){
        global $post;
        if(!isset($post->post_content)){
            return;
        }
        $result = array();
        $pattern = get_shortcode_regex(array('b_testimonial'));
        
        if (preg_match_all('/' . $pattern . '/s', $post->post_content, $matches)) {
            $keys = array();
            $result = array();
            foreach ($matches[0] as $key => $value) {
                $get = str_replace(" ", "&", $matches[3][$key]);
                parse_str($get, $output);
                $keys = array_unique(array_merge($keys, array_keys($output)));
                $result[] = $output;
            }
            if ($keys && $result) {
                foreach ($result as $key => $value) {
                    foreach ($keys as $attr_key) {
                        $result[$key][$attr_key] = isset($result[$key][$attr_key]) ? $result[$key][$attr_key] : null;
                    }
                    ksort($result[$key]);
                }
            }

            $info = array();
            $i = 0;
            //display the result
            foreach ($result as $hook) {
                $id = str_replace('"', '', $hook['id']);
                $id = str_replace("'", '', $id);
                $meta = metadata_exists( 'post', $hook['id'], 'btss_meta' ) ? get_post_meta($hook['id'], 'btss_meta', true) : '';
                
                $bts_autoplay =  $this->get_shortcode_meta($id, 'bts_autoplay', 'on');
                $bts_dots =  $this->get_shortcode_meta($id, 'bts_dots', 'show');
                $bts_nav =  $this->get_shortcode_meta($id, 'bts_nav', 'hide');

                $info[$i]['carousel'] = 'carousel'.$id;
                $info[$i]['margin'] = $this->get_shortcode_meta($id, 'bts_margin', ['right' => '10']);
                $info[$i]['loop'] = $this->get_shortcode_meta($id, 'bts_loop', false, true);
                $info[$i]['mouseDrag'] = $this->get_shortcode_meta($id, 'bts_mousedrag', true, true);
                $info[$i]['touchDrag'] = $this->get_shortcode_meta($id, 'bts_touchdrag', true, true);
                $info[$i]['startPosition'] = $this->get_shortcode_meta($id, 'bts_start_position', '0');
                $info[$i]['nav'] = $this->get_shortcode_meta($id, 'bts_nav', false, true);
                $info[$i]['lazyLoad'] = $this->get_shortcode_meta($id, 'bts_lazyload', true, true);
                $info[$i]['autoplayHoverPause'] = $this->get_shortcode_meta($id, 'bts_pause_on_hover', true, true);
                $info[$i]['dots'] = $this->get_shortcode_meta($id, 'bts_dots_nav', true, true);
                $info[$i]['items'] = $this->get_shortcode_meta($id, 'bts_column', ['bottom' => '1', 'left' => '1', 'right' => '1', 'top' => '1']);
                $info[$i]['autoplayTimeout'] = $this->get_shortcode_meta($id, 'bts_autoplay_timeout', '3000');
                $info[$i]['smartSpeed'] = $this->get_shortcode_meta($id, 'bts_pagination_speed', '600');
                $info[$i]['bts_dots'] = $bts_dots  == 'show' || $bts_dots == 'mobile'  ? true : false;
                $info[$i]['bts_dots_mobile'] = $bts_dots == 'mobile'  ? false : true;
                $info[$i]['bts_nav'] = $bts_nav  == 'show' || $bts_nav == 'mobile'  ? true : false;
                $info[$i]['bts_nav_mobile'] = $bts_nav == 'mobile'  ? false : true;
                $info[$i]['bts_autoplay'] = $bts_autoplay  == 'on' || $bts_autoplay == 'mobile'  ? true : false;
                $info[$i]['bts_autoplay_mobile'] = $bts_autoplay == 'mobile'  ? false : true;
                //$info[$i]['mouseWheel'] = $this->get_shortcode_meta($id, 'bts_mousewheel', '0');
                $i++;
            }

            // echo "<pre>";
            //print_r($result);
            // echo '</pre>';

            wp_localize_script( 'bts-script', 'bts', $info);

            ?>
                <svg width="0" height="0" class="hidden">
                    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 -10 511.987 511" id="star">
                        <path d="M510.652 185.902a27.158 27.158 0 00-23.425-18.71l-147.774-13.419-58.433-136.77C276.71 6.98 266.898.494 255.996.494s-20.715 6.487-25.023 16.534l-58.434 136.746-147.797 13.418a27.208 27.208 0 00-23.402 18.71c-3.371 10.368-.258 21.739 7.957 28.907l111.7 97.96-32.938 145.09c-2.41 10.668 1.73 21.696 10.582 28.094 4.757 3.438 10.324 5.188 15.937 5.188 4.84 0 9.64-1.305 13.95-3.883l127.468-76.184 127.422 76.184c9.324 5.61 21.078 5.097 29.91-1.305a27.223 27.223 0 0010.582-28.094l-32.937-145.09 111.699-97.94a27.224 27.224 0 007.98-28.927zm0 0" fill="#ffc107"></path>
                    </symbol>
                </svg>
            <?php
            
        }
    }

    
    public function bts_shortcode_area(){
        global $post;   
        if($post->post_type=='btsshortcode'){
        ?>
        
        <style>
            #btss_meta .postbox-header{display:none}.bshortcode{margin-top:30px;border:5px solid #4527a4;overflow:hidden}.shortcode-heading{background:#4527a4;padding:15px;overflow:hidden;color:#fff}.shortcode-heading .icon{float:left;overflow:hidden;width:50%}.shortcode-heading .text{float:right;overflow:hidden;text-align:right}.shortcode-heading .text a{color:#fff;display:block;text-decoration:none}.bshortcode .shortcode-left{width:50%;float:left;overflow:hidden;padding:20px 0 30px;text-align:center;background:#fff;border-right:5px solid #4527a4;box-sizing:border-box}.bshortcode .shortcode-right{width:50%;float:left;overflow:hidden;padding:20px 0 30px;text-align:center;background:#fff}.bshortcode .shortcode{padding:8px 15px;background:#eae6f9;display:inline-block;user-select:all;font-size:16px}
        </style>
        <div class="bshortcode">
            <div class="shortcode-heading">
                <div class="icon"><span class="dashicons dashicons-testimonial"></span> <?php _e('WP Super Testimonial', 'bts') ?></div>
                <div class="text"> <a href="https://bplugins.com/support/" target="_blank"><?php _e('Supports', 'bts') ?></a></div>
            </div>
            <div class="shortcode-left">
                <h3><?php _e('Shortcode', 'bts') ?></h3>
                <p><?php _e('Copy and paste this shortcode into your posts or pages or widget content:', 'bts') ?></p>
                <div class="shortcode" selectable>[b_testimonial id='<?php echo $post->ID; ?>']</div>
            </div>
            <div class="shortcode-right">
                <h3><?php _e('Template Include', 'bts') ?></h3>
                <p><?php _e('Copy and paste the PHP code into your template file:', 'bts') ?></p>
                <div class="shortcode">&lt;?php echo do_shortcode('[b_testimonial id="<?php echo $post->ID; ?>"]');
				?&gt;</div>
            </div>
        </div>
        <?php 
    }}

}

$bts = new BTS();

    require_once 'inc/shortcode-free.php';
    require_once 'inc/metabox-free.php';

 }




 add_action('admin_head', function () {
    $post_title = 'Testimonial';
    ?>

    <script>
        if(window.location.href.includes('playground.wordpress.net/')){
        <?php
    $post_id = sanitize_text_field($_GET['post'] ?? null);
    $action = sanitize_text_field($_GET['action'] ?? null);
    if($post_id == 2 && $action === 'edit'){
        $post = get_post($post_id);
        if($post->post_title !== $post_title){
            wp_insert_post([
                'ID' => 2,
                'post_title' => $post_title,
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_content' => '
                ',
            ]);
            ?>
            window.location.href = '<?php echo admin_url("post.php?post=2&action=edit") ?>';
            <?php
        }else {
            ?>
                
                let i = 0;
               const interval =  setInterval(() => {
                    i++;
                    if(i >=100){
                        clearInterval(interval);
                    }
                    if(document.querySelector('.block-editor-warning__action button')){
                        document.querySelector('.block-editor-warning__action button').click();
                        clearInterval(interval);
                    }
                }, 1000);
            <?php
        }
    }
    ?>

    }

    </script>
<?php
});