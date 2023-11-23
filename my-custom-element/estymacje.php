
    <div id="custom-estymacje" class="custom-estymacje" style="color:black;">
        <div class="custom-estymacje-left">
            <p class="estymacje-main-title">Estymacje 1. edycji</p>
            <div>
                <p class="estymacje-title">Polska - 90%</p>
                <p class="estymacje-desc">7 200</p>
            </div>
            <div>
                <p class="estymacje-title">Zagranica - 10%</p>
                <p class="estymacje-desc">800</p>
            </div>
            <div>
                <p class="estymacje-title">Suma<span style="color: black; font-weight:500"> - 8000</span></p>
                <p class="estymacje-desc">Branżowych</p>
                <p class="estymacje-desc">Odwiedzających</p>
            </div>
        </div>
        <div class="custom-estymacje-right">
            <div class="custom-estymacje-img-box">
                <img src="/doc/logo-color.png"/>
                <p class="estymacje-data" style="text-align: center;">20-23 Maja 2023</p>
            </div>
            <div style="margin-bottom: 20%;">
                <p class="estymacje-metr">20 000 m<sup>2</sup></p>
                <p class="estymacje-desc">powierzchni<br>wystawienniczej</p>
                <br>
                <p class="estymacje-title">90</sup></p>
                <p class="estymacje-desc">wystawców</p>
            </div>
        </div>
    </div>
    <div class="mobile-estymacje-image"></div>
<style>
    .custom-estymacje p{
        line-height: 1;
        margin-top:0;
    }
    .custom-estymacje :is(.estymacje-title, .estymacje-desc, .estymacje-data){
        text-transform:uppercase;
    }
    .custom-estymacje :is(.estymacje-title, .estymacje-metr, .estymacje-data, .estymacje-main-title){
        font-weight:800;
    }
    .custom-estymacje .estymacje-title{
        color: #48b8e0;
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
            font-size:36px;
        }
        .custom-estymacje-left{
            align-self: center;
        }
        .custom-estymacje-left div{
            margin-top:50px;
        }
        .custom-estymacje-right{
            display: flex; 
            flex-direction: column; 
            align-items: flex-end; 
            justify-content: space-around;
        }
        .custom-estymacje-right{
            max-width:250px;
        }
        .estymacje-title{
            font-size:32px;
            color: #48b8e0;
        }
        .estymacje-desc{
            font-size:28px;
        }
        .estymacje-data{
            font-size:24px;
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
            align-self: center;
        }
        .custom-estymacje-left div{
            margin-top:20px;
        }
        .custom-estymacje-right{
            display: flex; 
            flex-direction: column; 
            align-items: flex-end; 
            justify-content: space-around;
        }
        .custom-estymacje-right img{
            max-width:22vw;
        }
        .estymacje-main-title{
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