<?php 
    include_once plugin_dir_path(__FILE__) . '/main-custom-element.php';

    $linker = 'https://outlook.live.com/calendar/0/action/compose?body='.urlencode($trade_desc).'&enddt='.substr($trade_end,0,4).'-'.substr($trade_end,5,2).'-'.substr($trade_end,8,2).'T17%3A00%3A00%3A00&location='.urlencode('Aleja Katowicka 62, 05-830 Nadarzyn').'&path=%2Fcalendar%2Faction%2Fcompose&rru=addevent&startdt='.substr($trade_start,0,4).'-'.substr($trade_start,5,2).'-'.substr($trade_start,8,2).'T10%3A00%3A00%3A00&subject='.urlencode($trade_name);
    
    echo '<div id="calendar-office" class="custom-container-calendar-add text-centered">';
        echo '<a class="office" alt="link do kalendarza office" href="' . $linker . '" target="_blank">';
            echo '<img src="/wp-content/plugins/custom-element/media/office365.png" alt="ikonka Office 365"/>';
            if ($locale == 'pl_PL'){
            echo '<p class="font-weight-700">Kalendarz<br>Office</p>';
            } else {
            echo '<p class="font-weight-700">Office<br>Calendar</p>';
            }
        echo '</a>';
   echo '</div>';
?>
