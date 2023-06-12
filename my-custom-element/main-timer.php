<div id='main-timer' class='custom-container-main-timer style-accent-bg' style='color:white !important;'>
    <div class='custom-main-timer-before'>
        <p class='pl_PL text-uppercase'>Do targów pozostało:</p>
        <p class='en_US text-uppercase'>Until the start of the fair:</p>
        <p id='start-countdown' class='main-timer-countdown text-uppercase'></p>
        <span class='pl_PL custom-main-timer-btn'><a style='color:white !important;' class='custom-link btn border-width-0 shadow-white btn-flat' href='/zostan-wystawca/' target='_blank'>Zostań wystawcą</a></span>
        <span class='en_US custom-main-timer-btn'><a style='color:white !important;' class='custom-link btn border-width-0 shadow-white btn-flat' href='/en/become-an-exhibitor' target='_blank'>Book a stand</a></span>
    </div>
    <div class='custom-main-timer-after'>
        <p class='pl_PL text-uppercase'>Do końca targów pozostało:</p>
        <p class='en_US text-uppercase'>Until the end of the fair:</p>
        <p id='end-countdown' class='main-timer-countdown text-uppercase'></p>
        <span class='pl_PL custom-main-timer-btn'><a style='color:white !important;' class='custom-link btn border-width-0 shadow-white btn-flat' href='/zostan-wystawca/' target='_blank'>Zarejestruj się<span style="display: block; font-weight: 300;">Odbierz darmowy bilet</span></a></span>
        <span class='en_US custom-main-timer-btn'><a style='color:white !important;' class='custom-link btn border-width-0 shadow-white btn-flat' href='/en/become-an-exhibitor' target='_blank'>REGISTER<span style="display: block; font-weight: 300;">GET A FREE TICKET</span></a></span>
    </div>
</div>

<script type="text/javascript">

if (!("[trade_fair_date]".toLowerCase().includes("nowa data") || "[trade_fair_date]".toLowerCase().includes("wiosna") || "[trade_fair_date]".toLowerCase().includes("lato") || "[trade_fair_date]".toLowerCase().includes("jesień") || "[trade_fair_date]".toLowerCase().includes("zima"))) {

    // Calculate the difference between endDate, startDate, and the current date/time
    var startDate = new Date("[trade_fair_datetotimer]");
    var endDate = new Date("[trade_fair_enddata]");
    let now = new Date();

    timer1 = document.querySelector('.custom-main-timer-before');
    timer2 = document.querySelector('.custom-main-timer-after');

    timer2.style.display='none';
    if (endDate-now < 0 && startDate-now < 0){
        // Set the year of the startDate object to one year in the future
        startDate.setYear(startDate.getFullYear() + 1);
        // Create a new string in the format yyyy/mm/01
        newDataToTimer = startDate.getFullYear() + '/' + startDate.getMonth() + '/01';
        timer2.style.display='none';
    } else { 
            if (startDate-now < 0) {
            timer1.style.display='none';
            timer2.style.display='block';
        }
    }
} else { document.querySelector('#main-timer').style.display='none'; }
   
   
    var startCountdownElement = document.getElementById('start-countdown');
    var endCountdownElement = document.getElementById('end-countdown');
    var customElementAttribute = document.querySelector('.custom_element:has(.custom-container-main-timer)').attributes[0].nodeValue;
   
    startEndCountdown(startCountdownElement, startDate);
    startEndCountdown(endCountdownElement, endDate);

    function startEndCountdown(element, targetDate) {
        var now = new Date().getTime();
        var distance = targetDate - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        var countdownText = '';

        if (customElementAttribute === 'pl_PL') {
            countdownText = `${days} dni ${hours} godzin ${minutes} minut ${seconds} sekund`;
        } else if (customElementAttribute === 'en_US') {
            countdownText = `${days} days ${hours} hours ${minutes} minutes ${seconds} seconds`;
        }

        element.innerHTML = countdownText;

        if (distance > 0) {
            setTimeout(function() {
                startEndCountdown(element, targetDate);
            }, 1000);
        }
    }
 
</script>





