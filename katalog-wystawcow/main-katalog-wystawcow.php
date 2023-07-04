<?php 
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
    ));
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

wp_enqueue_style( 'katalog_wystawcow-css', plugin_dir_url( __FILE__ ) . 'katalog.css' );
wp_enqueue_script( 'katalog_wystawcow-js', plugin_dir_url( __FILE__ ) . 'katalog.js', array( 'jquery' ), '1.0', true );
wp_localize_script( 'katalog_wystawcow-js', 'katalog_data', $script_data );

return $output;
}
// Rejestracja elementu Katalog wystawców
add_action( 'vc_before_init', 'my_custom_wpbakery_element_katalog_wystawcow' );
add_shortcode('katalog_wystawcow', 'katalog_wystawcow_output');
?>