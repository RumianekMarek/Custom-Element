<?php
    if ($btn_color != ''){
        $btn_color = '.custom_element_'.$rnd_id.' .custom-btn-container '.$btn_color;
        if ($btn_color_hover) {
            $btn_color_hover = '.custom_element_'.$rnd_id.' .custom-btn-container '.$btn_color_hover;
        }
    }
?>

<style>
    <?php echo $btn_color ?>
    <?php echo $btn_color_hover ?>

    /* Header */
    .custom-header .custom-header-container {
        min-height: calc(100vh - 90px);
        justify-content: space-evenly;
        flex-direction: column;
        align-items: center;
        display: flex;
    }

    .custom-header .custom-header-flex {
        display: flex;
    }

    .custom-header .custom-header-background {
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

    .custom-header .custom-header-logo {
        width: 450px;
        height: 250px;
        background-size: contain;
    }

    .custom-header .header-button a {
        padding: 0 !important;
        height: 70px;
        display: flex;
        flex-flow: column;
        align-items: center;
        justify-content: center;
        /* margin: 0 30px; */
    }

    .custom-header .custom-header-partner-fair img {
        filter: brightness(0) invert(1);
        max-height: 100px;
        margin: 0 15px;
    }

    .custom-header .custom-header-wrap {
        flex-wrap: wrap;
        justify-content: center;
    }

    .custom-partner-background {
        background-color: rgba(0, 0, 0, 0.6);
    }
    .custom-header .custom-header-buttons {
        max-width: 650px;
        gap: 20px;
        padding: 18px 0;
    }
    .custom-header .custom-btn-container {
        padding: 0;
    }
    .custom-header-text {
        max-width: 650px;
    }
    .custom-header-text h1 {
        font-size: 30px;
    }
    .custom-header-text h2 {
        font-size: 36px;
    }
    @media (min-width: 300px) and (max-width: 1200px) {
        .custom-header-text h1 {
            font-size: calc(24px + (30 - 24) * ( (100vw - 300px) / (1200 - 300) ));
        }
        .custom-header-text h2 {
            font-size: calc(28px + (36 - 28) * ( (100vw - 300px) / (1200 - 300) ));
        }
    }
    
    @media (max-width:600px) {
        .custom-header .custom-header-logo {
            width: 80%;
        }
    }

    /* END Header */    
</style>

<?php 
    include plugin_dir_url( __FILE__ ) . 'custom-element.php';
    $partnerImages = glob($_SERVER['DOCUMENT_ROOT'] . '/doc/partnerzy/*.{jpeg,jpg,png,webp,JPG,PNG,JPEG,WEBP}', GLOB_BRACE);
    $base_url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $base_url .= "://".$_SERVER['HTTP_HOST'];

    $trade_fair_desc = $locale == 'pl_PL' ? '[trade_fair_desc]' : '[trade_fair_desc_eng]';
    $trade_fair_date = $locale == 'pl_PL' ? '[trade_fair_date]' : '[trade_fair_date_eng]';

    if($logo_color != 'true') {
        $logo_url = $locale == 'pl_PL' || !file_exists('doc/logo-en.png') ? '/doc/logo.png' : '/doc/logo-en.png';
    } else {
        $logo_url = $locale == 'pl_PL' ? '/doc/logo-color.png' : (file_exists('doc/logo-color-en.png') ? '/doc/logo-color-en.png' : '/doc/logo-en.png');
    }

?>
<div id="customHeader" class="custom-header">
    <?php
        $file_path_header_background = glob('doc/background.*');
        if (!empty($file_path_header_background)) {
            $file_path_header_background = $file_path_header_background[0];
            $file_url = $base_url . '/' . $file_path_header_background;
            echo '<div style="background-image: url(\''.$file_url.'\');"  class="custom-header-container custom-header-flex custom-header-background">';
        }

        echo '<div style="background-image: url('. $logo_url .')" class="custom-header-logo custom-header-background"></div>';

        echo '<div class="custom-header-text">
            <h1 style="text-align: center; color:white !important; text-shadow: 2px 2px black;">'. $trade_fair_desc .'</h1>
            <h2 style="text-align: center; color:white !important; text-shadow: 2px 2px black; width:auto;">'. $trade_fair_date .'</h2>
        </div>';  
    ?>
    <div class="custom-header-flex custom-header-wrap custom-header-buttons">
        <?php 
        
            if ($locale == 'pl_PL') {
                $header_tickets_button_link = empty($header_tickets_button_link) ? "/bilety/" : $header_tickets_button_link;
                $header_register_button_link = empty($header_register_button_link) ? "/rejestracja/" : $header_register_button_link;
                $header_conferences_button_link = empty($header_conferences_button_link) ? "/wydarzenia/" : $header_conferences_button_link;
            } else {
                $header_tickets_button_link = empty($header_tickets_button_link) ? "/en/tickets/" : $header_tickets_button_link;
                $header_register_button_link = empty($header_register_button_link) ? "/en/registration/" : $header_register_button_link;
                $header_conferences_button_link = empty($header_conferences_button_link) ? "/en/events/" : $header_conferences_button_link;
            }

            if (in_array('register', explode(',', $button_on))) {
                echo'<div class="custom-btn-container header-button .custom-header-flex">';
                    if ($locale == 'pl_PL'){ 
                        echo '<a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="'. $header_register_button_link .'" alt="link do rejestracji">Zarejestruj się<span style="display: block; font-weight: 300;">Odbierz darmowy bilet</span></a>';
                    } else { 
                        echo '<a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="'. $header_register_button_link .'" alt="link to registration">Register<span style="display: block; font-weight: 300;">Get a free ticket</span></a>';
                    }   
                echo'</div>';
            }
            if (in_array('ticket', explode(',', $button_on))) {
                echo'<div class="custom-btn-container header-button .custom-header-flex">';
                    if ($locale == 'pl_PL'){ 
                        echo '<a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="'. $header_tickets_button_link .'" alt="link do biletów">Kup bilet</a>';
                    } else { 
                        echo '<a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="'. $header_tickets_button_link .'" alt="link to tickets">Buy a ticket</a>';
                    } 
                echo'</div>';
            }
            if (in_array('conference', explode(',', $button_on))) {
                echo'<div class="custom-btn-container header-button .custom-header-flex">';
                    if ($locale == 'pl_PL'){ 
                        echo '<a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="'. $header_conferences_button_link .'" alt="konferencje">KONFERENCJE</a>';
                    } else { 
                        echo '<a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="'. $header_conferences_button_link .'" alt="conferences">CONFERENCES</a>';
                    } 
                echo'</div>';
            }

            $header_custom_buttons_urldecode = urldecode($header_custom_buttons);
            $header_custom_buttons_json = json_decode($header_custom_buttons_urldecode, true);
            if (is_array($header_custom_buttons_json)) {
                foreach ($header_custom_buttons_json as $button) {
                    $button_url = $button["header_custom_button_link"];
                    $button_text = $button["header_custom_button_text"];
    
                    echo'<div class="custom-btn-container header-button .custom-header-flex">
                        <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="'. $button_url .'" alt="'. $button_url .'">'. $button_text .'</a>
                    </div>';
                }
            }

            
        ?>
        </div>

    <div class="custom-header-left-time">
        <?php
            $widgetHeaderPath = 'widget-header.php';
            include $widgetHeaderPath;
        ?>
    </div>

    <?php include 'logos-catalog.php'; ?>


    <?php
        // if($logo_color) {
        //     $partenr_background ="custom-partner-background";
        // } else {
        //     $partenr_background ="";
        // }
        // if($fair_partner == 'true'){
        //     echo '<div class="custom-header-partner-fair">';
        //     if($locale == 'pl_PL'){
        //         echo '<h2 style="width: 100%; text-align: center !important; color:white !important; text-shadow: 2px 2px black;">Partner Targów</h2>';
        //     } else {
        //         echo '<h2 style="width: 100%; text-align: center !important; color:white !important; text-shadow: 2px 2px black;">Fair Partner</h2>';
        //     }
        //     echo '<div class="custom-header-flex custom-header-flex-wrap '. $partenr_background . '">';
        //     if (!empty($partnerImages)) {                       
        //         foreach ($partnerImages as $imagePath) {
        //             $imageRelativePath = str_replace($_SERVER['DOCUMENT_ROOT'], '', $imagePath);
        //             $imageURL = $base_url . $imageRelativePath;             
        //             echo '<img src="' . $imageURL . '" alt="Partner Image">';
        //         }
        //         echo '</div>';
        //     }
        //     echo '</div>';
        // }
    ?>
        </div>
</div>
