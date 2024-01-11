<style>

    .custom-logos-gallery-wrapper {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
    }
    .custom-logos-gallery-wrapper .custom-logo-item,
    .custom-logos-gallery-wrapper .custom-logo-item div,
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
    #page-header .custom-logos-title{
        width: inherit !important;
        text-align: center;
        text-align: -webkit-center;
    }
    #page-header .custom-logos-title h4 {
        margin-top: 0;
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
                                
                            $slider_images_url = array();
                            $urls_custom = array();
    
                            foreach ($files as $index => $file) {
                                $short_path = '';
                                
                                if ($logoscatalog == "partnerzy obiektu") {
                                    $short_path = substr($file, strpos($file, '/wp-content/'));
                                } else {
                                    $short_path = substr($file, strpos($file, '/doc/'));
                                }
                                $file_name = pathinfo($file, PATHINFO_FILENAME);
                                $file_base_name = pathinfo($file, PATHINFO_BASENAME);
                                $full_path = $server_url . $short_path;  
    
                                $slider_images_url[] = $full_path;
                            }

                            $logotypes_files_urldecode = urldecode($logotypes_files);
                            $logotypes_files_json = json_decode($logotypes_files_urldecode, true);

                            $logotype_filename_array = array();
                            $logotype_link_array = array();

                            foreach ($logotypes_files_json as $logotype) {
                                $logotype_filename_array[] = $logotype["logotype_filename"];
                                $logotype_link_array[] = $logotype["logotype_link"];
                            }

                            $logotypes_files_json_encode = json_encode($logotypes_files_json);

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

<?php if (isset($element_unique_id)) { ?>
    
<script>

    {
        const logotypesFiles = <?php echo $logotypes_files_json_encode ?>;

        function processGalleryChildren(galleryChildren, containerClass) {
            for (let i = 0; i < galleryChildren.length; i++) {
                const backgroundImage = galleryChildren[i].style.backgroundImage;
                // Sprawdzamy, czy backgroundImage pasuje do wzoru
                const matchResult = backgroundImage.match(/"([^"]+)"/);

                if (matchResult) {
                    const filename = matchResult[1];
                    // Używamy metody split, aby uzyskać tablicę fragmentów
                    const filenameParts = filename.split("/");
                    // Pobieramy ostatni fragment, który powinien być nazwą pliku
                    const actualFilename = filenameParts[filenameParts.length - 1];
                    // Inicjujemy zmienną na znaleziony logotyp
                    let matchingLogotype = null;

                    for (let j = 0; j < logotypesFiles.length; j++) {
                        if (logotypesFiles[j].logotype_filename === actualFilename) {
                            matchingLogotype = logotypesFiles[j];
                            break;
                        }
                    }

                    if (matchingLogotype) {
                        // Tworzymy nowy element 'a'
                        const linkElement = document.createElement('a');
                        if (document.querySelector('.slides')) {
                            // Dodajemy klasę 'slide' i 'image-container' do nowego elementu 'a'
                            linkElement.classList.add('slide');
                            linkElement.classList.add('image-container');
                        } else {
                            // Dodajemy klasę 'custom-logo-item' do nowego elementu 'a'
                            linkElement.classList.add('custom-logo-item');
                        }
                        // Dodajemy target = "_blank"
                        linkElement.target = "_blank";
                        // Ustawiamy atrybut 'href' na wartość logotype_link
                        linkElement.href = matchingLogotype.logotype_link;
                        // Tworzymy nowy element 'div' (custom-logo-item)
                        const divElement = document.createElement('div');
                        // Ustawiamy atrybut 'style' z tła jako backgroundImage
                        divElement.style.backgroundImage = backgroundImage;
                        linkElement.appendChild(divElement);
                        if (document.querySelector('.slides')) {
                            // Usuwamy klasę 'slide' i 'image-container' z istniejącego elementu dziecka '.slides'
                            galleryChildren[i].classList.remove('slide');
                            galleryChildren[i].classList.remove('image-container');
                        } else {
                            // Usuwamy klasę 'custom-logo-item' z istniejącego elementu dziecka
                            galleryChildren[i].classList.remove('custom-logo-item');
                        }
                        // Zastępujemy obecny element dziecka nowym elementem 'a'
                        galleryChildren[i].replaceWith(linkElement);
                    }
                }
            }
        }

        // SLIDER
        if (document.querySelector('.slides')) {
            const slideChildren = document.querySelector('.slides').children;
            if (logotypesFiles && Array.isArray(logotypesFiles)) {
                processGalleryChildren(slideChildren, 'slides');
            }
        }

        // JUSTIFY
        if (document.querySelector('.custom-logos-gallery-wrapper')) {
            const galleryChildren = document.querySelector('.custom-logos-gallery-wrapper').children;
            if (logotypesFiles && Array.isArray(logotypesFiles)) {
                processGalleryChildren(galleryChildren, 'custom-logos-gallery-wrapper');
            }
        }
        
        // Hide container if slider length = 0 (wydarzenia-ogolne.php)
        if(<?php echo count($files) ?>  > 0) {
            if(document.querySelector('.media-logos')){
                document.querySelector('.media-logos').classList.toggle("custom-display-none")
            }
        }
    }

</script>

<?php } ?>

