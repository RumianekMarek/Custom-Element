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
  var localLang = document.querySelector('.custom_element').getAttribute('custom-lang');
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

// // LOGOS-CATALOG
// if (document.querySelector('.custom-container-logos-gallery')) {
//   const galleryWrapper = document.querySelector('.custom-logos-gallery-slider');
//   const galleryItemCount = galleryWrapper.children.length;
//   let openCloseCarousel = show_slider;

//   // Open slider
//   if (openCloseCarousel == "true" && galleryItemCount > 7) {

//     document.querySelectorAll('.row-container .row').forEach(function(rowContainerBg) {
//       if (rowContainerBg.querySelector('.custom-container-logos-gallery')) {
//             if (rowContainerBg.classList.contains("limit-width")) rowContainerBg.classList.remove("limit-width");
//               rowContainerBg.classList.add("full-width");
//             }
//     });
//     document.querySelectorAll('.custom-logos-title').forEach(function(element) {
//       element.style.paddingLeft = "36px";
//     });

//     jQuery(function ($) {
  
//       // Set the number of dots, dot size and margin here.
//       var maxDots = 5;
//       var dotSize = 15; //px
//       var dotMargin = 8; //px
    
//       // Variables used to control the sliding animation
//       var transformXIntervalNext;
//       var transformXIntervalPrev;
    
//       // Keep track of the current X (left/right scroll) position
//       var transformCount = 0;
    
//       function setBoundaries($slick, windowSize) {
//         let $dots = $('.slick-dots li');
//         // Added to dots accent bg-color
//         $dots.addClass("style-accent-bg");
//         $dots.each(function(idx) {
//             $(this).css({width:dotSize, height:dotSize, margin:'0 ' + dotMargin + 'px'});
//             $('button', $(this)).css({width:dotSize, height:dotSize, margin:'0 ' + dotMargin + 'px', font:dotSize});
//         });
//         if (windowSize < $dots.length) {
//             $slick.find(".slick-dots li").eq(windowSize-1).addClass("small");
//         }
//         let $dot = $dots.first();
//         let marginLeft = Math.round(parseFloat($dot.css('margin-left')));
//         let marginRight = Math.round(parseFloat($dot.css('margin-right')));
//         let dotWidth = $dot.width() + marginLeft + marginRight;
//         let viewportWidth = dotWidth * windowSize;
    
//         // Calculate the viewport width
//         $('.slick-dots-viewport').css('width', viewportWidth + 'px');
    
//         // Define the left/right increments to smoothly scroll the dots.
//         transformXIntervalPrev = dotWidth;
//         transformXIntervalNext = -dotWidth;
//       }
    
//       // Slick Selector.
//       var slickSlider = $(".custom-logos-gallery-slider");
//       slickSlider.on("init", function (event, slick) {
//         // Since the dots location is customisable, use the config options to find them.
//         let $dotsholder = $(slick.options.appendDots).find('.' + slick.options.dotsClass);
//         $dotsholder.wrap("<div class='slick-dots-viewport'></div>");
//         // $dots.wrap("<div class='slick-dots-viewport'></div>");
//         // Add an index to each dot so we can easily identify them.
//         $dotsholder
//             .find("li")
//             .each(function (index) {
//                 $(this).addClass("dot-index-" + index);
//             });
    
//         // Reset the list position inside the viewport window
//         $dotsholder.css("transform", "translateX(0)");
    
//         // Resize the viewport and initialise the overflow dot (if necessary)
//         setBoundaries($(this), maxDots);
//       });
    
//       slickSlider.on("beforeChange", function (event, slick, currentSlide, nextSlide) {
//         let $slider = $(this);
//         let $dotList = $slider.find("ul.slick-dots");
//         // debugger;
//         let $dots = $dotList.find("li");
//         let $firstDot = $dots.first();
//         let $lastDot = $dots.last();
//         let totalCount = $dots.length;
//         if (totalCount > maxDots) {
//             let delta = nextSlide - currentSlide;
//             if (Math.abs(delta) === totalCount - 1) {
//                 // Reset the style of every dot because we're about to wrap around
//                 $dots.removeClass("small");
//                 let boundaryDot;
//                 if (delta < 0) {
//                     // Wrapping around to the start
//                     transformCount = 0;
//                     boundaryDot = maxDots - 1;
//                 } else {
//                     // Wrapping around to the end
//                     transformCount = (totalCount - maxDots) * transformXIntervalNext;
//                     boundaryDot = totalCount - maxDots;
//                 }
//                 $dots.filter(".dot-index-" + boundaryDot).addClass("small");
    
//                 // Animate the dots into position
//                 $dotList.css("transform", "translateX(" + transformCount + "px)");
//             } else {
//                 let $nextSlide = $dots.filter(".dot-index-" + nextSlide);
//                 if (nextSlide > currentSlide) {
//                     if ($nextSlide.hasClass("small")) {
//                         // We haven't reached the end of the list yet, scroll the dots to the left.
//                         transformCount = transformCount + transformXIntervalNext;
    
//                         // Remove the existing right-side boundary dot...
//                         $nextSlide.removeClass("small");
    
//                         // ...and move it one place to the right UNLESS we already reached the last dot.
//                         if (!$nextSlide.next().is($lastDot)) {
//                             $nextSlide.next().addClass("small");
//                         }
    
//                         // Smoothly slide the dots to the left
//                         $dotList.css("transform", "translateX(" + transformCount + "px)");
    
//                         // Update the left-side boundary dot.
//                         let $firstVisibleDot = $dots.eq(nextSlide - (maxDots-2));
//                         $firstVisibleDot.addClass("small").prev().removeClass("small").addClass("tiny");
//                     }
//                 } else {
//                     // If the previous button has the "small" dot style...
//                     if ($nextSlide.hasClass("small")) {
//                         // We haven't reached the start of the list yet, scroll the dots to the right.
//                         transformCount = transformCount + transformXIntervalPrev;
    
//                         // Remove the existing left-side boundary dot...
//                         $nextSlide.removeClass("small");
    
//                         // ...and move it one place to the left UNLESS we already reached the first dot.
//                         if (!$nextSlide.prev().is($firstDot)) {
//                             $nextSlide.prev().addClass("small");
//                         }
    
//                         // Smoothly slide the dots to the left
//                         $dotList.css("transform", "translateX(" + transformCount + "px)");
    
//                         // Update the left-side boundary dot.
//                         let $lastVisibleDot = $dots.eq(nextSlide + (maxDots-2));
//                         $lastVisibleDot.addClass("small").next().removeClass("small").addClass("tiny");
//                     }
//                 }
//             }
//         }
//       });
    
//       slickSlider.on("afterChange", function (event, slick, currentSlide) {
//         let $slider = $(this);
//         let $dotList = $slider.find("ul.slick-dots");
//         let $dots = $dotList.find("li");
//         $dots.filter('.tiny').removeClass('tiny');
//       });
    
//       slickSlider.slick({
//         centerMode: true,
//           slidesToShow: 7,
//           slidesToScroll: 1,
//           arrows: false,
//           autoplay: true,
//           autoplaySpeed: 3000,
//           dots: true,
//           cssEase: 'linear',
//           swipeToSlide: true,
//           responsive: [
//             {
//               breakpoint: 900,
//               settings: {
//                   slidesToShow: 5,
//                   autoplay: false
//               }
//             },
//             {
//               breakpoint: 768,
//               settings: {
//                   slidesToShow: 4,
//                   autoplay: false
//               }
//             },  
//             {
//               breakpoint: 480,
//               settings: {
//                   slidesToShow: 2,
//                   autoplay: false
//               }
//             },
//             {
//               breakpoint: 350,
//               settings: {
//                   slidesToShow: 1,
//                   autoplay: false
//               }
//             }
//           ]
        
//       });
  
//     });
//   }
//   if(galleryItemCount < 1) { // HIDE CONTAINER LOGOS-CATALOG IF GALLERY LENGTH = 0
//       document.querySelector('.row-container .row:has(.custom-container-logos-gallery-hide)').style.display='none';
//   }
// }
