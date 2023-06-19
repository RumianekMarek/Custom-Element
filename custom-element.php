<?php
/*
Plugin Name: Custom Element
Plugin URI:
Description: Adding a new element to the website.
Version: 1.5.6
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
        'type' => 'dropdown',
        'heading' => __('Select an element', 'my-custom-plugin'),
        'param_name' => 'element',
        'description' => __('Select an element to display its files.', 'my-custom-plugin'),
        'value' => array(
          'Select' => '',
          'Adres Ptak Warsaw Expo' => 'ptakAdress.php',
          'Dodaj do kalendarza' => 'calendarAdd.php',
          'Dodaj do Google Kalendarz' => 'calendarGoogle.html',
          'Dodaj do Outlook Kalendarz' => 'calendarOutlook.html',
          'Dodaj do Office 365 Kalendarz' => 'calendarOffice365.html',
          'Dodaj do Yahoo Kalendarz' => 'calendarYahoo.html',
          'Dodaj do Apple Kalendarz' => 'calendarApple.html',
          'Kalendarz do potwierdzenia' => 'confCalendar.php',
          'Dokumenty' => 'download.php',
          'Exhibitors-benefits'=> 'exhibitors-benefits.php',
          'FAQ' => 'faq.php',
          'For Exhibitors' => 'for-exhibitors.php',
          'For Visitors' => 'for-visitors.php',
          'Main Page Gallery - mini' => 'gallery.php',
          'Gallery Slider' => 'gallery-slider.php',
          'Grupy zorganizowane' => 'grupy.php',
          'Informacje organizacyjne' => 'org-information.php',
          'Kontakt' => 'kontakt.php',
          'Organizator' => 'organizator.php',
          'Mapka dojazdu' => 'route.php',
          'Ramka Facebook' => 'socialMedia.php',
          'Timer' => 'main-timer.php',
          'Visitors Benefits' => 'visitors-benefits.php',
          'Voucher' => 'voucher.php',
          'Wydarzenia - ogólne informacje' => 'wydarzenia-ogolne.php',
          'Zabudowa' => 'zabudowa.php',
        ),
        'save_always' => true,
        'admin_label' => true
      ),
      array(
        'type' => 'textfield',
        'heading' => __('Select a file', 'my-custom-plugin'),
        'param_name' => 'file',
        'description' => __('Select a file to display its contents.', 'my-custom-plugin'),
        'save_always' => true,
        'admin_label' => true
      ),
      array(
        'type' => 'dropdown',
        'heading' => __('Select a color', 'my-custom-plugin'),
        'param_name' => 'color',
        'description' => __('Select a color for the element.', 'my-custom-plugin'),
        'value' => array(
          'Default' => '',
          'White' => '#ffffff',
          'Black' => '#000000'
        ),
        'save_always' => true
      )
    ),
    'description' => __( 'Enter description.', 'my-text-domain' )
  ));
}

// Rejestracja elementu Katalog wystawców
function my_custom_wpbakery_element_katalog_wystawcow() {
  vc_map( array(
      'name' => __( 'Katalog wystawców', 'my-custom-plugin' ),
      'base' => 'katalog_wystawcow',
      'category' => __( 'My Elements', 'my-custom-plugin' ),
      'params' => array(
        array(
            'type' => 'textfield',
            'heading' => __( 'Enter ID', 'my-custom-plugin' ),
            'param_name' => 'identification',
            'description' => __( 'Enter trade fair ID number.', 'my-custom-plugin' ),
            'save_always' => true,
            'admin_label' => true
        ),
        array(
          'type' => 'checkbox',
          'heading' => __('Show details', 'my-custom-plugin'),
          'param_name' => 'details',
          'description' => __('Check to use to show details.', 'my-custom-plugin'),
          'admin_label' => true,
          'value' => array(__('True', 'my-custom-plugin') => 'true',),
        ),
        array(
          'type' => 'checkbox',
          'heading' => __('Ticket check', 'my-custom-plugin'),
          'param_name' => 'ticket',
          'description' => __('Check if there is a ticket above', 'my-custom-plugin'),
          'admin_label' => true,
          'value' => array(__('True', 'my-custom-plugin') => 'true',),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Catalog format', 'my-custom-plugin' ),
          'param_name' => 'format',
          'description' => __( 'Select catalog format.', 'my-custom-plugin' ),
          'value' => array(
            'Select' => '',
            'Full' => 'full',
            'Top21' => 'top21',
            'Top10' => 'top10'
          ),
          'save_always' => true,
          'admin_label' => true
        ),
      ),
      'description' => __( 'Enter description.', 'my-text-domain' )
  ) );
}

// Define the output function for the element
function my_custom_element_output($atts, $content = null) {
  // Get the current language of the website
  $locale = get_locale();

  extract(shortcode_atts(
    array(
      'file' => '',
      'element' => '',
      'color' => ''
    ),
    $atts
  ));

  if (empty($element)) {
    $file_path = plugin_dir_path(__FILE__) . 'my-custom-element/' . $atts['file'];
  } else {
    $file_path = plugin_dir_path(__FILE__) . 'my-custom-element/' . $atts['element'];
  }
  
  if (file_exists($file_path)) {
    ob_start();
    include $file_path;
    $file_cont = ob_get_clean();

    $file_cont = do_shortcode($file_cont);

    if ($color != '') {
      $file_cont = str_replace(
        array('color:white !important', 'color:black !important', 'box-shadow: 9px 9px 0px -6px white', 'box-shadow: 9px 9px 0px -6px black'),
        array('color:'.$color.' !important', 'color:'.$color.' !important', 'box-shadow: 9px 9px 0px -6px '.$color, 'box-shadow: 9px 9px 0px -6px '.$color),
        $file_cont
      );  
    }

    if ($color != '') {
      if ($color == '#ffffff') {
        $color1 = '#000000';
      } elseif ($color == '#000000') {
        $color1 = '#ffffff';
      }
      $file_cont = str_replace(
        array('text-shadow: 2px 2px white', 'text-shadow: 2px 2px black'),
        array('text-shadow: 2px 2px '.$color1, 'text-shadow: 2px 2px '.$color1),
        $file_cont
      );  
    }

    if ($color == '#000000') {
      $file_cont = str_replace(
        array('saturate'),
        array('invert'),
        $file_cont
      );  
    }     
    $file_cont = '<div custom-lang="' . $locale . '" class="custom_element">' . $file_cont . '</div>';
    return $file_cont;
  } else {
    echo '<script>console.error("File not found: ' . $file_path . '");</script>';
  }
}

// Zdefiniuj funkcję wyjścia dla elementu Katalog wystawców
function katalog_wystawcow_output($atts, $content = null) {
  extract( shortcode_atts( array(
    'identification' => '',
    'details' => '',
    'format' => '',
    'ticket' => ''
  ), $atts ) );

  $locale = get_locale();

  // If 'format' is not 'Top10', force 'ticket' to be false
  if ($format !== 'top10') {
    $ticket = 'false';
  }

  $id_targow = $identification;
  $today = new DateTime();
  $formattedDate = $today->format('Y-m-d');
  $token = md5("#22targiexpo22@@@#".$formattedDate);
  $canUrl = 'https://export.www2.pwe-expoplanner.com/mapa.php?token='.$token.'&id_targow='.$id_targow;

  $json = file_get_contents($canUrl);
  $data = json_decode($json, true);

  $script_data = array(
    'data' => $data,
    'json' => $json,
    'id_targow' => $id_targow,
    'details' => $details,
    'format' => $format,
    'ticket' => $ticket
    );
    
  // Twój kod dla tego elementu
  $output = '<div custom-lang="' . $locale . '" id="cat"></div>'; 
  $output .= '<div class="spinner"></div>';

  wp_enqueue_style( 'katalog_wystawcow-css', plugin_dir_url( __FILE__ ) . '/css/katalog.css' );
  wp_enqueue_script( 'katalog_wystawcow-js', plugin_dir_url( __FILE__ ) . '/js/katalog.js', array( 'jquery' ), '1.0', true );
  wp_localize_script( 'katalog_wystawcow-js', 'katalog_data', $script_data );

  return $output;
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

  $js_file = plugins_url('/js/script.js', __FILE__);
  $js_version = filemtime(plugin_dir_path(__FILE__) . '/js/script.js');
  wp_enqueue_script('my-custom-element-js', $js_file, array('jquery'), $js_version, true);
  wp_localize_script( 'my-custom-element-js', 'inner_data', $inner_data_array ); 

  $css_file = plugins_url('/css/style.css', __FILE__);
  $css_version = filemtime(plugin_dir_path(__FILE__) . '/css/style.css');
  wp_enqueue_style('my-custom-element-css', $css_file, array(), $css_version);
}

add_action('vc_before_init', 'my_custom_wpbakery_element');
add_shortcode('my_custom_element', 'my_custom_element_output');
add_action('wp_enqueue_scripts', 'my_custom_element_scripts');

// Rejestracja elementu Katalog wystawców
add_action( 'vc_before_init', 'my_custom_wpbakery_element_katalog_wystawcow' );
add_shortcode('katalog_wystawcow', 'katalog_wystawcow_output');
?>
