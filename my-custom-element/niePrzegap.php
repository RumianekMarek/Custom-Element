<?php 
    if (!preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT'])) {
?>
<style>
#niePrzegap {
    z-index: 100;
}
.custom-container-niePrzegap{
    display:flex;
}
.custom-container-niePrzegap{
    position: fixed;
    left: -250px;
    top: 30%;
    z-index: 11;
    transition: left 0.3s ease;
}
.custom-container-niePrzegap:hover,
.niePrzegap-hover,
.custom-container-niePrzegap.hovered-cal {
    left: 0 !important;
}
.row-container:has(.custom-container-niePrzegap) .row-parent,
.row-container:has(.custom-container-niePrzegap) .wpb_column  {
    padding: 0 !important;
}
.custom-inner-niePrzegap{
    width: 250px !important;
    height: 250px;
    background-color:#fff;
    border: 4px solid #000;
    padding: 10px 0;
}
.custom-pointer-niePrzegap {
    margin: 0 -30px;
}
.custom-pointer-niePrzegap i{
    text-shadow: 5px 0 #fff;
}
.custom-header-niePrzegap h4{
    margin:10px;
}
.custom-container-calendar-niePrzegap{
    display:flex;
    margin:20px 5px;
    gap: 5px;
    justify-content: space-evenly;
}
.custom-container-calendar-niePrzegap .custom-container-calendar-add {
    width: 100px;
}
.custom-container-calendar-niePrzegap img{
    height:50px !important;
    object-fit: contain;
}
.custom-container-calendar-niePrzegap p{
    font-size: 15px !important;
    margin-top: 5px;
    line-height: 1.2;
    text-wrap: wrap;
    width: 80%;
}
.custom-pointer-wrapper-niePrzegap {
    display: flex;
}
.custom-pointer-wrapper-niePrzegap i {
    color:black;
    position: absolute;
    left: 251px;
}
.custom-vertival-text-niePrzegap {
    display: flex;
    height: 250px;
    position: absolute;
    left: 247px;
    background-color: black;
    border-radius: 0 8px 8px 0;
}
.custom-vertival-text-niePrzegap p {
    color: white;
    padding: 11px 2px;
    margin: 0;
    text-align: center;
    font-weight: 600;
    writing-mode: vertical-rl;
    text-orientation: upright;
    letter-spacing: 0px;
    background-color: black;
    border-radius: 0 8px 8px 0;
}
.link-more{
    margin:10px;
    text-decoration: underline;
}
</style>
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
<?php   
        if (current_user_can('administrator')) {
            $admin_username = 'Anton';
            $current_user = wp_get_current_user();
            if ($current_user->user_login == $admin_username) { echo '<style>#niePrzegap { display: none !important; }</style>'; }
        } 
    } else {
        ?>
        <div id='niePrzegap'></div>
        <?php
    }
?>