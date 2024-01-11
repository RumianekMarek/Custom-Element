<?php

function speakers_box() {
    // Define the element name and path to the element file
    vc_map(array(
        'name' => __('Speakers info box ', 'my-custom-plugin'),
        'base' => 'speakers_box',
        'category' => __('My Elements', 'my-custom-plugin'),
        'admin_enqueue_css' => plugin_dir_url( __FILE__ ) . 'backend-info.css',
        'params' => array(
            array(
                'heading' => __('Speakers', 'my-custom-plugin'),
                'group' => 'main',
                'type' => 'param_group',
                'param_name' => 'speakers',
                'save_always' => true,
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'heading' => __('Select Speaker Image', 'my-custom-plugin'),
                        'param_name' => 'speaker_image',
                        'description' => __('Choose speaker image from the media library.', 'my-custom-plugin'),
                        'save_always' => true,
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __('Speaker Name', 'my-custom-plugin'),
                        'param_name' => 'speaker_name',
                        'save_always' => true,
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textarea',
                        'heading' => __('Bio', 'my-custom-plugin'),
                        'param_name' => 'speaker_bio',
                    ),
                ),
            ),
            array(
                'type' => 'colorpicker',
                'group' => 'options',
                'heading' => __('Lecturers color', 'my-custom-plugin'),
                'param_name' => 'lect_color',
                'description' => __('Color for lecturers names.', 'my-custom-plugin'),
                'save_always' => true,
            ),
            array(
                'type' => 'textfield',
                'group' => 'options',
                'heading' => __('BIO Img size', 'my-custom-plugin'),
                'param_name' => 'modal_img_size',
                'description' => __('Size of the Img for "BIO" description. max 300px', 'my-custom-plugin'),
                'save_always' => true,
            ),
            array(
                'type' => 'colorpicker',
                'group' => 'options',
                'heading' => __('BIO BTN Color', 'my-custom-plugin'),
                'param_name' => 'bio_color',
                'description' => __('Color for buton "BIO".', 'my-custom-plugin'),
                'save_always' => true,
            ),
            array(
                'type' => 'colorpicker',
                'group' => 'options',
                'heading' => __('BIO BTN Text Color', 'my-custom-plugin'),
                'param_name' => 'bio_text',
                'description' => __('Color for text on buton "BIO" .', 'my-custom-plugin'),
                'save_always' => true,
            ),
            array(
                'type' => 'checkbox',
                'group' => 'options',
                'heading' => __('Photo as square', 'my-custom-plugin'),
                'param_name' => 'photo_squer',
                'description' => __('Check to show photos as square.', 'my-custom-plugin'),
                'admin_label' => true,
                'value' => array(__('True', 'my-custom-plugin') => 'true',),
            ),
        ),
    ));
}

function speakers_box_output($atts, $content = null) {
    $rn = rand(10000, 99999);
    extract( shortcode_atts( array(
        'border_radius' => '',
        'border_style' => '',
        'border_color' => '',
        'lect_color' => '',
        'bio_color' => '',
        'title_color' => '',
        'photo_squer' => '',
    ), $atts ) );

    $locale = get_locale();

    $lecture_id = !empty($atts['lecture_id']) ? $atts['lecture_id'] : $rn;

    $speakers = urldecode($atts['speakers']);
    $speakers = json_decode($speakers);

    foreach ($speakers as $id => $speaker){
        $speakers[$id]->speaker_image = wp_get_attachment_image_src($speaker->speaker_image, 'full')[0];
    }

    $modal_img_size = !empty($atts['modal_img_size']) ? 'width: '.$atts['modal_img_size'].';' : 'width: 120px;';
    $bio_text = !empty($atts['bio_text']) ? 'color: '.$atts['bio_text'].'!important;' : '';
    
    $event_title = str_replace('``','"', $event_title);

    $uncode_options = get_option('uncode');

    $css_file = plugins_url('display-info.css', __FILE__);
    $css_version = filemtime(plugin_dir_url( __FILE__ ) . 'display-info.css');
    wp_enqueue_style('info_box-css', $css_file, array(), $css_version);

    $js_file = plugins_url('speakers-info.js', __FILE__);
    $js_version = filemtime(plugin_dir_url(__FILE__) . 'speakers-info.js');
    wp_enqueue_script('speakers_box-js', $js_file, array('jquery'), $js_version, true);
    wp_localize_script('speakers_box-js', 'speakers' , $speakers);

    $html = '<div id="speakersInfo-'.$rn.'" class="speakersInfo">';
    foreach($speakers as $id => $speak){
        $html .= '
                <div class="'.$speak->speaker_name.' speaker-'.$id.'">
                    <img class="custom-speaker-img" src="'.$speak->speaker_image.'" style="'.$modal_img_size.'">
                    <h5 style="margin-top: 9px;">'.$speak->speaker_name.'</h5>';
                    if(!empty($speak->speaker_bio)){
                        $html .='<button class="speakers-bio btn btn-sm btn-default lecture-btn" style="background-color:'.$bio_color.' !important; '.$bio_text.'">BIO</button>';
                    }
                $html .='</div>';
    }
    $html .= '</div>';
    return $html;
}

add_action('vc_before_init', 'speakers_box');
add_shortcode('speakers_box', 'speakers_box_output');

?>