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
            'type' => 'checkbox',
            'group' => 'main',
            'heading' => __('Simple form', 'my-custom-plugin'),
            'param_name' => 'simple_mode',
            'description' => __('To display in simpler form.', 'my-custom-plugin'),
            'admin_label' => true,
            'value' => array(__('True', 'my-custom-plugin') => 'true',),
        ),
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
            'heading' => __('Event Speakers (pictures order)', 'my-custom-plugin'),
            'param_name' => 'event_speaker',
            'description' => __('Put all names with "," separator, in order of pictures.', 'my-custom-plugin'),
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
            'description' => __('Choose lecturers images from the media library.', 'my-custom-plugin'),
            'save_always' => true,
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
        ),
        array(
            'type' => 'textfield',
            'group' => 'options',
            'heading' => __('Border Width', 'my-custom-plugin'),
            'param_name' => 'border_width',
            'description' => __('Outside border width.', 'my-custom-plugin'),
            'save_always' => true,
        ),
        array(
            'type' => 'textfield',
            'group' => 'options',
            'heading' => __('Border Style', 'my-custom-plugin'),
            'param_name' => 'border_style',
            'description' => __('Outside style (example -> solid).', 'my-custom-plugin'),
            'save_always' => true,
        ),
        array(
            'type' => 'colorpicker',
            'group' => 'options',
            'heading' => __('Border Color', 'my-custom-plugin'),
            'param_name' => 'border_color',
            'description' => __('Outside border color.', 'my-custom-plugin'),
            'save_always' => true,
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
            'type' => 'checkbox',
            'group' => 'options',
            'heading' => __('Shadow', 'my-custom-plugin'),
            'param_name' => 'shadow',
            'description' => __('Check to display shadow. ONLY full catalog.', 'my-custom-plugin'),
            'admin_label' => true,
            'value' => array(__('True', 'my-custom-plugin') => 'true',),
        ),
        array(
            'type' => 'colorpicker',
            'group' => 'options',
            'heading' => __('Tile Color', 'my-custom-plugin'),
            'param_name' => 'title_color',
            'description' => __('Color for buton lecture Title.', 'my-custom-plugin'),
            'save_always' => true,
        ),
        array(
            'type' => 'textfield',
            'group' => 'options',
            'heading' => __('Tile size', 'my-custom-plugin'),
            'param_name' => 'title_size',
            'description' => __('Title font size.', 'my-custom-plugin'),
            'save_always' => true,
        ),
        array(
            'type' => 'checkbox',
            'group' => 'options',
            'heading' => __('Tittle on top', 'my-custom-plugin'),
            'param_name' => 'title_top',
            'description' => __('Check to move Title to top of Lecturers.', 'my-custom-plugin'),
            'admin_label' => true,
            'value' => array(__('True', 'my-custom-plugin') => 'true',),
        ),
        array(
            'type' => 'textarea',
            'group' => 'pop-UP',
            'heading' => __('Modal info for pictures', 'my-custom-plugin'),
            'param_name' => 'event_modal',
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
            'heading' => __('Photo/Bio box', 'my-custom-plugin'),
            'param_name' => 'photo_box',
            'description' => __('Check to show Photo/Bio box at left side.', 'my-custom-plugin'),
            'admin_label' => true,
            'value' => array(__('True', 'my-custom-plugin') => 'true',),
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

function info_box_output($atts, $content = null) {
    $rn = rand(10000, 99999);
    extract( shortcode_atts( array(
        'simple_mode' => '',
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
        'bio_color' => '',
        'title_color' => '',
        'shadow' => '',
        'photo_box' => '',
        'photo_squer' => '',
        'title_top' => '',
        'lecture_id' => $rn,
    ), $atts ) );

    
        $locale = get_locale();

        $border_radius = ($atts['border_radius']) ? 'border-radius: '.$atts['border_radius'].';': '';
        $border_width = isset($atts['border_width']) ? $atts['border_width'] : '2px';
        $border_style = isset($atts['border_style']) ? $atts['border_style'] : 'solid';
        $border_color = isset($atts['border_color']) ? $atts['border_color'] : '#000000';
        $lect_color = isset($atts['lect_color']) ? 'color: '.$atts['lect_color'].';' : 'color: #000000;';
        $bio_color = isset($atts['bio_color']) ? $atts['bio_color'] : '#000000';
        $title_color = isset($atts['title_color']) ? $atts['title_color'] : '#000000';
        $shadow = isset($atts['shadow']) ? 'box-shadow: 4px 4px 7px 2px;' : '';
        $photo_box = isset($atts['photo_box']) ? $atts['photo_box'] : '';
        $modal_img_size = isset($atts['modal_img_size']) ? 'width: '.$atts['modal_img_size'].';' : 'width: 120px';
        $bio_text = isset($atts['bio_text']) ? 'color: '.$atts['bio_text'].'!important;' : '';
        $title_size = isset($atts['title_size']) ? ' font-size: '.$atts['title_size'].'!important; ' : '';
        
        $event_name = str_replace('``','"', $event_name);

        $uncode_options = get_option('uncode');

        $css_file = plugins_url('display-info.css', __FILE__);
        $css_version = filemtime(plugin_dir_url( __FILE__ ) . 'display-info.css');
        wp_enqueue_style('info_box-css', $css_file, array(), $css_version);

        $js_file = plugins_url('display-info.js', __FILE__);
        $js_version = filemtime(plugin_dir_url(__FILE__) . 'display-info.js');
        wp_enqueue_script('info_box-js', $js_file, array('jquery'), $js_version, true);
        wp_localize_script('info_box-js', 'inner' , $atts);

        if (!$simple_mode){
            
        $speakers = explode(';', $event_speaker);
        $speaker_imgs = explode(',',$event_images);
        $speaker_html = '<div class="speakers">';
        $modal_html = '<div class="modal-lecturers">';
        
        if (count($speakers)>3 || (preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT']))){
            $font_lecturers = 'font-size: 14px; margin-top: 9px;';
            $info_box_max_height = 'unset;';
        } else {
            $font_lecturers = '';
            $info_box_max_height = '280px;';
        }

        if ($event_images == ''){
            $speaker_html = '<div class="speakers">';

            // foreach ($speakers as $speaker) {
            //     $speaker_html .= '<h4 class="name-container" style="'.$font_lecturers.' text-align:left;">' . $speaker . '</h4>';
            // } 
        } else {
            $speaker_html = '<div class="speakers-img">';
            for ($i = 0; $i < count($speaker_imgs); $i++) {            
                if (isset($speaker_imgs[$i])) {
                    $image_src = wp_get_attachment_image_src($speaker_imgs[$i], 'full');

                    
                    if ($image_src) {
                        if (!$photo_squer){
                            $b_radius = 'border-radius: 50%;';
                        }
                        $z_index = (1 + $i);
                        $margin_top_index = '';
                        switch (count($speaker_imgs)) {
                            case 1:
                                $top_index = "unset";
                                $left_index = "unset";
                                $max_width_index = "80%";
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
                        
                        $speaker_html .= '<img class="speaker" src="' . esc_url($image_src[0]) . '" alt="'.$speakers[$i].' portrait" style="position:relative; '.$b_radius.' z-index:'.$z_index.'; top:'.$top_index.'; left:'.$left_index.'; max-width: '.$max_width_index.';'.$margin_top_index.';" />';
                    }
                }
            }
        }
        $speaker_html .= '</div>';
        
        $event_modal = substr($event_modal, 3);
        $event_modal = substr($event_modal, 0, -3);
        $event_modal = str_replace("``", '"', $event_modal);
        $event_modal = str_replace("\n", '<br>', $event_modal);
        $event_modal = "[". $event_modal . "]";
        
        $modal_array = json_decode($event_modal, true);
        $modal_desc = false;

        foreach ($modal_array as $modal){
            if ($modal['desc']){
                $modal_desc = true;
            }
        }

        for($i=0; $i<count($modal_array); $i++){
            if($modal_array[$i]['id']){
                $image_src = '';
                $modal_lecturer_display = '';
                if($speaker_imgs[$i]){
                    $image_src = wp_get_attachment_image_src($speaker_imgs[$i], 'full');
                }

                if(!$speaker_imgs[$i] && !$modal_array[$i]['desc']){
                    $modal_lecturer_display = 'style="display:none;"';
                }
                $modal_html .= '<div class="lecturer" '.$modal_lecturer_display.'>';
                $modal_html .= '<div class="modal-image"><img class="alignleft" src="'.$image_src[0].'" style="'.$modal_img_size .'"><h3 style="'.$lect_color.'">'.$modal_array[$i]['id'].'</h3>';
            } else {
                $modal_html .= '<div class="modal-image">';
            }
            if($modal_array[$i]['desc']){
                $modal_html .= '<p>'.$modal_array[$i]['desc'].'</p></div></div>';
            } else {
                $modal_html .= '</div></div>';
            }
        }
        
        if($photo_box){
            $html .= '<div id="lecture-'.$rn.'" class="chevron-slide" style="min-height:280px; max-height: '.$info_box_max_height.' '.$shadow.' border:'.$border_width.' '.$border_style.' '.$border_color.'; '.$border_radius.'">
                    <div class="head-container">
                    ' . $speaker_html;
        
            if ($modal_desc){
                if (count($speaker_imgs) < 3){
                    $html .=
                            '<button class="lecturers-bio btn btn-sm btn-default lecture-btn" style="background-color:'.$bio_color.' !important; '.$bio_text.'">BIO</button>';
                } else {
                    $html .=
                            '<button class="lecturers-bio lecturers-triple btn btn-sm btn-default lecture-btn" style="background-color:'.$bio_color.' !important; '.$bio_text.'">BIO</button>';
                }
            }
            $html .= '</div>';
            $html .= '<div class="text-container" style="width: 75%;">';
        } else {
            $html .= '<div id="lecture-'.$rn.'" class="chevron-slide" style="'.$shadow.' border:'.$border_width.' '.$border_style.' '.$border_color.'; '.$border_radius.'">
                    <div class="text-container" style="width: 90%;">';
        }
        $display_speakers = str_replace('``', '"', $event_speaker);
        $display_speakers = str_replace(';', '<br>', $display_speakers);

        if($title_top != ''){
            $html .= '<h4 class="lectur-time">' . $event_time . '</h4>
                    <h3 class="inside-title" style="'.$title_size.'color:'.$title_color.';">' . $event_name . '</h3>
                    <h5 class="lecturer-name" style="color:'.$lect_color.';">'.$display_speakers.'</h5> ';
        } else {
            $html .= '<h4 class="lectur-time">' . $event_time . '</h4>
            <h5 class="lecturer-name" style="color:'.$lect_color.';">'.$display_speakers.'</h5> 
            <h3 class="inside-title" style="'.$title_size.'color:'.$title_color.';">' . $event_name . '</h3>';
        }

        if($event_desc != ''){        
            $html .='<div class="inside-text" style="max-height: 77px;"><p>' . $event_desc . '</p></div>
                        <p class="open-desc"><i class="text-accent-color fa fa-chevron-down fa-1x fa-fw"></i>';
                        if ($locale == 'pl_PL') {
                            $html .= 'Czytaj więcej';
                        } else {
                            $html .= 'Read more';
                        }
                        $html .= '<i class="text-accent-color fa fa-chevron-down fa-1x fa-fw"></i></p>';        
        }
        $html .='</div>
                <div id="info-modal" class="info-modal" style="display:none;">
                    <div class="info-modal-content">
                        '.$modal_html.'
                    </div>
                    <i class="fa fa-times-circle-o fa-2x fa-fw info-close"></i>
                </div>
            </div>
        </div>';
    } else {

        $simple_speakers = str_replace('``', '"', $event_speaker);
        $simple_speakers = str_replace(';', ' , ', $simple_speakers);
        
        $html .= '<div id="lecture-'.$rn.'" class="simple-lecture">
                    <h5 class="simple-lecture-hour">'.$event_time.'</h5>
                    <div class="simple-lecture-text">
                        <h5>'.$event_name.'</h5>
                        <p class="text-accent-color">'.$simple_speakers.'</p>
                    </div>
                </div>';
    }

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