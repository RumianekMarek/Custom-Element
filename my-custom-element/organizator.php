<style>
  .custom-organizator-video{
    height:500px;
    position: relative;
    overflow: hidden;
  }
  .custom-organizator-video iframe{
    min-width: 180%; 
    height:120vh; 
    position: absolute;
    top:50%;
    left:50%;
    transform: translate(-50%, -50%);
  }
  .custom-organizator-text{
    position: relative;
  }
  .custom-organizator-text{
    padding:1px 0 50px 0;
  }
  .custom-inner-organizator{
    max-width:1200px;
  }
</style>

<div id="organizator" class="custom-container-organizator text-centered">
  <div class='custom-organizator-video'>
    <iframe title="YouTube video player" frameborder="0" marginwidth="0"
      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share; muted" 
      data-src="https://www.youtube.com/embed/dZJblpIVrcQ?autoplay=1&mute=1&loop=1&playlist=dZJblpIVrcQ&controls=0&showinfo=0"></iframe>
  </div>
  <div class="custom-organizator-text style-accent-bg">
    <div class='custom-inner-organizator text-left'>
      <p class="border-top-left"  style="box-shadow: -3px -3px white; margin: 25px -10px -40px -10px !important; ">&nbsp;</p>
      <h5 class="custom-organizator-header " style="color:white !important;">
        <?php if($locale == 'pl_PL'){ echo '
        O organizatorze
        ';} else { echo '
        About the organizer
        ';} ?>
      </h5>
      <p  class="" style="color:white !important;">
        <?php if($locale == 'pl_PL'){ echo 'Ptak Warsaw Expo to przede wszystkim gwarancja doświadczenia. Już od blisko dekady organizujemy ponad 70 imprez rocznie na 143 000 m2 powierzchni wystawienniczej 6 nowoczesnych hal oraz 500 000 m2 powierzchni zewnętrznej. To pozycjonuje nas jako lidera branży targowej, dysponującego najbardziej innowacyjnym zapleczem organizacyjnym.
        <br> To jednak nie wszystko. Zdobyte doświadczenie i wysoka jakość aranżowanych wydarzeń przełożyła się na zbudowanie silnej sieci kontaktów biznesowych. Ta gwarantuje uczestnikom poszczególnych eventów dostęp do nowoczesnych rozwiązań - zarówno znanych na polskim rynku, jak i podbijających branże na polu międzynarodowym. To sprawia, że imprezy Ptak Warsaw Expo otwierają odwiedzających na nowe możliwości biznesowe. Dowodem zdobytego zaufania są rekordowe liczby - 1 000 000 odwiedzających i 10 000 wystawców.
        <br> Największą siłą Ptak Warsaw Expo jest jednak nasz zespół. To doświadczona grupa pełnych pasji ludzi, która za cel stawia sobie wyjście naprzeciw oczekiwaniom odwiedzających i wystawców. Elastyczne podejście, umiejętność znalezienia odpowiedzi na zmieniające się okoliczności i otwartość na potrzeby uczestników wydarzeń - te cechy sprawiają, że nasze eventy docenia się ze względu na profesjonalną obsługę.
        <br> Te wszystkie czynniki składają się na to, że Ptak Warsaw Expo stało się europejską stolicą targów, organizującą niezapomniane imprezy branżowe i komercyjne. Zachęcamy do kontaktu już dziś, aby dowiedzieć się jak konkretnie możemy pomóc osiągnąć twoje cele i sprawić, że firma otworzy się na nowe możliwości biznesowe.
        ';} else { echo "
        Ptak Warsaw Expo is first and foremost a guarantee of experience. For nearly a decade now, we have been organizing more than 70 events a year on 143,000 sqm of exhibition space of 6 modern halls and 500,000 sqm of outdoor space. This positions us as a leader in the trade fair industry with the most innovative organizational facilities.
        <br> However, that's not all. The experience we have gained and the high quality of the events we arrange have translated into building a strong network of business contacts. This guarantees the participants of individual events access to modern solutions - both those known on the Polish market and those conquering the industry on the international field. This makes Ptak Warsaw Expo events open visitors to new business opportunities. Proof of the trust gained is the record numbers - 1,000,000 visitors and 10,000 exhibitors.
        <br> However, the greatest strength of Ptak Warsaw Expo is our team. It is an experienced group of passionate people who aim to meet the expectations of visitors and exhibitors. Flexible approach, ability to find answers to changing circumstances and openness to the needs of event participants - these qualities make our events appreciated for their professional service.
        <br> All these factors contribute to the fact that Ptak Warsaw Expo has become the European capital of trade fairs, organizing unforgettable industry and commercial events. We encourage you to contact us today to find out how specifically we can help you achieve your goals and make your company open to new business opportunities.
        ";} ?>
      </p>
      <p class="border-bottom-right"  style="box-shadow: 3px 3px white; margin: -20px -10px 30px 0px; ">&nbsp;</p>
    </div>
  </div>
</div>