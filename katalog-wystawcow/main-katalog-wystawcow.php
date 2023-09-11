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
            'type' => 'checkbox',
            'heading' => __('Show details', 'my-custom-plugin'),
            'param_name' => 'details',
            'description' => __('Check to use to show details.', 'my-custom-plugin'),
            'admin_label' => true,
            'value' => array(__('True', 'my-custom-plugin') => 'true',),
          ),
          array(
            'type' => 'checkbox',
            'heading' => __('Ticket check', 'my-custom-plugin'),
            'param_name' => 'ticket',
            'description' => __('Check if there is a ticket above', 'my-custom-plugin'),
            'admin_label' => true,
            'value' => array(__('True', 'my-custom-plugin') => 'true',),
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
        ),
        'description' => __( 'Enter description.', 'my-text-domain' )
    ));
}
  
// Zdefiniuj funkcję wyjścia dla elementu Katalog wystawców
function katalog_wystawcow_output($atts, $content = null) {

  if (isset($atts['identification'])) { $identification = $atts['identification']; }
  if (isset($atts['details'])) { $details = $atts['details']; }
  if (isset($atts['format'])) { $format = $atts['format']; }
  if (isset($atts['ticket'])) { $ticket = $atts['ticket']; }
  if (isset($atts['color'])) { $color = $atts['color']; }

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

  $json = file_get_contents($canUrl);
  $data = json_decode($json, true);
  $name = do_shortcode('[trade_fair_name]');
  $name_eng = do_shortcode('[trade_fair_name_eng]');


  $script_data = array(
      'data' => $data,
      'json' => $json,
      'id_targow' => $id_targow,
      'details' => $details,
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

  // Twój kod dla tego elementu
  if($format === 'full'){
    if($locale == 'pl_PL'){
      $output = '
      <div custom-lang="' . $locale . '" id="'. $format .'">
        <div class="exhibitors">
          <div class="exhibitor__header" style="background-image: url(&quot;/doc/background.jpg&quot;);">
            <div>
              <h1 style="text-align: center; '. $text_color. ';' . $text_shadow . '">Katalog wystawców</h1>
              <h2 style="text-align: center; '. $text_color. ';' . $text_shadow . '">'. $name . '</h2>
            </div>
            <input id="search" placeholder="Szukaj"/>
          </div>
        </div>
      </div>';
    } else {
      $output = '
      <div custom-lang="' . $locale . '" id="'. $format .'">
        <div class="exhibitors">
          <div class="exhibitor__header" style="background-image: url(&quot;/doc/background.jpg&quot;);">
            <div>
              <h1 style="text-align: center; '. $text_color. ';' . $text_shadow . '">Exhibitor Catalog</h1>
              <h2 style="text-align: center; '. $text_color. ';' . $text_shadow . '">'. $name . '</h2>
            </div>
            <input id="search" placeholder="Search"/>
          </div>
        </div>
      </div>';
    }
    
  } else {
    $output = '<div custom-lang="' . $locale . '" id="'. $format .'">';
    $output .= '<div class="img-container">';

    $count = 0;
    $displayedCount = 0;

    if ($format === 'top21') {
      while ($displayedCount < 21 && $count < count($exhibitors)) {
        if (!empty($exhibitors[$count]['URL_logo_wystawcy'])) {
            $url = str_replace('$2F', '/', $exhibitors[$count]['URL_logo_wystawcy']);
            $singleLogo = '';

            if (!empty($url)) {
              if ($katalog_data['ticket'] == 'true') {
                $singleLogo .= '<div class="tickets" style="background-image: url(' . $url . ');"></div>';
                $output .= $singleLogo;
              } else {
                $singleLogo .= '<div style="background-image: url(' . $url . ');"></div>';
                $output .= $singleLogo;
              }   
            }

            $displayedCount++;
        }
        $count++;
      }
      $output .= '</div>';

      if ($locale == 'pl_PL') {
          $output .= '
            <div>
              <span style="display: flex; justify-content: center;" class="btn-container">
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

            if ($katalog_data['ticket'] == 'true') {
                $singleLogo = '<div class="tickets">';
            }

            if (!empty($url)) {
                $singleLogo .= '<div style="background-image: url(' . $url . ');"></div>';
                $output .= $singleLogo;
            }

            $displayedCount++;
        }
        $count++;
      }
      $output .= '</div>';
    } else if ($format === 'recently7') {

      $emptySlots = 7;

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

          if ($katalog_data['ticket'] == 'true') {
              $singleLogo = '<div class="tickets">';
          }

          if (!empty($url)) {
              $singleLogo .= '<div style="background-image: url(' . $url . ');"></div>';
              $output .= $singleLogo;

              // Data pod obrazkiem
              // if (!empty($exhibitor['Data_sprzedazy'])) {
              //     $output .= '<div class="exhibitor-date">' . $exhibitor['Data_sprzedazy'] . '</div>';
              // }

              $displayedCount++;
          }

          $count++;

          if ($displayedCount >= 7 || $count >= count($exhibitors)) {
              break;
          }
      }
      while ($displayedCount < 7 && $emptySlots > 0) {
          $output .= '<div class="empty-slot"></div>';
          $displayedCount++;
          $emptySlots--;
      }
      $output .= '</div>';
    }
    $output .= '</div>';

  }
 
  $spinner = '<div class="spinner"></div>';
  if (empty($spinner)) {
    $output .= '<div class="spinner"></div>';
  }


  wp_enqueue_style( 'katalog_wystawcow-css', plugin_dir_url( __FILE__ ) . 'katalog.css' );
  wp_enqueue_script( 'katalog_wystawcow-js', plugin_dir_url( __FILE__ ) . 'katalog.js', array( 'jquery' ), '1.0', true );
  wp_localize_script( 'katalog_wystawcow-js', 'katalog_data', $script_data );

  return $output;
}
// Rejestracja elementu Katalog wystawców
add_action( 'vc_before_init', 'my_custom_wpbakery_element_katalog_wystawcow' );
add_shortcode('katalog_wystawcow', 'katalog_wystawcow_output');


?>


