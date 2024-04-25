<?php
    if ($color == '' || $color == '#ffffff') {
        $color = 'white';
        $text_shadow = 'black';
    } else {
        $color = 'black';
        $text_shadow = 'white';
    }
    
    if ($header_logo_width == '') {
        $header_logo_width = '400px';
    }
    if ($btn_color != ''){
        $btn_color = '.custom_element_'.$rnd_id.' .custom-btn-container '.$btn_color;
        if ($btn_color_hover) {
            $btn_color_hover = '.custom_element_'.$rnd_id.' .custom-btn-container '.$btn_color_hover;
        }
    } 
    $header_logo_width = str_replace("px", "", $header_logo_width);
?>

<style>
    <?php echo $btn_color ?>
    <?php echo $btn_color_hover ?>

    .row-parent:has(.custom_element_<?php echo $rnd_id ?> .custom-header) {
        max-width: 100%;
        padding: 0 !important;  
    }
    .custom_element_<?php echo $rnd_id ?> .custom-header-wrapper {
        min-height: 60vh;
        max-width: 1200px;
        margin: 0 auto; 
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .custom-header-container:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: <?php echo $header_overlay_color ?>;
        opacity: <?php echo $header_overlay_range ?>;
        z-index: 0;
    }
    .header-wrapper-column {
        max-width: 750px;
        justify-content: space-evenly;
        align-items: center;
        display: flex;
        flex-direction: column; 
        padding: 36px 18px;
    }
    .custom-header-background {
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
    .custom-header-logo {
        max-width: <?php echo $header_logo_width ?>px !important;
        width: 100%;
        height: auto;
        z-index: 1;
    }
    .header-button a {
        padding: 0 !important;
        height: 70px;
        display: flex;
        flex-flow: column;
        align-items: center;
        justify-content: center;
        text-transform: uppercase;
        z-index: 1;
    }
    .custom-header-buttons {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        padding: 18px 0;
    }
    .custom-header .custom-btn-container {
        width: 320px;
        height: 75px;
        padding: 0;
    }
    .custom-header .btn {
        width: 100%;
        height: 100%;
        transform: scale(1) !important;
        font-size: 15px;
        padding: 6px 18px !important;
    }
    .custom-header-text {
        padding: 18px 0;
        z-index: 1;
    }
    .custom-header-text :is(h1, h2), 
    .custom-header .custom-logos-title h4 {
        color: <?php echo $color ?> !important;
        text-shadow: 2px 2px <?php echo $text_shadow ?> !important;
        text-transform: uppercase;
        text-align: center;
        width: auto;
    }
    .custom-header-text h1 {
        font-size: 30px;
    }
    .custom-header-text h2 {
        font-size: 36px;
    }
    .custom-header .custom-container-logos-gallery {
        position: relative;
        z-index: 1;
    }
    .custom-header-logotypes {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        max-width: 1200px;
        width: 100%;
        margin: 0 auto;
        padding: 18px 18px 36px;
        gap: 18px;
    }
    @media (max-width:1200px) {
        .custom-header-logotypes {
            max-width: 100%;
        }
    }
    @media (min-width: 300px) and (max-width: 1200px) {
        .custom-header-text h1 {
            font-size: calc(24px + (30 - 24) * ( (100vw - 300px) / (1200 - 300) ));
        }
        .custom-header-text h2 {
            font-size: calc(28px + (36 - 28) * ( (100vw - 300px) / (1200 - 300) ));
        }
    }
    @media (max-width:700px) {
        .custom-header-logotypes .custom-container-logos-gallery {
            width: 100% !important;
        }
        .custom-header .custom-btn-container {
            width: 260px;
            height: 70px;
        }
        .custom-header .btn {
            font-size: 13px;
        }
    }   
</style>

<?php 
    include plugin_dir_url( __FILE__ ) . 'custom-element.php';
    $partnerImages = glob($_SERVER['DOCUMENT_ROOT'] . '/doc/partnerzy/*.{jpeg,jpg,png,webp,JPG,PNG,JPEG,WEBP}', GLOB_BRACE);
    $base_url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $base_url .= "://".$_SERVER['HTTP_HOST'];

    $trade_fair_name = $locale == 'pl_PL' ? '[trade_fair_name]' : '[trade_fair_name_eng]';
    $trade_fair_desc = $locale == 'pl_PL' ? '[trade_fair_desc]' : '[trade_fair_desc_eng]';
    $trade_fair_date = $locale == 'pl_PL' ? '[trade_fair_date]' : '[trade_fair_date_eng]';

    if($header_logo_color != 'true') {
        if ($locale == 'pl_PL') {
            $logo_url = (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo.webp') ? '/doc/logo.webp' : '/doc/logo.png');
        } else {
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-en.webp') || file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-en.png')) {
                $logo_url = file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-en.webp') ? "/doc/logo-en.webp" : "/doc/logo-en.png";
            } else {
                $logo_url = file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo.webp') ? "/doc/logo.webp" : "/doc/logo.png";
            }  
        }
    } else {
        if ($locale == 'pl_PL') {
            $logo_url = (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-color.webp') ? '/doc/logo-color.webp' : '/doc/logo-color.png');
        } else {
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-color-en.webp') || file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-color-en.png')) {
                $logo_url = file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-color-en.webp') ? "/doc/logo-color-en.webp" : "/doc/logo-color-en.png";
            } else {
                $logo_url = file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-color.webp') ? "/doc/logo-color.webp" : "/doc/logo-color.png";
            }
        }
    }

    $file_path_header_background = glob('doc/background.*');
    if (!empty($file_path_header_background)) {
        $file_path_header_background = $file_path_header_background[0];
        $file_url = $base_url . '/' . $file_path_header_background;
    }

    if ($header_simple_mode == 'true') {
        echo '
            <style>
                .header-wrapper-column {
                    padding: 36px;
                }
                .custom-header-wrapper {
                    min-height: auto !important;
                }
                .custom-header-text {
                    display: flex;
                    flex-direction: column-reverse;
                }
                .custom-header-text h2 {
                    font-size: calc(28px + (40 - 28) * ( (100vw - 300px) / (1200 - 300) ));
                }
                @media (min-width:960px) {
                    .custom-header-background {
                        background-position: top;
                    }
                    .custom-header-wrapper {
                        min-height: 350px !important;
                        height: 350px;
                    }
                    .header-wrapper-column {
                        max-width: 1200px;
                        flex-direction: row;
                    }
                }
                @media (min-width:960px) {
                    .header-wrapper-column {
                        gap: 100px;
                    }
                }
            </style>
        ';
    }

    if ($header_logo_marg_pag == 'true') {
        echo '
            <style>
                .header-wrapper-column {
                    padding: 0 18px 36px;
                }
                .custom-header-text h1 {
                    margin: 0;
                }
                .custom-header-text {
                    padding: 0 0 18px;
                }
            </style>
        ';
    }

    $positions = ['top', 'center', 'bottom'];
    foreach ($positions as $position) {
        if (in_array($position, explode(',', $header_bg_position))) {
            echo '
                <style>
                    .custom-header-background {
                        background-position: '. $position .' !important;
                    }
                </style>
            ';
            break;
        }
    }

?>

<div id="customHeader" class="custom-header">

    <div style="background-image: url(<?php echo $file_url ?>);"  class="custom-header-container custom-header-background">
        <div class="custom-header-wrapper">
            <div class="header-wrapper-column">
                <?php
                echo '<img class="custom-header-logo" src="'. $logo_url .'" alt="logo-'. $trade_fair_name .'">';

                echo '<div class="custom-header-text">
                    <h1>'. $trade_fair_desc .'</h1>
                    <h2>'. $trade_fair_date .'</h2>
                </div>';  
                ?>

                <?php 
                if ($header_simple_mode != 'true') {

                    echo '<div class="custom-header-buttons">';
                         
                        if ($locale == 'pl_PL') {
                            $header_tickets_button_link = empty($header_tickets_button_link) ? "/bilety/" : $header_tickets_button_link;
                            $header_register_button_link = empty($header_register_button_link) ? "/rejestracja/" : $header_register_button_link;
                            $header_conferences_button_link = empty($header_conferences_button_link) ? "/wydarzenia/" : $header_conferences_button_link;
                        } else {
                            $header_tickets_button_link = empty($header_tickets_button_link) ? "/en/tickets/" : $header_tickets_button_link;
                            $header_register_button_link = empty($header_register_button_link) ? "/en/registration/" : $header_register_button_link;
                            $header_conferences_button_link = empty($header_conferences_button_link) ? "/en/conferences/" : $header_conferences_button_link;
                        }
                        
                        $target_blank = (strpos($header_conferences_button_link, 'http') !== false) ? 'target="blank"' : '';

                        if (in_array('register', explode(',', $button_on))) {
                            echo'<div id="customBtnRegistration" class="custom-btn-container header-button">';
                                if ($locale == 'pl_PL'){ 
                                    echo '<a class="custom-link btn border-width-0" href="'. $header_register_button_link .'" alt="link do rejestracji">Zarejestruj się<span style="display: block; font-weight: 300;">Odbierz darmowy bilet</span></a>';
                                } else { 
                                    echo '<a class="custom-link btn border-width-0" href="'. $header_register_button_link .'" alt="link to registration">Register<span style="display: block; font-weight: 300;">Get a free ticket</span></a>';
                                }   
                            echo'</div>';
                        }
                        if (in_array('ticket', explode(',', $button_on))) {
                            echo'<div id="customBtnTickets" class="custom-btn-container header-button">';
                                if ($locale == 'pl_PL'){ 
                                    echo '<a class="custom-link btn border-width-0" href="'. $header_tickets_button_link .'" alt="link do biletów">Kup bilet</a>';
                                } else { 
                                    echo '<a class="custom-link btn border-width-0" href="'. $header_tickets_button_link .'" alt="link to tickets">Buy a ticket</a>';
                                } 
                            echo'</div>';
                        }
                        if (in_array('conference', explode(',', $button_on))) {
                            if (empty($header_conferences_title)) {
                                $header_conferences_title = ($locale == 'pl_PL') ? 'KONFERENCJE' : 'CONFERENCES';
                            } else {
                                $header_conferences_title = urldecode(base64_decode($header_conferences_title));
                            }
                            echo'<div id="customBtnConferences" class="custom-btn-container header-button">';
                                if ($locale == 'pl_PL'){ 
                                    echo '<a class="custom-link btn border-width-0" href="'. $header_conferences_button_link .'" '. $target_blank .' alt="konferencje">'. $header_conferences_title .'</a>';
                                } else { 
                                    echo '<a class="custom-link btn border-width-0" href="'. $header_conferences_button_link .'" '. $target_blank .' alt="conferences">'. $header_conferences_title .'</a>';
                                } 
                            echo'</div>';
                        }

                        $header_custom_buttons_urldecode = urldecode($header_custom_buttons);
                        $header_custom_buttons_json = json_decode($header_custom_buttons_urldecode, true);
                        if (is_array($header_custom_buttons_json)) {
                            foreach ($header_custom_buttons_json as $button) {
                                $button_url = $button["header_custom_button_link"];
                                $button_text = $button["header_custom_button_text"];

                                $target_blank_aditional = (strpos($button_url, 'http') !== false) ? 'target="blank"' : '';
                                if(!empty($button_url) && !empty($button_text) ) {
                                    echo'<div class="custom-btn-container header-button">
                                        <a class="custom-link btn border-width-0" href="'. $button_url .'" '. $target_blank_aditional .' alt="'. $button_url .'">'. $button_text .'</a>
                                    </div>';
                                } 
                            }
                        }
                    
                    echo '</div>';
                }
                ?>

            </div>

            <?php

                // if ($header_conference == 'true') {
                    echo'<div class="header-conference">';
                        // $widgetCongressPath = 'widget-congress.php';
                        // include $widgetCongressPath;
                    echo'</div>';
                // }

            ?>
            
            <?php
                $header_custom_logotypes_urldecode = urldecode($header_custom_logotypes);
                $header_custom_logotypes_json = json_decode($header_custom_logotypes_urldecode, true);
                if ($header_simple_mode != 'true') {
                    if (is_array($header_custom_logotypes_json) && !empty($header_custom_logotypes_json)) {
                        echo'<div class="custom-header-logotypes">';
                            foreach ($header_custom_logotypes_json as $logotypes) {
                                $logotypes_width = $logotypes["logotypes_width"];
                                $logotypes_media = $logotypes["logotypes_media"];
                                if(!empty($logotypes["logoscatalog"]) || !empty($logotypes_media)) {
                                    include 'logos-catalog.php';
                                }
                            }
                        echo'</div>';
                    }
                }
                
            ?>
            
            <?php
                if ($header_simple_mode != 'true') {
                    echo'<div class="custom-header-left-time">';
                        $widgetHeaderPath = 'widget-header.php';
                        include $widgetHeaderPath;
                    echo'</div>';
                }
            ?>
            
        </div>
    </div>
    
</div>

<?php if (glob($_SERVER['DOCUMENT_ROOT'] . '/doc/header_mobile.webp', GLOB_BRACE)) {?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (window.innerWidth <= 569) {
                const customHeaderBg = document.querySelector('#customHeader .custom-header-container');
                if (customHeaderBg) {
                    customHeaderBg.style.backgroundImage = "url('/doc/header_mobile.webp')";
                }
            }  
        });
    </script>
<?php } ?>