<?php
if ($horizontal == "true") {
?>
  <style>
    .custom-container-contact-items { 
      display: flex; 
      flex-wrap: wrap;
      justify-content: space-around;
    }
    .raw-custom-container {
      flex-direction: column;
      text-align: center;
      width: 33%;
    }
    .custom-container-contact a {
      font-size: 15px;
    }
    @media (max-width:960px) {
      .contact-section .image-shadow {
        max-width: 95px !important;
        margin: 0 auto;
      }
      .contact-item {
        text-align: center;  
      }
      .raw-custom-container {
        width: 100%;
      }
      .uncell:has(.custom-container-contact) {
        padding: 36px 18px 36px 18px !important;
      }
      .row:has(.custom-container-contact) {
        max-width: 627px;
        margin: 0 auto;
      }
    }
    @media (max-width:600px) {
      .row:has(.custom-container-contact) {
        padding: 36px 18px !important;
      }
    }
    @media (max-width: 480px) {
      .contact-item p {
        font-size: 14px;
      }
      .contact-section .single-block-padding {
        padding: 18px !important;  
      }
    }
    @media (max-width: 420px) {
      .contact-item p {
        font-size: 13px;
      }
      .custom-container-contact a {
      font-size: 13px;
    }
      
    }
  </style>
<?php
}
?>

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
    <div class="raw-custom-container">
      <div class="half-block-padding">
        <div class="image-shadow"><img src="/wp-content/plugins/custom-element/my-custom-element/media/WystawcyZ.jpg" alt="grafika wystawcy"></div>
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
        
    <div class="raw-custom-container">
      <div class="half-block-padding">
        <div class="image-shadow"><img src="/wp-content/plugins/custom-element/my-custom-element/media/Odwiedzajacy.jpg" alt="grafika odwiedzajacy"></div>
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
    
    <div class="raw-custom-container">
      <div class="half-block-padding">
        <div class="image-shadow"><img src="/wp-content/plugins/custom-element/my-custom-element/media/Media.jpg"  alt="grafika media"></div>
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
    
    <div class="raw-custom-container">
      <div class="half-block-padding">
        <div class="image-shadow"><img src="/wp-content/plugins/custom-element/my-custom-element/media/WystawcyO.jpg" alt="grafika obsluga"></div>
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
    
    <div class="raw-custom-container">
      <div class="half-block-padding">
        <div class="image-shadow"><img src="/wp-content/plugins/custom-element/my-custom-element/media/Technicy.jpg" alt="grafika technicy"></div>
      </div>
      <div class="uncode_text_column" style="overflow-wrap: anywhere;">
        <p><?php if($locale == 'pl_PL'){ echo '
          Obsługa techniczna wystawców<br><a href="mailto:konsultanttechniczny@warsawexpo.eu">konsultanttechniczny@warsawexpo.eu</a>
          ';} else { echo '
          Technical service of exhibitors<br><a href="mailto:konsultanttechniczny@warsawexpo.eu">konsultanttechniczny@warsawexpo.eu</a>
          ';} ?>
        </p>
      </div>
    </div>
  </div>
    
</div>
