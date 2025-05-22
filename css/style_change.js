"use strict";

$(document).ready(function() {

	//Открытие формы-----------------------------
	var setForm = $('#settingsForm');
	var setBtn = $('.settings_btn__wrapper');
	var settings = $('.settings__open');

	setBtn.on('click', function() {
		if ( settings.hasClass('visible') ) {
			settings.removeClass('visible');
		} else {
			settings.addClass('visible');
		}
	});

	$(document).click(function (e) {
		if ( !setBtn.is(e.target) && !settings.is(e.target) && settings.has(e.target).length === 0) {
			settings.removeClass('visible');
		};
	});

	// ----------------------
	//------------------------------------------------------------------------

	document.querySelector("#settingsForm").addEventListener("submit", function(e){
		e.preventDefault();    //устраняет перезагрузку страницы 
	});
	
	var link = document.getElementById('theme');

	$('.theme_type_radio').click(function() {
		let themeVal = $(this).val();

		// link.href = "css/themes/"+ themeVal +".css";
		$('#pageStyle').val(themeVal);
	});

	// console.log("theme value is"themeVal);
	$('#settingsForm').submit(take_theme);
	//-------

	function take_theme() {
		let themeVal = $('#pageStyle').val();
		save_theme(themeVal);
	}

	//--------
	function save_theme(themeName){
		// console.log(themeName);
		if ( $("#pageNameVal").val() == 'mainpage' ) {
			$.post("../change_style.php", {themeName: themeName}).done(function(data){
				console.log(data);
			});
		}
		else {
			$.post("../../change_style.php", {themeName: themeName}).done(function(data){
				console.log(data);
			});			
		}
		setTimeout(location.reload(), 2000);
		
		// setTimeout(location.reload(), 2000);
	};
	//--------
});