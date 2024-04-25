<style>
    .header-conference {
        position: absolute;
        top: 18px;
        right: 18px;
        display: flex;
        justify-content: center;
        flex-direction: column;
        gap: 0;
    }
    .header-conference-items {
        padding: 18px;
        gap: 18px;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: end;
    }
    .header-conference-item {
        width: 200px;
    }
    .header-conference-item img {
        width; 100%;
        border-radius: 10px;
    }
    .header-conference-title,
    .header-conference-caption {
        align-self: center;
    }
    .header-conference-caption,
    .header-conference-item {
        transition: .3s ease;
    }
    .header-conference-caption:hover,
    .header-conference-item:hover {
        transform: scale(1.05);
    }
    .header-conference-title h2,
    .header-conference-caption h2 {
        color: white;
        margin: 0;
        font-size: 22px;
    }
    .header-conference-caption h2 {
        border: 2px solid white;
        border-radius: 25px;
        padding: 5px 10px;
        font-size: 16px;
    }
    
    @media (max-width:1200px) {
        .header-conference {
            position: relative;
            top: 0;
            right: 0;
            gap: 0;
            padding-bottom: 36px; 
        }
        .header-conference-items {
            flex-direction: row !important;
        }
    }
    @media (max-width:1200px) {
        .header-conference {
            position: relative;
            top: 0;
            right: 0;
            gap: 0;
            padding-bottom: 36px; 
        }
        .header-conference-items {
            flex-direction: row;
            flex-wrap: wrap;
        }
    }

</style>

<?php
   echo '
    <div class="header-conference">
        <div class="header-conference-title">
            <h2>KONFERENCJE</h2>
        </div>
        <div class="header-conference-items">
            <div class="header-conference-item">
                <a href="#">
                    <img src="https://cleanexpo.pl/wp-content/uploads/2023/12/konf-pl-800-340.jpg" alt="Konferencja PIME">
                </a>
            </div>
            <div class="header-conference-item">
                <a href="#">
                    <img src="https://cleanexpo.pl/wp-content/uploads/2023/12/fesiwal-podronikow-pl-800-340.jpg" alt="Konferencja PESA">
                </a>
            </div>
        </div>
        <div class="header-conference-caption">
            <a href="/wydarzenia/">
                <h2>DOWIEDZ SIĘ WIĘCEJ</h2>
            </a>
        </div>
    </div>';
?>