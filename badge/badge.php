<?php 
// function rozpocznij_sesje() {
//   if (!session_id()) {
//       session_start();
//   }
// }
add_action('init', 'rozpocznij_sesje');
function register_custom_badge_element() {
  vc_map(array(
      'name' => __('Custom Badge', 'my-custom-plugin'),
      'base' => 'custom_badge',
      'category' => __('My Elements', 'my-custom-plugin'),
      'params' => array(
        array(
          'type' => 'textfield',
          'heading' => __('Nazwa Identyfikatora', 'my-custom-plugin'),
          'param_name' => 'identyfikator',
          'value' => '',
          'description' => __('Wprowadź nazwe identyfikatora do pliku pdf.', 'my-custom-plugin')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Użytkownik', 'my-custom-plugin'),
            'param_name' => 'user',
            'value' => '',
            'description' => __('Wprowadź użytkownika.', 'my-custom-plugin')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Hasło', 'my-custom-plugin'),
            'param_name' => 'password',
            'value' => '',
            'description' => __('Wprowadź hasło.', 'my-custom-plugin')
        )
      )
  ));
}

function custom_badge_element_output($atts){
    // Domyślne wartości dla parametrów
    $atts = shortcode_atts(array(
      'user' => '',
      'password' => '',
      'identyfikator' => '',
    ), $atts, 'custom_badge');

    $locale = get_locale();

    $url_token = false;
    $registered = "";
    $sesion_entry_data = '';

    if (isset($_GET['token'])) {
        $token = $_GET['token'];
        $jsonFilePath = __DIR__ . '/badge_users.json'; // Zmień na rzeczywistą ścieżkę do pliku JSON.
        $jsonData = json_decode(file_get_contents($jsonFilePath));
        foreach($jsonData as $key => $value){
            if ($key === $token) {
              $url_token = $value;
            }
        }
    }

    $token = wp_create_nonce('my_custom_form_token'); // Generowanie tokenu
    $domain = do_shortcode('[trade_fair_domainadress]');
    ?>
    <div id="identifiers" class="col-lg-12 wpb_column">
        <div class="col-lg-4 wpb_column">
            <div id="id-description">
                <p>Jeżeli już jesteś zarejestrowany/a na naszej stronie a potrzebujesz zaproszenia w formie papierowej? Wypełnij formularz.</p>
                <hr class="single-padding">
                <h2 class="text-uppercase">Masz pytania?</h2>
                <h5 class="text-uppercase">Obsługa odwiedzających<br>
                    <a href="tel:+48513903628">+48 513 903 628</a></h5>
                <h5 class="text-uppercase">Obsługa wystawców<br>
                    <a href="tel:+48501239338">+48 501 239 338</a></h5>
                <h5 class="text-uppercase">Współpraca z mediami<br>
                    <a href="mailto:media@warsawexpo.eu">media@warsawexpo.eu</a></h5><br>
                <img src="/doc/logo-pwe.png" style="width:200px;">
            </div>
        </div>

        <div class="col-lg-8 wpb_column">
            <?php if ($url_token != false){
                echo '<h2 class="text-centered" style="color:white";>Generator wewnętrzny <br>'.$url_token.'</h2>';
            } ?>
            <div id="form-section">
                <form id="custom-form" action="" method="post">
                    <input type="text" id="full_name" name="full_name" placeholder="Imię i Nazwisko / Full name" required>
                    <input type="text" id="firm" name="firm" placeholder="Firm / Comapny name" required>

                    <input type="email" id="email" name="email" placeholder="E-mail" required>
                    <input type="text" id="adres" name="adres" placeholder="Adres / Adress"required>

                    <div class="two-column">
                        <input type="text" id="miasto" name="miasto" placeholder="Miasto / City"required>
                        <input type="text" id="kod" name="kod" placeholder="Kod pocztowy / Zip code" required>
                    </div>
                
                    <div class="two-column">
                        <select id='panstwo' name='panstwo' required>
                            <option value='Afganistan' >Afganistan</option><option value='Albania' >Albania</option><option value='Algieria' >Algieria</option><option value='Andora' >Andora</option><option value='Angola' >Angola</option><option value='Anguilla' >Anguilla</option><option value='Antarktyda' >Antarktyda</option><option value='Antigua i Barbuda' >Antigua i Barbuda</option><option value='Arabia Saudyjska' >Arabia Saudyjska</option><option value='Argentyna' >Argentyna</option><option value='Armenia' >Armenia</option><option value='Aruba' >Aruba</option><option value='Australia' >Australia</option><option value='Austria' >Austria</option><option value='Azerbejdżan' >Azerbejdżan</option><option value='Bahamy' >Bahamy</option><option value='Bahrajn' >Bahrajn</option><option value='Bangladesz' >Bangladesz</option><option value='Barbados' >Barbados</option><option value='Belgia' >Belgia</option><option value='Belize' >Belize</option><option value='Benin' >Benin</option><option value='Bermudy' >Bermudy</option><option value='Bhutan' >Bhutan</option><option value='Białoruś' >Białoruś</option><option value='Boliwia' >Boliwia</option><option value='Bonaire, St Eustatius i Saba' >Bonaire, St Eustatius i Saba</option><option value='Botswana' >Botswana</option><option value='Bośnia i Hercegowina' >Bośnia i Hercegowina</option><option value='Brazylia' >Brazylia</option><option value='Brunei Darussalam' >Brunei Darussalam</option><option value='Brytyjskie Terytorium Oceanu Indyjskiego' >Brytyjskie Terytorium Oceanu Indyjskiego</option><option value='Burkina Faso' >Burkina Faso</option><option value='Burundi' >Burundi</option><option value='Bułgaria' >Bułgaria</option><option value='Chile' >Chile</option><option value='Chiny' >Chiny</option><option value='Chorwacja' >Chorwacja</option><option value='Curaçao' >Curaçao</option><option value='Cypr' >Cypr</option><option value='Czad' >Czad</option><option value='Czarnogóra' >Czarnogóra</option><option value='Czechy' >Czechy</option><option value='Dania' >Dania</option><option value='Demokratyczna Republika Kongo' >Demokratyczna Republika Kongo</option><option value='Dominikana' >Dominikana</option><option value='Dominikana, Republika' >Dominikana, Republika</option><option value='Dżibuti' >Dżibuti</option><option value='Egipt' >Egipt</option><option value='Ekwador' >Ekwador</option><option value='Erytrea' >Erytrea</option><option value='Estonia' >Estonia</option><option value='Eswatini (Suazi)' >Eswatini (Suazi)</option><option value='Etiopia' >Etiopia</option><option value='Falklandy' >Falklandy</option><option value='Fidżi' >Fidżi</option><option value='Filipiny' >Filipiny</option><option value='Finlandia' >Finlandia</option><option value='Francja' >Francja</option><option value='Francuskie Terytoria Południowe' >Francuskie Terytoria Południowe</option><option value='Gabon' >Gabon</option><option value='Gambia' >Gambia</option><option value='Ghana' >Ghana</option><option value='Gibraltar' >Gibraltar</option><option value='Grecja' >Grecja</option><option value='Grenada' >Grenada</option><option value='Grenlandia' >Grenlandia</option><option value='Gruzja' >Gruzja</option><option value='Gruzja Południowa' >Gruzja Południowa</option><option value='Guam' >Guam</option><option value='Guernsey' >Guernsey</option><option value='Gujana' >Gujana</option><option value='Gujana Francuska' >Gujana Francuska</option><option value='Gwadelupa' >Gwadelupa</option><option value='Gwatemala' >Gwatemala</option><option value='Gwinea' >Gwinea</option><option value='Gwinea Bissau' >Gwinea Bissau</option><option value='Gwinea Równikowa' >Gwinea Równikowa</option><option value='Haiti' >Haiti</option><option value='Hiszpania' >Hiszpania</option><option value='Holandia' >Holandia</option><option value='Honduras' >Honduras</option><option value='Hongkong' >Hongkong</option><option value='Indie' >Indie</option><option value='Indonezja' >Indonezja</option><option value='Irak' >Irak</option><option value='Iran' >Iran</option><option value='Irlandia' >Irlandia</option><option value='Islandia' >Islandia</option><option value='Izrael' >Izrael</option><option value='Jamajka' >Jamajka</option><option value='Japonia' >Japonia</option><option value='Jemen' >Jemen</option><option value='Jersey' >Jersey</option><option value='Jordania' >Jordania</option><option value='Kajmany' >Kajmany</option><option value='Kambodża' >Kambodża</option><option value='Kamerun' >Kamerun</option><option value='Kanada' >Kanada</option><option value='Katar' >Katar</option><option value='Kazachstan' >Kazachstan</option><option value='Kenia' >Kenia</option><option value='Kirgistan' >Kirgistan</option><option value='Kiribati' >Kiribati</option><option value='Kolumbia' >Kolumbia</option><option value='Komory' >Komory</option><option value='Kongo, Republika' >Kongo, Republika</option><option value='Korea Południowa' >Korea Południowa</option><option value='Korea Północna' >Korea Północna</option><option value='Kostaryka' >Kostaryka</option><option value='Kuba' >Kuba</option><option value='Kuwejt' >Kuwejt</option><option value='Laotańska Republika Ludowo-Demokratyczna' >Laotańska Republika Ludowo-Demokratyczna</option><option value='Lesoto' >Lesoto</option><option value='Liban' >Liban</option><option value='Liberia' >Liberia</option><option value='Libia' >Libia</option><option value='Liechtenstein' >Liechtenstein</option><option value='Litwa' >Litwa</option><option value='Luksemburg' >Luksemburg</option><option value='Macedonia' >Macedonia</option><option value='Madagaskar' >Madagaskar</option><option value='Majotta' >Majotta</option><option value='Makau' >Makau</option><option value='Malawi' >Malawi</option><option value='Malediwy' >Malediwy</option><option value='Malezja' >Malezja</option><option value='Mali' >Mali</option><option value='Malta' >Malta</option><option value='Mariany Północne' >Mariany Północne</option><option value='Maroko' >Maroko</option><option value='Martynika' >Martynika</option><option value='Mauretania' >Mauretania</option><option value='Mauritius' >Mauritius</option><option value='Meksyk' >Meksyk</option><option value='Mikronezja' >Mikronezja</option><option value='Mjanma' >Mjanma</option><option value='Monako' >Monako</option><option value='Mongolia' >Mongolia</option><option value='Montserrat' >Montserrat</option><option value='Mozambik' >Mozambik</option><option value='Mołdawia' >Mołdawia</option><option value='Namibia' >Namibia</option><option value='Nauru' >Nauru</option><option value='Nepal' >Nepal</option><option value='Niemcy' >Niemcy</option><option value='Niger' >Niger</option><option value='Nigeria' >Nigeria</option><option value='Nikaragua' >Nikaragua</option><option value='Niue' >Niue</option><option value='Norwegia' >Norwegia</option><option value='Nowa Kaledonia' >Nowa Kaledonia</option><option value='Nowa Zelandia' >Nowa Zelandia</option><option value='Oman' >Oman</option><option value='Pakistan' >Pakistan</option><option value='Palau' >Palau</option><option value='Palestyna' >Palestyna</option><option value='Panama' >Panama</option><option value='Papua Nowa Gwinea' >Papua Nowa Gwinea</option><option value='Paragwaj' >Paragwaj</option><option value='Peru' >Peru</option><option value='Pitcairn' >Pitcairn</option><option value='Polinezja Francuska' >Polinezja Francuska</option><option value='Polska' selected='selected'>Polska</option><option value='Portoryko' >Portoryko</option><option value='Portugalia' >Portugalia</option><option value='Południowa Afryka' >Południowa Afryka</option><option value='Republika Afryki Środkowej' >Republika Afryki Środkowej</option><option value='Republika Zielonego Przylądka' >Republika Zielonego Przylądka</option><option value='Reunion' >Reunion</option><option value='Rosja' >Rosja</option><option value='Rumunia' >Rumunia</option><option value='Rwanda' >Rwanda</option><option value='Sahara Zachodnia' >Sahara Zachodnia</option><option value='Saint Kitts i Nevis' >Saint Kitts i Nevis</option><option value='Saint Lucia' >Saint Lucia</option><option value='Saint Pierre i Miquelon' >Saint Pierre i Miquelon</option><option value='Saint Vincent i Grenadyny' >Saint Vincent i Grenadyny</option><option value='Saint-Barthélemy' >Saint-Barthélemy</option><option value='Saint-Martin' >Saint-Martin</option><option value='Salwador' >Salwador</option><option value='Samoa' >Samoa</option><option value='Samoa Amerykańska' >Samoa Amerykańska</option><option value='San Marino' >San Marino</option><option value='Senegal' >Senegal</option><option value='Serbia' >Serbia</option><option value='Seszele' >Seszele</option><option value='Sierra Leone' >Sierra Leone</option><option value='Singapur' >Singapur</option><option value='Sint Maarten' >Sint Maarten</option><option value='Somalia' >Somalia</option><option value='Sri Lanka' >Sri Lanka</option><option value='Stany Zjednoczone' >Stany Zjednoczone</option><option value='Stolica Apostolska' >Stolica Apostolska</option><option value='Sudan' >Sudan</option><option value='Sudan Południowy' >Sudan Południowy</option><option value='Surinam' >Surinam</option><option value='Syria' >Syria</option><option value='Szwajcaria' >Szwajcaria</option><option value='Szwecja' >Szwecja</option><option value='Słowacja' >Słowacja</option><option value='Słowenia' >Słowenia</option><option value='Tadżykistan' >Tadżykistan</option><option value='Tajlandia' >Tajlandia</option><option value='Tajwan' >Tajwan</option><option value='Tanzania' >Tanzania</option><option value='Timor-Leste' >Timor-Leste</option><option value='Togo' >Togo</option><option value='Tokelau' >Tokelau</option><option value='Tonga' >Tonga</option><option value='Trynidad i Tobago' >Trynidad i Tobago</option><option value='Tunezja' >Tunezja</option><option value='Turcja' >Turcja</option><option value='Turkmenistan' >Turkmenistan</option><option value='Tuvalu' >Tuvalu</option><option value='US Minor Outlying Islands' >US Minor Outlying Islands</option><option value='Uganda' >Uganda</option><option value='Ukraina' >Ukraina</option><option value='Urugwaj' >Urugwaj</option><option value='Uzbekistan' >Uzbekistan</option><option value='Vanuatu' >Vanuatu</option><option value='Wallis i Futuna' >Wallis i Futuna</option><option value='Wenezuela' >Wenezuela</option><option value='Wietnam' >Wietnam</option><option value='Wybrzeże Kości Słoniowej' >Wybrzeże Kości Słoniowej</option><option value='Wyspa Bożego Narodzenia' >Wyspa Bożego Narodzenia</option><option value='Wyspa Man' >Wyspa Man</option><option value='Wyspa Norfolk' >Wyspa Norfolk</option><option value='Wyspa Świętej Heleny' >Wyspa Świętej Heleny</option><option value='Wyspy Alandzkie' >Wyspy Alandzkie</option><option value='Wyspy Bouvet' >Wyspy Bouvet</option><option value='Wyspy Cooka' >Wyspy Cooka</option><option value='Wyspy Dziewicze, U.S.A.' >Wyspy Dziewicze, U.S.A.</option><option value='Wyspy Dziewicze, Wielka Brytania' >Wyspy Dziewicze, Wielka Brytania</option><option value='Wyspy Heard i McDonalda' >Wyspy Heard i McDonalda</option><option value='Wyspy Kokosowe' >Wyspy Kokosowe</option><option value='Wyspy Marshalla' >Wyspy Marshalla</option><option value='Wyspy Owcze' >Wyspy Owcze</option><option value='Wyspy Salomona' >Wyspy Salomona</option><option value='Wyspy Svalbard i Jan Mayen' >Wyspy Svalbard i Jan Mayen</option><option value='Wyspy Turks i Caicos' >Wyspy Turks i Caicos</option><option value='Wyspy Świętego Tomasza i Książęca' >Wyspy Świętego Tomasza i Książęca</option><option value='Węgry' >Węgry</option><option value='Włochy' >Włochy</option><option value='Zambia' >Zambia</option><option value='Zimbabwe' >Zimbabwe</option><option value='Zjednoczone Emiraty Arabskie' >Zjednoczone Emiraty Arabskie</option><option value='Zjednoczone Królestwo' >Zjednoczone Królestwo</option><option value='Łotwa' >Łotwa</option>                           
                        </select>
                        <?php if ($url_token != false){ echo '
                        <select type="text" id="client_status" name="client_status" placeholder="client status" required>
                            <option value="gosc_a6" >Gość</option>
                            <option value="vipgold_a6" >Vip</option>
                        </select>
                        <select type="text" id="client_status" name="client_status" placeholder="client status" required>
                            <option value="Dzial1" >Dzial1</option>
                            <option value="Diaal2" >Dzial2</option>
                        </select>
                    </div>
                    <div class="checkboxy"><input type="checkbox" name="email_id" id="email_id">
                        <label for="checkbox1">Identyfikator Emailem</label>
                        <input type="checkbox" name="paper_id" id="paper_id" checked>
                        <label for="checkbox2">Identyfikator Papierowy</label>
                    </div>';
                        } else {echo '</div>'; }?>
                    <input type="hidden" name="token" value="' . $token . '">
                    <input type="submit" name="submit" value="Wyślij" id="modal-submit-button">

                    <div id="custom-modal" style="display: none;" class="modal">
                        <div class="modal-content">
                            <p>Imie i Nazwisko - <span id="full_name_check"></span></p>
                            <p>Nazwa Firmy - <span id="firm_check"></span></p>
                            <p>Email - <span id="email_check"></span></p>
                            <p>Adres - <span id="adres_check"></span></p>
                            <p>Miasto - <span id="miasto_check"></span></p>
                            <p>Kod pocztowy - <span id="kod_check"></span></p>
                            <p>Państwo - <span id="panstwo_check"></p>
                            <p>Czy na pewno chcesz wysłać dane?</p>
                            <button class="modal-button" id="change-form">Popraw</button>
                            <button class="modal-button" id="submit-form" name="submit">Zatwierdz</button>
                        </div>
                    </div>
                </form>
            </div>

            <div id="text-section" class="text-centered single-block-padding" style="display: none;">
                <h2>Twoja prośba o identyfikator zaostała przekazana do realizacji</h2>';
                <p>&nbsp;</p>
            </div>
        </div>
    </div>

  <?php
  
  if (isset($_POST["submit"]) && isset($_POST['token']) && wp_verify_nonce($_POST['token'], 'my_custom_form_token')) {
    $full_name = trim($_POST["full_name"]);
    $firm = trim($_POST["firm"]);
    $email = trim($_POST["email"]);
    $adres= trim($_POST["adres"]);
    $miasto = trim($_POST["miasto"]);
    $kod = trim($_POST["kod"]);
    $panstwo = trim($_POST["panstwo"]);
    if ($url_token != false){
      $user_id = $url_token;
      $vip = trim($_POST["client_status"]);
      $email_id = $_POST["email_id"];
      $paper_id = $_POST["paper_id"];
    } else {
      $user_id = $vip = $email_id = $paper_id = '';
    }

    $entry_data = array(
      'form_id' => '',
      '1' => $email,
      '2' => $adres,
      '3' => $miasto,
      '4' => $kod,
      '5' => $panstwo,
      '6' => $full_name,
      '7' => $firm,
      '8' => '',
      '9' => $user_id,
      '10' => $vip,
      '11' => $email_id,
      '12' => $paper_id,
      // Dodaj inne pola.
    );

    // if ($user_id != '' && $registered == ''){
    //   Inside_badge($email, $entry_data, $atts, $registered);
    // } else {
    //   Give_me_badge_check($email, $entry_data, $atts);
    // }
    echo'<script>
            document.querySelector("#form-section").style.display = "none";
            document.querySelector("#text-section").style.display = "block";
        </script>';
  }
}

function Send_email_replay($name, $mail){
  
  $subject = "Potwierdzenie prosby o identyfikator papierowy";
  
  // Wczytanie pliku z treścią emaila
  $file_path = dirname(__FILE__) . '/email_template.html'; 
  $message = file_get_contents($file_path);
  
  $message = do_shortcode($message);
  $message = str_replace("{Imię i nazwisko}", $name, $message); 
  
  $domain = do_shortcode('[trade_fair_domainadress]');
  $headers = "From: rejestracja@" . $domain . "\r\n";
  $headers .= "Reply-To: rejestracja@" . $domain . "\r\n";
  $headers .= "Content-Type: text/html\r\n"; // Ustawienie treści jako HTML
  $headers .= "Date: " . date("D, d M Y H:i:s") . " UT\r\n"; // Dodanie nagłówka Date

  if (mail($mail, $subject, $message, $headers)) {
  } else {
    error_log("Wystąpił błąd podczas wysyłania emaila.");
  }
}

function Send_form_data($form_data, $vip, $atts){
  
  // Pobierz wartości parametrów
  $user = $atts['user'];
  $password = $atts['password'];

  $json_entry_data = json_encode($entry_data);  

  $options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query(array('json_data' => $json_entry_data)),
    ),
  );

  $parsed_content = [];
  parse_str($options['http']['content'], $parsed_content);

  if (isset($parsed_content['json_data'])) {
    $parsed_content['json_data'] = json_encode(json_decode($parsed_content['json_data'], true), JSON_PRETTY_PRINT);
  }

  $options['http']['content'] = $parsed_content;

  // Replace with your database credentials
  $db_host = "localhost";
  $db_username = $user;
  $db_password = $password;
  $db_name = $user;

  // Create a database connection
  $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Sanitize and validate data
  $data_curent = date('Y-m-d H:i:s');
  $www = do_shortcode('[trade_fair_domainadress]');
  $status = 'new';
  if ($vip == 'vip'){$vip = 'gosc_a6';}
  $typ_badge = $vip;
  $full_name = $form_data[6];
  $firm = $form_data[7];
  $email = $form_data[1];
  $adres = $form_data[2];
  $miasto = $form_data[3];
  $kod = $form_data[4];
  $panstwo = $form_data[5];
  $qr_url = $form_data[8];
  
  // Prepare and execute an SQL insert query
  $sql = "INSERT INTO give_me_badge (data_curent, status, www, typ_badge, name, firm, email, ulica, miasto, kod_pocztowy, country, qr_url) 
                VALUES ('$data_curent', '$status', '$www','$typ_badge','$full_name', '$firm', '$email', '$adres', '$miasto', '$kod', '$panstwo', '$qr_url')";

  if ($conn->query($sql) !== TRUE) {
    error_log("Error: " . $sql . "<br>" . $conn->error);
  }
  Send_email_replay($full_name, $email);

// Close the database connection
  $conn->close();
}

function get_entry_meta($form_id){

}
function Get_all_forms($email_search, $qr_array, &$vip, $full_name){
  
  $entry_return = '';
  // Załaduj plik z klasą GFAPI, jeśli nie jest jeszcze załadowany
  if (class_exists('GFAPI')) {
    // Pobierz listę wszystkich formularzy
    $forms = GFAPI::get_forms();
    
    foreach ($forms as $form) {
      if (strpos(strtolower($form['title']), 'napisz') === false && strpos(strtolower($form['title']), 'write') === false && strpos(strtolower($form['title']), 'katalog') === false && strpos(strtolower($form['title']), 'zostań') === false){
            $entries = GFAPI::get_entries($form['id'],null,null,array( 'offset' => 0, 'page_size' => 0 ));
        
        foreach ($entries as $entry) {
          $form_fields = GFAPI::get_form($form['id']);
          
          foreach ($form_fields['fields'] as $field) {
            
            if (rgar($entry, $field->id) === $email_search) {
              $field_value = rgar($entry, $field->id);
              
              for ($i = 0; $i < 200; $i++) {
                $meta_key = 'qr-code_feed_' . $i . '_url';
                
                if (gform_get_meta($entry['id'], $meta_key) !== false && !in_array(gform_get_meta($entry['id'], $meta_key), $qr_array)) {
                  $entry_return = gform_get_meta($entry['id'], $meta_key);
                  if (strpos(strtolower($form['title']), 'aktywacj') !== false){
                    $vip = 'vipgold_a6';
                    return $entry_return;
                  }
                }
              }
            } 
          }
        }
      }
    }
    if (empty($entry_return)) {
      $entry_return = 'Nie znaleziono danych';
      $domain = do_shortcode('[trade_fair_domainadress]');
      ?>
        <script>
            const targetHeader = document.querySelector("#text-section h2");
            targetHeader.innerText = "Brak unikalnych kodów QR";
            const targetDesc = document.querySelector("#text-section p");
            targetDesc.innerHTML = "Podany email adres nie został znaleziony w naszej bazie danych osób zarejestrowanych na targi lub została już wysłana prośba o identyfiaktor. Jeżeli chcesz otrzymać identyfikator prosimy o zarejestrowanie się po czym wysunięcie prośby o identyfikator jeszcze raz.<br><a href='/rejestracja/' style='font-size:30px;'>REJESTRACJA NA TARGI</a>";
        </script>
      <?php
    } else {
    }
    return $entry_return;
  }
}

function Give_me_badge_check($search_email, $entries_data, $atts){
  
  $full_name = $entries_data[6];
  if ($entries_data[10] === ''){
    $vip = 'gosc_a6';
  } else { 
    $vip = $entries_data[10];
  }
  
  $forms = GFAPI::get_forms();
  $give_me_badge_form_exists = false;
  $give_me_badge_form_id = null;

  foreach ($forms as $form) {
    if (strtolower($form['title']) === 'give me badge') {
      $give_me_badge_form_exists = true;
      $give_me_badge_form_id = $form['id'];
      break;
    }
  }
  if ($give_me_badge_form_exists) {
    // Formularz "Give Me Badge" istnieje, szukaj pola "Email"
    $form_fields = GFAPI::get_form($give_me_badge_form_id);
    $qr_table = array();
    foreach ($form_fields['fields'] as $field) {
      if ($field->type === 'email') {
        // Sprawdź, czy email istnieje w formularzu
        $entries = GFAPI::get_entries($give_me_badge_form_id, null, null, array('offset' => 0, 'page_size' => 0));
        
        foreach ($entries as $entry) {
          if (rgar($entry, $field->id) === $search_email) { 
            $qr_code_resoult =  gform_get_meta($entry['id'], 8);
            $qr_table[] = $qr_code_resoult;            
          }
        }
        $unical_qr = Get_all_forms($search_email, $qr_table, $vip, $full_name);

        if ($unical_qr != 'Nie znaleziono danych') {
          $entries_data['8'] = $unical_qr;
          $entries_data['form_id'] = $give_me_badge_form_id;

          Send_form_data($entries_data, $vip, $atts);

          $entry_id = GFAPI::add_entry($entries_data);
        }
      }
    }
  } else {
    $form_title = 'Give Me Badge';
    if ($entries_data[9] != ''){

    } else {
    // Jeśli formularz nie istnieje, utwórz go
    $form_id = GFAPI::add_form(array(
        'title' => $form_title,
        'fields' => array(
            // Tutaj możesz dodać pola formularza
          array(
              'label' => 'Email',
              'type' => 'email',
              'id' => 1,
          ),
          array(
            'label' => 'Ulica',
            'type' => 'text',
            'id' => 2,
          ),
          array(
            'label' => 'Miasto',
            'type' => 'text',
            'id' => 3,
          ),
          array(
            'label' => 'Kod pocztowy',
            'type' => 'text',
            'id' => 4,
          ),
          array(
            'label' => 'Panstwo',
            'type' => 'text',
            'id' => 5,
          ),
          array(
            'label' => 'name',
            'type' => 'text',
            'id' => 6,
          ),
          array(
            'label' => 'firm',
            'type' => 'text',
            'id' => 7,
          ),
          array(
            'label' => 'QRcode',
            'type' => 'text',
            'id' => 8,
          ),
          array(
            'label' => 'userID',
            'type' => 'text',
            'id' => 9
          ),
          array(
            'label' => 'vip',
            'type' => 'text',
            'id' => 10
          ),
        ),
    ));

      $entries_data['form_id'] = $form_id;
      $entries_data['8'] = Get_all_forms($search_email, [], $vip, $entries_data[6]);

      $entry_id = GFAPI::add_entry($entries_data);

      if (is_wp_error($form_id)) {
          error_log('Nie udało się utworzyć formularza.');
      } else {
        Send_form_data($entries_data, $vip, $atts);
      }
    }
  } 
} 

function Inside_badge($search_email, $entries_data, $atts, &$registered){
  if($entries_data['11'] !== ''){
    echo $entries_data['11'] . '<br>';
  }
  if($entries_data['12'] !== ''){
    echo $entries_data['12'];
  }

  $id_name = $atts['identyfikator'];
  
  $vip = 'gosc_a6';
  $forms = GFAPI::get_forms();
  $give_me_badge_form_exists = false;
  $give_me_badge_form_id = '';

  foreach ($forms as $form) {
    if (strtolower($form['title']) == 'inside identyfikator') {
      $give_me_badge_form_exists = true;
      $give_me_badge_form_id = $form['id'];
    }
  }

  if ($give_me_badge_form_exists) {
    $form_id = $give_me_badge_form_id; // Zmień na ID swojego formularza

    $entry_data = array(
      'input_2' => $entries_data[1],
      'input_10' => $entries_data[2],
      'input_3' => $entries_data[3],
      'input_4' => $entries_data[4],
      'input_5' => $entries_data[5],
      'input_6' => $entries_data[6],
      'input_8' => $entries_data[7],
      'input_11' => $entries_data[9],
      'input_12' => $atts['identyfikator'] . $entries_data[10],
    );

    $is_valid = GFAPI::submit_form($form_id, $entry_data);

    if (is_wp_error($is_valid)) {
      $error_text = 'Błąd podczas przesyłania formularza: ' . $is_valid->get_error_message();
        echo '<script>
          const targetHeader = document.querySelector("#text-section h2");
          targetHeader.innerText = "'.$error_text.'";
        </script>';
    } else {
      ?>
      <script>
        const targetHeader = document.querySelector("#text-section h2");
        targetHeader.innerText = "Identyfikator wysłany pomyślnie";
      </script>

      <?php
    }
  } else {
    ?>
    <script>
      const targetHeader = document.querySelector("#text-section h2");
      targetHeader.innerText = "Formularz nie istnieje";
      const targetDesc = document.querySelector("#text-section p");
      targetDesc.innerHTML = "Skontaktuj się z web Developerami aby stworzyć formularz do identyfikatorów 'Inside identyfikator";
      
    </script>
    <?php
  }
}

function unCodeText ($text){
  $text = str_rot13($text); 
  $text = str_replace('1mal1', '@', $text);
  $text = str_replace('3krop3', '.', $text);
  return $text;
}

function custom_badge_scripts(){
  $js_file = plugins_url('badge.js', __FILE__);
  $js_version = filemtime(plugin_dir_path(__FILE__) . 'badge.js');
  wp_enqueue_script('badge-js', $js_file, array('jquery'), $js_version, true);
  wp_localize_script( 'badge-js', 'inner_data', $inner_data_array ); 

  $css_file = plugins_url('badge.css', __FILE__);
  $css_version = filemtime(plugin_dir_path(__FILE__) . 'badge.css');
  wp_enqueue_style('badge-css', $css_file, array(), $css_version);
}

add_action('vc_before_init', 'register_custom_badge_element');
add_shortcode('custom_badge', 'custom_badge_element_output');

add_action('wp_enqueue_scripts', 'custom_badge_scripts');
?>