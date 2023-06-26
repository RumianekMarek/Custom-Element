<?php
// Kod funkcji dostępu do katalogu

function dostep_do_katalogu() {
    echo '<div class="wrap">';
    echo '<h1>/doc/</h1>';

    $katalog = ABSPATH . 'doc'; // Pełna ścieżka do katalogu
    
    // Wyświetl komunikat, jeśli jest dostępny w sesji
    if (isset($_SESSION['moja_wtyczka_komunikat'])) {
        echo '<p>' . $_SESSION['moja_wtyczka_komunikat'] . '</p>';
        unset($_SESSION['moja_wtyczka_komunikat']); // Usuń komunikat z sesji
    }
    
    if (is_dir($katalog)) {
        $pliki = scandir($katalog);

        // Sortuj pliki alfabetycznie z uwzględnieniem folderów jako pierwszych
        usort($pliki, function($a, $b) use ($katalog) {
            $sciezkaA = $katalog . '/' . $a;
            $sciezkaB = $katalog . '/' . $b;

            if (is_dir($sciezkaA) && !is_dir($sciezkaB)) {
                return -1; // $a jest folderem, $b nie jest, więc $a jest przed $b
            } elseif (!is_dir($sciezkaA) && is_dir($sciezkaB)) {
                return 1; // $a nie jest folderem, $b jest, więc $a jest po $b
            } else {
                return strcasecmp($a, $b); // Sortowanie alfabetyczne dla pozostałych plików/folderów
            }
        });

        // Wyświetl zawartość folderu
        echo '<ul>';
        foreach ($pliki as $plik) {
            if ($plik !== '.' && $plik !== '..') {
                $sciezka = $katalog . '/' . $plik;
                $ikona = is_dir($sciezka) ? 'dashicons-admin-home' : 'dashicons-media-default';
                echo '<li><span class="dashicons ' . $ikona . '"></span>' . $plik;
                
                // Dodaj formularz do usuwania pliku
                if (!is_dir($sciezka)) {
                    echo '<form action="' . admin_url('admin-post.php') . '" method="POST" style="display:inline">';
                    echo '<input type="hidden" name="action" value="usun_plik" />';
                    echo '<input type="hidden" name="plik" value="' . $plik . '" />';
                    echo '<input type="submit" value="Usuń" />';
                    echo '</form>';
                }
                
                echo '</li>';
            }
        }
        echo '</ul>';

        // Wyświetl formularz do przesyłania plików
        echo '<form action="' . admin_url('admin-post.php') . '" method="POST" enctype="multipart/form-data">';
        echo '<input type="hidden" name="action" value="dodaj_plik" />';
        echo '<input type="file" name="plik" />';
        echo '<input type="submit" value="Dodaj plik" />';
        echo '</form>';
    } else {
        echo '<br> Katalog nie istnieje.';
    }

    echo '</div>';
}

// Kod obsługujący żądanie dodawania pliku
function moja_wtyczka_dodaj_plik() {
    $katalog = ABSPATH . 'doc/'; // Pełna ścieżka do katalogu

    if (isset($_FILES['plik'])) {
        $plik = $_FILES['plik'];

        // Sprawdź, czy nie wystąpiły błędy podczas przesyłania pliku
        if ($plik['error'] === UPLOAD_ERR_OK) {
            $nazwa = $plik['name'];
            $lokalizacja = $plik['tmp_name'];

            // Przenieś plik do docelowego katalogu
            if (move_uploaded_file($lokalizacja, $katalog . $nazwa)) {
                $_SESSION['moja_wtyczka_komunikat'] = 'Plik został dodany.';
                wp_redirect(admin_url('admin.php?page=moja-wtyczka-dostep-do-katalogu')); // Przekierowanie do strony z zawartością katalogu
                exit;
            } else {
                $_SESSION['moja_wtyczka_komunikat'] = 'Wystąpił problem podczas dodawania pliku.';
                wp_redirect(admin_url('admin.php?page=moja-wtyczka-dostep-do-katalogu')); // Przekierowanie do strony z zawartością katalogu
                exit;
            }
        } else {
            $_SESSION['moja_wtyczka_komunikat'] = 'Wystąpił błąd podczas przesyłania pliku.';
            wp_redirect(admin_url('admin.php?page=moja-wtyczka-dostep-do-katalogu')); // Przekierowanie do strony z zawartością katalogu
            exit;
        }
    }
}

// Kod obsługujący żądanie usuwania pliku
function moja_wtyczka_usun_plik() {
    if (isset($_POST['plik'])) {
        $plik = $_POST['plik'];
        $katalog = ABSPATH . 'doc/'; // Pełna ścieżka do katalogu

        if (is_file($katalog . $plik)) {
            if (unlink($katalog . $plik)) {
                $_SESSION['moja_wtyczka_komunikat'] = 'Plik ' . $plik . ' został usunięty';
                wp_redirect(admin_url('admin.php?page=moja-wtyczka-dostep-do-katalogu')); // Przekierowanie do strony z zawartością katalogu
                exit;
            } else {
                $_SESSION['moja_wtyczka_komunikat'] = 'Wystąpił problem podczas usuwania pliku.';
                wp_redirect(admin_url('admin.php?page=moja-wtyczka-dostep-do-katalogu')); // Przekierowanie do strony z zawartością katalogu
                exit;
            }
        } else {
            $_SESSION['moja_wtyczka_komunikat'] = 'Nie można odnaleźć pliku.';
            wp_redirect(admin_url('admin.php?page=moja-wtyczka-dostep-do-katalogu')); // Przekierowanie do strony z zawartością katalogu
            exit;
        }
    }
}

add_action('admin_post_usun_plik', 'moja_wtyczka_usun_plik');
add_action('admin_post_nopriv_usun_plik', 'moja_wtyczka_usun_plik');

add_action('admin_post_dodaj_plik', 'moja_wtyczka_dodaj_plik');
add_action('admin_post_nopriv_dodaj_plik', 'moja_wtyczka_dodaj_plik');
?>
