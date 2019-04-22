<?php
	session_start();	

	if (isset($_COOKIE['username'])) {
		$status = true;
	} else {
		$status = false;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Math Game</title>
</head>
<body>

	<h1 align="center">WELCOME TO MATH GAME!</h1>

	<?php
		$_SESSION['x'] = rand(0,100);
		$_SESSION['y'] = rand(0,100);
		$_SESSION['lives'] = 5;
		$_SESSION['score'] = 0;
	?>
	
	<?php	
		if (isset($_COOKIE['math'])){
		$value = $_COOKIE['math'];
		}
	?>

	<form method="post" action="math2.php" enctype="multipart/form-data">
		<?php
			if ($status == false) {
		?>
		<center>Insert Your Name : <input type="text" name="username"></center>
		<?php
			} else {
				echo "<p><center>Welcome back, ".$_COOKIE['username']."!</center></p>";
				echo "<p><center>Last played : ".$_COOKIE['lasttime']." | Score ".$_COOKIE['score']."</center></p>";
			}
		?>
		
		<input type="hidden" name="MAX_FILE_SIZE" value="100000000" />
		<center>Choose Photo : <input type="file" name="userfile"></center>

		<center><h2>Choose Level : </h2></center>
		<center><select name="level" style="padding: 15px;">
				<option value="easy"> Easy </option>
				<option value="medium"> Medium </option>
				<option value="hard"> Hard </option>
		</center></select><br><br>		
		
		<center><input type="submit" name="submit2" value="START"  style="padding: 10px;"></center>
		
		<center><input type="submit" name="submit3" value="Not Me"  style="padding: 10px;"></center>

	</form>

</body>
</html>