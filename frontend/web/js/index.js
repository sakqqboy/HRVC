var i = 0;
function move() {
    if (i == 0) {
        i = 1;
        var elem = document.getElementById("myBar");
        var width = 10;
        var id = setInterval(frame, 10);
        function frame() {
            if (width >= 100) {
                clearInterval(id);
                i = 0;
            } else {
                width++;
                elem.style.width = width + "%";
                elem.innerHTML = width + "%";
            }
        }
    }
}
$(indexmenu).ready(function () {
    $(".slide-toggle").click(function () {
        $(".header1").animate({
            width: "toggle"
        });
    });
});

function showHrvc2(i) {
    $("#HRVC-" + i).css("display", "none");
    $("#HRVC2-" + i).show();
}

function showHrvc1(i) {
    $("#HRVC2-" + i).css("display", "none");
    $("#HRVC-" + i).show();
}
