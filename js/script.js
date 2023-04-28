/* JS */
localLang = document.querySelector('.custom_element').getAttribute('custom-lang');
console.log(localLang);

if (localLang == 'pl_PL') {
lang = document.querySelectorAll('.pl_PL');
for (i=0; i<lang.length; i++) lang[i].style.display = 'block';
console.log('pl');
} else if (localLang == 'en_US')  {
lang = document.querySelectorAll('.en_US');
for (i=0; i<lang.length; i++) lang[i].style.display = 'block';
console.log('en');
} else { 
console.log(localLang, 'nie ma takiego języka, dodaj tłumaczenie');
    lang = document.querySelectorAll('.en_US');
    for (i=0; i<lang.length; i++) lang[i].style.display = 'block'; 
};

jQuery(function ($) { 
    $(".pytanie").click(function() {
      $(event.target.nextElementSibling).slideToggle();
      $(event.target).toggleClass("active");
    }); 
  }); 
  console.log(document.querySelectorAll('.pytanie'));