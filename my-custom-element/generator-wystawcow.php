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
<style>
#customGeneratorWystawcow .heading-text :is(h3, a){
    color: <?php echo $color ?> !important;
}
#customGeneratorWystawcow .heading-text a{
    text-decoration: underline;
}
.custom-generator-wystawcow {
    padding: 18px 0 36px;
}
.custom-generator-wystawcow h2 {
    font-size: 28px !important;
    width: auto !important;
}
.custom-generator-wystawcow .gform_legacy_markup_wrapper .gform_footer input[type=submit] {
    width: auto !important;
}
.custom-generator-wystawcow .gform_footer {
    display: flex;
    justify-content: center;
}
.custom-generator-wystawcow input[type='text'], 
.custom-generator-wystawcow input[type='submit'],
.custom-generator-wystawcow input[type='email'] {
    box-shadow: none !important;
}
.custom-generator-wystawcow input[type="submit"] {
    border-radius: 5px;
    margin: 0 auto 15px;
    width: 150px;
}
.custom-generator-wystawcow input[type="file"] {
    width: 83px !important;
    padding: 2px 0px 2px 2px !important;
}
.custom-generator-wystawcow .gform-body input[type="text"],
.custom-generator-wystawcow .gform-body input[type="email"] {
    padding-left: 45px !important;
    background-color: #D2D2D2 !important;
    border-radius: 5px !important;
    border: none !important;
    font-weight: 700;
    color: #555555;
}
.custom-generator-wystawcow .ginput_container {
    position: relative;
}
.custom-generator-wystawcow .gfield img {
    position: absolute;
    left: 7px;
    top: 9px;
    height: 24px;
}
.custom-generator-wystawcow .gfield_validation_message, 
.custom-generator-wystawcow .gform_submission_error {
    font-size: 12px !important;
    padding: 4px 4px 4px 12px !important;
    margin-top: 2px !important;
}
.custom-generator-wystawcow .gform_submission_error {
    margin: 0 auto;
}
.custom-generator-wystawcow .gform_validation_errors {
    padding: 0 !important;
}
.custom-generator-wystawcow .container-forms h2, 
.custom-generator-wystawcow .container-forms button {
    font-weight: 800;
}
.custom-generator-wystawcow .gform-body {
    padding: 25px 25px 0 25px;
    max-width: 550px;
    margin: 0 auto;
}
.custom-generator-wystawcow .table {
    display: table;
    width: 100%;
    height: 100%;
}
.custom-generator-wystawcow .table-cell {
    display: table-cell;
    vertical-align: middle;
    -moz-transition: all 0.5s;
    -o-transition: all 0.5s;
    -webkit-transition: all 0.5s;
    transition: all 0.5s;
}
.custom-generator-wystawcow .container {
    border-radius: 25px;
    position: relative;
    /* min-width: 800px; */
    max-width: 1200px;
    margin: 30px auto 0;
    height: 680px;
    top: 50%;
    -moz-transition: all 0.5s;
    -o-transition: all 0.5s;
    -webkit-transition: all 0.5s;
    transition: all 0.5s;
}
.custom-generator-wystawcow .container .container-forms {
    position: relative;
}
.custom-generator-wystawcow .container .btn-exh {
    cursor: pointer;
    text-align: center;
    margin: 0 auto;
    border-radius: 15px;
    width: 164px;
    font-size: 24px;
    margin: 12px 0;
    padding: 5px 0;
    color: #fff;
    opacity: 1;
    -moz-transition: all 0.5s;
    -o-transition: all 0.5s;
    -webkit-transition: all 0.5s;
    transition: all 0.5s;
}
.custom-generator-wystawcow .container .btn-exh:hover {
    opacity: 0.7;
}
.custom-generator-wystawcow .container .container-forms .container-info {
    display: flex;
    justify-content: space-between;
    text-align: left;
    width: 100%;
    -moz-transition: all 0.5s;
    -o-transition: all 0.5s;
    -webkit-transition: all 0.5s;
    transition: all 0.5s;
}
.custom-generator-wystawcow .container .container-forms .container-info .info-item {
    text-align: center;
    width: 800px;
    height: 680px;
    display: inline-block;
    vertical-align: top;
    color: #fff;
    opacity: 1;
    -moz-transition: all 0.3s;
    -o-transition: all 0.3s;
    -webkit-transition: all 0.3s;
    transition: all 0.3s;
    background: #EBEBEB;
}
.custom-generator-wystawcow .info-item-left {
    border-radius: 20px 0 0 20px;
}
.custom-generator-wystawcow .info-item-left h2 {
    color: #31572C;
}
.custom-generator-wystawcow .info-item-left .gform_footer input[type="submit"] {
    background-color: #31572C !important;
}
.custom-generator-wystawcow .info-item-right {
    position: absolute;
    right: 0;
    border-radius: 0 20px 20px 0;
}
.custom-generator-wystawcow .info-item-right .gform_footer input[type="submit"] {
    background: #90A955 !important;
}
.custom-generator-wystawcow .info-item-right h2 {
    color: #90A955;
}
.custom-generator-wystawcow .container-info .info-item button, 
.custom-generator-wystawcow .gform_footer input[type="submit"] {
    margin-top: 25px !important;
    color: white !important;
    font-weight: 800;
    font-size: 24px !important;
    border-radius: 15px !important;
    padding: 15px 25px;
    width: 200px;
    box-shadow: none !important;
    cursor: pointer;
    border: none;
}
.custom-generator-wystawcow .container-info .none {
    width: 0px !important;
    overflow: hidden;
}
.custom-generator-wystawcow .form-item img {
    opacity: 0.4;
    position: absolute;
    width: 100%;
    z-index: 0;
    left: 0;
    top: 25%;
}
.custom-generator-wystawcow .form-item h2, 
.custom-generator-wystawcow .form-item h3, 
.custom-generator-wystawcow .form-item button {
    z-index: 100;
    position: relative;
    color: white !important;
}
.custom-generator-wystawcow .form-item h3 {
    font-weight: 400;
    font-size: 18px;
}
.custom-generator-wystawcow .form-item-element-left {
    background-color: #31572C !important;
    border-radius: 20px 0 0 20px;
}
.custom-generator-wystawcow .form-item-element-right {
    background: #90A955 !important;
    border-radius: 0 20px 20px 0;
}
.custom-generator-wystawcow .container .container-forms .container-info .info-item .btn-exh {
    background-color: transparent;
    border: 1px solid #fff;
}
.custom-generator-wystawcow .container .container-forms .container-info .info-item .table-cell {
    padding-right: 0;
}
.custom-generator-wystawcow .container .container-forms .container-info .info-item:nth-child(2) .table-cell {
    padding-left: 70px;
    padding-right: 0;
}
.custom-generator-wystawcow .container .container-form {
    overflow: hidden;
    position: absolute;
    left: 0px;
    top: 0px;
    width: 400px;
    height: 680px;
    -moz-transition: all 0.5s;
    -o-transition: all 0.5s;
    -webkit-transition: all 0.5s;
    transition: all 0.5s;
}
.custom-generator-wystawcow .container .form-item {
    padding: 25px;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    opacity: 1;
    -moz-transition: all 0.5s;
    -o-transition: all 0.5s;
    -webkit-transition: all 0.5s;
    transition: all 0.5s;
    color: white !important;
    text-align: center;
}
.custom-generator-wystawcow .container .form-item.sign-up {
    position: absolute;
    opacity: 0;
}
.custom-generator-wystawcow .container.log-in .container-form {
    left: 800px;
}
.custom-generator-wystawcow .container.log-in .container-form .form-item.sign-up {
    left: 0;
    opacity: 1;
}
.custom-generator-wystawcow .container.log-in .container-form .form-item.log-in {
    left: -100%;
}
.custom-generator-wystawcow .forms-conteiner-info__btn {
    margin-top: 50px !important;
    background-color: transparent;
    border: 2px solid white;
}
.custom-generator-wystawcow .heading-text {
    text-align: center;
    padding: 18px 0;
}
.custom-generator-wystawcow .heading-text h3 {
    margin: 0 auto;
    color: #000000 !important;
}
.custom-generator-wystawcow .guest-info {
    width: 80% !important;
    margin: 0 auto;
    color: #000000 !important;
}
.custom-tech-support-text {
    padding-top: 36px !important;
}
@media (max-width:1200px) {
    .custom-generator-wystawcow .container {
        max-width: 900px !important;
    }
    .custom-generator-wystawcow .container .container-forms .container-info .info-item {
        width: 600px;
    }
    .custom-generator-wystawcow .container .container-form {
        width: 300px;
    }
    .custom-generator-wystawcow .container.log-in .container-form {
        left: 600px;
    }
    .custom-generator-wystawcow .row-container:has(.gform_wrapper, .custom-container-grupy) .wpb_column,
    .custom-generator-wystawcow .row-container:has(.drive, .area) .wpb_column {
        max-width: 100% !important;
    }
    .custom-generator-wystawcow .container .container-forms .container-info .info-item .table-cell {
        padding-right: 0px !important;
    }
}
@media (max-width:900px) {
    .custom-generator-wystawcow .container {
        max-width: none !important;
        margin: 15px auto 0;
        height: 1080px;
    }
    .custom-generator-wystawcow .container .container-form {
        width: 100%;
        height: 380px;

    }

    .custom-generator-wystawcow .container .container-forms .container-info .info-item {
        position: absolute;
        top: 350px;
        width: 100%;
        height: 730px;
        padding-top: 40px;
    }

    .custom-generator-wystawcow .container .container-form {
        width: 100%;
    }

    .custom-generator-wystawcow .container.log-in .container-form {
        left: 0px;
    }
    .custom-generator-wystawcow .row-container:has(.gform_wrapper, .custom-container-grupy) .row-parent {
        padding: 0px 0px 0px 0px !important;
    }
    .custom-generator-wystawcow .info-item-left, 
    .custom-generator-wystawcow .container, 
    .custom-generator-wystawcow .info-item-right, 
    .custom-generator-wystawcow .form-item-element-left, 
    .custom-generator-wystawcow .form-item-element-right {
        border-radius: 0px !important;
    }
    .custom-generator-wystawcow .forms-conteiner-info__btn {
        margin-top:10px !important;
    }
    .custom-generator-wystawcow .container .container-forms .container-info .info-item:nth-child(2) .table-cell {
        padding-left: 0px !important; 
        padding-right: 0;
    }
}
@media (max-width:400px) {
    .custom-generator-wystawcow h2 {
        font-size: 24px !important;
    }
    .custom-generator-wystawcow .heading-text h3 {
        font-size: 18px;
    }
}
.custom-generator-wystawcow input{
    background-repeat: no-repeat;
    background-size: 30px;
    background-position: 5px;
}
.custom-generator-wystawcow :is(input[placeholder="IMIĘ I NAZWISKO (PRACOWNIKA)"], input[placeholder="IMIĘ I NAZWISKO (GOŚCIA)"], input[placeholder="NAME AND SURNAME (GUEST)"], input[placeholder="NAME AND SURNAME (EMPLOYEE)"], input[placeholder="NAME AND SURNAME"]) {
    background-image: url("/wp-content/plugins/custom-element/media/generator-wystawcow/name.png");
}
.custom-generator-wystawcow input[placeholder="FIRMA ZAPRASZAJĄCA"], 
.custom-generator-wystawcow input[placeholder="FIRMA"], 
.custom-generator-wystawcow input[placeholder="INVITING COMPANY"], 
.custom-generator-wystawcow input[placeholder="COMPANY"] {
    background-image: url("/wp-content/plugins/custom-element/media/generator-wystawcow/box.png");
}
.custom-generator-wystawcow input[placeholder="E-MAIL OSOBY ZAPRASZANEJ"],
.custom-generator-wystawcow input[placeholder="E-MAIL OF THE INVITED PERSON"],
.custom-generator-wystawcow input[placeholder="E-MAIL"] {
    background-image: url("/wp-content/plugins/custom-element/media/generator-wystawcow/email.png");
}
.custom-generator-wystawcow input:-webkit-autofill,
.custom-generator-wystawcow input:-webkit-autofill:hover,
.custom-generator-wystawcow input:-webkit-autofill:focus {
  -webkit-text-fill-color: #555555 !important;
  -webkit-box-shadow: 0 0 0px 40rem #D2D2D2 inset !important;
  transition: background-color 5000s ease-in-out 0s;
}

</style>
<div id="customGeneratorWystawcow" class="custom-generator-wystawcow">
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
                    <img src="/wp-content/plugins/custom-element/media/generator-wystawcow/bg.png" />
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
                    <img src="/wp-content/plugins/custom-element/media/generator-wystawcow/bg.png" />
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="heading-text custom-tech-support-text">
        <h3>
            <?php if($locale == 'pl_PL'){ echo '
                Potrzebujesz pomocy?<br>
                Skontaktuj się z nami - <a href="mailto:info@warsawexpo.eu">info@warsawexpo.eu</a>
            '; } else { echo '
                Need help?<br>
                Contact us - <a href="mailto:info@warsawexpo.eu">info@warsawexpo.eu</a>
            '; } ?>
        </h3>
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

    if (document.querySelector('html').lang === "pl-PL") {
        const companyNameInput = document.querySelector('.forms-conteiner-form__left input[placeholder="FIRMA ZAPRASZAJĄCA"]');
        const companyEmailInput = document.querySelector('.forms-conteiner-form__left input[placeholder="E-MAIL OSOBY ZAPRASZANEJ"]');
        if (companyNameInput && companyEmailInput) {
            companyNameInput.placeholder = 'FIRMA';
            companyEmailInput.placeholder = 'E-MAIL';
        }
    } else {
        const companyNameInputEn = document.querySelector('.forms-conteiner-form__left input[placeholder="INVITING COMPANY"]');
        const companyEmailInputEn = document.querySelector('.forms-conteiner-form__left input[placeholder="E-MAIL OF THE INVITED PERSON"]');
        if (companyNameInputEn && companyEmailInputEn) {
            companyNameInputEn.placeholder = 'COMPANY';
            companyEmailInputEn.placeholder = 'E-MAIL';
        }
    }

</script>

