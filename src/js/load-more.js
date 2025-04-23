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
    function getPerPage() {
        const width = window.innerWidth;
        if (width <= 640) return 3;
        if (width <= 1064) return 2;
        return 3;
    }
    
    $('#load-more-presse').on('click', function () {
        const button = $(this);

        if (button.hasClass('loading')) return;
        button.addClass('loading');

        const page = parseInt(button.data('page'));
        const perPage = getPerPage();
        const total = parseInt(button.data('total'));
        const loaded = parseInt(button.attr('data-loaded'));
        const pageId = button.data('page-id');

        $.ajax({
            url: ajaxVars.ajaxUrl,
            type: 'post',
            data: {
                action: 'load_more_presse',
                page: page,
                per_page: perPage,
                loaded: loaded,
                page_id: pageId,
                _ajax_nonce: ajaxVars.nonce
            },
            success: function (response) {
                if (response.success && response.data) {
                    $('.presse-container').append(response.data);

                    const newLoaded = loaded + perPage;
                    button.attr('data-loaded', newLoaded);
                    button.attr('data-page', page + 1);

                    if (newLoaded >= total) {
                        button.hide();
                    }
                }
            },
            complete: function () {
                button.removeClass('loading');
            }
        });
    });
});