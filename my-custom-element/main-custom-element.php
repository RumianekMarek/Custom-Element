<?php

// Add the new WPBakery My Custom Element
function my_custom_wpbakery_element() {
    // Define the element name and path to the element file
    vc_map(array(
      'name' => __('My Custom Element', 'my-custom-plugin'),
      'base' => 'my_custom_element',
      'category' => __('My Elements', 'my-custom-plugin'),
      'admin_enqueue_css' => plugin_dir_url( __FILE__ ) . '/css/backendstyle.css',
      'params' => array(
        array(
          'type' => 'dropdown',
          'heading' => __('Select an element', 'my-custom-plugin'),
          'param_name' => 'element',
          'description' => __('Select an element to display its files.', 'my-custom-plugin'),
          'value' => array(
            'Select' => '',
            'Adres Ptak Warsaw Expo' => 'ptakAdress.php',
            'Dodaj do kalendarza' => 'calendarAdd.php',
            'Dodaj do Google Kalendarz' => 'calendarGoogle.html',
            'Dodaj do Outlook Kalendarz' => 'calendarOutlook.html',
            'Dodaj do Office 365 Kalendarz' => 'calendarOffice365.html',
            'Dodaj do Yahoo Kalendarz' => 'calendarYahoo.html',
            'Dodaj do Apple Kalendarz' => 'calendarApple.html',
            'Kalendarz do potwierdzenia' => 'confCalendar.php',
            'Dokumenty' => 'download.php',
            'Exhibitors-benefits'=> 'exhibitors-benefits.php',
            'FAQ' => 'faq.php',
            'For Exhibitors' => 'for-exhibitors.php',
            'For Visitors' => 'for-visitors.php',
            'Main Page Gallery - mini' => 'gallery.php',
            'Mini-Galery' => 'mini-gallery.php',
            'Nie przegap' => 'niePrzegap.php',
            'Gallery Slider' => 'gallery-slider.php',
            'Grupy zorganizowane' => 'grupy.php',
            'Informacje organizacyjne' => 'org-information.php',
            'Kontakt' => 'kontakt.php',
            'Logotype Gallery' => 'logos-catalog.php',
            'Organizator' => 'organizator.php',
            'Mapka dojazdu' => 'route.php',
            'Ramka Facebook' => 'socialMedia.php',
            'Timer' => 'main-timer.php',
            'Visitors Benefits' => 'visitors-benefits.php',
            'Voucher' => 'voucher.php',
            'Wydarzenia - ogólne informacje' => 'wydarzenia-ogolne.php',
            'Wypromój się na targach' => 'promote-yourself.php',
            'Zabudowa' => 'zabudowa.php',
          ),
          'save_always' => true,
          'admin_label' => true
        ),
        array(
          'type' => 'textfield',
          'heading' => __('Select a file', 'my-custom-plugin'),
          'param_name' => 'file',
          'description' => __('Select a file to display its gallerys.', 'my-custom-plugin'),
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
          'type' => esc_html__('textarea_raw_html'),
          'heading' => __('Text for Exhibitors 1', 'my-custom-plugin'),
          'param_name' => 'exhibitor1',
          'description' => __('Text ten pojawi się obok zdjęcia liczone od góry strony', 'my-custom-plugin'),
          'value' => base64_encode($exhibitor1),
          'save_always' => true,
          'dependency' => array(
            'element' => 'element',
            'value' => array('for-exhibitors.php')
          ),
        ),
        array(
          'type' => 'textarea_raw_html',
          'heading' => __('Text for Exhibitors 2', 'my-custom-plugin'),
          'param_name' => 'exhibitor2',
          'description' => __('Text ten pojawi się obok zdjęcia liczone od góry strony', 'my-custom-plugin'),
          'value' => base64_encode($exhibitor2),
          'save_always' => true,
          'dependency' => array(
            'element' => 'element',
            'value' => array('for-exhibitors.php')
          ),
        ),
        array(
          'type' => 'textarea_raw_html',
          'heading' => __('Text for Exhibitors 3', 'my-custom-plugin'),
          'param_name' => 'exhibitor3',
          'description' => __('Text ten pojawi się obok zdjęcia liczone od góry strony', 'my-custom-plugin'),
          'value' => base64_encode($exhibitor3),
          'save_always' => true,
          'dependency' => array(
            'element' => 'element',
            'value' => array('for-exhibitors.php')
          ),
        ),
        array(
          'type' => 'textarea_raw_html',
          'heading' => __('Text for Exhibitors 4', 'my-custom-plugin'),
          'param_name' => 'exhibitor4',
          'description' => __('Text ten pojawi się obok zdjęcia liczone od góry strony', 'my-custom-plugin'),
          'value' => base64_encode($exhibitor4),
          'save_always' => true,
          'dependency' => array(
            'element' => 'element',
            'value' => array('for-exhibitors.php')
          ),
        ),
        array(
          'type' => 'textarea_raw_html',
          'heading' => __('Text for Exhibitors 5', 'my-custom-plugin'),
          'param_name' => 'exhibitor5',
          'description' => __('Text ten pojawi się obok zdjęcia liczone od góry strony', 'my-custom-plugin'),
          'value' => base64_encode($exhibitor5),
          'save_always' => true,
          'dependency' => array(
            'element' => 'element',
            'value' => array('for-exhibitors.php')
          ),
        ),
        array(
          'type' => 'textarea_raw_html',
          'heading' => __('Text for Exhibitors 6', 'my-custom-plugin'),
          'param_name' => 'exhibitor6',
          'description' => __('Text ten pojawi się obok zdjęcia liczone od góry strony', 'my-custom-plugin'),
          'value' => base64_encode($exhibitor6),
          'save_always' => true,
          'dependency' => array(
            'element' => 'element',
            'value' => array('for-exhibitors.php')
          ),
        ),
        array(
          'type' => 'textarea_raw_html',
          'heading' => esc_html__('Text for Main Page Gallery', 'my-custom-plugin'),
          'param_name' => 'gallery',
          'value' => base64_encode($gallery),
          'save_always' => true,
          'dependency' => array(
              'element' => 'element',
              'value' => array('gallery.php')
          ),
        ),array(
          'type' => 'textfield',
          'heading' => esc_html__('Logos catalog and Galery name', 'my-custom-plugin'),
          'param_name' => 'logoscatalog',
          'description' => __('Put catalog name in /doc/ where are logos to show in gallery, and this text will by use as galery header.', 'my-custom-plugin'),
          'save_always' => true,
          'dependency' => array(
              'element' => 'element',
              'value' => array('logos-catalog.php')
          ),
        ),
        array(
          'type' => 'checkbox',
          'heading' => __('Dispaly different logo', 'my-custom-plugin'),
          'param_name' => 'promote_yourself',
          'description' => __('Check Yes to display different color logo.', 'my-custom-plugin'),
          'admin_label' => true,
          'save_always' => true,
          'value' => array(__('True', 'my-custom-plugin') => 'true',),
          'dependency' => array(
            'element' => 'element',
            'value' => array('promote-yourself.php')
          ),
        ),
        array(
          'type' => 'checkbox',
          'heading' => __('Hide baners', 'my-custom-plugin'),
          'param_name' => 'show_banners',
          'description' => __('Check Yes to hide download options for baners.', 'my-custom-plugin'),
          'admin_label' => true,
          'save_always' => true,
          'value' => array(__('True', 'my-custom-plugin') => 'true',),
          'dependency' => array(
            'element' => 'element',
            'value' => array('promote-yourself.php')
          ),
        ),
        array(
          'type' => 'checkbox',
          'heading' => __('Show gallery in slider', 'my-custom-plugin'),
          'param_name' => 'show_slider',
          'description' => __('Check to create gallery as slider .', 'my-custom-plugin'),
          'admin_label' => true,
          'save_always' => true,
          'value' => array(__('True', 'my-custom-plugin') => 'true',),
          'dependency' => array(
            'element' => 'element',
            'value' => array('logos-catalog.php')
          ),
        ),
        array(
          'type' => 'checkbox',
          'heading' => __('Hide registery button', 'my-custom-plugin'),
          'param_name' => 'tickets_available',
          'description' => __('Check to hide the registration button on Fair there is no registration available.', 'my-custom-plugin'),
          'admin_label' => true,
          'save_always' => true,
          'value' => array(__('True', 'my-custom-plugin') => 'true',),
          'dependency' => array(
            'element' => 'element',
            'value' => array('gallery.php')
          ),
        ),
        array(
          'type' => 'checkbox',
          'heading' => __('Show link url in gallery', 'my-custom-plugin'),
          'param_name' => 'showurl',
          'description' => __('Check to create a link in every logotype.', 'my-custom-plugin'),
          'admin_label' => true,
          'save_always' => true,
          'value' => array(__('True', 'my-custom-plugin') => 'true',),
          'dependency' => array(
            'element' => 'element',
            'value' => array('logos-catalog.php')
          ),
        ),
        array(
          'type' => 'textarea_raw_html',
          'heading' => __('Text for Visitors 1', 'my-custom-plugin'),
          'param_name' => 'visitor1',
          'description' => __('Text ten pojawi się obok zdjęcia liczone od góry strony', 'my-custom-plugin'),
          'value' => base64_encode($visitor1),
          'save_always' => true,
          'dependency' => array(
            'element' => 'element',
            'value' => array('for-visitors.php')
          ),
        ),
        array(
          'type' => 'textarea_raw_html',
          'heading' => __('Text for Visitors 2', 'my-custom-plugin'),
          'param_name' => 'visitor2',
          'description' => __('Text ten pojawi się obok zdjęcia liczone od góry strony', 'my-custom-plugin'),
          'value' => base64_encode($visitor2),
          'save_always' => true,
          'dependency' => array(
            'element' => 'element',
            'value' => array('for-visitors.php')
          ),
        ),
      ),
      'description' => __( 'Enter description.', 'my-text-domain' )
    ));
  }

  // Define the output function for the element
function my_custom_element_output($atts, $content = null) {
    // Get the current language of the website
    $locale = get_locale();
  
    $color = isset($atts['color']) ? $atts['color'] : '';
    $element = isset($atts['element']) ? $atts['element'] : '';
    $exhibitor1 = isset($atts['exhibitor1']) ? $atts['exhibitor1'] : '';
    $exhibitor2 = isset($atts['exhibitor2']) ? $atts['exhibitor2'] : '';
    $exhibitor3 = isset($atts['exhibitor3']) ? $atts['exhibitor3'] : '';
    $exhibitor4 = isset($atts['exhibitor4']) ? $atts['exhibitor4'] : '';
    $exhibitor5 = isset($atts['exhibitor5']) ? $atts['exhibitor5'] : '';
    $exhibitor6 = isset($atts['exhibitor6']) ? $atts['exhibitor6'] : '';
    $file = isset($atts['file']) ? $atts['file'] : '';
    $gallery = isset($atts['gallery']) ? $atts['gallery'] : '';
    $logoscatalog = isset($atts['logoscatalog']) ? $atts['logoscatalog'] : '';
    $promote_yourself = isset($atts['promote_yourself']) ? $atts['promote_yourself'] : '';
    $show_banners = isset($atts['show_banners']) ? $atts['show_banners'] : '';
    $showurl = isset($atts['showurl']) ? $atts['showurl'] : '';
    $visitor1 = isset($atts['visitor1']) ? $atts['visitor1'] : '';
    $visitor2 = isset($atts['visitor2']) ? $atts['visitor2'] : '';
    $show_slider = isset($atts['show_slider']) ? $atts['show_slider'] : '';
    $tickets_available = isset($atts['tickets_available']) ? $atts['tickets_available'] : '';

    // Przekazywanie zmiennych z atts zadeklarowanych powyzej do scriptów JS
    echo '<script> if(typeof show_slider == "undefined") var show_slider = "' . $show_slider . '";</script>';

    if (empty($element)) {
      $file_path = plugin_dir_path(__FILE__) . $atts['file'];
    } else {
      $file_path = plugin_dir_path(__FILE__) . $atts['element'];
    }
    
    if (file_exists($file_path)) {
      ob_start();
      include $file_path;
      $file_cont = ob_get_clean();
  
      $file_cont = do_shortcode($file_cont);
  
      if ($color != '') {
        $file_cont = str_replace(
          array('color:white !important', 'color:black !important', 'box-shadow: 9px 9px 0px -6px white', 'box-shadow: 9px 9px 0px -6px black'),
          array('color:'.$color.' !important', 'color:'.$color.' !important', 'box-shadow: 9px 9px 0px -6px '.$color, 'box-shadow: 9px 9px 0px -6px '.$color),
          $file_cont
        );  
      }
  
      if ($color != '') {
        if ($color == '#ffffff') {
          $color1 = '#000000';
        } elseif ($color == '#000000') {
          $color1 = '#ffffff';
        }
        $file_cont = str_replace(
          array('text-shadow: 2px 2px white', 'text-shadow: 2px 2px black'),
          array('text-shadow: 2px 2px '.$color1, 'text-shadow: 2px 2px '.$color1),
          $file_cont
        );  
      }
  
      if ($color == '#000000') {
        $file_cont = str_replace(
          array('saturate'),
          array('invert'),
          $file_cont
        );  
      }
  
      $file_cont = '<div custom-lang="' . $locale . '" class="custom_element">' . $file_cont . '</div>';
      return $file_cont;
    } else {
      echo '<script>console.error("File not found: ' . $file_path . '");</script>';
    }
  }
  
  add_action('vc_before_init', 'my_custom_wpbakery_element');
  add_shortcode('my_custom_element', 'my_custom_element_output');
?>