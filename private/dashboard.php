<?php include_once "../config.php"; checkLogin(); ?>

<!DOCTYPE html>
<html>
<head>
	<?php include_once "../templates/_head.php"; ?>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
	<?php include_once "../templates/_nav.php"; ?>

<!-- Adding coins form -->
<div class="container-fluid">						
	<div class="row">
		<div class="col-md-8 offset-md-4">
			<form method="post">
				<div class="form-row">
						<div class="form-group col-md-4">
							
							<select name="denomination" class="custom-select" id="inputGroupSelect01">
							<option selected value="0">Choose...</option>
								<?php 
								$query = "select * from cc where user = :id";
								$stmt = $conn->prepare($query);
								$stmt->execute(array("id"=> $_SESSION["session"]->id));
								$result = $stmt->fetchAll(PDO::FETCH_OBJ);  


								foreach ($result as $row): ?>						    
							<option value="<?php echo $row->id; ?>"><?php echo $row->denomination; ?></option>
								<?php endforeach;  ?>
							</select>
						</div>

						<div class="form-group col-md-2">
							<input type="text" class="form-control" name="total" id="total" placeholder="Add total value of coins" value="" />
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
					
					
					$total = $_POST["total"];

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
	</div>
</div> <!-- end of first row -->

<div class="row">
	<div class="col-md-4 offset-md-4">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th id="cell" scope="col">Denomination</th>
					<th id="cell" scope="col">Amount</th>
					<th id="cell" scope="col">Total</th>   
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php 
					$query = "select * from cc where user = :id";
				$stmt = $conn->prepare($query);
				$stmt->execute(array("id"=> $_SESSION["session"]->id));
				$result = $stmt->fetchAll(PDO::FETCH_OBJ); 

					foreach ($result as $row): 	?>
					<th scope="row"><?php echo $row->denomination . "kn<br>"; ?></th>
					<td><?php echo $row->amount . " kom<br>"; ?></td>
					<td><?php echo $row->total . "kn<br>"; ?></td>
				</tr>
				<?php endforeach; ?>
				<tr>
					<?php
					$query = "select id, sum(total) as balance from cc where user = :id";
					$stmt = $conn->prepare($query);
					$stmt->execute(array("id" => $_SESSION["session"]->id));
					$result = $stmt->fetchAll(PDO::FETCH_OBJ);

					foreach ($result as $row): 	?>
					<th scope="row">Balance</th>
					<td id="cell_color"></td>
					<td id="cell_color"><?php echo $row->balance . "kn"; ?></td>					
				<?php endforeach; ?>
				</tr>
			</tbody>
		</table>
	</div>
</div> <!-- end of second row -->
</div> <!-- end of container -->

	<?php include_once "../templates/_script.php";   ?>
</body>
</html>