<?php 
    if ($color != '#ffffff'){
        $color = 'black';
    } else {
        $color = 'white';
        $filter ='filter: invert(100%);';
    }

    if ($btn_color != ''){
        $btn_color = '.custom_element_'.$rnd_id.' .custom-btn-container '.$btn_color;
    }
?> 
<style>

<?php echo $btn_color ?>

.custom-container-exhibitors-benefits{
    margin: 0 auto;
}
.custom-row-benefits {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.custom-benefits {
    width: 100%;
    display: flex;
    gap: 36px;
}
.custom-benefit-item {
    width: 33%;
}
.custom_element_<?php echo $rnd_id ?> .custom-benefit-img img {
    width: 100%;
    <?php echo $filter ?>
}
.custom_element_<?php echo $rnd_id ?> .custom-benefit-text p {
        padding:18px 0;
        color: <?php echo $color ?>
    }

@media (max-width:570px) {
    .custom-benefits {
        flex-direction: column;
    }
    .custom-benefit-item {
        width: 100%;
    }  
}
</style>
<div id="exhibitorsBenefits" class="custom-container-exhibitors-benefits">

    <div class="custom-row-border">
        <div class="border-top-left-<?php echo $color ?>"></div>
    </div>
        <!-- benefit-container -->
    <div class="custom-row-benefits">
        <div class="custom-benefits" style="justify-content: center;">
            <div class="custom-benefit-item">
                <div class="custom-benefit-img">
                <?php if($locale == 'pl_PL'){
                    echo '<img class="image-shadow" src="/wp-content/plugins/custom-element/my-custom-element/media/ulga_pl.png" alt="Strefa Networkingu">';
                } else {
                    echo '';
                } ?>
                </div>
                <?php if($locale == 'pl_PL'){
                    echo '<div class="custom-btn-container" style="padding: 18px;">
                        <span>
                            <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="https://warsawexpo.eu/dla-organizatorow/#ulga"  target="_blank">Zobacz szczegóły</a>
                        </span>
                    </div>';
                } else {
                    echo '';
                } ?>
            </div>
        </div>
    </div>
    <div class="custom-row-benefits">
        <div class="custom-benefits">

            <!-- benefit-item -->
            <div class="custom-benefit-item">
                <div class="custom-benefit-img">
                <?php if($locale == 'pl_PL'){
                    echo '<img class="image-shadow" src="/wp-content/plugins/custom-element/my-custom-element/media/Strefa_Networkingu.png" alt="Strefa Networkingu">';
                } else {
                    echo '<img class="image-shadow" src="/wp-content/plugins/custom-element/my-custom-element/media/Networking_Zone.png" alt="Networking Zone">';
                } ?>
                </div>
                <div class="custom-benefit-text uncode_text_column custom-align-left">
                <?php if($locale == 'pl_PL'){
                    echo '<p class="custom-line-height">Podczas targów dostępna będzie, specjalnie wydzielona <strong>strefa networkingu</strong> – przestrzeń do wymiany doświadczeń i zacieśnienia kontaktów. Spotkania branżowe to idealna okazja do poszerzenia grona potencjalnych partnerów biznesowych, a także zbudowania bazy odbiorców.</p>';
                } else {
                    echo '<p class="custom-line-height">During the fair, a specially separated networking zone will be available - a space for exchanging experiences and strengthening contacts. Industry meetings are an ideal opportunity to expand the group of potential business partners, as well as build a customer base.</p>';
                } ?>
                </div>
            </div>

            <!-- benefit-item -->
            <div class="custom-benefit-item">
                <div class="custom-benefit-img">
                <?php if($locale == 'pl_PL'){
                    echo '<img class="image-shadow" src="/wp-content/plugins/custom-element/my-custom-element/media/Panel_Edukacyjny.png" alt="Panel Edukacyjny">';
                } else {
                    echo '<img class="image-shadow" src="/wp-content/plugins/custom-element/my-custom-element/media/Educational_Panel.png" alt="Educational Panel">';
                } ?>
                </div>
                <div class="custom-benefit-text uncode_text_column custom-align-left">
                <?php if($locale == 'pl_PL'){
                    echo '<p class="custom-line-height">Liczne wystąpienia i konferencja branżowa prowadzona przez uznanych prelegentów – doświadczonych praktyków i znawców branży.</p>';
                } else {
                    echo '<p class="custom-line-height">Numerous speeches and an industry conference conducted by recognized speakers - experienced practitioners and industry experts.</p>';
                } ?>
            </div>
            </div>

            <!-- benefit-item -->
            <div class="custom-benefit-item">
                <div class="custom-benefit-img">
                <?php if($locale == 'pl_PL'){
                    echo '<img class="image-shadow" src="/wp-content/plugins/custom-element/my-custom-element/media/Pakiety_Powitalne.png" alt="Pakiety Powitalne">';
                } else {
                    echo '<img class="image-shadow" src="/wp-content/plugins/custom-element/my-custom-element/media/Welcome_Package.png" alt="Welcome Package">';
                } ?>
                </div>
                <div class="custom-benefit-text uncode_text_column custom-align-left">
                <?php if($locale == 'pl_PL'){
                    echo '<p class="custom-line-height">Przygotowanie identyfikatorów oraz indywidualnych pakietów powitalnych do wszystkich zarejestrowanych, które zostaną przesłane bezpośrednio pod adres podany w formularzu rejestracyjnym.</p>';
                } else {
                    echo '<p class="custom-line-height">Preparation of badges and individual welcome packages for all registered, which will be sent directly to the address provided in the registration form.</p>';
                } ?>
                </div>
            </div>

        </div>
    </div>

    <div class="custom-row-border">
        <div class="border-bottom-right-<?php echo $color ?>"></div>
    </div>
    
</div>


