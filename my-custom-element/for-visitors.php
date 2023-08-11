<?php 
    $visitorImages = glob($_SERVER['DOCUMENT_ROOT'] . '/doc/galeria/*.{jpeg,jpg,png,JPG,JPEG,PNG}', GLOB_BRACE);
    include plugin_dir_url( __FILE__ ) . 'custom-element.php';
?>
<div id="forVisitors"class="custom-container-visitors">

    <!-- for-visitors-item -->
    <div class="custom-content-visitors-item custom-align-left">
        <div class="custom-visitors-image-block uncode-single-media-wrapper">              
            <?php
                $firstImage = $visitorImages[0];
                $shortPath = substr($firstImage, strpos($firstImage, '/doc/'));
                echo '<img class="image-shadow" src="' . $shortPath . '" alt="visitors image 1">';
            ?>
        </div>
        <div class="custom-visitors-text-block">
            <div class="custom-visitors-text">
                <p><?php if($locale == 'pl_PL'){
                        if($visitor1 == '') { 
                            echo '[trade_fair_name] to branżowe specjalistyczne wydarzenie odbywające się w Ptak Warsaw Expo, Największym Centrum Targowo – Kongresowym w Europie Środkowej. Mające na celu skupienie wszystkich gałęzi branży [super_shortcode_1] i stworzenie dogodnych warunków do profesjonalnych kontaktów biznesowych. [trade_fair_desc] pozwolą na znalezienie potencjalnych partnerów biznesowych dla twojej firmy.';
                        } else {echo urldecode(base64_decode($visitor1));}
                    } else { if($visitor1 == '') {  echo "
                        [trade_fair_name_eng] is an industry specialized event held at Ptak Warsaw Expo, the Largest Trade Fair and Congress Center in Central Europe. Aimed at bringing together all branches of the [super_shortcode_2] industry and creating convenient conditions for professional business contacts. [trade_fair_desc_eng] will allow you to find potential business partners for your company.
                    ";} else {echo urldecode(base64_decode($visitor1));} }?>
                </p>
            </div>
        </div>
        
    </div>

    <!-- for-visitors-item -->
    <div class="custom-content-visitors-item custom-align-left column-reverse">
        <div class="custom-visitors-text-block">
            <div class="custom-visitors-text">
                <p>
                    <?php if($locale == 'pl_PL'){
                    if($visitor2 == '') {
                        echo '[trade_fair_name] to doskonała okazja byś mógł porównać i dokładnie przeanalizować wszystkie dostępne na polskim rynku oferty dedykowane branży. Wydarzenie to stanowi również doskonałą okazję do uczestnictwa w konferencjach, warsztatach oraz kongresach branży [super_shortcode_1] rozwijających znajomość rynku oraz pokazujących działanie najnowszych technologii. Zarejestruj się i otrzymaj zaproszenie na targi.';
                    } else {echo urldecode(base64_decode($visitor2));}
                } else { if($visitor2 == '') {  echo "
                    [trade_fair_name_eng] is an excellent opportunity for you to compare and carefully analyze all offers available on the Polish market dedicated to the industry. The event also provides an excellent opportunity to participate in conferences, workshops and congresses of the industry [super_shortcode_2] developing knowledge of the market and showing the operation of the latest technologies. Register and receive an invitation to the fair.
                "; } else {echo urldecode(base64_decode($visitor2));} } ?>
                </p>
            </div>
            <div class="custom-btn-container">
                <span>
                <?php if($locale == 'pl_PL'){
                   echo '<a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="/rejestracja/"  target="_blank" style="color:white !important">Zarejestruj się<span style="display: block; font-weight: 300;">Odbierz darmowy bilet</span></a>
                ';} else { echo '
                    <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="/en/registration/"  target="_blank" style="color:white !important">REGISTER<span style="display: block; font-weight: 300;">GET A FREE TICKET</span></a>
                ';} ?>
                </span>
            </div>
        </div>
        <div class="custom-visitors-image-block uncode-single-media-wrapper">              
            <?php
                $secondImage = $visitorImages[1];
                $shortPath = substr($secondImage, strpos($secondImage, '/doc/'));
                echo '<img class="image-shadow" src="' . $shortPath . '"alt="visitors image 2">';
            ?>
        </div>
    </div>
</div>