<style>
    .custom-widget-info-header {
        position: absolute;
        left: 36px;
        top: 500px;
        z-index: 12;
        color: white;
        padding: 8px;
        background-color: rgba(0, 0, 0, 0.6);
        border: 5px solid rgba(255, 255, 255, 0.63);
    }
    .custom-header-left-time {
        z-index: 1;
        display: flex;
        justify-content: center;
    }
    @media (max-width:1250px) {
        .custom-widget-info-header {
            position: static;
            margin: 25px 0;
        }
    }
</style>

<?php
    if($locale == "pl_PL"){
        echo '
            <div class="custom-widget-info-header">
                <div>
                    <div style="display:flex; align-items:center; margin:8px 0 0 0; opacity: 100%;" class="v-align">
                        <img class="alignnone size-full wp-image-2632" src="/wp-content/plugins/custom-element/media/car-white.png" alt="car white" width="30" height="30" />
                        <p style="margin:0 0 0 10px;"><span style="font-weight: bold; font-size:18px; color:white;">DARMOWY PARKING</span></p>
                    </div>
                    <div style="display:flex; align-items:center; margin:8px 0 0 0; opacity: 100%;" class="v-align">
                        <img class="alignnone size-full wp-image-2626" src="/wp-content/plugins/custom-element/media/timer-white.png" alt="clock" width="30" height="30" />
                        <p style="margin:0 0 0 10px; font-size:18px;"><span style="font-weight: bold;">GODZINY OTWARCIA:</span></p>
                    </div>
                </div>
                <div style="margin-left: 40px";>
                    <div>
                        <p style="margin: 0px 0; line-height: 1.2;font-size:16px; text-align:right;"><span style="font-weight: bold;">[trade_fair_date]</span></p>
                        <p style="margin: 0px 0; line-height: 1.2;font-size:16px; text-align:right;"><span style="font-weight: bold;">10:00 - 17:00</span></p>
                    </div>
                </div>
            </div>';
    } else {
        echo '<div class="custom-widget-info-header">
                <div>
                    <div style="display:flex; align-items:center; margin:10px 0 0 0; opacity: 100%;" class="v-align">
                        <img class="alignnone size-full wp-image-2632" src="/wp-content/plugins/custom-element/media/car-white.png" alt="car white" width="30" height="30" />
                        <p style="margin:0 0 0 10px;"><span style="font-weight: bold; font-size:18px; color:white;">FREE PARKING</span></p>
                    </div>
                    <div style="display:flex; align-items:center; margin:8px 0 0 0; opacity: 100%;" class="v-align">
                        <img class="alignnone size-full wp-image-2626" src="/wp-content/plugins/custom-element/media/timer-white.png" alt="clock" width="30" height="30" />
                        <p style="margin:0 0 0 10px; font-size:18px;"><span style="font-weight: bold;">OPENING HOURS:</span></p>
                    </div>
                </div>
                <div style="margin-left: 40px";>
                    <div>
                        <p style="margin: 0px 0; line-height: 1.2;font-size:16px; text-align:right;"><span style="font-weight: bold;">[trade_fair_date_eng]</span></p>
                        <p style="margin: 0px 0; line-height: 1.2;font-size:16px; text-align:right;"><span style="font-weight: bold;">10:00 - 17:00</span></p>
                    </div>
                </div>
            </div>';
    }
?>