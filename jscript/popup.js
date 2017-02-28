var popupStatus = 0;

function loadingPopup() {
    if (popupStatus == 0) {
        $("#popupBack").css({    "opacity":"0.7"    });
        $("#popupBack").fadeIn("slow");
        $("#popupOpen").fadeIn("slow");
        popupStatus = 1;
    }
}

function disablePopup() {
    if (popupStatus == 1) {
        $("#popupBack").fadeOut("slow");
        $("#popupOpen").fadeOut("slow");
        $('.popupGame').remove();
        $('.popupPlay').remove();
        popupStatus = 0;
    }
}

function centerPopup() {
    var windowWidth = document.documentElement.clientWidth;
    var windowHeight = document.documentElement.clientHeight;
    var popupHeight = $("#popupOpen").height();
    var popupWidth = $("#popupOpen").width();
    $("#popupOpen").css({    "position":"fixed", "top":windowHeight / 2.5 - popupHeight / 2.5, "left":windowWidth / 2 - popupWidth / 1.915});
    $("#popupBack").css({    "height":windowHeight});
}

function setPopup(url, lhref, game) {
    var iframe = $('<iframe></iframe>', {
        //id: game,
        width: '100%',
        height: '100%',
        frameborder: 'no',
        allowtransparency: 'no',
        src: url
        //class: 'popupGame'
    }).attr('id', game).addClass('popupGame');

    var allhref = $('<a href="'+lhref+'" target="_blank" class="popupPlay">Играть на реальные деньги</a>', {});
    //var allhref = $('<button  onclick="javascript:window.open('+lhref+')">Play for real money</button>', {});
	

    $('#popupOpen').prepend(iframe);
    $('#realHref').prepend(allhref);
    //$('#popupOpen').append(iframe);

    centerPopup();
    loadingPopup();
}

$(document).ready(function () {

    $("#popupClose").click(function () {
        disablePopup();
    });

    $("#popupBack").click(function () {
        disablePopup();
    });

    $(document).keypress(function (e) {
        if (e.keyCode == 27 && popupStatus == 1) {
            disablePopup();
        }
    });

});
