<?php
	function get_frames($pageName)
	{
		// echo "<h1>This is page name: {$pageName}</h1>";

		//connection settings 
		$servername = "openhome.esp";
		$username = "root";
		$password = "";
		$database = "openhome";
		//------------------

		//connection--------------------------
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

		$connect = mysqli_connect($servername, $username, $password, $database);
		// Проверяем соединение
		if (!$connect) {
			die("Не удалось подклюючиться к MySQL: " . mysqli_connect_error());
		}
		// echo "Соединение установленно. ";
		//---------------------------------

		// $pageName = $_GET['pageName'];

		//Query----------------------------------------------
		// $query = mysqli_query($connect, "SELECT * from `frames` ORDER BY `id` ASC"); //asc - сортировка по возрастания (id)
		$query = "SELECT * from `frames` WHERE `page_name` = '$pageName'";
		$result = mysqli_query($connect, $query);

		if ($result) {
			$frames = [];
			// echo "<p>$result</p>";
			while ($frame = $result->fetch_assoc()) { //fetch_row
				$frames[] = $frame;
			}
		} 
		else {
			printf("Сообщение ошибки: %s\n", mysqli_error( $link ) );
		}

		// echo "<h1>This is page name: {$pageName}</h1>";
		return $frames;
		//----------------------------------------------------

		//Closing connection
		mysqli_close($connect);		
	}
?>