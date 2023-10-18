<?php
function register_custom_gf_download() {
    vc_map(array(
        'name' => __('Gravity Entries downloader', 'my-custom-plugin'),
        'base' => 'gf_download',
        'category' => __('My Elements', 'my-custom-plugin'),
    ));
}

function custom_gf_download_output() {
    if (class_exists('GFAPI')) {
        $all_forms = GFAPI::get_forms();
    }

    $form_output = '<form id="custom-form" action="" method="post">';
    $form_output .= '<select id="custom-element-all-forms" name="form_id" required>';
    $form_output .= '<option value="">Wybierz Dział</option>';

    foreach ($all_forms as $form) {
        $form_id = $form['id'];
        $form_title = $form['title'];
        $form_output .= '<option value="' . $form_id . '">' . $form_id . ' - ' . $form_title . '</option>';
    }

    $form_output .= '</select>';
    $form_output .= '<button id="submit-form" name="submit">Zatwierdź</button>';
    $form_output .= '</form>';

    if (isset($_POST["submit"]) && isset($_POST["form_id"])) {
        var_dump($_POST["submit"]);
        $selected_form_id = $_POST['form_id'];
        gf_finder($selected_form_id);
    }

    return $form_output;
}

function gf_finder($gf_id){
    
    if (class_exists('GFAPI')) {
        $page_size = 1000; // Liczba wpisów do przetworzenia w jednej partii
        $offset = 0; // Początkowy offset
        $entry_data = ''; // Inicjalizacja zmiennej dla danych
    
        do {
            $entries = GFAPI::get_entries($gf_id, null, null, array('offset' => $offset, 'page_size' => $page_size));
            foreach ($entries as $entry) {
                $entry_line = array();
                foreach ($entry as $id => $key) {
                    if (is_int($id)) {
                        $key = str_replace(',',' ',$key);
                        $entry_line[] = $key;
                    }
                }
                $entry_data .= implode(',', $entry_line) . '\n';
            }
    
            $offset += $page_size;
        } while (count($entries) === $page_size); // Kontynuuj, dopóki pobierane są kolejne partie
    
        $entry_data = str_replace('"', '', $entry_data);
    
        echo '<script>
            var csvContent = "data:text/csv;charset=utf-8,";
            const data = "' . $entry_data . '";
            var csvContent = "data:text/csv;charset=utf-8," + data;
            var encodedUri = encodeURI(csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "dane.csv");
    
            document.body.appendChild(link);
            link.click();
        </script>';
    }
    
}

add_action('vc_before_init', 'register_custom_gf_download');
add_shortcode('gf_download', 'custom_gf_download_output');
?>