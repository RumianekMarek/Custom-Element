<?php 

    $firstPath = $_SERVER['DOCUMENT_ROOT'] . '/doc/galeria/zdjecia_wys_odw';
    $secondPath = $_SERVER['DOCUMENT_ROOT'] . '/doc/galeria';

    if (is_dir($firstPath) && !empty(glob($firstPath . '/*.{jpeg,jpg,png,webp,JPEG,JPG,PNG,WEBP}', GLOB_BRACE))) {
        $visitorImages = glob($firstPath . '/*.{jpeg,jpg,png,webp,JPEG,JPG,PNG,WEBP}', GLOB_BRACE);
    } else {
        $visitorImages = glob($secondPath . '/*.{jpeg,jpg,png,webp,JPEG,JPG,PNG,WEBP}', GLOB_BRACE);
    }
    include plugin_dir_url( __FILE__ ) . 'custom-element.php';

    if ($color != '#ffffff'){
        $color = '#000000 !important';
    }
    if ($btn_color != ''){
        $btn_color = '.custom_element_'.$rnd_id.' #forVisitors ' . $btn_color;
        if ($btn_color_hover) {
            $btn_color_hover = '.custom_element_'.$rnd_id.' #forVisitors '.$btn_color_hover;
        }
    }

?> 
<style>
.custom_element_<?php echo $rnd_id ?> #forVisitors p{
    color: <?php echo $color ?>;
}

<?php echo $btn_color ?>
<?php echo $btn_color_hover ?>

.custom-content-visitors-item{
    width: 100%;
    display:flex;
    justify-content: center;
    gap: 36px;
    padding-bottom: 36px;
}
.custom-visitors-image-block, .custom-visitors-text-block{
    width: 50%;
}
.custom-visitors-image-block img {
    width: 100%;
    aspect-ratio: 16/9;
    object-fit: cover;
}
@media (max-width:768px){
    .custom-content-visitors-item {
        flex-direction: column;
    }
    .custom-column-reverse{
        flex-direction: column-reverse;
    }
    .custom-visitors-image-block,
    .custom-visitors-text-block {
        width: 100%;
    }
    .custom-visitors-text {
        padding: 18px 0;
    }
}
</style>

<div id="forVisitors"class="custom-container-visitors">

    <!-- for-visitors-item -->
    <div class="custom-content-visitors-item custom-align-left">
        <div class="custom-visitors-image-block uncode-single-media-wrapper">              
            <?php
                $firstImage = $visitorImages[0];
                $shortPath = substr($firstImage, strpos($firstImage, '/doc/'));
                echo '<div class="image-shadow"><div class="t-entry-visual"><img src="' . $shortPath . '" alt="visitors image 1"></div></div>';
            ?>
        </div>
        <div class="custom-visitors-text-block">
            <div class="custom-visitors-text">
                <p><?php if($locale == 'pl_PL'){
                        if($visitor1 == '') { 
                            echo '[trade_fair_name] to branżowe specjalistyczne wydarzenie odbywające się w Ptak Warsaw Expo, Największym Centrum Targowo – Kongresowym w Europie Środkowej. Mające na celu skupienie wszystkich gałęzi branży [trade_fair_opisbranzy] i stworzenie dogodnych warunków do profesjonalnych kontaktów biznesowych. [trade_fair_desc] pozwolą na znalezienie potencjalnych partnerów biznesowych dla twojej firmy.';
                        } else {echo urldecode(base64_decode($visitor1));}
                    } else { if($visitor1 == '') {  echo "
                        [trade_fair_name_eng] is an industry specialized event held at Ptak Warsaw Expo, the Largest Trade Fair and Congress Center in Central Europe. Aimed at bringing together all branches of the [trade_fair_opisbranzy_eng] industry and creating convenient conditions for professional business contacts. [trade_fair_desc_eng] will allow you to find potential business partners for your company.
                    ";} else {echo urldecode(base64_decode($visitor1));} }?>
                </p>
            </div>
        </div>
    </div>

    <!-- for-visitors-item -->
    <div class="custom-content-visitors-item custom-column-reverse custom-align-left column-reverse">
        <div class="custom-visitors-text-block">
            <div class="custom-visitors-text">
                <p>
                    <?php if($locale == 'pl_PL'){
                    if($visitor2 == '') {
                        echo '[trade_fair_name] to doskonała okazja byś mógł porównać i dokładnie przeanalizować wszystkie dostępne na polskim rynku oferty dedykowane branży. Wydarzenie to stanowi również doskonałą okazję do uczestnictwa w konferencjach, warsztatach oraz kongresach branży [trade_fair_opisbranzy] rozwijających znajomość rynku oraz pokazujących działanie najnowszych technologii. Zarejestruj się i otrzymaj zaproszenie na targi.';
                    } else {echo urldecode(base64_decode($visitor2));}
                } else { if($visitor2 == '') {  echo "
                    [trade_fair_name_eng] is an excellent opportunity for you to compare and carefully analyze all offers available on the Polish market dedicated to the industry. The event also provides an excellent opportunity to participate in conferences, workshops and congresses of the industry [trade_fair_opisbranzy_eng] developing knowledge of the market and showing the operation of the latest technologies. Register and receive an invitation to the fair.
                "; } else {echo urldecode(base64_decode($visitor2));} } ?>
                </p>
            </div>
            <div class="custom-btn-container">
                <span>
                <?php if($locale == 'pl_PL'){
                   echo '<a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="/rejestracja/">Zarejestruj się<span style="display: block; font-weight: 300;">Odbierz darmowy bilet</span></a>
                ';} else { echo '
                    <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="/en/registration/">REGISTER<span style="display: block; font-weight: 300;">GET A FREE TICKET</span></a>
                ';} ?>
                </span>
            </div>
        </div>
        <div class="custom-visitors-image-block uncode-single-media-wrapper">              
            <?php
                $secondImage = $visitorImages[1];
                $shortPath = substr($secondImage, strpos($secondImage, '/doc/'));
                echo '<div class="image-shadow"><div class="t-entry-visual"><img src="' . $shortPath . '"alt="visitors image 2"></div></div>';
            ?>
        </div>
    </div>

</div>