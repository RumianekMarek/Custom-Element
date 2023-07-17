<div id='socialMedia' class='custom-container-socialMedia  text-centered drive'>
    <h4>
        <?php if($locale == 'pl_PL'){ echo '
            Śledź nas na social mediach i zyskaj
        ';} else { echo '
            Follow us on social media and gain
        ';} ?>
    </h4>

    <div class='custom-block-socialMedia'>
        <img class='absolute-facebook-Img' src='/wp-content/plugins/custom-element/my-custom-element/media/facebookIcon.png' alt='facebookIcon'/>
        <ul class='list-style-none' style='padding-left:0 !important;'>
            <?php if($locale == 'pl_PL'){ echo '
                <li> wiedzę </li>
                <li> kontakty </li>
                <li> rabaty </li>
            ';} else { echo '
                <li> knowledge </li>
                <li> contacts </li>
                <li> discounts </li>
            ';} ?>
        </ul> 
    </div>

    <span class='half-block-padding-top'><a class='custom-facebook custom-link btn border-width-0 shadow-black btn-accent btn-flat' href='[trade_fair_facebook]' alt='facebook link' target='_blank'><i class="fa fa-facebook fa-1x fa-fw"></i>Facebook</a></span>
</div>