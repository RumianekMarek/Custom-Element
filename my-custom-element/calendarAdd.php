<div id='calendar-add' class='custom-container-calendar-main text-centered'>
    <div class='custom-header-calendar-add text-centered bigtext pl_PL'>
        <h1 class="bigtext-line0 text-uppercase">Dodaj do kalendarza</h1>
    </div> 
    <div class='custom-header-calendar-add text-centered bigtext en_US'>
        <h1 class="bigtext-line0 text-uppercase">Add to calendar</h1>
    </div>

    <div class='custom-text-calendar-add text-centered pl_PL'>
        <h3>Wybierz ikonę swojej poczty aby dodać wydarzenie do kalendarza.</h4>
    </div>
    <div class='custom-text-calendar-add text-centered en_US'>
        <h3>Select your mail icon to add the event to your calendar.</h4>
    </div>

    <div class='custom-container-calendar-icons text-centered'>
        <?php include plugin_dir_path(__FILE__) . 'calendarGoogle.html'; ?> 
        <?php include plugin_dir_path(__FILE__) . 'calendarOutlook.html'; ?>
        <?php include plugin_dir_path(__FILE__) . 'calendarOffice365.html'; ?>
        <?php include plugin_dir_path(__FILE__) . 'calendarYahoo.html'; ?>
        <?php include plugin_dir_path(__FILE__) . 'calendarApple.html'; ?>
    </div>
</div>
