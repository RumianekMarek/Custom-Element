<div id='niePrzegap' class='custom-container-niePrzegap custom-display-none'>
    <div class='custom-inner-niePrzegap'>
        <div class='custom-header-niePrzegap text-centered'>
            <h4>
                <?php if($locale == 'pl_PL'){ echo '
                Dodaj wydarzenie<br> do kalendarza
                ';} else { echo '
                Add the event<br> to your calendar
                ';} ?>
            </h4>
        </div>
        <div class='custom-container-calendar-niePrzegap text-centered'>
            <?php include plugin_dir_path(__FILE__) . 'calendarGoogle.php'; ?> 
            <?php include plugin_dir_path(__FILE__) . 'calendarApple.php'; ?>
        </div>
        <div class="text-centered">
            <?php if($locale == 'pl_PL'){ echo '
            <a class="link-more" href="/dodaj-do-kalendarza/">Więcej Kalendarzy</a>
            ';} else { echo '
            <a class="link-more" href="/en/add-to-calendar/">More Calendars</a>
            ';} ?>
        </div>
    </div>
    <div class="custom-pointer-wrapper-niePrzegap">
        <div class="custom-vertival-text-niePrzegap">
            <p class="custom-uppercase">
                <?php if($locale == 'pl_PL'){ echo '
                Nie przegap
                ';} else { echo '
                Do not miss
                ';} ?>
            </p>
        </div>
        <div class='custom-pointer-niePrzegap'>
            <i class="fa fa-caret-right fa-4x fa-fw"></i>
        </div>
    </div>
</div>

