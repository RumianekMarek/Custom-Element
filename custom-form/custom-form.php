<?php

function custom_forms() {
    vc_map(array(
        'name' => __('Custom Formularz', 'my-custom-plugin'),
        'base' => 'custom_forms',
        'category' => __('My Elements', 'my-custom-plugin'),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __('Heder Formularza', 'my-custom-plugin'),
                'param_name' => 'form_header',
                'save_always' => true,
            ),
            array(
                'type' => 'textarea_html',
                'heading' => __('Opis Formularza', 'my-custom-plugin'),
                'param_name' => 'content',
                'save_always' => true,
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Nazwa formularza', 'my-custom-plugin'),
                'param_name' => 'form_name',
                'save_always' => true,
                'admin_label' => true,
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Napis na przycisku', 'my-custom-plugin'),
                'param_name' => 'button_text',
                'save_always' => true,
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('wy', 'my-custom-plugin'),
                'edit_field_class' => 'notif-switch',
                'param_name' => 'p_drop',
                'save_always' => true,
                'value' => array( 
                    'input' => 'url',
                    'rejestracja' => 'potwierdzenie-rejestracja.html',
                ),
            ),
            array(
                'type' => 'textfield',
                'edit_field_class' => 'notif-switch',
                'param_name' => 'p_url',
                'save_always' => true,
                'value' => '',
                'dependency' => array(
                    'element' => 'p_drop',
                    'value' => array('url'),
                ),
            ),
            array(
                'heading' => __('Form fields', 'my-custom-plugin'),
                'type' => 'param_group',
                'param_name' => 'form_fields',
                'save_always' => true,
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => __('Field name', 'my-custom-plugin'),
                        'param_name' => 'field_name',
                        'save_always' => true,
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __('Field_type', 'my-custom-plugin'),
                        'param_name' => 'field_type',
                        'value' => 'text',
                        'save_always' => true,
                    ),
                ),
            ),
        )
    ));
}

function custom_forms_output($atts, $content = null) {
    $rn = rand(10000, 99999);
    extract( shortcode_atts( array(
        'form_fields' => '',
    ), $atts ) );

    $form_name = str_replace(
            array('`{`','`}`'), 
            array('[',']'), 
            $atts['form_name']);
    $form_name = do_shortcode($form_name);

    global $notification;
    $notification = ($atts['p_drop'] == 'url') ? $atts['p_url'] : plugin_dir_path(__FILE__) . $atts['p_drop'];
    $form_desc = !empty($content) ? nl2br($content) : $atts['event_desc'];
    $form_header = !empty($atts['form_header']) ? $atts['form_header'] : $form_name;
    $button_text = !empty($atts['button_text']) ? $atts['button_text'] : 'SEND';

    echo '<script>console.log("'.$notification.'")</script>';
    
    include_once plugin_dir_path(__FILE__) . '/../main-katalog/main-katalog-wystawcow.php';

    $atts_catalog = [
        'color' => '',
        'format' => 'top10',
        'slider_desktop' => '',
        'grid_mobile' => '',
        'identification' => '',
        'catalog_year' => '',
        'export_link' => '',
        'file_changer' => ''
    ];

    
    $form_fields = urldecode($atts['form_fields']);
    $form_fields = json_decode($form_fields);

    $custom_form = '<form id="'.str_replace(' ','-',$form_name).'" action="" method="post">';

    foreach ($form_fields as $id => $field){
        if ($field->field_type == "label"){
            $custom_form .= '<label id="'.$field->field_name.'-label" required>'.$field->field_name.'</label>';
        } elseif ($field->field_type == "zgoda"){
            $custom_form .= '<div class="zgoda"><input type="checkbox"><label>Wyrażam zgodę na przetwarzanie przez PTAK WARSAW EXPO sp. z o.o. moich danych osobowych w celach marketingowych i wysyłki wiadomości.<span> (Więcej)*</span></label></div>';
        } else {
            $custom_form .= '<input type="'.$field->field_type.'" id="'.$field->field_name.'" name="'.$field->field_name.'" placeholder="'.$field->field_name.'" required>';
        }
    }
    $custom_form .= '<button class="custom-form-button btn" id="submit-form" name="submit">'.$button_text.'</button>';
    $custom_form .= '</form>';
    
    $custom_form_return ='
    <div id="custom-form-'.$rn.'" class="custom-form">
        <div class="form-side style-accent-bg single-block-padding">
            <h4 class="heading-text text-uppercase">'.$form_header.'</h4>
            <p>'.$form_desc.'</p>
            '.$custom_form.'
        </div>
        <div class="logos-side single-block-padding">
            '.katalog_wystawcow_output($atts_catalog).'
        </div>
    </div>';

    $css_file = plugins_url('custom-form.css', __FILE__);
    $css_version = filemtime(plugin_dir_path(__FILE__) . 'custom-form.css');
    wp_enqueue_style('custom-form-css', $css_file, array(), $css_version);

    if (isset($_POST["submit"])) {
        custom_form_check($form_name, $_POST, $rn);
    }
    return $custom_form_return;
}

function custom_form_check($form_name, $form_data, $rn){
 
    $forms = GFAPI::get_forms();

    $form_true = false;
    foreach ($forms as $form ){
        if($form["title"] === $form_name){
            $form_id = $form["id"];
            $form_true = true;
            break;
        } 
    } 

    if ($form_true === false){
        create_custom_form($form_name, $form_data, $rn);
    }
        add_custom_form_entry($form_id, $form_data);
}

function create_custom_form($form_name, $form_data, $rn){
    $custom_form_fields = array();
    $for_field_id = 2;
    $custom_form_fields[] = array(
        'label' => 'Data_Pozycji',
        'id' => 1,
    );
    foreach ($form_data as $id => $data){
        if($id != 'submit'){
            $custom_form_fields[] = array(
                'label' => $id,
                'id' => $for_field_id,
            );
            $for_field_id++;
        }
    }
    $custom_form_fields[] = array(
        'label' => 'UTM',
        'id' => $for_field_id,
    );

    $form_id = GFAPI::add_form(array(
        'title' => $form_name,
        'fields' =>  $custom_form_fields,
    ));

    custom_form_qr($form_id, $form_name, $rn);
}

function custom_form_qr($form_id, $form_name, $rn){

    $dom_name = str_replace(' ', '', strtoupper(get_bloginfo('name')));
    $label = $label = substr($dom_name, 0, 4) . str_pad($form_id, 3, '0', STR_PAD_LEFT);

    $feed = array(
        'feedName' => $form_name,
        'qrcodeLabel' => '',
        'qrcodeSize' => '200',
        'feed_condition_conditional_logic_object' => array(),
        'feed_condition_conditional_logic' => '0',
        'qrcodeFields' => array(
            array('key' => 'gf_custom', 'custom_key' => $label, 'value' => 'id', 'custom_value' => ''),
            array('key' => 'gf_custom', 'custom_key' => 'RND'.$rn, 'value' => 'id', 'custom_value' => ''),
        ),
        'feedCondition' => ''
    );  

    $if_exist = GFAPI::get_feeds( null, 122 );
    $qr_exist = false;

    foreach($if_exist as $fed){
        if ($fed->addon_slug == 'qr-code'){
            $qr_exist = true;
        }
    }

    if (!$qr_exist){
        $result = GFAPI::add_feed( $form_id, $feed, 'qr-code' );
        
        if ( is_wp_error( $result ) ) {
            echo '<script>console.log("'.$result->get_error_message().'")</script>';
        }
    }
}

function add_custom_form_entry($form_id, $form_data){
    $form_entry_data = array(
        'form_id' => $form_id,
        1 => current_time('Y-m-d H:i:s'),
    );
    $for_field_id = 2;
    foreach($form_data as $data){        
        $form_entry_data[$for_field_id] = $data;
        $for_field_id++;
    }
    $entry_id = GFAPI::add_entry($form_entry_data);
    send_notification($form_id, $form_data, $entry_id);
}

function send_notification($form_id, $form_data, $entry_id){
    $meta_key = '';
    for ($i=0; $i<=300;$i++){
        if(gform_get_meta($entry_id , 'qr-code_feed_' . $i . '_url') != ''){
          $meta_key = 'qr-code_feed_' . $i . '_url';
          break;
        }
    }
    $qr_image = gform_get_meta($entry_id, $meta_key);

    $locale = get_locale();

    $subject = ($locale == 'pl_PL') ? "Potwierdzenie prosby o identyfikator papierowy" : "Confirmation of paper ID request";
    $name = '';
    foreach ($form_data as $id => $data){
        if (strpos(strtolower($id), 'nazwisko') !== false || strpos(strtolower($id), 'name') !== false) {
            $name = $data;
            break;
        }
    }
    global $notification;
    $file_path = $notification;

    $html_files = glob('doc/*.*');
    $header = 'cos';

    foreach ($html_files as $file) {
        if(basename($file) == 'header.webp' || basename($file) == 'header.png' || basename($file) == 'header.jpg'){
            $header = $file;
            break;
        }
    }

    $message = file_get_contents($file_path);
    $message = do_shortcode($message);

    $message = str_replace("{Imię i nazwisko:1}", $name, $message); 
    $message = str_replace("{header}", $header, $message); 
    $message = str_replace("{qrcode-image}", $qr_image, $message); 

    $domain = do_shortcode('[trade_fair_domainadress]');
    $headers = "From: rejestracja@" . $domain . "\r\n";
    $headers .= "Reply-To: rejestracja@" . $domain . "\r\n";
    $headers .= "Content-Type: text/html\r\n";
    $headers .= "Date: " . date("D, d M Y H:i:s") . " UT\r\n";
    
    $mail = '';
    foreach ($form_data as $id => $data){
        if(strpos(strtolower($id), 'email') != false){
            $mail = $data;
            break;
        }
    }

    echo '<script>console.log("'.$mail.'")</script>';
    
    if (mail($mail, $subject, $message, $headers)) {
    } else {
        error_log("Wystąpił błąd podczas wysyłania emaila.");
    }
}

add_action('vc_before_init', 'custom_forms');
add_shortcode('custom_forms', 'custom_forms_output');
?>