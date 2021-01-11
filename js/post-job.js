// ! POST JOB

// ! functions

function empty_logo_input(err_msg) {
	$('label[for="card__input-logo"]').css({ 'border': '2px solid #969696' });
	$('label[for="card__input-logo"]').empty().append('<span></span>');

	$('.card__input-logo-label').append('<div class="err_file" style=" width: 280px; display: none; position: absolute; z-index: 99; top: 35px; left: 0px; background-color: #fff; color: tomato;">' + err_msg + '</div>');
	$('.err_file').slideDown(300);

	setTimeout(() => {
		$('.err_file').slideUp(300);
	}, 3000);
}

function empty_examples_input(err_msg){
	$('.card-option__example-li').empty();
	$('.card-option__example-li').append('<label for="card-option__post-job-example" class="card-option__post-job-example-label">Load Example</label>');
	$('.card-option__example-li').append('<div class="err_examples" style=" width: 280px; display: none; position: absolute; z-index: 99; top: 133px; left: 100px; background-color: #fff; color: tomato;">'+ err_msg +'</div>');
	$('.err_examples').slideDown(300);
	setTimeout(() => {
		$('.err_examples').slideUp(300);
	}, 3000);
}

// ! READY

$(document).ready(function () {

	// hidden on start
	$('.two-cards-bg').slideDown(500);

	// ! (for POST JOB) preview logo
	$(document).on('change', '#card__input-logo', function (e) {

		var type = e.target.files[0].type;
		var size = e.target.files[0].size;

		if (size >= 2097152) {
			empty_logo_input('File max size = 2 MB');
			return;
		}
		if (type != 'image/jpeg' && type != 'image/png' && type != 'image/gif' && type != 'image/jpg') {
			empty_logo_input('File must be: JPG, PNG or GIF');
			return;
		}

		//  ? if file < 2 mb and GOOD file => SHOW preview 
		if (size < 2097152 && type == 'image/jpeg' || 'image/jpg' || 'image/gif' || 'image/png') {
			var preview = URL.createObjectURL(e.target.files[0]);
			$('label[for="card__input-logo"]').html('<img class="card__logo" src="' + preview + '" alt="NO IMG">');
			$('label[for="card__input-logo"]').css({ 'border': 'none' });
		}




	});
	// ! (for update) preview logo
	$(document).on('change', '#update__input-logo', function (e) {
		var preview = URL.createObjectURL(e.target.files[0]);
		$('label[for="update__input-logo"]').html('<img class="card__logo" src="' + preview + '" alt="NO">');
		$('label[for="update__input-logo"]').css({ 'border': 'none' });
	});

	// ! (for POST JOB) preview examples - IF > 3 examples disable FORM submit
	$('#card-option__post-job-example').on('change', function (e) {


		// var type1 = e.target.files[0].type;
		// var type2 = e.target.files[1].type;
		// var type3 = e.target.files[2].type;


		if (e.target.files.length == 0) {
			$('.card-option__example-li').empty();
			$('.card-option__example-li').append('<label for="card-option__post-job-example" class="card-option__post-job-example-label">Load Example</label>');
		}

		if (e.target.files.length > 3) {
			$('label[for="card-option__post-job-example"]').empty().html('<div>3 pics max!</div>').css({ 'background': 'tomato', 'width': '100px' });
			$('#post-job-submit').attr('disabled', 'disabled');
		}


// ? if examples = 1 check SIZE < 2 MB



		if (e.target.files.length == 1) {

			var size1 = e.target.files[0].size;

			if(size1 >= 2097152){
				empty_examples_input('EACH File max size = 2 MB');
			}			
			if (size1 < 2097152){
				$('label[for="card-option__post-job-example"]').empty().html('<div>1/3 pic</div>').css({ 'background': '#6fda44', 'width': '49px' });
				$('#post-job-submit').removeAttr('disabled');
			}
		}
		if (e.target.files.length == 2) {

			var size1 = e.target.files[0].size;
			var size2 = e.target.files[1].size;

			if(size1 >= 2097152 || size2 >= 2097152){
				empty_examples_input('EACH File max size = 2 MB');
			}			
			if (size1 < 2097152 && size2 < 2097152){
				$('label[for="card-option__post-job-example"]').empty().html('<div>2/3 pic</div>').css({ 'background': '#6fda44', 'width': '49px' });
				$('#post-job-submit').removeAttr('disabled');
			}
		}
		if (e.target.files.length == 3) {

			var size1 = e.target.files[0].size;
			var size2 = e.target.files[1].size;
			var size3 = e.target.files[2].size;

			if(size1 >= 2097152 || size2 >= 2097152 || size3 >= 2097152){
				empty_examples_input('EACH File max size = 2 MB');
			}			
			if (size1 < 2097152 && size2 < 2097152 && size3 < 2097152){
				$('label[for="card-option__post-job-example"]').empty().html('<div>3/3 pic</div>').css({ 'background': '#6fda44', 'width': '49px' });
				$('#post-job-submit').removeAttr('disabled');
			}
		}
	});

	// ! (for update) preview examples - IF > 3 examples disable FORM submit
	$('#card-option__update-job-example').on('change', function (e) {
		if (e.target.files.length > 3) {
			$('label[for="card-option__update-job-example"]').empty().html('<div>3 pics max!</div>').css({ 'background': 'tomato', 'width': '100px' });
			$('#update-job-submit').attr('disabled', 'disabled');
		}
		if (e.target.files.length == 1) {
			$('label[for="card-option__update-job-example"]').empty().html('<div>1/3 pic</div>').css({ 'background': '#6fda44', 'width': '49px' });
			$('#update-job-submit').removeAttr('disabled');
		}
		if (e.target.files.length == 2) {
			$('label[for="card-option__update-job-example"]').empty().html('<div>2/3 pics</div>').css({ 'background': '#6fda44', 'width': '69px' });
			$('#update-job-submit').removeAttr('disabled');
		}
		if (e.target.files.length == 3) {
			$('label[for="card-option__update-job-example"]').empty().html('<div>3/3 pics</div>').css({ 'background': '#6fda44', 'width': '100px' });
			$('#update-job-submit').removeAttr('disabled');
		}
		// todo later 
		if (e.target.files.length == 0) {
			location.reload();
		}
	});




	// ! OLD
	// number of tags selected
	var tagsNumberChosen = $('#post-job-form').find('.chosen-choices li').not('.search-field').length;


	// ! validation
	// if (jobTitle == '' || jobCompanyName == '' || jobSalary == '0' || jobExp == '0' || jobLocation == '0' || jobDuration == '0' || jobWorkload == '0' || tagsNumberChosen < 3) {
	// 	alert('ALL FIELDS ARE REQUIRED!');
	// 	return false;
	// }




})

