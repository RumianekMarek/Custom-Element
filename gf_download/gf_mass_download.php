<?php

$new_url = str_replace('private_html','public_html',$_SERVER["DOCUMENT_ROOT"]) .'/wp-load.php';

// Check if wp-load.php is in find path.
if (file_exists($new_url)) {
    require_once($new_url);

    // Check if gravity form class GFAPI is available.
    if (class_exists('GFAPI')) {   
        
    }
}
