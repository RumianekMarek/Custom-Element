<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: https://cleanexpo.pl/test-marek');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['HTTPS'] !== 'on') {
    header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit();
}

// Implement secure password handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $token = isset($_SERVER['HTTP_AUTHORIZATION']) ? $_SERVER['HTTP_AUTHORIZATION'] : '';
    $domain = 'https://' . $_SERVER ["HTTP_HOST"] . '/';
    $new_url = str_replace('private_html','public_html',$_SERVER["DOCUMENT_ROOT"]) .'/wp-load.php';

    if (validateToken($token, $domain)) {
        if (file_exists($new_url)) {
            require_once($new_url);
            if (class_exists('GFAPI')) {
                $all_forms = GFAPI::get_forms();
                foreach ($all_forms as $key => $value) {
                    //var_dump($value);
                    if ($data['options'][0] == $value['title']){
                        $form = $value;
                        break;
                    }
                }
                foreach ($data[$domain] as $value){
                    foreach ($form['fields'] as $id => $key){
                        //if(strtolower($key['label']))
                        var_dump($id);
                        echo '<br>';
                        var_dump($key);
                        echo '<br><br>';
                    }
                }

                echo 'WordPress YES';
                echo'<br><br>';
            } else {
                echo 'WordPress is not present on this site.';
                echo'<br><br>';
            }
        }
        echo 'valide';
        echo'<br><br>';
    } else {
        echo 'ivalide';
        echo'<br><br>';
        http_response_code(401);
        exit;
    }
}

function generateToken($domain) {
    $secret_key = 'T#8c$wrYz@jw2W3s6L7';
    return hash_hmac('sha256', $domain, $secret_key);
}

// Function to validate a token
function validateToken($token, $domain) {
    $expected_token = generateToken($domain);

    return hash_equals($expected_token, $token);
}