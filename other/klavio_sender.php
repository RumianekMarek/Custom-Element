<?php
function klavio_sender($entry, $form){
    $dom_name = explode('.', do_shortcode('[trade_fair_domainadress]'));

    $pattern = '/^\(20\d{2}\) Rejestracja (PL|EN)( \(header\))?$/';
    if (!preg_match($pattern, $form['title'])){
        return;
    }

    if (strpos(strtolower($form['title']), 'pl') !== false ) {
        $klavio_list_id = 'TKhJfW';
        $dom_id = $dom_name[0] . '_pl';
    } else {
        $klavio_list_id = 'WCvciT';
        $dom_id = $dom_name[0] . '_en';
    }

    foreach($form['fields'] as $field){
        
        if(strpos(strtolower($field['label']), 'email') !== false){
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

    if(isset($email_id)){
        $email = rgar($entry, $email_id);
    } else {
        $email = '';
    }
    if(isset($phone_id)){
        $phone = rgar($entry, $phone_id);
    } else {
        $phone = '';
    }
    if(isset($utm_id)){
        $utm = rgar($entry, $utm_id);
    } else {
        $utm = '';
    }

    $email_array = explode('@', $email);
    $name = $email_array[0];

    $data = [
        "data" => [
            "type" => "profile-bulk-import-job",
            "attributes" => [
                "profiles" => [
                    "data" => [
                        [
                            "type" => "profile",
                            "attributes" => [
                                "email" => $email,
                                "first_name" => $name,
								"properties" => [
                                    "utm_" . $dom_id => $utm,
                                    "phone_" . $dom_id => $phone,
									"qr_code_" . $dom_id => $qr_code_url,
								]
                            ]
                        ]
                    ]
                ]
            ],
           "relationships" => [
                "lists" => [
                    "data" => [
                        [
                            "type" => "list",
                            "id" => $klavio_list_id,
                        ]
                    ]
				]
			]	
        ]
    ];

    $args = [
        'body'        => wp_json_encode($data),
        'headers'     => [
            'Content-Type' => 'application/json',
            'Authorization' => 'Klaviyo-API-Key pk_b7b2bb8effe9e4d7d595e997fd0bf6c9ab',
            'Accept' => 'application/json',
            'Revision' => '2024-07-15'
        ],
        'method'      => 'POST',
        'data_format' => 'body',
    ];

    $response = wp_remote_post('https://a.klaviyo.com/api/profile-bulk-import-jobs/', $args);
    if (is_wp_error($response)) {
        $error_message = $response->get_error_message();
        error_log("Something went wrong: $error_message");
    } else {
        error_log('Profile successfully added to Klaviyo');
    }
}