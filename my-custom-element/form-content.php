<?php 
if ($color == '#000000') {
    $color = 'black !important';
} else {
    $color = 'white !important';
}
if($locale == 'pl_PL') {
    $pwe_title_form = ($pwe_title_form == "") ? "DLA ODWIEDZAJĄCYCH" : $pwe_title_form;
    $pwe_text_form = ($pwe_text_form == "") ? "Wypełnij formularz i odbierz darmowy bilet" : $pwe_text_form;
    $pwe_button_text_form = ($pwe_button_text_form == "") ? "ODBIERZ DARMOWY BILET" : $pwe_button_text_form;
} else {
    $pwe_title_form = ($pwe_title_form == "") ? "FOR VISITORS" : $pwe_title_form;
    $pwe_text_form = ($pwe_text_form == "") ? "Fill out the form and receive your free ticket" : $pwe_text_form;
    $pwe_button_text_form = ($pwe_button_text_form == "") ? "GET A FREE TICKET" : $pwe_button_text_form;
}

// Create unique id for element
$unique_id = rand(10000, 99999);
$element_unique_id = 'pweFormContent-' . $unique_id;
?>

<style>
    .row-container:has(.custom_element_<?php echo $rnd_id ?>) {
        .gform_wrapper input[type="submit"] {
            opacity: 0;
        }
        .gform_wrapper :is(label, .gfield_description), .show-consent,
        .gform_legacy_markup_wrapper .gfield_required {
            color: <?php echo $color ?>;
        }
        .pwe-form-title h4, .pwe-form-text p {
            color: <?php echo $color ?>;
        }
        .pwe-form-title h4 {
            margin-top: 0 !important;
            box-shadow: 9px 9px 0px -6px <?php echo $color ?>;
        }
    }
@media (max-width: 450px) {
    .row-container:has(.custom_element_<?php echo $rnd_id ?>) {
        input[type='submit'] {
            padding: 12px 20px !important;
            font-size: 3.3vw !important;
        }
    }
}
</style>

<div id='<?php echo $element_unique_id ?>' class='pwe-form-content'>
    <div class="pwe-form-title main-heading-text">
        <h4 class="custom-uppercase"><span><?php echo $pwe_title_form ?></span></h4>
    </div>  
    <div class="pwe-form-text">
        <?php $pwe_text_form = str_replace(array('`{`', '`}`'), array('[', ']'), $pwe_text_form); ?>
        <p><?php echo wpb_js_remove_wpautop($pwe_text_form, true); ?></p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const pweRowContainer = document.querySelector('.row-container:has(.custom_element_<?php echo $rnd_id ?>)');
    const pweFormButton = pweRowContainer.querySelector('.gform_wrapper input[type="submit"]');
    if (pweFormButton) {
        pweFormButton.style.opacity = 1;
        pweFormButton.style.transition = 'opacity 0.3s ease';
        pweFormButton.value = '<?php echo $pwe_button_text_form ?>';
    }
});
</script>