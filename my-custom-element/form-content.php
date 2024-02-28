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
?>

<style>
.pwe-form-title h4, .pwe-form-text p {
    color: <?php echo $color ?>;
}
.pwe-form-title h4 {
    margin-top: 0 !important;
    box-shadow: 9px 9px 0px -6px <?php echo $color ?>;
}
@media (max-width: 450px) {
    input[type='submit'] {
        padding: 12px 20px !important;
        font-size: 3.3vw !important;
    }
}
</style>

<div id='pweFormContent' class='pwe-form-content'>
    <div class="pwe-form-title main-heading-text">
        <h4 class="custom-uppercase"><span><?php echo $pwe_title_form ?></span></h4>
    </div>  
    <div class="pwe-form-text">
        <p><?php echo wpb_js_remove_wpautop($pwe_text_form, true); ?></p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    let pweFormButton = document.querySelector('.gform_wrapper input[type="submit"]');
    if (pweFormButton) {
        pweFormButton.value = '<?php echo $pwe_button_text_form ?>';
    }
});
</script>