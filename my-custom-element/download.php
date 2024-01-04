<?php 
if ($color != '#000000'){
    $color = '#ffffff !important';
} else {
  $filter ='.custom_element_'.$rnd_id.' #download img{
    filter: invert(100%);
  }';
}
?> 

<style>
#download {
    display:flex;
    align-items: center;
    color:white; 
    border: 0;
    max-width: 500px;
    margin: auto;
}
.custom_element_<?php echo $rnd_id ?> #download :is(h3, a){
  color: <?php echo $color ?>
}
<?php echo $filter ?>

@media (max-width:959px){
    .t-m-display-none{
        display:none;
    }
}
</style>
<div id="download" class="custom-download-container style-accent-bg shadow-black single-block-padding">
  <div class="single-media-wrapper wpb_column t-m-display-none half-block-padding" style="flex:1;">
    <img src="/wp-content/plugins/custom-element/my-custom-element/media/download-icon.png" alt="ikonka pobierania"/>
  </div>
  
  <div style="flex:5">
    <div class="heading-text el-text text-centered">
    <?php if($locale == 'pl_PL') {
      echo '<h3 class="pl_PL">Dokumenty do pobrania:</h3>';
    } else {
      echo '<h3 class="en_US">Documents for Download</h3>';
    } ?>
    </div>

    <div>
      <p class="text-centered">
      <?php if($locale == 'pl_PL') {
        echo '<a href="https://warsawexpo.eu/docs/Regulamin-targow-pwe-2022.pdf" target="_blank" rel="noopener noreferrer">Regulamin targów</a><br>';
        echo '<a href="https://warsawexpo.eu/docs/regulamin_obiektu.pdf" target="_blank" rel="noopener noreferrer">Regulamin obiektu</a><br>';
        echo '<a href="https://warsawexpo.eu/docs/regulamin_zabudowy.pdf" target="_blank" rel="noopener noreferrer">Regulamin zabudowy</a><br>';
        echo '<a href="https://warsawexpo.eu/docs/Regulamin na Voucher_2023.pdf" target="_blank" rel="noopener noreferrer">Regulamin Voucherów</a>';
      } else {
        echo '<a href="https://warsawexpo.eu/docs/regulamin_targ%C3%B3w_2021_en.pdf" target="_blank" rel="noopener noreferrer">Fair regulations</a><br>';
        echo '<a href="https://warsawexpo.eu/docs/regulamin_obiektu_en.pdf" target="_blank" rel="noopener noreferrer">Facility regulations</a><br>';
        echo '<a href="https://warsawexpo.eu/docs/building_regulations.pdf" target="_blank" rel="noopener noreferrer">Building regulations</a>';
      } ?>
        </p> 
    </div> 
  </div>
</div>