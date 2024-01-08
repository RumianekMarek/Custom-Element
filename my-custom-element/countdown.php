<?php
    if ($color != '#000000'){
        $color = '#ffffff !important';
    }
    if ($btn_color != ''){
        $btn_color = '#main-timer ' . $btn_color;
    }
?>

    <style>
        #main-timer p {
            color: <?php echo $color ?>;
        }
        <?php echo $btn_color ?>
        .is_stucked:has(.custom-container-main-timer) .row-parent {
            margin-top: 25px !important;
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
        .custom-container-main-timer .countdown-text {
            display: none !important;
        }
        .countdown-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            align-items: baseline;
        }
        .countdown-container p {
                margin: 0 auto;
                padding: 8px;
                font-size: <?php echo $countdown_font_size[0] ?>;
        }
        <?php if (isset($countdown_column[0]) && $countdown_column[0] == true) { ?>
            .countdown-container {
                flex-direction: column;
            }
        <?php } ?>
    </style>


<?php
$countdown_container_id = 'countdown-container-' . uniqid();
$countdown_id = 'countdown-' . uniqid();

date_default_timezone_set('Europe/Warsaw');
$current_date = date("Y-m-d H:i:s");

$countdowns_urldecode = urldecode($countdowns);
$countdowns_json = json_decode($countdowns_urldecode, true);

$countdowns = array();

if (is_array($countdowns_json)) {
    foreach ($countdowns_json as $countdown) {
        $countdowns[] = array(
            $turn_off_countdown_text[] = $countdown["turn_off_countdown_text"],
            $countdown_text[] = $countdown["countdown_text"],
            $countdown_column[] = $countdown["countdown_column"],
            $countdown_font_size[] = $countdown["countdown_font_size"],
            $countdown_color[] = $countdown["countdown_color"],
            $countdown_start[] = $countdown["countdown_start"],
            $countdown_end[] = $countdown["countdown_end"]
        );
    }
}
$countdowns_array = json_encode($countdowns);
?>

<style>
    .countdown-container:has(#<?php echo $countdown_id ?>) p {
        font-size: <?php echo $countdown_font_size[0] ?> !important;
        color: <?php echo $countdown_color[0] ?> !important;
    }
</style>

<?php
if ((empty($countdown_start[0]) && empty($countdown_end[0])) || (strtotime($countdown_start[0]) - strtotime($current_date)) <= 0 && (strtotime($countdown_end[0]) - strtotime($current_date)) >= 0) {
?>

    <div id="<?php echo $countdown_container_id; ?>" class="countdown-container">
        <?php
            if (empty($turn_off_countdown_text[0]) && $turn_off_countdown_text[0] !== true && empty($countdown_start[0]) && empty($countdown_end[0])) {
                echo '<p class="countdown-text text-uppercase">';
                if ((strtotime($trade_start) - strtotime($current_date)) >= 0 || (strtotime($trade_end) - strtotime($current_date)) <= 0){
                    if ($locale == 'pl_PL') {
                        echo (!empty($countdown_text[0])) ? $countdown_text[0] : 'Do targów pozostało:';
                    } else {
                        echo (!empty($countdown_text[0])) ? $countdown_text[0] : 'Until the start of the fair:';
                    }
                } else {
                    if ($locale == 'pl_PL') {
                        echo (!empty($countdown_text[0])) ? $countdown_text[0] : 'Do końca targów pozostało:';
                    } else {
                        echo (!empty($countdown_text[0])) ? $countdown_text[0] : 'Until the end of the fair:';
                    }
                }
                echo '</p>';
            }
        ?>
        <p id="<?php echo $countdown_id; ?>" class='main-timer-countdown text-uppercase'></p>
    </div>

    <script>
    {
        if (["nowa data", "wiosna", "lato", "jesień", "zima"].some(season => ("<?php echo $trade_date ?>").toLowerCase().includes(season.toLowerCase()))) {
            document.querySelector('#main-timer').style.display = 'none';
        }
        function startEndCountdown(targetDate) {
            const countdownsArray = <?php echo $countdowns_array ?>;
            const now = new Date().getTime();
            const endDate = new Date("<?php echo $trade_end ?>");
            const startDate = new Date("<?php echo $trade_start ?>");
            const containerElement = document.querySelector('#<?php echo $countdown_container_id; ?>');
            const element = document.querySelector('#<?php echo $countdown_id; ?>');
            let foundMatchingCountdown = false;

            if (countdownsArray && countdownsArray.length > 0) {
                countdownsArray.forEach(countdown => {
                    var countdownStart = new Date(<?php echo json_encode($countdown_start[0]); ?>).getTime();
                    var countdownEnd = new Date(<?php echo json_encode($countdown_end[0]); ?>).getTime();
                    if (now > countdownStart && now < countdownEnd) {
                        targetDate = countdownEnd;
                        foundMatchingCountdown = true;
                    } else if (!countdownStart && !countdownEnd && now < startDate && now < endDate) {
                        targetDate = startDate;
                        foundMatchingCountdown = true;
                    } else if (!countdownStart && !countdownEnd && now > startDate && now < endDate) {
                        targetDate = endDate;
                        foundMatchingCountdown = true;
                    } else {
                        foundMatchingCountdown = false;
                    }

                    if (!foundMatchingCountdown) {
                        containerElement.style.display = 'none';
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

        function closeMainTimer() {
            const now = new Date().getTime();
            const endDate = new Date("<?php echo $trade_end ?>");
            const startDate = new Date("<?php echo $trade_start ?>");

            if (endDate - now < 0 && startDate - now < 0) {
                document.querySelector('#main-timer').style.display = 'none';
                document.querySelector('#<?php echo $countdown_container_id; ?>').style.display = 'none';
            } else {
                if (startDate - now < 0) {
                    startEndCountdown("<?php echo $trade_end ?>");
                } else {
                    startEndCountdown("<?php echo $trade_start ?>");
                }
            }
        } closeMainTimer();
    }
    </script>

<?php
}
?>