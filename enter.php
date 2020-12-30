<?
session_start();
include 'header.php';
?>
<!-- ! IF USER EXISTS => show LOG OUT -->
<?if($_SESSION['user']): ?>
<? echo "HELLO {$_SESSION['user']['user_email']}"; ?>
<a href="log_out.php">LOG OUT</a>
<? endif; ?>


<!--  -->
<!--  -->

<!-- ! AJAX FORM -->
<form>
	<!-- ! IF USER EXISTS => don't show REGISTER -->
	<? if(!$_SESSION['user']): ?>
	<a href="register_front.php">Don't have account? SIGN UP</a>
	<? endif; ?>
	<br>
	<br>
	<br>
	<!-- ! Email -->
	<label for="user_email">User Email</label>
	<input class="reg-input" type="email" name="user_email" id="user_email">
	<!-- ! Password -->
	<label for="user_pass">Password</label>
	<input class="reg-input" type="password" name="user_pass" id="user_pass">

	<input class="reg-input-submit" type="submit" value="SIGN IN" id="reg-input-submit">

	<div class="success">
		<!-- <? 
		if($_SESSION['validation_msg']){
			echo $_SESSION['validation_msg'];
			unset($_SESSION['validation_msg']);
		}
		?> -->
	</div>
</form>


<!-- ! CURRENT HEADER STYLE  -->
<style>
	#sign-in-icon,
	#sign-in-icon2 {
		fill: #6fda44;
	}

	.sign-in {
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

			$.ajax({
				url: 'enter_back.php',
				type: 'POST',
				dataType: 'json',
				data: {
					user_email:user_email,
					user_pass:user_pass
				},
				success: function(response){

					var reg_input_submit = $('.reg-input-submit');

if(response.status == true){
	reg_input_submit.val(response.msg);
	reg_input_submit.css({'border': '2px solid #6fda44', 'background': '#6fda44'});
	document.location.href = 'index.php';
} 

if(response.type == 'error_fiels'){
	reg_input_submit.val(response.msg);
	reg_input_submit.css({'border': '2px solid tomato', 'background': 'tomato', 'color': '#fff'});
	response.fields.forEach(function(field){
		$(`input[name="${field}"]`).addClass('error');
		setTimeout(function () {
			$('input').removeClass('error');
			reg_input_submit.val('SIGN IN');
			reg_input_submit.css({'border': '2px solid #6fda44', 'background': '#6fda44'});
 				}, 500);
		
	})
}

if (response.type == 'no user') {
	reg_input_submit.val(response.msg);	
	reg_input_submit.css({'border': '2px solid tomato', 'background': 'tomato', 'color': '#fff'});
	setTimeout(function () {
		reg_input_submit.val('SIGN IN');
		reg_input_submit.css({'border': '2px solid #6fda44', 'background': '#6fda44'});
		
				}, 500);
}


					
				}
			});

		})



	});


</script>