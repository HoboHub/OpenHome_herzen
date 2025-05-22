<?php
	include_once 'assets/filters/translit.php';
	
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

	$roomName = filter_var(trim($_POST['roomName']), FILTER_SANITIZE_STRING);
	$selectedIcon = filter_var(trim($_POST['selectedIcon']), FILTER_SANITIZE_STRING);
	$timestamp = filter_var(trim($_POST['timestamp']), FILTER_SANITIZE_STRING);

	$room_id = "room_" . $timestamp;

	//---------------------------------------------------------------------
	// add new room in data/rooms
	//---------------------------------------------------------------------
	$newcontent = file_get_contents(dirname(__FILE__)."\assets\\templates\\room.php");

	$roomNameLatin = translit($roomName); //translate kirilitca to latin
	$room_file = $roomNameLatin . '_' . $timestamp . '.php';

	if (!file_exists($room_file)) {
		$handle = fopen(dirname(__FILE__)."\data\\rooms\\".$room_file, 'w+' );
		fwrite($handle,$newcontent);
		fclose($handle);
	}
	//-----------------------------------------

	//Query----------------------------------------------
	// $sql = "UPDATE `frames` SET `url`='$url', frameID='$frameID' WHERE `frameID`='$oldFrameName'";
	$sql = "INSERT INTO `rooms` (`name`, `room_id`, `icon_id`, `room_file`) VALUES ('$roomName', '$room_id', '$selectedIcon', '$room_file')";

	if (mysqli_query($connect, $sql)) {
		echo "Новая комната добавлена. ";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($connect);
	}
	//----------------------------------------------------

	//Closing connection
	mysqli_close($connect);

?>