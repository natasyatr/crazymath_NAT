<?php
	session_start();

	$x = rand(0,100);
	$y = rand(0,100);

	if (isset($_POST['submit2'])){
		$uploaddir = 'photos/';
        
        $uploadtime = date('YmdHis');
        
        $ext = explode(".",$_FILES['userfile']['name']);
        $ext = strtolower(end($ext));

        $uploadfile = $_POST['username'] . "-" . $uploadtime . "." . $ext;

        $uplod = move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $uploadfile);
        
        if($uplod){	
        $_SESSION['filenameupload'] = $uploadfile;
        setcookie('username', $_POST['username'], time()+3600*24*7);
        header("Location: math2.php");
        }
    }
	
	if (isset($_POST['submit3'])){
		setcookie('username', $_POST['username'], time()-3600*24*1);
		header("Location: math1.php");
	}


	if (isset($_POST['submit'])){
		if ($_POST['x_old'] + $_POST['y_old'] == $_POST['hasil']) {
			$_SESSION['score'] += 5;
			$status = true;
		} else {
			$_SESSION['score'] -= 1;
			$_SESSION['lives'] -= 1;
			$status = false;
		}
	}

	if (isset($_POST['submit2'])){
		if ($_POST['level'] == "easy"){
			$_SESSION['level'] = "easy";
		}
		elseif ($_POST['level'] == "medium"){
			$_SESSION['level'] = "medium";
		}
		elseif ($_POST['level'] == "hard"){
			$_SESSION['level'] = "hard";
		}	
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Math Game</title>
</head>
<body>

	<h1 align="center">MATH GAME</h1>


		<?php
			echo "<p>Username : ".$_COOKIE['username']."</p>";
			echo "Lives : ".$_SESSION['lives'];
			echo "<br>Score : ".$_SESSION['score'];
		?>

		<?php
			if (isset($status)){
				if ($status == true){
					echo "<h2>RIGHT ANSWER! :)</h2>";
			} else {
				echo "<h2>WRONG ANSWER! :(</h2>";
				}
			}
		?>

		<?php
			if ($_SESSION['lives'] == 0) {
				echo "<h1><center>!GAME OVER!</center></h1>";
				echo "<p><a href='math1.php'><center>Try Again</center></a></p>";
				
				setcookie('score', $_SESSION['score'], time()+3600*24*7);
				setcookie('lasttime', date('d/m/Y H:i'), time()+3600*24*7);

				include 'dbconfig.php';

				$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
				$query = "INSERT INTO scores (username, scores, playtime, foto) 
						VALUES ('".$_COOKIE['username']."', ".$_SESSION['score'].", '".date('Y-m-d H:i:s')."', '".$_SESSION['filenameupload']."')";
				$hasil = mysqli_query($db, $query);

			} else {
		?>
				<form method="post" action="math2.php">
					<?php
					if ($_SESSION['level'] == "easy") {
						echo "$x + $y = ";
					}
					elseif ($_SESSION['level'] == "medium") {
						echo "$x * $y = ";
					}
					else {
						echo "$x / $y = ";
					}
					
					?>
						<input type="hidden" name="x_old" value="<?php echo $x;?>">
						<input type="hidden" name="y_old" value="<?php echo $y;?>">
						<input type="text" name="hasil">
						<input type="submit" name="submit">
				</form>
		<?php 	
			}
		?>


</body>
</html>