<?php 
    include plugin_dir_url( __FILE__ ) . 'custom-element.php';
    $partnerImages = glob($_SERVER['DOCUMENT_ROOT'] . '/doc/partnerzy/*.{jpeg,jpg,png,JPG,PNG,JPEG}', GLOB_BRACE);
    $base_url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $base_url .= "://".$_SERVER['HTTP_HOST'];
?>
<div id="custom-header" class="custom-element-header">
    <?php
        $file_path_header_background = glob('doc/header.*');
        if (!empty($file_path_header_background)) {
            $file_path_header_background = $file_path_header_background[0];
            $file_url = $base_url . '/' . $file_path_header_background;
            echo '<div style="background-image: url(\''.$file_url.'\');"  class="custom-element-header-container custom-element-header-flex custom-header-background">';
        }
    ?>
    <?php 
        if($logo_color != 'true'){
            if($locale == 'pl_PL'){
                echo '<div style="background-image: url(/doc/logo.png)" class="custom-header-logo custom-header-background"></div>';
            } else {
                if (file_exists('doc/logo-en.png')) { 
                    echo '<div style="background-image: url(/doc/logo-en.png)" class="custom-header-logo custom-header-background"></div>';
                } else {
                    echo '<div style="background-image: url(/doc/logo.png)" class="custom-header-logo custom-header-background"></div>';
                } 
            }
        } else {
            if($locale == 'pl_PL'){
                echo '<div style="background-image: url(/doc/logo-color.png)" class="custom-header-logo custom-header-background"></div>';
            } else {
                if (file_exists('doc/logo-color-en.png')) { 
                    echo '<div style="background-image: url(/doc/logo-color-en.png)" class="custom-header-logo custom-header-background"></div>';
                } else {
                    echo '<div style="background-image: url(/doc/logo-en.png)" class="custom-header-logo custom-header-background"></div>';
                } 
            }
        }
    ?>
    <?php
        if($locale == 'pl_PL'){
            echo '<div><h1 style="text-align: center; color:white !important; text-shadow: 2px 2px black;">[trade_fair_desc]</h1><h2 style="text-align: center; color:white !important; text-shadow: 2px 2px black; width:auto;">[trade_fair_date]</h2></div>';
        } else {
            echo '<div><h1 style="text-align: center; color:white !important; text-shadow: 2px 2px black;">[trade_fair_desc_eng]</h1><h2 style="text-align: center;width:auto; color:white !important; text-shadow: 2px 2px black;">[trade_fair_date_eng]</h2></div>';
        }
    ?>
    <div class="custom-element-header-flex custom-element-header-wrap">
        <?php 
            if (in_array('register', explode(',', $button_on))) {
                if($locale == 'pl_PL'){
                    echo '<div class="custom-btn-container header-button .custom-element-header-flex">
                            <a href="/rejestracja/" class="custom-element-header-flex custom-link btn btn-lg border-width-0 shadow-black btn-accent btn-flat" style="min-width:300px;" title="Zarejestruj się">Zarejestruj się<span style="display: block; font-weight: 300;">Odbierz darmowy bilet</span></a>
                        </div>';
                } else {
                    echo '<div class="custom-btn-container header-button custom-element-header-flex">
                        <a href="/en/registration/" class="custom-element-header-flex custom-link btn btn-lg border-width-0 shadow-black btn-accent btn-flat" style="min-width:300px;" title="Register">REGISTER<span style="display: block; font-weight: 300;">GET A FREE TICKET</span></a>
                    </div>';
                }
            }
            if (in_array('ticket', explode(',', $button_on))) {
                if($locale == 'pl_PL'){
                    echo '<div class="custom-btn-container header-button custom-element-header-flex">
                            <a href="/bilety/" class="custom-element-header-flex custom-link btn btn-lg border-width-0 shadow-black btn-accent btn-flat" style="min-width:300px;" title="KUP BILET">KUP BILET<span style="display: block; font-weight: 300;">TRWA PRZEDSPRZEDAŻ</span></a>
                        </div>';
                } else {
                    echo '<div class="custom-btn-container header-button custom-element-header-flex">
                            <a href="/en/tickets/" class="custom-element-header-flex custom-link btn btn-lg border-width-0 shadow-black btn-accent btn-flat" style="min-width:300px;" title="BUY A TICKET">BUY A TICKET<span style="display: block; font-weight: 300;">PRE-SALE OFFER</span></a>
                        </div>';
                }
            }
            if (in_array('conference', explode(',', $button_on))) {
                if($locale == 'pl_PL'){
                    echo '<div class="custom-btn-container header-button custom-element-header-flex">
                            <a href="/wydarzenia/" class="custom-element-header-flex custom-link btn btn-lg border-width-0 shadow-black btn-accent btn-flat" style="min-width:300px;" title="Zarejestruj się">KONFERENCJE</a>
                        </div>';
                } else {
                    echo '<div class="custom-btn-container header-button custom-element-header-flex">
                            <a href="/en/events/" class="custom-element-header-flex custom-link btn btn-lg border-width-0 shadow-black btn-accent btn-flat" style="min-width:300px;" title="CONFERENCES">CONFERENCES</a>
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
    <?php
        if($fair_partner == 'true'){
            echo '<div class="custom-header-partner-fair">';
            if($locale == 'pl_PL'){
                echo '<h2 style="width: 100%; text-align: center !important; color:white !important; text-shadow: 2px 2px black;">Partner Targów</h2>';
            } else {
                echo '<h2 style="width: 100%; text-align: center !important; color:white !important; text-shadow: 2px 2px black;">Fair Partner</h2>';
            }
            echo '<div class="custom-element-header-flex custom-element-header-flex-wrap">';
            if (!empty($partnerImages)) {                       
                foreach ($partnerImages as $imagePath) {
                    $imageRelativePath = str_replace($_SERVER['DOCUMENT_ROOT'], '', $imagePath);
                    $imageURL = $base_url . $imageRelativePath;             
                    echo '<img src="' . $imageURL . '" alt="Partner Image">';
                }
                echo '</div>';
            }
            echo '</div>';
        }
    ?>
        </div>
</div>
