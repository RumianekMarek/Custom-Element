<div id='onlyCalendar' class='custom-container-onlyCalendar custom-display-none text-centered'>
    <div class='half-block-padding'>
    <?php if ($locale == 'pl_PL') {
        echo '<h3>Nie przegap targów, dodaj datę do kalendarza</h3>';
    } else {
        echo "<h3>Don't miss the fair, add the date to your calendar</h3>";
    } ?>
    </div>
    <div class='custom-container-calendar-icons single-top-padding'>
        <?php include plugin_dir_path(__FILE__) . 'calendarGoogle.php'; ?> 
        <?php include plugin_dir_path(__FILE__) . 'calendarOutlook.php'; ?>
        <?php include plugin_dir_path(__FILE__) . 'calendarApple.php'; ?>
        <?php include plugin_dir_path(__FILE__) . 'calendarOffice365.php'; ?>
        <!-- <?php include plugin_dir_path(__FILE__) . 'calendarYahoo.php'; ?> -->
    </div>
</div>