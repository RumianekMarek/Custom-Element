<?php
    $promoteImages = glob($_SERVER['DOCUMENT_ROOT'] . '/doc/galeria/*.{jpeg,jpg,png,webp,JPG,JPEG,PNG,WEBP}', GLOB_BRACE);

    if ($color != '#000000'){
        $color = '#ffffff !important';
    }
    if ($btn_color != ''){
        $btn_color = '.custom_element_'.$rnd_id.' .btn-container '.$btn_color;
        if ($btn_color_hover) {
            $btn_color_hover = '.custom_element_'.$rnd_id.' .btn-container '.$btn_color_hover;
        }
    }
?>
<style>
<?php echo $btn_color ?>
<?php echo $btn_color_hover ?>


.custom-content-promote-item {
    padding:0 5px 25px 5px;
    flex-wrap: wrap;
}
.custom-content-promote-item .btn-icon-right {
    color:white !important;
}
.custom-content-promote-item .custom-content-promote-element {
    flex:1;
    justify-content: space-between;
    align-items: center;
    min-width: 250px;
    display:flex !important;
}
.custom-content-promote-item div .img-bg  {
    width: 250px;
    min-height: 150px;
}
.custom-content-promote-item div .btn {
    transform: none !important;
    white-space: unset !important;
    font-size: 16px;
}
.custom-content-promote-item div .btn-container {
    display: flex;
    justify-content: center;
}
.custom-content-promote-item__help {
    width: 80%;
}
.custom-content-promote-item__help div a {
    font-size: 18px;
}
.custom_element_<?php echo $rnd_id ?> .custom-content-promote-item__help h5 {
    margin-top: 0;
    color: <?php echo $color ?>;
}
.custom-hide-promote {
    width: 66%;
    margin: 0 auto;
}
@media (max-width:950px){
    .custom-content-promote-item__help {
        width: 100%;
    }
    .custom-hide-promote {
        width: 100%;
    }
}
@media (max-width:600px) {
    .custom-content-promote-item  ol li {
        font-size:13px !important;
    }
    .custom-content-promote-item__help {
        padding: 25px 10px !important;
    }
    .custom-content-promote-item__help h5, .custom-content-promote-item__help div a {
        font-size:13px !important;
    }

    .promote-img-contener{
        order: 2;
        text-align: center;
    }
    .custom-promote-text-block{
        display: flex;
        flex-direction: column;
    }
}
.promote-element-background-element {
    background: lightgrey;
}
.custom-promote-left-container{
    max-width:50%;
}
.image-container {
    position: relative;
    max-width: 45%;
}

.download-hover {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgba(0, 0, 0, 1);
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    opacity: 0;
    transition: opacity 0.3s ease;
    cursor: pointer;
}

.download-uslug:hover .download-hover {
    opacity: 1;
}
.download-social:hover .download-hover {
    opacity: 1;
}
.custom-promote-text-block {
    display:flex;
}
@media(max-width:960px){
    .image-container {
        max-width:100%;
    }
     .custom-promote-left-container{
        max-width:100%;
    }
    .download-hover {
        opacity: 1;
        top: 75%;
        padding: 5px 5px;
    }
    .custom-promote-text-block {
        display:block;
    }
}
</style>
<div id="promoteYourself" >
    <div class="custom-content-promote-item column-reverse custom-align-left">
        <div class="custom-promote-text-block" style="">
            <div class="custom-promote-left-container">
            <?php
                if($locale == 'pl_PL'){
                    echo '<h3>Wypromuj się na [trade_fair_name]!</h3>';
                } else {
                    echo '<h3>Promote yourself at the [trade_fair_name_eng]!</h3>';}
                if($locale == 'pl_PL'){
                    echo '
                        <p>Drogi Wystawco!</p>
                        <p>[trade_fair_desc] – to niepowtarzalna okazja do wypromowania Twojej firmy! Chcesz by Twoje stoisko odwiedziło jak najwięcej osób? Pomożemy Ci sprawić, że Twoi klienci dowiedzą się, że jesteś częścią [trade_fair_name]!</p>
                        <p>Poniżej KROK po KROKU wyjaśniamy jak sprawić, by o Twojej obecności na Targach dowiedzieli się Twoi klienci!</p>';
                } else {
                    echo '
                        <p>Dear Exhibitor!</p>
                        <p>[trade_fair_desc_eng] - is a unique opportunity to promote your company! You want your stand to visit how the most people? We will help you make your clients know that you are part of [trade_fair_name_eng].</p>
                        <p>Below we explain STEP by STEP how to make your presence at the Fair known to your customers!</p>';
                }
            ?>
            </div>
            <div class="image-container">
                <div class="image-shadow promote-img-contener"style="display: flex; gap: 20px;">
                    <div style="margin: 0 18px;" class="image-container download-uslug">
                        <img class="" src="/wp-content/plugins/custom-element/media/Katalog-uslug-marketingowych.webp">
                        <?php if($locale == 'pl_PL'){
                            echo '<div class="download-hover"><a style="color: white;" target="_blank" href="https://warsawexpo.eu/docs/Katalog-uslug-marketingowych.pdf"><i class="fa fa-inbox2"></i>Pobierz</a></div>';} else {
                            echo '<div class="download-hover"><a style="color: white;" target="_blank" href="https://warsawexpo.eu/docs/Katalog-uslug-marketingowych.pdf"><i class="fa fa-inbox2"></i>Download</a></div>';} ?>
                    </div>
                    <div style="margin: 0 18px;" class="image-container download-social">
                        <img class="" src="/wp-content/plugins/custom-element/media/Katalog-uslug-social-media.webp">
                         <?php if($locale == 'pl_PL'){
                            echo '<div class="download-hover"><a style="color: white;" target="_blank" href="https://warsawexpo.eu/docs/Katalog-uslug-social-media.pdf"><i class="fa fa-inbox2"></i>Pobierz</a></div>';} else {
                            echo ' <div class="download-hover"><a style="color: white;" target="_blank" href="https://warsawexpo.eu/docs/Katalog-uslug-social-media.pdf"><i class="fa fa-inbox2"></i>Download</a></div>';} ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- promote-yourself-elements -->
    <div class="custom-content-promote-item custom-align-left">
        <?php if($locale == 'pl_PL'){ echo '
        <ol>
            <li>Zamieść nasz baner w swojej stopce mailowej oraz w stopkach pracowników Twojej firmy</li>
            <li>Zamieść w swoich kanałach Social Media oraz na www informację, że będziesz na Targach [trade_fair_name] i sukcesywnie o tym przypominaj!</li>
            <li>Wyślij mailing do bazy swoich klientów, że będą mogli zobaczyć Twoją firmę na [trade_fair_name].</li>
            <li>Poinformuj swoich klientów za pomocą swoich kanałów Social Media o tym, co na nich czeka na Twoim stoisku! (jakie brandy? jakie innowacyjne produkty i usługi? jakie atrakcje?)</li>
            <li>Przygotuj ofertę specjalną na targi i poinformuj o niej swoich klientów za pomocą kanałów Social Media oraz mailingu.</li>
            <li>Umieść na swojej stronie podlinkowany baner [trade_fair_name].</li>
            <li>Podziel się wszystkim tym, co przygotowałeś na [trade_fair_name] z naszym zespołem! Wyślij nam listę atrakcji i ambasadorów obecnych na Twoim stoisku oraz poinformuj nas o premierach, promocjach i rabatach, które przygotowałeś na targi, a my zamieścimy to w naszych kanałach Social Media. (wszelkie materiały wysyłaj na adres mailowy: <a style="text-decoration:underline;" href="mailto:konsultantmarketingowy@warsawexpo.eu">konsultantmarketingowy@warsawexpo.eu</a>)</li>
            <li>Jeśli potrzebujesz materiałów o naszych targach, poniżej znajduje się lista plików do pobrania.</li>
        </ol>
        <p>Gdybyś potrzebował więcej, napisz do nas, a my postaramy się pomóc! Tylko działając razem jesteśmy w stanie osiągnąć sukces.</p>
        ';} else { echo "
        <ol>
            <li>Place our banner in your e-mail footer and in the footers of your company's employees</li>
            <li>Include in your Social Media channels and on the website information that you will be at the [trade_fair_name_eng] and keep reminding about it!</li>
            <li>Send a mailing to your customer base that they will be able to see your company on [trade_fair_name_eng].</li>
            <li>Inform your customers through your Social Media channels about what is waiting for them at your stand! (what brands? what innovative products and services? what attractions?)</li>
            <li>Prepare a special offer for the fair and inform your customers about it using Social Media channels and mailing.</li>
            <li>Place the linked banner [trade_fair_name_eng] on your website.</li>
            <li>Share everything you've prepared on [trade_fair_name_eng] with our team! Send us a list of attractions and ambassadors present at your stand and inform us about the premieres, promotions and discounts that you have prepared for the fair, and we will post it in our Social Media channels. (all materials should be sent to the following e-mail address: <a style='text-decoration:underline;' href='mailto:konsultantmarketingowy@warsawexpo.eu'>konsultantmarketingowy@warsawexpo.eu</a>)</li>
            <li>If you need materials about our fair, below is a list of files to download.</li>
        </ol>
        <p>If you need more, write to us and we will try to help! Only by working together are we able to achieve success.</p>
        ";} ?>
    </div>
    <!-- promote-yourself-docs -->
    <?php
    if ($show_banners != 'true') {
        if($color == '#000000'){
            echo '<div class="custom-flex custom-content-promote-item custom-shadow-border-black promote-element-background-element">';
        } else {
            echo '<div class="custom-flex custom-content-promote-item custom-shadow-border-black">';
        }
    }  else  {
        if($color == '#000000'){
            echo '<div class="custom-flex custom-content-promote-item custom-shadow-border-black promote-element-background-element custom-hide-promote">';
        } else {
           echo '<div class="custom-flex custom-content-promote-item custom-shadow-border-black custom-hide-promote">';
        }

    }
    ?>
    <?php
    if ($show_banners != 'true') {
        $base_url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $base_url .= "://".$_SERVER['HTTP_HOST'];

        echo '<div class="custom-column custom-content-promote-element">
                <h3>';
                    if($locale == 'pl_PL'){ echo '
                        Pobierz banery
                    ';} else { echo "
                        Download banners
                    ";}
                    echo '</h3>';

        $file_path = glob('doc/wypromuj/wypromuj_800_pl.*');
    if (!empty($file_path) && $locale == 'pl_PL') {
        $file_path = $file_path[0];
        $file_url = $base_url . '/' . $file_path;
        echo '
            <p>800×800</p>
            <div>
                <span class="btn-container">
                    <a href="'.$file_url.'" class="custom-link btn" target="_blank" rel="nofollow" title="800x800" >Pobierz<i class="fa fa-inbox2"></i></a>
                </span>
            </div>
            ';
    }

    $file_path = glob('doc/wypromuj/wypromuj_800_en.*');
    if (!empty($file_path) && $locale == 'en_US') {
        $file_path = $file_path[0];
        $file_url = $base_url . '/' . $file_path;
        echo '
        <p>800×800</p>
        <div>
            <span class="btn-container">
                <a href="'.$file_url.'" class="custom-link btn" target="_blank" rel="nofollow" title="800x800">Download <i class="fa fa-inbox2"></i></a>
            </span>
        </div>';
    }

    $file_path = glob('doc/wypromuj/wypromuj_1200_pl.*');
    if (!empty($file_path) && $locale == 'pl_PL') {
        $file_path = $file_path[0];
        $file_url = $base_url . '/' . $file_path;
        echo ' <p>1200x200</p>
                <div>
                    <span class="btn-container">
                        <a href="'.$file_url.'" class="custom-link btn" target="_blank" rel="nofollow" title="1200x200">Pobierz<i class="fa fa-inbox2"></i></a>
                    </span>
                </div> ';
    }

    $file_path = glob('doc/wypromuj/wypromuj_1200_en.*');
    if (!empty($file_path) && $locale == 'en_US') {
        $file_path = $file_path[0];
        $file_url = $base_url . '/' . $file_path;
        echo '
        <p>1200x200</p>
        <div>
            <span class="btn-container">
                <a href="'.$file_url.'" class="custom-link btn" target="_blank" rel="nofollow" title="1200x200">Download <i class="fa fa-inbox2"></i></a>
            </span>
        </div>';
    }

    echo '
    </div>';
    }
    ?>

        <div class="custom-column custom-content-promote-element">
            <h3>
                <?php if($locale == 'pl_PL'){ echo '
                Pobierz logo</h3>
                <p><strong>[trade_fair_name]</strong></p>
                ';} else { echo '
                Download logo</h3>
                <p><strong>[trade_fair_name_eng]</strong></p>
                ';} ?>
            <?php
            if ($logo_white_promote != 'true') {
                if ($locale == 'pl_PL') {
                    $logo_url = file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-color.webp') ? "/doc/logo-color.webp" : "/doc/logo-color.png";
                } else {
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-color-en.webp') || file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-color-en.png')) {
                        $logo_url = file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-color-en.webp') ? "/doc/logo-color-en.webp" : "/doc/logo-color-en.png";
                    } else {
                        $logo_url = file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-color.webp') ? "/doc/logo-color.webp" : "/doc/logo-color.png";
                    }

                }
            } else {
                if ($locale == 'pl_PL') {
                    $logo_url = file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo.webp') ? "/doc/logo.webp" : "/doc/logo.png";
                } else {
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-en.webp') || file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-en.png')) {
                        $logo_url = file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-en.webp') ? "/doc/logo-en.webp" : "/doc/logo-en.png";
                    } else {
                        $logo_url = file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo.webp') ? "/doc/logo.webp" : "/doc/logo.png";
                    }
                }
            }
            echo '<div style="background-image:url(\'' . $logo_url . '\'); background-repeat: no-repeat; background-size: contain; background-position: center;" class="img-bg"></div>';
            ?>
        <div>
            <span class="btn-container">
                <a href="<?php echo $logo_url; ?>" class="custom-link btn" target="_blank" rel="nofollow" title="800x800" >
                    <?php if($locale == 'pl_PL'){ echo '
                    Pobierz
                    ';} else { echo '
                    Download
                    ';} ?>
                <i class="fa fa-inbox2"></i></a>
            </span>
        </div>
        </div>
        <div class="custom-column custom-content-promote-element">
            <h3>
                <?php if($locale == 'pl_PL'){ echo '
                Pobierz logo
                ';} else { echo '
                Download logo
                ';} ?>
            </h3>
            <p><strong>Ptak Warsaw Expo</strong></p>
            <div style="background-image:url('/wp-content/plugins/custom-element/media/logo_pwe_black.webp'); background-repeat: no-repeat; background-size: contain; background-position: center;" class="img-bg"></div>
            <div>
                <span class="btn-container">
                    <a href="https://warsawexpo.eu/docs/Logo_PWE.zip" class="custom-link btn" target="_blank" rel="nofollow" title="800x800">
                        <?php if($locale == 'pl_PL'){ echo '
                        Pobierz
                        ';} else { echo '
                        Download
                        ';} ?>
                    <i class="fa fa-inbox2"></i></a>
                </span>
            </div>
        </div>
    </div>
    <div class="custom-shadow-border-black style-accent-bg custom-content-promote-item__help" style="margin:35px auto; padding: 25px 20px;">
        <h5>
            <?php if($locale == 'pl_PL'){ echo '
                Gdybyś potrzebował więcej napisz do nas, a my postaramy się pomóc! Tylko działając razem jesteśmy w stanie osiągnąć sukces.</br>
            ';} else { echo '
                If you need more, write to us and we will try to help! Only by working together can we be successful.</br>
            ';} ?>
        </h5>
        <div style="text-align: center; margin-top:15px; font-weight: 600; text-decoration:underline; text-decoration-color:white;">
            <a style="color:<?php echo $color ?>;" href="mailto:konsultantmarketingowy@warsawexpo.eu">konsultantmarketingowy@warsawexpo.eu</a>
        </div>
    </div>
</div>