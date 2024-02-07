<?php 
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Odbierz dane z tablicy $_POST
    $parametr1 = $_POST["parametr1"];
    $parametr2 = $_POST["parametr2"];

    // Możesz teraz użyć otrzymanych danych do dalszej obróbki
    echo "Odebrane dane:\n";
    echo "Parametr 1: " . $parametr1 . "\n";
    echo "Parametr 2: " . $parametr2 . "\n";
} else {
    // Jeśli dane nie zostały przesłane za pomocą POST, zwróć błąd
    echo "Błąd: Brak danych POST.";
}