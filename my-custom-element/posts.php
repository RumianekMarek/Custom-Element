<?php
    $mobile = preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT']);

    if($locale == 'pl_PL') {
        $posts_title = ($posts_title == "") ? "Aktualności" : $posts_title;
        $posts_link = ($posts_link == "") ? "/aktualnosci/" : $posts_link;
        $posts_text = "Zobacz wszystkie";
    } else {
        $posts_title = ($posts_title == "") ? "News" : $posts_title;
        $posts_link = ($posts_link == "") ? "/en/news/" : $posts_link;
        $posts_text = "See all";
    }
    $posts_count = ($posts_count == "") ? 5 : $posts_count;
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
        opacity: 0;
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
    }
    .custom-posts .slides {
        align-items: flex-start !important;
        gap: 16px;
    }
    @media (max-width: 1128px) {
        .custom_element_<?php echo $rnd_id ?> .custom-posts-wrapper {
            padding: 36px;  
        }
    }
</style>

<?php

// Display all categories across the full width of the page
if ($posts_full_width === 'true' && $mobile != 1) {
    $output .= ' <style>
                    .custom-posts-wrapper {
                        max-width: 100% !important;  
                        padding: 36px 0 !important; 
                    }
                    .custom-posts-title {
                        max-width: 1200px;
                        margin: 0 auto;
                        padding-left: 36px;
                    }
                    .custom-posts .slides {
                        margin-right: 36px !important;
                        gap: 36px !important;
                    }
                    .custom-post .t-entry-visual,
                    .custom-post .image-container,
                    .custom-post .custom-post-thumbnail {
                        min-width: 300px !important;
                        max-width: 300px !important;
                    }
                </style>';
}   

$output .= '<div id="customPosts" class="custom-container-posts">
                
    <div class="custom-posts-wrapper">

        <div class="custom-posts-title main-heading-text">
            <h4 class="custom-uppercase"><span>' . $posts_title . '</span></h4>
        </div>  
        <div class="custom-posts">';

        if (strlen($trade_end) <= 10) { // Assuming the date format is 'Y/m/d'
            $trade_end .= ' 17:00'; // Adding '17:00' to the date
        }
        $trade_end_date = DateTime::createFromFormat('Y/m/d H:i', $trade_end);
        $now = new DateTime();

        if ($trade_end_date !== false) {
            // Getting the year from the end date of the fair
            $trade_end_year = $trade_end_date->format('Y');

            // Create a category name with the "news-" prefix and the year
            $category_year = 'news-' . $trade_end_year;

            // Check if `$posts category` is set and not empty
            if (!empty($posts_category) && term_exists($posts_category, 'category')) {
                // We only use categories from `$posts category`
                $categories = $posts_category;
            } else {
                // Create an array for categories
                $categories_array = [];
                // Add a categories to the array, if it's exists
                if (term_exists($category_year, 'category')) {
                    // Check if a category with the "news-" prefix and year exists
                    array_push($categories_array, $category_year);
                }
                if (term_exists("current", 'category')) {
                    // Check if category "current" exists
                    array_push($categories_array, "current");
                }
               

                // Transform the category array into a string
                $categories = implode(',', $categories_array);
            }

            $max_posts = ($posts_all !== 'true') ? min($posts_count, 5) : -1;

            $args = array(
                'posts_per_page' => $max_posts,
                'orderby' => 'date',
                'order' => 'DESC',
                'category_name' => $categories,
            );

            $query = new WP_Query($args);

            $posts_displayed = $query->post_count; 

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
    let customPostsElement = document.querySelector('.custom_element_<?php echo $rnd_id ?> .custom-posts');
    const customSliderElement = document.querySelector('.custom-posts .slides');
    const customPostsRow = document.querySelector('.row-container:has(.custom-posts)');
    customPostsElement.style.opacity = 1;
    customPostsElement.style.transition = 'opacity 0.3s ease';
    if ((customPostsElement && customPostsElement.children.length === 0) || (customSliderElement && customSliderElement.children.length === 0)) {
        customPostsRow.classList.add('desktop-hidden', 'tablet-hidden', 'mobile-hidden');
    }
});

</script>