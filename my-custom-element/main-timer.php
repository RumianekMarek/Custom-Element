<div id='main-timer' class='custom-container-main-timer style-accent-bg' style='color:white !important;'>
    <div class='custom-main-timer-before'>
        <p class='text-uppercase'>
            <?php if(strtotime($trade_start)-strtotime('+2 hour', time()) >= 0 || strtotime($trade_end)-strtotime('+2 hour', time()) <= 0 ){
                if($locale == 'pl_PL'){
                    echo 'Do targów pozostało:';
                } else {
                    echo 'Until the start of the fair:';
                }
            } else {
                if($locale == 'pl_PL'){
                    echo 'Do końca targów pozostało:';
                } else {
                    echo 'Until the end of the fair:';
                }
            } ?>
        </p>
        <p id='start-countdown' class='main-timer-countdown text-uppercase'></p>
        <span class='custom-main-timer-btn'>
            <?php 
            if(strtotime($trade_start)-strtotime('+2 hour', time()) >= 604800){
                if($locale == 'pl_PL'){
                    echo "<a id='customBtn' class='custom-link btn border-width-0 btn-flat btn-custom-black' href='/zostan-wystawca/'>Zostań wystawcą</a>";
                } else {
                    echo "<a id='customBtn' class='custom-link btn border-width-0 btn-flat btn-custom-black' href='/en/become-an-exhibitor'>Book a stand</a></span>";
                }
            } else {
                if($locale == 'pl_PL'){
                    echo "<a id='customBtn' class='custom-link btn border-width-0 btn-flat btn-custom-black' href='/rejestracja/'>Zarejestruj się<span style='display: block; font-weight: 300;'>Odbierz darmowy bilet</span></a>";
                } else {
                    echo "<a id='customBtn' class='custom-link btn border-width-0 btn-flat btn-custom-black' href='/en/registration/'>REGISTER<span style='display: block; font-weight: 300;'>GET A FREE TICKET</span></a></span>";
                }
            } 
            ?>
        </span>
    </div>
</div>


<script>
    <?php 
    echo '
    const trade_date1 = "' .$trade_date. '";
    const trade_start1 = "' .$trade_start . '";
    const trade_end1 = "' .$trade_end. '";
    const localLang1 = "' .$locale. '";
    '; ?>

    if (["nowa data", "wiosna", "lato", "jesień", "zima"].some(season => trade_date1.toLowerCase().includes(season.toLowerCase()))) {
        document.querySelector('#main-timer').style.display='none';
    }

    function startEndCountdown(targetDate){
        const element = document.querySelector('#start-countdown');
        const now = new Date().getTime();
        targetDate = new Date(targetDate);
        const distance = targetDate - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        var countdownText = '';
        if (localLang1 === 'pl_PL') {
            function pluralizePolish(count, singular, plural, pluralGenitive) {
                if (count === 1) {
                    return `${count} ${singular} `;
                } else if (count % 10 >= 2 && count % 10 <= 4 && (count % 100 < 10 || count % 100 >= 20)) {
                    return `${count} ${plural} `;
                } else {
                    return `${count} ${pluralGenitive} `;
                }
            }
            if (localLang1 === 'pl_PL') {
                countdownText += pluralizePolish(days, 'dzień', 'dni', 'dni');
                countdownText += pluralizePolish(hours, 'godzina', 'godziny', 'godzin');
                countdownText += pluralizePolish(minutes, 'minuta', 'minuty', 'minut');
                countdownText += pluralizePolish(seconds, 'sekunda', 'sekundy', 'sekund').trim();
            }
        } else if (localLang1 === 'en_US') {
            function pluralize(count, noun) {
                return `${count} ${noun}${count !== 1 ? 's' : ''} `;
            }
            countdownText += pluralize(days, 'day');
            countdownText += pluralize(hours, 'hour');
            countdownText += pluralize(minutes, 'minute');
            countdownText += pluralize(seconds, 'second').trim(); // Usuńmy niepotrzebne spacje na końcu        
        }

        element.innerHTML = countdownText;
        if (distance > 0) {
            setTimeout(function() {
                startEndCountdown(targetDate);
            }, 1000);
        }
    } 
    {
        const now = new Date().getTime();
        const endDate = new Date(trade_end1);
        const startDate = new Date(trade_start1);

        if (endDate-now < 0 && startDate-now < 0){
            // // Set the year of the trade_start1 object to one year in the future
            // startDate.setMonth(startDate.getMonth() + 13);
            // // Create a new string in the format yyyy/mm/01
            // newDataToTimer = startDate.getFullYear() + '/' + startDate.getMonth() + '/01';
            // startEndCountdown(newDataToTimer);
            document.querySelector('#main-timer').style.display = 'none';
        } else {
            if (startDate-now < 0) {
                startEndCountdown(trade_end1);
            } else{
                startEndCountdown(trade_start1);
            }
        }
    }
</script>