/* ZMIENNE GLOBALNE */
const trade_date = inner_data.trade_date;
const trade_start = inner_data.trade_start;
const trade_end = inner_data.trade_end;
const trade_name = inner_data.trade_name;
const trade_desc = inner_data.trade_desc;
const trade_name_en = inner_data.trade_name_en;
const trade_desc_en = inner_data.trade_desc_en;

/* JS */
// ZNAJDYWANIE JĘZYKA
if (document.querySelector('.custom_element')) {
  var localLang = document.querySelector('.custom_element').getAttribute('custom-lang');

  if (localLang == 'pl_PL') {
    var lang = document.querySelectorAll('.pl_PL');
    for (var i = 0; i < lang.length; i++) {
      lang[i].style.display = 'block';
    }
  } else if (localLang == 'en_US') {
    var lang = document.querySelectorAll('.en_US');
    for (var i = 0; i < lang.length; i++) {
      lang[i].style.display = 'block';
    }
  } else {
    var lang = document.querySelectorAll('.en_US');
    for (var i = 0; i < lang.length; i++) {
      lang[i].style.display = 'block';
    }
  }

// FAQ
if (document.querySelector('.custom-container-faq')) {
  jQuery(function ($) {
    $(".pytanie").click(function (event) {
      $(event.target.nextElementSibling).slideToggle();
      $(event.target).toggleClass("active");
    });
  });
}
// AKCENT BACKGROUND DO CUSTOM-ELEMENTU
document.querySelectorAll('.row-container').forEach(function(rowContainer) {
    if (rowContainer.querySelector('#customGallery') || 
        rowContainer.querySelector('.custom-container-organizator') ||
        rowContainer.querySelector('#faq') || 
        rowContainer.querySelector('#main-timer') || 
        rowContainer.querySelector('#calendar-add')) {
        rowContainer.classList.add('style-accent-bg');
    }
  });
  //  FULLSCREEN ROW CONTAINER
  document.querySelectorAll('.row-container .row').forEach(function(rowContainerBg) {
    if (rowContainerBg.querySelector('.custom-container-organizator') ||
        rowContainerBg.querySelector('.custom-container-org-info') ||
        rowContainerBg.querySelector('.custom-container-calendar-main')) {
          if (rowContainerBg.classList.contains("limit-width")) rowContainerBg.classList.remove("limit-width");
            rowContainerBg.classList.add("full-width");
          }
  });

  // AKCENT BACKGROUND FULLSCREEN DO CUSTOM-ELEMENTU
  var rowContainerOrganizator = document.querySelector('.row-container:has(.custom-container-organizator)');
    if (rowContainerOrganizator) {
      rowContainerOrganizator.classList.add('style-accent-bg');
    }
    var rowContainerOrganizator = document.querySelector('.row-container:has(#customGallery)');
    if (rowContainerOrganizator) {
      rowContainerOrganizator.classList.add('style-accent-bg');
    }

  // SOCIAL MEDIA
  if(document.querySelector('.custom-facebook')){
    if(document.querySelector('.custom-facebook').getAttribute('href') == '') document.querySelector('#socialMedia').style.display = 'none';
  } 
}
// KALENDARZ
const CalendarLink = (calendar) => {
  switch (calendar) {
    case 'google':
      if (localLang == 'pl_PL') {
        window.open('https://calendar.google.com/calendar/render?action=TEMPLATE&details='+encodeURIComponent(trade_desc)+'&dates='+trade_start.substring(0,4)+trade_start.substring(5,7)+trade_start.substring(8,10)+'T100000%2F'+trade_end.substring(0,4)+trade_end.substring(5,7)+trade_end.substring(8,10)+'T170000?0&location=Aleja%20Katowicka%2062%2C%2005-Aleja%20Katowicka%2062%2C%2005-830%20Nadarzyn%2C%20Polska&text='+encodeURIComponent(trade_name), "_blank");
      } else {
        window.open('https://calendar.google.com/calendar/render?action=TEMPLATE&details='+encodeURIComponent(trade_desc_en)+'&dates='+trade_start.substring(0,4)+trade_start.substring(5,7)+trade_start.substring(8,10)+'T100000%2F'+trade_end.substring(0,4)+trade_end.substring(5,7)+trade_end.substring(8,10)+'T170000?0&location=Aleja%20Katowicka%2062%2C%2005-Aleja%20Katowicka%2062%2C%2005-830%20Nadarzyn%2C%20Polska&text='+encodeURIComponent(trade_name_en), "_blank");
      } break;
    case 'outlook':
      if (localLang == 'pl_PL') {
      window.open('https://outlook.live.com/calendar/0/action/compose?body='+encodeURIComponent(trade_desc)+'&enddt='+trade_end.substring(0,4)+'-'+trade_end.substring(5,7)+'-'+trade_end.substring(8,10)+'T17%3A00%3A00%3A00&location=Aleja%20Katowicka%2062%2C%2005-830%20Nadarzyn&path=%2Fcalendar%2Faction%2Fcompose&rru=addevent&startdt='+trade_start.substring(0,4)+'-'+trade_start.substring(5,7)+'-'+trade_start.substring(8,10)+'T10%3A00%3A00%3A00&subject='+encodeURIComponent(trade_name), "_blank");
    } else {
      window.open('https://outlook.live.com/calendar/0/action/compose?body='+encodeURIComponent(trade_desc_en)+'&enddt='+trade_end.substring(0,4)+'-'+trade_end.substring(5,7)+'-'+trade_end.substring(8,10)+'T17%3A00%3A00%3A00&location=Aleja%20Katowicka%2062%2C%2005-830%20Nadarzyn&path=%2Fcalendar%2Faction%2Fcompose&rru=addevent&startdt='+trade_start.substring(0,4)+'-'+trade_start.substring(5,7)+'-'+trade_start.substring(8,10)+'T10%3A00%3A00%3A00&subject='+encodeURIComponent(trade_name_en), "_blank");
    }
    break;
    case 'office365':
      if (localLang == 'pl_PL') {
      window.open('https://outlook.office.com/calendar/deeplink/compose?allday=false&body='+encodeURIComponent(trade_desc)+'&enddt='+trade_end.substring(0,4)+'-'+trade_end.substring(5,7)+'-'+trade_end.substring(8,10)+'T17%3A00%3A00%3A00&location=Aleja%20Katowicka%2062%2C%2005-830%20Nadarzyn&path=%2Fcalendar%2Faction%2Fcompose&rru=addevent&startdt='+trade_start.substring(0,4)+'-'+trade_start.substring(5,7)+'-'+trade_start.substring(8,10)+'T10%3A00%3A00%3A00&subject='+encodeURIComponent(trade_name), "_blank");
    } else {
      window.open('https://outlook.office.com/calendar/deeplink/compose?allday=false&body='+encodeURIComponent(trade_desc_en)+'&enddt='+trade_end.substring(0,4)+'-'+trade_end.substring(5,7)+'-'+trade_end.substring(8,10)+'T17%3A00%3A00%3A00&location=Aleja%20Katowicka%2062%2C%2005-830%20Nadarzyn&path=%2Fcalendar%2Faction%2Fcompose&rru=addevent&startdt='+trade_start.substring(0,4)+'-'+trade_start.substring(5,7)+'-'+trade_start.substring(8,10)+'T10%3A00%3A00%3A00&subject='+encodeURIComponent(trade_name_en), "_blank");
    }
    break;
    case 'yahoo':
      if (localLang == 'pl_PL') {
      window.open('https://calendar.yahoo.com/?desc='+encodeURIComponent(trade_desc)+'&dur=&et='+trade_end.substring(0,4)+trade_end.substring(5,7)+trade_end.substring(8,10)+'T170000&in_loc=Aleja%20Katowicka%2062%2C%2005-830%20Nadarzyn&st='+trade_start.substring(0,4)+trade_start.substring(5,7)+trade_start.substring(8,10)+'T100000&title='+encodeURIComponent(trade_name)+'&v=60', "_blank");
    } else {
      window.open('https://calendar.yahoo.com/?desc='+encodeURIComponent(trade_desc_en)+'&dur=&et='+trade_end.substring(0,4)+trade_end.substring(5,7)+trade_end.substring(8,10)+'T170000&in_loc=Aleja%20Katowicka%2062%2C%2005-830%20Nadarzyn&st='+trade_start.substring(0,4)+trade_start.substring(5,7)+trade_start.substring(8,10)+'T100000&title='+encodeURIComponent(trade_name_en)+'&v=60', "_blank");
    }
    break;
    default:
      break;
  }
}

function downloadFile(url) {
  var newTab = window.open(url, "_blank");
  newTab.onload = function() {
      newTab.close();
  };
}

const AppleCalendarFile = () => {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/wp-content/plugins/custom-element/my-custom-element/calendarApple.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
      }
  };
  if (localLang == 'pl_PL') {
    var data = 'trade_start=' + encodeURIComponent(trade_start) +
            '&trade_end=' + encodeURIComponent(trade_end) +
            '&trade_name=' + encodeURIComponent(trade_name) +
            '&trade_desc=' + encodeURIComponent(trade_desc);
  } else{
    var data = 'trade_start=' + encodeURIComponent(trade_start) +
            '&trade_end=' + encodeURIComponent(trade_end) +
            '&trade_name=' + encodeURIComponent(trade_name_en) +
            '&trade_desc=' + encodeURIComponent(trade_desc_en);
  }
  xhr.send(data);
  downloadFile("/doc/Iphone.ics");
};

// INFO ORG <----------------------------------------------------------------------------------------------------------<
if(document.querySelector('.custom-container-org-info')){
  var customElementAttribute = document.querySelector('.custom_element:has(.custom-container-org-info)').attributes[0].nodeValue;
  if (customElementAttribute === 'pl_PL') {
    if (["nowa data", "wiosna", "lato", "jesień", "zima"].some(season => trade_date.toLowerCase().includes(season.toLowerCase()))) {
        document.querySelector('.custom-org-info-block-dates').style.display = 'none';
        document.querySelector('.custom-hidden-paragraph').style.display = 'block';
    }
} else if (customElementAttribute === 'en_US') {
    if (["nowa data", "wiosna", "lato", "jesień", "zima"].some(season => trade_date.toLowerCase().includes(season.toLowerCase()))) {
        document.querySelector('.custom-org-info-block-dates-en').style.display = 'none';
        document.querySelector('.custom-hidden-paragraph-en').style.display = 'block';
    }
  }
}  

// TIMER <----------------------------------------------------------------------------------------------------------<
if(document.querySelector('.custom-container-main-timer')) {
  if (!["nowa data", "wiosna", "lato", "jesień", "zima"].some(season => trade_date.toLowerCase().includes(season.toLowerCase()))) {

    let now = new Date();

    timer1 = document.querySelector('.custom-main-timer-before');
    timer2 = document.querySelector('.custom-main-timer-after');

    timer2.style.display='none';
    if (trade_end-now < 0 && trade_start-now < 0){
        // Set the year of the trade_start object to one year in the future
        trade_start.setYear(trade_start.getFullYear() + 1);
        // Create a new string in the format yyyy/mm/01
        newDataToTimer = trade_start.getFullYear() + '/' + trade_start.getMonth() + '/01';
        timer2.style.display='none';
    } else { 
            if (trade_start-now < 0) {
            timer1.style.display='none';
            timer2.style.display='block';
        }
    }
  } else  { document.querySelector('#main-timer').style.display='none'; }
   
    const startCountdownElement = document.getElementById('start-countdown');
    const endCountdownElement = document.getElementById('end-countdown');
    
   
    startEndCountdown(startCountdownElement, trade_start);
    startEndCountdown(endCountdownElement, trade_end);

    function startEndCountdown(element, targetDate) {
        const customElementAttribute = document.querySelector('.custom_element:has(.custom-container-main-timer)').attributes[0].nodeValue;
        const now = new Date().getTime();
        targetDate = new Date(targetDate);
        const distance = targetDate - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        var countdownText = '';

        if (customElementAttribute === 'pl_PL') {
            if (days === 1) {
                countdownText += `${days} dzień `;
            } else if (days >= 2 && days <= 4) {
                countdownText += `${days} dni `;
            } else {
                countdownText += `${days} dni `;
            }

            if (hours === 1) {
                countdownText += `1 godzina `;
            } else if (hours >= 2 && hours <= 4) {
                countdownText += `${hours} godziny `;
            } else {
                countdownText += `${hours} godzin `;
            }

            if (minutes === 1 || minutes === 21 || minutes === 31 || minutes === 41 || minutes === 51) {
                countdownText += `1 minuta `;
            } else if (
                (minutes >= 2 && minutes <= 4) ||
                (minutes >= 22 && minutes <= 24) ||
                (minutes >= 32 && minutes <= 34) ||
                (minutes >= 42 && minutes <= 44) ||
                (minutes >= 52 && minutes <= 54)
            ) {
                countdownText += `${minutes} minuty `;
            } else {
                countdownText += `${minutes} minut `;
            }

            if (seconds === 1) {
                countdownText += `1 sekunda`;
            } else if (seconds >= 2 && seconds <= 4) {
                countdownText += `${seconds} sekundy`;
            } else {
                countdownText += `${seconds} sekund`;
            }
        } else if (customElementAttribute === 'en_US') {
            if (days === 1) {
                countdownText += `${days} day `;
            } else {
                countdownText += `${days} days `;
            }

            if (hours === 1) {
                countdownText += `1 hour `;
            } else {
                countdownText += `${hours} hours `;
            }

            if (minutes === 1) {
                countdownText += `1 minute `;
            } else {
                countdownText += `${minutes} minutes `;
            }

            if (seconds === 1) {
                countdownText += `1 second`;
            } else {
                countdownText += `${seconds} seconds`;
            }
        }

        element.innerHTML = countdownText;

        if (distance > 0) {
            setTimeout(function() {
                startEndCountdown(element, targetDate);
            }, 1000);
        }
    }
}

// NIE PRZEGAP <----------------------------------------------------------------------------------------------------------<
if(document.querySelector('.custom-container-niePrzegap')) {
  let niePrzegap = document.querySelector('.custom-container-niePrzegap');
  let niePrzegapSmallText = document.querySelector('.custom-vertival-text-niePrzegap');
  let idleTimeout = null; // Timeout dla braku interakcji

  // Dodawanie klasy przy najechaniu
  niePrzegap.addEventListener('mouseenter', function() {
      niePrzegap.classList.add('hovered-cal');
      clearTimeout(idleTimeout); // Resetowanie timera dla braku interakcji
  });
  // Usuwanie klasy przy opuszczeniu
  niePrzegap.addEventListener('mouseleave', function() {
      niePrzegap.classList.remove('hovered-cal');
      resetujTimer();
  });
  // Pokazywanie elementu po 2 minutach
  let niePrzegapTimer = setTimeout(function() {
      niePrzegap.style.left = '0';
      resetujTimer();
  }, 120000);
  // Ukrywanie elementu po 30 sekundach braku interakcji
  function resetujTimer() {
      clearTimeout(idleTimeout);
      idleTimeout = setTimeout(ukryjElement, 30000);
  }
  function resetujTimerNatychmiast() {
      clearTimeout(niePrzegapTimer);
      niePrzegapTimer = setTimeout(ukryjElement, 0);
  }
  // Ukrywanie elementu po najechaniu i opuszczeniu
  niePrzegap.addEventListener('mouseleave', function() {
      resetujTimerNatychmiast();
  });
  function ukryjElement() {
      niePrzegap.style.left = '-250px';
  }
  // Anulowanie działania po najechaniu
  niePrzegap.addEventListener('mouseenter', function() {
      clearTimeout(niePrzegapTimer);
      clearTimeout(idleTimeout);
  });
  // Anulowanie działania po opuszczeniu
  niePrzegap.addEventListener('mouseleave', function() {
      resetujTimer();
  });
  // Anulowanie działania bez ukrywania po kliknięciu
  function anulujDzialanie() {
      clearTimeout(niePrzegapTimer);
      clearTimeout(idleTimeout);
      niePrzegap.removeEventListener('mouseenter', anulujDzialanie);
      niePrzegap.removeEventListener('mouseleave', resetujTimer);
  }
}


//AUTOMATYCZNY LAZY LOAD DLA IFRAMEÓW
// w iframe wideo nie ustawiamy parametru "src" zamiast niego ustawiamy "data-src".
// Filmik zoastanie załadowany dopiwero po zjechaniu do 1000px strony internetowej.
const insertSrc = () => {
  let iframes = document.querySelectorAll('iframe')
  for (var i = 0; i < iframes.length; i++) {
    if (!iframes[i].src && iframes[i].dataset.src) {
      iframes[i].src = iframes[i].dataset.src;
    }
  }
  window.removeEventListener('scroll', insertSrc);
}

let scrolled = false;
window.addEventListener('scroll', function() {
  if (!scrolled && window.scrollY >= 1000) {
    insertSrc();
    scrolled = true;
  }
});

// HIDE CALENDAR IF NO DATE
if(document.querySelector('.custom-container-calendar-main')) {
  if (["nowa data", "wiosna", "lato", "jesień", "zima"].some(season => trade_date.toLowerCase().includes(season.toLowerCase()))) {
      document.querySelector('.custom-container-calendar-icons-hide').style.display='none';
      document.querySelector('.custom-container-calendar-icons-empty').style.display='block';
  } 
}
// HIDE 'NIE PRZEGAP' IF NO DATE
if (document.querySelector('.custom-container-niePrzegap')) {
  if (["nowa data", "wiosna", "lato", "jesień", "zima"].some(season => trade_date.toLowerCase().includes(season.toLowerCase()))) {
    document.querySelector('.custom-container-niePrzegap-hide').style.display='none';
  }
}
// HIDE CONFIRMATION-CALENDAR IF NO DATE
if (document.querySelector('.custom-container-onlyCalendar')) {
  if (["nowa data", "wiosna", "lato", "jesień", "zima"].some(season => trade_date.toLowerCase().includes(season.toLowerCase()))) {
    document.querySelector('.row-container .row:has(.custom-container-onlyCalendar-hide)').style.display='none';
  }
}

// LOGOS-EXHIBITORS 
if (document.querySelector('.custom-container-exhibitors-gallery')) {
  const galleryWrapper = document.querySelector('.custom-exhibitors-gallery-wrapper');
  const logoExhibitors = document.querySelectorAll('.custom-logo-exhibitor');
  const galleryItemCount = galleryWrapper.children.length;

  logoExhibitors.forEach((logoExhibitor) => {
    if (galleryItemCount > 18) {
      logoExhibitor.style.width = '140px';
      galleryWrapper.style.gap = '24px';
    }
  });
  // HIDE CONTAINER LOGOS-EXHIBITORS IF ZERO EXHIBITORS
  if (galleryItemCount < 1) {
    document.querySelector('.row-container .row:has(.custom-container-exhibitors-gallery-hide)').style.display='none';
  }
}

// REPLACE IMAGES IF MINI NOT FOUND
let miniImg = document.querySelectorAll('.mini-img');
if (miniImg) {
  miniImg.forEach((img, index) => {
    let repeatedIndex = index % 4;
    if (img.src) {
      img.src = `/doc/galeria/mini/mini-${repeatedIndex + 1}.jpg`;
    } else {
      img.src = `/doc/galeria/Galeria-${repeatedIndex + 1}.jpeg`;
    }
  });
}







