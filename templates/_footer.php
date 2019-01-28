<div class="row">
	<div class="col-md-4 offset-4 text-center" >
	&copy; Jurica <?php echo date("Y",getdate()[0]); ?> 
	
	<?php 
	//print_r($_SERVER["HTTP_HOST"]!="localhost");
	if(!$produkacija){
		echo ", <span style=\"color: red\">Lokalno</span>";
	}
	
	?>
</div>
</div>