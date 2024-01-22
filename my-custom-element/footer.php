<?php
    include_once plugin_dir_path(__FILE__) . 'main-custom-element.php';
    $base_url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $base_url .= "://".$_SERVER['HTTP_HOST'];
?>

<style>
.custom-footer-bg {
    position: relative;
    padding: 36px;
    background-size: cover;
}
.custom-footer-bg:after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.2);
    opacity: .4;
}
.custom-footer-bg-wrapper {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 36px;
}
.custom-footer-bg-limit {
    max-width: 950px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 36px;
}
.custom-footer-images-bg img {
    width: 100%;
    object-fit: contain;
}
.custom-footer-bg, .custom-footer-images-bg {
    background-position: center;
    background-repeat: no-repeat;
}
.custom-footer-logo-pwe {
    width: 100%;
    display: flex;
    float: left;
}
.custom-footer-logo-pwe img {
    width: 140px;
}
.custom-footer-title-section h4 span {
    color: white;
    width: auto;
}
.custom-footer-title-section h2 {
    margin: 0;
    width: auto !important;
}
.custom-footer-title-pl {
    color: white;
    font-size: 96px;  
}
.custom-footer-title-en {
    color: white;
    font-size: 84px; 
}
@media (min-width: 320px) and (max-width: 1200px) { 
    .custom-footer-title-pl { 
        font-size: calc(24px + (96 - 24) * ( (100vw - 320px) / ( 1200 - 320) )); 
    } 
    .custom-footer-title-en { 
        font-size: calc(24px + (84 - 24) * ( (100vw - 320px) / ( 1200 - 320) )); 
    } 
}
.custom-footer-benefits {
    display: flex;
    justify-content: space-around;
}
.custom-footer-benefits p {
    text-align: center;
    font-size: 14px;
    font-weight: 700;
    color: white;
    text-shadow: 0 0 10px black;
}
.custom-footer-nav {
    background-color: black;
    padding: 36px;
}
.custom-footer-nav-wrapper {
    display: flex;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    gap: 18px;
}
.custom-footer-nav-left-column, 
.custom-footer-nav-right-column {
    display: flex;
    gap: 18px;
}
.custom-footer-nav-left-column {
    width: 25%;
}
.custom-footer-nav-right-column {
    width: 75%;
}
.custom-footer-nav-logo-column {
    width: 100%;
}
.custom-footer-nav-column {
    width: 33.333%;
}
.custom-footer-nav-column h5 span {
    color: white;
}
.custom-footer-nav-logo-top,
.custom-footer-nav-logo-bottom {
    max-width: 200px !important;
}
.custom-footer-nav-logo-bottom img {
    padding: 8px;
    max-height: 150px;
    object-fit: contain;
}
.custom-footer-nav-links ul {
    padding: 0 !important;
    list-style: none !important;
}
.custom-footer-nav-links ul li a {
    color: white !important;
}
@media (max-width:1000px){
    .custom-footer-benefits {
        flex-direction: column;
        justify-content: center;
    }
    .custom-footer-nav-column h5 span {
        font-size: 16px;
    }
    .custom-footer-nav-left-column {
        width: 30%;
    }
    .custom-footer-nav-right-column {
        width: 70%;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .custom-footer-nav-column {
        width: 47%;
    }
}
@media (max-width:720px) {
    .custom-footer-nav-column h5 span {
        font-size: 14px;
    }
    .custom-footer-nav-links ul li a {
        font-size: 14px;
    }
}
@media (max-width:640px) {
    .custom-footer-nav-wrapper {
        flex-direction: column;
    }
    .custom-footer-nav-left-column {
        width: 100%;
    }
    .custom-footer-nav-logo-top,
    .custom-footer-nav-logo-bottom {
        margin: 0 auto;
    }
    .custom-footer-nav-right-column {
        width: 100%;
    }
}
@media (max-width:500px) {
    .custom-footer-bg {
        padding: 18px;
    }
    .custom-footer-title-section h4 {
        text-align: center;
        width: auto;
    }
    .custom-footer-title-section h4 span {
        font-size: 16px;
    }
    .custom-footer-nav-right-column {
        flex-direction: column;
    }
    .custom-footer-nav-column {
        width: 200px;
        margin-left: auto;
        margin-right: auto;
    }
}
</style>
<div id="customFooter" class="custom-footer">

    <div class="custom-footer-bg" style="background-image: url(/wp-content/plugins/custom-element/media/footer.webp)">
        <div class="custom-footer-bg-wrapper">
            <div class="custom-footer-bg-limit">
                <div class="custom-footer-logo-pwe">
                    <img src="/wp-content/plugins/custom-element/media/logo_pwe.webp" alt="pwe logo">
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
            <img src="/wp-content/plugins/custom-element/media/footer-images.webp" alt="footer background">
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
                            <div class="custom-footer-nav-logo-top"><a href="' . $base_url . '"><img src="/wp-content/plugins/custom-element/media/logo_pwe_ufi.webp" alt="logo pwe & ufi"></a></div>
                            <div class="custom-footer-nav-logo-bottom text-centered">
                                <a href="' . $base_url . '">
                                    ';
                                        if ($logo_color_invert != 'true') {
                                            echo '<img src="' . (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo.webp') ? '/doc/logo.webp' : '/doc/logo.png') . '" alt="logo-[trade_fair_name]">';
                                        } else {
                                            echo '<span class="logo-invert-white"><img src="' . (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo.webp') ? '/doc/logo.webp' : '/doc/logo.png') . '" alt="logo-[trade_fair_name]"></span>';
                                        }
                                    echo '
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
                            <div class="custom-footer-nav-logo-top"><a href="' . $base_url . '/en"><img src="/wp-content/plugins/custom-element/my-custom-element/media/logo_pwe_ufi.png"></a></div>
                            <div class="custom-footer-nav-logo-bottom text-centered">
                                <a href="' . $base_url . '/en">
                                    ';
                                        if (file_exists('doc/logo-en.png') && $logo_color_invert !== 'true') { 
                                            echo '<img src="' . (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-en.webp') ? '/doc/logo-en.webp' : '/doc/logo-en.png') . '" alt="logo-[trade_fair_name]">';
                                        } elseif (file_exists('doc/logo-en.png') && $logo_color_invert == 'true') {
                                            echo '<span class="logo-invert-white"><img src="' . (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-en.webp') ? '/doc/logo-en.webp' : '/doc/logo-en.png') . '" alt="logo-[trade_fair_name]"></span>';
                                        } else {
                                            if($logo_color_invert == 'true'){
                                                echo '<span class="logo-invert-white"><img src="' . (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo.webp') ? '/doc/logo.webp' : '/doc/logo.png') . '" alt="logo-[trade_fair_name]"></span>';
                                            } else {
                                                echo '<img src="' . (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo.webp') ? '/doc/logo.webp' : '/doc/logo.png') . '" alt="logo-[trade_fair_name]">'; 
                                            }   
                                        } 
                                    echo '
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
                        } 
                        echo '
                    </div>                         
                </div>
            </div> ';
        }
    } 
    
    ?>

</div>
