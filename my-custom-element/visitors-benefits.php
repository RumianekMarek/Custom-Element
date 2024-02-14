<?php 
if ($color != '#ffffff'){
    $color = '#000000 !important';
}

?>
<style>
.custom_element_<?php echo $rnd_id ?> #visitorsBenefits :is(h3, h4){
    color: <?php echo $color ?>;
}
.custom-visitors-benefits-row {
    padding-top: 18px;
    width: 100%;
    text-align: center;
}
.custom-visitors-benefits {
    width: 100%;
    display: flex;
    justify-content: center;
    gap: 36px;
}
.custom-visitors-benefits-item {
    width: 33%;
}
@media (max-width:768px) {
    .custom-visitors-benefits {
        gap: 18px;
    }
    .custom-visitors-benefits-item-heading h4 {
        font-size: 16px;
    }
}
@media (max-width:570px) {
    .custom-visitors-benefits {
        flex-direction: column;
    }
    .custom-visitors-benefits-item {
        width: 100%;
    }  
    .custom-visitors-benefits-item-heading h4 {
        font-size: 20px;
    }
} 
</style>
<div id="visitorsBenefits"class="custom-container-visitors-benefits">

    <div class="custom-visitors-benefits-heading main-heading-text">
        <h3>
            <?php if($locale == 'pl_PL'){ echo '
                DLACZEGO WARTO?
            ';} else { echo '
                WHY IS IT WORTH IT?
            ';} ?>
        </h3>
    </div>
    <div class="custom-visitors-benefits-row">
        <div class="custom-visitors-benefits">

            <!-- benefit-item -->
            <div class="custom-visitors-benefits-item">
                <div class="custom-visitors-benefits-item-img icon-accent">
                    <img src="/wp-content/plugins/custom-element/media/lamp-b-150x150.webp" alt="lamp">
                </div>
                <div class="custom-visitors-benefits-item-heading">
                    <h4 class="custom-line-height">
                        <?php if($locale == 'pl_PL'){ echo '
                            POZNASZ NAJNOWSZE TRENDY BRANŻOWE
                        ';} else { echo '
                            YOU WILL MEET THE LATEST INDUSTRY TRENDS
                        ';} ?>
                    </h4>
                </div>
            </div>

            <!-- benefit-item -->
            <div class="custom-visitors-benefits-item">
                <div class="custom-visitors-benefits-item-img icon-accent">
                    <img src="/wp-content/plugins/custom-element/media/hands-b-150x150.webp" alt="handshake">
                </div>
                <div class="custom-visitors-benefits-item-heading">
                    <h4 class="custom-line-height">
                        <?php if($locale == 'pl_PL'){ echo '
                            NAWIĄŻESZ NOWE KONTAKTY BIZNESOWE
                        ';} else { echo '
                            YOU WILL MAKE NEW BUSINESS CONTACTS
                        ';} ?>
                    </h4>
                </div>
            </div>

            <!-- benefit-item -->
            <div class="custom-visitors-benefits-item">
                <div class="custom-visitors-benefits-item-img icon-accent">
                    <img src="/wp-content/plugins/custom-element/media/head-b-150x150.webp" alt="head">
                </div>
                <div class="custom-visitors-benefits-item-heading">
                    <h4 class="custom-line-height">
                        <?php if($locale == 'pl_PL'){ echo '
                            ZDOBĘDZIESZ CENNĄ WIEDZĘ I POZNASZ NOWOŚCI RYNKU
                        ';} else { echo '
                            YOU WILL GAIN VALUABLE KNOWLEDGE AND LEARN ABOUT MARKET NEWS
                        ';} ?>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>