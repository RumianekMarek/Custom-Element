<?php

class Hubspot_Integration{
    public function __construct() {
    }

    public function send_data($data_to_send, $secret_key) {
        if(empty($data_to_send) || empty($secret_key)){
            error_log('Hubspot_Integration błąd danych');
            return;
        }
        
        $url = 'https://api.hubapi.com/crm/v3/objects/contacts';

        $data = [
            'properties' => [
                'email' => $data_to_send['email'],
                'phone' => $data_to_send['phone'],
                'qr_code' => $data_to_send['qr_code'],
            ]
        ];

        $response_contact = wp_remote_post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $secret_key,
            ],
            'body' => json_encode($data),
            'method' => 'POST',
        ]);

        $response_body = json_decode(wp_remote_retrieve_body($response_contact), true);
        $vid = $response_body['id'] ?? null;
        $list_id = '2-131584974';

        if (!$vid) {
            var_dump('Nie udało się uzyskać ID kontaktu.');
            var_dump($response_body);
            return;
        }

        $add_to_list_url = 'https://api.hubapi.com/contacts/v1/lists/' . $list_id . '/add';
        $list_data = [
            'vids' => [$vid]
        ];
    
        $response_list = wp_remote_post($add_to_list_url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $secret_key,
            ],
            'body' => json_encode($list_data),
        ]);
    
        if (is_wp_error($response_list)) {
            error_log('Błąd dodania do listy: ' . $response_list->get_error_message());
        } else {
            var_dump('Kontakt został pomyślnie dodany do listy.');
        }

        var_dump($response_list);
    }
}