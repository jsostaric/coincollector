<?php include_once "config.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once "templates/_head.php"; ?>
</head>
<body>
	<?php include_once "templates/_nav.php"; ?>

	
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="jumbotron jumbotron-fluid">
				<div class="container-fluid">
					<?php if(isset($_GET["logout"])): ?>
				<div class="alert alert-primary" role="alert">
				  <p>You successfully logged out!</p>
				</div>
				<?php endif; ?>

				<h1 class="display-6 text-center">Welcome to Coin Collector</h1>
				<a class="btn btn-outline-success btn-block" href="<?php echo $route; ?>public/login.php" role="button">Login</a>
				<a class="btn btn-outline-primary btn-block" href="<?php echo $route; ?>public/register.php" role="button">Register</a>
				
				
				</div>
			</div>
			<hr>
			<?php include_once "templates/_footer.php"; ?>
		</div>
	</div>

	

	<?php include_once "templates/_script.php";   ?>
</body>
</html>