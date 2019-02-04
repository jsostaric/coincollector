<?php include_once "../config.php"; ?>

<!DOCTYPE html>
<html>
<head>
	<?php include_once "../templates/_head.php"; ?>
</head>
<body>
	<?php include_once "../templates/_nav.php"; ?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4 offset-md-4">
				<?php if(isset($_GET["oops"])): ?>
				<div class="alert alert-primary" role="alert">
				  <p>Wrong name or password!</p>
				</div>
				<?php endif; ?>

				<?php if(isset($_GET["registered"])): ?>
				<div class="alert alert-primary" role="alert">
				  <p>Registered! Try to log in.!</p>
				</div>
				<?php endif; ?>

				<?php if(isset($_GET["stop"])): ?>
				<div class="alert alert-primary" role="alert">
				  <p>Please log in first!</p>
				</div>
				<?php endif; ?>

				<form method="post" action="<?php echo $route; ?>auth.php">
					<div class="form-group row">
   						 <label for="name" class="col-sm-2 col-form-label">Name:</label>
    					<div class="col-sm-6">
      						<input type="text" class="form-control" name="name" id="name" placeholder="Enter your username" value="jurica">
    					</div>
  					</div>

					<div class="form-group row">
						<label for="password" class="col-sm-2 col-form-label">Password:</label>
						<div class="col-sm-6">
					  <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="password">
						</div>
					</div>

					<input class="btn btn-primary" type="submit" name="submit" value="Log In">
				</form>
			</div>
		</div>
	</div> <!-- end of container -->
	

	<?php include_once "../templates/_script.php";   ?>
</body>
</html>