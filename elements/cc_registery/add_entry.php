<?php 

$report['status'] = false;

$new_url = str_replace('private_html','public_html',$_SERVER["DOCUMENT_ROOT"]) .'/wp-load.php';
if (file_exists($new_url)) {
    require_once($new_url);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['secret'] == SECURE_AUTH_KEY) {
        if (class_exists('GFAPI')) {
            $all_entries = array();

            $post_data = str_replace("\\", "", $_POST['data']);
            
            $data_array = json_decode($post_data, true);
            
            foreach ($data_array['all_names'] as $index => $name){

                $entry = array();

                foreach ($data_array as $id => $val){
                    if($id == 'form_id'){ 
                        $entry[$id] = $val;
                        continue;
                    }
                    if($id == 'name_id'){ 
                        $field_id = str_replace('input_', '', $val);
                        $entry[$field_id] = $name;
                        continue;
                    }

                    if(strpos($id, 'input') !== false){ 
                        $field_id = str_replace('input_', '', $id);
                        $field_id = explode('.', $field_id)[0];

                        $entry[$field_id] = $val;
                        continue;
                    }
                }
                $all_entries[] = GFAPI::add_entry($entry);
            }

            foreach ($all_entries as $entry_id){
                $qr_code_id = '';
                $qr_feeds = GFAPI::get_feeds( NULL, $data_array['form_id']);

                foreach($qr_feeds as $feed){
                    if (gform_get_meta($entry_id, 'qr-code_feed_' . $feed['id'] . '_url')){
                        $qr_code_id = $feed['id'];
                    }   
                }

                $meta_key_url = gform_get_meta($entry_id, 'qr-code_feed_' . $qr_code_id . '_url');
                $meta_key_image = '<img data-imagetype="External" src="' . $meta_key_url . '>';

                $face_form = GFAPI::get_form($data_array['form_id']);
                $entry_object = GFAPI::get_entry($entry_id);
                
                foreach($face_form["notifications"] as $id => $key){
                    if ($key["notification_conditional_logic"] == "1"){
                        foreach($key["notification_conditional_logic_object"]['rules'] as $r_id => $rule){
                            if($rule['value'] == $data_array['notification']){
                                if(strpos($key["message"], '{qrcode-url-' . $qr_code_id . '}') != false){
                                    $face_form["notifications"][$id]["message"] = str_replace('{qrcode-url-' . $qr_code_id . '}', $meta_key_url, $key["message"]);
                                } else if (strpos($key["message"], '{qrcode-image-' . $qr_code_id . '}') != false){
                                    $face_form["notifications"][$id]["message"] = str_replace('{qrcode-image-' . $qr_code_id . '}', $meta_key_image, $key["message"]);
                                }
                                try {
                                    GFAPI::send_notifications($face_form, $entry_object);
                                } catch (Exception $e) {
                                    error_log('Error send_notifications for Call Center: ' . $e->getMessage());
                                }
                            }
                        }
                    }
                }
            }

            $report['entries'] = $all_entries;
            $report['status'] = true;
            echo json_encode($report, true);
        }
    }
}