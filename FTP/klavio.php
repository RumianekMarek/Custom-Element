<?php 

// Funkcja dodająca stronę menu do panelu administracyjnego WordPress
function klavio_menu() {
    add_submenu_page(
        'moja-wtyczka-dostep-do-katalogu', // Slug rodzica (strony menu)
        'KLAVIO',                        // Tytuł podmenu
        'KLAVIO',                        // Wyświetlany tekst w menu bocznym
        'manage_options',                 // Wymagane uprawnienia
        'klavio_admin_setup', // Unikalny identyfikator strony
        'klavio_admin_setup_output', // Funkcja wyświetlająca zawartość strony
    );
}

// Funkcja wyświetlająca zawartość strony ustawień
function klavio_admin_setup_output() {
    global $wpdb;
    
    echo '<style>
            form {
                display: flex;
                flex-direction: column;
                width: 400px;
                gap: 10px;
            }
            input[type="submit"] {
                width: fit-content;
                padding: 5px 10px;
            }
        </style>';
    echo '<div class="wrap">';
        echo '<h1>Klavio Setup</h1>';
        echo '<form action="' . admin_url('admin.php?page=klavio_admin_setup') . '" method ="POST" >';
            echo '<label>Klavio Privat Key</label>';
            echo '<input type="text" name="klavio_pkey" value=""/>'; // Pole tekstowe do wprowadzenia privat key Klavio
            echo '<label>Id Listy Klavio PL</label>';
            echo '<input type="text" name="klavio_list_pl" value=""/>'; // Pole tekstowe do wprowadzenia ID listy Klavio PL
            echo '<label>Id Listy Klavio EN</label>';
            echo '<input type="text" name="klavio_list_en" value=""/>'; // Pole tekstowe do wprowadzenia ID listy Klavio En
            echo '<input type="submit" name="submit_klavio_setup" value="Update" />'; // Przycisk do wysłania formularza
        echo '</form>';
    echo '</div>';
}

// Funkcja tworząca tabelę w bazie danych, jeśli nie istnieje
function klavia_data_base_create($table_name) {
    global $wpdb;

    // Pobierz odpowiednie ustawienia kodowania i porównania dla tabeli
    $charset_collate = $wpdb->get_charset_collate();

    // Zapytanie SQL do stworzenia tabeli
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        update_time DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
        klavio_list_name VARCHAR(100) NOT NULL,
        klavio_list_id VARCHAR(100) NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    // Załaduj funkcję dbDelta do tworzenia/aktualizacji tabeli
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    // Wykonanie zapytania do stworzenia lub zaktualizowania tabeli
    dbDelta($sql);

    // Sprawdź, czy tabela została poprawnie utworzona
    if ($wpdb->last_error) {
        echo '<pre style="margin-left: 200px; margin-top: 20px;">';
        echo 'Database Error: ' . esc_html($wpdb->last_error);
        echo '</pre>';
    } else {
        echo '<pre style="margin-left: 200px; margin-top: 20px;">';
        echo 'Table creation/update successful.';
        echo '</pre>';
    }
}


function klavio_send_data($id, $key, $table_name, $wpdb){

    $existing_row = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $table_name WHERE klavio_list_name = %s",
        $id
    ));

    if ($existing_row) {
        // Row exists, update it
        $result = $wpdb->update(
            $table_name,
            array('klavio_list_id' => $key),
            array('klavio_list_name' => $id),
            array('%s'),
            array('%s')
        );
    } else {
        // Prepare the format array
        $format = array('%s', '%s'); // Both fields are text

        // Prepare the data array with column names as keys
        $data = array(
            'klavio_list_name' => $id,
            'klavio_list_id'   => $key
        ); 

        // Row does not exist, insert a new one
        $result = $wpdb->insert(
            $table_name,
            $data,
            $format
        );
    }
    if ($result === false) {
        echo '<pre style="margin-left: 200px; margin-top: 20px;">';
        echo 'Insert failed: ' . esc_html($wpdb->last_error);
        echo '</pre>';
    } else {
        echo '<pre style="margin-left: 200px; margin-top: 20px;">';
        echo $id . ' ' . $key . ' Data inserted successfully';
        echo '</pre>';
    }
}

// Funkcja sprawdzająca i aktualizująca tabelę w bazie danych
function klavia_data_base_check($table_name) {
    global $wpdb;

    //Sprawdź, czy tabela istnieje
    if ($wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $table_name)) === $table_name) {

        // Tabela istnieje, pobierz kolumny
        $columns = $wpdb->get_col("DESC $table_name", 0);

        // Jeśli kolumna 'klavio_list_id' nie istnieje, dodaj ją do tabeli
        if (!in_array('klavio_list_name', $columns)) {
            $wpdb->query("ALTER TABLE $table_name ADD klavio_list_name VARCHAR(100) NOT NULL");
        }

        if (!in_array('klavio_list_id', $columns)) {
            $wpdb->query("ALTER TABLE $table_name ADD klavio_list_id VARCHAR(100) NOT NULL");
        } 
    } else {
        // Tabela nie istnieje, stwórz nową tabelę
        klavia_data_base_create($table_name);
    }

    //Send data to db
    foreach($_POST as $id => $key){
        if($key == ''){
            continue;
        }
        if($id != 'submit_klavio_setup'){
            klavio_send_data($id, $key, $table_name, $wpdb);
        }
    }
}

// Sprawdź, czy formularz został wysłany i wykonaj odpowiednie działania
if (isset($_POST['submit_klavio_setup'])){
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_klavio_setup'; // Nazwa tabeli z prefiksem
    klavia_data_base_check($table_name); // Sprawdź i aktualizuj tabelę
}

// Dodaj stronę menu do panelu administracyjnego WordPress
add_action( 'admin_menu', 'klavio_menu' );

?>
