
$(document).ready(function () {
    $("#btttn-left").click(function () {
        $("index1").removeClass("col-lg-12");
        $("index1").addClass("col-lg-10");
    });
});

$(document).ready(function () {
    $("#index1").click(function () {
        $("index1").removeClass("col-lg-10");
        $("index1").addClass("col-lg-12");
    })
})

$('#cssmenu ul ul li:odd').addClass('odd');
$('#cssmenu ul ul li:even').addClass('even');
$('#cssmenu > ul > li > a').click(function () {
    $('#cssmenu li').removeClass('active');
    $(this).closest('li').addClass('active');
    var checkElement = $(this).next();
    if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
        $(this).closest('li').removeClass('active');
        checkElement.slideUp('normal');
    }
    if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
        $('#cssmenu ul ul:visible').slideUp('normal');
        checkElement.slideDown('normal');
    }
    if ($(this).closest('li').find('ul').children().length == 0) {
        return true;
    } else {
        return false;
    }
});

$(function () {
    $('.menu').click(function () {
        $('#header-menu').css({ left: '0' });
    });
    $('.close-menu').click(function () {
        $('#header-menu').css({ left: '-340px' });
    });
});