<?php
    $worker_entries = GFAPI::get_entries($worker_form_id);
    $guest_entries = GFAPI::get_entries($guest_form_id);
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $registration_count = 0;
    foreach ($worker_entries as $entry) {
        $entry_ip = rgar($entry, 'ip');
        if ($entry_ip === $ip_address) {
            $registration_count++;
        }
    }
    foreach ($guest_entries as $entry) {
        $entry_ip = rgar($entry, 'ip');
        if ($entry_ip === $ip_address) {
            $registration_count++;
        }
    }
    
    $new_content_check = do_shortcode('[trade_fair_date]') . " " .  do_shortcode('[trade_fair_domainadress]');
    $new_content_array = ['fruitpolandexpo.com', 'roofexpo.pl', '2024', '2025', '2026', '2027', 'nowa', 'new'];
    $new_content = false;
    foreach($new_content_array as $key){
        if(strpos($new_content_check , $key) !== false){
            $new_content = true;
            break;
        } 
    }  
?>

<div class="custom-generator-wystawcow">
    <div class="heading-text register-count">
        <h3>
            <?php if($locale == 'pl_PL'){ echo '
                Wykorzystano '. $registration_count .' z limitu 100 zaproszeń
            '; } else { echo '
                Already used '. $registration_count .' from a total of 100 invitations
            '; } ?>
            
        </h3>
    </div>
    <div class="heading-text">
        <h3>
            <?php if($locale == 'pl_PL'){ echo '
                Jeśli potrzebujesz więcej zaproszeń skontaktuj się z nami!<br>
                Obsługa Wystawców: <a href="tel:+48501239338">+48 501 239 338</a>
            '; } else { echo '
                Contact us for more invites<br>
                Exhibitors support: <a href="tel:+48501239338">+48 501 239 338</a>
            '; } ?>
        </h3>
    </div>
    <div class="container">
        <div class="container-forms">
            <div class="container-info">
                <div class="info-item info-item-left none">
                    <div class="table">
                        <div class="table-cell">
                            <div class="forms-conteiner-form__left active">
                                <h2>
                                    <?php if($locale == 'pl_PL'){
                                        if($new_content){
                                        echo 'WYGENERUJ IDENTYFIKATOR <br> DLA SIEBIE I OBSŁUGI STOISKA';
                                    } else {
                                        echo 'WYGENERUJ IDENTYFIKATOR DLA SIEBIE I SWOICH PRACOWNIKÓW!';
                                    }} else {
                                            echo 'GENERATE AN ID FOR YOURSELF <br> AND YOUR COWORKERS';
                                    }
                                    ?>                    
                                </h2>
                            [gravityform id="<?php echo $worker_form_id ?>" title="false" description="false" ajax="false"]
                            </div>
                        </div>
                    </div>
                </div>
            <div class="info-item info-item-right">
                <div class="table">
                    <div class="table-cell">
                        <h4 class="guest-info">
                            <?php if($locale == 'pl_PL'){ echo '
                                    Goście upoważnieni są do wejścia na teren targów<br> od godziny 10:00
                                </h4>
                                <div class="forms-conteiner-form__right">
                                    <h2>
                                        WYGENERUJ IDENTYFIKATOR DLA SWOICH </br>GOŚCI!
                                    </h2>
                            '; } else { echo '
                                    Visitors are entitled to enter the fairgrounds<br> from 10:00
                                </h4>.
                                <div class="forms-conteiner-form__right">
                                    <h2>
                                        GENERATE AN INVITE FOR YOUR GUESTS!
                                    </h2>
                            '; } ?>
                            [gravityform id="<?php echo $guest_form_id ?>" title="false" description="false" ajax="false"]
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="container-form">
            <div class="form-item form-item-element-left log-in">
                <div class="table">
                <div class="table-cell">
                    <h2>
                    <?php if($locale == 'pl_PL'){
                        if($new_content){
                            echo 'WYGENERUJ IDENTYFIKATOR DLA SIEBIE I OBSŁUGI STOISKA
                            </h2>';
                        } else {
                        echo 'WYGENERUJ IDENTYFIKATOR DLA SIEBIE I SWOICH PRACOWNIKÓW
                        </h2>
                        <h3>
                        JEŚLI CHCESZ ZAPROSIĆ NA WYDARZENIE SWOICH WSPÓŁPRACOWNIKÓW, WYPEŁNIJ FORMULARZ
                        </h3>';
                        }} else {
                        echo 'GENERATE AN ID FOR YOURSELF AND YOUR COWORKERS';
                    } ?>
                    <button class="forms-conteiner-info__btn btn-exh" >
                    <?php if($locale == 'pl_PL'){ echo'
                        KLIKNIJ
                    '; } else { echo '
                        CHANGE
                    '; } ?>
                    </button>
                    <img src="/wp-content/plugins/custom-element/my-custom-element/media/generator-wystawcow/bg.png" />
                </div>
                </div>
            </div>
            <div class="form-item form-item-element-right sign-up">
                <div class="table">
                <div class="table-cell ">
                    <h2>
                    <?php if($locale == 'pl_PL'){ echo'
                        WYGENERUJ IDENTYFIKATOR DLA SWOICH GOŚCI
                    '; } else { echo '
                        GENERATE AN INVITE FOR YOUR GUESTS!
                    '; } ?>
                    </h2>
                    <?php if($locale == 'pl_PL'){
                        if(!$new_content){
                    echo '<h3>
                        JEŚLI CHCESZ ZAPROSIĆ NA WYDARZENIE SWOICH NAJWAŻNIEJSZYCH GOŚCI, KLIENTÓW LUB KONTRACHENTÓW, WYPEŁNIJ FORMULARZ
                    </h3>';
                    }} ?>
                    <button class="forms-conteiner-info__btn  btn-exh">
                    <?php if($locale == 'pl_PL'){ echo'
                        KLIKNIJ
                    '; } else { echo '
                        CHANGE
                    '; } ?>
                    </button>
                    <img src="/wp-content/plugins/custom-element/my-custom-element/media/generator-wystawcow/bg.png" />
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript"> 
    var btnExhElements = document.querySelectorAll(".form-item .btn-exh");

    btnExhElements.forEach(function(btnExhElement) {

        btnExhElement.addEventListener("click", function() {

            var containerElements = document.querySelectorAll(".container");
            var infoItemElements = document.querySelectorAll(".info-item");
            

            containerElements.forEach(function(containerElement) {
            containerElement.classList.toggle("log-in");
            });
            
            infoItemElements.forEach(function(infoItemElement) {
            infoItemElement.classList.toggle("none");
            });
        });
    });

    var registrationCount = <?php echo $registration_count; ?>

    if (registrationCount == 0) {
        document.querySelector(".register-count").style.display = "none";
    }
</script>

