<style>

    .custom-logos-gallery-wrapper {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
    }
    .custom-logos-gallery-wrapper .custom-logo-item,
    .custom-logos-gallery-wrapper .slides div {
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        min-height: 120px;
        min-width: 140px;
        margin: 5px;
    }
    .custom-logos-title h4 {
        margin: 0;
    }

    <?php if ($slider_full_width_on == "true") { ?>
        .custom_element_catalog_slider {
            overflow: visible !important;
        }
    <?php } ?>

    .custom-white-logos div[style*="background-image"] {
        filter: brightness(0) invert(1);
        transition: all .3s ease;
    }
    .custom-white-logos div[style*="background-image"]:hover {
        filter: none;
    }

    /* FOR HEADER */
    #page-header .custom-logos-title{
        width: inherit !important;
        text-align: center;
        text-align: -webkit-center;
    }
    #page-header .custom-logos-title h4 {
        color:white;
        margin-top: 0;
        box-shadow: 9px 9px 0px -6px white;
    }

</style>


<?php
    if ($logoscatalog != ''){
    
        $is_https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
        $domain = $_SERVER['HTTP_HOST'];
        $server_url = ($is_https ? 'https://' : 'http://') . $domain;
        $mobile = preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT']);

        $pattern = '/``id``:``(.*?)``,``url``:``(.*?)``/';
        // Search for matches and save the results to an array of $matches
        preg_match_all($pattern, $logo_url, $matches);

        $ids = $matches[1];
        $url_values = $matches[2];

        if ($logoscatalog == "partnerzy obiektu") {
            $files = glob($_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/custom-element/my-custom-element/media/partnerzy-obiektu/*.{jpeg,jpg,png,webp,JPEG,JPG,PNG,WEBP}', GLOB_BRACE);
        } else {
            $files = glob($_SERVER['DOCUMENT_ROOT'] . '/doc/' . $logoscatalog . '/*.{jpeg,jpg,png,webp,JPEG,JPG,PNG,WEBP}', GLOB_BRACE); 
        } 

        if (count($files) > 0) {

            if($color != ''){
                echo '
                    <style>
                        .custom_element_'.$rnd_id.' .custom-logos-title span{
                            color: '.$color.';
                        }
                    </style>';
            }
    
            $output = '<div id="customLogos" class="custom-container-logos-gallery">
                        <div class="custom-logos-title main-heading-text">
                            <h4 class="custom-uppercase"><span>'. $titlecatalog .'</span></h4>
                        </div>
                        <div class="custom-logos-gallery-wrapper single-top-padding ';
                        if ($slider_logo_white == "true") {
                            $output .= 'custom-white-logos';
                        }
                        $output .= '">';
                                
                            $slider_images_url = array();
                            $urls_custom = array();
    
                            foreach ($files as $index => $file) {
                                $short_path = '';
                                
                                if ($logoscatalog == "partnerzy obiektu") {
                                    $short_path = substr($file, strpos($file, '/wp-content/'));
                                    // if (strpos($short_path, '/doc/'.$logoscatalog.'/') !== false) {
                                    //     $altText = str_replace('/doc/'.$logoscatalog.'/', '', $short_path);
                                    // } else {$altText = 'partner logotyp';}
                                } else {
                                    $short_path = substr($file, strpos($file, '/doc/'));
                                    // if (strpos($short_path, '/doc/'.$logoscatalog.'/') !== false) {
                                    //     $altText = str_replace('/doc/'.$logoscatalog.'/', '', $short_path);
                                    // } else {$altText = 'logotyp';}
                                }
                                $file_name = pathinfo($file, PATHINFO_FILENAME);
                                $file_base_name = pathinfo($file, PATHINFO_BASENAME);
                                $full_path = $server_url . $short_path;
    
                                // Looking for the index of the match "id" in the array $ids
                                $idIndex = array_search(strtolower($file_base_name), array_map('strtolower', $ids));
    
                                if ($idIndex !== false && $url_values[$idIndex] !== "") {
                                    if (strpos($url_values[$idIndex], 'https://www.') !== false) {
                                        $url = 'https://' . preg_replace('/https:\/\/www\./i', '', $url_values[$idIndex]);
                                    } else if (strpos($url_values[$idIndex], 'http://www.') !== false) {
                                        $url = 'https://' . preg_replace('/http:\/\/www\./i', '', $url_values[$idIndex]);
                                    } else if (strpos($url_values[$idIndex], 'www.') !== false) {
                                        $url = 'https://' . preg_replace('/www\./i', '', $url_values[$idIndex]);
                                    }  else if (strpos($url_values[$idIndex], 'http://') !== false) {
                                        $url = 'https://' . substr($url_values[$idIndex], 7); 
                                    } else if (strpos($url_values[$idIndex], 'https://') !== false) {
                                        $url = $url_values[$idIndex];
                                    } else {
                                        $url = 'https://' . $url_values[$idIndex];
                                    }
                                } else {
                                    $url = "";  
                                }
    
                                // if ($showurl == "true" && $url_custom !== "") {
                                //     $singleLogo .= '<a href="' . $url_custom . '" title="logo ' . $file_name . '" target="_blank"><div class="custom-logo-item" style="background-image: url(' . $full_path . ');"></div></a>';
                                // } else {
                                //     if ($showurl == "true" && $url_custom == "") {
                                //         $singleLogo .= '<div class="custom-logo-item" style="background-image: url(' . $full_path . ');"></div>';
                                //     } else {
                                //         $singleLogo .= '<div class="custom-logo-item" style="background-image: url(' . $full_path . ');"></div>';
                                //     }
                                // }
    
                                // $url_custom = $url;
                                // $urls_custom[$index] = $url_custom;
    
                                $slider_images_url[] = $full_path;
    
                            }
                            
                            if ($mobile == 1 && count($slider_images_url) > 0) {
                                if ($grid_mobile == true) {
                                    foreach ($slider_images_url as $full_path) {
                                        $output .= '<div class="custom-logo-item" style="background-image: url(' . $full_path . ');"></div>';
                                    }
                                } else {
                                    if (count($slider_images_url) <= 2) {
                                        foreach ($slider_images_url as $full_path) {
                                            $output .= '<div class="custom-logo-item" style="background-image: url(' . $full_path . ');"></div>';
                                        }
                                    } else {
                                        include_once plugin_dir_path(__FILE__) . '/../scripts/slider.php';
                                        $output .= custom_media_slider($slider_images_url);
                                    }
                                }
                            } else if (($mobile != 1 && count($slider_images_url) > 0)) {
                                
                                if ($slider_desktop == true) {
                                    include_once plugin_dir_path(__FILE__) . '/../scripts/slider.php';
                                    $output .= custom_media_slider($slider_images_url);
                                } else {
                                    foreach ($slider_images_url as $full_path) {
                                        $output .= '<div class="custom-logo-item" style="background-image: url(' . $full_path . ');"></div>';
                                    }
                                }
                            }
                            
                $output .= '</div>
            </div>';
    
            echo $output;
        }  
    }
?>

