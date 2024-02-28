<?php

// Add the new WPBakery My Custom Element
function my_custom_wpbakery_element() {

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

  // GET GALLERY IMAGES LIST
  $doc_images = glob($_SERVER['DOCUMENT_ROOT'] . '/doc/galeria/*.{jpeg,jpg,png,webp,JPEG,JPG,PNG,WEBP}', GLOB_BRACE);
  $name_images = array();
  $name_images['Wybierz'] = '';
  foreach ($doc_images as $image_path) {
      $file_info = pathinfo($image_path);
      $file_name = $file_info['basename'];
      $name_images[$file_name] = $file_name;
  }

  // FORMULARZE
  $pwe_forms_array = array();
  if (method_exists('GFAPI', 'get_forms')) {
      $pwe_forms = GFAPI::get_forms();
      foreach ($pwe_forms as $form) {
        $pwe_forms_array[$form['id']] = $form['title'];
      }
  }

  // SHORTCODE INPUT RANGE ELEMENT
  if ( function_exists( 'vc_add_shortcode_param' ) ) {
    vc_add_shortcode_param( 'input_range', 'input_range_field_html' );
  }

  // INPUT RANGE ELEMENT
  function input_range_field_html( $settings, $value ) {
    $id = uniqid('range_');
    return '<div class="custom-input-range">'
          . '<input type="range" '
          . 'id="' . esc_attr( $id ) . '" '
          . 'name="' . esc_attr( $settings['param_name'] ) . '" '
          . 'class="wpb_vc_param_value ' . esc_attr( $settings['param_name'] ) . ' ' . esc_attr( $settings['type'] ) . '_field" '
          . 'value="' . esc_attr( $value ) . '" '
          . 'min="' . esc_attr( $settings['min'] ) . '" '
          . 'max="' . esc_attr( $settings['max'] ) . '" '
          . 'step="' . esc_attr( $settings['step'] ) . '" '
          . 'oninput="document.getElementById(\'value_' . esc_attr( $id ) . '\').innerHTML = this.value" '
          . '/>'
          . '<span id="value_' . esc_attr( $id ) . '">' . esc_attr( $value ) . '</span>'
          . '</div>';
  }

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
          'Call Center Formularz' => 'callcenter.php',
          'Countdown' => 'countdown.php',
          'Dodaj do kalendarza' => 'calendarAdd.php',
          'Dodaj do Google Kalendarz' => 'calendarGoogle.php',
          'Dodaj do Outlook Kalendarz' => 'calendarOutlook.php',
          'Dodaj do Office 365 Kalendarz' => 'calendarOffice365.php',
          'Dodaj do Yahoo Kalendarz' => 'calendarYahoo.php',
          'Dodaj do Apple Kalendarz' => 'calendarApple.php',
          'Dokumenty' => 'download.php',
          'Estymacje' => 'estymacje.php',
          'Exhibitors-benefits'=> 'exhibitors-benefits.php',
          'FAQ' => 'faq.php',
          'Footer' => 'footer.php',
          'For Exhibitors' => 'for-exhibitors.php',
          'For Visitors' => 'for-visitors.php',
          'Form content' => 'form-content.php',
          'Gallery Slider' => 'gallery-slider.php',
          'Generator wystawcow' => 'generator-wystawcow.php',
          'Grupy zorganizowane' => 'grupy.php',
          'Header' => 'header-custom.php',
          'Identyfikatory' => 'badge-local.php',
          'Informacje organizacyjne' => 'org-information.php',
          'Informacje kontaktowe' => 'kontakt-info.php',
          'Kalendarz do potwierdzenia' => 'confCalendar.php',
          'Kontakt' => 'kontakt.php',
          'Logotype Gallery' => 'logos-catalog.php',
          'Main timer' => 'main-timer.php',
          'Main Page Gallery - mini' => 'gallery.php',
          'Mapka dojazdu' => 'route.php',
          'Mini-Galery' => 'mini-gallery.php',
          'Nie przegap' => 'niePrzegap.php',
          'Organizator' => 'organizator.php',
          'Posts' => 'posts.php',
          'Profile' => 'profile.php',
          'Ramka Facebook' => 'socialMedia.php',
          'Registration' => 'registration.php',
          'Sticky buttons' => 'sticky-buttons.php',
          'Videos' => 'videos.php',
          'Visitors Benefits' => 'visitors-benefits.php',
          'Voucher' => 'voucher.php',
          'Wydarzenia - ogólne informacje' => 'wydarzenia-ogolne.php',
          'Wypromuj się na targach' => 'promote-yourself.php',
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
        'heading' => __('Select text color', 'my-custom-plugin'),
        'param_name' => 'color',
        'description' => __('Select text color for the element.', 'my-custom-plugin'),
        'value' => array(
          'Default' => '',
          'White' => '#ffffff',
          'Black' => '#000000'
        ),
        'save_always' => true
      ),
      array(
        'type' => 'dropdown',
        'group' => 'Main Settings',
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
        'group' => 'Main Settings',
        'heading' => __('Select button color text', 'my-custom-plugin'),
        'param_name' => 'btn_color_text',
        'description' => __('Select button color text for the element.', 'my-custom-plugin'),
        'value' => array_merge(
          array('Default' => ''),
          $custom_element_colors
        ),
        'save_always' => true
      ),
      array(
        'type' => 'dropdown',
        'group' => 'Main Settings',
        'heading' => __('Select button color shadow', 'my-custom-plugin'),
        'param_name' => 'btn_color_shadow',
        'description' => __('Select button color shadow for the element.', 'my-custom-plugin'),
        'value' => array_merge(
          array('Default' => ''),
          $custom_element_colors
        ),
        'save_always' => true
      ),
      // FOR VISITORS <-------------------------------------------------------------------------<
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
      // FOR EXHIBITORS <-------------------------------------------------------------------------<
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
      // GALLERY <-------------------------------------------------------------------------<
      array( 
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => esc_html__('Title for Main Page Gallery', 'my-custom-plugin'),
        'param_name' => 'gallery_title',
        'save_always' => true,
        'dependency' => array(
            'element' => 'element',
            'value' => array('gallery.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => esc_html__('Button Register Text', 'my-custom-plugin'),
        'param_name' => 'gallery_btn_text',
        'save_always' => true,
        'dependency' => array(
            'element' => 'element',
            'value' => array('gallery.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => esc_html__('Button Register Link', 'my-custom-plugin'),
        'param_name' => 'gallery_btn_link',
        'save_always' => true,
        'dependency' => array(
            'element' => 'element',
            'value' => array('gallery.php')
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
        'type' => 'attach_images',
        'group' => 'Images',
        'heading' => __('Select 4 Images ~300/200', 'my-custom-plugin'),
        'param_name' => 'gallery_images',
        'description' => __('Choose images from the gallery.', 'my-custom-plugin'),
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('gallery.php')
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
        'type' => 'textarea_raw_html',
        'group' => 'Main Settings',
        'heading' => esc_html__('Text for Main Page Gallery for mobile', 'my-custom-plugin'),
        'param_name' => 'gallery_mobile',
        'value' => base64_encode($gallery_mobile),
        'save_always' => true,
        'dependency' => array(
            'element' => 'element',
            'value' => array('gallery.php')
        ),
      ),
      array(
        'type' => 'checkbox',
        'group' => 'Main Settings',
        'heading' => __('Turn on countdown', 'my-custom-plugin'),
        'param_name' => 'gallery_countdown',
        'admin_label' => true,
        'save_always' => true,
        'value' => array(__('True', 'my-custom-plugin') => 'true',),
        'dependency' => array(
          'element' => 'element',
          'value' => array('gallery.php')
        ),
      ),
      // LOGOTYPES <-------------------------------------------------------------------------<
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => esc_html__('Logos catalog', 'my-custom-plugin'),
        'param_name' => 'logoscatalog',
        'description' => __('Put catalog name in /doc/ where are logotypes.', 'my-custom-plugin'),
        'save_always' => true,
        'dependency' => array(
            'element' => 'element',
            'value' => array('logos-catalog.php', 'gallery-slider.php', 'wydarzenia-ogolne.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => esc_html__('Title', 'my-custom-plugin'),
        'param_name' => 'titlecatalog',
        'description' => __('Set title to diplay over the gallery', 'my-custom-plugin'),
        'save_always' => true,
        'dependency' => array(
            'element' => 'element',
            'value' => array('logos-catalog.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Aditional options',
        'heading' => __('Text-align title', 'my-custom-plugin'),
        'param_name' => 'left_center_right_title',
        'description' => __('Default left, for header dafault center', 'my-custom-plugin'),
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('logos-catalog.php', 'header-custom.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Aditional options',
        'heading' => __('Min width logotypes', 'my-custom-plugin'),
        'param_name' => 'min_width_logo',
        'description' => __('Default min width for grid 140px', 'my-custom-plugin'),
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('logos-catalog.php', 'header-custom.php')
        ),
      ),
      array(
        'type' => 'checkbox',
        'group' => 'Aditional options',
        'heading' => __('Turn on full width', 'my-custom-plugin'),
        'param_name' => 'slider_full_width_on',
        'description' => __('Turn on full width', 'my-custom-plugin'),
        'admin_label' => true,
        'save_always' => true,
        'value' => array(__('True', 'my-custom-plugin') => 'true',),
        'dependency' => array(
          'element' => 'element',
          'value' => array('logos-catalog.php', 'header-custom.php')
        ),
      ),
      array(
        'type' => 'checkbox',
        'group' => 'Aditional options',
        'heading' => __('Slider desktop', 'my-custom-plugin'),
        'param_name' => 'slider_desktop',
        'description' => __('Check if you want to display in slider on desktop.', 'my-custom-plugin'),
        'admin_label' => true,
        'save_always' => true,
        'value' => array(__('True', 'my-custom-plugin') => 'true',),
        'dependency' => array(
          'element' => 'element',
          'value' => array('logos-catalog.php', 'header-custom.php')
        ),
      ),
      array(
        'type' => 'checkbox',
        'group' => 'Aditional options',
        'heading' => __('Grid mobile', 'my-custom-plugin'),
        'param_name' => 'grid_mobile',
        'description' => __('Check if you want to display in grid on mobile.', 'my-custom-plugin'),
        'admin_label' => true,
        'save_always' => true,
        'value' => array(__('True', 'my-custom-plugin') => 'true',),
        'dependency' => array(
          'element' => 'element',
          'value' => array('logos-catalog.php', 'header-custom.php')
        ),
      ),
      array(
        'type' => 'checkbox',
        'group' => 'Aditional options',
        'heading' => __('Logotypes white', 'my-custom-plugin'),
        'param_name' => 'slider_logo_white',
        'description' => __('Check if you want to change the logotypes color to white. ', 'my-custom-plugin'),
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
        'group' => 'Aditional options',
        'heading' => __('Logotypes color', 'my-custom-plugin'),
        'param_name' => 'slider_logo_color',
        'description' => __('Check if you want to change the logotypes white to color. ', 'my-custom-plugin'),
        'admin_label' => true,
        'save_always' => true,
        'value' => array(__('True', 'my-custom-plugin') => 'true',),
        'dependency' => array(
          'element' => 'element',
          'value' => array('header-custom.php')
        ),
      ),
      array(
        'type' => 'param_group',
        'group' => 'Main Settings',
        'heading' => __('Add link', 'my-custom-plugin'),
        'param_name' => 'logotypes_files',
        'dependency' => array(
          'element' => 'element',
          'value' => array('logos-catalog.php', 'header-custom.php')
        ),
        'params' => array(
          array(
            'type' => 'textfield',
            'heading' => __('Filename(ex. file.png)', 'my-custom-plugin'),
            'param_name' => 'logotype_filename',
            'save_always' => true,
            'admin_label' => true
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Link', 'my-custom-plugin'),
            'param_name' => 'logotype_link',
            'save_always' => true,
            'admin_label' => true
          ),
          array(
            'type' => 'checkbox',
            'heading' => __('Logo color', 'my-custom-plugin'),
            'param_name' => 'logotype_color',
            'save_always' => true,
            'admin_label' => true,
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Custom style', 'my-custom-plugin'),
            'param_name' => 'logotype_style',
            'save_always' => true,
            'admin_label' => true,
          ),
        ),
      ),
      // PROMOTE YOURSELF <-------------------------------------------------------------------------<
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
        'param_name' => 'logo_white_promote',
        'description' => __('Check Yes to display different logo color.', 'my-custom-plugin'),
        'admin_label' => true,
        'save_always' => true,
        'value' => array(__('True', 'my-custom-plugin') => 'true',),
        'dependency' => array(
          'element' => 'element',
          'value' => array('promote-yourself.php')
        ),
      ),
      // POSTS <-------------------------------------------------------------------------<
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Category', 'my-custom-plugin'),
        'param_name' => 'posts_category',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('posts.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Posts count', 'my-custom-plugin'),
        'param_name' => 'posts_count',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('posts.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Aspect ratio', 'my-custom-plugin'),
        'param_name' => 'posts_ratio',
        'description' => __('Default 1/1', 'my-custom-plugin'),
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('posts.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Button link', 'my-custom-plugin'),
        'param_name' => 'posts_link',
        'description' => __('Default aktualnosci-news', 'my-custom-plugin'),
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('posts.php')
        ),
      ),
      array(
        'type' => 'checkbox',
        'group' => 'Main Settings',
        'heading' => __('Hide posts button', 'my-custom-plugin'),
        'param_name' => 'posts_btn',
        'save_always' => true,
        'value' => array(__('True', 'my-custom-plugin') => 'true',),
        'dependency' => array(
          'element' => 'element',
          'value' => array('posts.php')
        ),
      ),
      // PROFILE <-------------------------------------------------------------------------<
      array(
        'type' => 'checkbox',
        'group' => 'Main Settings',
        'heading' => __('Title', 'my-custom-plugin'),
        'param_name' => 'profile_title_checkbox',
        'save_always' => true,
        'value' => array(
          __('PROFIL ODWIEDZAJĄCEGO', 'my-custom-plugin') => 'profile_title_visitors',
          __('PROFIL WYSTAWCY', 'my-custom-plugin') => 'profile_title_exhibitors',
          __('ZAKRES BRANŻOWY', 'my-custom-plugin') => 'profile_title_scope',
          __('APLIKACJA', 'my-custom-plugin') => 'profile_application',
        ),
        'dependency' => array(
          'element' => 'element',
          'value' => array('profile.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Title custom', 'my-custom-plugin'),
        'param_name' => 'profile_title',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('profile.php')
        ),
      ),
      array(
        'type' => 'textarea_html',
        'group' => 'Main Settings',
        'heading' => __('Text', 'my-custom-plugin'),
        'param_name' => 'content',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('profile.php')
        ),
      ),
      array(
        'type' => 'param_group',
        'group' => 'Main Settings',
        'param_name' => 'profile_images',
        'dependency' => array(
          'element' => 'element',
          'value' => array('profile.php')
        ),
        'params' => array(
          array(
            'type' => 'attach_image',
            'heading' => __('Catalog MEDIA', 'my-custom-plugin'),
            'param_name' => 'catalog_media',
            'save_always' => true,
            'admin_label' => true
          ),
          array(
            'type' => 'dropdown',
            'heading' => __('Catalog DOC', 'my-custom-plugin'),
            'param_name' => 'catalog_doc',
            'save_always' => true,
            'admin_label' => true,
            'value' => $name_images
          ),
        ),
      ),
      array(
        'type' => 'checkbox',
        'group' => 'Main Settings',
        'heading' => __('Reverse blocks', 'my-custom-plugin'),
        'param_name' => 'profile_reverse_block',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('profile.php')
        ),
      ),
      array(
        'type' => 'checkbox',
        'group' => 'Main Settings',
        'heading' => __('Buttons', 'my-custom-plugin'),
        'param_name' => 'profile_buttons',
        'save_always' => true,
        'value' => array(
          __('Register button', 'my-custom-plugin') => 'profile_btn_rej',
          __('Tickets button', 'my-custom-plugin') => 'profile_btn_tick',
          __('Book a stand button', 'my-custom-plugin') => 'profile_btn_exhib',
        ),
        'dependency' => array(
          'element' => 'element',
          'value' => array('profile.php')
        ),
      ),
      array(
        'type' => 'checkbox',
        'group' => 'Main Settings',
        'heading' => __('Border', 'my-custom-plugin'),
        'param_name' => 'profile_border',
        'save_always' => true,
        'value' => array(
          __('border top', 'my-custom-plugin') => 'border_top',
          __('border bottom', 'my-custom-plugin') => 'border_bottom',
        ),
        'dependency' => array(
          'element' => 'element',
          'value' => array('profile.php')
        ),
      ),
      array(
        'type' => 'dropdown',
        'group' => 'Main Settings',
        'heading' => __('Background color', 'my-custom-plugin'),
        'param_name' => 'profile_background',
        'save_always' => true,
        'value' => array_merge(
          array('Wybierz' => ''),
          $custom_element_colors
        ),
        'dependency' => array(
          'element' => 'element',
          'value' => array('profile.php')
        ),
      ), 
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Tickets button link', 'my-custom-plugin'),
        'description' => __('Default (/bilety/ - PL), (/tickets/ - EN)', 'my-custom-plugin'),
        'param_name' => 'profile_tickets_button_link',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('profile.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Register button link', 'my-custom-plugin'),
        'description' => __('Default (/rejestracja/ - PL), (/registration/ - EN)', 'my-custom-plugin'),
        'param_name' => 'profile_register_button_link',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('profile.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Exhibitors button link', 'my-custom-plugin'),
        'description' => __('Default (/zostan-wystawca/ - PL), (/become-an-exhibitor/ - EN)', 'my-custom-plugin'),
        'param_name' => 'profile_exhibitors_button_link',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('profile.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Aspect ratio (Default 3/2)', 'my-custom-plugin'),
        'param_name' => 'profile_img_aspect_ratio',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('profile.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Max width (Default 80%)', 'my-custom-plugin'),
        'param_name' => 'profile_img_max_width',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('profile.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Padding (Default 18px 36px)', 'my-custom-plugin'),
        'param_name' => 'profile_padding_element',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('profile.php')
        ),
      ),
      // HEADER <-------------------------------------------------------------------------<
      array(
        'type' => 'checkbox',
        'group' => 'Main Settings',
        'heading' => __('Simple mode', 'my-custom-plugin'),
        'param_name' => 'header_simple_mode',
        'admin_label' => true,
        'save_always' => true,
        'value' => array(__('True', 'my-custom-plugin') => 'true',),
        'dependency' => array(
          'element' => 'element',
          'value' => array('header-custom.php')
        ),
      ),
      array(
        'type' => 'dropdown',
        'group' => 'Main Settings',
        'heading' => __('Background position', 'my-custom-plugin'),
        'param_name' => 'header_bg_position',
        'value' => array(
          'Top' => 'top',
          'Center' => 'center',
          'Bottom' => 'bottom'
        ),
        'dependency' => array(
          'element' => 'element',
          'value' => array('header-custom.php')
        ),
      ),
      array(
        'type' => 'checkbox',
        'group' => 'Main Settings',
        'heading' => __('Turn on buttons', 'my-custom-plugin'),
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
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Tickets button link', 'my-custom-plugin'),
        'description' => __('Default (/bilety/ - PL), (/en/tickets/ - EN)', 'my-custom-plugin'),
        'param_name' => 'header_tickets_button_link',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('header-custom.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Register button link', 'my-custom-plugin'),
        'description' => __('Default (/rejestracja/ - PL), (/en/registration/ - EN)', 'my-custom-plugin'),
        'param_name' => 'header_register_button_link',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('header-custom.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Conferences button link', 'my-custom-plugin'),
        'description' => __('Default (/wydarzenia/ - PL), (/en/conferences/ - EN)', 'my-custom-plugin'),
        'param_name' => 'header_conferences_button_link',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('header-custom.php')
        ),
      ),
      array(
        'type' => 'textarea_raw_html',
        'group' => 'Main Settings',
        'heading' => __('Conferences custom title', 'my-custom-plugin'),
        'description' => __('Default (Konferencje - PL), (Conferences - EN)', 'my-custom-plugin'),
        'param_name' => 'header_conferences_title',
        'save_always' => true,
        'value' => base64_encode($header_conferences_title),
        'dependency' => array(
          'element' => 'element',
          'value' => array('header-custom.php')
        ),
      ),
      array(
        'type' => 'colorpicker',
        'group' => 'Main Settings',
        'heading' => __('Overlay color', 'my-custom-plugin'),
        'param_name' => 'header_overlay_color',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('header-custom.php')
        ),
      ),
      array(
        'type' => 'input_range',
        'group' => 'Main Settings',
        'heading' => __('Overlay opacity', 'my-custom-plugin'),
        'param_name' => 'header_overlay_range',
        'value' => '0',
        'min' => '0',
        'max' => '1',
        'step' => '0.01',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('header-custom.php')
        ),
      ),
      array(
        'type' => 'checkbox',
        'group' => 'Main Settings',
        'heading' => __('Main logo color', 'my-custom-plugin'),
        'param_name' => 'header_logo_color',
        'save_always' => true,
        'value' => array(__('True', 'my-custom-plugin') => 'true',),
        'dependency' => array(
          'element' => 'element',
          'value' => array('header-custom.php')
        ),
      ),
      array(
        'type' => 'input_range',
        'group' => 'Main Settings',
        'heading' => __('Max width logo (px)', 'my-custom-plugin'),
        'description' => __('Default 400px', 'my-custom-plugin'),
        'param_name' => 'header_logo_width',
        'value' => '400',
        'min' => '100',
        'max' => '600',
        'step' => '1',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('header-custom.php')
        ),
      ),
      array(
        'type' => 'param_group',
        'group' => 'Main Settings',
        'heading' => __('Additional buttons', 'my-custom-plugin'),
        'param_name' => 'header_custom_buttons',
        'dependency' => array(
          'element' => 'element',
          'value' => array('header-custom.php')
        ),
        'params' => array(
          array(
            'type' => 'textfield',
            'heading' => __('URL', 'my-custom-plugin'),
            'param_name' => 'header_custom_button_link',
            'save_always' => true,
            'admin_label' => true
          ),
          array(
            'type' => 'textarea',
            'heading' => __('Text', 'my-custom-plugin'),
            'param_name' => 'header_custom_button_text',
            'save_always' => true,
            'admin_label' => true
          ),
        ),
      ),
      array(
        'type' => 'param_group',
        'group' => 'Main Settings',
        'heading' => __('Logotypes', 'my-custom-plugin'),
        'param_name' => 'header_custom_logotypes',
        'dependency' => array(
          'element' => 'element',
          'value' => array('header-custom.php')
        ),
        'params' => array(
        array(
          'type' => 'attach_images',
          'heading' => __('Logotypes catalog', 'my-custom-plugin'),
          'param_name' => 'logotypes_media',
          'save_always' => true,
        ),
          array(
            'type' => 'textfield',
            'heading' => __('Logotypes catalog', 'my-custom-plugin'),
            'param_name' => 'logoscatalog',
            'description' => __('Put catalog name in /doc/ where are logotypes.', 'my-custom-plugin'),
            'save_always' => true,
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Logotypes Title', 'my-custom-plugin'),
            'param_name' => 'titlecatalog',
            'description' => __('Set title to diplay over the gallery', 'my-custom-plugin'),
            'save_always' => true,
          ),
          array(
            'type' => 'input_range',
            'heading' => __('Gallery width (%)', 'my-custom-plugin'),
            'param_name' => 'logotypes_width',
            'value' => '100',
            'min' => '0',
            'max' => '100',
            'step' => '1',
            'save_always' => true,
          ),
        ),
      ),
      // FOOTER <-------------------------------------------------------------------------<
      array(
        'type' => 'checkbox',
        'group' => 'Main Settings',
        'heading' => __('Change the logo color to white?', 'my-custom-plugin'),
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
      // CONTACT <-------------------------------------------------------------------------<
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
      // GENERATOR WYSTAWCÓW <-------------------------------------------------------------------------<
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
      // BADGE <-------------------------------------------------------------------------<
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => esc_html__('Badge form id', 'my-custom-plugin'),
        'param_name' => 'badge_form_id',
        'description' => __('Badge form id for generator badges', 'my-custom-plugin'),
        'save_always' => true,
        'dependency' => array(
            'element' => 'element',
            'value' => array('badge-local.php', 'callcenter.php')
        ),
      ),
      // // CONTACT INFO <-------------------------------------------------------------------------<
      array(
        'type' => 'textfield',
        'heading' => __('Header', 'my-custom-plugin'),
        'group' => 'Main Settings',
        'param_name' => 'contact_header',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('kontakt-info.php')
        ),
      ),
      array(
        'type' => 'checkbox',
        'heading' => __('Remove content', 'my-custom-plugin'),
        'group' => 'Main Settings',
        'param_name' => 'contact_content',
        'save_always' => true,
        'value' => array(
          'Zostań wystawcą' => 'wystawca',
          'Odwiedzający' => 'odwiedzajacy',
          'Współpraca z mediami' => 'media',
          'Obsługa wystawcy' => 'ob_wystawcy',
          'Obsługa techniczna' => 'technicy',
        ),
        'dependency' => array(
          'element' => 'element',
          'value' => array('kontakt-info.php')
        ),
      ),
      array(
        'type' => 'param_group',
        'group' => 'Main Settings',
        'param_name' => 'contact_items',
        'save_always' => true,
        'params' => array(
          array(
            'type' => 'attach_image',
            'param_name' => 'img',
            'save_always' => true,
            'admin_label' => true
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Image URL', 'my-custom-plugin'),
            'param_name' => 'url',
            'save_always' => true,
            'admin_label' => true
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Name', 'my-custom-plugin'),
            'param_name' => 'name',
            'save_always' => true,
            'admin_label' => true
          ),
          array(
              'type' => 'textfield',
              'heading' => __('Phone', 'my-custom-plugin'),
              'param_name' => 'phone',
              'save_always' => true,
              'admin_label' => true
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Email', 'my-custom-plugin'),
            'param_name' => 'email',
            'save_always' => true,
            'admin_label' => true
          ),
        ),
        'dependency' => array(
          'element' => 'element',
          'value' => array('kontakt-info.php')
        ),
      ),
      array(
        'type' => 'textarea',
        'group' => 'Main Settings',
        'heading' => esc_html__('All contacts', 'my-custom-plugin'),
        'param_name' => 'contact_object',
        'description' => __('All contacts', 'my-custom-plugin'),
        'save_always' => true,
        'dependency' => array(
            'element' => 'element',
            'value' => array('kontakt-info.php')
        ),
      ),
      // REPLACE STRING<-------------------------------------------------------------------------<
      array(
        'type' => 'param_group',
        'group' => 'Replace Strings',
        'param_name' => 'replace_items',
        'params' => array(
          array(
            'type' => 'textarea',
            'heading' => __('Input HTML', 'my-custom-plugin'),
            'param_name' => 'input_replace_html',
            'save_always' => true,
            'admin_label' => true
          ),
          array(
              'type' => 'textarea',
              'heading' => __('Output HTML', 'my-custom-plugin'),
              'param_name' => 'output_replace_html',
              'save_always' => true,
              'admin_label' => true
          ),
        ),
      ),
      // ESTYMACJE <-------------------------------------------------------------------------<
      array(
        'type' => 'textarea',
        'group' => 'Main Settings',
        'heading' => esc_html__('Title', 'my-custom-plugin'),
        'param_name' => 'title_estymacje',
        'save_always' => true,
        'dependency' => array(
            'element' => 'element',
            'value' => array('estymacje.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => esc_html__('All visitors', 'my-custom-plugin'),
        'param_name' => 'visitors_estymacje',
        'description' => __('Set how many visitors entered the fair', 'my-custom-plugin'),
        'save_always' => true,
        'dependency' => array(
            'element' => 'element',
            'value' => array('estymacje.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => esc_html__('Visitors from Poland in %', 'my-custom-plugin'),
        'param_name' => 'polish_estymacje',
        'description' => __('How much percentage of visitors ware from poland, the rest will by from abroad', 'my-custom-plugin'),
        'save_always' => true,
        'dependency' => array(
            'element' => 'element',
            'value' => array('estymacje.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => esc_html__('Data of previus Edition', 'my-custom-plugin'),
        'param_name' => 'date_estymacje',
        'description' => __('Set up a date of previus edition', 'my-custom-plugin'),
        'save_always' => true,
        'dependency' => array(
            'element' => 'element',
            'value' => array('estymacje.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => esc_html__('Exhibitors space', 'my-custom-plugin'),
        'param_name' => 'space_estymacje',
        'description' => __('How much was total exhibitors space', 'my-custom-plugin'),
        'save_always' => true,
        'dependency' => array(
            'element' => 'element',
            'value' => array('estymacje.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => esc_html__('More discription', 'my-custom-plugin'),
        'param_name' => 'exhibitors_estymacje',
        'description' => __('Set more descriptions ex. "25 krajów"', 'my-custom-plugin'),
        'save_always' => true,
        'dependency' => array(
            'element' => 'element',
            'value' => array('estymacje.php')
        ),
      ),
      // COUNTDOWN <-------------------------------------------------------------------------<
      array(
        'type' => 'param_group',
        'group' => 'Main Settings',
        'heading' => __('Add countdown', 'my-custom-plugin'),
        'param_name' => 'countdowns',
        'dependency' => array(
          'element' => 'element',
          'value' => array('countdown.php', 'gallery.php')
        ),
        'params' => array(
          array(
            'type' => 'textfield',
            'heading' => __('Start', 'my-custom-plugin'),
            'param_name' => 'countdown_start',
            'description' => __('Format (Y/M/D H:M)', 'my-custom-plugin'),
            'save_always' => true,
            'admin_label' => true
          ),
          array(
            'type' => 'textfield',
            'heading' => __('End', 'my-custom-plugin'),
            'param_name' => 'countdown_end',
            'description' => __('Format (Y/M/D H:M)', 'my-custom-plugin'),
            'save_always' => true,
            'admin_label' => true
          ), 
          array(
            'type' => 'textfield',
            'heading' => __('Placeholder text', 'my-custom-plugin'),
            'param_name' => 'countdown_text',
            'description' => __('Default: "Do targów pozostało/Until the start of the fair"', 'my-custom-plugin'),
            'save_always' => true,
            'admin_label' => true
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Font size', 'my-custom-plugin'),
            'param_name' => 'countdown_font_size',
            'save_always' => true,
            'admin_label' => true
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Color', 'my-custom-plugin'),
            'param_name' => 'countdown_color',
            'save_always' => true,
            'admin_label' => true
          ),
          array(
            'type' => 'checkbox',
            'heading' => __('Turn off placeholder text', 'my-custom-plugin'),
            'param_name' => 'turn_off_countdown_text',
            'value' => array(__('True', 'my-custom-plugin') => 'true',),
            'save_always' => true,
            'admin_label' => true
          ),
          array(
            'type' => 'checkbox',
            'heading' => __('Row->Column', 'my-custom-plugin'),
            'param_name' => 'countdown_column',
            'value' => array(__('True', 'my-custom-plugin') => 'true',),
            'save_always' => true,
            'admin_label' => true
          ),
        ),
      ),
      // STICKY BUTTONS <-------------------------------------------------------------------------<
      array(
        'type' => 'colorpicker',
        'group' => 'Main Settings',
        'heading' => __('Background kolor (default akcent)', 'my-custom-plugin'),
        'param_name' => 'sticky_buttons_cropped_background',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('sticky-buttons.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Aspect ratio (default 21/9)', 'my-custom-plugin'),
        'param_name' => 'sticky_buttons_aspect_ratio',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('sticky-buttons.php')
        ),
      ),
      array(
        'type' => 'colorpicker',
        'group' => 'Main Settings',
        'heading' => __('Background full size kolor (default white)', 'my-custom-plugin'),
        'param_name' => 'sticky_buttons_full_size_background',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('sticky-buttons.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Aspect ratio full size (default 1/1)', 'my-custom-plugin'),
        'param_name' => 'sticky_buttons_aspect_ratio_full_size',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('sticky-buttons.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Font size buttons (default 12px)', 'my-custom-plugin'),
        'param_name' => 'sticky_buttons_font_size',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('sticky-buttons.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Font size full size buttons (default 16px)', 'my-custom-plugin'),
        'param_name' => 'sticky_buttons_font_size_full_size',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('sticky-buttons.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Width buttons (default 170px)', 'my-custom-plugin'),
        'param_name' => 'sticky_buttons_width',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('sticky-buttons.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Width full width buttons (default 170px)', 'my-custom-plugin'),
        'param_name' => 'sticky_full_width_buttons_width',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('sticky-buttons.php')
        ),
      ),
      array(
        'type' => 'checkbox',
        'group' => 'Main Settings',
        'heading' => __('Hide all sections except the first one', 'my-custom-plugin'),
        'param_name' => 'sticky_hide_sections',
        'save_always' => true,
        'value' => array(__('True', 'my-custom-plugin') => 'true',),
        'dependency' => array(
          'element' => 'element',
          'value' => array('sticky-buttons.php')
        ),
      ),
      array(
        'type' => 'checkbox',
        'group' => 'Main Settings',
        'heading' => __('Show dropdown buttons', 'my-custom-plugin'),
        'param_name' => 'sticky_buttons_dropdown',
        'save_always' => true,
        'value' => array(__('True', 'my-custom-plugin') => 'true',),
        'dependency' => array(
          'element' => 'element',
          'value' => array('sticky-buttons.php')
        ),
      ),
      array(
        'type' => 'checkbox',
        'group' => 'Main Settings',
        'heading' => __('Show full size buttons', 'my-custom-plugin'),
        'param_name' => 'sticky_buttons_full_size',
        'description' => __('Turn on full size images', 'my-custom-plugin'),
        'save_always' => true,
        'value' => array(__('True', 'my-custom-plugin') => 'true',),
        'dependency' => array(
          'element' => 'element',
          'value' => array('sticky-buttons.php')
        ),
      ),
      array(
        'type' => 'param_group',
        'group' => 'Main Settings',
        'param_name' => 'sticky_buttons',
        'dependency' => array(
          'element' => 'element',
          'value' => array('sticky-buttons.php')
        ),
        'params' => array(
          array(
            'type' => 'attach_images',
            'heading' => __('Select Image', 'my-custom-plugin'),
            'param_name' => 'sticky_buttons_images',
            'save_always' => true,
            'admin_label' => true
          ),
          array(
            'type' => 'attach_images',
            'heading' => __('Select Full Size Image', 'my-custom-plugin'),
            'param_name' => 'sticky_buttons_full_size_images',
            'save_always' => true,
            'admin_label' => true
          ),
          array(
            'type' => 'colorpicker',
            'heading' => __('Background color button', 'my-custom-plugin'),
            'description' => __('Jeżeli jest dodatkowo dodany obrazek to ma większy priorytet', 'my-custom-plugin'),
            'param_name' => 'sticky_buttons_color_bg',
            'save_always' => true,
            'admin_label' => true
          ),
          array(
            'type' => 'textarea',
            'heading' => __('Button text', 'my-custom-plugin'),
            'param_name' => 'sticky_buttons_color_text',
            'save_always' => true,
            'admin_label' => true
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Button link', 'my-custom-plugin'),
            'param_name' => 'sticky_buttons_link',
            'save_always' => true,
            'admin_label' => true
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Button id (PRZECZYTAJ!)', 'my-custom-plugin'),
            'description' => __('Wpisując tutaj ID musisz dodać taki sam ID w elemencie który chcesz ukryć.', 'my-custom-plugin'),
            'param_name' => 'sticky_buttons_id',
            'save_always' => true,
            'admin_label' => true
          ),
        ),
      ),
      // MAIN TIMER <-------------------------------------------------------------------------<
      array(  
        'type' => 'checkbox',
        'group' => 'Main Settings',
        'heading' => __('Turn on to hide register', 'my-custom-plugin'),
        'param_name' => 'show_register_bar',
        'description' => __('Turn on to hide register button on bar', 'my-custom-plugin'),
        'admin_label' => true,
        'save_always' => true,
        'value' => array(__('True', 'my-custom-plugin') => 'true',),
        'dependency' => array(
          'element' => 'element',
          'value' => array('main-timer.php')
        ),
      ),
      // VIDEOS <-------------------------------------------------------------------------<
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Custom title element', 'my-custom-plugin'),
        'param_name' => 'video_custom_title',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('videos.php')
        ),
      ),
      array(
        'type' => 'param_group',
        'group' => 'Main Settings',
        'heading' => __('Youtube iframes', 'my-custom-plugin'),
        'param_name' => 'videos',
        'dependency' => array(
          'element' => 'element',
          'value' => array('videos.php')
        ),
        'params' => array(
          array(
            'type' => 'textfield',
            'heading' => __('Title', 'my-custom-plugin'),
            'param_name' => 'video_title',
            'save_always' => true,
            'admin_label' => true
          ),
          array(
            'type' => 'textarea',
            'heading' => __('Iframe', 'my-custom-plugin'),
            'param_name' => 'video_iframe',
            'save_always' => true,
            'admin_label' => true
          ),
        ),
      ),
      // FORM CONTENT <-------------------------------------------------------------------------<
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Custom title form', 'my-custom-plugin'),
        'param_name' => 'pwe_title_form',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('form-content.php', 'registration.php')
        ),
      ),
      array(
        'type' => 'textarea',
        'group' => 'Main Settings',
        'heading' => __('Custom text form', 'my-custom-plugin'),
        'param_name' => 'pwe_text_form',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('form-content.php', 'registration.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Custom button text form', 'my-custom-plugin'),
        'param_name' => 'pwe_button_text_form',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('form-content.php', 'registration.php')
        ),
      ),
      array(
        'type' => 'textfield',
        'group' => 'Main Settings',
        'heading' => __('Height logotypes', 'my-custom-plugin'),
        'description' => __('Default 50px', 'my-custom-plugin'),
        'param_name' => 'pwe_height_logotypes_form',
        'save_always' => true,
        'dependency' => array(
          'element' => 'element',
          'value' => array('registration.php')
        ),
      ),
      array(
        'type' => 'dropdown',
        'group' => 'Main Settings',
        'heading' => __('Form id', 'my-custom-plugin'),
        'param_name' => 'pwe_registration_form_id',
        'save_always' => true,
        'value' => array_merge(
          array('Wybierz' => ''),
          $pwe_forms_array
        ),
        'dependency' => array(
          'element' => 'element',
          'value' => array('registration.php')
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
    $rnd_id = rand(10000, 99999);

    if ($locale === 'pl_PL'){
      $trade_date = do_shortcode('[trade_fair_date]');
      $trade_name = do_shortcode('[trade_fair_name]');
      $trade_desc = do_shortcode('[trade_fair_desc]');
    } else {
      $trade_date = do_shortcode('[trade_fair_date_eng]');
      $trade_name = do_shortcode('[trade_fair_name_eng]');
      $trade_desc = do_shortcode('[trade_fair_desc_eng]');
    }
    $trade_start = do_shortcode('[trade_fair_datetotimer]');
    $trade_end = do_shortcode('[trade_fair_enddata]');

    if(!empty($content)){            
      $custom_content = wpb_js_remove_wpautop($content, true);
    } else {
      $custom_content = $atts['custom_content'];
    }

    // $selected_option = vc_param_group_get_key('params', 'slider_off', $atts);

    if (isset($atts['color'])) { $color = $atts['color']; }
    if (isset($atts['btn_color'])) { $button_color = $atts['btn_color']; }
    if (isset($atts['btn_color_text'])) { $button_color_text = $atts['btn_color_text']; }
    if (isset($atts['btn_color_shadow'])) { $button_color_shadow = $atts['btn_color_shadow']; }
    
    global $custom_element_colors;

    if ($button_color === '') {
      $button_color_text = ($button_color_text == '') ? '#ffffff' : $button_color_text;
      $button_color_shadow = ($button_color_shadow === '') ? $button_color_text : $button_color_shadow;
      $btn_color = '.btn {
          color: '. $button_color_text .' !important;
          background-color: #000000 !important;
          border-color: #000000 !important;
          box-shadow: 9px 9px 0px -5px '. $button_color_shadow .' !important;
      }';
      $btn_color_hover = '.btn:hover  {
          color: #000000 !important;
          background-color: #ffffff !important;
          border-color: #000000 !important;
      }';
    } else if (($button_color === '#000000') || 
    ($button_color === '#101213') || 
    ($button_color === '#141618') ||
    ($button_color === '#1b1d1f') ||
    ($button_color === '#303133')) {
      $button_color_text = ($button_color_text == '') ? '#ffffff' : $button_color_text;
      $button_color_shadow = ($button_color_shadow === '') ? $button_color_text : $button_color_shadow;
      $btn_color = '.btn {
          color: '. $button_color_text .' !important;
          background-color: '. $button_color .' !important;
          border-color: '. $button_color .' !important;
          box-shadow: 9px 9px 0px -5px '. $button_color_shadow .' !important;
      }';
      $btn_color_hover = '.btn:hover {
          color: #000000 !important;
          background-color: #ffffff !important;
          border-color: '. $button_color .' !important;
      }';
    } else if (($button_color === '#ffffff') || 
    ($button_color === '#f7f7f7') || 
    ($button_color === '#eaeaea') ||
    ($button_color === '#dddddd') ||
    ($button_color === '#777777')) {
      $button_color_text = ($button_color_text == '') ? '#000000' : $button_color_text;
      $button_color_shadow = ($button_color_shadow === '') ? $button_color_text : $button_color_shadow;
      $btn_color = '.btn {
          color: '. $button_color_text .' !important;
          background-color: '. $button_color .' !important;
          border-color: #000000 !important;
          box-shadow: 9px 9px 0px -5px '. $button_color_shadow .' !important;
      }';
      $btn_color_hover = '.btn:hover {
          color: #ffffff !important;
          background-color: #000000 !important;
          border-color: #ffffff !important;
      }';
    } else {
      $button_color_text = ($button_color_text == '') ? '#ffffff' : $button_color_text;
      $button_color_shadow = ($button_color_shadow === '') ? $button_color_text : $button_color_shadow;
      $btn_color = '.btn {
          color: '. $button_color_text .' !important;
          background-color: '. $button_color .' !important;
          border-color: '. $button_color .' !important;
          box-shadow: 9px 9px 0px -5px '. $button_color_shadow .' !important;
      }';
      $btn_color_hover = '.btn:hover {
        color: #000000 !important;
        background-color: #ffffff !important;
        border-color: '. $button_color .' !important;
      }';
    }
    
    if (isset($atts['element'])) { $element = $atts['element']; }
    if (isset($atts['file'])) { $file = $atts['file']; }

    // FOR VISITORS
    if (isset($atts['visitor1'])) { $visitor1 = $atts['visitor1']; }
    if (isset($atts['visitor2'])) { $visitor2 = $atts['visitor2']; }

    // FOR VISITORS
    if (isset($atts['visitor1'])) { $visitor1 = $atts['visitor1']; }
    if (isset($atts['visitor2'])) { $visitor2 = $atts['visitor2']; }

    // VIDEO
    if (isset($atts['video_custom_title'])) { $video_custom_title = $atts['video_custom_title']; }
    if (isset($atts['videos'])) { $videos = $atts['videos']; }

    // FOR EXHIBITORS
    if (isset($atts['exhibitor1'])) { $exhibitor1 = $atts['exhibitor1']; }
    if (isset($atts['exhibitor2'])) { $exhibitor2 = $atts['exhibitor2']; }
    if (isset($atts['exhibitor3'])) { $exhibitor3 = $atts['exhibitor3']; }
    if (isset($atts['exhibitor4'])) { $exhibitor4 = $atts['exhibitor4']; }
    if (isset($atts['exhibitor5'])) { $exhibitor5 = $atts['exhibitor5']; }
    if (isset($atts['exhibitor6'])) { $exhibitor6 = $atts['exhibitor6']; }

    // HEADER
    if (isset($atts['button_on'])) { $button_on = $atts['button_on']; }
    if (isset($atts['header_simple_mode'])) { $header_simple_mode = $atts['header_simple_mode']; }
    if (isset($atts['header_bg_position'])) { $header_bg_position = $atts['header_bg_position']; }
    if (isset($atts['header_tickets_button_link'])) { $header_tickets_button_link = $atts['header_tickets_button_link']; }
    if (isset($atts['header_register_button_link'])) { $header_register_button_link = $atts['header_register_button_link']; }
    if (isset($atts['header_conferences_button_link'])) { $header_conferences_button_link = $atts['header_conferences_button_link']; }
    if (isset($atts['header_custom_buttons'])) { $header_custom_buttons = $atts['header_custom_buttons']; }
    if (isset($atts['header_conferences_title'])) { $header_conferences_title = $atts['header_conferences_title']; }
    if (isset($atts['header_custom_logotypes'])) { $header_custom_logotypes = $atts['header_custom_logotypes']; }
    if (isset($atts['header_overlay_color'])) { $header_overlay_color = $atts['header_overlay_color']; }
    if (isset($atts['header_overlay_range'])) { $header_overlay_range = $atts['header_overlay_range']; }
    if (isset($atts['header_logo_width'])) { $header_logo_width = $atts['header_logo_width']; }
    if (isset($atts['header_logo_color'])) { $header_logo_color = $atts['header_logo_color']; }
    
    // LOGOTYPE GALLERY
    if (isset($atts['logo_url'])) { $logo_url = $atts['logo_url']; }
    if (isset($atts['titlecatalog'])) { $titlecatalog = $atts['titlecatalog']; }
    if (isset($atts['logotypes_files'])) { $logotypes_files = $atts['logotypes_files']; }
    if (isset($atts['left_center_right_title'])) { $left_center_right_title = $atts['left_center_right_title']; }
    if (isset($atts['slider_full_width_on'])) { $slider_full_width_on = $atts['slider_full_width_on']; }
    if (isset($atts['slider_desktop'])) { $slider_desktop = $atts['slider_desktop']; }
    if (isset($atts['grid_mobile'])) { $grid_mobile = $atts['grid_mobile']; }
    if (isset($atts['slider_logo_white'])) { $slider_logo_white = $atts['slider_logo_white']; }
    if (isset($atts['slider_logo_color'])) { $slider_logo_color = $atts['slider_logo_color']; }
    if (isset($atts['logoscatalog'])) { global $logoscatalog; $logoscatalog = $atts['logoscatalog']; }

    if (isset($atts['countdowns'])) { $countdowns = $atts['countdowns']; }
    
    if (isset($atts['show_banners'])) { $show_banners = $atts['show_banners']; }
    if (isset($atts['logo_white_promote'])) { $logo_white_promote = $atts['logo_white_promote']; }
    if (isset($atts['min_width_logo'])) { $min_width_logo = $atts['min_width_logo']; }
    if (isset($atts['tickets_available'])) { $tickets_available = $atts['tickets_available']; }
    
    if (isset($atts['logo_color'])) { $logo_color = $atts['logo_color']; }
    if (isset($atts['logo_color_invert'])) { $logo_color_invert = $atts['logo_color_invert']; }
    if (isset($atts['fair_partner'])) { $fair_partner = $atts['fair_partner']; }
    if (isset($atts['footer_logo_color'])) { $footer_logo_color = $atts['footer_logo_color']; }
    if (isset($atts['horizontal'])) { $horizontal = $atts['horizontal']; }
    if (isset($atts['worker_form_id'])) { $worker_form_id = $atts['worker_form_id']; }
    if (isset($atts['gallery_countdown'])) { $gallery_countdown = $atts['gallery_countdown']; }
    if (isset($atts['guest_form_id'])) { $guest_form_id = $atts['guest_form_id']; }
    if (isset($atts['badge_form_id'])) { $badge_form_id = $atts['badge_form_id']; }
    if (isset($atts['contact_number'])) { $contact_number = $atts['contact_number']; }
    if (isset($atts['contact_object'])) { $contact_object = $atts['contact_object']; }
    if (isset($atts['contact_header'])) { $contact_header = $atts['contact_header']; }
    if (isset($atts['contact_content'])) { $contact_content = $atts['contact_content']; }
    if (isset($atts['contact_items'])) { $contact_items = vc_param_group_parse_atts($atts['contact_items']); }

    // POSTS
    if (isset($atts['posts_cat'])) { $posts_cat = $atts['posts_cat']; }
    if (isset($atts['posts_category'])) { $posts_category = $atts['posts_category']; }
    if (isset($atts['posts_count'])) { $posts_count = $atts['posts_count']; }
    if (isset($atts['posts_ratio'])) { $posts_ratio = $atts['posts_ratio']; }
    if (isset($atts['posts_link'])) { $posts_link = $atts['posts_link']; }
    if (isset($atts['posts_btn'])) { $posts_btn = $atts['posts_btn']; }

    // PROFILES
    if (isset($atts['profile_title_checkbox'])) { $profile_title_checkbox = $atts['profile_title_checkbox']; }
    if (isset($atts['profile_title'])) { $profile_title = $atts['profile_title']; }
    if (isset($atts['profile_images'])) { $profile_images = $atts['profile_images']; }
    if (isset($atts['profile_buttons'])) { $profile_buttons = $atts['profile_buttons']; }
    if (isset($atts['profile_border'])) { $profile_border = $atts['profile_border']; }
    if (isset($atts['profile_background'])) { $profile_background = $atts['profile_background']; }
    if (isset($atts['profile_reverse_block'])) { $profile_reverse_block = $atts['profile_reverse_block']; }
    if (isset($atts['profile_tickets_button_link'])) { $profile_tickets_button_link = $atts['profile_tickets_button_link']; }
    if (isset($atts['profile_register_button_link'])) { $profile_register_button_link = $atts['profile_register_button_link']; }
    if (isset($atts['profile_exhibitors_button_link'])) { $profile_exhibitors_button_link = $atts['profile_exhibitors_button_link']; }
    if (isset($atts['profile_img_aspect_ratio'])) { $profile_img_aspect_ratio = $atts['profile_img_aspect_ratio']; }
    if (isset($atts['profile_img_max_width'])) { $profile_img_max_width = $atts['profile_img_max_width']; }
    if (isset($atts['profile_padding_element'])) { $profile_padding_element = $atts['profile_padding_element']; }

    if (isset($atts['content'])) { $content = $atts['content']; }

    // STICKY BUTTONS
    if (isset($atts['sticky_buttons'])) { $sticky_buttons = $atts['sticky_buttons']; }
    if (isset($atts['sticky_buttons_dropdown'])) { $sticky_buttons_dropdown = $atts['sticky_buttons_dropdown']; }
    if (isset($atts['sticky_buttons_full_size'])) { $sticky_buttons_full_size = $atts['sticky_buttons_full_size']; }
    if (isset($atts['sticky_buttons_cropped_background'])) { $sticky_buttons_cropped_background = $atts['sticky_buttons_cropped_background']; }
    if (isset($atts['sticky_buttons_full_size_background'])) { $sticky_buttons_full_size_background = $atts['sticky_buttons_full_size_background']; }
    if (isset($atts['sticky_buttons_aspect_ratio'])) { $sticky_buttons_aspect_ratio = $atts['sticky_buttons_aspect_ratio']; }
    if (isset($atts['sticky_buttons_aspect_ratio_full_size'])) { $sticky_buttons_aspect_ratio_full_size = $atts['sticky_buttons_aspect_ratio_full_size']; }
    if (isset($atts['sticky_hide_sections'])) { $sticky_hide_sections = $atts['sticky_hide_sections']; }
    if (isset($atts['sticky_buttons_font_size'])) { $sticky_buttons_font_size = $atts['sticky_buttons_font_size']; }
    if (isset($atts['sticky_buttons_font_size_full_size'])) { $sticky_buttons_font_size_full_size = $atts['sticky_buttons_font_size_full_size']; }
    if (isset($atts['sticky_buttons_width'])) { $sticky_buttons_width = $atts['sticky_buttons_width']; }
    if (isset($atts['sticky_full_width_buttons_width'])) { $sticky_full_width_buttons_width = $atts['sticky_full_width_buttons_width']; }

    // FORM CONTENT
    if (isset($atts['pwe_title_form'])) { $pwe_title_form = $atts['pwe_title_form']; }
    if (isset($atts['pwe_text_form'])) { $pwe_text_form = $atts['pwe_text_form']; }
    if (isset($atts['pwe_button_text_form'])) { $pwe_button_text_form = $atts['pwe_button_text_form']; }

    if (isset($atts['pwe_registration_form_id'])) { $pwe_registration_form_id = $atts['pwe_registration_form_id']; }
    if (isset($atts['pwe_height_logotypes_form'])) { $pwe_height_logotypes_form = $atts['pwe_height_logotypes_form']; }
   
    if (isset($atts['show_register_bar'])) { $show_register_bar = $atts['show_register_bar']; }

    if (preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT']) && isset($atts['gallery_mobile'])) {
        $gallery = $atts['gallery_mobile'];
    } else {
      if (isset($atts['gallery'])) { $gallery = $atts['gallery']; }
    }
    if (isset($atts['gallery_title'])) { $gallery_title = $atts['gallery_title']; }
    if (isset($atts['gallery_btn_link'])) { $gallery_btn_link = $atts['gallery_btn_link']; }
    if (isset($atts['gallery_btn_text'])) { $gallery_btn_text = $atts['gallery_btn_text']; }

    if (isset($atts['replace_items'])) {
      $replace_items = $atts['replace_items'];
      $replace_items_urldecode = urldecode($replace_items);
      $replace_items_json = json_decode($replace_items_urldecode, true);

      $input_replace_array_html = array();
      $output_replace_array_html = array();
      
      foreach ($replace_items_json as $replace_item) {
        $input_replace_array_html[] = $replace_item["input_replace_html"];
        $output_replace_array_html[] = $replace_item["output_replace_html"];
      }
      $input_replace_array = json_encode($input_replace_array_html);
      $output_replace_array = json_encode($output_replace_array_html);
    }

    if (isset($atts['title_estymacje'])) { $title_estymacje = $atts['title_estymacje']; } else { $title_estymacje = 'Branżowi odwiedzający<br>1. Edycji'; }
    if (isset($atts['visitors_estymacje'])) { $visitors_estymacje = $atts['visitors_estymacje']; } else { $visitors_estymacje = '3638'; }
    if (isset($atts['polish_estymacje'])) { $polish_estymacje = $atts['polish_estymacje']; } else {$polish_estymacje = '93'; }
    if (isset($atts['date_estymacje'])) { $date_estymacje = $atts['date_estymacje']; } else {$date_estymacje = $trade_date; }
    if (isset($atts['space_estymacje'])) { $space_estymacje = $atts['space_estymacje']; } else {$space_estymacje = '20 000'; }
    if (isset($atts['exhibitors_estymacje'])) { $exhibitors_estymacje = $atts['exhibitors_estymacje']; } else {$exhibitors_estymacje = '90'; }
    
    if (isset($atts['gallery_images'])) {
      $gallery_array = explode(',' , $atts['gallery_images']);
      $gallery_images = array(); 
      foreach($gallery_array as $image){
        $gallery_images[] = wp_get_attachment_url($image);
      }
    }
    
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

      // Replace HTML elements
      if ($input_replace_array_html && $output_replace_array_html) {
        $original_html = $file_cont;
        $file_cont = str_replace($input_replace_array_html, $output_replace_array_html, $file_cont);
        // if (current_user_can('administrator') && !is_admin()) {
        //     if (($original_html === $file_cont) && ($input_replace_array[0] !== "" || $output_replace_array[0] !== "")) {
        //         echo '<script>console.error("Błąd: Zamiana nie została dokonana w elemencie '. $element.'");</script>';
        //     } else {
        //         echo '<script>console.log("Zamiana została dokonana w elemencie '. $element .'");</script>';
        //     }
        // }  
      }
    
  
      $file_cont = '<div class="custom_element custom_element_'.$rnd_id.'">' . $file_cont . '</div>';
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

    $kontakt_array = array (
      'contact_number' => $contact_number,
    );

    $js_file_logos = plugins_url('js/logos-catalog.js', __FILE__);
    $js_version_logos = filemtime(plugin_dir_path(__FILE__) . 'js/logos-catalog.js');
    wp_enqueue_script('my-custom-element-logos-js', $js_file_logos, array('jquery'), $js_version_logos, true);
    wp_localize_script( 'my-custom-element-logos-js', 'inner', $inner_array ); 

    $js_file_kontakts = plugins_url('js/kontakt-info-backend.js', __FILE__);
    $js_version_kontakts = filemtime(plugin_dir_path(__FILE__) . 'js/kontakt-info-backend.js');
    wp_enqueue_script('my-custom-element-kontakts-js', $js_file_kontakts, array('jquery'), $js_version_kontakts, true);
    wp_localize_script( 'my-custom-element-kontakts-js', 'inner_kontakt', $kontakt_array ); 
  }



  add_action('wp_enqueue_scripts', 'my_custom_element_scripts');

  add_action('vc_before_init', 'my_custom_wpbakery_element');
  add_shortcode('my_custom_element', 'my_custom_element_output');

  add_action('admin_enqueue_scripts', 'admin_script');
?>