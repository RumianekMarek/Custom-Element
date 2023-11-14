<?php
    $contact_object = substr($contact_object, 3);
    $contact_object = substr($contact_object, 0, -3);
    $contact_object = str_replace("``", '"', $contact_object);
    $contact_object = str_replace("\n", '<br>', $contact_object);
    $contact_object = "[". $contact_object . "]";
    
    $contact_array =  json_decode($contact_object, true);

    $content_array = [];
    foreach($contact_array as $cont){
        $content_array[$cont['id']] = $cont['value'];
    }

?>
<div id="contact-info" class="custom-container-contact">
  <div class="heading-text el-text main-heading-text hal-bloack-padding">
    <h4> <?php if($locale == 'pl_PL'){ echo '
      Obsługa wystawców
      ';} else { echo '
      Exhibitors service
      ';} ?>
    </h4>
  </div>
<?php
    for ($i= 0; $i<$contact_number;$i++){
        if($content_array["imie".$i] && $content_array["email".$i] && $content_array["telefon".$i]){
            echo '<div class="custom-container-contact-info-items">
                <div class="raw-custom-container">
                <div class="half-block-padding">';
            if ($content_array['photo'.$i]){
                echo '<div class="image-shadow"><img width="100px"height="100px" src="'.$content_array['photo'.$i].'" alt="zdjęcie"></div>';
            } else {
                echo '<div class="image-shadow"><img width="100px"height="100px" src="/wp-content/plugins/custom-element/my-custom-element/media/WystawcyO.jpg" alt="zdjęcie"></div>';
            }
                echo '</div>
                <div class="uncode_text_column">';
                if ($i === 0){
                    echo '<p>Kierownik projektu: <b>'.$content_array["imie".$i].'</b></p>';
                } else {
                    echo '<p><b>'.$content_array["imie".$i].'</b></p>';
                }   
                    echo '<p>E-mail: <a href="mailto:'.$content_array["email".$i].'">'.$content_array["email".$i].'</a></p>
                    <p>Tel.: <a href="tel'.$content_array["telefon".$i].'">'.$content_array["telefon".$i].'</a></p>
                </div>
            </div>';
        }
    }
    return $html_content;
?>