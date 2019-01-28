<?php include_once "../config.php"; 

$err = [];

if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])) {
	if(trim($_POST["name"]) === "") {
		$err["name"] = "Please enter a name!";
	}

	if(trim($_POST["email"]) === "") {
		$err["email"] = "Please enter your email address!";
	}

	if($_POST["password"] === "") {
		$err["password"] = "Please enter a password!";
	}

	if(count($err) == 0) {
		try {
			
			$stmt = $conn->prepare("insert into user(name, password, email) values(:name, md5(:password), :email)");
			$result = $stmt->execute($_POST);

			$last = $conn->lastInsertId();

			$stmt = $conn->prepare("insert into cc(user, denomination, amount, total) values($last,0.01,0,0),($last,0.02,0,0),($last,0.05,0,0),
			 ($last,0.10,0,0),
				 ($last,0.20,0,0),
					 ($last,0.50,0,0),
						 ($last,1.00,0,0),
							($last,2.00,0,0),
								($last,5.00,0,0),
									($last,25.00,0,0)");
			$result = $stmt->execute();

			header("location: " . $route . "public/login.php?registered");
		} catch (Exception $e) {
			echo $e->getMessage();
			var_dump($conn->errorInfo());
		}
	}
}

?>

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
				<form method="post">
					<div class="form-group row">
   						 <label for="name" class="col-sm-2 col-form-label">Name:</label>
    					<div class="col-sm-6">
      						<input type="text" class="form-control" name="name" id="name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ""; ?>" />
    					</div>
  					</div>

					<div class="form-group row">
						<label for="email" class="col-sm-2 col-form-label">Email:</label>
						<div class="col-sm-6">
					  <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ""; ?>" />
						</div>
					</div>
					
					<div class="form-group row">
						<label for="password" class="col-sm-2 col-form-label">Password:</label>
						<div class="col-sm-6">
					  <input type="password" class="form-control" name="password" id="password" value="" />
						</div>
					</div>
					<input class="btn btn-primary btn-block" type="submit" value="Register">
					<a class="btn btn-danger btn-block" href="<?php echo $route; ?>index.php">Cancel</a>
				</form>
				<hr>
				<?php if(isset($err["name"])): ?>
				<div class="alert alert-danger" role="alert">
					<?php echo $err["name"]; ?>
				</div>
				<?php endif;?>

				<?php if(isset($err["email"])): ?>
				<div class="alert alert-danger" role="alert">
					<?php echo $err["email"]; ?>
				</div>
				<?php endif;?>

				<?php if(isset($err["password"])): ?>
				<div class="alert alert-danger" role="alert">
					<?php echo $err["password"]; ?>
				</div>
				<?php endif;?>

			</div>
		</div>
	</div>
	

	<?php include_once "../templates/_script.php";   ?>
</body>
</html>