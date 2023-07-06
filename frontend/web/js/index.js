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
$(document).ready(function () {
    $(".slide-toggle").click(function () {
        $(".header1").animate({
            width: "toggle"
        });
    });
});

function showHrvc2() {
    $("#HRVC").css("display", "none");
    $("#HRVC2-").show();
}

function showHrvc1() {
    $("#HRVC2").css("display", "none");
    $("#HRVC").show();
}
