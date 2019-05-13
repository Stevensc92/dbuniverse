var app = {
    init: function() {
        console.log('app init');
        app.changeCharacter.init();
        app.flashMessage.init();
    },

    changeCharacter: {
        init: function() {
            $('.select-label').on('click', function() {
                var container = $('#list-character'),
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

            window.location = pathToRedirect;
        }
    },

    flashMessage: {
        init: function() {
            console.log('flash message initialisé');
        },
    },
};

$(app.init);