<?php 
if ($color != '#000000'){
    $color = '#ffffff';
    $shadow = '#000000';
} else {
    $shadow = '#ffffff';
}
?>
<style>
    .custom_element_<?php echo $rnd_id ?> #wydarzenia h1{
        color: <?php echo $color ?>;
        text-shadow: 2px 2px <?php echo $shadow ?>;
    }
    .custom-wydarzenia-header {
        background-image:url('/doc/background.jpg'); 
        background-position: center; 
        background-size: cover;
        background-repeat: no-repeat;
        padding: 100px 18px;
    }
    .custom-wydarzenia-header h1 {
        max-width: 1128px;
        margin: 0 auto;
    }
    .custom-wydarzenia-header h1 span {
        font-size: 54px;
    }
    @media (min-width: 300px) and (max-width: 1200px) {
        .custom-wydarzenia-header h1 span {
            font-size: calc(24px + (54 - 24) * ( (100vw - 300px) / (1200 - 300) ));
        }
    }
    .media-logos .custom-logos-gallery-wrapper{
        padding-top: 0 !important;
    }
</style>
<div id="wydarzenia" class="custom-wydarzenia">
    <div class="custom-wydarzenia-header">
        <h1 class="text-uppercase text-centered">
        <?php if($locale == 'pl_PL'){ echo '
                <span>Kongres Branży<br>[trade_fair_opisbranzy]</span>
            ';} else { echo '
                <span>Trade congress<br>[trade_fair_opisbranzy_eng]</span>
            ';} 
        ?>
        </h1>
    </div>
    <div class="custom-width-limit single-block-padding">
        <?php if($locale == 'pl_PL'){ echo '
            <p>Zapraszamy na specjalistyczną Konferencję, która odbędzie się w ramach międzynarodowych targów [trade_fair_name]. Tematyka spotkania skupiać się będzie na najnowszych trendach, innowacjach i wyzwaniach w branży [trade_fair_opisbranzy]. W jej programie znajdziecie Państwo prelekcje ekspertów, panele dyskusyjne, warsztaty oraz prezentacje firm powiązanych sektorem.</p>
            <p>Nasze forum dyskusyjne będzie integralną częścią targów, co pozwoli uczestnikom na korzystanie z pełnego wachlarza możliwości, jakie niesie za sobą międzynarodowa wystawa. Udział w nim to doskonała okazja, aby podyskutować z liderami rynkowymi, nawiązać cenne kontakty biznesowe i poznać najnowsze trendy z branży.</p>
            <p>Celem wydarzenia jest stworzenie platformy spotkań i rozmów dla specjalistów, przedsiębiorców i pasjonatów branży, którzy chcą wymieniać się wiedzą, doświadczeniami oraz nawiązywać nowe kontakty biznesowe.</p>
            <p>Ramowy program Konferencji podczas [trade_fair_name]:</p>
        ';} else { echo '
            <p>We invite you to a specialized Conference that will take place as part of the international [trade_fair_name_eng] trade fair. The meeting will focus on the latest trends, innovations, and challenges in the [trade_fair_opisbranzy_eng] industry. The conference program will include expert lectures, panel discussions, workshops, and presentations by companies associated with the sector.</p>
            <p>Our discussion forum will be an integral part of the trade fair, allowing participants to take advantage of the full range of opportunities that an international exhibition offers. Participating in the forum is an excellent opportunity to engage in discussions with industry leaders, establish valuable business contacts, and learn about the latest trends in the field.</p>
            <p>The event aims to provide a platform for industry professionals, entrepreneurs and enthusiasts to meet and talk with each other to exchange knowledge, experiences and make new business contacts.</p>
            <p>Outline of the Conference program during [trade_fair_name_eng]:</p>
        ';} ?>
        <ul>
            <?php if($locale == 'pl_PL'){ echo '
                <li>Najnowsze trendy i innowacje w branży [trade_fair_opisbranzy]</li>
                <li>Digitalizacja i automatyzacja sektora</li>
                <li>Nowe technologie w produkcji i procesach logistycznych</li>
                <li>Wyzwania związane z zrównoważonym rozwojem branży [trade_fair_opisbranzy]</li>
                <li>Przykłady dobrych praktyk – prezentacje firm</li>
                <li>Przyszłość branży [trade_fair_opisbranzy]: prognozy i wyzwania</li>
                <li>Zarządzanie produktem: najlepsze praktyki i trendy</li>
                <li>Inwestycje i finansowanie w sektorze branżowym</li>
            ';} else { echo '
                <li>Latest trends and innovations in the [trade_fair_opisbranzy_eng] industry</li>
                <li>Digitalization and automation in the sector</li>
                <li>New technologies in production and logistics processes</li>
                <li>Challenges related to sustainable development in the [trade_fair_opisbranzy_eng] industry</li>
                <li>Best practice examples - company presentations</li>
                <li>The future of the [trade_fair_opisbranzy_eng] industry: forecasts and challenges</li>
                <li>Product management: best practices and trends</li>
                <li>Investments and financing in the industry sector</li>
                ';} ?>
        </ul>
        <p>
            <?php if($locale == 'pl_PL'){ echo '
                    Te tematy pomogą uczestnikom poznać aktualne zmiany w branży [trade_fair_opisbranzy], a także nawiązać cenne kontakty biznesowe i wymienić się wiedzą z innymi specjalistami z tej dziedziny.
                ';} else { echo '
                    These topics will help participants understand the current changes in the [trade_fair_opisbranzy_eng] industry, establish valuable business contacts, and exchange knowledge with other specialists in the field.
            ';} ?>
        </p>
    </div>
    <?php if($logoscatalog != ''){ ?>
        <div class="media-logos text-centered custom-width-limit single-block-padding">
            <h2>
                <?php if($locale == 'pl_PL'){ echo '
                    PARTNERZY MEDIALNI
                ';} else { echo '
                    MEDIA PATRONAGE
                ';} ?>
            </h2>
            <?php include 'logos-catalog.php'; ?>
        </div>
    <?php } ?>
</div>