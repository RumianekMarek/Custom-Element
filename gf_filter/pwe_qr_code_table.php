<?php 
    $new_url = str_replace('private_html', 'public_html', $_SERVER["DOCUMENT_ROOT"]) . '/wp-load.php';
    require_once($new_url);

// Funkcja tworząca tabelę w bazie danych, jeśli nie istnieje
function qr_code_table_create($table_name) {
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        update_time DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
        form_id INT NOT NULL,
        entry_id INT NOT NULL,
        qr_code VARCHAR(100) NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

function qr_code_data_populate($table_name, $entry, $qr_code) {
    global $wpdb;

    if ($wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $table_name)) !== $table_name) {
        qr_code_table_create($table_name);
    }

    $wpdb->insert(
        $table_name,
        [
            'form_id' => $entry['form_id'],
            'entry_id' => $entry['id'],
            'qr_code' => $qr_code,
        ],
        [
            '%d',
            '%d',
            '%s',
        ]
    );

    if ($result === false) {
        error_log('QR insert failed: ' . $wpdb->last_error);
    }
}

$qr_feeds = GFAPI::get_feeds(NULL, $entry['form_id']);
$qr_code = '';
$qr_exists = false;
var_dump($qr_feeds);
foreach ($qr_feeds as $feed) {
    if(!empty($feed["addon_slug"]) && $feed["addon_slug"] == 'qr-code'){
        $qr_code .= $feed['meta']['qrcodeFields'][0]['custom_key'] . $entry['id'] . $feed['meta']['qrcodeFields'][1]['custom_key'] . $entry['id'] . ' ';
        $qr_exists = true;
    }
}

if ($qr_exists){
    global $wpdb;
    $table_name = $wpdb->prefix . 'pwe_qr_code_table';
    qr_code_data_populate($table_name, $entry, $qr_code);
}