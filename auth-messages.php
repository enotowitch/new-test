<div class="auth-messages">
<!-- ! // LOG OUT -->
<?if($_SESSION['user']): ?>
<? echo "HELLO {$_SESSION['user']['user_email']}"; ?>
<a href="log_out.php">LOG OUT</a>
<? endif; ?>
<!-- ! // SIGN IN IF NO USER -->
<?if(!$_SESSION['user']): ?>
<a href="enter.php">SIGN IN</a>
<span>|</span>
<? endif; ?>
<!-- ! // REGISTER IF NO USER -->
<?if(!$_SESSION['user']): ?>
<a href="register_front.php">SIGN UP</a>
<? endif; ?>
</div>