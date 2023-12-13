<?php
date_default_timezone_set('Europe/Warsaw');
$current_date = date("Y-m-d H:i:s");
?>

<div id='main-timer' class='custom-container-main-timer style-accent-bg' style='color:white !important;'>
    <div class='custom-main-timer-before'>
        <p class='text-uppercase'>
            <?php if((strtotime($trade_start) - strtotime($current_date)) >= 0 || (strtotime($trade_end) - strtotime($current_date)) <= 0){
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
            if(strtotime($trade_start) - strtotime($current_date) >= 604800){
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