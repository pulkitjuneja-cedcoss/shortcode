<?php 
/**
 * Plugin Name:       Shortcode
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       display content via shortcode
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Pulkit Juneja
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       shortcode
 */
function wporg_add_custom_shortcode_box() {
    
        wp_add_dashboard_widget(
            'custom_shortcode',                     // Unique ID
            'Custom Shortcode',          // Box title
            'custom_shortcode_html',            // Content callback, must be of type callable
            $screen                            // Post type
        );
  //  }
}
add_action( 'wp_dashboard_setup', 'wporg_add_custom_shortcode_box');

function custom_shortcode_html( ) {
 
    ?>
    <h3>Enter name of your shortcode here</h3><br/>
    <input type="text" id="shortcode_name" name="shortcode_name"  /><br/><br/>
    <h3>Enter your shortcode content here</h3><br/>
    <input type="text" id="shortcode_content" name="shortcode_content" /><br/><br/>
    
    <input type="submit" id="btn" value="Submit"/>
   
    <?php
}

function custom_shortcode()
{
    wp_enqueue_script('custom_shortcode_script', plugin_dir_url(__FILE__) . 'script.js', ['jquery']);       
    wp_localize_script(
                'custom_shortcode_script',
                'custom_shortcode_script_obj',
                [
                    'url' => admin_url('admin-ajax.php'),
                ]
            );
       
}
add_action('admin_enqueue_scripts', 'custom_shortcode');

//  add_action( 'save_post', 'save_custom_post_taxonomy_data' );
add_action("wp_ajax_show_shortcode", "show_shortcode");
add_action("wp_ajax_nopriv_show_shortcode", "show_shortcode");


function wpb_demo_shortcode() { 
        
    $message = get_option('message_for_shortcode');
    return $message;
    } 
    
function show_shortcode(){
   // echo "show_shortcode".$_POST['name'] ;
       update_option('message_for_shortcode', $_POST['content']);
       update_option('shortcode', $_POST['name']);
      // add_shortcode('myFirstShortcode', 'wpb_demo_shortcode'); 
}
add_shortcode(get_option('shortcode'), 'wpb_demo_shortcode');
// add_action('init', 'abc');
// function abc(){
//     add_shortcode(get_option('shortcode'), 'wpb_demo_shortcode');
// }
?>