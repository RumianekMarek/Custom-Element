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
    extract( shortcode_atts( array(
        'event_time' => '',
        'event_name' => '',
        'event_speaker' => '',
        'event_images' => '',
        'event_desc' => '',
        'event_modal' => '',
    ), $atts ) );

    $css_file = plugins_url('display-info.css', __FILE__);
    $css_version = filemtime(plugin_dir_url( __FILE__ ) . 'display-info.css');
    wp_enqueue_style('info_box-css', $css_file, array(), $css_version);

    $js_file = plugins_url('display-info.js', __FILE__);
    $js_version = filemtime(plugin_dir_url(__FILE__) . 'display-info.js');
    wp_enqueue_script('info_box-js', $js_file, array('jquery'), $js_version, true);
    wp_localize_script('info_box-js', 'inner', array('event_modal' => $atts['event_modal']));

    $speakers = explode(',', $event_speaker);
    $speaker_imgs = explode(',',$event_images);

    $speaker_html = '<div class="speakers">';

    if ($event_images == ''){
        $speaker_html = '<div class="speakers">';
        foreach ($speakers as $speaker) {
            $speaker_html .= '<h4 class="name-container">' . $speaker . '</h4>';
        } 
    } else {
        $speaker_html = '<div class="speakers-img">';
        for ($i = 0; $i < count($speakers); $i++) {
            if (isset($speaker_imgs[$i])) {
                $image_src = wp_get_attachment_image_src($speaker_imgs[$i], 'full');
                if ($image_src) {
                    $z_index = (1 + $i);
                    switch (count($speakers)) {
                        case 1:
                            $top_index = "unset";
                            $left_index = "unset";
                            break;
                    
                        case 2:
                            switch ($i) {
                                case 0:
                                    $top_index = "-10px";
                                    $left_index = "15px";
                                    break;
                    
                                case 1:
                                    $top_index = "10px";
                                    $left_index = "-15px";
                                    break;
                            }
                            break;
                    
                        case 3:
                            switch ($i) {
                                case 0:
                                    $top_index = "10px";
                                    $left_index = "15px";
                                    break;
                    
                                case 1:
                                    $top_index = "40px";
                                    $left_index = "-15px";
                                    break;
                    
                                case 2:
                                    $top_index = "-10px";
                                    $left_index = "-15px";
                                    break;
                            }
                            break;
                    }
                    
                    $speaker_html .= '<img class="speaker" src="' . esc_url($image_src[0]) . '" alt="'.$speakers[$i].' portrait" style="position:relative; z-index:'.$z_index.'; top:'.$top_index.'; left:'.$left_index.';" />';
                }
            }
        }
    }
    $speaker_html .= '</div>';

    $html =
        '<div class="chevron-slide border-accent-color">
            <div class="head-container">
                ' . $speaker_html . '
            </div>
            <div class="text-container">
                <h4 class="lectur-time">' . $event_time . '</p>
                <h5 class="lecturer-name">'.$event_speaker.'</p> 
                <h3 class="inside-title">' . $event_name . '</h3>';
    if($event_desc != ''){
        $html .='<p class="open-desc"><i class="text-accent-color fa fa-chevron-down fa-1x fa-fw"></i> Sprawdź opis wykładu <i class="text-accent-color fa fa-chevron-down fa-1x fa-fw"></i></p>
                <p class="inside-text" style="display:none">' . $event_desc . '</p>';
    }
    $html .='</div>
            
        </div>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <div>
                    <img id="modalImg"/>
                </div>
                <div>
                    <h3 id="modalHeader"></h3>
                    <p id="modalText"></p>
                </div>
                <span class="close">&times;</span>
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