<?php

function register_custom_qr_check() {
  vc_map(array(
      'name' => __('QR Check', 'my-custom-plugin'),
      'base' => 'qr_check',
      'category' => __('My Elements', 'my-custom-plugin'),
      'params' => array(
          array(
              'type' => 'textfield',
              'heading' => __('Formularze ID', 'my-custom-plugin'),
              'param_name' => 'form_check',
              'value' => '',
              'description' => __('Wprowadź ID formularzy po przecinkach dla których chcesz sprawdzić kody QR. Jeżeli puste Użyje wszystkich formularzy dostępnych.', 'my-custom-plugin')
          ),
      )
  ));
}

function qr_check_output($atts){
    $atts = shortcode_atts(array(
        'form_check' => ''
    ), $atts, 'qr_check');

    $search_forms = $atts['form_check'];

    ?>
        <style>
            @media (min-width:600px) {
                #email{
                    width:500px;
                }
                #qr-form-submit-button{
                    margin-top: 18px;
                    max-width:130px;
                }
            }
            @media (max-width:599px) {
                #qr-form-submit-button{
                    margin-top: 18px;
                    max-width:130px;
                }
                #email{
                    width:100%;
                }
            }
            
            
        </style>
        <div id="qr-check" class="text-centered"> 
        <form id="qr-check-form" action="" method="post">
            <input type="text" id="email" name="email" placeholder="Email" required>
            <input type="submit" name="submit" value="Wyślij" id="qr-form-submit-button">
        </form>
    <?php

    if (isset($_POST["submit"])) {
        $email = trim($_POST["email"]);
        search_qr($email, $search_forms);
    }
}

function search_qr($email, $forms_id){
    $email = strtolower($email);
    echo '<div class="text-centered"><h5>'.$email.'</h5>';
    if ($forms_id){
        $forms_array = explode(",", $forms_id);
        $forms_array = array_map('trim', $forms_array);
        foreach ($forms_array as $form) {
            if ($entries = GFAPI::get_entries($form,null,null,array( 'offset' => 0, 'page_size' => 0 ))){                
                foreach ($entries as $entry) {
                    $form_fields = GFAPI::get_form($form);

                    foreach ($form_fields['fields'] as $field) {
                        if (rgar($entry, $field->id) === $email){
                            for ($i = 0; $i < 200; $i++) {
                                $meta_key = 'qr-code_feed_' . $i . '_url';

                                if (gform_get_meta($entry['id'], $meta_key)){
                                    echo '<p style="margin-top:50px;">'.GFAPI::get_form($form)['title'].'</p>';
                                    echo '<img style="margin-bottom:100px;" src="'.gform_get_meta($entry['id'], $meta_key).'">';
                                }
                            }
                        }
                    }
                }
            }
        }
    } else {    
        if (class_exists('GFAPI')) {
            $forms = GFAPI::get_forms();
            
            foreach ($forms as $form) {
                $entries = GFAPI::get_entries($form['id'],null,null,array( 'offset' => 0, 'page_size' => 0 ));
                
                foreach ($entries as $entry) {
                    $form_fields = GFAPI::get_form($form['id']);

                    foreach ($form_fields['fields'] as $field) {
                        if (rgar($entry, $field->id) === $email){
                            for ($i = 0; $i < 200; $i++) {
                                $meta_key = 'qr-code_feed_' . $i . '_url';

                                if (gform_get_meta($entry['id'], $meta_key)){
                                    echo '<p style="margin-top:50px;">'.$form['title'].'</p>';
                                    echo '<img style="margin-bottom:100px;" src="'.gform_get_meta($entry['id'], $meta_key).'">';
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    echo '</div>';
}

add_action('vc_before_init', 'register_custom_qr_check');
add_shortcode('qr_check', 'qr_check_output');
?>