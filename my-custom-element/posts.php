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
        max-width: 340px;
        margin: 0 auto;
    }
    .custom-post-thumbnail img {
        width: 100%;
        aspect-ratio: <?php echo $posts_ratio ?>;
        object-fit: cover;
    }

    /* .custom-posts .slides {
        align-items: flex-start !important;
        gap: 18px;
    }
    .slides .custom-post-thumbnail div {
        width: 100%;
        max-width: 300px;
        aspect-ratio: 1/1;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    } */
    @media (max-width: 600px) {
        .custom-posts {
            flex-wrap: wrap;
        }
        .custom-post {
            max-width: 200px;
        }
        .custom-post-title {
            font-size: 14px !important;
        }
    }
    @media (max-width: 400px) {
        .custom-post {
            max-width: 150px;
        }
    }
</style>

<?php
// $output = '';
// $output .= '<div id="customPosts" class="custom-container-posts">
//                 <div class="custom-posts-title main-heading-text">
//                     <h4 class="custom-uppercase"><span>' . $posts_title . '</span></h4>
//                 </div>  
//                 <div class="custom-posts">';
        
                    // query_posts(array(
                    //     'posts_per_page' => $posts_count,
                    //     'orderby' => 'date',
                    //     'order' => 'DESC',
                    //     'category_name' => $posts_cat,
                    // ));
                    
                    // $post_image_urls = array();
                    // while (have_posts()) : the_post();
                    //     $link = get_permalink();
                    //     $image = has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'full') : '';
                    //     $title = get_the_title();

                    //     $post_image_urls[] = array(
                    //         "img" => $image,
                    //         "link" => $link,
                    //         "title" => $title
                    //     );

                    // endwhile;
                    // wp_reset_query();

                    // include_once plugin_dir_path(__FILE__) . '/../scripts/posts-slider.php';
                    // $output .= custom_posts_slider($post_image_urls);
        
// $output .= '</div>
//     <div class="custom-btn-container" style="padding-top: 18px;">
//         <span>
//             <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="'. $posts_link .'"  target="_blank">'. $posts_text .'</a>
//         </span>
//     </div>
// </div>';

// echo $output;

?>

<div id='customPosts' class='custom-container-posts'>
    <div class="custom-posts-title main-heading-text">
        <h4 class="custom-uppercase"><span><?php echo $posts_title ?></span></h4>
    </div>  
    <div class="custom-posts">
        <?php
            // Pobranie najnowszego wpisu
            query_posts(array(
                'posts_per_page' => $posts_count,
                'orderby' => 'date',
                'order' => 'DESC',
                'category_name' => $posts_cat,
            ));
            // Wyświetlenie wpisów
            while (have_posts()) : the_post();
            ?>
                <a href="<?php the_permalink(); ?>">
                    <div class="custom-post">
                        <div class="custom-post-thumbnail image-shadow">
                            <div class="t-entry-visual">
                                <?php
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail('full');
                                    }
                                ?>
                            </div>
                        </div>
                        <h5 class="custom-post-title"><?php the_title(); ?></h5>
                    </div>
                </a>    
            <?php
            endwhile;
            wp_reset_query();
        ?>
    </div>
    <div class="custom-btn-container">
        <span>
            <?php if($locale == 'pl_PL'){ echo '
                <a style="padding-top: 36px;" class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="/'. $posts_link .'/"  target="_blank">Zobacz wszystkie</a>
            ';} else { echo '
                <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="/en/'. $posts_link .'/"  target="_blank">See all</a>
            ';} ?>
        </span>
    </div>

</div>