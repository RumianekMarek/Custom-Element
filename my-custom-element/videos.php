<?php
    if($locale == 'pl_PL') {
        $videos_title = "Zobacz jak było na poprzednich edycjach";
    } else {
        $videos_title = "Check previous editions";
    }  
?>

<style>
    .custom-container-videos {
        display: flex;
        flex-direction: column;
        gap: 36px;
    }
    .custom-videos-title h4 {
        margin: 0;
    }
    .custom-videos {
        display: flex;
        justify-content: center;
        gap: 36px;
    }
    .custom-video-item {
        width: 50%;
    }
    .custom-video-item p {
        font-size: 18px;
    }
    @media (max-width:959px) {
        .custom-videos {
            flex-direction: column;
        }
        .custom-video-item {
            width: 100%;
        }
    }
</style>

<div id='customVideos' class='custom-container-videos'>
    <div class="custom-videos-title main-heading-text">
        <h4 class="custom-uppercase"><span><?php echo $videos_title ?></span></h4>
    </div>  
    <div class="custom-videos">
    <?php
        $videos_urldecode = urldecode($videos);
        $videos_json = json_decode($videos_urldecode, true);

        if (is_array($videos_json)) {
            foreach ($videos_json as $video) {
                $video_title = $video["video_title"];
                $video_iframe = $video["video_iframe"];

                echo'<div class="custom-video-item">';
                    echo $video_iframe;
                    echo '<p>'. $video_title .'</p>';
                echo'</div>';
            }
        }
    ?>
    </div>
</div>

<script>
    const iframes = document.querySelectorAll('.custom-video-item iframe');
    if (iframes) {
        iframes.forEach((iframe) => iframe.classList.add('iframe-shadow'));
    }
</script>