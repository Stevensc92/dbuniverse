var app = {
    init: function() {
        app.changeCharacter.init();
        app.flashMessage.init();
        app.menuMapAction.init();
        app.capsuleCorp.init();
        app.capsule.init();
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
                let actionsContainer = $('#lien-map-actions');
                let btnMap = $('.lien-map');

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
    },

    capsuleCorp: {
        init: function() {
            const btnBuy = $('.buy');
            const ajaxUrl = $('.ajax-url').data('url');
            $('.ajax-url').remove();

            $(btnBuy).on('click', function() {
                app.capsuleCorp.buy(ajaxUrl, $(this).parent().data('id'));
            })
        },

        buy: function(path, capsId) {
            $.post(
                path,
                {
                    data: {
                        capsule: capsId
                    }
                },
                function(response) {
                    let responseJson = $.parseJSON(response);
                    let price = responseJson.price;
                    let newStock = responseJson.newStock;

                    const zenis = $('.zenis span');
                    let currentZenis = zenis.html();
                    const nbCharBeforeSpace = 3;
                    const nbDoingReplace = currentZenis.length / nbCharBeforeSpace;

                    console.log('Before for currentZenis : ', currentZenis);

                    for (let i = 0; i < nbDoingReplace; i++) {
                        currentZenis = currentZenis.replace(' ', '');
                    }

                    console.log('After for currentZenis : ', currentZenis);


                    currentZenis = parseInt(currentZenis.replace(' ', '').replace(' ', ''));
                    let newZenis = currentZenis - price;
                    // console.log(currentZenis);
                }
            )
        },
    },

    capsule: {
        init: function() {
            // app.capsule.displayStat();
            // let htmlTemplate = '<div class="tooltip tooltip-custom"><div class="overlay"><h2 class="overlay--title">Caractéristique</h2></div></div><div class="tooltip-inner"></div></div>';
            // $(function () {
            //     $('[data-toggle="tooltip"]').tooltip({
            //         html: true,
            //         // template: '<div class="tooltip tooltip-custom"><div class="title">Test</div><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
            //         content: function() {
            //             return $(this).prop('title');
            //         },
            //         track: true
            //     })
            // })
            let capsules = document.querySelectorAll('.overlay .overlay--data');

            window.onmousemove = function(e) {
                let x = (e.clientX + 20) + 'px';
                let y = (e.clientY + 20) + 'px';

                for (var i = 0; i < capsules.length; i++) {
                    capsules[i].style.top = y;
                    capsules[i].style.left = x;
                }
            };
        },

        displayStat: function() {
            let $capsule = $('.capsule');

            $capsule.hover(function(e) {
                let $stat = $(this).find('.stat');
                e.stopPropagation();
                $stat.css('display', 'block');
            });

            $capsule.blur(function(e) {
                let $stat = $(this).find('.stat');
                e.stopPropagation();
                $stat.css('display', 'inline');
            })
        }
    }
};

$(app.init);