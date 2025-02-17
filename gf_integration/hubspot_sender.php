<?php

class Hubspot_Integration{
    public function __construct() {
    }

    public function send_data($data_to_send, $secret_key) {
        if(empty($data_to_send) || empty($secret_key)){
            error_log('Hubspot_Integration błąd danych');
            return;
        }
        
        $url = 'https://api.hubapi.com/crm/v3/objects/2-138191659';

        $data = [
            'properties' => [
                'email_z_rejestracji' => $data_to_send['email'],
                'numer_telefonu_testowy' => $data_to_send['phone'],
                'qr_code_url' => $data_to_send['qr_code'],
                'imi__i_nazwisko' => 'Brak',
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
        // die(wp_remote_retrieve_body($response_contact));
        // $vid = $response_body['id'] ?? null;
        // $list_id = '2-131584974';

        // if (!$vid) {
        //     var_dump('Nie udało się uzyskać ID kontaktu.');
        //     var_dump($response_body);
        //     return;
        // }

        // $add_to_list_url = 'https://api.hubapi.com/contacts/v1/lists/' . $list_id . '/add';
        // $list_data = [
        //     'vids' => [$vid]
        // ];
    
        // $response_list = wp_remote_post($add_to_list_url, [
        //     'headers' => [
        //         'Content-Type' => 'application/json',
        //         'Authorization' => 'Bearer ' . $secret_key,
        //     ],
        //     'body' => json_encode($list_data),
        // ]);
    
        // if (is_wp_error($response_list)) {
        //     error_log('Błąd dodania do listy: ' . $response_list->get_error_message());
        // } else {
        //     var_dump('Kontakt został pomyślnie dodany do listy.');
        // }

        // var_dump($response_list);
    }
}