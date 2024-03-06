<?php
if (empty($pwe_height_logotypes_form)) {
    $pwe_height_logotypes_form = '50px';
}
?>

<style> 
    .gform_wrapper :is(label, .gfield_description), .show-consent,
    .gform_legacy_markup_wrapper .gfield_required {
        color: <?php echo $color ?>;
    }
    .pwe-registration .gform-body ul,
    .uncell:has(.img-container-top10) {
        padding: 0 !important;
    }
    .pwe-registration-column {
        padding: 36px;
        height: 100%;
    }
    .row-container:has(.img-container-top10) #top10 {
        padding: 36px;
        box-shadow: 9px 9px 0px -5px black;
        border: 2px solid;
        height: 100%;
    }
    .row-container:has(.img-container-top10) .uncol,
    .row-container:has(.img-container-top10) .uncell,
    .row-container:has(.img-container-top10) .uncont,
    .custom_element:has(.pwe-registration),
    .pwe-registration {
        height: 100%;
    }
</style>

<?php 
    $mobile = preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT']);
    if ($mobile != 1) {
        echo '<style>
                .row-container:has(.img-container-top10) .img-container-top10 div {
                    min-height: '. $pwe_height_logotypes_form .';
                    margin: 10px 5px !important;
                }
              </style>';
    }
?>

<div id='pweRegistration' class='pwe-registration'>
    <div class="pwe-registration-column style-accent-bg shadow-black">
        <?php include __DIR__ . '/form-content.php'; ?>
        <div class="pwe-registration-form">
            [gravityform id="<?php echo $pwe_registration_form_id ?>" title="false" description="false" ajax="false"]
        </div>
    </div>
</div>
