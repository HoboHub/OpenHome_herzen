$(document).ready(function () {
  var form = $("#createFrameForm");

  //Открытие формы-----------------------------
  var svg = $("#svg_wrapper");
  var addFrame = $(".add_block__open");

  svg.on("click", function () {
    if (addFrame.hasClass("visible")) {
      addFrame.removeClass("visible");
    } else {
      addFrame.addClass("visible");
    }
  });

  $(document).click(function (e) {
    if (
      !svg.is(e.target) &&
      !addFrame.is(e.target) &&
      addFrame.has(e.target).length === 0 &&
      !$("#addFrameItem").is(e.target) &&
      $("#addFrameItem").has(e.target).length === 0
    ) {
      addFrame.removeClass("visible");
    }
  });

  // ----------------------
  //------------------------------------------

  document
    .querySelector("#createFrameForm")
    .addEventListener("submit", function (e) {
      e.preventDefault(); //устраняет перезагрузку страницы
    });

  //--------Ресайз размеров фрейма под ширину контента-------

  // function iframeLoaded(frameId) {
  // 	var iFrameID = document.getElementById(frameId);
  // 	if(iFrameID) {
  // 		iFrameID.height = "";
  // 		iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
  // 	}
  // }
  //-----------------------------

  //-----Создание фрейма----------------------
  $(form).submit(createFrame);

  function createFrame() {
    let frameName = $("#frameName").val();
    let frameIP = $("#frameIP").val();

    // var frame = document.createElement("iframe");

    // frameContainer.setAttribute("id", frameName+'_frame_container frame_container');
    // frameContainer.setAttribute("style", "overflow:hidden; padding-top:56.25%; position:relative;");

    // frame.setAttribute("src", 'http://'+frameIP);
    // frame.setAttribute("class", frameName+'_frame mainframe'); //классс состоит из frameName (classID) + _frame
    // frame.setAttribute("scrolling", "no"); //убрать скроллбар
    // frame.setAttribute("id", frameName); //задавать не ClassName а уникальный classID !!!!!

    // $('.content').append(frame);

    save_iframe(frameName, frameIP); //добавление фрейма в бд

    form[0].reset(); //очистка данных из input после submit
    setTimeout(location.reload(), 2000);
  }

  //-------------------------------------------------
  //Сохранение frame в БД
  //-------------------------------------------------
  function save_iframe(frameId, frameIP) {
    $url = "http://" + frameIP;
    $pageName = $("#pageNameVal").val();
    if ($pageName == "mainpage") {
      $.post("iframe_save.php", {
        url: $url,
        frameID: frameId,
        pageName: $pageName,
      }).done(function (data) {
        console.log(data);
      });
    } else {
      $.post("../../iframe_save.php", {
        url: $url,
        frameID: frameId,
        pageName: $pageName,
      }).done(function (data) {
        console.log(data);
      });
    }
  }
  //------------------------------------

  //show url and frameID on hover-------------(NEED TO BE CHANGEABLE WTH USER SETTINGS)--------
  $(".mainframe").hover(function () {
    $(".frame_stat").toggleClass("visible_block");
  });
  //-------------------------------------------------------------------------------------
});
