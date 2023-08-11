<div id='calendar-add' class='custom-container-calendar-main text-centered style-accent-bg'>
    <div class='custom-inner-calendarAdd single-block-padding'>
        <div class='custom-header-calendarAdd'>
                <?php 
                    $exist = is_file($_SERVER['DOCUMENT_ROOT'] . '/doc/logo.png');
                    echo '<script>console.log("'.$exist.'")</script>';
                    
                    if($color == '#000000' && $locale == 'en_US' && file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-color-en.png')){
                        echo '<img src="/doc/logo-color-en.png"/>';
                    } elseif($color == '#000000' && $locale == 'pl_PL' && file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-color.png')){
                        echo '<img src="/doc/logo-color.png"/>';
                    } elseif ($locale == 'en_US' && file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/logo-en.png')){
                        echo '<img src="/doc/logo-en.png"/>';
                    } else {
                        echo '<img src="/doc/logo.png"/>';
                    }
                ?>   
            <div class='custom-header-text-calendarAdd'>
                <?php if($locale == 'pl_PL'){ echo '
                    <h2 style="color:white !important; text-shadow: 2px 2px black;">[trade_fair_name]</h2>
                    <h2 style="color:white !important; text-shadow: 2px 2px black;">[trade_fair_desc]</h2>
                ';} else { echo '
                    <h2 style="color:white !important; text-shadow: 2px 2px black;">[trade_fair_name_eng]</h2>
                    <h2 style="color:white !important; text-shadow: 2px 2px black;">[trade_fair_desc_eng]</h2>
                ';} ?>
            </div>
        </div>
        <div class='custom-header-calendar-add text-centered'>
            <h1 class='bigtext' style="color:white !important; text-shadow: 2px 2px black;">
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
                echo '<h3 style="color:white !important; text-shadow: 2px 2px black;">Wybierz ikonę swojej poczty aby dodać wydarzenie do kalendarza.</h3>';
            } else {
                echo '<h3 style="color:white !important; text-shadow: 2px 2px black;">Select your mail icon to add the event to your calendar.</h3>';
            } ?>
        </div>
    </div>
    <div class='custom-inner-calendar-icons text-centered style-accent-bg'>
        <div class='custom-container-main-icons custom-container-calendar-icons custom-display-none'>
            <?php include plugin_dir_path(__FILE__) . 'calendarGoogle.php'; ?> 
            <?php include plugin_dir_path(__FILE__) . 'calendarOutlook.php'; ?>
            <?php include plugin_dir_path(__FILE__) . 'calendarApple.php'; ?>
            <?php include plugin_dir_path(__FILE__) . 'calendarOffice365.php'; ?>
            <?php include plugin_dir_path(__FILE__) . 'calendarYahoo.php'; ?>
        </div>
        <div class="custom-container-calendar-icons-empty double-bottom-padding double-top-padding custom-display-none">
        <?php if($locale == 'pl_PL'){
            echo '<h2 style="color:white !important; text-shadow: 2px 2px black; margin:0;" class="custom-uppercase text-centered">Nowa data wkrótce</h2>';
        } else {
            echo '<h2 style="color:white !important; text-shadow: 2px 2px black; margin:0;" class="custom-uppercase text-centered">New date coming soon</h2>';
        } ?>
        </div>
    </div>
</div>