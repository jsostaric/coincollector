<?php include_once "../config.php"; checkLogin(); 
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
				<div class="jumbotron text-center">
				<div class="btn-group" role="group" aria-label="Basic example">
				  <a href="<?php echo $route; ?>private/dashboard.php" class="btn btn-primary">Overview</a>
				  <a href="<?php echo $route; ?>private/add.php" class="btn btn-primary">Add</a>
				</div>
				</div>
			</div>
		</div> <!-- end of first row -->

		<div class="row">
			<div class="col-md-8 offset-md-4">
				<form method="post">
					<div class="form-row">
					    <div class="form-group col-md-1">
					      
					      <select name="denomination" class="custom-select" id="inputGroupSelect01">
						 	<option selected value="0">Choose...</option>
						 	<?php 	$query = "select * from cc where user = :id";
									$stmt = $conn->prepare($query);
									$stmt->execute(array("id"=> $_SESSION["session"]->id));
									$result = $stmt->fetchAll(PDO::FETCH_OBJ);  


						 	 foreach ($result as $row): ?>
						    
						    <option value="<?php echo $row->id; ?>"><?php echo $row->denomination; ?></option>

						    <?php endforeach;  ?>
					  		</select>
					    </div>

					    <div class="form-group col-md-2">
					      <input type="text" class="form-control" name="amount" id="amount" placeholder="amount of coins" value="" />
					    </div>
						<p>or</p>
					    <div class="form-group col-md-2">
					      <input type="text" class="form-control" name="total" id="total" placeholder="total value of coins" value="" />
					    </div>

					    <div class="form-group col-md-2">
					      <input type="submit" class="btn btn-primary" name="add" value="Add" />
					    </div>
					  </div>

					 <?php
					 // prvo dohvatimo sve iz forme. submit mora imati name  
					 if(isset($_POST["add"])) {
					 	$query = "select * from cc where id=:id"; 

					 	$stmt= $conn->prepare($query);
					 	$stmt->execute(array("id" => $_POST["denomination"] )); //trazimo samo odredjeni red

					 	//dohvacamo samo jedan red koji zelimo izmjeniti. ta imamo iznos u bazi kojemu mozemo
					 	// dodati iznos
					 	$row = $stmt->fetch(PDO::FETCH_OBJ); 
						
						
					 	$total = $row->total + $_POST["total"];

					 	$amount = $total / $row->denomination;

					 	$stmt = $conn->prepare("update cc set user=:user,denomination = :denomination, amount = :amount, total = :total  where id=:id");
					 	$stmt->execute(array("user" => $row->user,
					 		"amount" => $amount,
					 		"denomination" => $row->denomination,
					 		"total" => $total,
					 		"id" => $_POST["denomination"]

					 		));
					 	
					 	}

					?>
				</form>
			</div>
		</div> <!-- end of second row -->
	</div> <!-- end of container -->
	

	<?php include_once "../templates/_script.php";   ?>
</body>
</html>