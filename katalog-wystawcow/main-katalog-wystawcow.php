<?php 
// Rejestracja elementu Katalog wystawców
function my_custom_wpbakery_element_katalog_wystawcow() {
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
            'type' => 'dropdown',
            'heading' => __('Select a color', 'my-custom-plugin'),
            'param_name' => 'color',
            'description' => __('Select a color for the element.', 'my-custom-plugin'),
            'value' => array(
              'Default' => '',
              'White' => '#ffffff',
              'Black' => '#000000'
            ),
            'save_always' => true
          ),
          array(
            'type' => 'textfield',
            'heading' => __( 'Enter Archive Year', 'my-custom-plugin' ),
            'param_name' => 'catalog_year',
            'description' => __( 'Enter year for display in catalog title.', 'my-custom-plugin' ),
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
        ),
        'description' => __( 'Enter description.', 'my-text-domain' )
    ));
}
  
// Zdefiniuj funkcję wyjścia dla elementu Katalog wystawców
function katalog_wystawcow_output($atts, $content = null) {

  if (isset($atts['identification'])) { $identification = $atts['identification']; }
  if (isset($atts['details'])) { $details = $atts['details']; }
  if (isset($atts['stand'])) { $stand = $atts['stand']; }
  if (isset($atts['format'])) { $format = $atts['format']; }
  if (isset($atts['ticket'])) { $ticket = $atts['ticket']; }
  if (isset($atts['color'])) { $color = $atts['color']; }
  if (isset($atts['export_link'])) { $export_link = $atts['export_link']; }
  if (isset($atts['catalog_year'])) { $catalog_year = $atts['catalog_year']; }
  if (isset($atts['slider_desctop'])) { $slider_desctop = $atts['slider_desctop']; }
  if (isset($atts['grid_mobile'])) { $grid_mobile = $atts['grid_mobile']; }

  $locale = get_locale();

  // If 'format' is not 'Top10', force 'ticket' to be false
  if ($format !== 'top10') {
      $ticket = 'false';
  }

  if ($color === '' || $color === '#ffffff'){
    $text_color = 'color:white !important';
    $text_shadow = 'text-shadow: 2px 2px black';
  } else {
    $text_color = 'color:black !important';
    $text_shadow = 'text-shadow: 2px 2px white';
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
  $name = do_shortcode('[trade_fair_name]');
  $name_eng = do_shortcode('[trade_fair_name_eng]');

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

  // KATALOG
  if($format === 'full'){

    if (current_user_can('administrator')  && !is_admin()) {
      ?><script>
        var katalog_data = <?php echo json_encode($script_data); ?>;
        console.log(katalog_data.data)
      </script><?php
    }

    $output = '
    <div custom-lang="' . $locale . '" id="'. $format .'">
      <div class="exhibitors">
        <div class="exhibitor__header" style="background-image: url(&quot;/doc/background.jpg&quot;);">';
          if($locale == 'pl_PL') {
            $output .= '<div>
                    <h1 style="text-align: center; '. $text_color. ';' . $text_shadow . '">Katalog wystawców '.$catalog_year.'</h1>
                    <h2 style="text-align: center; '. $text_color. ';' . $text_shadow . '">'. $name . '</h2>
                  </div>
                  <input id="search" placeholder="Szukaj"/>';
          } else {
            $output .= '<div>
                    <h1 style="text-align: center; '. $text_color. ';' . $text_shadow . '">Exhibitors Catalog '.$catalog_year.'</h1>
                    <h2 style="text-align: center; '. $text_color. ';' . $text_shadow . '">'. $name . '</h2>
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
    $output = '<div custom-lang="' . $locale . '" id="'. $format .'">';
    $output .= '<div class="img-container-'. $format .'">';

    $count = 0;
    $displayedCount = 0;
    
    if ($format === 'top21') {
      $slider_images_url = array();
      while ($displayedCount < 21 && $count < count($exhibitors)) {
        if (!empty($exhibitors[$count]['URL_logo_wystawcy'])) {
          $url = str_replace('$2F', '/', $exhibitors[$count]['URL_logo_wystawcy']);
          $singleLogo = '';
          if (($slider_desctop && (!preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT']))) || (!$grid_mobile && (preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT'])))){
            $slider_images_url[] = $url;
          } elseif (!empty($url)) {
            $singleLogo .= '<div style="background-image: url(' . $url . ');"></div>';
            $output .= $singleLogo;
          }
          $displayedCount++;
        }
        $count++;
      }

      if (count($slider_images_url) > 0){
        include_once plugin_dir_path(__FILE__) . 'slider.php';
        $output .= custom_media_slider($slider_images_url);
      }
      
      $output .= '</div>';
      if ($locale == 'pl_PL') {
          $output .= '
            <div>
              <span style="display: flex; justify-content: center;" class="btn-container ">
                  <a href="/katalog-wystawcow" class="custom-link btn border-width-0 btn-accent btn-square" title="Katalog wystawców">Zobacz więcej</a>
              </span>
            </div>';
      } else {
          $output .= '
            <div>
              <span style="display: flex; justify-content: center;" class="btn-container">
                  <a href="/en/exhibitors-catalog/" class="custom-link btn border-width-0 btn-accent btn-square" title="Exhibitor Catalog">See more</a>
              </span>
            </div>';
      }
    } else if ($format === 'top10') {
      while ($displayedCount < 10 && $count < count($exhibitors)) {
        if (!empty($exhibitors[$count]['URL_logo_wystawcy'])) {
            $url = str_replace('$2F', '/', $exhibitors[$count]['URL_logo_wystawcy']);
            $singleLogo = '';

            if (($slider_desctop && (!preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT']))) || (!$grid_mobile && (preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT'])))){
              $slider_images_url[] = $url;
            } elseif (!empty($url)) {
              $singleLogo = '<div style="background-image: url(' . $url . ');"></div>';
              $output .= $singleLogo;  
            }

            $displayedCount++;
        }
        $count++;
      }
      if (count($slider_images_url) > 0){
        include_once plugin_dir_path(__FILE__) . 'slider.php';
        $output .= custom_media_slider($slider_images_url);
      }

      $output .= '</div>';
    } else if ($format === 'recently7') {
      $slider_images_url = array();
      usort($exhibitors, function($a, $b) {
        return strtotime($b['Data_sprzedazy']) - strtotime($a['Data_sprzedazy']);
      });

      foreach ($exhibitors as $exhibitor) {
          // Pomijaj wystawcow, ktorzy nie maja URL logo
          if (empty($exhibitor['URL_logo_wystawcy'])) {
              continue;
          }
          $url = str_replace('$2F', '/', $exhibitor['URL_logo_wystawcy']);
          $singleLogo = '';

          if (($slider_desctop && (!preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT']))) || (!$grid_mobile && (preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT'])))){
            
            if($url){
              $slider_images_url[] = $url;
              $displayedCount++;
            }
          } elseif (!empty($url)) {
              $singleLogo .= '<div class="recent-7" style="background-image: url(' . $url . ');"></div>';
              $output .= $singleLogo;

              $displayedCount++;
          }

          $count++;

          if ($displayedCount >= 7 || $count >= count($exhibitors)) {
              break;
          }
      }

      if (count($slider_images_url) > 0){
        include_once plugin_dir_path(__FILE__) . 'slider.php';
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

  return $output;
}
// Rejestracja elementu Katalog wystawców
add_action( 'vc_before_init', 'my_custom_wpbakery_element_katalog_wystawcow' );
add_shortcode('katalog_wystawcow', 'katalog_wystawcow_output');

?>