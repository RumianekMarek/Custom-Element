<?php

// Add the new WPBakery My Custom Element
function my_custom_wpbakery_element() {
    // Define the element name and path to the element file
    vc_map(array(
      'name' => __('My Custom Element', 'my-custom-plugin'),
      'base' => 'my_custom_element',
      'category' => __('My Elements', 'my-custom-plugin'),
      'admin_enqueue_css' => plugin_dir_url( __FILE__ ) . 'css/backendstyle.css',
      'params' => array(
        array(
          'type' => 'dropdown',
          'group' => 'Main Settings',
          'heading' => __('Select an element', 'my-custom-plugin'),
          'param_name' => 'element',
          'description' => __('Select an element to display its files.', 'my-custom-plugin'),
          'value' => array(
            'Select' => '',
            'Adres Ptak Warsaw Expo' => 'ptakAdress.php',
            'Dodaj do kalendarza' => 'calendarAdd.php',
            'Dodaj do Google Kalendarz' => 'calendarGoogle.php',
            'Dodaj do Outlook Kalendarz' => 'calendarOutlook.php',
            'Dodaj do Office 365 Kalendarz' => 'calendarOffice365.php',
            'Dodaj do Yahoo Kalendarz' => 'calendarYahoo.php',
            'Dodaj do Apple Kalendarz' => 'calendarApple.php',
            'Kalendarz do potwierdzenia' => 'confCalendar.php',
            'Dokumenty' => 'download.php',
            'Exhibitors-benefits'=> 'exhibitors-benefits.php',
            'FAQ' => 'faq.php',
            'Footer' => 'footer.php',
            'For Exhibitors' => 'for-exhibitors.php',
            'For Visitors' => 'for-visitors.php',
            'Gallery Slider' => 'gallery-slider.php',
            'Generator wystawcow' => 'generator-wystawcow.php',
            'Grupy zorganizowane' => 'grupy.php',
            'Header' => 'header-custom.php',
            'Identyfikatory' => 'badge-local.php',
            'Informacje organizacyjne' => 'org-information.php',
            'Kontakt' => 'kontakt.php',
            'Logotype Gallery' => 'logos-catalog.php',
            'Main Page Gallery - mini' => 'gallery.php',
            'Mini-Galery' => 'mini-gallery.php',
            'Nie przegap' => 'niePrzegap.php',
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
          'admin_label' => true,
        ),
        array(
          'type' => 'textfield',
          'group' => 'Main Settings',
          'heading' => __('Select a file', 'my-custom-plugin'),
          'param_name' => 'file',
          'description' => __('Select a file to display its gallerys.', 'my-custom-plugin'),
          'save_always' => true,
          'admin_label' => true
        ),
        array(
          'type' => 'dropdown',
          'group' => 'Main Settings',
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
          'group' => 'Main Settings',
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
          'group' => 'Main Settings',
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
          'group' => 'Main Settings',
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
          'group' => 'Main Settings',
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
          'group' => 'Main Settings',
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
          'group' => 'Main Settings',
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
          'group' => 'Main Settings',
          'heading' => esc_html__('Text for Main Page Gallery', 'my-custom-plugin'),
          'param_name' => 'gallery',
          'value' => base64_encode($gallery),
          'save_always' => true,
          'dependency' => array(
              'element' => 'element',
              'value' => array('gallery.php')
          ),
        ),
        array(
          'type' => 'textfield',
          'group' => 'Main Settings',
          'heading' => esc_html__('Logos catalog', 'my-custom-plugin'),
          'param_name' => 'logoscatalog',
          'description' => __('Put catalog name in /doc/ where are logos to show in gallery, and this text will by use as galery header.', 'my-custom-plugin'),
          'save_always' => true,
          'dependency' => array(
              'element' => 'element',
              'value' => array('logos-catalog.php', 'gallery-slider.php', 'wydarzenia-ogolne.php')
          ),
        ),
        array(
          'type' => 'textfield',
          'group' => 'Main Settings',
          'heading' => esc_html__('Galery name', 'my-custom-plugin'),
          'param_name' => 'titlecatalog',
          'description' => __('Set title to diplay over the gallery', 'my-custom-plugin'),
          'save_always' => true,
          'dependency' => array(
              'element' => 'element',
              'value' => array('logos-catalog.php')
          ),
        ),
        array(
          'type' => 'checkbox',
          'group' => 'Main Settings',
          'heading' => __('Hide baners to download', 'my-custom-plugin'),
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
          'group' => 'Main Settings',
          'heading' => __('Dispaly different logo color', 'my-custom-plugin'),
          'param_name' => 'logo_color_promote',
          'description' => __('Check Yes to display different logo color.', 'my-custom-plugin'),
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
          'group' => 'Main Settings',
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
          'group' => 'Main Settings',
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
          'group' => 'Main Settings',
          'heading' => __('Show link url in gallery', 'my-custom-plugin'),
          'param_name' => 'showurl',
          'description' => __('Check to create a link in every logotype.', 'my-custom-plugin'),
          'admin_label' => true,
          'save_always' => true,
          'value' => array(__('True', 'my-custom-plugin') => 'true',),
          'dependency' => array(
            'element' => 'element',
            'value' => array('logos-catalog.php', 'wydarzenia-ogolne.php')
          ),
        ),
        array(
          'type' => 'textarea_raw_html',
          'group' => 'Main Settings',
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
          'group' => 'Main Settings',
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
        array(
          'type' => 'checkbox',
          'group' => 'Main Settings',
          'heading' => __('Button on', 'my-custom-plugin'),
          'param_name' => 'button_on',
          'description' => __('Select options to display button:', 'my-custom-plugin'),
          'admin_label' => true,
          'save_always' => true,
          'value' => array(
            __('register', 'my-custom-plugin') => 'register',
            __('ticket', 'my-custom-plugin') => 'ticket',
            __('conference', 'my-custom-plugin') => 'conference',
          ),
          'dependency' => array(
            'element' => 'element',
            'value' => array('header-custom.php')
          ),
        ),
        array(
          'type' => 'checkbox',
          'group' => 'Main Settings',
          'heading' => __('Logo color', 'my-custom-plugin'),
          'param_name' => 'logo_color',
          'description' => __('Check Yes to display logo color.', 'my-custom-plugin'),
          'admin_label' => true,
          'save_always' => true,
          'value' => array(__('True', 'my-custom-plugin') => 'true',),
          'dependency' => array(
            'element' => 'element',
            'value' => array('header-custom.php')
          ),
        ),
        array(
          'type' => 'checkbox',
          'group' => 'Main Settings',
          'heading' => __('Fair partner', 'my-custom-plugin'),
          'param_name' => 'fair_partner',
          'description' => __('Check Yes to display fair partner.', 'my-custom-plugin'),
          'admin_label' => true,
          'save_always' => true,
          'value' => array(__('True', 'my-custom-plugin') => 'true',),
          'dependency' => array(
            'element' => 'element',
            'value' => array('header-custom.php')
          ),
        ),
        array(
          'type' => 'checkbox',
          'group' => 'Main Settings',
          'heading' => __('Footer logo color', 'my-custom-plugin'),
          'param_name' => 'footer_logo_color',
          'description' => __('Check Yes to display footer logo color.', 'my-custom-plugin'),
          'admin_label' => true,
          'save_always' => true,
          'value' => array(__('True', 'my-custom-plugin') => 'true',),
          'dependency' => array(
            'element' => 'element',
            'value' => array('footer.php')
          ),
        ),
        array(
          'type' => 'checkbox',
          'group' => 'Main Settings',
          'heading' => __('Footer logo color invert', 'my-custom-plugin'),
          'param_name' => 'logo_color_invert',
          'description' => __('Check Yes to display footer logo color white.', 'my-custom-plugin'),
          'admin_label' => true,
          'save_always' => true,
          'value' => array(__('True', 'my-custom-plugin') => 'true',),
          'dependency' => array(
            'element' => 'element',
            'value' => array('footer.php')
          ),
        ),
        array(
          'type' => 'textfield',
          'group' => 'Pliki',
          'heading' => __('Pliki', 'my-custom-plugin'),
          'param_name' => 'pliki_tab',
          'dependency' => array(
            'element' => 'element',
            'value' => array('logos-catalog.php')
          ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __('Logos Data Base', 'my-custom-plugin'),
          'group' => 'Hidden',
          'param_name' => 'logo_url',
          'save_always' => true,
          'dependency' => array(
            'element' => 'element',
            'value' => array('logos-catalog.php')
          ),
        ),
        array(
          'type' => 'checkbox',
          'group' => 'Main Settings',
          'heading' => __('Horizontal', 'my-custom-plugin'),
          'param_name' => 'horizontal',
          'description' => __('Horizontal block.', 'my-custom-plugin'),
          'admin_label' => true,
          'save_always' => true,
          'value' => array(__('True', 'my-custom-plugin') => 'true',),
          'dependency' => array(
            'element' => 'element',
            'value' => array('kontakt.php')
          ),
        ),
        array(
          'type' => 'textfield',
          'group' => 'Main Settings',
          'heading' => esc_html__('Worker form id', 'my-custom-plugin'),
          'param_name' => 'worker_form_id',
          'description' => __('Worker form id for generator exhibitors', 'my-custom-plugin'),
          'save_always' => true,
          'dependency' => array(
              'element' => 'element',
              'value' => array('generator-wystawcow.php')
          ),
        ),
        array(
          'type' => 'textfield',
          'group' => 'Main Settings',
          'heading' => esc_html__('Guest form id', 'my-custom-plugin'),
          'param_name' => 'guest_form_id',
          'description' => __('Guest form id for generator exhibitors', 'my-custom-plugin'),
          'save_always' => true,
          'dependency' => array(
              'element' => 'element',
              'value' => array('generator-wystawcow.php')
          ),
        ),
        array(
          'type' => 'textfield',
          'group' => 'Main Settings',
          'heading' => esc_html__('Badge form id', 'my-custom-plugin'),
          'param_name' => 'badge_form_id',
          'description' => __('Badge form id for generator badges', 'my-custom-plugin'),
          'save_always' => true,
          'dependency' => array(
              'element' => 'element',
              'value' => array('badge-local.php')
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

    $trade_date = do_shortcode('[trade_fair_date]');
    $trade_start = do_shortcode('[trade_fair_datetotimer]');
    $trade_end = do_shortcode('[trade_fair_enddata]');
    $trade_name = do_shortcode('[trade_fair_name]');
    $trade_desc = do_shortcode('[trade_fair_desc]');
    $trade_name_en = do_shortcode('[trade_fair_name_eng]');

    if (isset($atts['color'])) { $color = $atts['color']; }
    if (isset($atts['element'])) { $element = $atts['element']; }
    if (isset($atts['exhibitor1'])) { $exhibitor1 = $atts['exhibitor1']; }
    if (isset($atts['exhibitor2'])) { $exhibitor2 = $atts['exhibitor2']; }
    if (isset($atts['exhibitor3'])) { $exhibitor3 = $atts['exhibitor3']; }
    if (isset($atts['exhibitor4'])) { $exhibitor4 = $atts['exhibitor4']; }
    if (isset($atts['exhibitor5'])) { $exhibitor5 = $atts['exhibitor5']; }
    if (isset($atts['exhibitor6'])) { $exhibitor6 = $atts['exhibitor6']; }
    if (isset($atts['file'])) { $file = $atts['file']; }
    if (isset($atts['gallery'])) { $gallery = $atts['gallery']; }

    if (isset($atts['logoscatalog'])) { 
      global $logoscatalog; 
      $logoscatalog = $atts['logoscatalog'];
    }

    if (isset($atts['logo_url'])) { $logo_url = $atts['logo_url']; }
    if (isset($atts['titlecatalog'])) { $titlecatalog = $atts['titlecatalog']; }
    if (isset($atts['show_banners'])) { $show_banners = $atts['show_banners']; }
    if (isset($atts['logo_color_promote'])) { $logo_color_promote = $atts['logo_color_promote']; }
    if (isset($atts['showurl'])) { $showurl = $atts['showurl']; }
    if (isset($atts['visitor1'])) { $visitor1 = $atts['visitor1']; }
    if (isset($atts['visitor2'])) { $visitor2 = $atts['visitor2']; }
    if (isset($atts['show_slider'])) { $show_slider = $atts['show_slider']; }
    if (isset($atts['tickets_available'])) { $tickets_available = $atts['tickets_available']; }
    if (isset($atts['button_on'])) { $button_on = $atts['button_on']; }
    if (isset($atts['logo_color'])) { $logo_color = $atts['logo_color']; }
    if (isset($atts['logo_color_invert'])) { $logo_color_invert = $atts['logo_color_invert']; }
    if (isset($atts['fair_partner'])) { $fair_partner = $atts['fair_partner']; }
    if (isset($atts['footer_logo_color'])) { $footer_logo_color = $atts['footer_logo_color']; }
    if (isset($atts['horizontal'])) { $horizontal = $atts['horizontal']; }
    if (isset($atts['worker_form_id'])) { $worker_form_id = $atts['worker_form_id']; }
    if (isset($atts['guest_form_id'])) { $guest_form_id = $atts['guest_form_id']; }
    if (isset($atts['badge_form_id'])) { $badge_form_id = $atts['badge_form_id']; }

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
          array('color:white !important', 'color:black !important','color:#ffffff !important', 'color:#000000 !important', 'box-shadow: 9px 9px 0px -6px white', 'box-shadow: 9px 9px 0px -6px black','border-bottom:1px solid white','border-bottom:1px solid black'),
          array('color:'.$color.' !important', 'color:'.$color.' !important','color:'.$color.' !important', 'color:'.$color.' !important', 'box-shadow: 9px 9px 0px -6px '.$color, 'box-shadow: 9px 9px 0px -6px '.$color,'border-bottom:1px solid '.$color,'border-bottom:1px solid '.$color),
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

      if ($color != '') {
        if ($color == '#ffffff') {
          $color2 = 'white';
        } elseif ($color == '#000000') {
          $color2 = 'black';
        }
        $file_cont = str_replace(
          array('btn-custom-black','btn-custom-white','custom-box-top-left-white','custom-box-top-left-black','custom-box-bottom-right-white','custom-box-bottom-right-black'),
          array('btn-custom-'.$color2,'btn-custom-'.$color2,'custom-box-top-left-'.$color2,'custom-box-top-left-'.$color2,'custom-box-bottom-right-'.$color2,'custom-box-bottom-right-'.$color2),
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
  
      $file_cont = '<div class="custom_element">' . $file_cont . '</div>';
      return $file_cont;
    } else {
      echo '<script>console.error("File not found: ' . $file_path . '");</script>';
    }
  }
  
  function my_custom_element_scripts() {
    $trade_date = do_shortcode('[trade_fair_date]');
    $trade_start = do_shortcode('[trade_fair_datetotimer]');
    $trade_end = do_shortcode('[trade_fair_enddata]');
    $trade_name = do_shortcode('[trade_fair_name]');
    $trade_desc = do_shortcode('[trade_fair_desc]');
    $trade_name_en = do_shortcode('[trade_fair_name_eng]');
    $trade_desc_en = do_shortcode('[trade_fair_desc_eng]');
  
    $inner_data_array = array(
      'trade_date' => $trade_date,
      'trade_start' => $trade_start,
      'trade_end' => $trade_end,
      'trade_name' => $trade_name,
      'trade_desc' => $trade_desc,
      'trade_name_en' => $trade_name_en,
      'trade_desc_en' => $trade_desc_en,
    );
  
    $js_file = plugins_url('js/script.js', __FILE__);
    $js_version = filemtime(plugin_dir_path(__FILE__) . 'js/script.js');
    wp_enqueue_script('my-custom-element-js', $js_file, array('jquery'), $js_version, true);
    wp_localize_script( 'my-custom-element-js', 'inner_data', $inner_data_array ); 
  
    $css_file = plugins_url('css/style.css', __FILE__);
    $css_version = filemtime(plugin_dir_path(__FILE__) . 'css/style.css');
    wp_enqueue_style('my-custom-element-css', $css_file, array(), $css_version);
  }

  function admin_script($atts, $content = null) {

    $katalog = ABSPATH . 'doc'; // Ścieżka do katalogu na serwerze
    $file_list = array();

    if (is_dir($katalog)) {
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($katalog));

        foreach ($iterator as $file) {
            if ($file->isFile()) {
                $filePath = $file->getPathname();
                $filePath = str_replace($katalog, '', $filePath);
                $file_list[] = $filePath;
            }
        }
    }

    $inner_array = array (
      'file_list' => $file_list,
    );

    $js_file_logos = plugins_url('js/logos-catalog.js', __FILE__);
    $js_version_logos = filemtime(plugin_dir_path(__FILE__) . 'js/logos-catalog.js');
    wp_enqueue_script('my-custom-element-logos-js', $js_file_logos, array('jquery'), $js_version_logos, true);
    wp_localize_script( 'my-custom-element-logos-js', 'inner', $inner_array ); 
  }

  add_action('wp_enqueue_scripts', 'my_custom_element_scripts');

  add_action('vc_before_init', 'my_custom_wpbakery_element');
  add_shortcode('my_custom_element', 'my_custom_element_output');

  add_action('admin_enqueue_scripts', 'admin_script');
?>