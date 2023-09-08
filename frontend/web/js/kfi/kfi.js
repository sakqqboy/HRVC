var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;

function selectUnit(currentUnit) {
    var previous = $("#currentUnit").val();
    var previous = $(".currentUnit").val();
    if (previous != '') {
        $("#previousUnit").val(previous);
        $(".previousUnit").val(previous);
        $("#unit-" + previous).css("background-color", "white");
        $(".unit-" + previous).css("background-color", "white");
    }

    $("#currentUnit").val(currentUnit);
    $(".currentUnit").val(currentUnit);
    $("#unit-" + currentUnit).css("background-color", "gray");
    $(".unit-" + currentUnit).css("background-color", "gray");

}

function updateKfi(kfiId) {
    $("#staticBackdrop2").show();
    var url = $url + 'kfi/management/update-kfi';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kfiId: kfiId },
        success: function(data) {
            if (data.status) {
                $("#kfiName").val(data.kfiName);
                $(".currentUnit").val(data.unitId);
                $("#companyName").val(data.companyName);
                $("#branchName").val(data.branchName);
                $(".unit-" + parseInt(data.unitId)).css("background-color", "gray");
                $("#targetAmount").val(data.targetAmount);
                $("#kfiDetail").val(data.detail);
                $("#quantRatio").val(data.quantRatio);
                $("#monthName").val(data.monthName);
            }

        }
    });
}