<?php
// Kod funkcji dostępu do katalogu
session_start();

function dostep_do_katalogu() {
    echo '<div class="wrap main-container-dostepFTP">';
    echo '<h1 class="main-header-dostepFTP">/doc/' . $_GET['folder'] . '</h1>';

    $katalog = ABSPATH . 'doc'; // Pełna ścieżka do katalogu
    
    // Wyświetl komunikat, jeśli jest dostępny w sesji
    if (isset($_SESSION['komunikat'])) {
        echo '<p class="komunikat">' . $_SESSION['komunikat'] . '</p>';
        unset($_SESSION['komunikat']);
    }

    $folder = isset($_GET['folder']) ? $_GET['folder'] : '';
    $katalog .= '/' . $folder; // Dodaj folder do ścieżki katalogu

    if (!empty($folder)) {

        $segments = explode('/', $folder); // Podziel ścieżkę na segmenty
        array_pop($segments); // Usuń ostatni segment
        $folderBack = implode('/', $segments); // Ponownie połącz segmenty w nową ścieżkę
        $katalog .= '/'; // Dodaj zaktualizowany folder do ścieżki katalogu

        $link_powrotu = admin_url('admin.php?page=moja-wtyczka-dostep-do-katalogu&folder=' . urlencode($folderBack));

        echo '<a class="powrot" href="' . $link_powrotu . '">Powrót</a>';
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
                $next_url = isset($_GET['folder']) && $_GET['folder'] !== '' ? $_GET['folder'] . '/' . $plik : $plik;
                $sciezka = ABSPATH . 'doc/' . $next_url;
                $ikona = is_dir($sciezka) ? 'dashicons-admin-home' : 'dashicons-media-default';

                if (is_dir($sciezka)) {
                    echo '<li class="folder"><div><span class="dashicons ' . $ikona . '"></span><a href="?page=moja-wtyczka-dostep-do-katalogu&folder=' . urlencode($next_url) . '">' . $plik . '</a></div>';
                    echo '<form action="' . admin_url('admin-post.php') . '" method="POST" style="display:inline">';
                    echo '<input type="hidden" name="action" value="usun_katalog" />';
                    echo '<input type="hidden" name="plik" value="' . $plik . '" />';
                    echo '<input type="hidden" name="folder" value="' . $_GET['folder'] . '" />';
                    echo '<input type="button" value="Usuń" onclick="PotwierdzenieUsuniecia(event)" />';
                    echo '<input style="display:none;" type="submit" name="wybor" value="Tak usuwam"/>';
                    echo '</form></li>';
                
                } else {
                    echo '<li class="plik"><div><span class="dashicons ' . $ikona . '"></span>' . $plik . '</div>';
                }

                // Dodaj formularz do usuwania pliku
                if (!is_dir($sciezka)) {
                    echo '<form action="' . admin_url('admin-post.php') . '" method="POST" style="display:inline">';
                    echo '<input type="hidden" name="action" value="usun_plik" />';
                    echo '<input type="hidden" name="plik" value="' . $plik . '" />';
                    echo '<input type="hidden" name="folder" value="' . $_GET['folder'] . '" />';
                    echo '<input type="button" value="Usuń" onclick="PotwierdzenieUsuniecia(event)" />';
                    echo '<input style="display:none;" type="submit" name="wybor" value="Tak usuwam"/>';
                    echo '</form></li>';
                }
            }
        }
        echo '</ul>';

        // Wyświetl formularz do przesyłania plików
        echo '<form class="dodaj-plik" action="' . admin_url('admin-post.php') . '" method="POST" enctype="multipart/form-data">';
        echo '<input type="hidden" name="action" value="dodaj_plik" />';
        echo '<input type="file" name="plik[]" multiple />';
        echo '<input type="hidden" name="folder" value="' . $_GET['folder'] . '" />';
        echo '<input type="submit" value="Dodaj plik" />';
        echo '</form>';

        // Wyświetl formularz do tworzenia formularza
        echo '<form class="dodaj-folder" action="' . admin_url('admin-post.php') . '" method="POST">';
        echo '<input type="hidden" name="action" value="dodaj_katalog" />';
        echo '<input type="text" name="nowy_katalog" placeholder="Wprowadź nazwę katalogu" />';
        echo '<input type="hidden" name="folder" value="' . $_GET['folder'] . '" />';
        echo '<input type="submit" value="Dodaj katalog" />';
        echo '</form>';
    } else {
        echo '<br> Katalog nie istnieje.';
    }

    echo '</div>';
}

// Kod obsługujący żądanie dodawania pliku
function dodaj_plik() {
    $katalog = ABSPATH . 'doc/' . $_POST['folder'] . '/'; // Pełna ścieżka do katalogu

    if (isset($_FILES['plik'])) {
        $pliki = $_FILES['plik'];

        $dozwolone_rozszerzenia = array('jpg', 'jpeg', 'png', 'pdf');

        foreach ($pliki['error'] as $key => $error) {
            if ($error === UPLOAD_ERR_OK) {
                $nazwa = $pliki['name'][$key];
                $lokalizacja = $pliki['tmp_name'][$key];
                $docelowa_sciezka = $katalog . $nazwa;
                $rozszerzenie = strtolower(pathinfo($docelowa_sciezka, PATHINFO_EXTENSION));

                if (!in_array($rozszerzenie, $dozwolone_rozszerzenia)) {
                    $_SESSION['komunikat'] .= 'Nieprawidłowe rozszerzenie pliku: ' . $nazwa . '. Dozwolone rozszerzenia to: ' . implode(', ', $dozwolone_rozszerzenia) . '<br>';
                    continue;
                }

                if (file_exists($docelowa_sciezka)) {
                    $_SESSION['komunikat'] .= 'Plik <b>' . $nazwa . '</b> już istnieje. <br>';
                } else {
                    if (move_uploaded_file($lokalizacja, $katalog . $nazwa)) {
                        // Plik został pomyślnie przesłany i zapisany
                    } else {
                        $_SESSION['komunikat'] = 'Wystąpił problem podczas dodawania pliku.';
                    }
                }
            } else {
                $_SESSION['komunikat'] = 'Wystąpił błąd podczas przesyłania pliku.';
            }
        }
        wp_redirect(admin_url('admin.php?page=moja-wtyczka-dostep-do-katalogu&folder=' . $_POST['folder'])); // Przekierowanie do strony z zawartością katalogu
        exit;
    }
}

// Kod obsługujący żądanie usuwania pliku
function usun_plik() {
    if (isset($_POST['plik'])) {
        $plik = $_POST['plik'];
        $katalog = ABSPATH . 'doc/' . $_POST['folder'] . '/'; // Pełna ścieżka do katalogu
            if (is_file($katalog . $plik)) {
                if (unlink($katalog . $plik)) {
                    $_SESSION['komunikat'] .= 'Plik <b>' . $plik . '</b> został usunięty ';
                    wp_redirect(admin_url('admin.php?page=moja-wtyczka-dostep-do-katalogu&folder=' . $_POST['folder'])); // Przekierowanie do strony z zawartością katalogu
                    exit;
                } else {
                    $_SESSION['komunikat'] .= 'Wystąpił problem podczas usuwania pliku.';
                    wp_redirect(admin_url('admin.php?page=moja-wtyczka-dostep-do-katalogu&folder=' . $_POST['folder'])); // Przekierowanie do strony z zawartością katalogu
                    exit;
                }
            } else {
                $_SESSION['komunikat'] .= 'Nie można odnaleźć pliku.';
                wp_redirect(admin_url('admin.php?page=moja-wtyczka-dostep-do-katalogu&folder=' . $_POST['folder'])); // Przekierowanie do strony z zawartością katalogu
                exit;
            }
        // }
    }
}
// Kod obsługujący żądanie dodawnia katalogów
function dodaj_katalog() {
    if (isset($_POST['nowy_katalog'])) {
        $nowy_katalog = $_POST['nowy_katalog'];
        $katalog_glowny = ABSPATH . 'doc/' . $folder;
        $pelna_sciezka = realpath($katalog_glowny . '/' . $_POST['folder']);

        if ($pelna_sciezka) {
            if (!is_dir($pelna_sciezka . '/' . $nowy_katalog)) {
                if (mkdir($pelna_sciezka . '/' . $nowy_katalog)) {
                    $_SESSION['komunikat'] = 'Katalog został dodany.';
                } else {
                    echo 'Wystąpił problem podczas dodawania katalogu.';
                }
            } else {
                echo 'Katalog już istnieje.';
            }
        } else {
            echo 'Nieprawidłowa ścieżka katalogu.';
        }

        wp_redirect(admin_url('admin.php?page=moja-wtyczka-dostep-do-katalogu&folder=' . $_POST['folder']));
        exit;
    }
}

// Funkcja obsługująca żądanie usuwania katalogu
function usun_katalog() {
    if (isset($_POST['plik'])) {
        $katalog = $_POST['plik'];
        $pelna_sciezka = ABSPATH . 'doc/' . $_POST['folder'] . '/' . $_POST['plik'];
        if (is_dir($pelna_sciezka)) {
            if (czy_katalog_pusty($pelna_sciezka)) {
                if (rmdir($pelna_sciezka)) {
                    $_SESSION['komunikat'] .= 'Katalog <b>' . $katalog . '</b> został usunięty';
                    wp_redirect(admin_url('admin.php?page=moja-wtyczka-dostep-do-katalogu&folder=' . $_POST['folder']));
                    exit;
                } else {
                    $_SESSION['komunikat'] .= 'Wystąpił problem podczas usuwania katalogu.';
                    wp_redirect(admin_url('admin.php?page=moja-wtyczka-dostep-do-katalogu&folder=' . $_POST['folder']));
                    exit;
                }
            } else {
                $_SESSION['komunikat'] .= 'Katalog <b>' . $katalog . '</b> nie może zostać usunięty, ponieważ nie jest pusty.';
                wp_redirect(admin_url('admin.php?page=moja-wtyczka-dostep-do-katalogu&folder=' . $_POST['folder']));
                exit;
            }
        } else {
            $_SESSION['komunikat'] .= 'Nie można odnaleźć katalogu. </b>' . $pelna_sciezka . '</b>';
            wp_redirect(admin_url('admin.php?page=moja-wtyczka-dostep-do-katalogu&folder=' . $_POST['folder']));
            exit;
        }
    }
}

// Funkcja sprawdzająca, czy katalog jest pusty
function czy_katalog_pusty($sciezka) {
    $pliki = glob(rtrim($sciezka, '/') . '/*');
    return empty($pliki);
}

function enqueue_custom_assets() {
    // Podłączanie pliku JavaScript
    wp_enqueue_script( 'custom_script', plugin_dir_url( __FILE__ ) . 'scriptFTP.js' );
    
    // Podłączanie pliku CSS
    wp_enqueue_style( 'custom_styles', plugin_dir_url( __FILE__ ) . 'styleFTP.css' );
}

add_action( 'admin_enqueue_scripts', 'enqueue_custom_assets' );

add_action('admin_post_usun_katalog', 'usun_katalog');
add_action('admin_post_nopriv_usun_katalog', 'usun_katalog');

add_action('admin_post_dodaj_katalog', 'dodaj_katalog');
add_action('admin_post_nopriv_dodaj_katalog', 'dodaj_katalog');

add_action('admin_post_usun_plik', 'usun_plik');
add_action('admin_post_nopriv_usun_plik', 'usun_plik');

add_action('admin_post_dodaj_plik', 'dodaj_plik');
add_action('admin_post_nopriv_dodaj_plik', 'dodaj_plik');

?>