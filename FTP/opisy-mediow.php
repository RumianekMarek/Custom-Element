<?php
    function dodaj_podmenu() {
        add_submenu_page(
            'moja-wtyczka-dostep-do-katalogu', // Slug rodzica (strony menu)
            'Alty zdjęć',                        // Tytuł podmenu
            'Alty zdjęć',                        // Wyświetlany tekst w menu bocznym
            'manage_options',                 // Wymagane uprawnienia
            'moja-wtyczka-alty-zdjec',           // Unikalny identyfikator podmenu
            'funkcja_renderujaca_podmenu_alty'   // Funkcja wyświetlająca zawartość podmenu
        );
    }

function funkcja_renderujaca_podmenu_alty() {
    $liczba_wynikow = 51; // Stała liczba wyników na stronie

    // Pobierz wartość przełącznika (czy pokazywać tylko elementy z wypełnionym alt)
    $pokazuj_z_alt = isset($_POST['pokazuj_z_alt']) ? true : false;

    // Dodatkowy argument dla funkcji get_posts() - filtruj po obrazach i bez paginacji
    $args = array(
        'post_type'      => 'attachment',
        'post_mime_type' => 'image', // Ograniczamy do obrazów
        'posts_per_page' => -1, // Wyłączamy paginację, pobieramy wszystkie wyniki na jednej stronie
    );

    $media_items = get_posts($args);

    echo '<div class="wrap">';
    echo '<h1>Wszystkie elementy galerii mediów</h1>';

    if ($media_items) {
        echo '<form method="post">';
        echo '<div class="galeria-zdjec">';
        foreach ($media_items as $media) {
            // Wyświetlamy nazwę i miniaturkę obrazu
            $thumbnail = wp_get_attachment_image_src($media->ID, 'thumbnail');
            echo '<div>';
            echo '<img src="' . $thumbnail[0] . '" alt="' . $media->post_title . '">';
            echo $media->post_title;

            // Pobieramy wartość alt lub wypełniamy pole nazwą obrazka, jeśli nie ma wartości
            $alt_text = get_post_meta($media->ID, '_wp_attachment_image_alt', true);
            if (empty($alt_text)) {
                $alt_text = sanitize_title($media->post_title); // Automatycznie wypełniamy wartością alt z nazwy obrazka, jeśli pole jest puste
            }
            echo '<input type="text" name="alt_text[' . $media->ID . ']" value="' . esc_attr($alt_text) . '">';

            echo '</div>';
        }
        echo '</div>';


        // Dodajemy przycisk "Zapisz"
        echo '<input type="submit" value="Zapisz" class="button button-primary">';
        echo '</form>';

        // Obsługa zapisywania wartości alt
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['alt_text'])) {
            foreach ($_POST['alt_text'] as $attachment_id => $alt_value) {
                update_post_meta($attachment_id, '_wp_attachment_image_alt', sanitize_text_field($alt_value));
            }
            echo '<div class="notice notice-success"><p>Zapisano wartości alt.</p></div>';
        }
    } else {
        echo '<p>Brak elementów galerii mediów.</p>';
    }

    echo '</div>';
}

    add_action('admin_menu', 'dodaj_podmenu');
?>