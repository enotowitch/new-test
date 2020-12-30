<?
session_start();
include 'header.php';
?>




<form action="register_back.php" method="POST">
<a href="enter.php">Already have account? SING IN</a>
<br>
<br>
<br>
<!-- Email -->
	<label for="user_email">User Email</label>
	<input class="reg-input" type="email" name="user_email" id="user_email">
	<!-- Password -->
	<label for="user_pass">Password</label>
	<input class="reg-input" type="password" name="user_pass" id="user_pass">
	<!-- Confirm Password -->
	<label for="user_pass_confirm">Confirm Password</label>
	<input class="reg-input" type="password" name="user_pass_confirm" id="user_pass_confirm">
	<input class="reg-input-submit" type="submit" value="SIGN UP">
	

</form>


<!-- ! CURRENT HEADER STYLE  -->
<style>
	#sign-in-icon,#sign-in-icon2{
		fill: #6fda44;
	}
	.sign-in{
		color: #6fda44;
	}
	</style>
	<!-- ? CURRENT HEADER STYLE  -->


<? 
include 'footer.php';
?>

<!-- ! AJAX FORM SCRIPT -->
<script>

	$(document).ready(function () {

		$('.reg-input-submit').on('click', function (e) {
			e.preventDefault();

			let user_email = $('#user_email').val();
			let user_pass = $('#user_pass').val();
			let user_pass_confirm = $('#user_pass_confirm').val();

			$.ajax({
				url: 'register_back.php',
				type: 'POST',
				dataType: 'json',
				data: {
					user_email:user_email,
					user_pass:user_pass,
					user_pass_confirm:user_pass_confirm
				},
				success: function(response){

					var reg_input_submit = $('.reg-input-submit');

if(response.status == true){
	reg_input_submit.val(response.msg);
	reg_input_submit.css({'border': '2px solid #6fda44', 'background': '#6fda44'});
	document.location.href = 'post_job.php';
} 

if(response.type == 'error_fiels'){
	reg_input_submit.val(response.msg);
	reg_input_submit.css({'border': '2px solid tomato', 'background': 'tomato', 'color': '#fff'});
	response.fields.forEach(function(field){
		$(`input[name="${field}"]`).addClass('error');
		setTimeout(function () {
			$('input').removeClass('error');
			reg_input_submit.val('SIGN UP');
			reg_input_submit.css({'border': '2px solid #6fda44', 'background': '#6fda44'});
 				}, 500);
		
	})
}


					
				}
			});

		})



	});


</script>