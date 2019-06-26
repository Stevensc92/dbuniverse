var app = {
    init: function() {
        app.changeCharacter.init();
        app.flashMessage.init();
        app.menuMapAction.init();
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

    menuMapAction: {
        init: function() {
            if($('#lien-map-actions').length) {
                console.log('map action init');
                let actionsContainer = $('#lien-map-actions');
                let btnMap = $('.lien-map');
                console.log($(btnMap).position());
                $(btnMap).hover(function() {
                    console.log('toto');
                    $(actionsContainer).addClass('opened').css({'left':$(btnMap).position().left});
                    console.log($(btnMap).position());
                });

                $(btnMap).on('mouseout', function() {
                    let timer = window.setTimeout(function() {
                        $(actionsContainer).toggleClass('opened');
                    }, 2500);
                });
            }
        }
    }
};

$(app.init);