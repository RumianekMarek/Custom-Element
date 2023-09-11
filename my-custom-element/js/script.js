/* ZMIENNE GLOBALNE */
const trade_date = inner_data.trade_date;
const trade_start = inner_data.trade_start;
const trade_end = inner_data.trade_end;
const trade_name = inner_data.trade_name;
const trade_desc = inner_data.trade_desc;
const trade_name_en = inner_data.trade_name_en;
const trade_desc_en = inner_data.trade_desc_en;
if (document.querySelector('.cat')) var localLang = document.querySelector('.cat').getAttribute('custom-lang');

if (document.querySelector('.custom_element')) {
//  var localLang = document.querySelector('.custom_element').getAttribute('custom-lang');
//   var lang;

//   if (localLang === 'pl_PL') {
//     lang = document.querySelectorAll('.pl_PL');
//   } else {
//     lang = document.querySelectorAll('.en_US');
//   }

//   for (var i = 0; i < lang.length; i++) {
//     lang[i].style.display = 'block';
//   }


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
      rowContainerBg.querySelector('.custom-container-calendar-main') ||
      rowContainerBg.querySelector('.custom-wydarzenia-header') ||
      rowContainerBg.querySelector('.custom-footer')) {
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


//NIE PRZEGAP <----------------------------------------------------------------------------------------------------------<
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
    { main: '.custom-container-niePrzegap', date: '.custom-container-niePrzegap' },
    //{ main: '#promoteYourself', date: '.' },
    { main: '.custom-container-onlyCalendar',date: '.custom-container-onlyCalendar' }
  ];

  elementsToHide.forEach(({ main, date, nodate }) => {
    if (document.querySelector(main)) {
      if (["nowa data", "wiosna", "lato", "jesień", "zima"].some(season => trade_date.toLowerCase().includes(season.toLowerCase()))) {
        if(nodate){document.querySelector(nodate).classList.toggle('custom-display-none');}
      } else {
        document.querySelector(date).classList.toggle('custom-display-none');
      }
      }
  });
  
  //funkcja do usuwania polskich liter
  function PolskieLitery(tekst) {
    const polskieLiteryMap = {
      'ą': 'a',
      'ć': 'c',
      'ę': 'e',
      'ł': 'l',
      'ń': 'n',
      'ó': 'o',
      'ś': 's',
      'ź': 'z',
      'ż': 'z',
      'Ą': 'A',
      'Ć': 'C',
      'Ę': 'E',
      'Ł': 'L',
      'Ń': 'N',
      'Ó': 'O',
      'Ś': 'S',
      'Ź': 'Z',
      'Ż': 'Z'
    };
    return tekst.replace(/[ąćęłńóśźżĄĆĘŁŃÓŚŹŻ]/g, znak => polskieLiteryMap[znak] || znak);
  }
