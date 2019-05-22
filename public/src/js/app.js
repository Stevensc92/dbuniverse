import ccgtm from 'ccgtm';

var app = {
    init: function() {
        console.log('app init');
        app.changeCharacter.init();
        app.flashMessage.init();
        app.ccgtm.init();
    },

    changeCharacter: {
        init: function() {
            $('.select-label').on('click', function() {
                let container = $('#list-character'),
                    label     = $('.select-label'),
                    selector  = $('.select-select');

                $(container).toggleClass('hover');
                $(label).toggleClass('opened');
                $(selector).toggleClass('opened');
            });

            $('.select-option').on('click', function() {
                app.changeCharacter.switch($(this).data('slug'));
            });
        },

        switch: function(slug) {
            let pathToRedirect = '/change-cc/'+slug;

            window.location.href = pathToRedirect;
        }
    },

    flashMessage: {
        init: function() {
            if($('#flash').length) {
                const flash = $('#flash');
                flash.fadeIn();

                $('.alert .close').on('click', function() {
                    $(this).parent().fadeOut();
                });
            }
        },
    },

    ccgtm: {
        init: function() {
            ccgtm.initialize({
                settings: {
                    validateOnClose: false,
                    pushTop: true,
                    pushPop: false,
                    fixBottom: false,
                    disableAcceptAll: false,
                    pushTopHideOnScroll: false,
                    mobileOffCanvas: false,
                    moreLink: '',
                    domain: null,
                    timeout: 0,
                    daysBeforeExpiry: 396
                },
                i18n: {
                    popinClose: 'Close'
                }
            });
        }
    }
};

$(app.init);