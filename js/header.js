jQuery(document).ready(function () {

	var brandColor = '#6fda44';
	var grayLightColor = '#dedede';
	var grayColor = '#969696';


	// ! header__burger on click show menu
	var headerBurgerIcon = $(".header__burger");
	var headerBurgerMenu = $(".header__burger-menu");

	headerBurgerIcon.on("click", function () {
		$(".header__burger-menu").toggleClass('header__burger-menu-active');
		headerBurgerIcon.toggleClass('header__burger-active');
	});
	// ! header__burger on click NOT IN menu
	$(document).mouseup(function (e) {
		if (
			!headerBurgerIcon.is(e.target) &&
			headerBurgerIcon.has(e.target).length === 0 &&
			!headerBurgerMenu.is(e.target) &&
			headerBurgerMenu.has(e.target).length === 0
		) {
			$(".header__burger-menu").removeClass('header__burger-menu-active');
			headerBurgerIcon.removeClass('header__burger-active');
		}
	});

	// ! Coloring svg and names of sections in NAV menu

	// $(".nav-block").click(function () {
	// 	$(".nav-block").find(".nav-block-item,.header__icon").removeClass("nav-block-item-active");
	// 	$(this).find(".nav-block-item,.header__icon").addClass("nav-block-item-active");
	// });

	// ! delete
	

});


