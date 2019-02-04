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
				  <a href="dashboard.php" class="btn btn-primary">Overview</a>
				  <a href="add.php?id=>" class="btn btn-primary">Add</a>
				</div>
				</div>
			</div>
		</div> <!-- end of first row -->

		<div class="row">
			<div class="col-md-8 offset-md-2">
				<table class="table table-bordered">
				  <thead>
				    <tr>
				      <th scope="col">Denomination</th>
				      <th scope="col">Amount</th>
				      <th scope="col">Total</th>				      
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				    	<?php 
				    	$query = "select id, denomination, amount, total from cc where user = :id";
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
				      <td></td>
				      <td><?php echo $row->balance . "kn"; ?></td>
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