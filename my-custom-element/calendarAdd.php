<div id='calendar-add' class='custom-container-calendar-main text-centered style-accent-bg'>
    <div class='custom-inner-calendarAdd single-block-padding'>
        <div class='custom-header-calendarAdd'>
            <img src='/doc/logo.png'/>
            <div class='custom-header-text-calendarAdd pl_PL'>
                <h2 style="color:white !important; text-shadow: 2px 2px black;">[trade_fair_name]</h2>
                <h2 style="color:white !important; text-shadow: 2px 2px black;">[trade_fair_desc]</h2>
            </div>
            <div class='custom-header-text-calendarAdd en_US'>
                <h2 style="color:white !important; text-shadow: 2px 2px black;">[trade_fair_name_eng]</h2>
                <h2 style="color:white !important; text-shadow: 2px 2px black;">[trade_fair_desc_eng]</h2>
            </div>
        </div>
        <div class='custom-header-calendar-add text-centered'>
            <h1 class='bigtext' style="color:white !important; text-shadow: 2px 2px black;">
                <span class="text-uppercase bigtext-line0">
                    <span class="pl_PL">Dodaj do kalendarza</span>
                    <span class="en_US">Add to calendar</span>
                </span>
            </h1>
        </div> 

        <div class='custom-text-calendar-add text-centered pl_PL'>
            <h3 style="color:white !important; text-shadow: 2px 2px black;">Wybierz ikonę swojej poczty aby dodać wydarzenie do kalendarza.</h4>
        </div>
        <div class='custom-text-calendar-add text-centered en_US'>
            <h3 style="color:white !important; text-shadow: 2px 2px black;">Select your mail icon to add the event to your calendar.</h4>
        </div>
    </div>
    <div class='custom-inner-calendar-icons text-centered style-accent-bg'>
        <div class='custom-container-main-icons custom-container-calendar-icons custom-display-none'>
            <?php include plugin_dir_path(__FILE__) . 'calendarGoogle.html'; ?> 
            <?php include plugin_dir_path(__FILE__) . 'calendarOutlook.html'; ?>
            <?php include plugin_dir_path(__FILE__) . 'calendarApple.html'; ?>
            <?php include plugin_dir_path(__FILE__) . 'calendarOffice365.html'; ?>
            <?php include plugin_dir_path(__FILE__) . 'calendarYahoo.html'; ?>
        </div>
        <div class="custom-container-calendar-icons-empty double-bottom-padding double-top-padding custom-display-none">
            <h2 style="color:white !important; text-shadow: 2px 2px black; margin:0;" class='custom-uppercase text-centered pl_PL'>Nowa data wkrótce</h2>
            <h2 style="color:white !important; text-shadow: 2px 2px black; margin:0;" class='custom-uppercase text-centered en_US'>New date coming soon</h2>
        </div>
    </div>
</div>
