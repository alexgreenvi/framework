// - coreJs -
var coreJs = {
    menu: $('.core__menu-nav__ul'),
    width: null,

    init: function () {
        this.resize();
    },
    active: function ($this) {
        $this.addClass('active');
    },
    activeRemove: function ($this) {
        $this.removeClass('active');
    },
    activeToggle: function ($this){
        $this.toggleClass('active');
    },
    delete: function ($this) {
        $this.remove();
    },
    resize: function () {
        coreJs.width = $(document).width();

        $(window).resize(function () {
            coreJs.width = $(document).width();
        });
    },
    put: function ($element,$to) {
        $element.detach();
        $to.append($element);
    }
};
var coreJsResize = {
    // Переменные
    // ...
    $arElements : $('[data-js-core-resize]'),
    width : null,

    //...
    init: function () {
        this.load();
    },
    load: function () {
        // Переменные
        this.$arElements.each(function () {
            var $this = $(this),
                $name = $this.data('js-core-resize'),
                $size = $this.data('js-core-resize-width');

            $this.data({
                status: false,
                name:   $name,
                size:   $size,
                before: $('[data-js-core-resize=' + $name + ']'),
                after:  $('[data-js-core-resize-after=' + $name + ']'),
            });

            //$this.children().addClass('js-core-resize-element');
        });
        this.resize();
        $(window).resize(this.resize);
    },
    resize: function() {
        coreJsResize.$arElements.each(function () {
            var $this = $(this);

            if($this.data().size === 'xl') $this.data().size = '1200';
            if($this.data().size === 'lg') $this.data().size = '992';
            if($this.data().size === 'md') $this.data().size = '758';
            if($this.data().size === 'sm') $this.data().size = '576';
            if($this.data().size === 'xs') $this.data().size = '360';


            if(coreJs.width <= $this.data().size){
                if(!$this.data().status) {
                    console.log('перенос');
                    $this.wrap('<div data-js-core-resize-before="' + $this.data().name + '"></div>');
                    $this.data().before = $('[data-js-core-resize-before=' + $this.data().name + ']');
                    $this.data().before.css('display','none');
                    coreJs.put(
                        $this,
                        $this.data().after
                    );
                    $this.data().status = true;
                }
            }else{
                if($this.data().status) {
                    console.log('Возврат');
                    coreJs.put(
                        $this.data().after.find('[data-js-core-resize=' + $this.data().name + ']'),
                        $this.data().before
                    );
                    $this.unwrap();

                    $this.data().status = false;
                }
            }
        });
    }
};
var coreJsFormCheckbox = {
    // Переменные
    // ...
    $arElements : $('[data-js-core-form-checkbox]'),
    //...
    init: function () {
        this.load();
    },
    load: function () {
        // Переменные
        this.$arElements.each(function () {
            var $this = $(this),
                $name = $this.data('js-core-form-checkbox');

            $this.data({
                hidden:     $('.' + $name)
            });
        });
        this.activation();
    },
    activation: function() {
        this.$arElements.each(function () {
            var $this = $(this);

            $($this).on('click', function(){
                $this.data().hidden.toggleClass('active');
            });
        });
    }
};
var coreJsTabs = {
    // Переменные
    // ...
    $arElementsNav : $('[data-js-core-tabs-nav]').find('a'),
    $arElementsTabs : $('[data-js-core-tabs]'),
    id : 1,
    num: null,
    //...
    init: function () {
        this.load();
    },
    load: function () {
        // Переменные
        var tempLastName = null;

        this.$arElementsNav.each(function () {
            var $this = $(this),
                id    = null,
                $name = $this.parents('[data-js-core-tabs-nav]').data('js-core-tabs-nav');

            if($this.data('js-core-tabs-nav-id')) {
                id = $this.data('js-core-tabs-nav-id');
            }else{
                id = coreJsTabs.id
            }

            // Для переключения
            if(tempLastName === $name) {
                coreJsTabs.num += 1;
            }else{
                tempLastName = $name;
                coreJsTabs.num = 1;
            }

            var $tab = coreJsTabs.$arElementsTabs.find('[data-js-core-tabs-id ='+ id + ']');

            $this.data({
                id:         id,
                name:       $name,
                tab:        $tab,
                num:        coreJsTabs.num
            });
            coreJsTabs.id += 1;
        });

        this.activation();
    },
    activation: function() {
        this.$arElementsNav.each(function () {
            var $this = $(this);

            $($this).on('click', function(e){
                e.preventDefault();
                // nav
                $('[data-js-core-tabs-nav=' + $this.data().name + ']').find('[data-js-core-tabs-nav-id]').removeClass('active');
                $this.toggleClass('active');
                // tab
                $('[data-js-core-tabs=' + $this.data().name + ']').find('[data-js-core-tabs-id]').removeClass('active');
                $this.data().tab.toggleClass('active');

                var JSarray = anime({
                    targets: $('[data-js-core-tabs=' + $this.data().name + ']').find('[data-js-core-tabs-id]'),
                    translateX: 250
                });
            });
        });
    }
};
var coreJsMobile = {
    // Переменные
    // ...
    $body :    $('.body-content'),
    $menu :    $('.core__mobile__menu'),
    $buttonX : $('.core__mobile__button'),

    init: function () {
        this.load();
    },
    load: function () {
        $(this.$buttonX).on('click', this.ButtonX_click);
    },

    ButtonX_click: function (e){
        e.preventDefault();
        coreJsMobile.$body.toggleClass('js-core-mobile-open');
        coreJsMobile.$buttonX.toggleClass('active');
        $('.core__mobile').removeClass('js-list');
    }
};
var coreJsMobileMenu = {
    core: null,

    // Переменные
    // ...
    $body :    $('.body-content'),
    $menu :    $('.core__menu-nav__mobile__alert__menu'),
    $buttonX : $('.core__menu-nav__mobile__button'),

    init: function () {
        core = $.extend(true, {} , this);
        this.load();
    },
    load: function () {
        $(this.$buttonX).on('click', this.ButtonX_click);
    },

    ButtonX_click: function (e){
        e.preventDefault();
        core.MenuMobile_load();

        core.$body.toggleClass('js-core-mobile-menu-open');
        core.$buttonX.toggleClass('active');
    }.bind(this.core),

    MenuMobile_load: function () {
        // Добавляем классы для пунктов
        core.$menu.find('li').each(function() {
            var $this = $(this);
            if($this.children('ul').length >= 1) {
                $this.children('a').addClass('js-core-mobile-menu-btn');
            }else{
                $this.children('a').addClass('js-core-mobile-menu-link');
            }
        });

        // Добавляем название меню
        if(core.$menu.find('.js-core-mobile-menu-name').length === 0) {
            var menu_name = core.$menu.attr('data-core-name');
            core.$menu.children('ul')
                .prepend("<li><span class='js-core-mobile-menu-name'>" + menu_name + "</span></li>");
        }

        core.MenuMobile_activeRemove();
        core.MenuMobile_btn_click();
    }.bind(this.core),

    MenuMobile_activeRemove: function () {
        coreJs.activeRemove(core.$menu.find('ul'));
        coreJs.activeRemove(core.$menu.find('li'));
        coreJs.delete(core.$menu.find('.js-core-mobile-menu-catalog-name').parent('li'));
        coreJs.delete(core.$menu.find('.js-core-mobile-menu-back').parent('li'));
    }.bind(this.core),

    MenuMobile_btn_click: function () {
        core.$menu.find('.js-core-mobile-menu-btn').off('click').on('click', function (e) {
            e.preventDefault();

            $(this).parents('ul').addClass('active');
            $(this).parent('li').addClass('active');

            var catalog_name = $(this).html();

            if( $(this).find('js-core-mobile-menu-catalog-name').length === 0) {
                $(this).siblings('ul')
                    .prepend("<li><span class='js-core-mobile-menu-catalog-name'>" + catalog_name + "</span></li>")
                    .prepend("<li><span class='js-core-mobile-menu-back'>Назад</span></li>");
            }
            core.$menu.find('.js-core-mobile-menu-back').on('click', core.MenuMobile_activeRemove);
        });

    }.bind(this.core)
};
var coreJsSwitchElement = {
    // Переменные
    // ...
    $arElements : $('[data-js-core-switch-element]'),
    //...
    init: function () {
        this.load();
    },
    load: function () {
        // Обработка DATA
        this.$arElements.each(function () {
            var $this = $(this),
                $name = $this.data('js-core-switch-element'),
                $text = $this.text();
            $textSwitch = $this.data('js-core-switch-element-text')

            $this.data({
                element:     $('.' + $name),
                text:        $text,
                textSwitch:  $textSwitch
            });
        });
        this.activation();
    },
    activation: function() {
        this.$arElements.each(function () {
            var $this = $(this);
            $($this).on('click', function(){
                $this.data('element').toggleClass('active');

                if(!!$this.data('textSwitch') && $this.data('element').hasClass('active')){
                    $this.text($this.data('textSwitch'));
                }else {
                    $this.text($this.data('text'));
                }
            });
        });
    }
};
var coreJSFixed = {
    init: function () {
        this.window = $(window);
        // .....
        this.$arElements = $('[data-js-fixed]');
        // .....
        if(this.$arElements.length) {
            this.load();
        }
    },
    load: function () {
        this.$arElements.each(function () {
            var $this = $(this),
                top = $this.offset().top;

            $this.data({
                status:    false,
                top:       top
            });
        });
        this.activation();
    },
    activation: function () {
        coreJSFixed.window.scroll(function() {
            coreJSFixed.$arElements.each(function () {
                var $this = $(this);
                if (coreJSFixed.window.scrollTop() > $this.data('top')) {
                    $this.addClass('fixed');
                } else {
                    $this.removeClass('fixed');
                }
            });
        });
    }
};

var Slider = {
    init: function () {
        // .....
        this.$arElements = $('[data-js-slider]');
        // .....
        this.load();
    },
    load: function () {
        this.$arElements.each(function () {
            var $this = $(this);
            $this.data({
                table: $this.data('js-slider'),
                id: $this.data('js-slider-number')
            });
        });
        this.activation();
    },
    activation: function () {
        this.$arElements.each(function () {
            var $this = $(this);
        });
    }
};
var All = {
    init: function () {
        $(".block").slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            autoplay: true,
            autoplaySpeed: 3000,
            dots: false,
            dotsClass: 'dots',
            prevArrow: "<svg class='slider__arrow slider__arrow_prev' width='32' height='32' viewBox='0 0 477.175 477.175'><path d='M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z'/></svg>",
            nextArrow: "<svg class='slider__arrow slider__arrow_next' width='32' height='32' viewBox='0 0 477.175 477.175'><path d='M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z'/></svg>",
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 640,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
        $('.work__list').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            arrows: true,
            autoplay: false,
            autoplaySpeed: 3000,
            dots: false,
            dotsClass: 'dots',
            prevArrow: "<svg class='slider__arrow slider__arrow_prev' width='32' height='32' viewBox='0 0 477.175 477.175'><path d='M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z'/></svg>",
            nextArrow: "<svg class='slider__arrow slider__arrow_next' width='32' height='32' viewBox='0 0 477.175 477.175'><path d='M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z'/></svg>",
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 640,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
        $('.page__index__slider__list').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            arrows: true,
            autoplay: true,
            autoplaySpeed: 3000,
            dots: false,
            dotsClass: 'dots',
            prevArrow: "<svg class='slider__arrow slider__arrow_prev' width='32' height='32' viewBox='0 0 477.175 477.175'><path d='M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z'/></svg>",
            nextArrow: "<svg class='slider__arrow slider__arrow_next' width='32' height='32' viewBox='0 0 477.175 477.175'><path d='M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z'/></svg>",
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 640,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }
};
// var coreJsAnimetion = {
//     // Переменные
//     // ...
//     $arElements : $('[data-js-core-animetion]'),
//     //...
//     init: function () {
//         this.load();
//     },
//
//     timeAddClass: function ($time,$class,$number) {
//
//     }
// };

var Catalog = {
    init: function () {
        // Переменые
        this.$arElements = $('[data-catalog-basket-add]');
        this.$topBasket = $('[data-catalog-basket]');
        // .....
        this.load();
    },
    load: function () {
        this.$arElements.each(function () {
            var $this = $(this);

            $this.data({
                table   : $this.data('table'),
                id      : $this.data('id')
            });

            $this.on('click', function(e){
                e.preventDefault();
                Catalog.onClick($this);
            });
        });
    },
    onClick: function ($this) {
        Catalog.ajax($this);
    },
    ajax: function ($this) {
        $.post("http://catalog:8888/ajax/catalog__basket__add/", {
                table       : $this.data().table,
                id          : $this.data().id
            }
            , onAjaxSuccess);
        function onAjaxSuccess(data){
            Catalog.$topBasket.html(data);
            Catalog.load();
        }
    }
};

var coreJsAnimationStep = {
    init: function () {
        // .....
        this.$arElements = $('[data-js-core-animation-step]');
        // .....
        // Если есть хоть 1 элемент то загружаем
        if(this.$arElements.length) {
            this.load();
        }
    },
    load: function () {
        this.$arElements.each(function () {
            var $this = $(this);

            $this.data({
                animation: false,
                from: 1,                // C какого числа начинать
                to: 14,                 // До какого считать
                speed: 1000            // Скорость

            });
            setTimeout(function () {
                coreJsAnimationStep.activation();
            }, 1000);
            coreJsAnimationStep.activation();
        });
    },
    activation: function () {
        this.$arElements.each(function () {
            var $this = $(this);
            if($this.data().animation === false){
                var number = $this.data('from');
                $this.data().animation = true;
                setInterval(function () {
                    $this.addClass('frame-' + number);
                    number++;

                    if(number === $this.data('to')){
                        while (number) {
                            $this.removeClass('frame-' + number);
                            number--;
                        }
                        $this.data.animation = false;
                    }
                }, $this.data('speed'));
            }
        });
    }
};

// (function ($) {
//     var coreJsAnimation = function (element, options) {
//         this.$element = $(element);
//         this.options  = $.extend({}, coreJsAnimation.DEFAULTS, this.dataOptions(), options);
//         this.init();
//     };
//     // == Переменные ==
//     coreJsAnimation.DEFAULTS = {
//         from: 0,               // C какого числа начинать
//         to: 10,                 // До какого считать
//         speed: 1000,           // Скорость
//         refreshInterval: 10000   // Через какое время перезагрузить перезагрусть
//     };
//     // DATA
//     coreJsAnimation.prototype.dataOptions = function () {
//         var options = {
//             from:            this.$element.data('from'),
//             to:              this.$element.data('to'),
//             speed:           this.$element.data('speed'),
//             refreshInterval: this.$element.data('refresh-interval')
//         };
//
//         var keys = Object.keys(options);
//
//         for (var i in keys) {
//             var key = keys[i];
//
//             if (typeof(options[key]) === 'undefined') {
//                 delete options[key];
//             }
//         }
//
//         return options;
//     };
//     // ==================
//
//     coreJsAnimation.prototype.init = function () {
//         this.number = this.options.from;
//
//         this.render();
//     };
//     coreJsAnimation.prototype.render = function () {
//         var $this = this;
//
//         var time = setInterval(function () {
//             $this.$element.addClass('frame-' + $this.options.number);
//             $this.options.numbers++;
//             console.log($this.options.numbers);
//         }, this.options.speed);
//
//         setInterval(function () {
//             clearInterval(time);
//         }, this.options.refreshInterval);
//
//     };
//     // == Конец ==
//     $.fn.countTo = function (option) {
//         return this.each(function () {
//             var $this   = $(this);
//             var data    = $this.data('countTo');
//             var init    = !data || typeof(option) === 'object';
//             var options = typeof(option) === 'object' ? option : {};
//             var method  = typeof(option) === 'string' ? option : 'init';
//
//             if (init) {
//                 if (data) data.stop();
//                 $this.data('countTo', data = new coreJsAnimation(this, options));
//             }
//
//             data[method].call(data);
//         });
//     };
// }(jQuery));