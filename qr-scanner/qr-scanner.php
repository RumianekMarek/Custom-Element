<?php 

function register_custom_qr_scanner() {
    vc_map(array(
        'name' => __('QR Scanner', 'my-custom-plugin'),
        'base' => 'qr-scanner',
        'category' => __('My Elements', 'my-custom-plugin'),
        'params' => array(),
    ));
}

function custom_qr_scanner_output(){   
    echo '<button class="btn" id="startCamera">Otwórz kamerę</button>';
    echo '<video autoplay id="camera" style="display:none;"></video>';

}

function custom_qr_scanner_scripts(){
    $js_url = plugins_url('qr-scanner.js', __FILE__);
    wp_enqueue_script('qr-scanner', $js_url, array('jquery'), '1.0', true);

    $css_file = plugins_url('qr-scanner.css', __FILE__);
    $css_version = filemtime(plugin_dir_path(__FILE__) . 'qr-scanner.css');
wp_enqueue_style('qr-scanner-css', $css_file, array(), $css_version);
}

add_action('vc_before_init', 'register_custom_qr_scanner');
add_shortcode('qr-scanner', 'custom_qr_scanner_output');
add_shortcode('qr-scanner', 'custom_qr_scanner_scripts');

?>