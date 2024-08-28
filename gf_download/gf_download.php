<?php
if (defined('ABSPATH')) {
} else {
    $new_url = str_replace('private_html','public_html',$_SERVER["DOCUMENT_ROOT"]) .'/wp-load.php';
    require_once($new_url);
}

function register_custom_gf_download() {
    vc_map(array(
        'name' => __('Gravity Entries downloader', 'my-custom-plugin'),
        'base' => 'gf_download',
        'category' => __('My Elements', 'my-custom-plugin'),
    ));
}

function custom_gf_download_output() {
    global $wpdb;
    $all_forms = '';

    if (class_exists('GFAPI')) {
        if (isset($_GET['token'])) {
            $token = $_GET['token'];
            if ($token == "all"){
                $all_forms = GFAPI::get_forms($active = null, $trash = null);
            } else {
                if ($token == "json"){
                    $all_forms = GFAPI::get_forms();
                    $json_data = array();
                    foreach($all_forms as $id => $form){
                        $from_name = $wpdb->prefix . "gf_form_view";
                        
                        $query = $wpdb->prepare("SELECT SUM(count) AS total_count FROM $from_name WHERE form_id = %d", $form['id']);
                        $view_data = $wpdb->get_results($query);
                        $count_entrys = count(GFAPI::get_entries($form['id'], null, null, array('offset' => 0, 'page_size' => 0)));
                        $json_data[$id]['form id'] = $form['id'];
                        $json_data[$id]['nazwa'] = $form['title'];
                        $json_data[$id]['wpisy'] = $count_entrys;
                        $json_data[$id]['wyswietlenia'] = $view_data[0]->total_count;
                    }
                    $json_file_name = do_shortcode('[trade_fair_name]').'.json';
                    $json_data = json_encode($json_data);
                    $file_path = plugin_dir_path( __FILE__ ). $json_file_name;
                    $file_written = file_put_contents($file_path, $json_data);
                    echo '<a class="json-download" href="' . plugins_url($json_file_name , __FILE__) . '" download>donwload</a>';
                    echo '<script>
                            document.querySelector(".json-download").click();
                            document.querySelector(".json-download").remove();
                        </script>';

                    $file_content = file_get_contents($file_path);

                } else if ($token != ''){

                    $forms_array = explode(',',$token);
                    $json_data = array();

                    $qr_search_entries = array();
                    $i = 0;

                    $pattern = '/^\(\s*20\d{2}\s*\)\s?Rejestracja (PL|EN)(\s*\(header(?:\s*new)?\))?(\s*\(Branzowe\))?(\s*\(podstrona kongresu\))?(\s*\(FB\))?$/';
                    $all_forms = GFAPI::get_forms();

                    foreach ($all_forms as $snipe_form) {
                        if (preg_match($pattern, $snipe_form['title'])){
                            
                            $qr_search_entries =  array_merge($qr_search_entries, GFAPI::get_entries($snipe_form['id'], null, null, array('offset' => 0, 'page_size' => 0)));
                        }
                    }

                    foreach($forms_array as $form_id){
                        if(!is_numeric($form_id)){
                            continue;
                        }
                        $form = GFAPI::get_form($form_id);
                        $all_etries = GFAPI::get_entries($form_id, null, null, array('offset' => 0, 'page_size' => 0));
                        foreach($all_etries as $entry_id => $entry){
                            $json_data[$i]['form_id'] = $form_id;
                            $json_data[$i]['entry_id'] = $entry['id'];
                            foreach($entry as $id => $val){
                                if (is_int($id)) {
                                    foreach($form['fields'] as $field){
                                        if ($field['id'] == $id){
                                            if (strpos(strtolower($field['label']) , 'email') !== false){
                                                $emial_search = $val;

                                                foreach($qr_search_entries as $s_entry){
                                                    if($emial_search != '' && in_array($emial_search, $s_entry)){
                                                        $qr_feeds = GFAPI::get_feeds(NULL, $s_entry['form_id']);
                                                        foreach ($qr_feeds as $feed) {
                                                            $qr_code_url = gform_get_meta($s_entry['id'], 'qr-code_feed_' . $feed['id'] . '_url');
                                                            if ($qr_code_url) {
                                                                $json_data[$i]['qr_code'] = $qr_code_url;
                                                                break;
                                                            } else {
                                                                $json_data[$i]['qr_code'] = '';
                                                            }
                                                        }
                                                        break;
                                                    }
                                                }
                                            }
                                            $json_data[$i][$field['label']] = $val;
                                            break;
                                        }
                                    }
                                }
                            }
                            $i++;
                        }
                    }
                    foreach($json_data as $json_checker){
                        
                        if(strpos(strtolower($json_checker['UTM']), 'utm_source=byli') !== false){
                            $json_vipgold[] = $json_checker;
                        } else if(strpos(strtolower($json_checker['UTM']), 'utm_source=klaviyo') !== false){
                            $json_klavio[] = $json_checker;
                        } else {
                            $json_new[] = $json_checker;
                        }
                    }

                    $json_vipgold = json_encode($json_vipgold, JSON_UNESCAPED_UNICODE);
                    $json_klavio = json_encode($json_klavio, JSON_UNESCAPED_UNICODE);
                    $json_new = json_encode($json_new, JSON_UNESCAPED_UNICODE);

                    if($json_vipgold != 'null'){
                        $json_file_name = do_shortcode('[trade_fair_name]').'_vip_gold.json';
                        $file_path = plugin_dir_path( __FILE__ ). $json_file_name;
                        $file_written = file_put_contents($file_path, $json_vipgold);
                        echo '<a class="json-download" href="' . plugins_url($json_file_name , __FILE__) . '" download>donwload</a>';
                        echo '<script>
                                document.querySelector(".json-download").click();
                                document.querySelector(".json-download").remove();
                            </script>';

                        $file_content = file_get_contents($file_path);
                    }

                    if($json_klavio != 'null'){
                        $json_file_name = do_shortcode('[trade_fair_name]').'_klaviyo.json';
                        $file_path = plugin_dir_path( __FILE__ ). $json_file_name;
                        $file_written = file_put_contents($file_path, $json_klavio);
                        echo '<a class="json-download" href="' . plugins_url($json_file_name , __FILE__) . '" download>donwload</a>';
                        echo '<script>
                                document.querySelector(".json-download").click();
                                document.querySelector(".json-download").remove();
                            </script>';

                        $file_content = file_get_contents($file_path);
                    }

                    if($json_new != 'null'){
                        $json_file_name = do_shortcode('[trade_fair_name]').'_gosc.json';
                        $file_path = plugin_dir_path( __FILE__ ). $json_file_name;
                        $file_written = file_put_contents($file_path, $json_new);
                        echo '<a class="json-download" href="' . plugins_url($json_file_name , __FILE__) . '" download>donwload</a>';
                        echo '<script>
                                document.querySelector(".json-download").click();
                                document.querySelector(".json-download").remove();
                            </script>';

                        $file_content = file_get_contents($file_path);
                    }
                }
            }
        } else {
            $all_forms = GFAPI::get_forms();
        }
    }

    $form_output = '<form id="custom-form" action="" method="post" style="width:600px">';
    $form_output .= '<select id="custom-element-all-forms" name="form_id" required>';
    $form_output .= '<option value="">Formularz</option>';

    foreach ($all_forms as $form) {
        $form_id = $form['id'];
        $form_title = $form['title'];
        $form_output .= '<option value="' . $form_id . '_' . $form_title .'">' . $form_id . ' - ' . $form_title . '</option>';
    }

    $form_output .= '</select>';
    $form_output .= '<button class="btn" id="submit-form" name="submit">Zatwierdź</button>';
    $form_output .= '</form>';

    if (isset($_POST["submit"]) && isset($_POST["form_id"])) {
        $selected_form_id = explode('_' , $_POST['form_id']);
        gf_finder($selected_form_id[0], $selected_form_id[1]);
    }

    return $form_output;
}

function gf_finder($gf_id, $form_title){

    if (class_exists('GFAPI')) {
        $page_size = 1000; // Liczba wpisów do przetworzenia w jednej partii
        $offset = 0; // Początkowy offset
        $entry_data = ''; // Inicjalizacja zmiennej dla danych
        $feeds = GFAPI::get_form($gf_id);
        $entry_labels = array();

        foreach ($feeds['fields'] as $id => $feed){
                $entry_labels[$feed['id']] = $feed['label'];
        }

        $entry_labels["source_url"] = "source_url";
        $entry_labels["date_created"] = "date_created";

        $sample_entry = GFAPI::get_entries($gf_id, null, null, array('offset' => 0, 'page_size' => 1));

        $labels_array = array();
        foreach ($sample_entry[0] as $key => $sample){
            foreach($entry_labels as $klucz => $wartosc){
                if($key === $klucz){
                    $label_array[$key] = $wartosc;
                    break;
                }
            }
        }
        ksort($label_array);
        $entry_data .= implode(',', $label_array) . '\n';

        do {
            $entries = GFAPI::get_entries($gf_id, null, null, array('offset' => $offset, 'page_size' => $page_size));
            foreach ($entries as $entry) {
                $entry_line = array();
                foreach ($entry as $id => $key) {
                    if (is_int($id) || $id === "source_url" || $id ==="date_created") {
                        $key = str_replace(',',' ',$key);
                        $key = str_replace(["\r\n", "\r", "\n"], ' ', $key);

                        $entry_line[$id] = $key;
                    }
                }
                ksort($entry_line);
                $entry_data .= implode(',', $entry_line) . '\n';
            }
            $offset += $page_size;
        } while (count($entries) === $page_size); // Kontynuuj, dopóki pobierane są kolejne partie

        $entry_data = str_replace('"', '', $entry_data);
        $entry_data = str_replace('#', '', $entry_data);
        $file_name = $form_title.' '.date("Y_m_d");
        echo '<script>
            var csvContent = "data:text/csv;charset=utf-8,";
            const data = "' . $entry_data . '";
            var csvContent = "data:text/csv;charset=utf-8," + data;
            var encodedUri = encodeURI(csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "'.$file_name.'.csv");
            document.body.appendChild(link);
            link.click();
        </script>';
    }

}

add_action('vc_before_init', 'register_custom_gf_download');
add_shortcode('gf_download', 'custom_gf_download_output');
?>