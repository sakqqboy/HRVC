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
        $("#unit-" + previous).css("color", "black");
        $(".unit-" + previous).css("color", "black");
    }

    $("#currentUnit").val(currentUnit);
    $(".currentUnit").val(currentUnit);
    $("#unit-" + currentUnit).css("background-color", "#3366FF");
    $(".unit-" + currentUnit).css("background-color", "#3366FF");
    $("#unit-" + currentUnit).css("color", "white");
    $(".unit-" + currentUnit).css("color", "white");

}

function updateKfi(kfiId) {

    resetUnit();
    $("#staticBackdrop2").show();
    $("#update-kfi")[0].reset();
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
                $(".unit-" + parseInt(data.unitId)).css("background-color", "#3366FF");
                $(".unit-" + data.unitId).css("color", "white");
                $("#targetAmount").val(data.targetAmount);
                $("#kfiDetail").val(data.detail);
                $("#quantRatio").val(data.quantRatio);
                $("#monthName").val(data.monthName);
                $("#amountType").val(data.amountType);
                $("#code").val(data.code);
                $("#kfiStatus").val(data.kfiStatus);
                $("#kfiId").val(kfiId);
            }

        }
    });
}

function resetUnit() {
    $(".unit-1").css("color", "black");
    $(".unit-1").css("background-color", "white");

    $(".unit-2").css("color", "black");
    $(".unit-2").css("background-color", "white");
    $(".unit-3").css("color", "black");
    $(".unit-3").css("background-color", "white");
    $(".unit-4").css("color", "black");
    $(".unit-4").css("background-color", "white");
    $(".currentUnit").val('');
    $(".previousUnit").val('');
}