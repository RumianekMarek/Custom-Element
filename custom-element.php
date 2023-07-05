<?php
/*
Plugin Name: Custom Element
Plugin URI:
Description: Adding a new element to the website.
Version: 2.0.4
Author: Marek Rumianek
Author URI:
*/

// Czyszczenie pamięci wp_rocket
function clear_wp_rocket_cache_on_plugin_update( $plugin ) {
  // Sprawdź, czy zaktualizowana wtyczka to twoja wtyczka
  if ( 'custom-element/custom-element.php' === $plugin ) {
    // Sprawdź, czy WP Rocket jest aktywny
    if ( function_exists( 'rocket_clean_domain' ) ) {
      // Wywołaj funkcję czyszczenia pamięci podręcznej WP Rocket
      do_action( 'rocket_clear_cache' );
    }
  }
}
add_action( 'upgrader_process_complete', 'clear_wp_rocket_cache_on_plugin_update', 10, 2 );


// Adres autoupdate
include( plugin_dir_path( __FILE__ ) . 'plugin-update-checker/plugin-update-checker.php');
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/RumianekMarek/Custom-Element',
	__FILE__,
	'custom-element'
);

$myUpdateChecker->getVcsApi()->enableReleaseAssets();

// My Custom Element
include_once plugin_dir_path(__FILE__) . '/my-custom-element/main-custom-element.php';

// Katalog wystawców
include_once plugin_dir_path(__FILE__) . '/katalog-wystawcow/main-katalog-wystawcow.php';

if (is_admin()) {
  // Edytor plików dostepFTP
  include_once plugin_dir_path(__FILE__) . '/FTP/main-dostepFTP.php';
  
  // opisy do Mediów
  // include_once plugin_dir_path(__FILE__) . 'opisy-mediow/opisy-mediow.php';
}
// Enqueue JavaScript and CSS files
function my_custom_element_scripts() {
  $trade_date = do_shortcode('[trade_fair_date]');
  $trade_start = do_shortcode('[trade_fair_datetotimer]');
  $trade_end = do_shortcode('[trade_fair_enddata]');
  $trade_name = do_shortcode('[trade_fair_name]');
  $trade_desc = do_shortcode('[trade_fair_desc]');
  $trade_name_en = do_shortcode('[trade_fair_name_eng]');
  $trade_desc_en = do_shortcode('[trade_fair_desc_eng]');

  $inner_data_array = array(
    'trade_date' => $trade_date,
    'trade_start' => $trade_start,
    'trade_end' => $trade_end,
    'trade_name' => $trade_name,
    'trade_desc' => $trade_desc,
    'trade_name_en' => $trade_name_en,
    'trade_desc_en' => $trade_desc_en,
  );

  $js_file = plugins_url('my-custom-element/js/script.js', __FILE__);
  $js_version = filemtime(plugin_dir_path(__FILE__) . 'my-custom-element/js/script.js');
  wp_enqueue_script('my-custom-element-js', $js_file, array('jquery'), $js_version, true);
  wp_localize_script( 'my-custom-element-js', 'inner_data', $inner_data_array ); 

  $css_file = plugins_url('my-custom-element/css/style.css', __FILE__);
  $css_version = filemtime(plugin_dir_path(__FILE__) . 'my-custom-element/css/style.css');
  wp_enqueue_style('my-custom-element-css', $css_file, array(), $css_version);
}

add_action('wp_enqueue_scripts', 'my_custom_element_scripts');
?>
