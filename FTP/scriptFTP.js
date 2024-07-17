const PotwierdzenieUsuniecia = (event) => {
    event.target.classList.toggle('display-none')
    const eventer = event.target.parentNode.querySelectorAll('.display-none');

    if (event.target.classList.contains('usuwam')) {
        setTimeout(() => {
            for (i = 1; i < eventer.length; i++) {
                eventer[i].classList.toggle('display-none')
            }
        }, 1000);
    } else {
        for (i = 1; i < eventer.length; i++) {
            eventer[i].classList.toggle('display-none')
        }
    }

}

jQuery(document).ready(function ($) {
    $('.get-all').on('click', function () {
        console.log($('input[value="Usuń"]').not('.display-none'));
        $('input[value="Usuń"]').not('.display-none').click();
    });

    $('.file-mass-del').on('click', function () {
        const deleting = [];

        $('input[value="Tak usuwam"]').not('.display-none').parent().find('input[name="plik"]').each(function () {
            deleting.push($(this).val());
        });

        const urlParams = new URLSearchParams(window.location.search);
        const katalog = urlParams.get('folder');

        const domain = window.location.hostname;

        if (deleting.length > 0) {
            const url = 'https://' + domain + '/wp-content/plugins/custom-element/FTP/mass_delete.php';
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: { kat: katalog, pliki: deleting, kod: 'kodek' },
                success: function (data) {
                    window.location.reload();
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    console.error(xhr.response);
                    console.error(xhr.status);
                }
            });
        } else {
            console.log('Nie zaznaczono żadnych plików do usunięcia.');
        }
    });
});