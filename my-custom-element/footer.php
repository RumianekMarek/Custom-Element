<?php
    include_once plugin_dir_path(__FILE__) . 'main-custom-element.php';
    $base_url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $base_url .= "://".$_SERVER['HTTP_HOST'];
?>

<div id="customFooter" class="custom-footer">

    <div class="custom-footer-bg" style="background-image: url(/wp-content/plugins/custom-element/my-custom-element/media/footer.jpg)">
        <div class="custom-footer-bg-wrapper">
            <div class="custom-footer-bg-limit">
                <div class="custom-footer-logo-pwe">
                    <img src="/wp-content/plugins/custom-element/my-custom-element/media/logo-pwe.png" alt="pwe">
                </div>
                <div class="custom-footer-title-section">
                    <?php if($locale == 'pl_PL'){ echo '
                        <h4 class="custom-align-left"><span>Targi / Konferencje / Eventy</span></h4>
                        <h2 class="custom-align-center"><span class="custom-uppercase custom-footer-title-pl">Stolica Targów</span></h2>
                    ';} else { echo '
                        <h4 class="custom-align-left"><span>Trade Fairs / Conferences / Events</span></h4>
                        <h2 class="custom-align-center"><span class="custom-uppercase custom-footer-title-en">Capital of the Fair</span></h2>
                    ';} ?>
                </div>
            </div>
            <div class="custom-footer-benefits">
                <?php if($locale == 'pl_PL'){ echo '
                    <p class="custom-uppercase">DOŚWIADCZONY ZESPÓŁ</p>
                    <p class="custom-uppercase">PROFESJONALIZM I KOMPLEKSOWOŚĆ</p>
                    <p class="custom-uppercase">DOSKONAŁA LOKALIZACJA</p>
                    <p class="custom-uppercase">INNOWACYJNY SYSTEM WYSTAWIENNICZY</p>
                ';} else { echo '
                    <p class="custom-uppercase">AN EXPERIENCED TEAM</p>
                    <p class="custom-uppercase">PROFESSIONALISM AND COMPLEXITY</p>
                    <p class="custom-uppercase">PERFECT LOCATION</p>
                    <p class="custom-uppercase">INNOVATIVE EXHIBITION SYSTEM</p>
                ';} ?>
            </div>
        </div>
    </div>

    <div class="custom-footer-images-bg">
            <img src="/wp-content/plugins/custom-element/my-custom-element/media/footer-images.jpg" alt="">
    </div>

    <?php 

    $menus = wp_get_nav_menus();
    $menu_array = array();

    foreach ($menus as $menu) {
        $menu_name_lower = strtolower($menu->name);

        if (strpos($menu_name_lower, '1 pl') !== false) {
            $menu_1_pl = $menu->name;
        } elseif (strpos($menu_name_lower, '1 en') !== false) {
            $menu_1_en = $menu->name;
        } elseif (strpos($menu_name_lower, '2 pl') !== false) {
            $menu_2_pl = $menu->name;
        } elseif (strpos($menu_name_lower, '2 en') !== false) {
            $menu_2_en = $menu->name;
        } elseif (strpos($menu_name_lower, '3 pl') !== false) {
            $menu_3_pl = $menu->name;
        } elseif (strpos($menu_name_lower, '3 en') !== false) {
            $menu_3_en = $menu->name;
        }
    }

    if($locale == 'pl_PL'){ 
        if(isset($menu_1_pl) && isset($menu_2_pl) && isset($menu_3_pl)){ echo '
            <div class="custom-footer-nav">
                <div class="custom-footer-nav-wrapper">
    
                    <div class="custom-footer-nav-left-column">
                        <div class="custom-footer-nav-logo-column">
                            <div class="custom-footer-nav-logo-top"><a href="' . $base_url . '"><img src="/wp-content/plugins/custom-element/my-custom-element/media/logo_pwe_ufi.png"></a></div>
                            <div class="custom-footer-nav-logo-bottom">
                                <a href="' . $base_url . '">
                                    ';
                                    if($footer_logo_color != 'true'){
                                        if($logo_color_invert != 'true'){
                                            echo '<img src="/doc/logo.png">';
                                        } else {
                                            echo '<span class="logo-invert-white"><img src="/doc/logo.png"></span>';
                                        }
                                    } else {
                                        echo '<img src="/doc/logo-color.png">';
                                    } echo '
                                </a>
                            </div>
                        </div>
                    </div>   
    
                    <div class="custom-footer-nav-right-column"> ';

                        if (isset($menu_1_pl)) { echo '
                        <!-- nav-column-item -->
                        <div class="custom-footer-nav-column">
                            <h5><span class="custom-uppercase">[trade_fair_name]</span></h5>
                            <div class="custom-footer-nav-links"> ';
                                wp_nav_menu(array(
                                    'menu' => $menu_1_pl
                                )); echo '
                            </div>
                        </div>
                        ';} 
                        if (isset($menu_2_pl)) { echo '
                        <!-- nav-column-item -->
                        <div class="custom-footer-nav-column">
                            <h5><span class="custom-uppercase">DLA ODWIEDZAJĄCYCH</span></h5>
                            <div class="custom-footer-nav-links"> ';
                                wp_nav_menu(array(
                                    'menu' => $menu_2_pl
                                )); echo '
                            </div>
                        </div>
                        ';}
                        if (isset($menu_3_pl)) { echo '
                        <!-- nav-column-item -->
                        <div class="custom-footer-nav-column">
                            <h5><span class="custom-uppercase">DLA WYSTAWCÓW</span></h5>
                            <div class="custom-footer-nav-links"> ';    
                                wp_nav_menu(array(
                                    'menu' => $menu_3_pl
                                )); echo '
                            </div>
                        </div>';
                        } echo '
                        
                    </div>                         
    
                </div>
            </div>
        ';}  
    } else { 
        if(isset($menu_1_en) && isset($menu_2_en) && isset($menu_3_en)){ echo '
            <div class="custom-footer-nav">
                <div class="custom-footer-nav-wrapper">

                    <div class="custom-footer-nav-left-column">
                        <div class="custom-footer-nav-logo-column">
                            <div class="custom-footer-nav-logo-top"><a href="' . $base_url . '"><img src="/wp-content/plugins/custom-element/my-custom-element/media/logo_pwe_ufi.png"></a></div>
                            <div class="custom-footer-nav-logo-bottom">
                                <a href="' . $base_url . '">
                                    ';
                                    if($footer_logo_color != 'true'){
                                        if (file_exists('doc/logo-en.png')) { 
                                            echo '<img src="/doc/logo-en.png">';
                                        } else {
                                            if($logo_color_invert != 'true'){
                                                echo '<img src="/doc/logo.png">';
                                            } else {
                                                echo '<span class="logo-invert-white"><img src="/doc/logo.png"></span>';
                                            }
                                        }         
                                    } else {
                                        if (file_exists('doc/logo-color-en.png')) { 
                                            echo '<img src="/doc/logo-color-en.png">';
                                        } else {
                                            if($logo_color_invert != 'true'){
                                                echo '<img src="/doc/logo-en.png">';
                                            } else {
                                                echo '<span class="logo-invert-white"><img src="/doc/logo-en.png"></span>';
                                            }
                                        }         
                                    } echo '
                                </a>
                            </div>
                        </div>
                    </div>   

                    <div class="custom-footer-nav-right-column"> ';

                        if (isset($menu_1_en)) { echo '
                        <!-- nav-column-item -->
                        <div class="custom-footer-nav-column">
                            <h5><span class="custom-uppercase">[trade_fair_name_eng]</span></h5>
                            <div class="custom-footer-nav-links"> ';
                                wp_nav_menu(array(
                                    'menu' => $menu_1_en
                                )); echo '
                            </div>
                        </div>
                        ';} 
                        if (isset($menu_2_en)) { echo '
                        <!-- nav-column-item -->
                        <div class="custom-footer-nav-column">
                            <h5><span class="custom-uppercase">FOR VISITORS</span></h5>
                            <div class="custom-footer-nav-links"> ';
                                wp_nav_menu(array(
                                    'menu' => $menu_2_en
                                )); echo '
                            </div>
                        </div>
                        ';}
                        if (isset($menu_3_en)) { echo '
                        <!-- nav-column-item -->
                        <div class="custom-footer-nav-column">
                            <h5><span class="custom-uppercase">FOR EXHIBITORS</span></h5>
                            <div class="custom-footer-nav-links"> ';    
                                wp_nav_menu(array(
                                    'menu' => $menu_3_en
                                )); echo '
                            </div>
                        </div>';
                        } echo '
                        
                    </div>                         

                </div>
            </div> ';
        }
    } 
    
    ?>

</div>
