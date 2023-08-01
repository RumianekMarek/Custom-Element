
<div id="download" class="custom-download-container style-accent-bg shadow-black single-block-padding">
  <div class="single-media-wrapper wpb_column t-m-display-none half-block-padding" style="flex:1;">
    <img style="filter: saturate(100%);" src="/wp-content/plugins/custom-element/my-custom-element/media/download-icon.png" alt="ikonka pobierania"/>
  </div>
  
  <div style="flex:5">
    <div class="heading-text el-text text-centered">
    <?php if($locale == 'pl_PL') {
      echo '<h3 class="pl_PL" style="color:white !important;">Dokumenty do pobrania:</h3>';
    } else {
      echo '<h3 class="en_US" style="color:white !important;">Documents for Download</h3>';
    } ?>
    </div>

    <div>
      <p>
      <?php if($locale == 'pl_PL') {
        echo '<a style="color:white !important;" href="https://warsawexpo.eu/docs/Regulamin-targow-pwe-2022.pdf" target="_blank" rel="noopener noreferrer">Regulamin targów</a><br>';
        echo '<a style="color:white !important;" href="https://warsawexpo.eu/docs/regulamin_obiektu.pdf" target="_blank" rel="noopener noreferrer">Regulamin obiektu</a><br>';
        echo '<a style="color:white !important;" href="https://warsawexpo.eu/docs/regulamin_zabudowy.pdf" target="_blank" rel="noopener noreferrer">Regulamin zabudowy</a>';
      } else {
        echo '<a style="color:white !important;" href="https://warsawexpo.eu/docs/regulamin_targ%C3%B3w_2021_en.pdf" target="_blank" rel="noopener noreferrer">Fair regulations</a><br>';
        echo '<a style="color:white !important;" href="https://warsawexpo.eu/docs/regulamin_obiektu_en.pdf" target="_blank" rel="noopener noreferrer">Facility regulations</a><br>';
        echo '<a style="color:white !important;" href="https://warsawexpo.eu/docs/building_regulations.pdf" target="_blank" rel="noopener noreferrer">Building regulations</a>';
      } ?>
        </p> 
    </div> 
  </div>
</div>