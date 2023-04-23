<?php
/*
Plugin Name: Custom Element.
Plugin URI: 
Description: Adding new elemnt on web site.
Version: 1.0
Author: Marek Rumianek
Author URI: 
*/

 // Kod do aktualizacji wtyczki
 include_once( plugin_dir_path( __FILE__ ) . 'plugin-update-checker/plugin-update-checker.php');
 $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
   'https://github.com/RumianekMarek/Custom-Element',
   __FILE__,
   'exhibitors_code_system'
 );
 $myUpdateChecker->getVcsApi()->enableReleaseAssets();
}

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
        'save_always' => true
      )
    )
  ));

  // Define the output function for the element
  function my_custom_element_output($atts, $content = null) {
    extract(shortcode_atts(
      array(
        'file' => ''
        ), $atts
      )
    );

    $file_path = plugin_dir_path(__FILE__) . $atts['file'];

    if (file_exists($file_path)) {
      $file_cont = file_get_contents($file_path);
      return '<div class="my-file-display col-lg-12">' . $file_cont . '</div>';
    } else {
      echo '<script>console.error("File not found: ' . $file_path . '");</script>';
    }
}
  add_shortcode('my_custom_element', 'my_custom_element_output');
}
add_action('vc_before_init', 'my_custom_wpbakery_element');