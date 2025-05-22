"use strict";

//global variables
var addFrame = $('.add_block__open');
var updateForm = $('#updateFrameForm');

var updateFrame = $('.update_block__open');

// ------------------------------------------------

//Open/Close Update Form -----------------------------
$(document).click(function (e) {
    if ( !updateFrame.is(e.target) && updateFrame.has(e.target).length === 0 
        && !$('#changeFrameItem').is(e.target) && $('#changeFrameItem').has(e.target).length === 0) {
        updateFrame.removeClass('visible');
    };
});
//--------------------------------------------------

// Trigger action when the contexmenu is about to be shown
$(document).on("contextmenu", function (event) {
    
    //triger custom-menu only in content box
    if ( $(event.target).hasClass("content") || $(event.target).hasClass("mainframe") || $(event.target).hasClass("mainroom") ||
        $(event.target).parents().hasClass("mainroom") ) {
        // Avoid the real one
        event.preventDefault();

        //add contextmenu items if clicked on room
        if ( $(event.target).hasClass("mainroom") || $(event.target).parents().hasClass("mainroom") ) {
            //
            $('.room_custom').addClass("visible_block");
            // 
        } else if ( !$(event.target).hasClass("mainroom") &&  $('.room_custom').hasClass("visible_block")) {
            // 
            $('.room_custom').removeClass("visible_block");
            // 
        }

        //add contextmenu items if clicked on frame
        if ( $(event.target).hasClass("mainframe") ) {
            //
            $('.iframe_custom').addClass("visible_block");
            // 
        } else if ( !$(event.target).hasClass("mainframe") &&  $('.iframe_custom').hasClass("visible_block")) {
            // 
            $('.iframe_custom').removeClass("visible_block");
            // 
        }

        //add contextmenu items if clicked on content block (frame, room)
        if ( $(event.target).hasClass("mainroom") || $(event.target).hasClass("mainframe") || $(event.target).parents().hasClass("mainroom") ) {
            //
            $('.content_block_custom').addClass("visible_block");
            // 
        } else if ( (!$(event.target).hasClass("mainroom") || !$(event.target).hasClass("mainframe")) && $('.content_block_custom').hasClass("visible_block")) {
            // 
            $('.content_block_custom').removeClass("visible_block");
            // 
        }
        //

        // Show contextmenu
        $(".custom-menu").finish().toggle(50).
        // In the right position (the mouse)
        css({
            top: event.pageY - 10 + "px",
            left: event.pageX + "px"
        });
        //-----------

        //remove update menu after new click
        if ( $('.update_block__open').hasClass("visible") ) {
            $('.update_block__open').removeClass("visible");
        }
        //---

        //update menu appearing near custom-menu 
        $('.update_block__open').css({
            top: event.pageY - 100 + "px",
            left: event.pageX + "px"
        });
        //
    }
});


// If the document is clicked somewhere
$(document).bind("mousedown", function (e) {
    // If the clicked element is not the menu
    if (!$(e.target).parents(".custom-menu").length > 0) {
        // Hide
        $(".custom-menu").hide(100);
    }
});


//custom menu items funcs (delete, change, add)
$(document).ready(function(){
    //
    $(updateForm).submit(updateFrameFunc);
    //update data in frame
    function updateFrameFunc(e) {
        e.preventDefault();
        let $newFrameName = $('#updateframeName').val();
        let $newFrameIP = $('#updateframeIP').val();
        let $oldFrameName = $("#lastFrameValue").val();

        update_iframe($oldFrameName, $newFrameName, $newFrameIP);

        //clean the inputs
        updateForm[0].reset();
        $(".update_block__open").removeClass("visible");
        location.reload(); //update page
    };
    //---
    function update_iframe(oldFrameName, frameId, frameIP) {
        let $url = 'http://'+frameIP;
        // let updatedFrame = document.getElementById($("#lastFrameValue").val());
        // console.log(updatedFrame);
        // updatedFrame.src = $url;
        $.post("update_frame.php", {url: $url, frameID: frameId, oldFrameName: oldFrameName}).done(function(data){
            console.log(data);
        });
    };
    //---------------------------------------

    // document event listener to catch last clicked iframe
    // $("iframe").on("contextmenu", function(){
    //     // console.log(this);
    //     var lastClickedFrameId = this.id;
    //     console.log(lastClickedFrameId);
    //     $("#lastFrameValue").val(lastClickedFrameId);
    // });

    $(".mainframe").on("contextmenu", function(){
        if ($(this).hasClass('preset_frame')) {
            // console.log('has preset frame');
            var lastClickedFrameId = this.id;
            $('#lastBlockType').val('frame');
            // console.log(lastClickedFrameId);
        } else {
            var lastClickedFrameId = $(this).children('iframe').attr('id');
            $('#lastBlockType').val('frame');
            // console.log(lastClickedFrameId);
            $("#lastFrameValue").val(lastClickedFrameId);
        }
    });

    $(".mainroom").on("contextmenu", function(){
        // console.log(this);
        var lastClickedFrameId = $(this).children('.mainroom__content').attr('id');
        var lastClickedRoomFile = $(this).attr('filename');
        $('#lastBlockType').val('room');
        $("#lastFrameValue").val(lastClickedFrameId);
        $('#lastFileName').val(lastClickedRoomFile);
    });

    // If the menu element is clicked (CUSTOM MENU ITEMS SETT)----------
    $(".custom-menu li").click(function(){
        // This is the triggered action name
        switch($(this).attr("data-action")) {
            // A case for each action. Your actions here------------

            case "add":
                addFrame.addClass("visible");
                $("html, body").animate({scrollTop: $("body").offset().top}); //scroll up
                break;

            case "delete":
                let frameID = $("#lastFrameValue").val();
                let blockType = $("#lastBlockType").val();
                let fileName = $('#lastFileName').val();
                // console.log(fileName);
                console.log(frameID);
                //room or frame delete
                if (blockType == 'frame') {
                    //Check if it's mainpage or sub (rooms can only contain frames). 
                    var path = window.location.pathname;
                    if(path.includes("data/rooms/")) {
                        // ajax request to delete frame from db (subpages)
                        $.post("../../delete_form.php", {frameID: frameID}).done(function(data){
                            console.log(data);
                        });
                    }
                    else {
                        // ajax request to delete frame from db (mainpage)
                        $.post("delete_form.php", {frameID: frameID}).done(function(data){
                            console.log(data);
                        });
                    }
                } 
                else if (blockType == 'room') {
                    // ajax request to delete room from db
                    $.post("delete_room.php", {frameID: frameID, pageName: fileName}).done(function(data){
                        console.log(data);
                    });
                }
                // location.reload(); 
                setTimeout(location.reload(), 2000);
                break;

            case "change":
                $(".update_block__open").addClass("visible");
                break;

            case "addRoom":
                $(".add_room__open").addClass("visible");
                $("html, body").animate({scrollTop: $("body").offset().top});
                break;

            case "changeRoom":
                alert("changing room");
                break;

            //--------------------
        }
  
        // Hide AFTER the action was triggered
        $(".custom-menu").hide(100);
  });
});
// end document.ready
