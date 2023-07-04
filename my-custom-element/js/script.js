/* ZMIENNE GLOBALNE */
const trade_date = inner_data.trade_date;
const trade_start = inner_data.trade_start;
const trade_end = inner_data.trade_end;
const trade_name = inner_data.trade_name;
const trade_desc = inner_data.trade_desc;
const trade_name_en = inner_data.trade_name_en;
const trade_desc_en = inner_data.trade_desc_en;
var localLang = document.querySelector('.custom_element').getAttribute('custom-lang');
// ZNAJDYWANIE JĘZYKA
if (document.querySelector('.custom_element')) {
  var lang;

  if (localLang === 'pl_PL') {
    lang = document.querySelectorAll('.pl_PL');
  } else {
    lang = document.querySelectorAll('.en_US');
  }

  for (var i = 0; i < lang.length; i++) {
    lang[i].style.display = 'block';
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

// TIMER <----------------------------------------------------------------------------------------------------------<
if(document.querySelector('.custom-container-main-timer')) {
  if (!["nowa data", "wiosna", "lato", "jesień", "zima"].some(season => trade_date.toLowerCase().includes(season.toLowerCase()))) {

    let now = new Date();
    timer1 = document.querySelector('.custom-main-timer-before');
    timer2 = document.querySelector('.custom-main-timer-after');
    startDate = new Date(trade_start);
    endDate = new Date(trade_end);

    const startCountdownElement = document.getElementById('start-countdown');
    const endCountdownElement = document.getElementById('end-countdown');

    if (endDate-now < 0 && startDate-now < 0){
      timer1.classList.toggle('custom-display-none');
      // Set the year of the trade_start object to one year in the future
      startDate.setMonth(startDate.getMonth() + 13);
      // Create a new string in the format yyyy/mm/01
      newDataToTimer = startDate.getFullYear() + '/' + startDate.getMonth() + '/01';
      startEndCountdown(startCountdownElement, newDataToTimer);
    } else {
      if (startDate-now < 0) {
        timer2.classList.toggle('custom-display-none');
        startEndCountdown(endCountdownElement, trade_end);
      } else{
        timer1.classList.toggle('custom-display-none');
        startEndCountdown(startCountdownElement, trade_start);
      }
    } 
  } else  { document.querySelector('#main-timer').style.display='none'; }

    function startEndCountdown(element, targetDate) {
        const now = new Date().getTime();
        targetDate = new Date(targetDate);
        const distance = targetDate - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        var countdownText = '';

        if (localLang === 'pl_PL') {
          function pluralizePolish(count, singular, plural, pluralGenitive) {
            if (count === 1) {
                return `${count} ${singular} `;
            } else if (count % 10 >= 2 && count % 10 <= 4 && (count % 100 < 10 || count % 100 >= 20)) {
                return `${count} ${plural} `;
            } else {
                return `${count} ${pluralGenitive} `;
            }
        }
        
        if (localLang === 'pl_PL') {
            countdownText += pluralizePolish(days, 'dzień', 'dni', 'dni');
            countdownText += pluralizePolish(hours, 'godzina', 'godziny', 'godzin');
            countdownText += pluralizePolish(minutes, 'minuta', 'minuty', 'minut');
            countdownText += pluralizePolish(seconds, 'sekunda', 'sekundy', 'sekund').trim();
        }
        } else if (localLang === 'en_US') {
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
                startEndCountdown(element, targetDate);
            }, 1000);
        }
    }
}

// NIE PRZEGAP <----------------------------------------------------------------------------------------------------------<
{
  const niePrzegap = document.querySelector('.custom-container-niePrzegap');
  if(niePrzegap) {
    niePrzegap.addEventListener('mouseenter', function(){
      niePrzegap.classList.add('mouse-entered');
      if (niePrzegap.classList.contains('niePrzegap-hover')) niePrzegap.classList.remove('niePrzegap-hover');
    })
    setTimeout(function() {
      if (!niePrzegap.classList.contains('mouse-entered')) {
        niePrzegap.classList.add('niePrzegap-hover');
        setTimeout(function() {
            niePrzegap.classList.remove('niePrzegap-hover');
        }, 30000);
      }
    }, 120000);
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

// HIDE ELEMENTS IF THERE IS NO DATE
  const elementsToHide = [
    { main: '.custom-container-calendar-main', date: '.custom-container-main-icons', nodate: '.custom-container-calendar-icons-empty' },
    { main: '.custom-container-org-info', date: '.custom-org-info-block-dates', nodate: '.custom-hidden-paragraph' },
    { main: '.custom-container-org-info', date: '.custom-org-info-block-dates-en', nodate: '.custom-hidden-paragraph-en' },
    { main: '.custom-container-niePrzegap', date: '.custom-container-niePrzegap' },
    { main: '.custom-container-onlyCalendar',date: '.custom-container-onlyCalendar' }
  ];

  elementsToHide.forEach(({ main, date, nodate }) => {
    if (document.querySelector(main)) {
      if (["nowa data", "wiosna", "lato", "jesień", "zima"].some(season => trade_date.toLowerCase().includes(season.toLowerCase()))) {
        document.querySelector(nodate).classList.toggle('custom-display-none');
      } else {
        document.querySelector(date).classList.toggle('custom-display-none');
      }
      }
  });

// LOGOS-CATALOG
if (document.querySelector('.custom-container-logos-gallery')) {
  const galleryWrapper = document.querySelector('.custom-logos-gallery-wrapper');
  const logoCatalog = document.querySelectorAll('.custom-logo-item');
  const galleryItemCount = galleryWrapper.children.length;

  logoCatalog.forEach((logoItem) => {
    if (galleryItemCount > 18) {
      logoItem.style.width = '140px';
      galleryWrapper.style.gap = '24px';
    }
  });
  
  // HIDE CONTAINER LOGOS-CATALOG IF ZERO LOGOS
  if (galleryItemCount < 1) {
    document.querySelector('.row-container .row:has(.custom-container-logos-gallery-hide)').style.display='none';
  }
}
