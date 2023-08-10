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
    
    wp_enqueue_style( 'info_box-css', plugin_dir_url( __FILE__ ) . 'display-info.css' );
    wp_enqueue_script( 'info_box-js', plugin_dir_url( __FILE__ ) . 'display-info.js', array( 'jquery' ), '1.0', true );
    wp_localize_script('info_box-js', 'inner', array('event_modal' => $atts['event_modal']));

    $height = '120px';
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
        $height = '202px';
        for ($i = 0; $i < count($speakers); $i++) {
            $speaker_html .= '<div class="'.$speakers[$i].' speaker-container" style="flex:1" >';
            if (isset($speaker_imgs[$i])) {
                $image_src = wp_get_attachment_image_src($speaker_imgs[$i], 'full');
                if ($image_src) {
                    $speaker_html .= '<img src="' . esc_url($image_src[0]) . '" alt="'.$speakers[$i].' portrait" />';
                }
            }
            $speaker_html .= '<p class="name-container text-centered" style="font-weight:700;">' . $speakers[$i] . '</p></div>';
        }
    }
    $speaker_html .= '</div>';

    $html =
        '<div class="chevron-slide">
            <div class="head-container" style="height:auto; overflow:hidden;">
                <p>' . $event_time . '</p> 
                ' . $speaker_html . '
            </div>
            <div class="text-container" style="height:'.$height.'; overflow:hidden;">
                <h3 class="inside-title">' . $event_name . '</h3>
                <p class="inside-text">' . $event_desc . '</p>
            </div>
            <i class="text-accent-color fa fa-chevron-down fa-1x fa-fw"></i>
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

if (is_admin()) {
    wp_enqueue_script( 'info_box-js', plugin_dir_url( __FILE__ ) . 'backend-info.js', array( 'jquery' ), '1.0', true );
}

add_action('vc_before_init', 'info_box');
add_shortcode('info_box', 'info_box_output');

?>