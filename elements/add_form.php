<?php 
$report['status'] = 'false';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['secret'] == 'qg58yn58q3yn5v') {
    $new_url = str_replace('private_html','public_html',$_SERVER["DOCUMENT_ROOT"]) .'/wp-load.php';
    if (file_exists($new_url)) {
        require_once($new_url);

        $csvContent = $_POST['data'];
        $csvArray = explode("\n", $csvContent);

        $entries_ids = '';
        $form_entries = array();
        $form_fields = array();
        $form_id = '';

        foreach ($csvArray as $id => $row) {
            if($row != ''){
                if ( $id > 0 ){
                    $form_entries[$id - 1][0] = '';
                }
                $row_array = explode(',',$row);
                foreach($row_array as $key => $value){
                    if($id == 0){
                        $form_fields[] = array(
                            'label' => $value,
                            'type' => 'text',
                            'id' => $key + 1,
                        );
                    } else {
                        $form_entries[$id - 1][] = $value;
                    }
                }
            }
        }

        $csv_name = $_POST['file_name'];

        $all_forms = GFAPI::get_forms();
        $qr_feeds = GFAPI::get_feeds();


        foreach($all_forms as $form){
            if($form['title'] == $csv_name){
                $report['output'] .= 'formularz ' . $csv_name . ' juz istnieje';
                echo json_encode($report);
                exit;
            }
        }
       
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
                            'custom_key' => substr($qr_feeds[0]['meta']['qrcodeFields'][0]['custom_key'], '0', 4) . str_pad($form_id, 3, '0', STR_PAD_LEFT),
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
        $report['output'] = '<p>Formularz ' . $csv_name . ' został stworzony <br> Zaimportowano ' . count($entries_ids) . ' pozycji</p>';
        $report['id_formularza'] =  $form_id;
        $report['fair_name'] = do_shortcode("[trade_fair_badge]");
        $report['form_name'] = $csv_name;
        $report['entries_count'] = count($entries_ids);
    }
    echo json_encode($report);
}