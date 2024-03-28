<?php 
include_once plugin_dir_path(__FILE__) . '/../scripts/slider.php';
$mobile = preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT']);
if ($left_center_right_title == ''){
    $left_center_right_title = 'left';
}
?>

<style>
    .custom-container-logos-gallery {
        z-index: 1;
    }
    .custom-logos-gallery-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 18px;
    }
    .custom_element_<?php echo $rnd_id ?> .custom-logos-gallery-wrapper .custom-logo-item,
    .custom_element_<?php echo $rnd_id ?> .custom-logos-gallery-wrapper .custom-logo-item div,
    .custom_element_<?php echo $rnd_id ?> .custom-logos-gallery-wrapper .slides div {
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        <?php if ($min_width_logo != '' && $mobile != 1) { ?>
            min-width: <?php echo $min_width_logo ?> !important;
        <?php } else { ?>
            min-width: 140px;
        <?php } ?>
        height: fit-content;
        aspect-ratio: 3/2;
        margin: 5px;
    }
    .custom_element_<?php echo $rnd_id ?> .custom-logos-title {
        display: flex;
        justify-content:<?php echo $left_center_right_title ?>;
    }
    .custom-logos-title h4 {
        margin: 0;
    }
    .custom-full-width .custom_element_catalog_slider {
        overflow: visible !important;
    }
    .custom-white-logos div[style*="background-image"],
    .custom-header .custom-logos-gallery-wrapper div[style*="background-image"] {
        filter: brightness(0) invert(1);
        transition: all .3s ease;
    }
    .custom-white-logos div[style*="background-image"]:hover,
    .custom-header .custom-logos-gallery-wrapper div[style*="background-image"]:hover {
        filter: none;
    }
    .custom-color-logos div[style*="background-image"] {
        filter: none !important;
    }
    /* FOR HEADER */
    #page-header .custom-logos-gallery-wrapper{
        padding-bottom: 36px; 
    }
    #page-header .custom_element_<?php echo $rnd_id ?> .custom-logos-title {
        justify-content: center;
    }
    #page-header .custom-logos-title h4 {
        color: white;
    }
    .custom_element_<?php echo $rnd_id ?> .custom-header .custom-logos-title {
        justify-content: center;
    }
    .custom_element_<?php echo $rnd_id ?> .custom-header .custom-logos-title h4 {
        color: white;
    }
    
</style>

<?php
    if ($logoscatalog != '' || !empty($header_custom_logotypes)){
        $is_https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
        $domain = $_SERVER['HTTP_HOST'];
        $server_url = ($is_https ? 'https://' : 'http://') . $domain;

        $unique_id = rand(10000, 99999);
        $element_unique_id = 'customLogotypes-' . $unique_id;
        
        $header_custom_logotypes_urldecode = urldecode($header_custom_logotypes);
        $header_custom_logotypes_json = json_decode($header_custom_logotypes_urldecode, true);
        $header_logotypes_media_urls = [];
        foreach ($header_custom_logotypes_json as $logotypes_item) {
            if (isset($logotypes)) {
                $header_logotypes_url = $logotypes["logoscatalog"];
                $header_logotypes_title = $logotypes["titlecatalog"];
                $header_logotypes_width = $logotypes["logotypes_width"];
                $header_logotypes_media = $logotypes["logotypes_media"];
                $header_logotypes_slider_off = $logotypes["logotypes_slider_off"];
                $header_logotypes_items_width = $logotypes["logotypes_items_width"];
            } else {
                $header_logotypes_url = $logotypes_item["logoscatalog"];
                $header_logotypes_title = $logotypes_item["titlecatalog"];
                $header_logotypes_width = $logotypes_item["logotypes_width"];
                $header_logotypes_media = $logotypes_item["logotypes_media"];
                $header_logotypes_slider_off = $logotypes_item["logotypes_slider_off"];
                $header_logotypes_items_width = $logotypes_item["logotypes_items_width"];
            }   
            $header_logotypes_media_ids = explode(',', $header_logotypes_media);  
        }

        foreach ($header_logotypes_media_ids as $id) {
            $url = wp_get_attachment_url($id); 
            if ($url) {
                $header_logotypes_media_urls[] = $url;
            }
        }

        $pattern = '/``id``:``(.*?)``,``url``:``(.*?)``/';
        // Wyszukaj dopasowania i zapisz wyniki w tablicy $ dopasowań
        preg_match_all($pattern, $logo_url, $matches);

        $ids = $matches[1];
        $url_values = $matches[2];

        if(!empty($header_custom_logotypes)) {
            $logoscatalog = $header_logotypes_url;
            $titlecatalog = $header_logotypes_title;
        }

        if ($logoscatalog == "partnerzy obiektu") {
            $files = glob($_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/custom-element/media/partnerzy-obiektu/*.{jpeg,jpg,png,webp,JPEG,JPG,PNG,WEBP}', GLOB_BRACE);
        } else if ($logoscatalog == "" && $header_logotypes_media_urls !== "") {
            $files = $header_logotypes_media_urls;
        } else {
            $files = glob($_SERVER['DOCUMENT_ROOT'] . '/doc/' . $logoscatalog . '/*.{jpeg,jpg,png,webp,JPEG,JPG,PNG,WEBP}', GLOB_BRACE);  
        } 

        if (count($files) > 0) {

            if ($color != ''){
                echo '<style>
                        .custom_element_'.$rnd_id.' .custom-logos-title span{
                            color: '. $color .' !important;
                        }
                        .custom_element_'.$rnd_id.' .custom-logos-title h4 {
                            box-shadow: 9px 9px 0px -6px '. $color .' !important;
                        }
                    </style>';
            } 

            if ($header_logotypes_width . '%' !== '%') {
                if ($header_logotypes_width >= 70 && $header_logotypes_width < 100) {
                    $header_logotypes_width  -= 3;
                } else if ($header_logotypes_width >= 50 && $header_logotypes_width < 70) {
                    $header_logotypes_width  -= 2;
                } else if ($header_logotypes_width >= 30 && $header_logotypes_width < 50) {
                    $header_logotypes_width  -= 1;
                } 
                echo'<style>
                    #'.$element_unique_id .' {
                        width: '.$header_logotypes_width.'%;
                </style>'; 
            }
    
            $output = '<div id="'.$element_unique_id.'" class="custom-container-logos-gallery">
                        <div class="custom-logos-title main-heading-text">
                            <h4 class="custom-uppercase"><span>'. $titlecatalog .'</span></h4>
                        </div>
                        <div class="custom-logos-gallery-wrapper';
                        if ($slider_logo_white == "true") {
                            $output .= ' custom-white-logos';
                        }
                        if ($slider_logo_color == "true") {
                            $output .= ' custom-color-logos';
                        }
                        if (isset($slider_full_width_on) && $slider_full_width_on == "true") {
                            $output .= ' custom-full-width';
                        }
                        $output .= '">';
                                
                            $images_url = array();
                            $urls_custom = array();
                            $urls_old = array();
    
                            foreach ($files as $index => $file) {
                                $short_path = '';
                                
                                if ($logoscatalog == "partnerzy obiektu") {
                                    $short_path = substr($file, strpos($file, '/wp-content/'));
                                } else {
                                    $short_path = substr($file, strpos($file, '/doc/'));
                                }
                                $file_name = pathinfo($file, PATHINFO_FILENAME);
                                $file_base_name = pathinfo($file, PATHINFO_BASENAME);

                                // Szukanie indeksu dopasowania „id” w tablicy $ids
                                $idIndex = array_search(strtolower($file_base_name), array_map('strtolower', $ids));
                                if ($idIndex !== false) {
                                    $urls_old[] = $url_values[$idIndex];
                                } else {
                                    $urls_old[] = '';
                                }

                                if ($header_logotypes_media_urls !== '') {
                                    $full_path = $short_path;
                                } else {
                                    $full_path = $server_url . $short_path;
                                }
                  
                                $images_url[] = $full_path;
                            }
                            
                            //<--------------->
                            $logotypes_files_urldecode = urldecode($logotypes_files);
                            $logotypes_files_json = json_decode($logotypes_files_urldecode, true);

                            $logotype_filename_array = array();
                            $logotype_link_array = array();

                            foreach ($logotypes_files_json as $logotype) {
                                $logotype_filename_array[] = $logotype["logotype_filename"];
                                $logotype_link_array[] = $logotype["logotype_link"];  
                                $logotype_class_array[] = $logotype["logotype_color"]; 
                                $logotype_style_array[] = $logotype["logotype_style"];
                            }
                            
                            $logotypes_files_json_encode = json_encode($logotypes_files_json);
                            //<--------------->

                            $updated_images_url = array();

                            foreach ($images_url as $image) {
                                // Resetowanie zmiennych na początku każdej iteracji
                                $new_site = '';
                                $class = '';
                                $style = '';
    
                                // Pobranie aktualnej wartości z $urls_old
                                $old_site = current($urls_old);
                                // Przesunięcie wskaźnika do następnej wartości w $urls_old
                                array_shift($urls_old);

                                foreach ($logotypes_files_json as $logotype) {
                                    if (strpos($image, $logotype["logotype_filename"]) !== false) {
                                        $new_site = $logotype["logotype_link"];
                                        $class = ($logotype["logotype_color"] === "true") ? 'custom-logo-original' : '';
                                        $style = ($logotype["logotype_style"] === "") ? '' : $logotype["logotype_style"];
                                        break;
                                    }  
                                }

                                $site = (!empty($new_site)) ? $new_site : $old_site;
                                if (!empty($site) && !preg_match("~^(?:f|ht)tps?://~i", $site)) {
                                    $site = "https://" . $site;
                                }     

                                $updated_images_url[] = array(
                                    "img"   => $image,
                                    "site"  => $site,
                                    "class" => $class,
                                    "style" => $style
                                );
                            }

                            if ($mobile == 1 && count($updated_images_url) > 0) {

                                if ($grid_mobile == true) {
                                    foreach ($updated_images_url as $url) {
                                        if ($header_logotypes_items_width != '' && $mobile != 1) {
                                            $logotypes_items_width = 'min-width:'. $header_logotypes_items_width .';';
                                        } else {
                                            $logotypes_items_width = 'min-width: 140px;';
                                        }
                                        if (!empty($image)) {
                                            if (!empty($url["site"])) {
                                                $output .= '<a target="_blank" href="'. $url["site"] .'"><div class="custom-logo-item '. $url["class"] .'" style="background-image: url(\'' . $url["img"] . '\'); '. $url["style"] .' '. $logotypes_items_width .'"></div></a>';
                                            } else  {
                                                $output .= '<div class="custom-logo-item '. $url["class"] .'" style="background-image: url(\'' . $url["img"] . '\'); '. $url["style"] .' '. $logotypes_items_width .'"></div>';
                                            }
                                        }   
                                    }
                                } else {
                                    if (count($updated_images_url) <= 2) {
                                        foreach ($updated_images_url as $url) {
                                            if ($header_logotypes_items_width != '' && $mobile != 1) {
                                                $logotypes_items_width = 'min-width:'. $header_logotypes_items_width .';';
                                            } else {
                                                $logotypes_items_width = 'min-width: 140px;';
                                            }
                                            if (!empty($image)) {
                                                if (!empty($url["site"])) {
                                                    $output .= '<a target="_blank" href="'. $url["site"] .'"><div class="custom-logo-item '. $url["class"] .'" style="background-image: url(\'' . $url["img"] . '\'); '. $url["style"] .' '. $logotypes_items_width .'"></div></a>';
                                                } else {
                                                    $output .= '<div class="custom-logo-item '. $url["class"] .'" style="background-image: url(\'' . $url["img"] . '\'); '. $url["style"] .' '. $logotypes_items_width .'"></div>';
                                                }
                                            }   
                                        }
                                    } else {
                                        if ($header_logotypes_slider_off !== 'true') {
                                            $output .= custom_media_slider($updated_images_url);
                                        } else {
                                            foreach ($updated_images_url as $url) {
                                                if ($header_logotypes_items_width != '' && $mobile != 1) {
                                                    $logotypes_items_width = 'min-width:'. $header_logotypes_items_width .';';
                                                } else {
                                                    $logotypes_items_width = 'min-width: 140px;';
                                                }
                                                if (!empty($image)) {
                                                    if (!empty($url["site"])) {
                                                        $output .= '<a target="_blank" href="'. $url["site"] .'"><div class="custom-logo-item '. $url["class"] .'" style="background-image: url(\'' . $url["img"] . '\'); '. $url["style"] .' '. $logotypes_items_width .'"></div></a>';
                                                    } else {
                                                        $output .= '<div class="custom-logo-item '. $url["class"] .'" style="background-image: url(\'' . $url["img"] . '\'); '. $url["style"] .' '. $logotypes_items_width .'"></div>';
                                                    }
                                                }   
                                            }
                                        }
                                    }
                                }  
                                
                            } else if (($mobile != 1 && count($updated_images_url) > 0)) {
                                if ($slider_desktop == true) {
                                    $output .= custom_media_slider($updated_images_url);
                                } else {
                                    foreach ($updated_images_url as $url) {
                                        if ($header_logotypes_items_width != '' && $mobile != 1) {
                                            $logotypes_items_width = 'min-width:'. $header_logotypes_items_width .';';
                                        } else {
                                            $logotypes_items_width = 'min-width: 140px;';
                                        }
                                        if (!empty($image)) {
                                            if (!empty($url["site"])) {
                                                $output .= '<a target="_blank" href="'. $url["site"] .'"><div class="custom-logo-item '. $url["class"] .'" style="background-image: url(\'' . $url["img"] . '\'); '. $url["style"] .' '. $logotypes_items_width .'"></div></a>';
                                            } else {
                                                $output .= '<div class="custom-logo-item '. $url["class"] .'" style="background-image: url(\'' . $url["img"] . '\'); '. $url["style"] .' '. $logotypes_items_width .'"></div>';
                                            }
                                        }   
                                    }
                                }
                            }
                            
                $output .= '</div>
            </div>';
    
            echo $output;
        }
    }
?>

<?php if (isset($element_unique_id) && $logoscatalog != "") {?>
    
<script>

    // Hide container if slider length = 0 (wydarzenia-ogolne.php)
    if(<?php echo count($files) ?> < 1) {
        if(document.querySelector('.media-logos')){
            document.querySelector('.media-logos').style.display = "none";
        }
    }

</script>

<?php } ?>

