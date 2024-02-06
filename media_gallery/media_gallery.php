<?php
function media_gallery() {
    vc_map(array(
        'name' => __('Media Gallery', 'my-custom-plugin'),
        'base' => 'media_gallery',
        'category' => __('My Elements', 'my-custom-plugin'),
        'params' => array(
            array(
                'type' => 'textfield',
                'group' => 'Main',
                'heading' => __('Custom id', 'my-custom-plugin'),
                'param_name' => 'custom_gallery_id',
                'description' => __('Set custom id for gallery not to have same id with other gallerys.', 'my-custom-plugin'),
                'save_always' => true,
            ),
            array(
                'type' => 'textfield',
                'group' => 'Main',
                'heading' => __('Gallery name', 'my-custom-plugin'),
                'param_name' => 'custom_gallery_name',
                'description' => __('Set a name that will by displayed at the top of gallery', 'my-custom-plugin'),
                'save_always' => true,
            ),
            array(
                'type' => 'textfield',
                'group' => 'Main',
                'heading' => __('URL to gallery', 'my-custom-plugin'),
                'param_name' => 'custom_gallery_url',
                'description' => __('Set url to gallery in /doc/', 'my-custom-plugin'),
                'save_always' => true,
            ),
            array(
                'type' => 'attach_images',
                'group' => 'Main',
                'heading' => __('Select Images', 'my-custom-plugin'),
                'param_name' => 'custom_gallery_images',
                'description' => __('Choose images from the media library.', 'my-custom-plugin'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'custom_gallery_url',
                    'value' => array(''),
                ),
            ),
            array(
                'type' => 'dropdown',
                'group' => 'Main',
                'heading' => __('When clicked', 'my-custom-plugin'),
                'param_name' => 'custom_image_clicked',
                'description' => __('Chose what happend after click on image', 'my-custom-plugin'),
                'save_always' => true,
                'value' => array(
                    'Full view' => 'Full',
                    'Linked' => 'Linked',
                    'Nothing' => 'Nothing',
                ),
            ),
            array(
                'type' => 'dropdown',
                'group' => 'Options',
                'heading' => __('Gallery disply', 'my-custom-plugin'),
                'param_name' => 'custom_image_gride',
                'description' => __('Set an grid for pictures', 'my-custom-plugin'),
                'value' => array(
                    'Justify' => 'flex',
                ),
            ),
            array(
                'type' => 'textfield',
                'group' => 'Options',
                'heading' => __('Image Width', 'my-custom-plugin'),
                'param_name' => 'custom_image_width',
                'description' => __('Chose width for all images', 'my-custom-plugin'),
                'save_always' => true,
            ),
            array(
                'type' => 'textfield',
                'group' => 'Options',
                'heading' => __('Inner Gap', 'my-custom-plugin'),
                'param_name' => 'custom_image_gap',
                'description' => __('Chose gap between pictures - verticale', 'my-custom-plugin'),
                'save_always' => true,
            ),
            array(
                'type' => 'textfield',
                'group' => 'Options',
                'heading' => __('Row Gap', 'my-custom-plugin'),
                'param_name' => 'custom_image_row_margin',
                'description' => __('Chose gap between rows', 'my-custom-plugin'),
                'save_always' => true,
            ),
            array(
                'type' => 'dropdown',
                'group' => 'Options',
                'heading' => __('Chose aspect ratio', 'my-custom-plugin'),
                'param_name' => 'custom_image_ratio',
                'description' => __('Set an aspect ratio for images', 'my-custom-plugin'),
                'value' => array(
                    'default' => '',
                    '1/1' => '1:1',
                    '2/1' => '2:1',
                    '3/2' => '3:2',
                    '4/3' => '4:3',
                    '5/4' => '5:4',
                    '10/3' => '10:3',
                    '16/9' => '16:9',
                    '1/2' => '1:2',
                    '2/3' => '2:3',
                    '3/4' => '3:4',
                    '4/5' => '4:5',
                    '3/0' => '3:10',
                    '9/6' => '9:16',
                ),
            ),
            array(
                'type' => 'dropdown',
                'group' => 'Options',
                'heading' => __('Chose vertical align', 'my-custom-plugin'),
                'param_name' => 'custom_image_align',
                'description' => __('Set an vertical alignen for pictures', 'my-custom-plugin'),
                'value' => array(
                    'Justify' => 'space-evenly',
                    'Left' => 'flex-start',
                    'Center' => 'center',
                    'Right' => 'flex-end',
                ),
            ),
            array(
                'type' => 'dropdown',
                'group' => 'Options',
                'heading' => __('Content to Show Option', 'my-custom-plugin'),
                'param_name' => 'custom_image_stratch',
                'description' => __('Set: Full to see full picture in container, Midel to strech the picture in container', 'my-custom-plugin'),
                'value' => array(
                    'Full' => 'max-height:100% !important;',
                    'Middle' => 'middle',
                ),
            ),
            array(
                'type' => 'textarea',
                'group' => 'Linki',
                'heading' => __('Links', 'my-custom-plugin'),
                'param_name' => 'custom_image_links',
                'description' => __('Links for pictures', 'my-custom-plugin'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'custom_image_clicked',
                    'value' => array('Linked')
                ),
            ),
        ),
    ));
}

function media_gallery_output($atts, $content = null){
    extract( shortcode_atts( array(
        'custom_gallery_id' => '',
        'custom_gallery_name' => '',
        'custom_image_gride' => '',
        'custom_image_stratch' => '',
        'custom_image_clicked' => '',
        'custom_image_links' => '',
    ), $atts ) );

    $custom_gallery_images = array();

    if(!empty($atts['custom_gallery_url'])){
        $folder_path = ABSPATH . 'doc/' . $atts['custom_gallery_url'];

        if (is_dir($folder_path)) {
            $files = scandir($folder_path);
            $allowed_extensions = array('png', 'jpg', 'jpeg', 'gif', 'webp');

            $custom_gallery = array_filter($files, function($files) use ($allowed_extensions) {
                $extension = pathinfo($files, PATHINFO_EXTENSION);
                return in_array(strtolower($extension), $allowed_extensions);
            });
        }

        foreach($custom_gallery as $key){
            $key_array = array(
                'url' => '/doc/' . $atts['custom_gallery_url'] . '/' . $key,
                'alt' => pathinfo($key, PATHINFO_FILENAME),
            );
            $custom_gallery_images[] = $key_array;
        }
    } else {
        $custom_gallery = explode(',',$atts['custom_gallery_images']);
        foreach($custom_gallery as $image) {
            $image_data = array(
                'url' => wp_get_attachment_image_src($image, 'full')[0],
                'alt' => get_post_meta($image, '_wp_attachment_image_alt', true)
            );
            $custom_gallery_images[] = $image_data;
        }
    }

    $custom_gallery_id = ($atts['custom_gallery_id']) ? $atts['custom_gallery_id'] : 'gallery-'.rand(10000, 99999);

    $custom_image_width = ($atts['custom_image_width']) ? 'width:'.$atts['custom_image_width'].';' : 'width:200px;';

    $custom_image_lr_padding = ($atts['custom_image_lr_padding']) ? 'margin-left:'.$atts['custom_image_lr_padding'].'!important; margin-right:'.$atts['custom_image_lr_padding'].'!important;' : '';
    $custom_image_align = ($atts['custom_image_align']) ? $atts['custom_image_align'] : 'center';
    $custom_image_gap = ($atts['custom_image_gap']) ? $atts['custom_image_gap'] : '18px';
    $custom_image_ratio = ($atts['custom_image_ratio']) ? $atts['custom_image_ratio']: '3:2';

    if($custom_image_ratio != ''){
        $ratio = explode(':', $custom_image_ratio);
        $width_index = preg_replace('/[^0-9]/', '', $custom_image_width);
        $custom_image_ratio = 'height:'.($width_index*($ratio[1]/$ratio[0])).'px; '.$custom_image_width;
    }
    
    if($custom_image_gride === 'flex' ||  $custom_image_gride === ''){
        $custom_image_gride = 'display:flex; flex-wrap: wrap; justify-content: '.$custom_image_align.'; align-items: center; gap:' . $custom_image_gap .';';
    }

    $html_gallery = '<div id="'.$custom_gallery_id.'">
                        <div class="heading-text el-text main-heading-text text-centered">
                            <h2>'.$custom_gallery_name.'</h2>
                        </div>
                        <div class="custom-gallery-container" style="'.$custom_image_gride.' margin: 18px;">';
    $image_src_array = [];

    var_dump($custom_image_links);
    foreach($custom_gallery_images as $key => $image){
        var_dump($key);
        $html_gallery .=     '<div class="custom_gallery_image_container" style="position:relative; overflow:hidden; '.$custom_image_lr_padding.' '.$custom_image_row_margin.' '.$custom_image_ratio.'">';

        if($custom_image_clicked === 'Link') {
            $html_gallery .= '<a href="">';
        } 
        $html_gallery .=    '<img class="custom-image-gallery-picture" src="'.$image['url'].'" alt="'.$image['alt'].'" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">';

        if($custom_image_clicked === 'Link') {
            $html_gallery .= '</a>';
        } 
        $html_gallery .='</div>';
    }
    $html_gallery .=    '</div>';
    if($custom_image_clicked === 'Full'){
        $html_gallery .=    '<div id="custom-media-gallery-modal" class="custom-media-gallery-modal" style="display:none;">
                                <div class="custom-media-gallery-modal-content">
                                    <img class="modal-last-image modal-image-arrow" src="/wp-content/plugins/custom-element/media_gallery/arrow-left.jpg" alt="last-picture"/>
                                    <img class="modal-image-gallery-picture" src="" alt="big-picture"/>
                                    <img class="modal-next-image modal-image-arrow" src="/wp-content/plugins/custom-element/media_gallery/arrow-right.jpg" alt="next-picture"/>
                                </div>
                            </div>';
    }
    $html_gallery .='</div>';
    echo '<script>console.log("'.$custom_image_clicked.'")</script>';
    
    $js_export = array(
        'gallery' => $image_src_array,
        'view' => $custom_image_clicked
    );
    
    $css_file = plugins_url('media_gallery.css', __FILE__);
    $css_version = filemtime(plugin_dir_url( __FILE__ ) . 'media_gallery.css');
    wp_enqueue_style('media_gallery-css', $css_file, array(), $css_version);

    $js_file = plugins_url('media_gallery.js', __FILE__);
    $js_version = filemtime(plugin_dir_url(__FILE__) . 'media_gallery.js');
    wp_enqueue_script('media_gallery-js', $js_file, array('jquery'), $js_version, true);
    wp_localize_script('media_gallery-js', 'js_gallery_export' , $js_export);

    return $html_gallery;
}

function backend_madia_gallery() {
    $css_file = plugins_url('media_gallery_backend.css', __FILE__);
    $css_version = filemtime(plugin_dir_url( __FILE__ ) . 'media_gallery_backend.css');
    wp_enqueue_style('media_gallery_backend-css', $css_file, array(), $css_version);

    $js_file = plugins_url('media_gallery_backend.js', __FILE__);
    $js_version = filemtime(plugin_dir_url(__FILE__) . 'media_gallery_backend.js');
    wp_enqueue_script('media_gallery_backend-js', $js_file, array('jquery'), $js_version, true);
}
add_action('admin_enqueue_scripts', 'backend_madia_gallery');

add_action('vc_before_init', 'media_gallery');
add_shortcode('media_gallery', 'media_gallery_output');
?>