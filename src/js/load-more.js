// js/load-more.js

jQuery(document).ready(function ($) {
    // Chargement des actualités
    $('#load-more-actus').on('click', function () {
        const button = $(this);
        const page = button.data('page') + 1;
        const max = button.data('max');

        $.ajax({
            url: ajaxVars.ajaxUrl,
            type: 'post',
            data: {
                action: 'load_more_actus',
                page: page,
                _ajax_nonce: ajaxVars.nonce
            },
            success: function (response) {
                if (response) {
                    $('.actus-container').append(response);
                    button.data('page', page);
                    if (page >= max) button.hide();
                }
            }
        });
    });

    // Chargement des articles de presse
    $('#load-more-presse').on('click', function () {
        const button = $(this);
        const page = button.data('page') + 1;
        const perPage = button.data('per-page');
        const loaded = button.data('loaded');
        const total = button.data('total');

        $.ajax({
            url: ajaxVars.ajaxUrl,
            type: 'post',
            data: {
                action: 'load_more_presse',
                page: page,
                per_page: perPage,
                loaded: loaded,
                _ajax_nonce: ajaxVars.nonce
            },
            success: function (response) {
                console.log('[Presse AJAX]', response); // debug
                if (response) {
                    $('.presse-container').append(response);
                    button.data('page', page);
                    const newLoaded = loaded + perPage;
                    button.data('loaded', newLoaded);
                    if (newLoaded >= total) button.hide();
                }
            }
        });
    });
});
