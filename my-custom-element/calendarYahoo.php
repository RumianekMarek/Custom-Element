<?php 
    include_once plugin_dir_path(__FILE__) . '/main-custom-element.php';
    
    if ($locale == 'pl_PL') {
        $linker = 'https://calendar.yahoo.com/?desc='.urlencode($trade_desc).'&dur=&et='.substr($trade_end,0,4).substr($trade_end,5,2).substr($trade_end,8,2).'T170000&in_loc='.urlencode('Aleja Katowicka 62, 05-830 Nadarzyn').'&st='.substr($trade_start,0,4).substr($trade_start,5,2).substr($trade_start,8,2).'T100000&title='.urlencode($trade_name).'&v=60';
    } else {
        $linker = 'https://calendar.yahoo.com/?desc='.urlencode($trade_desc_en).'&dur=&et='.substr($trade_end,0,4).substr($trade_end,5,2).substr($trade_end,8,2).'T170000&in_loc='.urlencode('Aleja Katowicka 62, 05-830 Nadarzyn').'&st='.substr($trade_start,0,4).substr($trade_start,5,2).substr($trade_start,8,2).'T100000&title='.urlencode($trade_name_en).'&v=60';
    }
    echo '<div id="calendar-yahoo" class="custom-container-calendar-add text-centered">';
        echo '<a class="yahoo" alt="link do kalendarza yahoo" href="' . $linker . '" target="_blank">';
            echo '<img src="/wp-content/plugins/custom-element/media/yahoo.png" alt="ikonka Yahoo"/>';
            if ($locale == 'pl_PL'){
            echo '<p class="font-weight-700">Kalendarz<br>Yahoo</p>';
            } else {
            echo '<p class="font-weight-700">Yahoo<br>Calendar</p>';
            }
        echo '</a>';
   echo '</div>';    
?>