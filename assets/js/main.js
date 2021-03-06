$(function () {
    coreJs.init();
    coreJsResize.init();
    coreJsFormCheckbox.init();
    coreJsTabs.init();
    coreJsMobile.init();
    coreJsMobileMenu.init();
    coreJsSwitchElement.init();
    //coreJSFixed.init();
    Slider.init();
    All.init();
    coreJsAnimationStep.init();
    // Запуск скрипты

    Catalog.init();

    $('.block__devProject__img').parallax({
        invertX: false,
        invertY: true,
        //scalarX: 10,
        frictionY: .1
    });
    $('.block__devParallax__img').parallax({
        relativeInput: true,
        invertX: false,
        invertY: true,
        scalarX: 0,
        frictionX: 2,
        frictionY: .1
    });
});