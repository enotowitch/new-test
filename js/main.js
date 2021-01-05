jQuery(document).ready(function () {

	var brandColor = '#6fda44';
	var grayLightColor = '#dedede';




	// ! search show
	$('#search-icon, #search-icon2').on('click', function () {
		$('.TEST-MAIN-banner').hide();
		$('.search').show();
	});
	// ! switch jobs and portfolios
	$('.radio-btn').on('click', function () {
		$('.radio-btn').removeClass('jobs-portfolios-radio_active');
		$(this).addClass('jobs-portfolios-radio_active');
	});

	// ! chosen

	$(".post-job-tags-select").chosen({ 'width': '245px', 'max_selected_options': '3', });
	$(".post-job-country-select").chosen({ 'width': '100px', 'max_selected_options': '1', });
	$(".post-job-salary-select").chosen({ 'width': '75px', 'max_selected_options': '1', });
	$(".post-job-exp-select").chosen({ 'width': '95px', 'max_selected_options': '1', });
	$(".post-job-duration-select").chosen({ 'width': '75px', 'max_selected_options': '1', });
	$(".post-job-workload-select").chosen({ 'width': '95px', 'max_selected_options': '1', });


	// ! AJAX DESTROY 

	$(document).on('click', '.destroy-btn', function (e) {
		e.preventDefault();

		confirm("SURE YOU WANT TO DELETE YOUR POST?");


		var this_card = $(e.target).closest('.card');

		var hidden_id_delete = this_card.find('input[name="hidden_id_delete"]').val();
		var user_id = this_card.find('#user_id_index').val();
		

		$.ajax({
			url: 'destroy.php',
			type: 'POST',
			data: { hidden_id_delete:hidden_id_delete,user_id:user_id },
			success: function (data) {

				this_card.prepend('<div class="animate-delete"></div>');
				this_card.find('.animate-delete').animate({ 'width': '100%' }, 500);

				setTimeout(function () {
					window.location.href = 'index.php';
				}, 500);

			},
		});
	})

		$(document).on('click', '.post-job-reset-label', function () {
			document.location.reload();
		});

		// ! HIDE/DELETE posts for ONE user
		$(document).on('click', '.delete-btn', function(e){
			e.preventDefault();

			var delete_id = $(e.target).closest('.card').find('input[name="hidden_id_delete"]').val();
			var user_id_index	= $(e.target).closest('.card').find('#user_id_index').val();


			$.ajax({
				url: "delete.php",
				type: "POST",
				dataType: "text",
				data: {delete_id:delete_id,user_id_index:user_id_index},
				success: function (data) {
		
					// alert(user_id_index);
				},
			});
		});


	// ! update AJAX on the SAME PAGE

$(document).on('click', '.update-btn', function(e){
	// e.preventDefault();

	var hidden_id_update = $(e.target).closest('.card').find('input[name="hidden_id_update"]').val();
	var this_card = $(e.target).closest('.card');

	$('.two-cards-bg').slideUp(800);
	$('.card').prepend('<div class="updating-card-all"></div>');
	$('.card').not(this_card).addClass('box-sh-none');


	this_card.addClass('updating-card-this');

		$.ajax({
		url: "update_same_page.php",
		type: "POST",
		dataType: "text",
		data: {hidden_id_update:hidden_id_update},
		success: function (data) {

			this_card.html(data);
		},
	});


});

// ! when CURRENT user LOGGED in - hide delete btns from cards of THIS user
if($('.card-main').find('.card__icons img').hasClass('update-btn')){
	$('.update-btn').closest('.card-main').addClass('cur-user-hid-del');
	$('.cur-user-hid-del').find('.card__icons').find('.delete-btn').hide();
}

	// ! MAIN slick

	$(document).on('click', '.card-option__example_main-card-example', function () {
		$(this).next('.card-slick').show().slick({ asNavFor: '.slider', lazyLoad: 'ondemand', infinite: true, speed: 500, fade: true, cssEase: 'linear' }).append('<img class="icon-scale close-slick" src="img/icons/delete.svg">');
	});

	$(document).on('click', '.close-slick', function () {
		$(this).closest('.card-slick').hide();
	});

	//
	// todo FIRST click on any 'watch next' slide does not work
	//

// ! MAKING FAKE SLIDER -> preventing 'Cannot read property 'getSlick' of undefined' so any slider should exist
$('.slider').slick();
// ! hidding slider to show when 'img-zoom' clicked
$('.slider-wrap').hide();


$(document).on('click', '.img-zoom' ,function(){

	// ! destroy FAKE SLIDER
	$('.slider').slick("unslick");

	var cur_slick_index = $(this).closest('.card-main').find('.slick-current').attr('data-slick-index');
	var cloned_slick_slides = $(this).closest('.card-main').find('.img-zoom').addClass('zoom-out').clone();
	
	// ! removing 'nav-for' to prevent SLIDING different sliders  
	$('.card-main').find('.card-slick').removeClass('nav-for');
	$(this).closest('.card-main').find('.card-slick').addClass('nav-for');

	$('.slider').html(cloned_slick_slides);
	$('.slider').slick({asNavFor: '.nav-for', lazyLoad: 'ondemand', infinite: true, speed: 500, fade: true, cssEase: 'linear', slidesToShow: 1  });
	$('.slider').slick('goTo', parseInt(cur_slick_index));

	$('.slider-wrap').show();

// ! removing class 'img-zoom' to prevent init SLIDER on already zoomed imgs
	$('.slider').find('.zoom-out').removeClass('img-zoom');

});

$(document).on('click', '.zoom-out', function(){

		$('.slider').slick("unslick");
	
		$('.slider').empty();
		$('.slider-wrap').hide();
	// ! adding 'img-zoom' to be able to zoom again
		$('.card-main').find('.zoom-out').addClass('img-zoom').removeClass('zoom-out');
	
	});


	// ! validation if INFO = OK
$('.post-form').on('change', function(){
	
	// pics
	var logo = $('#card__input-logo').prop('files')[0];
	var example_pic = $('#card-option__post-job-example').prop('files')[0];
	//TOP
	var job_title = $.trim($('#card__post-job-title').val());
	var job_company_name = $.trim($('#card__post-job-company-name').val());
	//  select INFO
	var job_salary = $('[name="job_salary"]').find('option:selected').val();
	var job_exp = $('[name="job_exp"]').find('option:selected').val();
	var job_location = $('[name="job_location"]').find('option:selected').val();
	var job_duration = $('[name="job_duration"]').find('option:selected').val();
	var job_workload = $('[name="job_workload"]').find('option:selected').val();
	// number of tags selected
	var tags_chosen = $(this).find('.chosen-choices li').not('.search-field').length;

		if(logo && example_pic && job_title != '' && job_company_name != '' && job_salary != 0 && job_exp != 0 && job_location != 0 && job_duration != 0 && job_workload != 0 && tags_chosen == 3){
			
			$('.post-job-submit-label img').attr('src', 'img/icons/info-ok.svg');
		} else {
			$('.post-job-submit-label img').attr('src', 'img/icons/info-ok-grey.svg');
		}
	

});
	// ! validation if INFO = OK (additional validation for tags chosen)
$(document).on('click', '.card__post-job', function(){

	var tags_chosen = $(this).find('.chosen-choices li').not('.search-field').length;

	if(tags_chosen < 3){
		$('.post-job-submit-label img').attr('src', 'img/icons/info-ok-grey.svg');
	}
});


	// ! OLD

// // ! POP UP clone for slick slider

// $('.hidden-pop').hide();

// $(document).on('click', '.img-zoom' ,function(){
// // ! adding class 'zoom-out' to make unslick later 
// var cur_slick_index = $(this).closest('.card-main').find('.slick-current').attr('data-slick-index');

// var cloned_slick_slides = $(this).closest('.card-main').find('.img-zoom').addClass('zoom-out').clone();

// 	$('.hid-zoom').html(cloned_slick_slides);
// 	$('.hidden-pop').show();

// 	$('.hid-zoom').slick({ slidesToShow: 1 });
// 	$('.hid-zoom').slick('goTo', parseInt(cur_slick_index) );

// // ! removing class 'img-zoom' to prevent init slick on already zoomed imgs
// 	$('.hid-zoom').find('.zoom-out').removeClass('img-zoom');
	
// });


// $(document).on('click', '.zoom-out', function(){

// 	$('.hid-zoom').slick("unslick");

// 	$('.hid-zoom').empty();
// 	$('.hidden-pop').hide();
// // ! adding 'img-zoom' to be able to zoom again
// 	$('.card-main').find('.zoom-out').addClass('img-zoom').removeClass('zoom-out');

// });




});
