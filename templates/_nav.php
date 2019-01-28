<nav class="nav">
	<?php if(!isset($_SESSION["session"])): ?>
<a class="nav-link active" href="<?php echo $route; ?>index.php">Home</a>
	<?php else: ?>
<a class="nav-link" href="<?php echo $route; ?>private/dashboard.php">Dashboard</a>
	<?php endif;  ?>
 <a class="nav-link" href="<?php echo $route; ?>public/about.php">About</a>
  <?php if(!isset($_SESSION["session"])): ?>
 <a class="nav-link" href="<?php echo $route; ?>public/login.php">Login</a>
	<?php else:?>
<a class="nav-link" href="<?php echo $route; ?>public/logout.php">Logout</a>
 	<?php endif; ?>
</nav>