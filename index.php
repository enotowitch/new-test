<?
session_start();
include 'header.php';
?>
<!-- !!! TEST-->
<div class="TEST-MAIN-banner" style="height: 300px; background-color: tomato">
	TEST-MAIN-banner
</div>
<!-- ??? TEST-->
<!--  -->
<!-- !!! POST JOB -->

<!-- ??? POST JOB -->
<!--  -->
<!-- !!! PROFILE -->

<!-- ??? PROFILE -->
<!--  -->
<!-- ! SEARCH -->
<?
include 'search.php';
?>
<!-- ? SEARCH -->
<!--  -->
<!-- // ! hidden POP UP clone for slick slider  -->
<div class="slider-wrap">
<div hidden class="slider"></div>
</div>

<!-- // ! OLD big slider  -->
<!-- <div class="hidden-pop">
<div hidden class="hid-zoom"></div>
</div> -->

<div class="main-cards-wrapper">
	<div class="jobs-portfolios-radio">
		<div class="jobs-portfolios-radio__jobs radio-btn jobs-portfolios-radio_active">JOBS</div>
		<a href="portfolios.php">
			<div class="jobs-portfolios-radio__portfolios radio-btn">PORTFOLIOS</div>
		</a>
	</div>
	<div class="main-cards-inner">
		<!--  -->
		<!-- ! MAIN CARD php -->
		<!-- ! PHP -->
		<?php

			
			require_once 'DB.php';
			
			$cards = mysqli_query($connect, "SELECT * from `tbl_card`");
			$cards = mysqli_fetch_all($cards, MYSQLI_ASSOC);			
			?>

		<? foreach($cards as $card): ?>

		<div class="card card-main">
			<img class="card__logo" src="<? echo $card["logo_path"] ?>" alt="post-job-logo">
			<div class="card__job-title">
				<? echo $card["job_title"] ?>
			</div>
			<div class="card__company-name">
				<? echo $card["job_company_name"] ?>
			</div>
			<!-- ! card-option -->
			<ul>
				<li class="card-option__salary">
					<? echo $card["job_salary"] ?>
				</li>
				<li class="card-option__exp">
					<? echo $card["job_exp"] ?>
				</li>
				<li class="card-option__location">
					<? echo $card["job_location"] ?>
				</li>
				<li class="card-option__duration">
					<? echo $card["job_duration"] ?>
				</li>
				<li class="card-option__workload">
					<? echo $card["job_workload"] ?>
				</li>
				<li class="card-option__example card-option__example_main-card-example">Example</li>
				<div class="card card-slick" hidden>
				<? if(($card["path_example_1"]) != 'uploads/'): ?>
					<img class="img-zoom" src="" data-lazy="<? echo $card["path_example_1"] ?>">
					<? endif; ?>
					<? if(($card["path_example_2"]) != 'uploads/'): ?>
					<img class="img-zoom" src="" data-lazy="<? echo $card["path_example_2"] ?>">
					<? endif; ?>
					<? if(($card["path_example_3"]) != 'uploads/'): ?>
					<img class="img-zoom" src="" data-lazy="<? echo $card["path_example_3"] ?>">
					<? endif; ?>
				</div>
			</ul>
			<!-- ! card-tags -->
			<div class="card__tags">
				<div class="card__tag">
					<? echo $card["tag_name_1"] ?>
				</div>
				<div class="card__tag">
					<? echo $card["tag_name_2"] ?>
				</div>
				<div class="card__tag">
					<? echo $card["tag_name_3"] ?>
				</div>
			</div>
			<!-- ! card-icons -->
			<div class="card__icons card-icons">
					<!-- // ! show UPDATE only for CURRENT user -->
	<? if($_SESSION['user']['user_id'] == $card["user_id"]): ?>
				<!-- // ! AJAX update form W/0 SUBMIT BUTTON-->
				<input type="hidden" name="hidden_id_update" value="<? echo $card["job_post_id"] ?>">
					<img class="icon-scale update-btn" src="img/icons/update.svg" alt="update">
		<? endif;?>

					<!-- // ! AJAX delete form W/0 SUBMIT BUTTON-->

					<input type="hidden" name="hidden_id_delete" value="<? echo $card["job_post_id"] ?>">
					<img class="delete icon-scale delete-btn" src="img/icons/delete.svg" alt="delete">

					<!-- // ! USER ID for POSTS -->
<input type="hidden" id="user_id_index" value="<? echo $_SESSION['user']['user_id'] ?>">

				<img class="like icon-scale" src="img/icons/like.svg" alt="like">
				<img class="apply icon-scale" src="img/icons/apply.svg" alt="apply">
			</div>
		</div>

		<? endforeach; ?>


		<?
			$connect-> close();
			?>
		<!-- ? PHP -->
		<!-- ? MAIN CARD php -->

		<!--  -->
	</div>
</div>
<!--  -->
	<? 
	include 'footer.php';
	?>

