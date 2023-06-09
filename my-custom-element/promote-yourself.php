
<?php 
    $exhibitorsImages = glob($_SERVER['DOCUMENT_ROOT'] . '/doc/galeria/*.{jpeg,jpg,png,JPG,JPEG,PNG}', GLOB_BRACE);
    include plugin_dir_url( __FILE__ ) . 'custom-element.php';
?>
<div id="promoteYourself" >
    <div class="custom-content-exhibitors-item column-reverse custom-align-left">
        <div class="custom-exhibitors-text-block">
            <div class="main-heading-text">
                <h3 class="pl_PL">Wypromuj się na [trade_fair_name]!</h3>
                <h3 class="en_US">Promote yourself at the [trade_fair_name_eng]!</h3>
            </div>
            <div class="pl_PL custom-exhibitors-text">
                <p>Drogi Wystawco!</p>
                <p>[trade_fair_desc] – to niepowtarzalna okazja do wypromowania Twojej firmy! Chcesz by Twoje stoisko odwiedziło jak najwięcej osób? Pomożemy Ci sprawić, że Twoi klienci dowiedzą się, że jesteś częścią [trade_fair_name]!</p>
                <p>Poniżej KROK po KROKU wyjaśniamy jak sprawić, by o Twojej obecności na Targach dowiedzieli się Twoi klienci!</p>
            </div>
            <div class="en_US custom-exhibitors-text">
                <p>Dear Exhibitor!</p>
                <p>[trade_fair_desc_eng] - is a unique opportunity to promote your company! You want your stand to visit how the most people? We will help you make your clients know that you are part of [trade_fair_name_eng].</p>
                <p>Below we explain STEP by STEP how to make your presence at the Fair known to your customers!</p>
            </div>
        </div>
        <div class="custom-exhibitors-image-block uncode-single-media-wrapper">              
            <?php
                $thirdImage = $exhibitorsImages[2];
                $shortPath = substr($thirdImage, strpos($thirdImage, '/doc/'));
                echo '<img class="image-shadow" src="' . $shortPath . '">';
            ?>
        </div>
    </div>

    <!-- promote-yourself-elements -->
    <div class="custom-content-promote-item custom-align-left">     
        <ol class="pl_PL">
            <li>Zamieść nasz baner w swojej stopce mailowej oraz w stopkach pracowników Twojej firmy</li>
            <li>Zamieść w swoich kanałach Social Media oraz na www informację, że będziesz na Targach [trade_fair_name] i sukcesywnie o tym przypominaj!</li>
            <li>Wyślij mailing do bazy swoich klientów, że będą mogli zobaczyć Twoją firmę na [trade_fair_name].</li>
            <li>Poinformuj swoich klientów za pomocą swoich kanałów Social Media o tym, co na nich czeka na Twoim stoisku! (jakie brandy? jakie innowacyjne produkty i usługi? jakie atrakcje?)</li>
            <li>Przygotuj ofertę specjalną na targi i poinformuj o niej swoich klientów za pomocą kanałów Social Media oraz mailingu.</li>
            <li>Umieść na swojej stronie podlinkowany baner [trade_fair_name].</li>
            <li>Podziel się wszystkim tym, co przygotowałeś na [trade_fair_name] z naszym zespołem! Wyślij nam listę atrakcji i ambasadorów obecnych na Twoim stoisku oraz poinformuj nas o premierach, promocjach i rabatach, które przygotowałeś na targi, a my zamieścimy to w naszych kanałach Social Media. (wszelkie materiały wysyłaj na adres mailowy: <a href="mailto:marketing@warsawexpo.eu">marketing@warsawexpo.eu</a>)</li>
            <li>Jeśli potrzebujesz materiałów o naszych targach, poniżej znajduje się lista plików do pobrania.</li>
        </ol>
        <p class="pl_PL">Gdybyś potrzebował więcej, napisz do nas, a my postaramy się pomóc! Tylko działając razem jesteśmy w stanie osiągnąć sukces.</p>
        
        <ol class="en_US">
            <li>Place our banner in your e-mail footer and in the footers of your company's employees</li>
            <li>Include in your Social Media channels and on the website information that you will be at the [trade_fair_name_eng] and keep reminding about it!</li>
            <li>Send a mailing to your customer base that they will be able to see your company on [trade_fair_name_eng].</li>
            <li>Inform your customers through your Social Media channels about what is waiting for them at your stand! (what brands? what innovative products and services? what attractions?)</li>
            <li>Prepare a special offer for the fair and inform your customers about it using Social Media channels and mailing.</li>
            <li>Place the linked banner [trade_fair_name_eng] on your website.</li>
            <li>Share everything you've prepared on [trade_fair_name_eng] with our team! Send us a list of attractions and ambassadors present at your stand and inform us about the premieres, promotions and discounts that you have prepared for the fair, and we will post it in our Social Media channels. (all materials should be sent to the following e-mail address: <a href="mailto:marketing@warsawexpo.eu">marketing@warsawexpo.eu</a>)</li>
            <li>If you need materials about our fair, below is a list of files to download.</li>
        </ol>
        <p class="en_US">If you need more, write to us and we will try to help! Only by working together are we able to achieve success.</p>
    </div>
    <!-- promote-yourself-docs -->
    <?php
    if ($show_banners != 'true') {
        echo '<div class="custom-flex custom-content-promote-item custom-shadow-border-black">';
    } else {
        echo '<div class="custom-flex custom-content-promote-item custom-shadow-border-black custom-hide-promote">';
    }
    ?>
    <?php
if ($show_banners != 'true') {
    $base_url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $base_url .= "://".$_SERVER['HTTP_HOST'];
    
    echo '<div class="custom-column custom-content-promote-element">
            <h3 class="pl_PL">Pobierz banery</h3>
            <h3 class="en_US">Download banners</h3>';
                
    $file_path = glob('doc/wypromuj/wypromuj_800_pl.*');
    if (!empty($file_path)) {
        $file_path = $file_path[0];
        $file_url = $base_url . '/' . $file_path;
        echo '
            <p class="pl_PL">800×800</p>
            <div class="pl_PL">
                <span class="btn-container">
                    <a href="'.$file_url.'" class="custom-link btn border-width-0 btn-accent btn-square btn-icon-right" title="Katalog wystawcow">Pobierz<i class="fa fa-inbox2"></i></a>
                </span>
            </div>
            ';
    }
            
    $file_path = glob('doc/wypromuj/wypromuj_800_en.*');
    if (!empty($file_path)) {
        $file_path = $file_path[0];
        $file_url = $base_url . '/' . $file_path;
        echo '
        <p class="en_US">800×800</p>
        <div class="en_US">
            <span class="btn-container">
                <a href="'.$file_url.'" class="custom-link btn border-width-0 btn-accent btn-square btn-icon-right" title="Katalog wystawcow">Download <i class="fa fa-inbox2"></i></a>
            </span>
        </div>';
    }
            
    $file_path = glob('doc/wypromuj/wypromuj_1200_pl.*');
    if (!empty($file_path)) {
        $file_path = $file_path[0];
        $file_url = $base_url . '/' . $file_path;
        echo ' <p class="pl_PL">1200x200</p>
                <div class="pl_PL">
                    <span class="btn-container">
                        <a href="'.$file_url.'" class="custom-link btn border-width-0 btn-accent btn-square btn-icon-right" target="_blank" rel="nofollow" title="800x800">Pobierz<i class="fa fa-inbox2"></i></a>
                    </span>
                </div> ';
    }

    $file_path = glob('doc/wypromuj/wypromuj_1200_en.*');
    if (!empty($file_path)) {
        $file_path = $file_path[0];
        $file_url = $base_url . '/' . $file_path;
        echo '
        <p class="en_US">1200x200</p>
        <div class="en_US">
            <span class="btn-container">
                <a href="'.$file_url.'" class="custom-link btn border-width-0 btn-accent btn-square btn-icon-right" title="Katalog wystawcow">Download <i class="fa fa-inbox2"></i></a>
            </span>
        </div>';
    }
    
    echo '
    </div>';
    }
    ?>
    
        <div class="custom-column custom-content-promote-element">
            <h3 class="pl_PL">Pobierz logo</h3>
            <h3 class="en_US">Download logo</h3>
            <p><strong>[trade_fair_name]</strong></p>
            
        
            <?php
            
            if($promote_yourself != 'true') { 
                $backgroundImage = "/doc/logo.png"; 
                } else {
                    $backgroundImage = "/doc/logo-color.png";
                } 
                echo '<div style="background-image:url(\'' . $backgroundImage . '\'); background-repeat: no-repeat; background-size: contain; background-position: center;" class="img-bg"></div>';
            ?>

            <div class="pl_PL">
                <span class="btn-container">
                            <a href="/doc/logo.png" class="custom-link btn border-width-0 btn-accent btn-square btn-icon-right" target="_blank" rel="nofollow" title="800x800">Pobierz<i class="fa fa-inbox2"></i></a>
                </span>
            </div>
            <div class="en_US">
                <span class="btn-container">
                    <a href="/doc/logo.png" class="custom-link btn border-width-0 btn-accent btn-square btn-icon-right" target="_blank" rel="nofollow" title="800x800">Download<i class="fa fa-inbox2"></i></a>
                </span>
            </div>
        </div>
        <div class="custom-column custom-content-promote-element">
            <h3 class="pl_PL">Pobierz logo</h3>
            <h3 class="en_US">Download logo</h3>
            <p><strong>Ptak Warsaw Expo</strong></p>
            <div style="background-image:url('https://forumwarzywa.com/wp-content/uploads/2023/05/pwe-logo.jpg'); background-repeat: no-repeat; background-size: contain; background-position: center;" class="img-bg"></div>
            <div class="pl_PL">
                <span class="btn-container">
                    <a href="https://warsawexpo.eu/docs/Logo_PWE.zip" class="custom-link btn border-width-0 btn-accent btn-square btn-icon-right" target="_blank" rel="nofollow" title="800x800">Pobierz<i class="fa fa-inbox2"></i></a>
                </span>
            </div>
            <div class="en_US">
                <span class="btn-container">
                    <a href="https://warsawexpo.eu/docs/Logo_PWE.zip" class="custom-link btn border-width-0 btn-accent btn-square btn-icon-right" target="_blank" rel="nofollow" title="800x800">Download <i class="fa fa-inbox2"></i></a>
                </span>
            </div>  
        </div>
    </div>
    <div class="custom-shadow-border-black style-accent-bg custom-content-promote-item__help" style="margin:35px auto; padding: 35px 20px;">
        <h2 class="text-color-xsdn-color pl_PL" style="margin-top:0; ">
            Gdybyś potrzebował więcej napisz do nas, a my postaramy się pomóc! Tylko działając razem jesteśmy w stanie osiągnąć sukces.
        </h2>
        <h2 class="text-color-xsdn-color en_US" style="margin-top:0; ">
            If you need more, write to us and we will try to help! Only by working together can we be successful.
        </h2>
    </div>
</div>
