<?php
	//connection settings 
	$servername = "openhome.esp";
	$username = "root";
	$password = "";
	$database = "openhome";

	//connection--------------------------
	$connect = mysqli_connect($servername, $username, $password, $database);
	// Проверяем соединение
	if (!$connect) {
		die("Не удалось подклюючиться к MySQL: " . mysqli_connect_error());
	}
	echo "Соединение установленно. ";
	//---------------------------------

	$frameID = filter_var(trim($_POST['frameID']), FILTER_SANITIZE_STRING);

	//Query----------------------------------------------
	$sql = "DELETE FROM `frames` WHERE `frameID`='$frameID'";
	if (mysqli_query($connect, $sql)) {
		// echo "Фрейм удален";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($connect);
	}
	//----------------------------------------------------

	//Closing connection
	mysqli_close($connect);
?>