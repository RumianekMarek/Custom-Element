<?php
    if($locale == 'pl_PL') {
        if ($posts_title == "") {
            $posts_title = "Aktualności";
        }
        if ($posts_link == "") {
            $posts_link = "aktualnosci";
        }
    } else {
        if ($posts_title == "") {
            $posts_title = "News";
        }
        if ($posts_link == "") {
            $posts_link = "news";
        }
    }
    if ($posts_count == "") {
        $posts_count = 1;
    }
    if ($posts_ratio == "") {
        $posts_ratio = "1/1";
    }

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
</style>

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
