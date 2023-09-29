<?php

function info_box() {
    // Define the element name and path to the element file
    vc_map(array(
      'name' => __('Info box', 'my-custom-plugin'),
      'base' => 'info_box',
      'category' => __('My Elements', 'my-custom-plugin'),
      'admin_enqueue_css' => plugin_dir_url( __FILE__ ) . 'backend-info.css',
      'params' => array(
        array(
            'type' => 'textfield',
            'group' => 'main',
            'heading' => __('Event time', 'my-custom-plugin'),
            'param_name' => 'event_time',
            'save_always' => true,
            'admin_label' => true
        ),
        array(
            'type' => 'textfield',
            'group' => 'main',
            'heading' => __('Event Name', 'my-custom-plugin'),
            'param_name' => 'event_name',
            'save_always' => true,
            'admin_label' => true
        ),
        array(
            'type' => 'attach_images',
            'group' => 'main',
            'heading' => __('Select Images', 'my-custom-plugin'),
            'param_name' => 'event_images',
            'description' => __('Choose images from the media library.', 'my-custom-plugin'),
            'save_always' => true,
        ),
        array(
            'type' => 'textfield',
            'group' => 'main',
            'heading' => __('Event Speaker', 'my-custom-plugin'),
            'param_name' => 'event_speaker',
            'description' => __('Put all names with "," separator', 'my-custom-plugin'),
            'save_always' => true,
            'admin_label' => true
        ),
        array(
            'type' => 'textarea',
            'group' => 'main',
            'heading' => __('Description', 'my-custom-plugin'),
            'param_name' => 'event_desc',
            'description' => __('Put event description.', 'my-custom-plugin'),
            'save_always' => true,
            'admin_label' => true
        ),
        array(
            'type' => 'textfield',
            'group' => 'options',
            'heading' => __('Border Radius', 'my-custom-plugin'),
            'param_name' => 'border_radius',
            'description' => __('Outside border radius(px or %).', 'my-custom-plugin'),
            'save_always' => true,
            'admin_label' => true
        ),
        array(
            'type' => 'textfield',
            'group' => 'options',
            'heading' => __('Border Width', 'my-custom-plugin'),
            'param_name' => 'border_width',
            'description' => __('Outside border width.', 'my-custom-plugin'),
            'save_always' => true,
            'admin_label' => true
        ),
        array(
            'type' => 'textfield',
            'group' => 'options',
            'heading' => __('Border Style', 'my-custom-plugin'),
            'param_name' => 'border_style',
            'description' => __('Outside style (example -> solid).', 'my-custom-plugin'),
            'save_always' => true,
            'admin_label' => true
        ),
        array(
            'type' => 'colorpicker',
            'group' => 'options',
            'heading' => __('Border Color', 'my-custom-plugin'),
            'param_name' => 'border_color',
            'description' => __('Outside border color.', 'my-custom-plugin'),
            'save_always' => true,
            'admin_label' => true
        ),
        array(
            'type' => 'colorpicker',
            'group' => 'options',
            'heading' => __('Lecturers color', 'my-custom-plugin'),
            'param_name' => 'lect_color',
            'description' => __('Color for lecturers names.', 'my-custom-plugin'),
            'save_always' => true,
            'admin_label' => true
        ),
        array(
            'type' => 'textarea',
            'group' => 'pop-UP',
            'heading' => __('Modal info for pictures', 'my-custom-plugin'),
            'param_name' => 'event_modal',
            'save_always' => true,
        ),
      ),
    ));
}

function info_box_output($atts, $content = null) {
    $rn = rand(10000, 99999);
    extract( shortcode_atts( array(
        'event_time' => '',
        'event_name' => '',
        'event_speaker' => '',
        'event_images' => '',
        'event_desc' => '',
        'event_modal' => '',
        'border_radius' => '',
        'border_width' => '',
        'border_style' => '',
        'border_color' => '',
        'lect_color' => '',
        'lecture_id' => $rn,
    ), $atts ) );
    
    $css_file = plugins_url('display-info.css', __FILE__);
    $css_version = filemtime(plugin_dir_url( __FILE__ ) . 'display-info.css');
    wp_enqueue_style('info_box-css', $css_file, array(), $css_version);

    $js_file = plugins_url('display-info.js', __FILE__);
    $js_version = filemtime(plugin_dir_url(__FILE__) . 'display-info.js');
    wp_enqueue_script('info_box-js', $js_file, array('jquery'), $js_version, true);
    wp_localize_script('info_box-js', 'inner' , $atts);

    $speakers = explode(',', $event_speaker);
    $speaker_imgs = explode(',',$event_images);
    $speaker_html = '<div class="speakers">';
    $modal_html = '<div class="modal-lecturers">';

    if ($event_images == ''){
        $speaker_html = '<div class="speakers">';
        foreach ($speakers as $speaker) {
            $speaker_html .= '<h4 class="name-container">' . $speaker . '</h4>';
        } 
    } else {
        $speaker_html = '<div class="speakers-img">';
        for ($i = 0; $i < count($speaker_imgs); $i++) {            
            if (isset($speaker_imgs[$i])) {
                $image_src = wp_get_attachment_image_src($speaker_imgs[$i], 'full');
                if ($image_src) {
                    $z_index = (1 + $i);
                    $margin_top_index = '';
                    switch (count($speaker_imgs)) {
                        case 1:
                            $top_index = "unset";
                            $left_index = "unset";
                            $max_width_index = "50%";
                            break;
                    
                        case 2:
                            switch ($i) {
                                case 0:
                                    $margin_top_index = "margin-top : 20px";
                                    $max_width_index = "50%";
                                    $top_index = "-10px";
                                    $left_index = "15px";
                                    break;
                    
                                case 1:
                                    $max_width_index = "50%";
                                    $top_index = "10px";
                                    $left_index = "-15px";
                                    break;
                            }
                            break;
                    
                        case 3:
                            switch ($i) {
                                case 0:
                                    $max_width_index = "35%";
                                    $top_index = "15px";
                                    $left_index = "unset";
                                    break;
                    
                                case 1:
                                    $max_width_index = "35%";
                                    $top_index = "40px";
                                    $left_index = "-15px";
                                    break;
                    
                                case 2:
                                    $max_width_index = "35%";
                                    $top_index = "-15px";
                                    $left_index = "-30px";
                                    break;
                            }
                            break;
                    }
                    
                    $speaker_html .= '<img class="speaker" src="' . esc_url($image_src[0]) . '" alt="'.$speakers[$i].' portrait" style="position:relative; z-index:'.$z_index.'; top:'.$top_index.'; left:'.$left_index.'; max-width: '.$max_width_index.';'.$margin_top_index.';" />';
                }
            }
        }
    }
    $speaker_html .= '</div>';
    
    $event_modal = substr($event_modal, 3);
    $event_modal = substr($event_modal, 0, -3);
    $event_modal = str_replace("``", '"', $event_modal);
    $event_modal = "[". $event_modal . "]";

    $modal_array = json_decode($event_modal, true);

    for($i=0; $i<count($modal_array); $i++){
        if($modal_array[$i]['id']){
            $modal_html .= '<div class=lecturer>';
            $image_src = '';
            if($speaker_imgs[$i]){
            $image_src = wp_get_attachment_image_src($speaker_imgs[$i], 'full');
            }
            $modal_html .= '<div class="modal-image"><img src="'.$image_src[0].'"></div>
                            <div class="modal-desc"><h3 style="color:'.$atts['lect_color'].';">'.$modal_array[$i]['id'].'</h3>';
        } else {
            $modal_html .= '<div class="modal-image"></div>';
        }
        if($modal_array[$i]['desc']){
            $modal_html .= '<p>'.$modal_array[$i]['desc'].'</p></div></div>';
        } else {
            $modal_html .= '</div></div>';
        }
    }
    
    $html =
        '<div id="lecture-'.$rn.'" class="chevron-slide" style="border:'.$atts['border_width'].' '.$atts['border_style'].' '.$atts['border_color'].'; border-radius:'.$atts['border_radius'].';">
            <div class="head-container">
                ' . $speaker_html;
    if (count($speaker_imgs) < 3){
        $html .=
                '<button class="lecturers-bio btn btn-sm btn-default lecture-btn">BIO</button>';
    } else {
        $html .=
                '<button class="lecturers-bio lecturers-triple btn btn-sm btn-default lecture-btn">BIO</button>';
    }
        $html .=
            '</div>

            <div class="text-container">
                <h4 class="lectur-time">' . $event_time . '</p>
                <h5 class="lecturer-name" style="color:'.$atts['lect_color'].';">'.$event_speaker.'</p> 
                <h3 class="inside-title">' . $event_name . '</h3>';
    if($event_desc != ''){
        $html .='<p class="inside-text" style="display:none">' . $event_desc . '</p>
                    <p class="open-desc"><i class="text-accent-color fa fa-chevron-down fa-1x fa-fw"></i>Opis wykładu <i class="text-accent-color fa fa-chevron-down fa-1x fa-fw"></i></p>';
                
    }
    $html .='</div>
            <div id="info-modal" class="info-modal" style="display:none;">
                <div class="info-modal-content">
                    '.$modal_html.'
                </div>
                <i class="fa fa-times-circle-o fa-2x fa-fw info-close"></i>
            </div>
        </div>';
    
    return $html;
}

function load_backend_scripts() {

    $css_file = plugins_url('backend-info.css', __FILE__);
    $css_version = filemtime(plugin_dir_url( __FILE__ ) . 'backend-info.css');
    wp_enqueue_style('info_box-css', $css_file, array(), $css_version);

    $js_file = plugins_url('backend-info.js', __FILE__);
    $js_version = filemtime(plugin_dir_url(__FILE__) . 'backend-info.js');
    wp_enqueue_script('info_box-js', $js_file, array('jquery'), $js_version, true);

}
add_action('admin_enqueue_scripts', 'load_backend_scripts');

add_action('vc_before_init', 'info_box');
add_shortcode('info_box', 'info_box_output');

?>