$( document ).ready(function() {

    const menuToggle = $('.menu .menu__toggle');

    $('.menu .menu__item--withsubmenu > .menu__link').click(function (e) {
        e.preventDefault();
        $(this).parent().toggleClass('menu__item--active');
    });

    $('.menu .menu__toggle').click(function (e) {
        e.preventDefault();
        toggleMenu();
    });

    $('.menu .menu__overlay').click(function (e) {
        e.preventDefault();
        toggleMenu();
    });
});

function toggleMenu() {
    menuToggle.toggleClass('menu__toggle--active');
    menuToggle.parent().toggleClass('menu--active');
}