<?php
if ($btn_color != ''){
    $btn_color = '.custom_element_'.$rnd_id.' .custom-main-timer-btn '.$btn_color;
    if ($btn_color_hover) {
        $btn_color_hover = '.custom_element_'.$rnd_id.' .custom-main-timer-btn '.$btn_color_hover;
    }
}
date_default_timezone_set('Europe/Warsaw');
$current_date = date("Y-m-d H:i:s");
?>
<style>
    <?php echo $btn_color ?>
    <?php echo $btn_color_hover ?>
</style>

<div id='main-timer' class='custom-container-main-timer style-accent-bg' style='color:white !important;' data-show-register-bar="<?php echo $show_register_bar; ?>">
    <div class='custom-main-timer-before'>
        <p class='text-uppercase'>
            <?php if((strtotime($trade_start) - strtotime($current_date)) >= 0 || (strtotime($trade_end) - strtotime($current_date)) <= 0){
                if($locale == 'pl_PL'){
                    echo 'Do targów pozostało:';
                } else {
                    echo 'Until the start of the fair:';
                }
            } else {
                if($locale == 'pl_PL'){
                    echo 'Do końca targów pozostało:';
                } else {
                    echo 'Until the end of the fair:';
                }
            } ?>
        </p>
        <?php include plugin_dir_path(__FILE__) . 'countdown.php'; ?>
        <span class='custom-main-timer-btn'>
            <?php
                if(strtotime($trade_start) - strtotime($current_date) >= 604800){
                    if($locale == 'pl_PL'){
                        echo "<a id='customBtn' class='custom-link btn border-width-0 btn-flat' href='/zostan-wystawca/'>Zostań wystawcą</a>";
                    } else {
                        echo "<a id='customBtn' class='custom-link btn border-width-0 btn-flat' href='/en/become-an-exhibitor'>Book a stand</a></span>";
                    }
                } else {
                    if($locale == 'pl_PL'){
                        echo "<a id='customBtn' class='custom-link btn border-width-0 btn-flat' href='/rejestracja/'>Zarejestruj się<span style='display: block; font-weight: 300;'>Odbierz darmowy bilet</span></a>";
                    } else {
                        echo "<a id='customBtn' class='custom-link btn border-width-0 btn-flat' href='/en/registration/'>REGISTER<span style='display: block; font-weight: 300;'>GET A FREE TICKET</span></a></span>";
                    }
                }
            ?>
        </span>
    </div>
</div>
<script>
    // Funkcja, która będzie wywoływana przy zmianie klasy
    function handleClassChange(mutationsList, observer) {
        for (let mutation of mutationsList) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
            const targetElement = mutation.target;
            const customBtn = document.getElementById('customBtn');
            const hasStuckedClass = targetElement.classList.contains('is_stucked');
            const buttonLink = customBtn.href;
            if (hasStuckedClass) {
                if (buttonLink.includes('/en')) {
                    customBtn.innerHTML = '<span>REGISTER<br/>Get a free ticket</span>';
                    customBtn.href = '/en/registration/';
                } else {
                    customBtn.innerHTML = '<span>Zarejestruj się<br/>Odbierz darmowy bilet</span>';
                    customBtn.href = '/rejestracja/';
                }
            } else {
                if (buttonLink.includes('/en')) {
                    customBtn.innerHTML = '<span>Book a stand</span>';
                    customBtn.href = '/en/become-an-exhibitor'
                } else {
                    customBtn.innerHTML = '<span>Zostań wystawcą</span>';
                    customBtn.href = '/zostan-wystawca/'
                }
            }
            }
        }
    }

    let is_stucked = false;
    const targetElement = document.querySelector('.sticky-element');
    const observer = new MutationObserver(handleClassChange);

    const config = { attributes: true, attributeFilter: ['class'] };
    const showRegisterBarValue = document.getElementById('main-timer').getAttribute('data-show-register-bar');
    if(targetElement && showRegisterBarValue !== 'true') {
        observer.observe(targetElement, config);
        targetElement.setAttribute('data-is-stucked', is_stucked);
    }

</script>