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

	$roomID = filter_var(trim($_POST['frameID']), FILTER_SANITIZE_STRING);
	$pageName = filter_var(trim($_POST['pageName']), FILTER_SANITIZE_STRING);

//Query----------------------------------------------
	//get room file name
	$sqlGetFile = "SELECT `room_file` FROM `rooms` WHERE `room_id`='$roomID'";
	$fileRes = mysqli_query($connect, $sqlGetFile);

	if ($fileRes) {
		$file = $fileRes->fetch_assoc();
	} 
	else {
		printf("Сообщение ошибки: %s\n", mysqli_error( $link ) );
	}
	//----------------------------------------------------------
	//Delete room from folder (if deleted from db)
	$sql = "DELETE FROM `rooms` WHERE `room_id`='$roomID'";
	if (mysqli_query($connect, $sql)) {
		echo "Комната удалена из базы данных. ";
		//------Delete all included frames from db
		$sqlDeleteFrame = "DELETE FROM `frames` WHERE `page_name` = '$pageName' ";
		if (mysqli_query($connect, $sqlDeleteFrame)) {
			echo "Связанные фреймы удалены. ";
		}
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($connect);
		}
		//-----------------------------------------
		//delete room file from folder--------------
		$file_pointer = $file['room_file'];
		// Use unlink() function to delete a file 
		if (!unlink(dirname(__FILE__).'\data\\rooms\\'.$file_pointer)) {
			echo ("$file_pointer cannot be deleted due to an error. Please delete it manualy from /data/rooms"); 
		}
		else {
			echo ("$file_pointer has been deleted"); 
		}
		//----------------------------
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($connect);
	}
//----------------------------------------------------

	//Closing connection
	mysqli_close($connect);
?>