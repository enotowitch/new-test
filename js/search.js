// ! SEARCH

jQuery(document).ready(function () {

	var brandColor = '#6fda44';
	var grayColor = '#969696';
	var grayLightColor = '#dedede';

	// ! search hide on click CROSS
	$('.search__cross').on('click', function () {
		$('.search').hide();
	});

	// ! coloring .search__tags
	$('.search__tags .card__tag').on('click', function () {
		$('.search__tags .card__tag').removeClass('card__tag_active');
		$(this).addClass('card__tag_active');
	})
	// ! coloring .search__topic
	$('.search__topic').on('click', function () {
		$('.search__topic').removeClass('search__topic_active');
		$(this).addClass('search__topic_active');
	})
	// ! search by tag text
	$('.search__tags .card__tag').click(function () {
		var tagText = $(this).text();
		$('.card-main').hide();
		$('.card:contains("' + tagText + '")').show();
	});
	// ! global search by tag, job, company etc...
	// todo by job	
	$("#search__input").on("keyup", function () {
		// ? ! if the global search is enabled HIDE TAGS and remove bg color
		$('.search__tags').hide();
		// delete
		$('.search__input-icon path').css({ 'fill': brandColor });
		// ? ! if the global search is enabled unColor search topics
		$('.search__topic').removeClass('search__topic_active');
		var searchVal = $(this).val();
		$(".card-main").hide();
		$(".card-main:contains('" + searchVal + "')").show();
		// ? ! clear input + REMOVE COLOR from picked search tags
		$(".search__topics").on("click", function () {
			$('.search__tags .card__tag').removeClass('card__tag_active');
			$("#search__input").val("");
			$('.search__input-icon path').css({ 'fill': grayColor });
		});
		if ($("#search__input").val() == '') {
			$('.search__topic:first').addClass('search__topic_active')
			$('.search__tags_design').show();
			$('.search__input-icon path').css({ 'fill': grayColor });
		}
	});

	$(".search__tags").not(":first").hide();
	$(".search__topic")
		.click(function () {
			$(".search__topic")
				.removeClass("search__topic_active")
				.eq($(this).index())
				.addClass("search__topic_active");
			$(".search__tags").hide().eq($(this).index()).show();
		})
		.eq(0)
		.addClass("search__topic_active");


});