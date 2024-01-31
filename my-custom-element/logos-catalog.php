<?php 
if ($left_center_right_title == ''){
    $left_center_right_title = 'left';
}
if ($min_width_logo == ''){
    $min_width_logo = '140px';
}
?>

<style>

    .custom-logos-gallery-wrapper {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
    }
    .custom_element_<?php echo $rnd_id ?> .custom-logos-gallery-wrapper .custom-logo-item,
    .custom_element_<?php echo $rnd_id ?> .custom-logos-gallery-wrapper .custom-logo-item div,
    .custom_element_<?php echo $rnd_id ?> .custom-logos-gallery-wrapper .slides div {
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        min-height: 120px;
        min-width: <?php echo $min_width_logo ?>;
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

    .custom-white-logos div[style*="background-image"] {
        filter: brightness(0) invert(1);
        transition: all .3s ease;
    }
    .custom-white-logos div[style*="background-image"]:hover {
        filter: none;
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

</style>


<?php
    if ($logoscatalog != ''){
    
        $is_https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
        $domain = $_SERVER['HTTP_HOST'];
        $server_url = ($is_https ? 'https://' : 'http://') . $domain;
        $mobile = preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT']);

        $unique_id = rand(10000, 99999);
        $element_unique_id = 'customLogotypes-' . $unique_id;

        $pattern = '/``id``:``(.*?)``,``url``:``(.*?)``/';
        // Wyszukaj dopasowania i zapisz wyniki w tablicy $ dopasowań
        preg_match_all($pattern, $logo_url, $matches);

        $ids = $matches[1];
        $url_values = $matches[2];

        if ($logoscatalog == "partnerzy obiektu") {
            $files = glob($_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/custom-element/media/partnerzy-obiektu/*.{jpeg,jpg,png,webp,JPEG,JPG,PNG,WEBP}', GLOB_BRACE);
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
    
            $output = '<div id="'.$element_unique_id.'" class="custom-container-logos-gallery">
                        <div class="custom-logos-title main-heading-text">
                            <h4 class="custom-uppercase"><span>'. $titlecatalog .'</span></h4>
                        </div>
                        <div class="custom-logos-gallery-wrapper single-top-padding';
                        if ($slider_logo_white == "true") {
                            $output .= ' custom-white-logos';
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
                                $full_path = $server_url . $short_path;  
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
                            }

                            $logotypes_files_json_encode = json_encode($logotypes_files_json);
                            //<--------------->

                            $updated_images_url = array();

                            foreach ($images_url as $image) {
                                // Pobranie aktualnej wartości z $urls_old
                                $old_site = current($urls_old);
                                // Przesunięcie wskaźnika do następnej wartości w $urls_old
                                array_shift($urls_old);

                                $new_site = "";
                                foreach ($logotypes_files_json as $logotype) {
                                    if (strpos($image, $logotype["logotype_filename"]) !== false) {
                                        $new_site = $logotype["logotype_link"];
                                        break;
                                    }
                                }

                                $site = (!empty($new_site)) ? $new_site : $old_site;
                                if (!empty($site) && !preg_match("~^(?:f|ht)tps?://~i", $site)) {
                                    $site = "https://" . $site;
                                }      

                                $updated_images_url[] = array(
                                    "img" => $image,
                                    "site" => $site
                                );
                            }

                            if ($mobile == 1 && count($updated_images_url) > 0) {
                                if ($grid_mobile == true) {
                                    foreach ($updated_images_url as $url) {
                                        if (!empty($image)) {
                                            if (!empty($url["site"])) {
                                                $output .= '<a target="_blank" href="'. $url["site"] .'"><div class="custom-logo-item" style="background-image: url(\'' . $url["img"] . '\');"></div></a>';
                                            } else if (empty($url["site"])) {
                                                $output .= '<div class="custom-logo-item" style="background-image: url(\'' . $url["img"] . '\');"></div>';
                                            }
                                        }   
                                    }
                                } else {
                                    if (count($updated_images_url) <= 2) {
                                        foreach ($updated_images_url as $url) {
                                            if (!empty($image)) {
                                                if (!empty($url["site"])) {
                                                    $output .= '<a target="_blank" href="'. $url["site"] .'"><div class="custom-logo-item" style="background-image: url(\'' . $url["img"] . '\');"></div></a>';
                                                } else if (empty($url["site"])) {
                                                    $output .= '<div class="custom-logo-item" style="background-image: url(\'' . $url["img"] . '\');"></div>';
                                                }
                                            }   
                                        }
                                    } else {
                                        include_once plugin_dir_path(__FILE__) . '/../scripts/slider.php';
                                        $output .= custom_media_slider($updated_images_url);
                                    }
                                }
                            } else if (($mobile != 1 && count($updated_images_url) > 0)) {
                                
                                if ($slider_desktop == true) {
                                    include_once plugin_dir_path(__FILE__) . '/../scripts/slider.php';
                                    $output .= custom_media_slider($updated_images_url);
                                } else {
                                    foreach ($updated_images_url as $url) {
                                        if (!empty($image)) {
                                            if (!empty($url["site"])) {
                                                $output .= '<a target="_blank" href="'. $url["site"] .'"><div class="custom-logo-item" style="background-image: url(\'' . $url["img"] . '\');"></div></a>';
                                            } else if (empty($url["site"])) {
                                                $output .= '<div class="custom-logo-item" style="background-image: url(\'' . $url["img"] . '\');"></div>';
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

    // $header_custom_logotypes_urldecode = urldecode($header_custom_logotypes);
    // $header_custom_logotypes_json = json_decode($header_custom_logotypes_urldecode, true);
    // foreach ($header_custom_logotypes_json as $logotypes_item) {
    //     $header_logotypes_url = $logotypes_item["logoscatalog"];
    //     $header_logotypes_title = $logotypes_item["titlecatalog"];
    //     $header_logotypes_position_title = $logotypes_item["left_center_right_title"];
    //     $header_logotypes_min_width = $logotypes_item["min_width_logo"];
    //     $header_logotypes_slider_full_width = $logotypes_item["slider_full_width_on"];
    //     $header_logotypes_slider_desktop = $logotypes_item["slider_desktop"];
    //     $header_logotypes_grid_mobile = $logotypes_item["grid_mobile"];
    //     $header_logotypes_logo_white = $logotypes_item["slider_logo_white"];

    //     $header_logotypes_files = $logotypes_item["logotypes_files"];
    //     $header_logotypes_files_urldecode = urldecode($header_custom_logotypes);
    //     $header_logotypes_files_json = json_decode($header_logotypes_files_urldecode, true);
    //     foreach ($header_logotypes_files_json as $logotypes_files) {
    //         $header_logotype_filename = $logotypes_item["logotype_filename"];
    //         $header_logotype_link = $logotypes_item["logotype_link"];
    //     }
    //     var_dump($header_logotypes_files);
        
        
    // }
    // var_dump($header_custom_logotypes_json);

?>

<?php if (isset($element_unique_id)) { ?>
    
<script>
 
    // Hide container if slider length = 0 (wydarzenia-ogolne.php)
    if(<?php echo count($files) ?>  > 0) {
        if(document.querySelector('.media-logos')){
            document.querySelector('.media-logos').style.display = "none";
        }
    }

</script>

<?php } ?>

