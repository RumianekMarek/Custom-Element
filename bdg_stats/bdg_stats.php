<?php 

$new_url = str_replace('private_html','public_html',$_SERVER["DOCUMENT_ROOT"]) .'/wp-load.php';

function generateToken($domain) {
    $secret_key = 'gmlbu5oNGsbPCCS';
    return hash_hmac('sha256', $domain, $secret_key);
}

if (file_exists($new_url)) {
    require_once($new_url);

    if (!empty($_SERVER['Authorization']) && $_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['Authorization'] == generateToken($_SERVER['HTTP_HOST'])) {
        $all_entries = array();

        $report['year'] = substr(get_option('trade_fair_datetotimer'), 0 ,4);

        $last_id = !empty($_POST['last_id']) ? $_POST['last_id'] : 0;
        $search_criteria = [
            'field_filters' => [
                [
                    'key'      => 'id',
                    'value'    => $last_id,
                    'operator' => '>'
                ]
            ]
        ];

        if (class_exists('GFAPI')) {
            $all_forms = GFAPI::get_forms();
            foreach($all_forms as $single_form){
                if(stripos($single_form['title'], 'napisz') !== false || stripos($single_form['title'], 'write') !== false || stripos($single_form['title'], 'katalog') !== false){
                    continue;
                }
                $form_fields = array(
                    'email' => '',
                    'telefon' => '',
                    'dane' => 'brak',
                    'utm' => '',
                );

                foreach($single_form['fields'] as $single_field){
                    if(stripos($single_field['label'], 'mail') !== false){
                        $form_fields['email'] = $single_field['id'];
                        continue;
                    }

                    if(stripos($single_field['label'], 'tel') !== false || stripos($single_field['label'], 'phone') !== false){
                        $form_fields['telefon'] = $single_field['id'];
                        continue;
                    }

                    if(stripos($single_field['label'], 'imie') !== false || stripos($single_field['label'], 'name') !== false){
                        $form_fields['dane'] = $single_field['id'];
                        continue;
                    }

                    if(stripos($single_field['label'], 'utm') !== false){
                        $form_fields['utm'] = $single_field['id'];
                        continue;
                    }
                }
                
                $form_entries = GFAPI::get_entries($single_form['id'], $search_criteria);

                foreach($form_entries as $single_entry){
                    $all_entries[$single_entry['id']]['entry_id'] = $single_entry['id'];
                    $all_entries[$single_entry['id']]['date_created'] = $single_entry['date_created'];
                    $all_entries[$single_entry['id']]['form_id'] = $single_entry['form_id'];
                    foreach($form_fields as $f_id => $f_val){
                        if ($single_entry[$f_val] === null){
                            continue;
                        }
                        $all_entries[$single_entry['id']][$f_id] = $single_entry[$f_val];
                    }
                }
            }
            $report['data'] = $all_entries;
            echo json_encode($report);
        }
    }
}