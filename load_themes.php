<?php
	function get_theme()
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
		//---------------------------------

		//Query----------------------------------------------
		$query = "SELECT `style` FROM `pages` WHERE id=(SELECT max(id) FROM `pages`)";
		$result = mysqli_query($connect, $query);

		if ($result) {
			$themes = [];

			while ($theme = $result->fetch_assoc()) { //fetch_row
				$themes[] = $theme;
			}

		} 
		else {
			printf("Сообщение ошибки: %s\n", mysqli_error( $link ) );
		}

		return $themes;
		//----------------------------------------------------

		//Closing connection
		mysqli_close($connect);		
	}
?>