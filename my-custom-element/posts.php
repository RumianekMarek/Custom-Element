<?php

    if($locale == 'pl_PL') {
        $posts_title = ($posts_title == "") ? "Aktualności" : $posts_title;
        $posts_link = ($posts_link == "") ? "/aktualnosci/" : $posts_link;
        $posts_text = "Zobacz wszystkie";
    } else {
        $posts_title = ($posts_title == "") ? "News" : $posts_title;
        $posts_link = ($posts_link == "") ? "/en/news/" : $posts_link;
        $posts_text = "See all";
    }
    $posts_count = ($posts_count == "") ? 1 : $posts_count;
    $posts_ratio = ($posts_ratio == "") ? "1/1" : $posts_ratio;

    if ($btn_color != ''){
        $btn_color = '.custom_element_'.$rnd_id.' .custom-btn-container '.$btn_color;
        if ($btn_color_hover) {
            $btn_color_hover = '.custom_element_'.$rnd_id.' .custom-btn-container '.$btn_color_hover;
        }
    } 
    
?>

<style>
    <?php echo $btn_color ?>
    <?php echo $btn_color_hover ?>

    .row-parent:has(.custom_element_<?php echo $rnd_id ?> .custom-container-posts) {
        max-width: 100%;
        padding: 0 !important;
    }
    .custom_element_<?php echo $rnd_id ?> .custom-posts-wrapper {
        max-width: 1200px; 
        margin: 0 auto; 
        padding: 36px;  
    } 
    .custom-posts-title h4 {
        margin: 0 0 36px;
    }
    .custom-posts {
        display: flex;
        justify-content: center;
        gap: 18px;
        padding-bottom: 18px;
    }
    .custom-post {
        min-width: 250px;
        max-width: 250px;
    }
    .custom-post-title {
        margin: 0;
        padding: 10px 0 0 10px;
    }
    .custom-post-thumbnail .image-container {
        width: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        aspect-ratio: <?php echo $posts_ratio ?>;
        max-width: 250px;
    }
    .custom-posts .slides {
        align-items: flex-start !important;
        gap: 18px;
    }
    @media (max-width: 600px) {
        .custom-post-title {
            font-size: 14px !important;
        }
    }
    @media (min-width: 1200px) {
        .custom-posts .slides {
            gap: 30px;
        }
    }
</style>

<?php

if ($posts_count > 1) {
    if ($posts_count % 2 == 0) {
        echo'<style>
                .custom-posts .slides {
                    margin: 0 !important;
                }
            </style>';
    } else {
        echo'<style>
                @media (max-width: 600px) {
                    .custom-posts .slides {
                        margin-left: 156px !important;
                    }
                }
            </style>';
    }
}

$output .= '<div id="customPosts" class="custom-container-posts">
                
    <div class="custom-posts-wrapper">

        <div class="custom-posts-title main-heading-text">
            <h4 class="custom-uppercase"><span>' . $posts_title . '</span></h4>
        </div>  
        <div class="custom-posts">';

        if (strlen($trade_end) <= 10) { // Zakładając, że format daty to 'Y/m/d'
            $trade_end .= ' 17:00'; // Dopisanie '00:00' do daty
        }
        $trade_end_date = DateTime::createFromFormat('Y/m/d H:i', $trade_end);
        $now = new DateTime();

        if ($trade_end_date !== false) {
            // Pobranie roku z daty zakończenia targów
            $trade_end_year = $trade_end_date->format('Y');

            // Tworzenie nazwy kategorii z prefiksem "news-" i rokiem
            $news_category_name = 'news-' . $trade_end_year;

            // Sprawdzenie, czy istnieje kategoria z prefiksem "news-" i rokiem
            $category_exists = term_exists($news_category_name, 'category');

            if ($category_exists) {
                // Kategoria "news-{rok}" istnieje, więc nic nie zmieniamy
            } else if (!$category_exists && term_exists("current", 'category')) {
                // Kategoria "news-{rok}" nie istnieje, sprawdzamy "current"
                $news_category_name = "current";
            } else if (!empty($posts_category) && term_exists($posts_category, 'category')) {
                // Kategoria "current" nie istnieje, sprawdzamy $posts_category
                $news_category_name = $posts_category;
            } else if (!empty($posts_cat) && term_exists($posts_cat, 'category')) {
                // Ani "current", ani $posts_category nie istnieją, użyj $posts_cat
                $news_category_name = $posts_cat;
            }
            
            // else {
            //     // Żadna z kategorii nie istnieje, pobieramy wszystkie wpisy
            //     // $news_category_name = null;
            // }

            $args = array(
                'posts_per_page' => min($posts_count, 4),
                'orderby' => 'date',
                'order' => 'DESC',
                'category_name' => $news_category_name,
            );

            $query = new WP_Query($args);

            $post_image_urls = array();
            if ($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();
                    $link = get_permalink();
                    $image = has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'full') : '';
                    $title = get_the_title();

                    $post_image_urls[] = array(
                        "img" => $image,
                        "link" => $link,
                        "title" => $title
                    );
                endwhile;
            }

            wp_reset_postdata();

            include_once plugin_dir_path(__FILE__) . '/../scripts/posts-slider.php';
            $output .= custom_posts_slider($post_image_urls);

        } else {
            echo 'Błąd: Nieprawidłowy format daty.';
            return;
        }

        $output .= '</div>';
        if ($posts_btn !== "true") {
            $output .= '
            <div class="custom-btn-container" style="padding-top: 18px;">
                <span>
                    <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="'. $posts_link .'">'. $posts_text .'</a>
                </span>
            </div>';
        }
        
        

    $output .= '</div>
                
</div>';

echo $output;

?>

<script>

document.addEventListener("DOMContentLoaded", function() {
  const customPostsElement = document.querySelector('.custom-posts');
  const customSliderElement = document.querySelector('.custom-posts .slides');
  const customPostsRow = document.querySelector('.row-container:has(.custom-posts)');
  if ((customPostsElement && customPostsElement.children.length === 0) || (customSliderElement && customSliderElement.children.length === 0)) {
    customPostsRow.classList.add('desktop-hidden', 'tablet-hidden', 'mobile-hidden');
  }
});

</script>