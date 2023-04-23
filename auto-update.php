<?php

add_action('init', 'auto-update');

function auto-update() {
    require_once plugin_dir_path(__FILE__) . 'plugin-update-checker/plugin-update-checker.php';
    $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
        'https://github.com/RumianekMarek/Custom-Element/',
        __FILE__,
        'my-custom-plugin'
    );
    $myUpdateChecker->setBranch('main');
    $myUpdateChecker->checkPeriodically(60 * 60 * 24, '03:00');
}
