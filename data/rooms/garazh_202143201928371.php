<!-- load current theme -->
<?php include_once "../../load_themes.php" ?>
<!--  -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>OpenHome Control Panel</title>
	<!-- jquery ui css file -->
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css"/> 
	<!--  -->
	<link rel="stylesheet" href="../../css/style.css">

	<!-- theme style test -->
	<?php $themes = get_theme();?>
	<?php foreach($themes as $theme): ?>
		<link rel="stylesheet" href="../../css/themes/<?=$theme['style']?>.css" id="theme">
	<?php endforeach; ?>
	<!--  -->
</head>

<!-- get data from db -->
<?php include_once dirname(dirname(dirname(__FILE__)))."/iframe_url.php" ?>
<?php include_once dirname(dirname(dirname(__FILE__)))."/load_rooms.php" ?>
<!--  -->

<body>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<!-- DRAG & DROP LIBRARY -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<!-- end -->

	<div class="topline">
		<div class="main_logo">
			<img class="logo" src="../../img/mainpage_img/orange2.svg" alt="logo">
			<h1 class="main_title">Open Home</h1>
		</div>

		<div class="main_mnu">

			<!-- start settings -->
			<div class="settings">
				<div class="settings_btn__wrapper template_settings_btn__wrapper" id="settings_wrapper"></div>	
				<div class="settings_btn">
					<svg width="25px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 55.634 55.634" style="enable-background:new 0 0 55.634 55.634;" xml:space="preserve">
						<g>
							<path d="M36.583,37.243c0.129-1.356,0.09-2.707-0.106-4.026l3.049-1.359c-0.288-1.477-0.741-2.934-1.369-4.344
								c-0.628-1.409-1.408-2.72-2.312-3.923l-3.051,1.358c-0.849-1.027-1.827-1.959-2.921-2.771l1.196-3.116
								c-1.249-0.84-2.599-1.55-4.04-2.103c-1.435-0.551-2.909-0.932-4.408-1.143l-1.197,3.119c-1.356-0.129-2.707-0.09-4.026,0.106
								l-1.351-3.034c-3.018,0.593-5.838,1.873-8.259,3.702l1.342,3.014c-1.029,0.849-1.961,1.828-2.773,2.921l-3.108-1.192
								c-0.848,1.246-1.559,2.597-2.113,4.037C0.587,29.929,0.211,31.407,0,32.896l3.116,1.196c-0.129,1.356-0.09,2.707,0.106,4.026
								l-3.049,1.358c0.288,1.478,0.741,2.934,1.369,4.344c0.629,1.41,1.408,2.72,2.313,3.923l3.049-1.358
								c0.849,1.028,1.827,1.96,2.922,2.772L8.63,52.275c1.249,0.841,2.599,1.55,4.04,2.103c1.435,0.551,2.909,0.932,4.408,1.143
								l1.197-3.119c1.356,0.128,2.707,0.089,4.026-0.107l1.351,3.033c3.018-0.593,5.84-1.873,8.26-3.702l-1.343-3.014
								c1.028-0.849,1.961-1.827,2.773-2.921l3.106,1.192c0.848-1.246,1.559-2.597,2.113-4.036c0.553-1.44,0.928-2.919,1.139-4.409
								L36.583,37.243z M28.3,38.91c-1.791,4.668-7.026,6.998-11.695,5.207c-4.663-1.79-6.996-7.024-5.206-11.691
								c1.791-4.667,7.026-6.997,11.692-5.208C27.758,29.008,30.09,34.244,28.3,38.91z"/>
						</g>
						<g>
							<path d="M53.465,12.395c0-0.604-0.062-1.195-0.168-1.769l2.337-1.35c-0.566-2.152-1.69-4.079-3.227-5.601l-2.343,1.353
								c-0.894-0.766-1.93-1.366-3.063-1.766V0.559c-1.032-0.283-2.113-0.445-3.232-0.445c-1.119,0-2.199,0.164-3.232,0.445v2.704
								c-1.133,0.4-2.168,1.001-3.063,1.766L35.13,3.676c-1.535,1.522-2.66,3.449-3.227,5.601l2.338,1.35
								c-0.106,0.575-0.169,1.164-0.169,1.769s0.063,1.195,0.169,1.769l-2.338,1.35c0.567,2.152,1.692,4.08,3.227,5.601l2.343-1.353
								c0.895,0.766,1.93,1.366,3.063,1.766v2.704c1.033,0.282,2.113,0.445,3.232,0.445s2.201-0.164,3.232-0.445v-2.704
								c1.133-0.4,2.169-1.001,3.063-1.766l2.343,1.353c1.537-1.522,2.661-3.449,3.227-5.601l-2.337-1.35
								C53.403,13.589,53.465,13,53.465,12.395z M43.77,16.921c-2.5,0-4.527-2.026-4.527-4.525S41.27,7.87,43.77,7.87
								c2.497,0,4.524,2.026,4.524,4.525S46.267,16.921,43.77,16.921z"/>
						</g>
					</svg>
				</div>		
				<div class="settings__open  template_settings__open popup_block">
					<form action="../../css/style_change.js" id="settingsForm">
						<h3 class="settings_header">Settings</h3>
						<!--  -->
						<label class="settings_theme_label">Theme</label>
						<br><br>
						<!-- 1 -->
						<input 
							class="theme_type_radio" 
							type="radio" 
							name="theme_type" 
							id="classic_theme" 
							value="classic"
							<?php $themes = get_theme();?>
							<?php foreach($themes as $theme): ?>
								<?php if ( $theme['style'] == 'classic' ) {
									echo "checked";
								}?>
							<?php endforeach; ?> >
						<label class="themem_type_label" for="classic_theme">classic</label>

						<br><br>

						<!-- 2 -->
						<input 
							class="theme_type_radio" 
							type="radio" 
							name="theme_type" 
							id="dark_theme" 
							value="dark"
							<?php $themes = get_theme();?>
							<?php foreach($themes as $theme): ?>
								<?php if ( $theme['style'] == 'dark' ) {
									echo "checked";
								}?>
							<?php endforeach; ?> >
						<label class="themem_type_label" for="dark_theme">dark</label>

						<br><br>

						<!-- 3 -->
						<input 
							class="theme_type_radio" 
							type="radio" 
							name="theme_type" 
							id="light_theme" 
							value="light"
							<?php $themes = get_theme();?>
							<?php foreach($themes as $theme): ?>
								<?php if ( $theme['style'] == 'light' ) {
									echo "checked";
								}?>
							<?php endforeach; ?> >
						<label class="themem_type_label" for="light_theme">light</label>

						<br><br>

						<input type="submit" name="settingsButton" value="Change" class="btn settings_submit">
					</form>
				</div>
			</div>
			<!-- end settings -->

			<div class="add_block__btn template_svg_wrapper" id="svg_wrapper"></div>
			<div class="add_block">
				<!-- <img src="img/plus.svg" alt="add" width="15px"> -->
				<svg width="15px" height="426.66667pt" viewBox="0 0 426.66667 426.66667" width="426.66667pt" xmlns="http://www.w3.org/2000/svg">
					<path d="m405.332031 192h-170.664062v-170.667969c0-11.773437-9.558594-21.332031-21.335938-21.332031-11.773437 0-21.332031 9.558594-21.332031 21.332031v170.667969h-170.667969c-11.773437 0-21.332031 9.558594-21.332031 21.332031 0 11.777344 9.558594 21.335938 21.332031 21.335938h170.667969v170.664062c0 11.777344 9.558594 21.335938 21.332031 21.335938 11.777344 0 21.335938-9.558594 21.335938-21.335938v-170.664062h170.664062c11.777344 0 21.335938-9.558594 21.335938-21.335938 0-11.773437-9.558594-21.332031-21.335938-21.332031zm0 0"/>
				</svg>
				<div class="add_block__open popup_block template_add_block__open">
					<form action="create_frame.js" id="createFrameForm">
						<h3 class="add_block__header">Create frame</h3>
						<label for="frameName">Create Unique FrameID</label><br>
						<input type="text" 
							class="create_frame_input class_input" 
							placeholder="temperature" 
							id="frameName" 
							required 
							maxlength="20"> 

						<br><br>

						<label for="frameIP">Device IP</label><br>
						<input type="text" 
							class="create_frame_input ip_input" 
							placeholder="192.160.0.0" 
							id="frameIP" 
							required 
							pattern="\b(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\b">

						<br><br>
						<!-- input with page_name value -->
						<input type="text" value="<?php echo basename(__FILE__); ?>" style="display: none;" id="pageNameVal">
						<!--  -->
						<input type="submit" name="createFrameButton" value="Add" class="btn create_frame_btn">
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- блоки на главной странице -->
	<div class="bg">
		<div class="content room__content">

			<div class="return__btn btn">
				<a href="/" class="return__btn_link"></a>
				<svg width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 viewBox="0 0 447.243 447.243" style="enable-background:new 0 0 447.243 447.243;" xml:space="preserve">
						<path d="M420.361,192.229c-1.83-0.297-3.682-0.434-5.535-0.41H99.305l6.88-3.2c6.725-3.183,12.843-7.515,18.08-12.8l88.48-88.48
							c11.653-11.124,13.611-29.019,4.64-42.4c-10.441-14.259-30.464-17.355-44.724-6.914c-1.152,0.844-2.247,1.764-3.276,2.754
							l-160,160C-3.119,213.269-3.13,233.53,9.36,246.034c0.008,0.008,0.017,0.017,0.025,0.025l160,160
							c12.514,12.479,32.775,12.451,45.255-0.063c0.982-0.985,1.899-2.033,2.745-3.137c8.971-13.381,7.013-31.276-4.64-42.4
							l-88.32-88.64c-4.695-4.7-10.093-8.641-16-11.68l-9.6-4.32h314.24c16.347,0.607,30.689-10.812,33.76-26.88
							C449.654,211.494,437.806,195.059,420.361,192.229z"/>
				</svg>
			</div>


			<!-- DB loaded frames -->
			<div class="frameDb__content">
				<?php $frames = get_frames( basename(__FILE__) );?>
				<!-- $i - incremented element for unique IDs of resizable elements -->
				<?php $i=0;?> 
				<!--  -->
				<?php foreach($frames as $frame): ?>
					<div 
						class="mainframe resizable_content frame_initial drag_<?php echo substr(basename(__FILE__), 0, -4); ?>" 
						id="resize_<?php echo substr(basename(__FILE__), 0, -4); ?>_<?php echo $i;?>">
						<div class="frame_stat">URL: <b><?=$frame["url"]?></b>  frameID: <b><?=$frame["frameID"]?></b> </div>
						<iframe 
							src="<?=$frame["url"]?>"
							id="<?=$frame["frameID"]?>"
							class="<?=$frame["frameID"]?>_frame mainframe_content ui-widget-content drop" 
							scrolling="no" 
							frameborder="0">Ваш браузер не поддерживает Фреймы</iframe>
							<!-- onload="resizeIframe(this);" - добавить как атрибут iframe--> 
					</div>
					<?php $i++;?>
				<?php endforeach; ?>
			</div>
			<!--end DB load -->


			<!-- Change Frame Popup-Menu -->
			<div class="update_block__open popup_block">
				<form action="custom_mnu.js" id="updateFrameForm">
					<h3 class="update_block__header">Update frame</h3>
					<label for="updateframeName">Update Unique FrameID</label><br>
					<input type="text" 
						class="create_frame_input class_input" 
						placeholder="temperature" 
						id="updateframeName"
						required 
						maxlength="20"> 

					<br><br>

					<label for="updateframeIP">Device IP</label><br>
					<input type="text" 
						class="create_frame_input ip_input" 
						placeholder="192.160.0.0" 
						id="updateframeIP" 
						required 
						pattern="\b(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\b">

					<br><br>

					<input type="submit" name="updateFrameButton" value="Update" class="btn update_frame_btn">
					<input type="reset" name="cancelUpdateFrame" value="Reset" class="btn cancel_frame_btn">
				</form>
				
			</div>
			<!-- /end change frame popup -->

			<!-- invis input to get last clicked iframe id -->
			<input type="text" value="" id="lastFrameValue" style="display: none">
			<input type="text" value="" id="lastBlockType" style="display: none">
			<!--  -->

			<!-- invis unput to get page style -->
			<input type="text" value="classic" id="pageStyle" style="display: none;">
		</div>
	</div>

	<!-- /блоков -->

	<!-- Custom context menu -->
	<ul class="custom-menu" id="frameContextMnu">
		<li data-action="add" class="custom-menu__item" id="addFrameItem">
			<svg width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 viewBox="0 0 352.4 352.4" style="enable-background:new 0 0 352.4 352.4;" xml:space="preserve">
				<g>
					<path d="M332.6,16.4C322.2,6,308.2,0,292.6,0h-54v21.6h53.6c9.6,0,18.4,4,24.8,10.4c6.4,6.4,10.4,15.2,10.4,24.8V114H349V56.4
						C349,40.8,342.6,26.8,332.6,16.4z"/>
					<path d="M35.4,320C29,313.6,25,304.8,25,295.2v-56.8H3.4v57.2c0,15.6,6.4,29.6,16.4,40c10.8,10,24.8,16.4,40.4,16.4h53.6v-21.6
						H60.2C50.6,330.4,41.8,326.4,35.4,320z"/>
					<path d="M327,295.6c0,9.6-4,18.4-10.4,24.8c-6.4,6.4-15.2,10.4-24.8,10.4h-53.2v21.6h53.6c15.6,0,29.6-6.4,40-16.4
						c10.4-10.4,16.4-24.4,16.4-40v-57.6H327V295.6z"/>
					<path d="M20.2,16.4C9.8,26.8,3.8,40.8,3.8,56.4v57.2h21.6V56.4c0-9.6,4-18.4,10.4-24.8c6.4-6.4,15.2-10.4,24.8-10.4h53.6V0h-54
						C44.6,0,30.6,6.4,20.2,16.4z"/>
				</g>
			</svg>
			<div class="custom-menu__text">Add Frame</div>
		</li>
		<li data-action="change" class="custom-menu__item iframe_custom" id="changeFrameItem">
			<svg width="20px" viewBox="0 0 512 511" xmlns="http://www.w3.org/2000/svg">
				<path d="m405.332031 256.484375c-11.796875 0-21.332031 9.558594-21.332031 21.332031v170.667969c0 11.753906-9.558594 21.332031-21.332031 21.332031h-298.667969c-11.777344 0-21.332031-9.578125-21.332031-21.332031v-298.667969c0-11.753906 9.554687-21.332031 21.332031-21.332031h170.667969c11.796875 0 21.332031-9.558594 21.332031-21.332031 0-11.777344-9.535156-21.335938-21.332031-21.335938h-170.667969c-35.285156 0-64 28.714844-64 64v298.667969c0 35.285156 28.714844 64 64 64h298.667969c35.285156 0 64-28.714844 64-64v-170.667969c0-11.796875-9.539063-21.332031-21.335938-21.332031zm0 0"/>
				<path d="m200.019531 237.050781c-1.492187 1.492188-2.496093 3.390625-2.921875 5.4375l-15.082031 75.4375c-.703125 3.496094.40625 7.101563 2.921875 9.640625 2.027344 2.027344 4.757812 3.113282 7.554688 3.113282.679687 0 1.386718-.0625 2.089843-.210938l75.414063-15.082031c2.089844-.429688 3.988281-1.429688 5.460937-2.925781l168.789063-168.789063-75.414063-75.410156zm0 0"/>
				<path d="m496.382812 16.101562c-20.796874-20.800781-54.632812-20.800781-75.414062 0l-29.523438 29.523438 75.414063 75.414062 29.523437-29.527343c10.070313-10.046875 15.617188-23.445313 15.617188-37.695313s-5.546875-27.648437-15.617188-37.714844zm0 0"/>
			</svg>
			<div class="custom-menu__text">Change Frame</div>
		</li>
		<li data-action="changeRoom" class="custom-menu__item room_custom" id="changeRoomItem">
			<svg width="20px" viewBox="0 0 512 511" xmlns="http://www.w3.org/2000/svg">
				<path d="m405.332031 256.484375c-11.796875 0-21.332031 9.558594-21.332031 21.332031v170.667969c0 11.753906-9.558594 21.332031-21.332031 21.332031h-298.667969c-11.777344 0-21.332031-9.578125-21.332031-21.332031v-298.667969c0-11.753906 9.554687-21.332031 21.332031-21.332031h170.667969c11.796875 0 21.332031-9.558594 21.332031-21.332031 0-11.777344-9.535156-21.335938-21.332031-21.335938h-170.667969c-35.285156 0-64 28.714844-64 64v298.667969c0 35.285156 28.714844 64 64 64h298.667969c35.285156 0 64-28.714844 64-64v-170.667969c0-11.796875-9.539063-21.332031-21.335938-21.332031zm0 0"/>
				<path d="m200.019531 237.050781c-1.492187 1.492188-2.496093 3.390625-2.921875 5.4375l-15.082031 75.4375c-.703125 3.496094.40625 7.101563 2.921875 9.640625 2.027344 2.027344 4.757812 3.113282 7.554688 3.113282.679687 0 1.386718-.0625 2.089843-.210938l75.414063-15.082031c2.089844-.429688 3.988281-1.429688 5.460937-2.925781l168.789063-168.789063-75.414063-75.410156zm0 0"/>
				<path d="m496.382812 16.101562c-20.796874-20.800781-54.632812-20.800781-75.414062 0l-29.523438 29.523438 75.414063 75.414062 29.523437-29.527343c10.070313-10.046875 15.617188-23.445313 15.617188-37.695313s-5.546875-27.648437-15.617188-37.714844zm0 0"/>
			</svg>
			<div class="custom-menu__text">Change Room</div>
		</li>
		<li data-action="delete" class="custom-menu__item content_block_custom" id="deleteFrameItem">
			<svg width="20px" viewBox="-57 0 512 512" xmlns="http://www.w3.org/2000/svg">
				<path d="m156.371094 30.90625h85.570312v14.398438h30.902344v-16.414063c.003906-15.929687-12.949219-28.890625-28.871094-28.890625h-89.632812c-15.921875 0-28.875 12.960938-28.875 28.890625v16.414063h30.90625zm0 0"/>
				<path d="m344.210938 167.75h-290.109376c-7.949218 0-14.207031 6.78125-13.566406 14.707031l24.253906 299.90625c1.351563 16.742188 15.316407 29.636719 32.09375 29.636719h204.542969c16.777344 0 30.742188-12.894531 32.09375-29.640625l24.253907-299.902344c.644531-7.925781-5.613282-14.707031-13.5625-14.707031zm-219.863282 312.261719c-.324218.019531-.648437.03125-.96875.03125-8.101562 0-14.902344-6.308594-15.40625-14.503907l-15.199218-246.207031c-.523438-8.519531 5.957031-15.851562 14.472656-16.375 8.488281-.515625 15.851562 5.949219 16.375 14.472657l15.195312 246.207031c.527344 8.519531-5.953125 15.847656-14.46875 16.375zm90.433594-15.421875c0 8.53125-6.917969 15.449218-15.453125 15.449218s-15.453125-6.917968-15.453125-15.449218v-246.210938c0-8.535156 6.917969-15.453125 15.453125-15.453125 8.53125 0 15.453125 6.917969 15.453125 15.453125zm90.757812-245.300782-14.511718 246.207032c-.480469 8.210937-7.292969 14.542968-15.410156 14.542968-.304688 0-.613282-.007812-.921876-.023437-8.519531-.503906-15.019531-7.816406-14.515624-16.335937l14.507812-246.210938c.5-8.519531 7.789062-15.019531 16.332031-14.515625 8.519531.5 15.019531 7.816406 14.519531 16.335937zm0 0"/><path d="m397.648438 120.0625-10.148438-30.421875c-2.675781-8.019531-10.183594-13.429687-18.640625-13.429687h-339.410156c-8.453125 0-15.964844 5.410156-18.636719 13.429687l-10.148438 30.421875c-1.957031 5.867188.589844 11.851562 5.34375 14.835938 1.9375 1.214843 4.230469 1.945312 6.75 1.945312h372.796876c2.519531 0 4.816406-.730469 6.75-1.949219 4.753906-2.984375 7.300781-8.96875 5.34375-14.832031zm0 0"/>
			</svg>
			<div class="custom-menu__text">Delete</div>
		</li>
	</ul>
	<!--  -->

	<script>
		$("document").ready(function() {

			// change blcok size
			var size = JSON.parse(localStorage.size || "{}");

			$.each(size, function (id, siz) {
				$("#" + id).css(siz)
			})

			$('.resizable_content').resizable({
				containment: ".content",
				scroll: true,
				stop: function (event, ui) {
					size[this.id] = ui.size
					localStorage.size = JSON.stringify(size)
				}
			});
			//----------

			// $( ".resizable_content" ).resizable({
			// 	// animate: true,
			// 	handles: "se",
			// 	stop: function(evet, ui) {
			// 		let resElem = document.getElementById(this.id);
			// 		var w = ui.size.width;
			// 		var h = ui.size.height;
			// 		console.log(w, h);
			// 		resElem.style.height = h;
			// 		resElem.style.width = w;
			// 	},
			// 	resize: function( event, ui ) {
			// 	}
			// });
			//--------------------

			//сохранять позицию элемента в LocalStorage
			var url = window.location.pathname;
			var filename = url.substring(url.lastIndexOf('/')+1);
			var cleanFilename = filename.substring(0, filename.length-4);

			var draggableClass = ".drag_" + cleanFilename;
			//------------
			var sPositions = localStorage.positions || "{}",
				positions = JSON.parse(sPositions);
			$.each(positions, function (id, pos) {
				$("#" + id).css(pos)
			})
			$(draggableClass).draggable({
				containment: ".content",
				scroll: false,
				stop: function (event, ui) {
					// console.log( $("#" + this.id) );
					// console.log(this.id);
					positions[this.id] = ui.position
					localStorage.positions = JSON.stringify(positions)
				}
			});
		});
	</script>

	<script src="../../weather.js"></script>
	<script src="../../create_frame.js"></script> 
	<!-- custom menu js -->
	<script src="../../custom_mnu.js"></script>
	<!-- clock frame -->
	<script src="../../clock.js"></script>
	<!-- change page theme -->
	<script src="../../css/style_change.js"></script>
	<!--  -->
	<!-- <script src="../../create_room.js"></script> -->
	<!--  -->
</body>
</html>