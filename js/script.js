/* ZMIENNE GLOBALNE */
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
        rowContainer.querySelector('#calendar-add')) {
        rowContainer.classList.add('style-accent-bg');
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
