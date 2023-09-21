<?php
/*
Plugin Name: Custom Element
Plugin URI:
Description: Adding a new element to the website.
Version: 2.1.15
Author: Marek Rumianek
Współtwórcy: Jakub Choła , Anton Melnychuk
Author URI: github.com/RumianekMarek
*/

// Czyszczenie pamięci wp_rocket
function clear_wp_rocket_cache_on_plugin_update( $plugin ) {
  // Sprawdź, czy zaktualizowana wtyczka to twoja wtyczka
  if ( 'custom-element/custom-element.php' === $plugin ) {
    // Sprawdź, czy WP Rocket jest aktywny
    if ( function_exists( 'rocket_clean_domain' ) ) {
      // Wywołaj funkcję czyszczenia pamięci podręcznej WP Rocket
      rocket_clean_domain();
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

// Info + Modal
include_once plugin_dir_path(__FILE__) . '/display-info/display-info.php';

// Badge
include_once plugin_dir_path(__FILE__) . '/badge/badge.php';

// QR Check
include_once plugin_dir_path(__FILE__) . '/badge/qrcodecheck.php';

// QR Check
include_once plugin_dir_path(__FILE__) . '/qr-scanner/qr-scanner.php';

if (is_admin()) {
  // Edytor plików dostepFTP
  include_once plugin_dir_path(__FILE__) . '/FTP/main-dostepFTP.php';
      
  //opisy do Mediów
  include_once plugin_dir_path(__FILE__) . '/FTP/opisy-mediow.php';
}

?>