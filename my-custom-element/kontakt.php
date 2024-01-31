<?php
if ($color === '#ffffff'){
    $invert = '.custom_element_'.$rnd_id.' #kontakty img{
      filter: invert(100%);
    }';
}
?>
<style>
    <?php echo $invert ?>

    .raw-custom-container{
        display:flex; 
        align-items: center;
        gap: 18px;
    }
    .custom-container-contact img{
        max-width:150px !important;
    }

    .custom_element_<?php echo $rnd_id ?>  .uncode_text_column :is(p, a),
    .custom_element_<?php echo $rnd_id ?>  .heading-text h4{
        color: <?php echo $color ?> !important;
    }
    .custom-container-contact .main-heading-text {
      padding-top: 0;
    }
    @media (max-width:860px){
        .uncell:has(.custom-container-contact) {
            padding: 36px 18px 36px 18px !important;
        }
        .raw-custom-container{
            flex-wrap: wrap;
            justify-content: center;
            text-align: center;
            flex-direction: column;
        }
        .raw-custom-container p{ 
            min-width: 160px;
        }
    }
<?php
if ($horizontal == "true") {
?>
    .custom-container-contact-items { 
        display: flex; 
        flex-wrap: wrap;
        justify-content: space-evenly;
    }

    .raw-custom-container {
        flex-direction: column;
        text-align: center;
    }
<?php
}
?>
</style>

<div id="kontakty" class="custom-container-contact">
  <div class="heading-text el-text main-heading-text half-block-padding">
    <h4> <?php if($locale == 'pl_PL'){ echo '
      Masz pytania?
      ';} else { echo '
      Do you have any questions?
      ';} ?>
    </h4>
  </div>

  <div class="custom-container-contact-items">
    <div class="raw-custom-container half-block-padding">
      <div class="image-shadow">
        <div class="t-entry-visual">
            <img src="/wp-content/plugins/custom-element/media/WystawcyZ.jpg" alt="grafika wystawcy">
        </div>
      </div>
      <div class="uncode_text_column">
        <p><?php if($locale == 'pl_PL'){ echo '
          Zostań wystawcą<br><a href="tel:48 517 121 906">+48 517 121 906</a>
          ';} else { echo '
          Become an Exhibitor<br><a href="tel:48 517 121 906">+48 517 121 906</a>
          ';} ?>
        </p>
      </div>
    </div>
        
    <div class="raw-custom-container half-block-padding">
      <div class="image-shadow">
        <div class="t-entry-visual">
            <img src="/wp-content/plugins/custom-element/media/Odwiedzajacy.jpg" alt="grafika odwiedzajacy">
        </div>
      </div>
      <div class="uncode_text_column">
        <p><?php if($locale == 'pl_PL'){ echo '
          Odwiedzający<br><a href="tel:48 513 903 628">+48 513 903 628</a>
          ';} else { echo '
          Visitors<br><a href="tel:48 513 903 628">+48 513 903 628</a>
          ';} ?>
        </p>
      </div>
    </div>
    
    <div class="raw-custom-container half-block-padding">
      <div class="image-shadow">
        <div class="t-entry-visual">
            <img src="/wp-content/plugins/custom-element/media/Media.jpg"  alt="grafika media">
        </div>
      </div>
      <div class="uncode_text_column">
        <p><?php if($locale == 'pl_PL'){ echo '
          Współpraca z mediami<br><a href="mailto:media@warsawexpo.eu">media@warsawexpo.eu</a>
          ';} else { echo '
          For Media<br><a href="mailto:media@warsawexpo.eu">media@warsawexpo.eu</a>
          ';} ?>
        </p>
      </div>
    </div>
    
    <div class="raw-custom-container half-block-padding">
      <div class="image-shadow">
        <div class="t-entry-visual">
            <img src="/wp-content/plugins/custom-element/media/WystawcyO.jpg" alt="grafika obsluga">
        </div>
      </div>
      <div class="uncode_text_column">
        <p><?php if($locale == 'pl_PL'){ echo '
          Obsługa Wystawców<br><a href="tel:48 501 239 338">+48 501 239 338</a>
          ';} else { echo '
          Exhibitor service<br><a href="tel:48 501 239 338">+48 501 239 338</a>
          ';} ?>
        </p>
      </div>
    </div>
    
    <div class="raw-custom-container half-block-padding">
      <div class="image-shadow">
        <div class="t-entry-visual">
            <img src="/wp-content/plugins/custom-element/media/Technicy.jpg" alt="grafika technicy">
        </div>
      </div>
      <div class="uncode_text_column" style="overflow-wrap: anywhere;">
        <p><?php 
        if ($horizontal == "true"){ 
            echo '<a href="mailto:konsultanttechniczny@warsawexpo.eu">konsultanttechniczny<span style="display:block;">@warsawexpo.eu</span></a>';
        } else {
            if($locale == 'pl_PL'){ echo '
            Obsługa techniczna wystawców<br><a href="mailto:konsultanttechniczny@warsawexpo.eu">konsultanttechniczny<span style="display:block;">@warsawexpo.eu</span></a>
            ';} else { echo '
            Technical service of exhibitors<br><a href="mailto:konsultanttechniczny@warsawexpo.eu">konsultanttechniczny@warsawexpo.eu</a>
            ';} 
        } ?>
        </p>
      </div>
    </div>
  </div>
    
</div>
