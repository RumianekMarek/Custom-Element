
<?php 
    $exhibitorsImages = glob($_SERVER['DOCUMENT_ROOT'] . '/doc/galeria/*.{jpeg,jpg,png,JPG,JPEG,PNG}', GLOB_BRACE);
    include plugin_dir_url( __FILE__ ) . 'custom-element.php';
?>
<div id="forExhibitors"class="custom-container-exhibitors">

    <!-- for-exhibitors-item -->
    <div class="custom-content-exhibitors-item column-reverse custom-align-left">
        <div class="custom-exhibitors-text-block">
            <div class="custom-visitors-benefits-heading main-heading-text">
            <?php if($locale == 'pl_PL'){ echo '
                <h4>BĘDZIESZ CZĘŚCIĄ NAJSZYBCIEJ ROZWIJAJĄCYCH SIĘ TARGÓW</h4>
                ';} else { echo '
                <h4>YOU WILL BE PART OF THE FASTEST GROWING TRADE SHOW</h4>
                ';} ?>
            </div>
            <div class="custom-exhibitors-text">
                <p><?php if($locale == 'pl_PL'){
                    if($exhibitor1 == '') { 
                    echo 'Targi w PTAK WARSAW EXPO to innowacyjne wydarzenia, w których udział biorą wystawcy z Polski i z zagranicy. Targi wyróżnia dostępność ogromnej, największej w Polsce powierzchni wystawienniczej, dającej wystawcom najlepsze, bo wręcz nieograniczone możliwości prezentacji swojej oferty.';
                    } else { echo urldecode(base64_decode($exhibitor1));}
                } else { 
                    if($exhibitor1 == '') { echo "
                    The fair at PTAK WARSAW EXPO is an innovative event featuring exhibitors from Poland and abroad. The fair is distinguished by the availability of a huge, the largest exhibition area in Poland, giving exhibitors the best, because almost unlimited opportunities to present their offer.
                ";} else { echo urldecode(base64_decode($exhibitor1));}  }?></p>
            </div>
        </div>
        <div class="custom-exhibitors-image-block uncode-single-media-wrapper">              
            <?php
                $thirdImage = $exhibitorsImages[2];
                $shortPath = substr($thirdImage, strpos($thirdImage, '/doc/'));
                echo '<img class="image-shadow" src="' . $shortPath . '" alt="exhibitors image 1">';
            ?>
        </div>
    </div>

    <!-- for-exhibitors-item -->
    <div class="custom-content-exhibitors-item custom-align-left">
        <div class="custom-exhibitors-image-block uncode-single-media-wrapper">              
            <?php
                $fourthImage = $exhibitorsImages[3];
                $shortPath = substr($fourthImage, strpos($fourthImage, '/doc/'));
                echo '<img class="image-shadow" src="' . $shortPath . '" alt="exhibitors image 2">';
            ?>
        </div>
        <div class="custom-exhibitors-text-block">
            <div class="custom-visitors-benefits-heading main-heading-text">
                <?php if($locale == 'pl_PL'){ echo '
                <h4>ZAPREZENTUJESZ SWOJE PRODUKTY I USŁUGI TYSIĄCOM KONSUMENTÓW</h4>
                ';} else { echo '
                <h4>YOU WILL PRESENT YOUR PRODUCTS AND SERVICES TO THOUSANDS OF CONSUMERS</h4>
                ';} ?>
            </div>
            <div class="custom-exhibitors-text">
                <p><?php if($locale == 'pl_PL'){
                    if($exhibitor2 == '') { 
                    echo 'To tysiące Twoich potencjalnych klientów! Biorąc udział w targach, w charakterze wystawcy, masz aż trzy targowe dni na pokazanie im swoich produktów i usług. A to nie wszystko. Dzięki szerokiej kampanii promocyjnej oraz dużemu zainteresowaniu mediów Twój brand dotrze także do setek tysięcy ludzi w Polsce i za granicą.';
                    } else {echo urldecode(base64_decode($exhibitor2));}
                } else { 
                    if($exhibitor2 == '') { echo "
                    That’s thousands of your potential customers! By participating in the fair, as an exhibitor, you have up to three fair days to show them your products and services. And that’s not all. Thanks to an extensive promotional campaign and a lot of media attention, your brand will also reach hundreds of thousands of people in Poland and abroad.
                ";} else { echo urldecode(base64_decode($exhibitor2));}  }?>
                </p>
            </div>
        </div>
    </div>

    <!-- for-exhibitors-item -->
    <div class="custom-content-exhibitors-item column-reverse custom-align-left">
        <div class="custom-exhibitors-text-block">
            <div class="custom-visitors-benefits-heading main-heading-text">
                <?php if($locale == 'pl_PL'){ echo '
                <h4>ZDOBĘDZIESZ CENNĄ WIEDZĘ I POZNASZ NOWOŚCI RYNKU</h4>
                ';} else { echo '
                <h4>YOU WILL GAIN VALUABLE KNOWLEDGE AND LEARN ABOUT THE NOVELTIES OF THE MARKET</h4>
                ';} ?>
            </div>
            <div class="custom-exhibitors-text">
                <p><?php if($locale == 'pl_PL'){
                    if($exhibitor3 == '') { 
                    echo 'W biznesie nie możesz pozwolić sobie na stanie w miejscu. Podczas szkoleń, seminariów i konferencji branżowych zdobędziesz cenną wiedzę, którą będziesz mógł wykorzystać w praktyce, a odwiedzając nasze targi odkryjesz najnowsze rozwiązania sprzętowe i produktowe.';
                    } else {echo urldecode(base64_decode($exhibitor3));}
                } else { 
                    if($exhibitor3 == '') { echo "
                    In business, you can't afford to stand still. During training, seminars and industry conferences, you'll gain valuable knowledge that you can put into practice, and by visiting our trade shows you'll discover the latest equipment and product solutions.
                ";} else { echo urldecode(base64_decode($exhibitor3));}  }?>
                </p>
            </div>
        </div>
        <div class="custom-exhibitors-image-block uncode-single-media-wrapper">              
            <?php
                $fifthImage = $exhibitorsImages[4];
                $shortPath = substr($fifthImage, strpos($fifthImage, '/doc/'));
                echo '<img class="image-shadow" src="' . $shortPath . '" alt="exhibitors image 3">';
            ?>
        </div>
    </div>

    <!-- for-exhibitors-item -->
    <div class="custom-content-exhibitors-item custom-align-left">
        <div class="custom-exhibitors-image-block uncode-single-media-wrapper">              
            <?php
                $sixthImage = $exhibitorsImages[5];
                $shortPath = substr($sixthImage, strpos($sixthImage, '/doc/'));
                echo '<img class="image-shadow" src="' . $shortPath . '" alt="exhibitors image 4">';
            ?>
        </div>
        <div class="custom-exhibitors-text-block">
            <div class="custom-visitors-benefits-heading main-heading-text">
                <?php if($locale == 'pl_PL'){ echo '
                <h4>NAWIĄŻESZ CENNE KONTAKTY BIZNESOWE</h4>
                ';} else { echo '
                <h4>MAKE VALUABLE BUSINESS CONTACTS</h4>
                ';} ?>
            </div>
            <div class="custom-exhibitors-text">
                <p><?php if($locale == 'pl_PL'){
                    if($exhibitor4 == '') { 
                    echo 'Podczas targów przeprowadzisz rozmowy i zbudujesz cenne relacje biznesowe, które zaowocują nowymi kontraktami. Targi to jedyna taka okazja by nie tylko zbudować bazę nowych klientów, ale także by usłyszeć o ich potrzebach, co pozwoli na jeszcze lepsze dopasowanie oferty do oczekiwań odbiorców, co w efekcie wpłynie na zwiększenie zysków firmy.';
                    } else {echo urldecode(base64_decode($exhibitor4));}
                } else { 
                    if($exhibitor4 == '') { echo "
                    During the fair you will hold discussions and build valuable business relationships that will result in new contracts. Trade fairs are a one-of-a-kind opportunity not only to build a base of new customers, but also to hear about their needs, which will allow you to tailor your offer even better to your customers' expectations, which will ultimately increase your company's profits.
                ";} else { echo urldecode(base64_decode($exhibitor4));}  }?>
                </p>
            </div>
        </div>
    </div>

    <!-- for-exhibitors-item -->
    <div class="custom-content-exhibitors-item column-reverse custom-align-left">
        <div class="custom-exhibitors-text-block">
            <div class="custom-visitors-benefits-heading main-heading-text">
                <?php if($locale == 'pl_PL'){ echo '
                <h4>NAJWIĘKSZY OŚRODEK TARGOWY W POLSCE</h4>
                ';} else { echo '
                <h4>THE LARGEST TRADE FAIR CENTER IN POLAND</h4>
                ';} ?>
            </div>
            <div class="custom-exhibitors-text">
                <p><?php if($locale == 'pl_PL'){
                    if($exhibitor5 == '') { 
                    echo 'Ptak Warsaw Expo to największy i najnowocześniejszy kompleks targowy w Polsce, dedykowany wydarzeniom biznesowym, komercyjnym i rozrywkowym. Ideą jego powstania była organizacja targów, kongresów, szkoleń, imprez masowych i innych wydarzeń w oparciu o innowacyjny system wystawienniczy. Doskonała lokalizacja Ptak Warsaw Expo, usytuowanie obiektów 10 minut od największego w kraju portu lotniczego Lotnisko Chopina i 15 minut od ścisłego centrum Warszawy, sprawia, że PWE wypracowało sobie miano europejskiej stolicy biznesu.';
                    } else {echo urldecode(base64_decode($exhibitor5));}
                } else { 
                    if($exhibitor5 == '') { echo "
                    Ptak Warsaw Expo is the largest and most modern trade fair complex in Poland, dedicated to business, commercial and entertainment events. The idea behind its creation was to organize trade fairs, congresses, training courses, mass events and other events based on an innovative exhibition system. The excellent location of Ptak Warsaw Expo, situating the facilities 10 minutes from the country's largest airport, Chopin Airport, and 15 minutes from the very center of Warsaw, makes PWE earn its name as the European capital of business.
                ";} else { echo urldecode(base64_decode($exhibitor5));}  }?>
                </p>
            </div>
        </div>
        <div class="custom-exhibitors-image-block uncode-single-media-wrapper">              
            <?php
                $seventhImage = $exhibitorsImages[6];
                $shortPath = substr($seventhImage, strpos($seventhImage, '/doc/'));
                echo '<img class="image-shadow" src="' . $shortPath . '" alt="exhibitors image 5">';
            ?>
        </div>
    </div>

    <!-- for-exhibitors-item -->
    <div class="custom-content-exhibitors-item custom-align-left">
        <div class="custom-exhibitors-image-block uncode-single-media-wrapper">              
            <?php
                $eighthImage = $exhibitorsImages[7];
                $shortPath = substr($eighthImage, strpos($eighthImage, '/doc/'));
                echo '<img class="image-shadow" src="' . $shortPath . '" alt="exhibitors image 6">';
            ?>
        </div>
        <div class="custom-exhibitors-text-block">
            <div class="custom-visitors-benefits-heading main-heading-text">
                <?php if($locale == 'pl_PL'){ echo '
                <h4>O ORGANIZATORZE</h4>
                ';} else { echo '
                <h4>ABOUT THE ORGANISER</h4>
                ';} ?>
            </div>
            <div class="custom-exhibitors-text">
                <p><?php if($locale == 'pl_PL'){
                    if($exhibitor6 == '') { 
                    echo 'Nasza silna sieć kontaktów branżowych pozwala nam przyciągać na targi wystawców i sponsorów, zapewniając Państwu dostęp do najnowszych i najbardziej innowacyjnych produktów i usług w swojej branży. Zawsze szukamy nowych i ekscytujących sposobów na zwiększenie wrażeń z targów, zapewniając, że są one świeże i ekscytujące dla uczestników.
                    Nasz zespół jest elastyczny, potrafi dostosować się do zmieniających się okoliczności i nieprzewidzianych wyzwań, które mogą pojawić się podczas imprezy. Szybko podejmujemy decyzje i podejmujemy działania, aby targi przebiegły sprawnie i wszyscy mieli pozytywne doświadczenia.';
                    } else {echo urldecode(base64_decode($exhibitor6));} 
                } else { 
                    if($exhibitor6 == '') { echo "
                    Our strong network of industry contacts allows us to attract exhibitors and sponsors to the show, providing you with access to the latest and most innovative products and services in your industry. We are always looking for new and exciting ways to enhance the trade show experience, ensuring that it is fresh and exciting for attendees.
                    Our team is flexible, able to adapt to changing circumstances and unforeseen challenges that may arise during an event. We are quick to make decisions and take action so that the trade show runs smoothly and everyone has a positive experience.
                ";} else { echo urldecode(base64_decode($exhibitor6));}  }?>
                </p>
            </div>
        </div>
    </div>
</div>