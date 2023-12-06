<?php 
if ($color != '#000000'){
    $color = '#ffffff';
}
if ($btn_color != ''){
    $btn_color = '#main-timer ' . $btn_color;
}
?>

<style>
    #main-timer p{
        color: <?php echo $color ?>;
    }
    <?php echo $btn_color ?>
    .row-container:has(.custom-container-main-timer) .row-parent {
        padding: 0 !important;
    }
    .custom-main-timer-before,
    .custom-main-timer-after {
        display: flex;
        justify-content: space-evenly;
        flex-wrap: wrap;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        gap: 8px
    }
    .main-timer-countdown {
        text-align: center;
        font-weight: 700;
        width: max-content;
    }
    #customBtn {
        transform-origin: center !important;
    }
    .custom-main-timer-before p,
    .custom-main-timer-after p {
        margin: 0 !important;
        font-size: 20px;
    }
    .custom-main-timer-btn {
        padding: 8px 0;
    }
    @media (max-width:570px){
        .custom-main-timer-before p,
        .custom-main-timer-after p {
            font-size: 16px;
        }
    }
</style>

<div id='main-timer' class='custom-container-main-timer style-accent-bg' style='color:white !important;'>
    <div class='custom-main-timer-before'>
        <p class='text-uppercase'>
            <?php if(strtotime($trade_start)-strtotime('+2 hour', time()) >= 0 || strtotime($trade_end)-strtotime('+2 hour', time()) <= 0 ){
                if($locale == 'pl_PL'){
                    echo 'Do targów pozostało:';
                } else {
                    echo 'Until the start of the fair:';
                }
            } else {
                if($locale == 'pl_PL'){
                    echo 'Do końca targów pozostało:';
                } else {
                    echo 'Until the end of the fair:';
                }
            } ?>
        </p>
        <?php include plugin_dir_path(__FILE__) . 'countdown.php'; ?>
        <span class='custom-main-timer-btn'>
            <?php 
            if(strtotime($trade_start)-strtotime('+2 hour', time()) >= 604800){
                if($locale == 'pl_PL'){
                    echo "<a id='customBtn' class='custom-link btn border-width-0 btn-flat btn-custom-black' href='/zostan-wystawca/'>Zostań wystawcą</a>";
                } else {
                    echo "<a id='customBtn' class='custom-link btn border-width-0 btn-flat btn-custom-black' href='/en/become-an-exhibitor'>Book a stand</a></span>";
                }
            } else {
                if($locale == 'pl_PL'){
                    echo "<a id='customBtn' class='custom-link btn border-width-0 btn-flat btn-custom-black' href='/rejestracja/'>Zarejestruj się<span style='display: block; font-weight: 300;'>Odbierz darmowy bilet</span></a>";
                } else {
                    echo "<a id='customBtn' class='custom-link btn border-width-0 btn-flat btn-custom-black' href='/en/registration/'>REGISTER<span style='display: block; font-weight: 300;'>GET A FREE TICKET</span></a></span>";
                }
            } 
            ?>
        </span>
    </div>
</div>