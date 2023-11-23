<div id="voucher"class="custom-container-voucher">
    <div class="uncode-single-media-wrapper half-block-padding custom-min-media-wrapper" style="flex:1;">
        <div class="image-shadow"><div class="t-entry-visual"><img style="vertical-align: bottom;" src="/wp-content/plugins/custom-element/my-custom-element/media/voucher.jpg" alt="grafika przykładowego vouchera"/></div></div>
    </div>

    <div class="half-block-padding" style="flex:1;">
        <div class="heading-text el-text text-centered main-heading-text">
            <h4>
                <?php if($locale == 'pl_PL'){ echo '
                    ODBIERZ VOUCHER NA ZABUDOWĘ
                ';} else { echo '
                    RECEIVE A CONSTRUCTION VOUCHER
                ';} ?>
            </h4>
        </div>
        
    <?php
        if (!preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT'])) {
        echo '<p class="custom-line-height">';
            if($locale == 'pl_PL'){ echo '
                Z naszym kuponem masz pełną swobodę wyboru opcji, które najlepiej odpowiadają Twoim potrzebom. W ofercie znajdują się niestandardowe projekty stoisk, grafika i oznakowanie, podłogi i oświetlenie, meble, sprzęt AV i wiele innych. Wszystko, co musisz zrobić, to okazać nasz kupon przy zakupie, wartość zniżki zostanie uwzględniona w fakturze. Dzięki temu zaoszczędzisz pieniądze, a także zyskasz większą elastyczność i swobodę twórczą.
            ';} else { echo '
                With our coupon, you have complete freedom to choose the options that best suit your needs. We offer custom booth designs, graphics and signage, flooring and lighting, furniture, AV equipment and much more. All you need to do is present our coupon at the time of purchase, the value of the discount will be included in the invoice. This will save you money and give you more flexibility and creative freedom.
            ';}
        echo '</p>';
        }
    ?>

        <div class="custom-btn-container">
            <span>
                <?php if($locale == 'pl_PL'){ echo '
                    <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="/kontakt/"  target="_blank" style="color:white !important;">Zapytaj o voucher</a>
                ';} else { echo '
                    <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="/en/contact/"  target="_blank" style="color:white !important;">Ask for a voucher</a>
                ';} ?>
            </span>
        </div>
    </div>
</div>