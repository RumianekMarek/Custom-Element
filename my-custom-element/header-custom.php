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
        justify-content: space-evenly;
        align-items: center;
        display: flex;
        flex-direction: column; 
        padding: 36px 0;
    }
    .custom-header-background {
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
    .custom-header-logo {
        max-width: <?php echo $header_logo_width ?>px !important;
        padding: 0 18px;
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
        z-index: 1;
    }
    .custom-header-buttons {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        max-width: 750px;
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
    }
    .custom-header-text {
        max-width: 750px;
        padding: 18px 0;
        z-index: 1;
    }
    .custom-header-text :is(h1, h2) {
        color: <?php echo $color ?> !important;
        text-shadow: 2px 2px <?php echo $text_shadow ?> !important;
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
        margin: 0 auto;
        padding: 18px;
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
    @media (max-width:768px) {
        .custom-header-logotypes .custom-container-logos-gallery {
            max-width: 100%;
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
                                if(!empty($button_url) && !empty($button_text) ) {
                                    echo'<div class="custom-btn-container header-button .custom-header-flex">
                                        <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="'. $button_url .'" alt="'. $button_url .'">'. $button_text .'</a>
                                    </div>';
                                } 
                            }
                        }
                    ?>
                </div>

            </div>

            
            <?php
                $header_custom_logotypes_urldecode = urldecode($header_custom_logotypes);
                $header_custom_logotypes_json = json_decode($header_custom_logotypes_urldecode, true);
                echo'<div class="custom-header-logotypes">';
                if (is_array($header_custom_logotypes_json)) {
                    foreach ($header_custom_logotypes_json as $logotypes) {
                        $logotypes_width = $logotypes["logotypes_width"];
                        if(!empty($logotypes["logoscatalog"])) {
                            include 'logos-catalog.php';
                        }
                    }
                }
                echo'</div>';
            ?>  
            

            <div class="custom-header-left-time">
                <?php
                    $widgetHeaderPath = 'widget-header.php';
                    include $widgetHeaderPath;
                ?>
            </div>
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