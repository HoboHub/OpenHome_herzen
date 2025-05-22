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
		die("Не удалось подключиться к MySQL: " . mysqli_connect_error());
	}
	echo "Соединение установленно. ";

	// Fields--------------------------------

	$url = filter_var(trim($_POST['url']), FILTER_SANITIZE_STRING);
	$frameID = filter_var(trim($_POST['frameID']), FILTER_SANITIZE_STRING);
	$oldFrameName = filter_var(trim($_POST['oldFrameName']), FILTER_SANITIZE_STRING);

	//Query----------------------------------------------
	$sql = "UPDATE `frames` SET `url`='$url', frameID='$frameID' WHERE `frameID`='$oldFrameName'";
	if (mysqli_query($connect, $sql)) {
		echo "Запись обновлена. ";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($connect);
	}
	//----------------------------------------------------

	//Closing connection
	mysqli_close($connect);
?>