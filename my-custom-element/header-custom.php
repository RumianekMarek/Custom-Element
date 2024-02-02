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
        min-height: calc(100vh - 90px);
        justify-content: space-evenly;
        align-items: center;
        display: flex;
        flex-direction: column; 
    }
    .custom-header-background {
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
    .custom-header-logo {
        width: 450px;
        height: 250px;
        background-size: contain;
        z-index: 1;
    }
    .header-button a {
        padding: 0 !important;
        height: 70px;
        display: flex;
        flex-flow: column;
        align-items: center;
        justify-content: center;
        z-index: 1;
    }
    .custom-header-buttons {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        max-width: 650px;
        gap: 20px;
        padding: 18px 0;
    }
    .custom-btn-container {
        padding: 0;
    }
    .custom-header-text {
        max-width: 650px;
        padding: 18px 0;
        z-index: 1;
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
        justify-content: center;
        max-width: 1200px;
        margin: 0 auto;
        padding: 18px;
        gap: 18px;
    }
    /* .custom-header-logotypes .custom-container-logos-gallery {
        max-width: 50%;
    } */

    @media (min-width: 300px) and (max-width: 1200px) {
        .custom-header-text h1 {
            font-size: calc(24px + (30 - 24) * ( (100vw - 300px) / (1200 - 300) ));
        }
        .custom-header-text h2 {
            font-size: calc(28px + (36 - 28) * ( (100vw - 300px) / (1200 - 300) ));
        }
    }
    @media (max-width:768px) {
        .custom-header-logo {
            width: 80%;
        }
        .custom-header-logotypes .custom-container-logos-gallery {
            max-width: 100%;
        }
        .custom-header-logotypes {
            flex-direction: column;
        }
    }   
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

    $file_path_header_background = glob('doc/background.*');
    if (!empty($file_path_header_background)) {
        $file_path_header_background = $file_path_header_background[0];
        $file_url = $base_url . '/' . $file_path_header_background;
    }

?>
<div id="customHeader" class="custom-header">

    <div style="background-image: url(<?php echo $file_url ?>);"  class="custom-header-container custom-header-background">
    
        <div class="header-wrapper-column">
            <?php
            echo '<div style="background-image: url('. $logo_url .')" class="custom-header-logo custom-header-background"></div>';

            echo '<div class="custom-header-text">
                <h1 style="text-align: center; color:white !important; text-shadow: 2px 2px black;">'. $trade_fair_desc .'</h1>
                <h2 style="text-align: center; color:white !important; text-shadow: 2px 2px black; width:auto;">'. $trade_fair_date .'</h2>
            </div>';  
            ?>

            <div class="custom-header-buttons">
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

        </div>

        <div class="custom-header-logotypes">
            <?php
            $header_custom_logotypes_urldecode = urldecode($header_custom_logotypes);
            $header_custom_logotypes_json = json_decode($header_custom_logotypes_urldecode, true);
            if (is_array($header_custom_logotypes_json)) {
                foreach ($header_custom_logotypes_json as $logotypes) {
                    include 'logos-catalog.php';
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