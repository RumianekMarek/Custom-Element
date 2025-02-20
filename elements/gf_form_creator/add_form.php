<?php 

$report['status'] = 'false';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['Authorization'] == 'qg58yn58q3yn5v') {

    $new_url = str_replace('private_html','public_html',$_SERVER["DOCUMENT_ROOT"]) .'/wp-load.php';
    if (file_exists($new_url)) {
        require_once($new_url);

        $csv_name = $_SERVER['HTTP_FILENAME'];

        $csvContent = file_get_contents('php://input');

        $csvContent = str_replace("\\", "", $csvContent);
        $csvContent = str_replace('\"', '"', $csvContent);

        $csvArray = json_decode($csvContent, true);
        $report['error'] = $csvContent;
        $entries_ids = '';
        $form_entries = array();
        $form_fields = array();
        $form_id = '';

        foreach ($csvArray as $id => $row) {
            if($row != ''){
                if ( $id > 0 ){
                    $form_entries[$id - 1][0] = '';
                }
                $row_array = $row;

                $i = 11;
                foreach($row_array as $key => $value){
                    $value = str_replace('\\"', "", $value);
                    if($id == 0){
                        $value = str_replace("\r", "", $value);                        
                        switch (strtolower(trim($value))){
                            case 'id': 
                                $form_fields[1] = array(
                                    'label' => $value,
                                    'type' => 'text',
                                    'id' => 1,
                                );
                                break;
                            case 'jlp': 
                                $form_fields[2] = array(
                                    'label' => $value,
                                    'type' => 'text',
                                    'id' => 2,
                                );
                                break;
                            case 'firma': 
                                $form_fields[3] = array(
                                    'label' => $value,
                                    'type' => 'text',
                                    'id' => 3,
                                );
                                break;
                            case 'osoba': 
                                $form_fields[4] = array(
                                    'label' => $value,
                                    'type' => 'text',
                                    'id' => 4,
                                );
                                break;
                            case 'kanaŁ': 
                            case 'kanal':
                                $form_fields[5] = array(
                                    'label' => $value,
                                    'type' => 'text',
                                    'id' => 5,
                                );
                                break;
                            case 'adres': 
                                $form_fields[6] = array(
                                    'label' => $value,
                                    'type' => 'text',
                                    'id' => 6,
                                );
                                break;
                            case 'miasto': 
                                $form_fields[7] = array(
                                    'label' => $value,
                                    'type' => 'text',
                                    'id' => 7,
                                );
                                break;
                            case 'mail': 
                                $form_fields[8] = array(
                                    'label' => $value,
                                    'type' => 'text',
                                    'id' => 8,
                                );
                                break;
                            case 'kod': 
                                $form_fields[9] = array(
                                    'label' => $value,
                                    'type' => 'text',
                                    'id' => 9,
                                );
                                break;
                            case 'telefon': 
                                $form_fields[10] = array(
                                    'label' => $value,
                                    'type' => 'text',
                                    'id' => 10,
                                );
                                break;
                            default:
                                $form_fields[$i] = array(
                                    'label' => $value,
                                    'type' => 'text',
                                    'id' => $i,
                                );
                                $i++;
                                break;
                        }
                    } else {
                        $form_entries[$id - 1][] = $value;
                    }
                }
            }
        }

        $all_forms = GFAPI::get_forms();
        
        $qr_feeds = GFAPI::get_feeds();
        foreach($qr_feeds as $single_feed){
            $elements[] = substr($single_feed['meta']['qrcodeFields'][0]['custom_key'], 0, 4);
        }

        $counts_qr_meta = array_count_values($elements);
        $most_used_qr_meta = array_search(max($counts_qr_meta), $counts_qr_meta);

        // foreach($all_forms as $form){
        //     if($form['title'] == $csv_name){
        //         $report['output'] .= 'formularz ' . $csv_name . ' juz istnieje';
        //         echo json_encode($report);
        //         exit;
        //     }
        // }
       
        if ($form_id == ''){
            $form_id = GFAPI::add_form(array(
                'title' => $csv_name,
                'fields' => $form_fields,
            ));

            $form_feed_exists = false;
            
            foreach ($qr_feeds as $feed) {
                if ($feed['form_id'] == $form_id){
                    $form_feed_exists = true;
                    break;
                }
            }
            if(!$form_feed_exists){
                $qr_feed_new = array(
                    'feedName'=> 'GF-QR-' . count($qr_feeds),
                    'qrcodeLabel'=> '',
                    'qrcodeSize'=> '200',
                    'feed_condition_conditional_logic_object' => array(),
                    'feed_condition_conditional_logic' => '0',
                    'qrcodeFields'=> array(
                        0 => array(
                            'key' => 'gf_custom',
                            'custom_key' => $most_used_qr_meta . str_pad($form_id, 3, '0', STR_PAD_LEFT),
                            'value'=> 'id',
                            'custom_value'=> ''
                        ),
                        1 => array(
                            'key' => 'gf_custom',
                            'custom_key' => 'rnd' . mt_rand(10000, 99999),
                            'value' => 'id',
                            'custom_value' => '',
                        ),
                    ),
                    'feedCondition' => '',
                );
                $qr_feed_exist = GFAPI::add_feed($form_id, $qr_feed_new, 'qr-code');

            }
            $entries_ids = GFAPI::add_entries($form_entries, $form_id);
        }

        $report['status'] = 'true';
        $report['output'] .= '<p>Formularz ' . $csv_name . ' został stworzony <br> Zaimportowano ' . count($entries_ids) . ' pozycji</p>';
        $report['id_formularza'] =  $form_id;
        $report['fair_name'] = do_shortcode("[trade_fair_badge]");
        $report['form_name'] = $csv_name;
        $report['entries_count'] = count($entries_ids);
    }
}

echo json_encode($report);