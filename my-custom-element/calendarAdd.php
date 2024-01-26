<?php 
if ($color != '#000000'){
    $color = '#ffffff !important';
    $text_shadow = '2px 2px #000000;';
} else {
    $filter ='#download img{
        filter: invert(100%);
      }';
}
?> 
<style>
    .row-parent:has(.custom_element_<?php echo $rnd_id ?> #calendar-add) {
        max-width: 100%;
        padding: 0 !important;
    }
    #calendar-add{
        background: no-repeat;
        background-size: cover;
        background-image:url('<?php echo file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/background.webp') ? '/doc/background.webp' : '/doc/background.jpg'; ?>');
        width: 100%;
    }
    .custom_element_<?php echo $rnd_id ?> #calendar-add :is(h2, h1, h3){
        color: <?php echo $color ?>;  
        text-shadow: <?php echo $text_shadow ?>;
        font-weight:700;
    }
    .custom-container-calendar-icons, .custom-header-calendarAdd{
        display: flex;
        justify-content: center;
        gap:30px;
        margin-top: 20px;
    }
    .custom-inner-calendarAdd, .custom-container-calendar-icons{
        max-width: 1200px;
    }
    .custom-inner-calendarAdd img {
        object-fit: contain;
        max-width: 300px !important;
    }
    .custom-container-calendar-icons{ 
        top:-30px;
        position: relative; 
    }
    .custom-inner-calendar-icons{
        margin-top:30px;
    }
    .custom-container-calendar-add{
        flex:1;
        min-width: 100px;
        max-width: 180px;
        background: white;
        padding:5px 0;
    }
    .custom-container-calendar-add p{
        color:black;
        margin:5px;
        line-height: 1.2;
    }
    .custom-container-calendar-add img, .custom-header-calendarAdd img{
        max-height: 150px;
        width: auto;
        max-width:100%;
    }
    @media (max-width:959px){
        .custom-container-calendar-icons{
            padding: 10px;
        }
    }
    @media (max-width:570px){
        .custom-container-calendar-icons, .custom-header-calendarAdd {
            flex-wrap: wrap;
        }
        .custom-container-calendar-add{
            min-width: 35%;
            max-width: 130px;
        }
        .custom-container-calendar-add img{
            max-height: 100px;
        }  
    }
</style>
<div id='calendar-add' class='custom-container-calendar-main text-centered style-accent-bg'>
    <div class="custom-calendar-wrapper">
        <div class='custom-inner-calendarAdd single-block-padding'>
            <div class='custom-header-calendarAdd'>
                    <?php
                        if ($color == '#000000' && $locale == 'en_US') {
                            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-color-en.webp')) {
                                echo '<img src="/doc/logo-color-en.webp"/>';
                            } elseif (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-color-en.png')) {
                                echo '<img src="/doc/logo-color-en.png"/>';
                            } elseif (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-color.webp')) {
                                echo '<img src="/doc/logo-color.webp"/>';
                            } elseif (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-color.png')) {
                                echo '<img src="/doc/logo-color.png"/>';
                            }
                        } elseif ($color == '#000000' && $locale == 'pl_PL') {
                            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-color.webp')) {
                                echo '<img src="/doc/logo-color.webp"/>';
                            } elseif (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-color.png')) {
                                echo '<img src="/doc/logo-color.png"/>';
                            }
                        } elseif ($locale == 'en_US') {
                            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-en.webp')) {
                                echo '<img src="/doc/logo-en.webp"/>';
                            } elseif (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-en.png')) {
                                echo '<img src="/doc/logo-en.png"/>';
                            } elseif (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo.webp')) {
                                echo '<img src="/doc/logo.webp"/>';
                            } elseif (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo.png')) {
                                echo '<img src="/doc/logo.png"/>';
                            }
                        } else {
                            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo.webp')) {
                                echo '<img src="/doc/logo.webp"/>';
                            } elseif (file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo.png')) {
                                echo '<img src="/doc/logo.png"/>';
                            }
                        }
                        
                    ?>   
                <div class='custom-header-text-calendarAdd'>
                    <?php if($locale == 'pl_PL'){ echo '
                        <h2>[trade_fair_name]</h2>
                        <h2>[trade_fair_desc]</h2>
                    ';} else { echo '
                        <h2>[trade_fair_name_eng]</h2>
                        <h2>[trade_fair_desc_eng]</h2>
                    ';} ?>
                </div>
            </div>
            <div class='custom-header-calendar-add text-centered'>
                <h1 class='bigtext'>
                    <span class="text-uppercase bigtext-line0">
                    <?php if($locale == 'pl_PL'){
                        echo '<span>Dodaj do kalendarza</span>';
                    } else {
                        echo '<span>Add to calendar</span>';
                    } ?>
                    </span>
                </h1>
            </div> 

            <div class='custom-text-calendar-add text-centered'>
                <?php if($locale == 'pl_PL'){
                    echo '<h3>Wybierz ikonę swojej poczty aby dodać wydarzenie do kalendarza.</h3>';
                } else {
                    echo '<h3>Select your mail icon to add the event to your calendar.</h3>';
                } ?>
            </div>
        </div>
        <div class='custom-inner-calendar-icons text-centered style-accent-bg'>
            <div class='custom-container-main-icons custom-container-calendar-icons custom-display-none'>
                <?php include plugin_dir_path(__FILE__) . 'calendarGoogle.php'; ?> 
                <?php include plugin_dir_path(__FILE__) . 'calendarApple.php'; ?>
                <?php include plugin_dir_path(__FILE__) . 'calendarOutlook.php'; ?>
                <?php include plugin_dir_path(__FILE__) . 'calendarOffice365.php'; ?>
                <!-- <?php include plugin_dir_path(__FILE__) . 'calendarYahoo.php'; ?> -->
            </div>
            <div class="custom-container-calendar-icons-empty double-bottom-padding double-top-padding custom-display-none">
            <?php if($locale == 'pl_PL'){
                echo '<h2 style="margin:0;" class="custom-uppercase text-centered">Nowa data wkrótce</h2>';
            } else {
                echo '<h2 style="margin:0;" class="custom-uppercase text-centered">New date coming soon</h2>';
            } ?>
            </div>
        </div>
    </div>
</div>