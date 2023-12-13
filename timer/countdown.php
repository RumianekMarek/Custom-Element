<?php

// Add the new WPBakery My Custom Element
function countdown() {
    // Define the element name and path to the element file
    vc_map(array(
        'name' => __('Countdown', 'my-custom-plugin'),
        'base' => 'countdown',
        'category' => __('My Elements', 'my-custom-plugin'),
        'params' => array(
            array(
                'type' => 'param_group',
                'group' => 'Main Settings',
                'param_name' => 'countdowns',
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
                ),
            ),
        ),
    ));
}

// Define the output function for the element
function countdown_output($atts, $content = null) {
    // Get the current language of the website
    $locale = get_locale();

    $trade_date = do_shortcode('[trade_fair_date]');
    $trade_start = do_shortcode('[trade_fair_datetotimer]');
    $trade_end = do_shortcode('[trade_fair_enddata]');
    $trade_name = do_shortcode('[trade_fair_name]');
    $trade_desc = do_shortcode('[trade_fair_desc]');
    $trade_name_en = do_shortcode('[trade_fair_name_eng]');

    if (isset($atts['countdowns'])) { $countdowns = $atts['countdowns']; }

    if ($color != '#000000'){
        $color = '#ffffff';
    }
    if ($btn_color != ''){
        $btn_color = '#main-timer ' . $btn_color;
    }
    ?>

    <style>
    #main-timer p{
        color: <?php echo $color ?>;
    }
    <?php echo $btn_color ?>
    .row-container:has(.custom-container-main-timer) .row-parent {
        padding: 0 !important;
    }
    .custom-main-timer-before,
    .custom-main-timer-after {
        display: flex;
        justify-content: space-evenly;
        flex-wrap: wrap;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        gap: 8px
    }
    .main-timer-countdown {
        text-align: center;
        font-weight: 700;
        width: max-content;
    }
    #customBtn {
        transform-origin: center !important;
    }
    .custom-main-timer-before p,
    .custom-main-timer-after p {
        margin: 0 !important;
        font-size: 20px;
    }
    .custom-main-timer-btn {
        padding: 8px 0;
    }
    @media (max-width:570px){
        .custom-main-timer-before p,
        .custom-main-timer-after p {
            font-size: 16px;
        }
    }
    </style>

    <?php
    $element_unique_id = 'countdown-' . uniqid();

    $countdowns_urldecode = urldecode($countdowns);
    $countdowns_json = json_decode($countdowns_urldecode, true);

    $countdowns = array();

    if (is_array($countdowns_json)) {
        foreach ($countdowns_json as $countdown) {
            $countdowns[] = array(
                'countdown_start' => $countdown["countdown_start"],
                'countdown_end' => $countdown["countdown_end"]
            );
        }
    }
    $countdowns_array = json_encode($countdowns);
    ?>

    <p id="<?php echo $element_unique_id; ?>" class='main-timer-countdown text-uppercase'></p>

    <?php
    if (isset($element_unique_id)) {
    ?>

    <script>
    {
        if (["nowa data", "wiosna", "lato", "jesień", "zima"].some(season => ("<?php echo $trade_date ?>").toLowerCase().includes(season.toLowerCase()))) {
            document.querySelector('#main-timer').style.display = 'none';
        }

        function startEndCountdown(targetDate) {
            const countdownsArray = <?php echo $countdowns_array ?>;

            const endDate = new Date("<?php echo $trade_end ?>");
            const startDate = new Date("<?php echo $trade_start ?>");

            const element = document.querySelector('#<?php echo $element_unique_id; ?>');
            let foundMatchingCountdown = false;
            const now = new Date().getTime();

            if (countdownsArray && countdownsArray.length > 0) {
                countdownsArray.forEach(countdown => {
                    const countdown_start = new Date(countdown.countdown_start).getTime();
                    const countdown_end = new Date(countdown.countdown_end).getTime();

                    if (now > countdown_start && now < countdown_end) {
                        targetDate = countdown.countdown_end;
                        foundMatchingCountdown = true;
                    } else {
                        element.style.display = 'none';
                        foundMatchingCountdown = false;
                    }

                    if (!foundMatchingCountdown) {
                        if (document.querySelector('#main-timer')) {
                            document.querySelector('#main-timer').style.display = 'none';
                        } else {
                            element.style.display = 'none';
                        }
                    }
                });
            }
            
            const distance = new Date(targetDate) - now;
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            var countdownText = '';

            if ("<?php echo $locale ?>" === 'pl_PL') {
                function pluralizePolish(count, singular, plural, pluralGenitive) {
                    if (count === 1) {
                        return `${count} ${singular} `;
                    } else if (count % 10 >= 2 && count % 10 <= 4 && (count % 100 < 10 || count % 100 >= 20)) {
                        return `${count} ${plural} `;
                    } else {
                        return `${count} ${pluralGenitive} `;
                    }
                }
                if ("<?php echo $locale ?>" === 'pl_PL') {
                    countdownText += pluralizePolish(days, 'dzień', 'dni', 'dni');
                    countdownText += pluralizePolish(hours, 'godzina', 'godziny', 'godzin');
                    countdownText += pluralizePolish(minutes, 'minuta', 'minuty', 'minut');
                    countdownText += pluralizePolish(seconds, 'sekunda', 'sekundy', 'sekund').trim();
                }
            } else if ("<?php echo $locale ?>" === 'en_US') {
                function pluralize(count, noun) {
                    return `${count} ${noun}${count !== 1 ? 's' : ''} `;
                }
                countdownText += pluralize(days, 'day');
                countdownText += pluralize(hours, 'hour');
                countdownText += pluralize(minutes, 'minute');
                countdownText += pluralize(seconds, 'second').trim();
            }

            element.innerHTML = countdownText;

            if (distance > 0) {
                setTimeout(function () {
                    startEndCountdown(targetDate);
                }, 1000);
            }
        }
        {
            const now = new Date().getTime();
            const endDate = new Date("<?php echo $trade_end ?>");
            const startDate = new Date("<?php echo $trade_start ?>");

            if (endDate - now < 0 && startDate - now < 0) {
                document.querySelector('#main-timer').style.display = 'none';
            } else {
                if (startDate - now < 0) {
                    startEndCountdown("<?php echo $trade_end ?>");
                } else {
                    startEndCountdown("<?php echo $trade_start ?>");
                }
            }
        }
    }
    </script>

    <?php
    }

}

add_action('vc_before_init', 'countdown');
add_shortcode('countdown', 'countdown_output');
?>