<style>
    .custom-estymacje p{
        line-height: 1;
        margin-top:0;
    }
    .custom-estymacje :is(.estymacje-title, .estymacje-desc, .estymacje-data){
        text-transform:uppercase;
    }
    .custom-estymacje :is(.estymacje-title, .estymacje-metr, .estymacje-data, .estymacje-main-title){
        font-weight:750;
    }
    @media (min-width: 1200px){
        .custom-estymacje{
            height: 670px;
            background-image:url(/doc/mapka.png); 
            background-position: center; 
            background-size: contain; 
            background-repeat: no-repeat; 
            padding:36px; 
            display:flex; 
            justify-content: space-between;
        }
        .estymacje-main-title{
            text-transform: uppercase;
            font-size:40px;
            max-width: 550px;
        }
        .custom-estymacje-left{
            align-self: top;
        }
        .custom-estymacje-left div{
            margin-top:50px;
        }
        .custom-estymacje-right{
            display: flex; 
            flex-direction: column; 
            align-items: flex-end; 
            justify-content: space-between;
        }
        .custom-estymacje-right{
            max-width:250px;
        }
        .custom-estymacje-right-bottom{
            margin:auto;
        }
        .estymacje-title{
            font-size:32px;
            color: #48b8e0;
        }
        .estymacje-desc{
            font-size:28px;
        }
        .estymacje-data{
            font-size:20px;
        }
        .estymacje-metr{
            font-size:24px;
        }
    }
    @media (min-width: 600px) and (max-width: 1199px){
        .custom-estymacje{
            height:50vw;
            background-image:url(/doc/mapka.png); 
            background-position: center; 
            background-size: contain; 
            background-repeat: no-repeat; 
            padding:36px; 
            display:flex; 
            justify-content: space-between;
        }
        .custom-estymacje-left{
            align-self: top;
        }
        .custom-estymacje-left p{
            max-width: 43vw;
        }
        .custom-estymacje-left div{
            margin-top:20px;
        }
        .custom-estymacje-right{
            display: flex; 
            flex-direction: column; 
            align-items: flex-end; 
            justify-content: space-between;
        }
        .custom-estymacje-right-bottom{
            margin:auto 0 auto auto;
        }
        .custom-estymacje-right img{
            max-width:22vw;
        }
        .estymacje-main-title{
            text-transform: uppercase;
            font-size: 3vw;
            margin-bottom:50px;
        }
        .estymacje-title{
            font-size: 2.5vw;
        } 
        .estymacje-desc, .estymacje-data, .estymacje-metr{
            font-size: 1.9vw;
        }
    }
    @media (max-width: 599px){
        .mobile-estymacje-image{
            height:230px;
            background-image:url(/doc/mapka.png); 
            background-position: center; 
            background-size: cover; 
            background-repeat: no-repeat;
        }
        .custom-estymacje{
            display:flex; 
            justify-content: space-between;
            gap:5px;
        }
        .custom-estymacje-right{
            width:37.5vw;
        }
        .custom-estymacje img{
            display:none;
        }
        .custom-estymacje p{
            line-height: 1.4 !important;
            text-align: center;
        }
        .estymacje-main-title, .estymacje-data{
            font-size: 20px;
            margin-bottom:20px;
        }
        .estymacje-title, .estymacje-desc, .estymacje-metr{
            font-size: 16px;
        }
        .estymacje-data{
            text-transform:capitalize !important;
        }
    }
</style>
<div id="custom-estymacje" class="custom-estymacje" style="color:black;">
    <div class="custom-estymacje-left">
        <p class="text-accent-color estymacje-main-title"><?php echo $title_estymacje ?></p>
        <div>
            <p class="text-accent-color estymacje-title">Polska - <?php echo $polish_estymacje ?>%</p>
            <p class="estymacje-desc"><?php echo floor($visitors_estymacje / 100 * $polish_estymacje) ?></p>
        </div>
        <div>
            <p class="text-accent-color estymacje-title">Zagranica - <?php echo (100 - $polish_estymacje) ?>%</p>
            <p class="estymacje-desc"><?php echo ($visitors_estymacje - floor($visitors_estymacje / 100 * $polish_estymacje)) ?></p>
        </div>
        <div>
            <p class="text-accent-color estymacje-title">Suma<span style="color: black; font-weight:500"> - <?php echo $visitors_estymacje ?></span></p>
            <p class="estymacje-desc">Branżowych</p>
            <p class="estymacje-desc">Odwiedzających</p>
        </div>
    </div>
    <div class="custom-estymacje-right">
        <div class="custom-estymacje-img-box">
            <img src="/doc/logo-color.png"/>
            <p class="estymacje-data" style="text-align: center;"><?php echo $date_estymacje ?></p>
        </div>
        <div class="custom-estymacje-right-bottom">
            <p class="estymacje-metr"><?php echo $space_estymacje ?> m<sup>2</sup></p>
            <p class="estymacje-desc">powierzchni<br>wystawienniczej</p>
            <br>
            <?php if($exhibitors_estymacje != ''){ 
                $estymacje_array = explode(' ', $exhibitors_estymacje, 2);
                echo '<p class="text-accent-color estymacje-title">'.$estymacje_array[0].'</p>
                <p class="estymacje-desc">'.$estymacje_array[1].'</p>';
            }?>
        </div>
    </div>
</div>
<div class="mobile-estymacje-image"></div>
