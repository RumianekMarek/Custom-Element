<?php
    
    $data = 'BEGIN:VCALENDAR' . PHP_EOL .
            'VERSION:2.0' . PHP_EOL .
            'BEGIN:VEVENT' . PHP_EOL .
            'DTSTART:' . substr($trade_start, 0, 4) . substr($trade_start, 5, 2) . substr($trade_start, 8, 2) . 'T100000' . PHP_EOL .
            'DTEND:' . substr($trade_end, 0, 4) . substr($trade_end, 5, 2) . substr($trade_end, 8, 2) . 'T170000' . PHP_EOL .
            'SUMMARY:' . $trade_name . PHP_EOL .
            'DESCRIPTION:' . $trade_desc . PHP_EOL .
            'LOCATION:Al. Katowicka 62, 05-830 Nadarzyn' . PHP_EOL .
            'END:VEVENT' . PHP_EOL .
            'END:VCALENDAR' . PHP_EOL;
    
    $filePath = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/custom-element/media/Iphone.ics';
    $fileSaved = file_put_contents($filePath, $data);

echo '<div id="calendar-apple" class="custom-container-calendar-add text-centered">';
    echo '<a class="apple" alt="link do kalendarza apple" href="/wp-content/plugins/custom-element/media/Iphone.ics">';
        echo '<img alt="ikonka apple" src="/wp-content/plugins/custom-element/media/apple.png"/>';
        if ($locale == 'pl_PL') {
            echo '<p class="font-weight-700">Kalendarz<br>Apple</p>';
        } else {
            echo '<p class="font-weight-700">Apple<br>Calendar</p>';
        }
    echo '</a>';
echo '</div>';
?>
