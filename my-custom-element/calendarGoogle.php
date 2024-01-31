<?php 
    include_once plugin_dir_path(__FILE__) . '/main-custom-element.php';

    $linker = 'https://calendar.google.com/calendar/render?action=TEMPLATE&details=' . urlencode($trade_desc) . '&dates=' . substr($trade_start, 0, 4) . substr($trade_start, 5, 2) . substr($trade_start, 8, 2) . 'T100000%2F' . substr($trade_end, 0, 4) . substr($trade_end, 5, 2) . substr($trade_end, 8, 2) . 'T170000?0&location=Aleja%20Katowicka%2062%2C%2005-Aleja%20Katowicka%2062%2C%2005-830%20Nadarzyn%2C%20Polska&text=' . urlencode($trade_name);
    
    echo '<div id="calendar-google" class="custom-container-calendar-add text-centered">';
        echo '<a class="google" alt="link do kalendarza google" href="' . $linker . '" target="_blank">';
            echo '<img src="/wp-content/plugins/custom-element/media/googlecalendar.png" alt="ikonka google calendar"/>';
            if ($locale == 'pl_PL'){
            echo '<p class="font-weight-700">Kalendarz<br>Google</p>';
            } else {
            echo '<p class="font-weight-700">Google<br>Calendar</p>';
            }
        echo '</a>';
   echo '</div>';
?>