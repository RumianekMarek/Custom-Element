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
                'heading' => __('Custom Id', 'my-custom-plugin'),
                'param_name' => 'lecture_id',
                'description' => __('Custom ID will by added to main lecture ID.', 'my-custom-plugin'),
                'admin_label' => true,
            ),
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
                'heading' => __('Title', 'my-custom-plugin'),
                'param_name' => 'event_title',
                'save_always' => true,
                'admin_label' => true
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
                'type' => 'textarea_html',
                'group' => 'main',
                'heading' => __('Description', 'my-custom-plugin'),
                'param_name' => 'content',
                'description' => __('Put event description.', 'my-custom-plugin'),
                'save_always' => true,
            ),
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
        'event_title' => '',
        'border_radius' => '',
        'border_style' => '',
        'border_color' => '',
        'lect_color' => '',
        'bio_color' => '',
        'title_color' => '',
        'shadow' => '',
        'photo_box' => '',
        'photo_squer' => '',
        'title_top' => '',
    ), $atts ) );

        $locale = get_locale();

        $lecture_id = !empty($atts['lecture_id']) ? $atts['lecture_id'] : $rn;

        $speakers = urldecode($atts['speakers']);
        $speakers = json_decode($speakers);
        /* Old data transformation to new */
        $event_title = !empty($event_title) ? $event_title : $atts['event_name'];
        
        if(empty($speakers)){
            $old_names = explode(';',$atts['event_speaker']);
            $old_images = explode(',',$atts['event_images']);
            $old_modal = substr($atts['event_modal'], 3);
            $old_modal = substr($old_modal, 0, -3);
            $old_modal = str_replace("``", '"', $old_modal);
            $old_modal = str_replace("\n", '<br>', $old_modal);
            $old_modal = "[". $old_modal . "]";
            
            $old_array = json_decode($old_modal, true);
            for ($i = 0; $i < count($old_names); $i++) {
                $speakers[] = [
                    "speaker_image" => $old_images[$i],
                    "speaker_name" => $old_names[$i],
                    "speaker_bio" => isset($old_array[$i]['desc']) ? $old_array[$i]['desc'] : '',
                ];
            }
        } else {
            $speakers_names = array();
            $speakers_images = array();
            $speakers_bios = array();
        }


        /* End of old data */
        $event_desc = !empty($content) ? nl2br($content) : $atts['event_desc'];
        $border_radius = ($atts['border_radius']) ? 'border-radius: '.$atts['border_radius'].';': '';
        $border_width = !empty($atts['border_width']) ? $atts['border_width'] : '0';
        $border_style = !empty($atts['border_style']) ? $atts['border_style'] : 'solid';
        $border_color = !empty($atts['border_color']) ? $atts['border_color'] : '#000000';
        $lect_color = !empty($atts['lect_color']) ? 'color: '.$atts['lect_color'].';' : 'color: #000000;';
        $bio_color = !empty($atts['bio_color']) ? $atts['bio_color'] : '#000000';
        $title_color = !empty($atts['title_color']) ? $atts['title_color'] : '#000000';
        $shadow = !empty($atts['shadow']) ? 'box-shadow: 4px 4px 7px 2px;' : '';
        $photo_box = !empty($atts['photo_box']) ? $atts['photo_box'] : '';
        $modal_img_size = !empty($atts['modal_img_size']) ? 'width: '.$atts['modal_img_size'].';' : 'width: 120px;';
        $bio_text = !empty($atts['bio_text']) ? 'color: '.$atts['bio_text'].'!important;' : '';
        $title_size = !empty($atts['title_size']) ? ' font-size: '.$atts['title_size'].'!important; ' : '';
        
        
        $event_title = str_replace('``','"', $event_title);
        $event_time = str_replace('``','"', $event_time);
        $event_desc = str_replace('<script>','', $event_desc);

        $uncode_options = get_option('uncode');

        $css_file = plugins_url('display-info.css', __FILE__);
        $css_version = filemtime(plugin_dir_url( __FILE__ ) . 'display-info.css');
        wp_enqueue_style('info_box-css', $css_file, array(), $css_version);

        $js_file = plugins_url('display-info.js', __FILE__);
        $js_version = filemtime(plugin_dir_url(__FILE__) . 'display-info.js');
        wp_enqueue_script('info_box-js', $js_file, array('jquery'), $js_version, true);
        wp_localize_script('info_box-js', 'inner' , $atts);
        
        foreach($speakers as $speaker){
            foreach($speaker as $id => $key){
                if($id == 'speaker_name'){
                    $speakers_names[] = $key;
                }
                if($id == 'speaker_image'){
                    $speakers_images[] = $key;
                }
                if($id == 'speaker_bio'){
                    $speakers_bios[] = $key;
                }
            }
        }

        if (!$simple_mode){
        
        $modal_html = '<div class="modal-lecturers">';
        if (empty($speakers_images[0])){
            $speaker_html = '<div class="speakers"></div>';
        } else {
            $speaker_html = '<div class="speakers-img">';
            $haed_images = array_filter($speakers_images);
            $haed_images = array_values($haed_images);
            
            for ($i = 0; $i < count($haed_images); $i++) {            
                if (isset($haed_images[$i])) {
                    $image_src = wp_get_attachment_image_src($haed_images[$i], 'full');

                    
                    if ($image_src) {
                        if (!$photo_squer){
                            $b_radius = 'border-radius: 50%;';
                        }
                        $z_index = (1 + $i);
                        $margin_top_index = '';
                        
                        switch (count($haed_images)) {
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
                                        $top_index = "-30px";
                                        $left_index = "10px";
                                        break;
                        
                                    case 1:
                                        $max_width_index = "50%";
                                        $top_index = "-10px";
                                        $left_index = "-10px";
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
                            case 4:
                                switch ($i) {
                                    case 0:
                                        $max_width_index = "35%";
                                        break;
                        
                                    case 1:
                                        $max_width_index = "35%";
                                        $left_index = "-10px";
                                        break;
                        
                                    case 2:
                                        $max_width_index = "35%";
                                        $top_index = "-15px";
                                        $left_index = "0";
                                        break;
                                    case 3:
                                        $max_width_index = "35%";
                                        $top_index = "-15px";
                                        $left_index = "-10px";
                                        break;
                                }
                                break;
                            default:
                                switch ($i) {
                                    case 0:
                                        $margin_top_index = 'margin-top: 5px !important;';
                                        $max_width_index = "35%";
                                        break;
                        
                                    case 1:
                                        $max_width_index = "35%";
                                        $left_index = "-10px";
                                        break;
                        
                                    case 2:
                                        $max_width_index = "35%";
                                        $top_index = "-15px";
                                        $left_index = "0";
                                        break;
                                    case 4:
                                        $max_width_index = "35%";
                                        $top_index = "-30px";
                                        $left_index = "0";
                                        break;
                                    case 6:
                                        $max_width_index = "35%";
                                        $top_index = "-45px";
                                        $left_index = "0";
                                        break;
                                    case 8:
                                        $max_width_index = "35%";
                                        $top_index = "-60px";
                                        $left_index = "0";
                                        break;
                                    case 10:
                                        $max_width_index = "35%";
                                        $top_index = "-75px";
                                        $left_index = "0";
                                        break;

                                    case 3:
                                        $max_width_index = "35%";
                                        $top_index = "-15px";
                                        $left_index = "-10px";
                                        break;
                                    case 5:
                                        $max_width_index = "35%";
                                        $top_index = "-30px";
                                        $left_index = "-10px";
                                        break;
                                    case 7:
                                        $max_width_index = "35%";
                                        $top_index = "-45px";
                                        $left_index = "-10px";
                                        break;
                                    case 9:
                                        $max_width_index = "35%";
                                        $top_index = "-60px";
                                        $left_index = "-10px";
                                        break;
                                    case 11:
                                        $max_width_index = "35%";
                                        $top_index = "-75px";
                                        $left_index = "-10px";
                                        break;
                                }
                                break;
                        }
                        
                        $speaker_html .= '<img class="speaker" src="' . esc_url($image_src[0]) . '" alt="'.$speakers_names[$i].'-'.$i.' portrait" style="position:relative; '.$b_radius.' z-index:'.$z_index.'; top:'.$top_index.'; left:'.$left_index.'; max-width: '.$max_width_index.';'.$margin_top_index.';" />';
                    }
                }
            }
            $speaker_html .= '</div>';
        }
        if($photo_box){
            foreach($speakers_bios as $id => $bio){
                if(!empty($bio)){
                    $modal_desc = true;
                    $modal_lecturer_display = '';
                    $modal_html .= '<div class="lecturer" '.$modal_lecturer_display.'><div class="modal-image">';

                    if(!empty($speakers_images[$id])){
                        $image_src = wp_get_attachment_image_src($speakers_images[$id], 'full');
                        $modal_html .= '<img class="alignleft" src="'.$image_src[0].'" style="'.$modal_img_size.'">';
                    }

                    $modal_html .= '<h3 style="'.$lect_color.'">'.$speakers_names[$id].'</h3>';
                    $modal_html .= '<p style="text-align: unset; margin-left:18px;">'.$bio.'</p>';
                    $modal_html .= '</div></div>';
                }
            }


            $html .= '<div id="lecture-'.$lecture_id.'" class="chevron-slide" style="min-height:280px; '.$shadow.' border:'.$border_width.' '.$border_style.' '.$border_color.'; '.$border_radius.'">
                    <div class="head-container">
                    ' . $speaker_html;
        
            if ($modal_desc){
                if (count($speakers_images) < 3){
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
            $html .= '<div id="lecture-'.$lecture_id.'" class="chevron-slide" style="'.$shadow.' border:'.$border_width.' '.$border_style.' '.$border_color.'; '.$border_radius.'">
                    <div class="text-container" style="width: 90%;">';
        }
        $display_speakers = implode(', ', $speakers_names);

        if($title_top != ''){
            $html .= '<h4 class="lectur-time">' . $event_time . '</h4>
                    <h3 class="inside-title" style="'.$title_size.'color:'.$title_color.';">' . $event_title . '</h3>
                    <h5 class="lecturer-name" style="'.$lect_color.'">'.$display_speakers.'</h5> ';
        } else {
            $html .= '<h4 class="lectur-time">' . $event_time . '</h4>
            <h5 class="lecturer-name" style="'.$lect_color.'">'.$display_speakers.'</h5> 
            <h3 class="inside-title" style="'.$title_size.'color:'.$title_color.';">' . $event_title . '</h3>';
        }

        if($event_desc != ''){
            $html .='<div class="inside-text" style="max-height: 120px;"><p>' . $event_desc . '</p></div>
                        <p class="open-desc" ><i class="text-accent-color fa fa-chevron-down fa-1x fa-fw"></i>';
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

        $simple_speakers = implode(', ', $speakers_names);
        
        $html .= '<div id="lecture-'.$lecture_id.'" class="simple-lecture">
                    <h5 class="simple-lecture-hour">'.$event_time.'</h5>
                    <div class="simple-lecture-text">
                        <h5>'.$event_title.'</h5>
                        <p class="text-accent-color">'.$simple_speakers.'</p>
                    </div>
                </div>';
    }

    return $html;
}

add_action('vc_before_init', 'info_box');
add_shortcode('info_box', 'info_box_output');

?>