<?php
// File: my_plugin_admin_page.php

function dodaj_podmenu() {
    add_submenu_page(
        'moja-wtyczka-dostep-do-katalogu', // Slug rodzica (strony menu)
        'Alty zdjęć',                        // Tytuł podmenu
        'Alty zdjęć',                        // Wyświetlany tekst w menu bocznym
        'manage_options',                 // Wymagane uprawnienia
        'moja-wtyczka-alty-zdjec',           // Unikalny identyfikator podmenu
        'funkcja_renderujaca_podmenu_alty'   // Funkcja wyświetlająca zawartość podmenu
    );
}

function funkcja_renderujaca_podmenu_alty() {
    if (isset($_POST['alt_attributes'])) {
        // Handle form submission and save alt attributes
        foreach ($_POST['alt_attributes'] as $media_id => $alt_text) {
            update_post_meta($media_id, '_wp_attachment_image_alt', sanitize_text_field($alt_text));
        }

        // Show success message after saving data
        echo '<div class="notice notice-success"><p>Alt attributes saved successfully.</p></div>';
    }

    $args = array(
        'post_type'      => 'attachment',
        'post_mime_type' => 'image', // Limit the query to images
        'post_status'    => 'inherit', // Include attachments with status 'inherit'
        'posts_per_page' => -1 // Number of results per page
    );

    $media_query = new WP_Query($args);

    echo '<div class="wrap">';
    echo '<h1>Wszystkie elementy galerii mediów</h1>';
    
    echo '<form method="post">'; // Open the form

    echo '<div class="galeria-zdjec">';
    while ($media_query->have_posts()) {
        $media_query->the_post();
        if ($media_query->post->post_parent != '0') {
            $media_id = $media_query->post->ID;
            
            $parent_id = $media_query->post->post_parent;
            // Get the image URL
            $image_url = wp_get_attachment_image_src(get_the_ID(), 'thumbnail');
            $image_url = $image_url[0];

            // Get the image title (if any)
            $image_title = get_the_title();

            // Get the existing alt text for the image
            $alt_text = get_post_meta($media_id, '_wp_attachment_image_alt', true);

            // Output the image thumbnail and title as a link
            echo '<div>';
            echo '<a href="' . esc_url(wp_get_attachment_url(get_the_ID())) . '" target="_blank">';
            echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($alt_text) . '">';
            echo '</a>';

            if (strlen($alt_text) <= 1){
                $alt_text = str_replace(array('-', '_'), ' ', $image_title);
            }

            // Display the input field for "alt" attribute
            echo '<p>' . esc_html($image_title) . '</p>';
            echo '<input type="text" name="alt_attributes[' . esc_attr($media_id) . ']" value="' . esc_attr($alt_text) . '">';

            echo '</div>';
        }
    }

    echo '</div>';

    // Add submit button
    echo '<input type="submit" value="Save Alt Attributes" class="button button-primary">';

    // Close the form
    echo '</form>';

    // Add pagination links if needed
    echo '<div class="pagination">';
    echo paginate_links(array(
        'total'   => $media_query->max_num_pages,
        'current' => $strona,
    ));
    echo '</div>';

    echo '</div>'; // Close the wrap div

    // Restore the global post data
    wp_reset_postdata();
}

add_action('admin_menu', 'dodaj_podmenu');

?>
