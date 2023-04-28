<?php
/*
Plugin Name: Custom Element.
Plugin URI: 
Description: Adding new elemnt on web site.
Version: 1.2
Author: Marek Rumianek
Author URI: 
*/

include( plugin_dir_path( __FILE__ ) . 'plugin-update-checker/plugin-update-checker.php');
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/RumianekMarek/Custom-Element',
	__FILE__,
	'custom-element'
);
$myUpdateChecker->getVcsApi()->enableReleaseAssets();


// Add the new WPBakery element
function my_custom_wpbakery_element() {
  // Define the element name and path to the element file
  vc_map(array(
    'name' => __('My Custom Element', 'my-custom-plugin'),
    'base' => 'my_custom_element',
    'category' => __('My Elements', 'my-custom-plugin'),
    'params' => array(
      array(
        'type' => 'textfield',
        'heading' => __('Select a file', 'my-custom-plugin'),
        'param_name' => 'file',
        'description' => __('Select a file to display its contents.', 'my-custom-plugin'),
        'save_always' => true,
        'admin_label' => true // Add this line to display the filename in the backend editor
      )
      ),
    "description" => __( "Enter description.", "my-text-domain" )
  ));

// Define the output function for the element
function my_custom_element_output($atts, $content = null) {
  // Get the current language of the website
  $locale = get_locale();

  extract(shortcode_atts(
    array(
      'file' => ''
    ),
    $atts
  ));

  $file_path = plugin_dir_path(__FILE__) . 'my-custom-element/' . $atts['file'];

  if (file_exists($file_path)) {
    $file_cont = file_get_contents($file_path);
    $file_cont = '<div custom-lang="' . $locale . '" class="custom_element">' . $file_cont . '</div>';
    return $file_cont;
  } else {
    echo '<script>console.error("File not found: ' . $file_path . '");</script>';
  }
}

// Enqueue JavaScript and CSS files
function my_custom_element_scripts() {
  $js_file = plugins_url('/js/script.js', __FILE__);
  $js_version = filemtime(plugin_dir_path(__FILE__) . '/js/script.js');
  wp_enqueue_script('my-custom-element-js', $js_file, array('jquery'), 1.1, true);

  $css_file = plugins_url('/css/style.css', __FILE__);
  $css_version = filemtime(plugin_dir_path(__FILE__) . '/css/style.css');
  wp_enqueue_style('my-custom-element-css', $css_file, array(), 1.1);
}
add_action('wp_enqueue_scripts', 'my_custom_element_scripts');

add_shortcode('my_custom_element', 'my_custom_element_output');
}

add_action('vc_before_init', 'my_custom_wpbakery_element');
?>