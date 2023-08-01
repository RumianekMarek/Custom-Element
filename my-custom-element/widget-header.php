<?php
    if($locale == "pl_PL"){
        echo '
            <div class="custom-widget-info-header">
                <div>
                    <div style="display:flex; align-items:center; margin:8px 0 0 0; opacity: 100%;" class="v-align"><img class="alignnone size-full wp-image-2632" src="https://warsawbuild.eu/wp-content/uploads/2023/02/car-white.png" alt="car white" width="30" height="30" /><p style="margin:0 0 0 10px;"><span style="font-weight: bold; font-size:18px; color:white;">DARMOWY PARKING</span></p></div>
                    <div style="display:flex; align-items:center; margin:8px 0 0 0; opacity: 100%;" class="v-align"><img class="alignnone size-full wp-image-2626" src="https://warsawbuild.eu/wp-content/uploads/2023/02/timer-white.png" alt="clock" width="30" height="30" /><p style="margin:0 0 0 10px; font-size:18px;"><span style="font-weight: bold;">GODZINY OTWARCIA:</span></p></div>
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
                <div style="display:flex; align-items:center; margin:10px 0 0 0; opacity: 100%;" class="v-align"><img class="alignnone size-full wp-image-2632" src="https://warsawbuild.eu/wp-content/uploads/2023/02/car-white.png" alt="car white" width="30" height="30" /><p style="margin:0 0 0 10px;"><span style="font-weight: bold; font-size:18px; color:white;">FREE PARKING</span></p></div>
                <div style="display:flex; align-items:center; margin:8px 0 0 0; opacity: 100%;" class="v-align"><img class="alignnone size-full wp-image-2626" src="https://warsawbuild.eu/wp-content/uploads/2023/02/timer-white.png" alt="clock" width="30" height="30" /><p style="margin:0 0 0 10px; font-size:18px;"><span style="font-weight: bold;">OPENING HOURS:</span></p></div>
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