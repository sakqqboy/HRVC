var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;

function selectUnit(currentUnit) {
    var previous = $("#currentUnit").val();
    if (previous != '') {
        $("#previousUnit").val(previous);
        $("#unit-" + previous).css("background-color", "white");
    }

    $("#currentUnit").val(currentUnit);
    $("#unit-" + currentUnit).css("background-color", "gray");

}