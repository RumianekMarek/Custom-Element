<?php 
    if ($color != '#ffffff'){
        $color = '#000000';
    }
?>
<style>
    .custom_element_<?php echo $rnd_id ?> #onlyCalendar h3{
    color: <?php echo $color ?>
    }
    .custom-container-calendar-icons{
        display: flex;
        justify-content: center;
        gap:30px;
        margin-top: 20px;
    }
    .custom-container-calendar-icons{
        max-width: 1200px;
    }
    .custom-inner-calendarAdd img {
        object-fit: contain;
        max-width: 300px !important;
    }
    .custom-container-calendar-icons{ 
        top:-30px;
        position: relative; 
    }
    .custom-container-calendar-add{
        flex:1;
        min-width: 100px;
        max-width: 180px;
        background: white;
        padding:5px 0;
    }
    .custom-container-calendar-add p{
        color:black;
        margin:5px;
        line-height: 1.2;
    }
    .custom-container-calendar-add img{
        max-height: 150px;
        width: auto;
        max-width:100%;
    }
    @media (max-width:959px){
        .custom-container-calendar-icons{
            padding: 10px;
        }
    }
    @media (max-width:570px){
        .custom-container-calendar-icons{
            flex-wrap: wrap;
        }
        .custom-container-calendar-add{
            min-width: 35%;
            max-width: 130px;
        }
        .custom-container-calendar-add img{
            max-height: 100px;
        }  
    }
</style>
<div id='onlyCalendar' class='custom-container-onlyCalendar custom-display-none text-centered'>
    <div class='half-block-padding'>
    <?php if ($locale == 'pl_PL') {
        echo '<h3>Nie przegap targów, dodaj datę do kalendarza</h3>';
    } else {
        echo "<h3>Don't miss the fair, add the date to your calendar</h3>";
    } ?>
    </div>
    <div class='custom-container-calendar-icons single-top-padding'>
        <?php include plugin_dir_path(__FILE__) . 'calendarGoogle.php'; ?> 
        <?php include plugin_dir_path(__FILE__) . 'calendarApple.php'; ?>
        <?php include plugin_dir_path(__FILE__) . 'calendarOutlook.php'; ?>
        <?php include plugin_dir_path(__FILE__) . 'calendarOffice365.php'; ?>
        <!-- <?php include plugin_dir_path(__FILE__) . 'calendarYahoo.php'; ?> -->
    </div>
</div>