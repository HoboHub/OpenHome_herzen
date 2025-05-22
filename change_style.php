<?php
	//connection settings 
	$servername = "openhome.esp";
	$username = "root";
	$password = "";
	$database = "openhome";

	$themeName = filter_var(trim($_POST['themeName']), FILTER_SANITIZE_STRING);
	echo "<h1>change_style.php themeName = $themeName</h1>";
	//------------------

	//connection--------------------------
	$connect = mysqli_connect($servername, $username, $password, $database);
	// Проверяем соединение
	if (!$connect) {
		die("Не удалось подключиться к MySQL: " . mysqli_connect_error());
	}
	echo "Соединение установленно. ";
	//---------------------------------

	//Query----------------------------------------------
	$sql = "UPDATE `pages` SET `style`='$themeName'";
	if (mysqli_query($connect, $sql)) {
		echo "Тема обновлена. ";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($connect);
	}
	//----------------------------------------------------

	//Closing connection
	mysqli_close($connect);
?>