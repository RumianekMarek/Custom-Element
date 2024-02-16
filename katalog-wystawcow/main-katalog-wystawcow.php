<?php
// Rejestracja elementu Katalog wystawców
function my_custom_wpbakery_element_katalog_wystawcow() {

    // GET UNCODE COLORS LIST
    $uncode_options = get_option('uncode');
    $accent_uncode_color = $uncode_options["_uncode_accent_color"];

    global $custom_element_colors;
    $custom_element_colors = array();
    $accent_color_value = '';

    if (isset($uncode_options["_uncode_custom_colors_list"]) && is_array($uncode_options["_uncode_custom_colors_list"])) {
        $custom_colors_list = $uncode_options["_uncode_custom_colors_list"];

        foreach ($custom_colors_list as $color) {
            $title = $color['title'];
            $color_value = $color["_uncode_custom_color"];
            $color_id = $color["_uncode_custom_color_unique_id"];

            if ($accent_uncode_color == $color_id) {
                $accent_color_value = $color_value;
            } else {
                $custom_element_colors[$title] = $color_value;
            }
        }

        if (!empty($accent_color_value)) {
            $custom_element_colors = array_merge(array('Accent' => $accent_color_value), $custom_element_colors);
        }
    }

    vc_map( array(
        'name' => __( 'Katalog wystawców', 'my-custom-plugin' ),
        'base' => 'katalog_wystawcow',
        'category' => __( 'My Elements', 'my-custom-plugin' ),
        'params' => array(
          array(
            'type' => 'textfield',
            'heading' => __( 'Enter ID', 'my-custom-plugin' ),
            'param_name' => 'identification',
            'description' => __( 'Enter trade fair ID number.', 'my-custom-plugin' ),
            'save_always' => true,
            'admin_label' => true
          ),
          array(
            'type' => 'textfield',
            'heading' => __( 'Enter Archive Year <br>or Title in "..." ', 'my-custom-plugin' ),
            'param_name' => 'catalog_year',
            'description' => __( 'Enter year for display in catalog title or us "" to change full title.', 'my-custom-plugin' ),
            'save_always' => true,
            'admin_label' => true
          ),
          array(
            'type' => 'dropdown',
            'heading' => __( 'Catalog format', 'my-custom-plugin' ),
            'param_name' => 'format',
            'description' => __( 'Select catalog format.', 'my-custom-plugin' ),
            'value' => array(
              'Select' => '',
              'Full' => 'full',
              'Top21' => 'top21',
              'Top10' => 'top10',
              'Recently7' => 'recently7'
            ),
            'save_always' => true,
            'admin_label' => true
          ),
          array(
            'type' => 'checkbox',
            'heading' => __('Show details', 'my-custom-plugin'),
            'param_name' => 'details',
            'description' => __('Check to use to show details. ONLY full catalog.', 'my-custom-plugin'),
            'admin_label' => true,
            'value' => array(__('True', 'my-custom-plugin') => 'true',),
          ),
          array(
            'type' => 'checkbox',
            'heading' => __('Hide stand', 'my-custom-plugin'),
            'param_name' => 'stand',
            'description' => __('Check to use to hide stand. ONLY full catalog.', 'my-custom-plugin'),
            'admin_label' => true,
            'value' => array(__('True', 'my-custom-plugin') => 'true',),
          ),
          array(
            'type' => 'checkbox',
            'heading' => __('Ticket check', 'my-custom-plugin'),
            'param_name' => 'ticket',
            'description' => __('Check if there is a ticket above. ONLY top10.', 'my-custom-plugin'),
            'admin_label' => true,
            'value' => array(__('True', 'my-custom-plugin') => 'true',),
            'dependency' => array(
              'element' => 'format',
              'value' => array('top10')
            ),
          ),
          array(
            'type' => 'checkbox',
            'heading' => __('Slider desctop', 'my-custom-plugin'),
            'param_name' => 'slider_desctop',
            'description' => __('Check if you want to display in slider on desctop.', 'my-custom-plugin'),
            'admin_label' => true,
            'save_always' => true,
            'value' => array(__('True', 'my-custom-plugin') => 'true',),
          ),
          array(
            'type' => 'checkbox',
            'heading' => __('Grid mobile', 'my-custom-plugin'),
            'param_name' => 'grid_mobile',
            'description' => __('Check if you want to display in grid on mobile.', 'my-custom-plugin'),
            'admin_label' => true,
            'save_always' => true,
            'value' => array(__('True', 'my-custom-plugin') => 'true',),
          ),
          array(
            'type' => 'textfield',
            'heading' => __( 'Export link', 'my-custom-plugin' ),
            'param_name' => 'export_link',
            'description' => __( 'Export link', 'my-custom-plugin' ),
            'save_always' => true,
            'admin_label' => true
          ),
          array(
            'type' => 'textfield',
            'heading' => __( 'Logos changer', 'my-custom-plugin' ),
            'param_name' => 'file_changer',
            'description' => __( 'Changer for logos divided by ";" try to put names <br> change places "name<=>name or position";<br> move to position "name=>>name or position";', 'my-custom-plugin' ),
            'save_always' => true,
            'dependency' => array(
              'element' => 'format',
              'value' => array('top10', 'top21', 'full'),
            ),
          ),
          array(
            'type' => 'dropdown',
            'heading' => __('Select a color', 'my-custom-plugin'),
            'param_name' => 'color',
            'description' => __('Select a color for the element.', 'my-custom-plugin'),
            'value' => array_merge(
              array('Default' => ''),
              $custom_element_colors
            ),
            'save_always' => true
          ),
          array(
            'type' => 'dropdown',
            'heading' => __('Select button color', 'my-custom-plugin'),
            'param_name' => 'btn_color',
            'description' => __('Select button color for the element.', 'my-custom-plugin'),
            'value' => array_merge(
              array('Default' => ''),
              $custom_element_colors
            ),
            'save_always' => true
          ),
          array(
            'type' => 'dropdown',
            'heading' => __('Select button color text', 'my-custom-plugin'),
            'param_name' => 'btn_color_text',
            'description' => __('Select button color text for the element.', 'my-custom-plugin'),
            'value' => array_merge(
              array('Default' => ''),
              $custom_element_colors
            ),
            'save_always' => true
          ),
        ),
        'description' => __( 'Enter description.', 'my-text-domain' )
    ));
}

// Zdefiniuj funkcję wyjścia dla elementu Katalog wystawców
function katalog_wystawcow_output($atts, $content = null) {
  include_once plugin_dir_path(__FILE__) . '/../scripts/slider.php';

  $locale = get_locale();

  if (!empty($atts['identification'])) {
    $identification = $atts['identification']; 
  } else {
    $identification = do_shortcode('[trade_fair_catalog]');
  }
  
  if (isset($atts['details'])) { $details = $atts['details']; }
  if (isset($atts['stand'])) { $stand = $atts['stand']; }
  if (isset($atts['format'])) { $format = $atts['format']; }
  if (isset($atts['ticket'])) { $ticket = $atts['ticket']; }
  if (isset($atts['color'])) { $color = $atts['color']; }
  if (isset($atts['export_link'])) { $export_link = $atts['export_link']; }
  
  if (isset($atts['slider_desctop'])) { $slider_desctop = $atts['slider_desctop']; }
  if (isset($atts['grid_mobile'])) { $grid_mobile = $atts['grid_mobile']; }
  if ($atts['file_changer'] != '') { $file_changer = $atts['file_changer']; $file_changer = str_replace('&lt;','<',$file_changer); $file_changer = str_replace('&gt;','>',$file_changer); $file_changer = explode(';' , $file_changer); }
  
  if (isset($atts['catalog_year'])) { $catalog_title = str_replace('``', '"', $atts['catalog_year']); }
  if(isset($catalog_title) && $catalog_title[0] == '"' && $catalog_title[strlen($catalog_title) - 1] == '"'){
      $catalog_title = trim($catalog_title, '"');
  } elseif($format == 'full') {
    if($locale == 'pl_PL') {$catalog_title = 'Katalog wystawców '.$catalog_title;}
    else {$catalog_title = 'Exhibitor Catalog '.$catalog_title;}
  } elseif($format == 'top21') {
    if($locale == 'pl_PL') {$catalog_title = 'WYSTAWCY '.do_shortcode('[trade_fair_catalog_year]');}
    else {$catalog_title = 'EXHIBITORS '.do_shortcode('[trade_fair_catalog_year]');}
  } elseif($format == 'top10') {
    if($locale == 'pl_PL') {$catalog_title = 'WYSTAWCY '.do_shortcode('[trade_fair_catalog_year]');}
    else {$catalog_title = 'EXHIBITORS '.do_shortcode('[trade_fair_catalog_year]');}
  } elseif($format == 'recently7') {
    if($locale == 'pl_PL') {$catalog_title = 'NOWI WYSTAWCY NA TARGACH '.$catalog_title;}
    else {$catalog_title = 'NEW EXHIBITORS AT THE FAIR '.$catalog_title;}
  }

  $slider_images_url = array();

  // If 'format' is not 'Top10', force 'ticket' to be false
  if ($format !== 'top10') {
      $ticket = 'false';
  }

  if ($color === '' || $color === '#ffffff'){
    $text_color = 'color:white !important';
    $text_shadow = 'text-shadow: 2px 2px black';
  } else if ($color === '#000000') {
    $text_color = 'color:black !important';
    $text_shadow = 'text-shadow: 2px 2px white';
  } else {
    $text_color = 'color:'. $atts['color'] .' !important';
  }

  global $custom_element_colors;

  if ($atts['btn_color'] === '') {
    $btn_color = '.btn {
        color: #ffffff !important;
        background-color: #000000 !important;
        border-color: #000000 !important;
        box-shadow: 9px 9px 0px -5px #ffffff !important;
    }';
    $btn_color_hover = '.btn:hover {
        color: #000000 !important;
        background-color: #ffffff !important;
        border-color: #000000 !important;
    }';
  } else if (($atts['btn_color'] === '#000000') || 
  ($atts['btn_color'] === '#101213') || 
  ($atts['btn_color'] === '#141618') ||
  ($atts['btn_color'] === '#1b1d1f') ||
  ($atts['btn_color'] === '#303133')) {
    $btn_color = '.btn {
        color: #ffffff !important;
        background-color: '. $atts['btn_color'] .' !important;
        border-color: '. $atts['btn_color'] .' !important;
        box-shadow: 9px 9px 0px -5px #ffffff !important;
    }';
    $btn_color_hover = '.btn:hover {
        color: #000000 !important;
        background-color: #ffffff !important;
        border-color: '. $atts['btn_color'] .' !important;
        box-shadow: 9px 9px 0px -5px #ffffff !important;
    }';
  } else if (($atts['btn_color'] === '#ffffff') || 
  ($atts['btn_color'] === '#f7f7f7') || 
  ($atts['btn_color'] === '#eaeaea') ||
  ($atts['btn_color'] === '#dddddd') ||
  ($atts['btn_color'] === '#777777')) {
    $btn_color = '.btn {
        color: #000000 !important;
        background-color: '. $atts['btn_color'] .' !important;
        border-color: #000000 !important;
        box-shadow: 9px 9px 0px -5px '. $atts['btn_color_text'] .' !important;
    }';
    $btn_color_hover = '.btn:hover {
        color: #ffffff !important;
        background-color: #000000 !important;
        border-color: #ffffff !important;
        box-shadow: 9px 9px 0px -5px #000000 !important;
    }';
  } else {
    $btn_color = '.btn {
        color: '. $atts['btn_color_text'] .' !important;
        background-color: '. $atts['btn_color'] .' !important;
        border-color: '. $atts['btn_color'] .' !important;
        box-shadow: 9px 9px 0px -5px #000000 !important;
    }';
    $btn_color_hover = '.btn:hover {
      color: #000000 !important;
      background-color: #ffffff !important;
      border-color: '. $atts['btn_color'] .' !important;
    }';
  }

  $id_targow = $identification;
  $today = new DateTime();
  $formattedDate = $today->format('Y-m-d');
  $token = md5("#22targiexpo22@@@#".$formattedDate);
  $canUrl = 'https://export.www2.pwe-expoplanner.com/mapa.php?token='.$token.'&id_targow='.$id_targow;

  if ($export_link === 'https://www4.pwe-expoplanner.com/sklep/importy/api2/wystawcy3.php?token=') {
    $canUrl = 'https://www4.pwe-expoplanner.com/sklep/importy/api2/wystawcy3.php?token='.$token.'&id_targow='.$id_targow;
    
    
    if (current_user_can('administrator')  && !is_admin()) {
      ?><script>console.log("www4")</script><?php
    }
  } else {
    $canUrl = 'https://export.www2.pwe-expoplanner.com/mapa.php?token='.$token.'&id_targow='.$id_targow;
  }

  $json = file_get_contents($canUrl);
  $data = json_decode($json, true);

  if ($file_changer != '' && ($format === 'top21' || $format === 'top10' || $format === 'full')) {
    foreach ($file_changer as $change) {
      $change = trim($change);

      if (strpos($change, '<=>') !== false) {
        $id = [];
        $names = trim(explode('<=>', $change));
        foreach($names as $name){
          $name = trim($name);
          if(is_numeric($name)){
            $id[] = $name. '.00';
          } else {
            $found = false;
            foreach($data[$id_targow]['Wystawcy'] as $index => $exhi){
              if(stripos($exhi['Nazwa_wystawcy'],  $name) !== false){
                $id[] = $index;
                $found = true;
                break;
              }
            }
            if (!$found) {
              echo '<script>console.error("nie znaleziono wystawcy ' . $name . '")</script>';
              break;
            }
          }
        }

        if($id[0] && $id[1] && count($data[$id_targow]['Wystawcy']) > $id[0] && count($data[$id_targow]['Wystawcy']) > $id[1]){
          list($data[$id_targow]['Wystawcy'][$id[0]], $data[$id_targow]['Wystawcy'][$id[1]]) = [$data[$id_targow]['Wystawcy'][$id[1]], $data[$id_targow]['Wystawcy'][$id[0]]];
        } elseif($id[0] && $id[1]) {
          echo '<script>console.error("lista zawiera tylko '. count($data[$id_targow]['Wystawcy']) .' wystawców, wystawców, sprawdź poprawność '.$change.'")</script>';
        }
      }
      elseif (strpos($change, '=>>') !== false) {
        $id = [];
        $names = explode('=>>', $change);
        foreach($names as $name){
          $name = trim($name);
          if(is_numeric($name)){
            $id[] = $name.'.00';
          } else {
            $found = false;
            foreach($data[$id_targow]['Wystawcy'] as $index => $exhi){
              if(stripos($exhi['Nazwa_wystawcy'],  $name) !== false){
                $id[] = $index;
                $found = true;
                break;
              }
            }
            if (!$found) {
              echo '<script>console.error("nie znaleziono wystawcy ' . $name . '")</script>';
              break;
            }
          }
        }

        if(count($data[$id_targow]['Wystawcy']) > $id[0] && count($data[$id_targow]['Wystawcy']) > $id[1]){
          if($id[0]>$id[1]){
            $temp = $data[$id_targow]['Wystawcy'][$id[1]];
            $data[$id_targow]['Wystawcy'][$id[1]] = $data[$id_targow]['Wystawcy'][$id[0]];

            for($i = ($id[1]+1).'.00'; $i<$id[0]; $i= ($i+1).".00"){

              $temp1 = $data[$id_targow]['Wystawcy'][$i];
              $data[$id_targow]['Wystawcy'][$i] = $temp;
              $temp = $temp1;
            }
            $data[$id_targow]['Wystawcy'][$id[0]] = $temp;
          } else {
            $temp = $data[$id_targow]['Wystawcy'][$id[1]];
            $data[$id_targow]['Wystawcy'][$id[1]] = $data[$id_targow]['Wystawcy'][$id[0]];

            for($i = ($id[1]-1).'.00'; $i>$id[0]; $i= ($i-1).'.00'){
              $temp1 = $data[$id_targow]['Wystawcy'][$i];
              $data[$id_targow]['Wystawcy'][$i] = $temp;
              $temp = $temp1;
            }
            $data[$id_targow]['Wystawcy'][$id[0]] = $temp;
          }
        } else {
          echo '<script>console.error("lista zawiera tylko '. count($data[$id_targow]['Wystawcy']) .' wystawców, sprawdź poprawność '.$change.'")</script>';
        }
      }
    }
  }

  $script_data = array(
      'data' => $data,
      'json' => $json,
      'id_targow' => $id_targow,
      'details' => $details,
      'stand' => $stand,
      'format' => $format,
      'ticket' => $ticket,
      'name' => $name,
      'name_en' => $name_eng,
      'text_color' => $text_color,
      'text_shadow' => $text_shadow,
  );

  // Pobieramy dane wystawcow
  $exhibitorsAll = $script_data['data'][$script_data['id_targow']]["Wystawcy"];

  // Przetwarzamy dane wystawcow i usuwamy duplikaty
  $exhibitors = array_reduce($exhibitorsAll, function($acc, $curr) {
      $name = $curr['Nazwa_wystawcy'];
      $existingEntry = array_filter($acc, function($item) use ($name) {
          return $item['Nazwa_wystawcy'] === $name;
      });
      if (empty($existingEntry)) {
          $acc[] = $curr;
      }

      return $acc;
  }, []);
    echo '<script>console.log("'.count($exhibitors).'")</script>';

  $trade_fair_name = do_shortcode('[trade_fair_name]');
  $trade_fair_name_eng = do_shortcode('[trade_fair_name_eng]');

  // KATALOG
  if($format === 'full'){
    $bg_link = file_exists($_SERVER['DOCUMENT_ROOT'] . '/doc/background.webp') ? '/doc/background.webp' : '/doc/background.jpg';

    $output = '
    <div custom-lang="' . $locale . '" id="'. $format .'">
      <div class="exhibitors">
        <div class="exhibitor__header" style="background-image: url(&quot;'. $bg_link .'&quot;);">';
          if($locale == 'pl_PL') {
            $output .= '<div>
                    <h1 style="text-align: center; '. $text_color. ';' . $text_shadow . '">'.$catalog_title.'</h1>
                    <h2 style="text-align: center; '. $text_color. ';' . $text_shadow . '">'. $trade_fair_name . '</h2>
                  </div>
                  <input id="search" placeholder="Szukaj"/>';
          } else {
            $output .= '<div>
                    <h1 style="text-align: center; '. $text_color. ';' . $text_shadow . '">'.$catalog_title.'</h1>
                    <h2 style="text-align: center; '. $text_color. ';' . $text_shadow . '">'. $trade_fair_name_eng . '</h2>
                  </div>
                  <input id="search" placeholder="Search"/>';
          }
          $output .= '</div>';

        $allExhibitorsArray = '';
        $divContainerExhibitors = '<div class="exhibitors__container">';
        // WYSTAWCY
        foreach ($exhibitors as $exhibitor) {
          $singleExhibitor = '<div class="exhibitors__container-list">';
          if ($exhibitor['URL_logo_wystawcy']) {
            $singleExhibitor .= '<div class="exhibitors__container-list-img" style="background-image: url(' . $exhibitor['URL_logo_wystawcy'] . ')"></div>';
          }
          if ($stand !== 'true') {
              $singleExhibitor .= '<div class="exhibitors__container-list-text">';
              $singleExhibitor .= '<h2 class="exhibitors__container-list-text-name">' . $exhibitor['Nazwa_wystawcy'] . '</h2>';
              if ($locale == 'pl_PL') {
                $singleExhibitor .= '<p>' . $exhibitor['Numer_stoiska'] . '</p>';
              } else {
                  $singleExhibitor .= '<p>' . $exhibitor['Numer_stoiska'] . '</p>';
              }
              $singleExhibitor .= '</div>';
          } else {
              $singleExhibitor .= '<h2 class="exhibitors__container-list-text-name">' . $exhibitor['Nazwa_wystawcy'] . '</h2>';
          }
          $singleExhibitor .= '</div>';
          $divContainerExhibitors .= $singleExhibitor;
          $allExhibitorsArray .= $singleExhibitor;
        }
        $divContainerExhibitors .= '</div>';
        $output .= $divContainerExhibitors;
        $output .= '</div></div>';
  } else {
    $output = '<div custom-lang="' . $locale . '" id="'. $format .'" class="custom-catalog main-heading-text">';

    if (isset($catalog_title) && !empty($catalog_title)){
        $output .= '<h2 class="catalog-custom-title" style="width: fit-content;">'.$catalog_title.'</h2>';
    }
    $output .= '<div class="img-container-'. $format .'">';

    $count = 0;
    $displayedCount = 0;

    if ($format === 'top21') {
      while ($displayedCount < 21 && $count < count($exhibitors)) {
        if (!empty($exhibitors[$count]['URL_logo_wystawcy'])) {
          $url = str_replace('$2F', '/', $exhibitors[$count]['URL_logo_wystawcy']);
          $urlWebsite = str_replace('$2F', '/', $exhibitors[$count]['www']);
          
          if (!empty($urlWebsite) && !preg_match("~^(?:f|ht)tps?://~i", $urlWebsite)) {
            $urlWebsite = "https://" . $urlWebsite;
          }
          
          $singleLogo = '';
          if (($slider_desctop && (!preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT']))) || (!$grid_mobile && (preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT'])))){
            $slider_images_url[] = array(
              'img'=> $url,
              'site'=> $urlWebsite,
            );
          } elseif (!empty($url)) {
            if(!empty($urlWebsite)){
              $singleLogo .= '<a target="_blank" href="'. $urlWebsite .'"><div style="background-image: url(' . $url . ');"></div></a>';
              $output .= $singleLogo;
            } elseif(empty($urlWebsite)){
              $singleLogo .= '<div style="background-image: url(' . $url . ');"></div>';
              $output .= $singleLogo;
            }
          }
          $displayedCount++;
        }
        $count++;
      }

      if (count($slider_images_url) > 0){
        $output .= custom_media_slider($slider_images_url);
      }

      if ($btn_color != ''){
        $btn_color = '#top21 .btn-container '.$btn_color;
        if ($btn_color_hover) {
            $btn_color_hover = '#top21 .btn-container '.$btn_color_hover;
        }
        echo '<style>';
                echo $btn_color;
                echo $btn_color_hover;
        echo '</style>';
      }

      $output .= '</div>';
      if ($locale == 'pl_PL') {
          $output .= '
            <div>
              <span style="display: flex; justify-content: center;" class="btn-container ">
                  <a href="/katalog-wystawcow" class="custom-link btn border-width-0 btn-accent btn-square shadow-black" title="Katalog wystawców">Zobacz więcej</a>
              </span>
            </div>';
      } else {
          $output .= '
            <div>
              <span style="display: flex; justify-content: center;" class="btn-container">
                  <a href="/en/exhibitors-catalog/" class="custom-link btn border-width-0 btn-accent btn-square shadow-black" title="Exhibitor Catalog">See more</a>
              </span>
            </div>';
      }
    } else if ($format === 'top10') {
      while ($displayedCount < 10 && $count < count($exhibitors)) {
        if (!empty($exhibitors[$count]['URL_logo_wystawcy'])) {
            $url = str_replace('$2F', '/', $exhibitors[$count]['URL_logo_wystawcy']);
            $urlWebsite = str_replace('$2F', '/', $exhibitors[$count]['www']);
            if (!empty($urlWebsite) && !preg_match("~^(?:f|ht)tps?://~i", $urlWebsite)) {
              $urlWebsite = "https://" . $urlWebsite;
            }

            $singleLogo = '';

            if (($slider_desctop && (!preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT']))) || (!$grid_mobile && (preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT'])))){        
              $slider_images_url[] = array(
                'img'=> $url,
                'site'=> $urlWebsite,
              );
            } elseif (!empty($url)) {
              if(!empty($urlWebsite)){
                $singleLogo .= '<a target="_blank" href="'. $urlWebsite .'"><div style="background-image: url(' . $url . ');"></div></a>';
                $output .= $singleLogo;
              } elseif(empty($urlWebsite)){
                $singleLogo .= '<div style="background-image: url(' . $url . ');"></div>';
                $output .= $singleLogo;
              }
            } 
            $displayedCount++;
        }
        $count++;
      }
      if (count($slider_images_url) > 0){
        $output .= custom_media_slider($slider_images_url);
      }

      $output .= '</div>';
    } else if ($format === 'recently7') {
      usort($exhibitors, function($a, $b) {
        return strtotime($b['Data_sprzedazy']) - strtotime($a['Data_sprzedazy']);
      });

      foreach ($exhibitors as $exhibitor) {
        
        // Pomijaj wystawcow, ktorzy nie maja URL logo
        if (empty($exhibitor['URL_logo_wystawcy'])) {
          continue;
        }

          $url = str_replace('$2F', '/', $exhibitor['URL_logo_wystawcy']);
          $urlWebsite = str_replace('$2F', '/', $exhibitor['www']);
          if (!empty($urlWebsite) && !preg_match("~^(?:f|ht)tps?://~i", $urlWebsite)) {
            $urlWebsite = "https://" . $urlWebsite;
          }
          $singleLogo = '';

          if (($slider_desctop && (!preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT']))) || (!$grid_mobile && (preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT'])))){
            $slider_images_url[] = array(
              'img'=> $url,
              'site'=> $urlWebsite,
            );
          } elseif (!empty($url)) {
            if(!empty($urlWebsite)){
              $singleLogo .= '<a target="_blank" href="'. $urlWebsite .'"><div style="background-image: url(' . $url . ');"></div></a>';
              $output .= $singleLogo;
            } elseif(empty($urlWebsite)){
              $singleLogo .= '<div style="background-image: url(' . $url . ');"></div>';
              $output .= $singleLogo;
            }
          }

          $displayedCount++;
          $count++;
          
          if ($displayedCount >= 7 || $count >= count($exhibitors)) {
              break;
          }
      }
      if (count($slider_images_url) > 0){
        $output .= custom_media_slider($slider_images_url);
      }
      $output .= '</div>';
    }
    $output .= '</div>';
  }

  $spinner = '<div class="spinner"></div>';
  if (empty($exhibitorsAll)) {
    $output .= $spinner;
  }
  $css_file = plugins_url('katalog.css', __FILE__);
  $js_file = plugins_url('katalog.js', __FILE__);
  $css_version = filemtime(plugin_dir_path(__FILE__) . 'katalog.css');
  $js_version = filemtime(plugin_dir_path(__FILE__) . 'katalog.js');
  wp_enqueue_style('katalog_wystawcow-css', $css_file, array(), $css_version);
  wp_enqueue_script('katalog_wystawcow-js', $js_file, array(), $js_version);
  wp_localize_script( 'katalog_wystawcow-js', 'katalog_data', $script_data );

  if (current_user_can('administrator')  && !is_admin()) {
    echo '<script>console.log("'.$canUrl.'")</script>';
    ?><script>
      var katalog_data = <?php echo json_encode($script_data); ?>;
      console.log(katalog_data.data["<?php echo $id_targow ?>"]["Wystawcy"])
    </script><?php
  }

  return $output;
}
// Rejestracja elementu Katalog wystawców
add_action( 'vc_before_init', 'my_custom_wpbakery_element_katalog_wystawcow' );
add_shortcode('katalog_wystawcow', 'katalog_wystawcow_output');

?>