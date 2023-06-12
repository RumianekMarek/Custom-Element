/* JS */
var customElement = document.querySelector('.custom_element');
if (customElement) {
  var localLang = customElement.getAttribute('custom-lang');

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

  jQuery(function ($) {
    $(".pytanie").click(function (event) {
      $(event.target.nextElementSibling).slideToggle();
      $(event.target).toggleClass("active");
    });
  });

  document.querySelectorAll('.row-container').forEach(function(rowContainer) {
    if (rowContainer.querySelector('#customGallery') || 
        rowContainer.querySelector('.custom-container-organizator') ||
        rowContainer.querySelector('#faq') || 
        rowContainer.querySelector('#calendar-add')) {
        rowContainer.classList.add('style-accent-bg');
    }
  });

  var rowContainerOrganizator = document.querySelector('.row-container:has(.custom-container-organizator)');
    if (rowContainerOrganizator) {
      rowContainerOrganizator.classList.add('style-accent-bg');
  }
  var rowContainerOrganizator = document.querySelector('.row-container:has(#customGallery)');
  if (rowContainerOrganizator) {
    rowContainerOrganizator.classList.add('style-accent-bg');
  }
}

if(document.querySelector('.custom-facebook')){
  if(document.querySelector('.custom-facebook').getAttribute('href') == '') document.querySelector('#socialMedia').style.display = 'none';
}
