<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pliki']) && isset($_POST['kat']) && isset($_POST['kod']) == 'kodek') {

    function deleteDir($dirPath) {
        if (!is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
    
        if (substr($dirPath, -1) != '/') {
            $dirPath .= '/';
        }
    
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                deleteDir($file);
            } else {
                unlink($file);
            }
        }
    
        rmdir($dirPath);
    }
    

    $new_url = str_replace('private_html','public_html',$_SERVER["DOCUMENT_ROOT"]) .'/wp-load.php';
        if (file_exists($new_url)) {
            require_once($new_url);
        $katalog = ABSPATH . 'doc/' . $_POST['kat'] . '/';
        
        $response = array();
        foreach ($_POST['pliki'] as $plik){
            if (is_file($katalog . $plik)) {
                if (unlink($katalog . $plik)) {
                    $_SESSION['komunikat'] .= 'Plik <b>' . $plik . '</b> został usunięty ';
                } else {
                    $_SESSION['komunikat'] .= 'Wystąpił problem podczas usuwania pliku. ' . $plik;
                }
                $response .= ' Plik ' . $plik . ' został usunięty.<br>';
            } else if (is_dir($katalog . $plik)) {
                if($_POST['kat'] == ''){
                    if (rmdir($katalog . $plik)) {
                        $_SESSION['komunikat'] .= 'Plik <b>' . $plik . '</b> został usunięty ';
                    } else {
                        $_SESSION['komunikat'] .= 'Wystąpił problem podczas usuwania pliku. ' . $plik;
                    }
                    $response .= ' Plik ' . $plik . ' został usunięty.<br>';
                } else {
                    deleteDir($katalog . $plik);
                }
            } else {
                $response[$plik] = 'false';
            }
        }
        echo json_encode(['success' => 'true']);
    } else {
        echo json_encode(['success' => 'nie']);
    }
} else {
    echo json_encode(['success' => '403']);
}