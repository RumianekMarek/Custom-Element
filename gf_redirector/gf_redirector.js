jQuery(document).ready(function($) {
    $('form').attr('action', '');
    $('form').attr('target', '');
    $('form .gform_button').removeAttr('onclick');
    $('form .gform_button').removeAttr('onkeypress');
    $('form .gform_button').attr('name', 'submit');
    $('form input[type="hidden"]').remove();
    $('form input[type="checkbox"]').attr('value', '0');
    $('form input[type="checkbox"]').each(function() {
        this.checked ? '1' : '0';
        $(this).on('change', function() {
            $(this).val(this.checked ? '1' : '0');
        });
    });
});