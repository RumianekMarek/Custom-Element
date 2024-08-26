<?php
// Kod funkcji dostępu do katalogu
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// echo '<pre style="margin-left:200px;">';
// var_dump($_SESSION);
// echo '</pre>';

function moja_wtyczka_dodaj_strone_menu() {
  add_menu_page(
      'Dostęp do katalogu', // Tytuł strony menu
      'DOC', // Wyświetlany tekst w menu
      'manage_options', // Wymagane uprawnienia
      'moja-wtyczka-dostep-do-katalogu', // Unikalny identyfikator strony
      'moja_wtyczka_wyswietl_strone_menu', // Funkcja wyświetlająca zawartość strony
      'dashicons-media-default', // Ikona w menu (opcjonalne)
      8 // Pozycja strony w menu (opcjonalne)
  );
}
// Kod funkcji dostępu do katalogu
function moja_wtyczka_wyswietl_strone_menu() {
  echo '<div class="wrap">';
  echo '<h1>Dostęp do katalogu</h1>';
  
  // Wywołaj funkcję dostępu do katalogu
  dostep_do_katalogu();
  
  echo '</div>';
}

// Kod funkcji dostępu do katalogu

function dostep_do_katalogu() {
    $folder = isset($_GET['folder']) ? $_GET['folder'] : '';

    echo '<div class="wrap main-container-dostepFTP">';
    echo '<h1 class="main-header-dostepFTP">/doc/' . $folder . '</h1>';

    $katalog = ABSPATH . 'doc'; // Pełna ścieżka do katalogu
    
    // Wyświetl komunikat, jeśli jest dostępny w sesji   
    if (isset($_SESSION['komunikat'])) {
        echo '<p class="komunikat">' . $_SESSION['komunikat'] . '</p>';
        unset($_SESSION['komunikat']);
    }

    $_SESSION = array();

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
                    // Formularz do zmiany nazwy dla każdego pliku/katalogu
                    echo '<div><form action="' . admin_url('admin-post.php') . '" method="POST" style="display:inline">';
                    echo '<input type="hidden" name="action" value="zmien_nazwe" />';
                    echo '<input type="hidden" name="stara_nazwa" value="' . $plik . '" />';
                    echo '<input type="hidden" name="folder" value="' . $folder . '" />';
                    echo '<input class="rename" type="button" value="Re-name" onclick="PotwierdzenieUsuniecia(event)" />';
                    echo '<input class="display-none" type="input" name="nowa_nazwa" placeholder="Podaj nową nazwę"/>';
                    echo '<input class="display-none" type="submit" value="Zmień nazwę" />';
                    echo '</form>';
                    
                    // Formularz do usuwania katalogu
                    echo '<form action="' . admin_url('admin-post.php') . '" method="POST" style="display:inline">';
                    echo '<input type="hidden" name="action" value="usun_katalog" />';
                    echo '<input type="hidden" name="plik" value="' . $plik . '" />';
                    echo '<input type="hidden" name="folder" value="' . $folder . '" />';
                    echo '<input class="usuwam" type="button" value="Usuń" onclick="PotwierdzenieUsuniecia(event)" />';
                    echo '<input class="display-none" type="submit" name="wybor" value="Tak usuwam"/>';
                    echo '</form></div></li>';
                
                } else {
                    echo '<li class="plik"><div><span class="dashicons ' . $ikona . '"></span><a target="_blank" href="' . get_site_url() . '/doc/' . $next_url . '">' . $plik . '</a></div>';
                }

                // Dodaj formularz do usuwania pliku
                if (!is_dir($sciezka)) {
                    // Formularz do zmiany nazwy dla każdego pliku/katalogu
                    echo '<div><form action="' . admin_url('admin-post.php') . '" method="POST" style="display:inline">';
                    echo '<input type="hidden" name="action" value="zmien_nazwe" />';
                    echo '<input type="hidden" name="stara_nazwa" value="' . $plik . '" />';
                    echo '<input type="hidden" name="folder" value="' . $folder . '" />';
                    echo '<input type="button" value="Re-name" onclick="PotwierdzenieUsuniecia(event)" />';
                    echo '<input class="display-none" type="input" name="nowa_nazwa" placeholder="Podaj nową nazwę"/>';
                    echo '<input class="display-none" type="submit" value="Zmień nazwę" />';
                    echo '</form>';
                    
                    // Formularz do usuwania pliku
                    echo '<form action="' . admin_url('admin-post.php') . '" method="POST" style="display:inline">';
                    echo '<input type="hidden" name="action" value="usun_plik" />';
                    echo '<input type="hidden" name="plik" value="' . $plik . '" />';
                    echo '<input type="hidden" name="folder" value="' . $folder . '" />';
                    echo '<input type="button" value="Usuń" onclick="PotwierdzenieUsuniecia(event)" />';
                    echo '<input class="display-none" type="submit" name="wybor" value="Tak usuwam"/>';
                    echo '</form></div></li>';
                }
            }
        }
        echo '</ul>';

        // Wyświetl formularz do przesyłania plików
        echo '<form class="dodaj-plik" action="' . admin_url('admin-post.php') . '" method="POST" enctype="multipart/form-data">';
            echo '<input type="hidden" name="action" value="dodaj_plik" />';
            echo '<div>';
                echo '<label>Katalog</label>';
                echo '<input type="file" name="plik[]" placeholder="Katalog" webkitdirectory directory multiple />';
            echo '</div>';
            echo '<div>';
                echo '<label>Plik</label>';
                echo '<input type="file" name="plik[]" multiple />';
            echo '</div>';
            echo '<input type="hidden" name="folder" value="' . $folder . '" />';
            echo '<input type="submit" value="Dodaj plik" />';
        echo '</form>';

        // Wyświetl formularz do tworzenia formularza
        echo '<form class="dodaj-folder" action="' . admin_url('admin-post.php') . '" method="POST">';
            echo '<input type="hidden" name="action" value="dodaj_katalog" />';
            echo '<input type="text" name="nowy_katalog" placeholder="Podaj nazwę katalogu" />';
            echo '<input type="hidden" name="folder" value="' . $folder . '" />';
            echo '<input type="submit" value="Dodaj katalog" />';
        echo '</form>';

        // Masowe usuwania plików
        echo '<div>
            <button class="get-all">Zaznacz wszystko</button>
            <button class="file-mass-del">Usuń zaznaczone pliki</button>
        </div>';

    } else {
        echo '<br> Katalog nie istnieje.';
    }

    echo '</div>';
}

// Kod obsługujący żądanie dodawania pliku
function dodaj_plik() {
    if (isset($_FILES['plik'])) {
        $pliki = $_FILES['plik'];
        $dozwolone_rozszerzenia = array('jpg', 'jpeg', 'png', 'pdf', 'webp');

        foreach ($pliki['error'] as $key => $error) {
            if ($error === UPLOAD_ERR_OK) {
                $folder = $_FILES['plik']['full_path'][$key];
                $file_name = basename($folder);
                $_SESSION[] = $file_name;
                $katalog = ABSPATH . 'doc/' . $_POST['folder'] . '/' . str_replace($file_name, '', $folder);
                $nazwa = $pliki['name'][$key];
                $lokalizacja = $pliki['tmp_name'][$key];
                $docelowa_sciezka = $katalog . $nazwa;
                $rozszerzenie = strtolower(pathinfo($docelowa_sciezka, PATHINFO_EXTENSION));

                if (!in_array($rozszerzenie, $dozwolone_rozszerzenia)) {
                    $_SESSION['komunikat'] .= 'Nieprawidłowe rozszerzenie pliku: ' . $nazwa . '. Dozwolone rozszerzenia to: ' . implode(', ', $dozwolone_rozszerzenia) . '<br>';
                    continue;
                }
                if (!is_dir(dirname($docelowa_sciezka))) {
                    mkdir(dirname($docelowa_sciezka), 0755, true);
                }

                if (move_uploaded_file($lokalizacja, $docelowa_sciezka)) {
                } else {
                    $_SESSION['komunikat'] .= 'Wystąpił problem podczas dodawania pliku' . $nazwa . ' => ' . $error;
                }
            } else {
                if($error != 4){
                    $_SESSION['komunikat'] .= 'Wystąpił błąd podczas przesyłania pliku.' . $nazwa . ' => ' . $error;
                }
            }
        }
        wp_redirect(admin_url('admin.php?page=moja-wtyczka-dostep-do-katalogu&folder=' . $_POST['folder']));
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
                    $_SESSION['komunikat'] = 'Plik <b>' . $plik . '</b> został usunięty ';
                } else {
                    $_SESSION['komunikat'] = 'Wystąpił problem podczas usuwania pliku.';
                }
            } else {
                $_SESSION['komunikat'] = 'Nie można odnaleźć pliku.';

            }
        wp_redirect(admin_url('admin.php?page=moja-wtyczka-dostep-do-katalogu&folder=' . $_POST['folder'])); // Przekierowanie do strony z zawartością katalogu
        exit;
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
                    $_SESSION['komunikat'] = 'Wystąpił problem podczas dodawania katalogu.';
                }
            } else {
                $_SESSION['komunikat'] = 'Katalog już istnieje.';
            }
        } else {
            $_SESSION['komunikat'] = 'Nieprawidłowa ścieżka katalogu.';
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
                    $_SESSION['komunikat'] = 'Katalog <b>' . $katalog . '</b> został usunięty';
                } else {
                    $_SESSION['komunikat'] = 'Wystąpił problem podczas usuwania katalogu.';
                }
            } else {
                $_SESSION['komunikat'] = 'Katalog <b>' . $katalog . '</b> nie może zostać usunięty, ponieważ nie jest pusty.';
            }
        } else {
            $_SESSION['komunikat'] = 'Nie można odnaleźć katalogu. </b>' . $pelna_sciezka . '</b>';
        }
        wp_redirect(admin_url('admin.php?page=moja-wtyczka-dostep-do-katalogu&folder=' . $_POST['folder']));
        exit;
    }
}

// Funkcja obsługująca zmianę nazwy pliku/katalogu
function zmien_nazwe() {
    if (isset($_POST['stara_nazwa']) && isset($_POST['nowa_nazwa'])) {
        $stara_nazwa = $_POST['stara_nazwa'];
        $nowa_nazwa = $_POST['nowa_nazwa'];
        $katalog = ABSPATH . 'doc/' . $_POST['folder'] . '/'; // Pełna ścieżka do katalogu
        
        if ($nowa_nazwa != '' && preg_match("/^[a-zA-Z0-9_.\-ąęśćżźńłóĄĘŚĆŻŹŃŁÓ]*$/", $nowa_nazwa)) {
            if (file_exists($katalog . $stara_nazwa)) {
                if (!file_exists($katalog . $nowa_nazwa)) {
                    if (rename($katalog . $stara_nazwa, $katalog . $nowa_nazwa)) {
                        $_SESSION['komunikat'] = 'Nazwa ' . $stara_nazwa . ' została zmieniona na ' . $nowa_nazwa;
                    } else {
                        $_SESSION['komunikat'] = 'Wystąpił błąd podczas zmiany nazwy pliku/katalogu.';
                    }
                } else {
                    $_SESSION['komunikat'] = 'Plik/katalog o nazwie ' . $nowa_nazwa . ' już istnieje.';
                }
            } else {
                $_SESSION['komunikat'] = 'Plik/katalog o nazwie' . $stara_nazwa . ' nie istnieje.';
            }
        } else { 
            $_SESSION['komunikat'] = 'Nazwa pliku/katalogu jest pusta lub zawiera niedozwolone znaki.';
        }

        wp_redirect(admin_url('admin.php?page=moja-wtyczka-dostep-do-katalogu&folder=' . $_POST['folder']));
        exit;
    }
}


// Funkcja sprawdzająca, czy katalog jest pusty
function czy_katalog_pusty($sciezka) {
    $pliki = glob(rtrim($sciezka, '/') . '/*');
    return empty($pliki);
}

function enqueue_custom_assets() {
    $css_file = plugins_url('styleFTP.css', __FILE__);
    $css_version = filemtime(plugin_dir_path( __FILE__ ) . 'styleFTP.css');
    wp_enqueue_style('custom_styles', $css_file, array(), $css_version);

    $js_file = plugins_url('scriptFTP.js', __FILE__);
    $js_version = filemtime(plugin_dir_path( __FILE__ ) . 'scriptFTP.js');
    wp_enqueue_script('custom_script', $js_file, array('jquery'), $js_version, true);
}

add_action( 'admin_enqueue_scripts', 'enqueue_custom_assets' );

add_action('admin_post_zmien_nazwe', 'zmien_nazwe');
add_action('admin_post_nopriv_zmien_nazwe', 'zmien_nazwe');

add_action('admin_post_usun_katalog', 'usun_katalog');
add_action('admin_post_nopriv_usun_katalog', 'usun_katalog');

add_action('admin_post_dodaj_katalog', 'dodaj_katalog');
add_action('admin_post_nopriv_dodaj_katalog', 'dodaj_katalog');

add_action('admin_post_usun_plik', 'usun_plik');
add_action('admin_post_nopriv_usun_plik', 'usun_plik');

add_action('admin_post_dodaj_plik', 'dodaj_plik');
add_action('admin_post_nopriv_dodaj_plik', 'dodaj_plik');

add_action( 'admin_menu', 'moja_wtyczka_dodaj_strone_menu' );
?>