<?php 
if ($color != '#ffffff'){
    $color = '#000000';
}
if ($color === '#ffffff') {
    $invert = 'filter: invert(1);';
}

?>
<style>
.custom_element_<?php echo $rnd_id ?> #dojazd :is(h4, h5, p){
    color: <?php echo $color ?>;
}
.custom-route-title-wrapper h4 {
    width: auto !important;
}
.custom-route-transport-item-img {
    display: flex;
    align-items: center;
    padding-right: 18px;
}
.custom_element_<?php echo $rnd_id ?> .custom-route-transport-item-img img {
    width: 60px !important;
    min-width: 60px;
    <?php echo $invert ?>
}
.custom-route-image-bg {
    aspect-ratio: 16/9;
    background-position: center;
    background-size: cover;
}
.custom-route-image-bg h3 {
    font-size: 22px !important;
    max-width: 90%;
    padding: 8px;
    margin: 0;
}
.custom-route-area-wrapper {
    padding-top: 36px;
    display: flex;
    gap: 36px;
    flex-direction: column;
}
.custom-route-area-block {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 18px;
}
.custom-route-area-block img {
    width: 80px;
    padding: 0 18px;
}
.custom-route-area-item-text {
    align-items: center;
}
.custom-route-area-item-text h5 {
    margin: 0;
}
@media (max-width:960px) {
    #route{
        padding: 36px 0;
    }
    .custom-route-transport-wrapper, 
    .custom-route-area-wrapper {
        flex-direction: column;
    }
    .custom-route-map-block, 
    .custom-route-transport-block, 
    .custom-route-image-bg-block, 
    .custom-route-area-block {
        width: 100% !important;
    }
    .custom-route-image-bg h3 {
        font-size: 18px !important;
    }
    .custom-route-area-block {
        padding: 36px 0;
    }
}
@media (max-width:600px){
    .custom-align-center {
        font-size: 16px !important;
    }
    .custom-route-transport-item {
        flex-direction: column;
    }
    .custom-route-transport-block h5{
        margin: 0;
    }
    .custom-route-transport-block img{
        margin: 27px 0 0;
    }
    .custom-route-transport-item-text {
        text-align: center;
    }
    .custom-route-transport-item-img,
    .custom-route-transport-item-text h5 {
        padding: 0;
        width: inherit !important;
        justify-content: center;
    }
}
</style>

<div id="dojazd"class="custom-container-route">

<div class="custom-route-title-wrapper">
    <h4 class="custom-align-center">
    <?php if($locale == 'pl_PL'){ echo '
            PTAK WARSAW EXPO – NAJLEPIEJ SKOMUNIKOWANE CENTRUM TARGOWE W POLSCE!
        ';} else { echo '
            PTAK WARSAW EXPO - THE BEST-CONNECTED TRADE FAIR CENTER IN POLAND!
        ';} ?>
    </h4>
</div>

<div class="custom-route-transport-wrapper custom-align-left single-top-padding custom-full-gap">

    <div class="custom-route-map-block custom-half-width">

        <img class="custom-full-width" src="/wp-content/plugins/custom-element/my-custom-element/media/mapka-wawa.png">

        <div class="custom-route-area-wrapper custom-align-left">
            <div class="custom-route-image-bg-block">
                <div style="background-image: url('/wp-content/plugins/custom-element/my-custom-element/media/ptak.jpg');" class="custom-route-image-bg shadow-black">
                    <h3 class="color-white">
                        <?php if($locale == 'pl_PL'){ echo '
                            Największy obiekt targowy w Polsce oraz Europie Środkowo-Wschodniej
                        ';} else { echo ' 
                            The largest fair facility in Poland and Central and Eastern Europe
                        ';} ?>
                    </h3>
                </div>
            </div>
            <div class="custom-route-area-block area">

                <div class="custom-route-area-item custom-flex">
                    <div class="custom-route-area-item-img">
                        <img src="/wp-content/plugins/custom-element/my-custom-element/media/entry.png">
                    </div>
                    <div class="custom-route-area-item-text custom-flex">
                        <h5>
                            <?php if($locale == 'pl_PL'){ echo '
                                143 000 m2 powierzchni wystawienniczej
                            ';} else { echo ' 
                                    143 000 m2 exhibition space
                            ';} ?>
                        </h5>
                    </div>
                </div>

                <div class="custom-route-area-item custom-flex">
                    <div class="custom-route-area-item-img">
                        <img src="/wp-content/plugins/custom-element/my-custom-element/media/leave.png">
                    </div>
                    <div class="custom-route-area-item-text custom-flex">
                        <h5>
                            <?php if($locale == 'pl_PL'){ echo '
                                500 000 m2 powierzchni zewnętrznej
                            ';} else { echo ' 
                                500 000 m2 outer surface
                            ';} ?>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <div class="custom-route-transport-block custom-half-width drive">
        <!-- custom-transport-item -->
        <div class="custom-route-transport-item custom-flex">
            <div class="custom-route-transport-item-img">
                <img class="custom-full-width" src="/wp-content/plugins/custom-element/my-custom-element/media/samolot.png">
            </div>
            <div class="custom-route-transport-item-text">
                <?php if($locale == 'pl_PL'){ echo '
                    <h5>SAMOLOTEM</h5>
                    <p>Do Ptak Warsaw Expo z Międzynarodowego Portu Lotniczego im. Fryderyka Chopina dotrzeć można w niespełna 10 minut! Nasze Centrum jest również dogodnie położone względem <span>lotniska w Modlinie oraz Łodzi.</span></p>
                ';} else { echo '
                    <h5>BY PLANE</h5>
                    <p>To Ptak Warsaw Expo from the International Warsaw Chopin Airport in less than 10 minutes! Our Center is also conveniently located when travelling from the airports in Modlin and Lodz.</p>
                ';} ?>
            </div>
        </div>

        <!-- custom-transport-item -->
        <div class="custom-route-transport-item custom-flex">
            <div class="custom-route-transport-item-img">
                <img class="custom-full-width" src="/wp-content/plugins/custom-element/my-custom-element/media/train.png">
            </div>
            <div class="custom-route-transport-item-text">
                <?php if($locale == 'pl_PL'){ echo '   
                    <h5>POCIĄGIEM</h5>
                    <p>Warszawa posiada trzy stacje kolejowe dla pociągów dalekobieżnych: Dworzec Centralny (Warszawa Centralna), Dworzec Wschodni (Warszawa Wschodnia) oraz Dworzec Zachodni (Warszawa Zachodnia). <span>Z dworca</span> zachodniego do Ptak Warsaw Expo można dojechać samochodem już w 13 minut (wg Google).</p>
                ';} else { echo '    
                    <h5>BY TRAIN</h5>
                    <p>Warsaw has three railway stations for long-distance trains: Central Railway Station (Central Warsaw), Eastern Railway Station (Eastern Warsaw) and Western Railway Station (Western Warsaw). Ptak Warsaw Expo can be reached by car from the western station in just 13 minutes (according to Google).</p>
                ';} ?>
            </div>
        </div>

        <!-- custom-transport-item -->
        <div class="custom-route-transport-item custom-flex">
            <div class="custom-route-transport-item-img">
                <img class="custom-full-width" src="/wp-content/plugins/custom-element/my-custom-element/media/bus.png">
            </div>
            <div class="custom-route-transport-item-text">
                <?php if($locale == 'pl_PL'){ echo '
                    <h5>AUTOBUSEM MIEJSKIM</h5>
                    <p>Autobusy linii 703, 711 z zajezdni Krakowska P+R do przystanku „Paszków” lub autobus 733 do przystanku „Centrum Mody”. Uwaga! „Przystanek Paszków” <span>i „Centrum mody”</span> mieszczą się w II strefie biletowej. W bilety zaopatrzyć się można w większości kiosków, <span>w biletomatach</span> oraz autobusach.</p>
                ';} else { echo ' 
                    <h5>BY CITY BUS</h5>
                    <p>Buses 703, 711 from Krakowska P+R depot to the “Paszków” stop or bus 733 to the “Centrum Mody” stop. Please note that “Paszków” and “Centrum Mody” stops are located in the second ticket zone. Tickets can be purchased in most kiosks, ticket machines and buses.</p>
                ';} ?>
            </div>
        </div>

        <!-- custom-transport-item -->
        <div class="custom-route-transport-item custom-flex">
            <div class="custom-route-transport-item-img">
                <img class="custom-full-width" src="/wp-content/plugins/custom-element/my-custom-element/media/sedan.png">
            </div>
            <div class="custom-route-transport-item-text">
                <?php if($locale == 'pl_PL'){ echo '
                    <h5>SAMOCHODEM</h5>
                    <p>Ptak Warsaw Expo znajduje się bezpośrednio przy trasie S8 w kierunku na Katowice. Zjazd Paszków. Dojazd z okolic lotniska Okęcie zajmie około 10 minut. <span>Z centrum</span> Warszawy – 15 minut. Z parkowaniem nie będzie problemu, nasze centrum dysponuje 15 000 miejsc parkingowych!</p>
                ';} else { echo ' 
                    <h5>BY CAR</h5>
                    <p>Ptak Warsaw Expo is located directly at the S8 route in the direction of Katowice, Paszków exit. It will take about 10 minutes to get here from the Warsaw Okęcie airport. From downtown Warsaw – 15 minutes. Parking is not a problem, our center has 15,000 parking spaces!</p>
                ';} ?>
            </div>
        </div>
    </div>

</div>

</div>