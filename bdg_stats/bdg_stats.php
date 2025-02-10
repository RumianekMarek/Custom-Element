<?php 

$new_url = str_replace('private_html','public_html',$_SERVER["DOCUMENT_ROOT"]) .'/wp-load.php';

function generateToken($domain) {
    $secret_key = 'gmlbu5oNGsbPCCS';
    return hash_hmac('sha256', $domain, $secret_key);
}
// echo '<pre>';
if (file_exists($new_url)) {
    require_once($new_url);

    if (!empty($_SERVER['Authorization']) && $_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['Authorization'] == generateToken($_SERVER['HTTP_HOST'])) {
        $all_entries = array();
        $all_forms_data = array();
        $form_fields = array();
        $report['year'] = substr(get_option('trade_fair_datetotimer'), 0 ,4);

        $last_id = !empty($_POST['last_id']) ? $_POST['last_id'] : 0;
        $last_form = intval($_POST['last_form']);
        $user_agent = array();

        $osPatterns = array(
            'Windows' => '/Windows NT/i',
            'MacBook' => '/Mac OS X|Macintosh/i',
            'Android' => '/Android/i',
            'iPhone'  => '/iPhone|iPad/i',
            'Linux'   => '/Linux/i',
            'Api' => '/Api/i'
        );

        $skip_fields = array(
            'captcha',
            'zgod',
            'consent',
            'konferencje',
            'kongres',
            'qrcode',
            'kod qr',
            'wystawca1',
            'wystawca2',
            'wystawca3',
            'wystawca4',
            'media1',
            'media2',
            'media3',
            'media4',
            'id',
            'wybierz',
            'bez tytu',
            'logotyp',
        );

         $save_fields = array(
            'form_id',
            'data_created',
            'id',
            'source_url',
        );

        if (isset($_POST['add_data']) && $_POST['add_data']){
            $report['name'] = do_shortcode('[trade_fair_name]');
            $report['meta'] = do_shortcode('[trade_fair_badge]');
            $report['start'] = do_shortcode('[trade_fair_datetotimer]');
            $report['end'] = do_shortcode('[trade_fair_enddata]');
        }

        if (class_exists('GFAPI')) {
            $all_forms = GFAPI::get_forms();
            foreach($all_forms as $single_form){
                if(stripos($single_form['title'], 'napisz') !== false || stripos($single_form['title'], 'write') !== false || stripos($single_form['title'], 'katalog') !== false){
                    continue;
                }

                if ($single_form['id'] > $last_form){
                    $qr_code_meta = array();
                    $qr_feeds = GFAPI::get_feeds(NULL, $single_form['id']);

                    if(!is_wp_error($qr_feeds)){
                        foreach($qr_feeds as $single_feed){
                            if($single_feed['addon_slug'] == 'qr-code'){
                                foreach($single_feed['meta']['qrcodeFields'] as $qr_id => $qr_val){
                                    $qr_code_meta[$qr_id] = $qr_val['custom_key'];
                                }
                            }
                        }
                    }

                    $all_forms_data[$single_form['id']] = [
                        'form_title' => $single_form['title'],
                        'form_meta_id' => $qr_code_meta[0],
                        'form_meta_rnd' => $qr_code_meta[1],
                    ];
                }
    
                    foreach($single_form['fields'] as $field_index => $single_field){
                        $label = strtolower($single_field['label']);

                        if (empty(trim($label))){
                            continue 2;
                        }

                        foreach($skip_fields as $single_skip){                            
                            if (stripos($label, $single_skip) !== false ){
                                continue 2;
                            }
                        }

                        switch (true) {
                            case stripos($label, 'mail') !== false:
                                $form_fields['email'] = $single_field['id'];
                                continue 2;

                            case stripos($label, 'tel') !== false || stripos($label, 'phone') !== false:
                                $form_fields['telefon'] = $single_field['id'];
                                continue 2;

                            case stripos($label, 'nazwisk') !== false || stripos($label, 'imie') !== false || stripos($label, 'name') !== false || stripos($label, 'osoba') !== false || stripos($label, 'imię') !== false || stripos($label, 'imiĘ') !== false:
                                $form_fields['dane'] = $single_field['id'];
                                continue 2;

                            case stripos($label, 'firm') !== false || stripos($label, 'compa') !== false:
                                $form_fields['firma'] = $single_field['id'];
                                continue 2;

                            case stripos($label, 'hala') !== false:
                                $form_fields['stand'] = $single_field['id'];
                                continue 2;

                            case stripos($label, 'stanowisko') !== false:
                                $form_fields['stand'] = $single_field['id'];
                                continue 2;

                            case stripos($label, 'utm') !== false:
                                $form_fields['utm'] = $single_field['id'];
                                continue 2;

                            case stripos($label, 'nip') !== false || stripos($label, 'tax') !== false:
                                $form_fields['nip'] = $single_field['id'];
                                continue 2;
                            
                            case stripos($label, 'powierzchnię') !== false || stripos($label, 'exhibition') !== false || stripos($label, 'area') !== false:
                                $form_fields['wielkosc_stoiska'] = $single_field['id'];
                                continue 2;

                            case stripos($label, 'active') !== false || stripos($label, 'aktywac') !== false:
                                $form_fields['aktywacja'] = $single_field['id'];
                                continue 2;

                            case stripos($label, 'język') !== false || stripos($label, 'lang') !== false:
                                $form_fields['jezyk'] = $single_field['id'];
                                continue 2;

                            case stripos($label, 'country') !== false:
                                $form_fields['państwo'] = $single_field['id'];
                                continue 2;

                            case stripos($label, 'city') !== false || stripos($label, 'miasto') !== false:
                                $form_fields['miasto'] = $single_field['id'];
                                continue 2;
                                
                            case stripos($label, 'kod') !== false || stripos($label, 'code') !== false:
                                $form_fields['kod_pocztowy'] = $single_field['id'];
                                continue 2;

                            case stripos($label, 'ulica') !== false || stripos($label, 'street') !== false:
                                $form_fields['ulica'] = $single_field['id'];
                                continue 2;

                            case stripos($label, 'numer u') !== false || stripos($label, 'building') !== false:
                                $form_fields['nr_ulicy'] = $single_field['id'];
                                continue 2;

                            case stripos($label, 'Mieszkan') !== false || stripos($label, 'Apartment') !== false:
                                $form_fields['nr_mieszkania'] = $single_field['id'];
                                continue 2;

                            case stripos($label, 'adres') !== false :
                                $form_fields['adres'] = $single_field['id'];
                                continue 2;
                            
                            case stripos($label, 'location') !== false || stripos($label, 'kana') !== false || stripos($label, 'dane wysy') !== false:
                                $form_fields['pwe_wysylajacy'] = $single_field['id'];
                                continue 2;

                            case stripos($label, 'more info') !== false:
                                $form_fields['dodatkowe_informacje'] = $single_field['id'];
                                continue 2;

                            default:
                                $form_fields[$label] = $single_field['id'];
                        }
                    }

                $form_entries = GFAPI::get_entries($single_form['id'], $search_criteria, null, array( 'offset' => 0, 'page_size' => 0));

                foreach($form_entries as $single_entry){
                    foreach($single_entry as $index => $val){
                        if (empty($val)) continue;

                        switch (true) {
                            case is_numeric($index) && floor($index) == $index:
                                $entry_field_name = array_search($index, $form_fields);
                                $all_entries[$single_entry['id']][$entry_field_name] = $val;
                                continue 2;
                            
                            case $index == 'user_agent':
                                foreach ($osPatterns as $os_index => $os_value){
                                    if (preg_match($os_value, $val)) {
                                        $all_entries[$single_entry['id']][$index] = $os_index;
                                        continue 2;
                                    } 
                                }
                                $all_entries[$single_entry['id']][$index] = $val . ' custome';
                                continue 2;
                            default :
                                if (in_array($index, $save_fields)){
                                    $all_entries[$single_entry['id']][$index] = $val;
                                }
                        }
                    }
                }
            }
            $report['data'] = $all_entries;
            $report['forms'] = $all_forms_data;
            
            echo json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
    } else {
        http_response_code(401);
        echo 'Unauthorized entry';
        exit;
    }
}