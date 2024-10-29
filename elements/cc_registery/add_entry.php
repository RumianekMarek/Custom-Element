<?php 

$report['status'] = false;

$new_url = str_replace('private_html','public_html',$_SERVER["DOCUMENT_ROOT"]) .'/wp-load.php';
if (file_exists($new_url)) {
    require_once($new_url);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['secret'] == SECURE_AUTH_KEY) {
        if (class_exists('GFAPI')) {
            $post_data = $_POST['data'];
            
            $report['data'] = $post_data;
            $report['status'] = true;
            echo json_encode($report, true);
        }
    }
}