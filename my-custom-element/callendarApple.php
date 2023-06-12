<?php
$filePath = $_SERVER['DOCUMENT_ROOT'] . '/doc/Iphone.ics';
$siteUrl = $_SERVER['HTTP_HOST'];
$start = $_POST['start']; 
$end = $_POST['end'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = 'BEGIN:VCALENDAR' . PHP_EOL .
        'VERSION:2.0' . PHP_EOL .
        'BEGIN:VEVENT' . PHP_EOL .
        'DTSTART:' . substr($start, 0, 4) . substr($start, 5, 2) . substr($start, 8, 2) . 'T100000' . PHP_EOL .
        'DTEND:' . substr($end, 0, 4) . substr($end, 5, 2) . substr($end, 8, 2) . 'T170000' . PHP_EOL .
        'SUMMARY:[trade_fair_name]' . PHP_EOL .
        'DESCRIPTION:[trade_fair_desc]' . PHP_EOL .
        'LOCATION:Al. Katowicka 62, 05-830 Nadarzyn' . PHP_EOL .
        'END:VEVENT' . PHP_EOL .
        'END:VCALENDAR' . PHP_EOL;
  
    // Zapisz nowe dane do pliku
    file_put_contents($filePath, $data);
  
    // Pobierz plik
    echo '<script>
        function downloadFile(url) {
            var newTab = window.open(url, "_blank");
            newTab.onload = function() {
                newTab.close();
            };
        }
      
        // Wywołanie funkcji downloadFile z podanym URL pliku
        downloadFile("/doc/Iphone.ics");
      </script>';

    exit;
}
?>