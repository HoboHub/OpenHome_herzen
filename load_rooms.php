<?php
	function get_rooms()
	{
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

		//Query----------------------------------------------
		// $query = mysqli_query($connect, "SELECT * from `frames` ORDER BY `id` ASC"); //asc - сортировка по возрастания (id)
		$query = "SELECT * from `rooms`";
		$result = mysqli_query($connect, $query);

		if ($result) {
			$rooms = [];

			while ($rum = $result->fetch_assoc()) { //fetch_row
				$rooms[] = $rum;
				// echo "<script>console.log(".$result->fetch_assoc().");</script>";
			}
		} 
		else {
			printf("Сообщение ошибки: %s\n", mysqli_error( $link ) );
		}
		return $rooms;
		//----------------------------------------------------

		//Closing connection
		mysqli_close($connect);		
	}
?>