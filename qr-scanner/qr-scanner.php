<?php

function register_custom_qr_scanner() {
    vc_map(array(
        'name' => __('QR Scanner', 'my-custom-plugin'),
        'base' => 'qr_scanner',
        'category' => __('My Elements', 'my-custom-plugin'),
        'params' => array(),
    ));
}

function custom_qr_scanner_output() {
    // Wyświetlanie zawartości elementu
    echo '<button class="btn" id="startCamera">Otwórz kamerę</button>';
    echo '<video autoplay id="camera" style="display:none;"></video>';

    
    // Dołączanie skryptu JavaScript
    $js_file = plugins_url('qr-scanner.js', __FILE__);
    $js_version = filemtime(plugin_dir_path(__FILE__) . 'qr-scanner.js');
    wp_enqueue_script('qr_scanner', $js_file, array('jquery'), $js_version);

    // Dołączanie stylu CSS
    $css_file = plugins_url('qr-scanner.css', __FILE__);
    $css_version = filemtime(plugin_dir_path(__FILE__) . 'qr-scanner.css');
    wp_enqueue_style('qr_scanner', $css_file, array(), $css_version);
}

// Rejestracja elementu wizualnego
add_action('vc_before_init', 'register_custom_qr_scanner');

// Definicja shortcode do wyświetlenia zawartości elementu
add_shortcode('qr_scanner', 'custom_qr_scanner_output');
?>