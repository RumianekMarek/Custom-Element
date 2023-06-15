<?php
$filePath = $_SERVER['DOCUMENT_ROOT'] . '/doc/Iphone.ics';
$siteUrl = $_SERVER['HTTP_HOST'];
$trade_start = $_POST['trade_start']; 
$trade_end = $_POST['trade_end'];
$trade_name = $_POST['trade_name'];
$trade_desc = $_POST['trade_desc'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = 'BEGIN:VCALENDAR' . PHP_EOL .
        'VERSION:2.0' . PHP_EOL .
        'BEGIN:VEVENT' . PHP_EOL .
        'DTSTART:' . substr($trade_start, 0, 4) . substr($trade_start, 5, 2) . substr($trade_start, 8, 2) . 'T100000' . PHP_EOL .
        'DTEND:' . substr($trade_end, 0, 4) . substr($trade_end, 5, 2) . substr($trade_end, 8, 2) . 'T170000' . PHP_EOL .
        'SUMMARY:'. $trade_name . PHP_EOL .
        'DESCRIPTION:'. $trade_desc . PHP_EOL .
        'LOCATION:Al. Katowicka 62, 05-830 Nadarzyn' . PHP_EOL .
        'END:VEVENT' . PHP_EOL .
        'END:VCALENDAR' . PHP_EOL;
  
    // Zapisz nowe dane do pliku
    file_put_contents($filePath, $data);

    exit;
}
?>
