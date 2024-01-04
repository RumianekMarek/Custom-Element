<?php
    if ($color != '#ffffff'){
        $color = '#000000 !important';
    } else {
        $color = '#ffffff';
    }
?>

<style>
    #call-center{
        max-width:700px;
    }
    #call-center :is(label, span, .gfield_description){
        color: <?php echo $color ?>;
    }
    .custom-submit{
        font-size: 1em !important;
        max-width: 150px;
        margin-top: 19px !important;
    }
    .gform_footer{
        display:none;
    }
</style>

<?php
    echo '<div id="call-center">[gravityform id="'.$badge_form_id.'" title="false" description="false" ajax="false"]</div>';

    var_dump($_POST);
?>
<script>
    jQuery(function ($) {
        $('form').attr('action', "");

        const multiDiv = $('<div>', {
            class: 'multiContener',
        })
        const multiLabel = $('<label>', {
            class: 'multi-field-label gfield_label',
            text: 'Podaj ilość do masowej wysyłki',
        })
        const multiField = $('<input>', {
            type: 'text',
            id: 'multi-field',
        });
        const buttonSubmiter = $('<input>', {
            class: 'custom-submit',
            name: 'submit',
            type: 'submit',
            value: 'Submit',
        });

        buttonSubmiter.on('click', function(event) {
            $('form').submit();
        })

        $(".gform_wrapper .gform_fields").append(multiDiv);
        $(multiDiv).append(multiLabel);
        $(multiDiv).append(multiField);
        $(multiDiv).append(buttonSubmiter);
    });
</script>
