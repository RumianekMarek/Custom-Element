<?php 
if ($color != '#ffffff'){
    $color = '#000000 !important';
}
if ($btn_color != ''){
    $btn_color = '.custom_element_'.$rnd_id.' '.$btn_color;
}
?>
<style>
    
<?php echo $btn_color ?>

#socialMedia{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border: 1px solid black;
    min-height: 270px;
    max-width: 500px;
    margin:auto;
    min-width: 250px;
    position: relative;
}
.custom_element_<?php echo $rnd_id ?> #socialMedia h4{
    margin-top:0 !important;
    color: <?php echo $color ?>;
}
#socialMedia span{
    padding-top: 0;
}
.custom-block-socialMedia{
    display: flex;
    align-items: center;
    margin:18px 0 !important;
}
.custom_element_<?php echo $rnd_id ?> .custom-block-socialMedia ul{
    margin:0 !important;
    color: <?php echo $color ?>;
}
.absolute-facebook-Img{
    position: absolute;
    left:12%;
}
@media (max-width: 569px){
    .custom-facebook{
        transform-origin: center !important;
    }
}
@media (max-width: 380px){
    .absolute-facebook-Img{
        display: none;
    }
}

</style>
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

    <span><a class='custom-facebook custom-link btn border-width-0 shadow-black btn-accent btn-flat' href='[trade_fair_facebook]' alt='facebook link' target='_blank'><i class="fa fa-facebook fa-1x fa-fw"></i>&nbsp;Facebook</a></span>
</div>