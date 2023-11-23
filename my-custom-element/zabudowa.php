<div id="stand" class="custom-container-zabudowa">
  <div class="custom-block-1 half-block-padding" style="flex:1;">
    <div class="heading-text el-text main-heading-text text-centered">
      <h4>
        <?php if($locale == 'pl_PL'){ echo '
          DEDYKOWANA ZABUDOWA TARGOWA
        ';} else { echo '
          DESIGNED EXHIBITION STANDS
        ';} ?>
      </h4>
    </div>
    <?php
      if (!preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT'])) {
        echo '<p class="custom-line-height">';
          if($locale == 'pl_PL'){ echo '
            Zobacz katalog stoisk targowych i przygotuj się na udział w targach w sposób jeszcze bardziej efektywny. Dzięki temu katalogowi będziesz miał dostęp do gotowych projektów stoisk, które ułatwią Ci przygotowanie się do targów i zyskasz cenną oszczędność czasu i pieniędzy. Wybierając już gotowy projekt stoiska, będziesz mógł skupić się na innych ważnych aspektach przygotowań do targów, takich jak przygotowanie oferty, zorganizowanie transportu czy zaplanowanie działań marketingowych.
          ';} else { echo '
            Check out the trade show booth catalog and prepare for your trade show participation in an even more efficient way. With this catalog, you will have access to ready-made booth designs that will make it easier for you to prepare for the trade show and gain valuable savings in time and money. By choosing an already ready-made booth design, you will be able to focus on other important aspects of preparing for the fair, such as preparing your offer, arranging transportation or planning your marketing activities.
          ';}
        echo '</p>';
      }
    ?>

    <div class="custom-btn-container">
      <span>
        <?php if($locale == 'pl_PL'){ echo '
          <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="https://warsawexpo.eu/zabudowa-targowa" target="_blank" style="color:white !important;">Zobacz Więcej</a>
        ';} else { echo '
          <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="https://warsawexpo.eu/en/exhibition-stands" target="_blank" style="color:white !important;">See more</a>
        ';} ?>
      </span>

      <span>
        <?php if($locale == 'pl_PL'){ echo '
          <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="https://warsawexpo.eu/katalog-zabudowy" target="_blank" style="color:white !important;">Katalog Zabudowy</a>
        ';} else { echo '
          <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="https://warsawexpo.eu/en/katalog-zabudowy" target="_blank" style="color:white !important;">Exhibition Stand</a>
        ';} ?>
      </span>
    </div>
  </div>

  <div class="custom-block-2 single-media-wrapper half-block-padding custom-min-media-wrapper" style="flex:1;">
    <div class="image-shadow"><div class="t-entry-visual"><img src="/wp-content/plugins/custom-element/my-custom-element/media/zabudowa.jpg" alt="zdjęcie przykładowej zabudowy"/></div></div>
  </div>
</div>