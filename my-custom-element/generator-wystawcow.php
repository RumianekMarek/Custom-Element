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
?>

<div class="custom-generator-wystawcow">
    <div class="heading-text register-count">
        <h3>Wykorzystano <?php echo $registration_count ?> z limitu 100 zaproszeń</h3>
    </div>
    <div class="heading-text">
        <h3>
        Jeśli potrzebujesz więcej zaproszeń skontaktuj się z nami!<br>
        Obsługa Wystawców: <a href="tel:+48501239338">+48 501 239 338</a>
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
                        WYGENERUJ IDENTYFIKATOR DLA SIEBIE I SWOICH PRACOWNIKÓW!
                    </h2>
                    [gravityform id="<?php echo $worker_form_id ?>" title="false" description="false" ajax="false"]
                    </div>
                </div>
                </div>
            </div>
            <div class="info-item info-item-right">
                <div class="table">
                <div class="table-cell">
                <h4 class="guest-info">Goście upoważnieni są do wejścia na teren targów<br> od godziny 10:00</h4>
                    <div class="forms-conteiner-form__right">
                    <h2>
                        WYGENERUJ IDENTYFIKATOR DLA SWOICH </br>GOŚCI!
                    </h2>
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
                    WYGENERUJ IDENTYFIKATOR DLA SIEBIE I SWOICH PRACOWNIKÓW
                    </h2>
                    <h3>
                    JEŚLI CHCESZ ZAPROSIĆ NA WYDARZENIE SWOICH WSPÓŁPRACOWNIKÓW, WYPEŁNIJ FORMULARZ
                    </h3>
                    <button class="forms-conteiner-info__btn btn-exh" >
                    KLIKNIJ
                    </button>
                    <img src="/wp-content/plugins/custom-element/my-custom-element/media/generator-wystawcow/bg.png" />
                </div>
                </div>
            </div>
            <div class="form-item form-item-element-right sign-up">
                <div class="table">
                <div class="table-cell ">
                    <h2>
                        WYGENERUJ IDENTYFIKATOR DLA SWOICH GOŚCI
                    </h2>
                    <h3>
                        JEŚLI CHCESZ ZAPROSIĆ NA WYDARZENIE SWOICH NAJWAŻNIEJSZYCH GOŚCI, KLIENTÓW LUB KONTRACHENTÓW, WYPEŁNIJ FORMULARZ
                    </h3>
                    <button class="forms-conteiner-info__btn  btn-exh">
                        KLIKNIJ
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
    // Pobierz wszystkie elementy .btn-exh
    var btnExhElements = document.querySelectorAll(".form-item .btn-exh");

    // Pętla po wszystkich elementach .btn-exh
    btnExhElements.forEach(function(btnExhElement) {
    // Dodaj nasłuchiwanie kliknięcia
        btnExhElement.addEventListener("click", function() {
            // Pobierz wszystkie elementy .container i .info-item
            var containerElements = document.querySelectorAll(".container");
            var infoItemElements = document.querySelectorAll(".info-item");
            
            // Przełącz klasę "log-in" na wszystkich elementach .container
            containerElements.forEach(function(containerElement) {
            containerElement.classList.toggle("log-in");
            });
            
            // Przełącz klasę "none" na wszystkich elementach .info-item
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

