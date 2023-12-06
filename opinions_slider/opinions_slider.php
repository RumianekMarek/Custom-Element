<?php
function media_opinions() {
    vc_map(array(
        'name' => __('Opinions slider', 'my-custom-plugin'),
        'base' => 'media_opinions',
        'category' => __('My Elements', 'my-custom-plugin'),
        'params' => array(
            array(
                'type' => 'textfield',
                'group' => 'Main',
                'heading' => __('Custom id', 'my-custom-plugin'),
                'param_name' => 'custom_opinions_id',
                'description' => __('Set custom id for opinions not to have the same id as other opinionss.', 'my-custom-plugin'),
                'save_always' => true,
            ),
            array(
                'type' => 'attach_images',
                'group' => 'Main',
                'heading' => __('Select Images', 'my-custom-plugin'),
                'param_name' => 'custom_opinions_images',
                'description' => __('Choose images from the media library.', 'my-custom-plugin'),
                'save_always' => true,
            ),
        ),
    ));
}

function media_opinions_output($atts, $content = null) {
    extract(shortcode_atts(array(
        'custom_opinions_id' => '',
        'custom_opinions_name' => '',
    ), $atts));

    if ($custom_opinions_id_random) {
        $custom_opinions_id_random = 'opinions-' . rand(10000, 99999);
    }

    $custom_opinions_id = ($atts['custom_opinions_id']) ? $atts['custom_opinions_id'] : $custom_opinions_id_random;
    $custom_opinions_images = ($atts['custom_opinions_images']) ? explode(',', $atts['custom_opinions_images']) : '';

    $html_opinions = '<div id="' . $custom_opinions_id . '" class="slider-opinions-container">';
    $html_opinions .= '<div class="slider-opinions-content">';

    foreach ($custom_opinions_images as $image) {
        $image_src = wp_get_attachment_image_src($image, 'full');
        $image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);

        $html_opinions .= '<div class="slide-opinion">';
        $html_opinions .= '<div class="slide-opinion-content">';
        $html_opinions .= '<img class="apostrof-left" src="/wp-content/plugins/custom-element/opinions_slider/apostrof-left.png"/>';
        $html_opinions .= '<div class="slider-opinions-content-element">';
        $html_opinions .= '<img src="' . $image_src[0] . '" alt="' . $image_alt . '" class="slider-opinions-image">';
        $html_opinions .= '<p>'. $image_alt .'</p>';
        $html_opinions .= '</div>';
        $html_opinions .= '<img class="apostrof-right" src="/wp-content/plugins/custom-element/opinions_slider/apostrof-right.png"/>';
        $html_opinions .= '</div>';
        $html_opinions .= '</div>';
    }

    $html_opinions .= '</div></div>';

    // Add CSS for the slider
    $html_opinions .= '<style>
        .slider-opinions-container {
            display: flex;
            overflow: hidden;
        }

        .slider-opinions-content {
            display: flex;
            transition: transform 1s ease;
        }

        .slide-opinion {
            flex: 0 0 100%;
            display:flex;
            align-items: stretch;
        }

        .slide-opinion-content {
            display: flex;
            flex-direction: row;
            align-items: stretch;
            justify-content: center;
            text-align: center;
        }
        .slide-opinion-content p {
            margin: 18px;
        }
        .slide-opinion-content .apostrof-left, .slide-opinion-content .apostrof-right {
            height:50px;
        }
        .slide-opinion-content .apostrof-left {
            align-self: flex-start;
        }
        .slide-opinion-content .apostrof-right {
            align-self: flex-end;
        }
        .slider-opinions-image {
            width: 180px;
            height: auto;
        }
    </style>';

    // Add JavaScript for automatic sliding to the left
    $html_opinions .= '<script>
        const sliderContainer = document.getElementById("' . $custom_opinions_id . '");
        const sliderContent = sliderContainer.querySelector(".slider-opinions-content");
        const slides = sliderContainer.querySelectorAll(".slide-opinion");
        let currentIndex = 0;

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            sliderContent.style.transform = "translateX(-" + currentIndex * 100 + "%)";
        }
        
        setInterval(nextSlide, 3000); // Change slide every 3 seconds
    </script>';

    return $html_opinions;
}

add_action('vc_before_init', 'media_opinions');
add_shortcode('media_opinions', 'media_opinions_output');
?>