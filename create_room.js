$(document).ready(function() {

	var roomForm = $('#createRoomForm');

	//Открытие формы-----------------------------
	var roomBtn = $('.add_room_btn__wrapper');
	var addRoom = $('.add_room__open');

	roomBtn.on('click', function() {
		if ( addRoom.hasClass('visible') ) {
			addRoom.removeClass('visible');
		} else {
			addRoom.addClass('visible');
		}
	});

	$(document).click(function (e) {
		if ( !roomBtn.is(e.target) && !addRoom.is(e.target) && addRoom.has(e.target).length === 0 
			&& !$('#addRoomItem').is(e.target) && $('#addRoomItem').has(e.target).length === 0) {
			addRoom.removeClass('visible');
		};
	});

	// ----------------------
	//------------------------------------------

	document.querySelector("#createRoomForm").addEventListener("submit", function(e){
		e.preventDefault();    //устраняет перезагрузку страницы 
	});


	//-----Создание комнаты----------------------
	$(roomForm).submit(createRoom);

	function createRoom() {
		let roomName = $('#roomName').val();

		let selectedIcon = $("input[name='room_type']:checked").val();

		//set unique identifier for future changes
		var now = new Date();
		let timestamp = now.getFullYear().toString();
		timestamp += (now.getMonth < 9 ? '0' : '') + now.getMonth().toString(); // JS months are 0-based (+1 and pad with 0's)
		timestamp += ((now.getDate < 10) ? '0' : '') + now.getDate().toString(); // pad with a 0
		timestamp += ((now.getHours < 10) ? '0' : '') + now.getHours().toString();
		timestamp += ((now.getMinutes < 10) ? '0' : '') + now.getMinutes().toString();
		timestamp += ((now.getSeconds < 10) ? '0' : '') + now.getSeconds().toString();
		timestamp += ((now.getMilliseconds < 10) ? '0' : '') + now.getMilliseconds().toString();
		// --------------------

		save_room(roomName, selectedIcon, timestamp);

		roomForm[0].reset();
		addRoom.removeClass('visible');
		setTimeout(location.reload(), 2000); //---reload page after submit
	};

	//-------------------------------------------------
		//Сохранение room в БД
	//-------------------------------------------------
	function save_room(roomName, selectedIcon, timestamp){
		$.post("create_room.php", {roomName: roomName, selectedIcon: selectedIcon, timestamp: timestamp}).done(function(data){
			console.log(data);
		});
	}
	//------------------------------------

});