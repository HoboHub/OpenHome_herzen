<?php
	//connection settings 
	$servername = "openhome.esp";
	$username = "root";
	$password = "";
	$database = "openhome";

	// $url = $_POST['url'];
	$url = filter_var(trim($_POST['url']), FILTER_SANITIZE_STRING);
	$frameID = filter_var(trim($_POST['frameID']), FILTER_SANITIZE_STRING);
	$pageName = filter_var(trim($_POST['pageName']), FILTER_SANITIZE_STRING);
	// $frameID = $_POST['frameID'];

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
	$sql = "INSERT INTO `frames` (`url`, `frameID`, `page_name`) VALUES ('". $url ."', '". $frameID."', '$pageName')";
	if (mysqli_query($connect, $sql)) {
		// echo "Новая запись добавлена в бд. ";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($connect);
	}
	//----------------------------------------------------

	//Closing connection
	mysqli_close($connect);
?>