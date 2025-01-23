<?php 

class GF_Integration {

    private $entry;
    private $form;
    private $hubspot_file;
         

    // Konstruktor przyjmujący dane
    public function __construct($entry, $form) {
        $this->entry = $entry;
        $this->form = $form;
        $this->hubspot_file = __DIR__ . '/hubspot_sender.php';
    }

    public function init() {
        echo '<pre>';
        // Check if form is one of the registration forms
        $pattern = '/^\(\s*20\d{2}\s*\)\s?Rejestracja (PL|EN)(\s*\(header(?:\s*new)?\))?(\s*\(Branzowe\))?(\s*\(FB\))?$/';
        if (!preg_match($pattern, $this->form['title'])){
            return;
        }
        include_once 'klavio_sender.php';
        klavio_sender($this->entry, $this->form);

        // $entry_data_to_integrate = $this->entry_data($this->form, $this->entry);
        // $secret = $this->get_secrets('hubspot');
        
        // if(!empty($secret) && !empty($entry_data_to_integrate) && file_exists($this->hubspot_file)){
        //     include_once $this->hubspot_file;
        //     $hubspot_integration = new Hubspot_Integration();
        //     $hubspot_integration->send_data($entry_data_to_integrate, $secret);
        // }

        // die;
        // $this->process_integration();
    }

    public function get_secrets($site) {
        if($site == 'hubspot'){
            global $wpdb;
            $db_returner = array();
            $table_name = $wpdb->prefix . 'custom_klavio_setup';
        
            $klavio_pre = $wpdb->prepare(
                "SELECT klavio_list_id FROM $table_name WHERE klavio_list_name = 'hubspot_secret'"
            );
        
            $db_data = $wpdb->get_results($klavio_pre);
            $db_returner = $db_data[0]->klavio_list_id;
            
            return $db_returner;
        }
    }

    public function entry_data($form, $entry) {
        if(!class_exists('GFAPI')){
            error_log('classa GFAPI nie istnieje w klasie GF_Integration');
            return;
        }

        foreach($form['fields'] as $field){
            if(strpos(strtolower($field['label']), 'email') !== false || strpos(strtolower($field['label']), 'e-mail') !== false){
                $email_id = $field['id'];
            } 
            if(strpos(strtolower($field['label']), 'tele') !== false || strpos(strtolower($field['label']), 'phone') !== false){
                $phone_id = $field['id'];
            }
            if(strpos(strtolower($field['label']), 'utm') !== false){
                $utm_id = $field['id'];
            }
        }

        // getting qr_code url
        $qr_feeds = GFAPI::get_feeds(NULL, $form['id']);
        foreach ($qr_feeds as $feed) {
            $qr_code_url = gform_get_meta($entry['id'], 'qr-code_feed_' . $feed['id'] . '_url');
            if ($qr_code_url) {
                $qr_code_id = $feed['id'];
                break;
            }
        }

        $nazwa = explode('@', $entry[$email_id])[0];

        $entry_to_send = [
            'targi' => do_shortcode('[trade_fair_name]'),
            'domena' => $_SERVER['SERVER_NAME'],
            'fair_date' => do_shortcode('[trade_fair_datetotimer]'),
            'entry_id' => $entry['id'],
            'nazwa' => $nazwa,
            'email' => $entry[$email_id],
            'phone' => $entry[$phone_id],
            'utm' => $entry[$utm_id],
            'qr_code' => $qr_code_url,
            'source_url' => $entry['source_url'],
        ];
        
        return $entry_to_send;
    }

    private function process_integration() {
        error_log('Przetwarzam dane integracji...');
    }
}   