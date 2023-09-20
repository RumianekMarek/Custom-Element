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
  if (isset($atts['stand'])) { $stand = $atts['stand']; }
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
    $output = '
    <div custom-lang="' . $locale . '" id="'. $format .'">
      <div class="exhibitors">
        <div class="exhibitor__header" style="background-image: url(&quot;/doc/background.jpg&quot;);">';
          if($locale == 'pl_PL') {
            $output .= '<div>
                    <h1 style="text-align: center; '. $text_color. ';' . $text_shadow . '">Katalog wystawców</h1>
                    <h2 style="text-align: center; '. $text_color. ';' . $text_shadow . '">'. $name . '</h2>
                  </div>
                  <input id="search" placeholder="Szukaj"/>';
          } else {
            $output .= '<div>
                    <h1 style="text-align: center; '. $text_color. ';' . $text_shadow . '">Exhibitor Catalog</h1>
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

  ?><script>
 
  document.addEventListener("DOMContentLoaded", function () {
    var katalog_data = <?php echo json_encode($script_data); ?>;
    if(katalog_data.data){

      /* SEARCH ELEMENT */
      const inputSearch = document.getElementById('search');
      var allExhibitorsArray = document.getElementsByClassName('exhibitors__container-list');
      inputSearch.addEventListener("input", () => {
        for (let i = 0; i < allExhibitorsArray.length; i++) {
          const exhibitorsNames = allExhibitorsArray[i].getElementsByTagName('h2')[0].innerText.toLocaleLowerCase();
          let isVisible = exhibitorsNames.includes(inputSearch.value.toLocaleLowerCase());
          allExhibitorsArray[i].classList.toggle("hide-post", !isVisible);
          allExhibitorsArray[i].classList.toggle("show-post", isVisible);
        }
      });
      
      var localLangKat = document.getElementById(katalog_data.format).getAttribute("custom-lang");	
      var exhibitors = <?php echo json_encode($exhibitors); ?>;

      /* MODAL ELEMENT */
      const modal = document.createElement('div');
      modal.classList.add('modal');
      modal.setAttribute('id', 'my-modal');

      for (let i = 0; i < allExhibitorsArray.length; i++) {
        allExhibitorsArray[i].addEventListener('click', () => {
          const url = exhibitors[i].URL_logo_wystawcy;
          url.replace('/', '$2F');

          var www = exhibitors[i].www;
          
          if (www !== false && www !== "") {
            if (www.indexOf('https://www.') !== -1) {
              www = 'https://' + www.replace(/^https:\/\/www\./i, '');
            } else if (www.indexOf('http://www.') !== -1) {
              www = 'https://' + www.replace(/^http:\/\/www\./i, '');
            } else if (www.indexOf('www.') !== -1) {
              www = 'https://' + www.replace(/^www\./i, '');
            } else if (www.indexOf('http://') !== -1) {
              www = 'https://' + www.substr(7);
            }
          }

          var modalBox = `<div class="modal__elements">
                            <div class="modal__elements-block">
                                ${url ? `<div class="modal__elements-img" style="background-image: url(${url});"></div>` : ''}
                                <div class="modal__elements-text">
                                  <h3>${exhibitors[i].Nazwa_wystawcy}</h3>`;

                                  if (katalog_data.details == 'true') {
                                    if (localLangKat == 'pl_PL') {
                                        modalBox += exhibitors[i].Telefon ? `<p>Numer telefonu: <b><a href="tel:${exhibitors[i].Telefon}">${exhibitors[i].Telefon}</a></b></p>` : '';
                                        modalBox += exhibitors[i].Email ? `<p>Adres email: <b><a href="mailto:${exhibitors[i].Email}">${exhibitors[i].Email}</a></b></p>` : '';
                                        modalBox += www ? `<p>Strona www: <b><a href="${www}" target="_blank" rel="noopener noreferrer">${www}</a></b></p>` : '';
                                        if (katalog_data.stand !== 'true') {
                                            modalBox += exhibitors[i].Numer_stoiska ? `<p>Stoisko: ${exhibitors[i].Numer_stoiska}</p>` : '';
                                        }
                                        modalBox += exhibitors[i].Opis_pl && localLangKat == "pl_PL" ? `<p>${exhibitors[i].Opis_pl}</p>` : '';
                                        modalBox += exhibitors[i].Opis_en && localLangKat == "en_US" ? `<p>${exhibitors[i].Opis_en}</p>` : '';
                                    } else {
                                        modalBox += exhibitors[i].Telefon ? `<p>Phone number: <b><a href="tel:${exhibitors[i].Telefon}">${exhibitors[i].Telefon}</a></b></p>` : '';
                                        modalBox += exhibitors[i].Email ? `<p>E-mail adress: <b><a href="mailto:${exhibitors[i].Email}">${exhibitors[i].Email}</a></b></p>` : '';
                                        modalBox += www ? `<p>Web page: <b><a href="${www}" target="_blank" rel="noopener noreferrer">${www}</a></b></p>` : '';
                                        if (katalog_data.stand !== 'true') {
                                            modalBox += exhibitors[i].Numer_stoiska ? `<p>Stand: ${exhibitors[i].Numer_stoiska}</p>` : '';
                                        }
                                        modalBox += exhibitors[i].Opis_pl && localLangKat == "pl_PL" ? `<p>${exhibitors[i].Opis_pl}</p>` : '';
                                        modalBox += exhibitors[i].Opis_en && localLangKat == "en_US" ? `<p>${exhibitors[i].Opis_en}</p>` : '';
                                    }
                                } else {
                                    if (localLangKat == 'pl_PL') {
                                        modalBox += exhibitors[i].Telefon ? `<p>Numer telefonu: <b><a href="tel:${exhibitors[i].Telefon}">${exhibitors[i].Telefon}</a></b></p>` : '';
                                        modalBox += exhibitors[i].Email ? `<p>Adres email: <b><a href="mailto:${exhibitors[i].Email}">${exhibitors[i].Email}</a></b></p>` : '';
                                        modalBox += www ? `<p>Strona www: <b><a href="${www}" target="_blank" rel="noopener noreferrer">${www}</a></b></p>` : '';
                                        if (katalog_data.stand !== 'true') {
                                            modalBox += exhibitors[i].Numer_stoiska ? `<p>Stoisko: ${exhibitors[i].Numer_stoiska}</p>` : '';
                                        }
                                    } else {
                                        modalBox += exhibitors[i].Telefon ? `<p>Phone number: <b><a href="tel:${exhibitors[i].Telefon}">${exhibitors[i].Telefon}</a></b></p>` : '';
                                        modalBox += exhibitors[i].Email ? `<p>E-mail adress: <b><a href="mailto:${exhibitors[i].Email}">${exhibitors[i].Email}</a></b></p>` : '';
                                        modalBox += www ? `<p>Web page: <b><a href="${www}" target="_blank" rel="noopener noreferrer">${www}</a></b></p>` : '';
                                        if (katalog_data.stand !== 'true') {
                                            modalBox += exhibitors[i].Numer_stoiska ? `<p>Stand: ${exhibitors[i].Numer_stoiska}</p>` : '';
                                        }
                                    }
                                }

          modalBox += `</div></div>
                              <div class="modal_elements-button">`;
          if (localLangKat == 'pl_PL') {
              modalBox += '<button class="close">Zamknij</button>';
          } else {
              modalBox += '<button class="close">Close</button>';
          }
          modalBox += `</div></div>`;

          modal.innerHTML = modalBox;
          document.getElementById('<?php echo $format ?>').appendChild(modal);
          modal.style.display = 'flex';

          const closeBtn = modal.querySelector(".close");

          closeBtn.addEventListener("click", function () {
            modal.style.display = "none";
          });

          window.addEventListener("click", function (event) {
            if (event.target == modal) {
              modal.style.display = "none";
            }
          });

        });
      };
    };
  });
  </script><?php    

        $output .= '</div></div>';
        
  } else {
    $output = '<div custom-lang="' . $locale . '" id="'. $format .'">';
    $output .= '<div class="img-container-'. $format .'">';

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

            if (!empty($url)) {
              if ($ticket == 'true') {
                $singleLogo = '<div class="tickets" style="background-image: url(' . $url . ');"></div>';
                $output .= $singleLogo;
              } else {
                $singleLogo = '<div style="background-image: url(' . $url . ');"></div>';
                $output .= $singleLogo;
              }   
            }

            $displayedCount++;
        }
        $count++;
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
          $singleLogo = '';

          if (!empty($url)) {
              $singleLogo .= '<div style="background-image: url(' . $url . ');"></div>';
              $output .= $singleLogo;

              $displayedCount++;
          }

          $count++;

          if ($displayedCount >= 7 || $count >= count($exhibitors)) {
              break;
          }
      }
      $output .= '</div>';
    }
    $output .= '</div>';
  }
 
  $spinner = '<div class="spinner"></div>';
  if (empty($exhibitorsAll)) {
    $output .= $spinner;
  }

  wp_enqueue_style( 'katalog_wystawcow-css', plugin_dir_url( __FILE__ ) . 'katalog.css' );

  return $output;
}
// Rejestracja elementu Katalog wystawców
add_action( 'vc_before_init', 'my_custom_wpbakery_element_katalog_wystawcow' );
add_shortcode('katalog_wystawcow', 'katalog_wystawcow_output');


?>