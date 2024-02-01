var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
function updateTeamKgi(kgiTeamId) {
    var url = $url + 'kgi/kgi-team/prepare-update';
    $("#kgiTeamId").val(kgiTeamId);
    resetUnit();
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kgiTeamId: kgiTeamId},
		success: function (data) {
            $("#kgi-name").html(data.kgiTeam.kgiName);
            $("#team-name").html(data.kgiTeam.teamName);
            $("#kgi-detail").html(data.kgiTeam.kgiDetail);
            $("#quant-ratio").html(data.kgiTeam.quantRatio);
            $("#priority").html(data.kgiTeam.priority);
            $("#amount-type").html(data.kgiTeam.amountType);
            $("#code").html(data.kgiTeam.codeText);
            $(".currentUnit").val(data.kgiTeam.unitId);
            $(".previousUnit").val(data.kgiTeam.unitId);
            $(".unit-" + parseInt(data.kgiTeam.unitId)).css("background-color", "#3366FF");
            $(".unit-" + parseInt(data.kgiTeam.unitId)).css("color", "white");
            $("#status-update").val(data.kgiTeam.status);
            $("#month-update").val(data.kgiTeam.month);
            $("#target-amount").val(data.kgiTeam.target);
            $("#result").val(data.kgiTeam.result);
            $("#from-date-update").val(data.kgiTeam.fromDate);
			$("#to-date-update").val(data.kgiTeam.toDate);
			$("#nextCheckDate-update").val(data.kgiTeam.nextCheckDate);
		}
	});
}
function kgiTeamHistory(kgiTeamId) {
    var url = $url + 'kgi/kgi-team/kgi-team-view';
    resetUnit();
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kgiTeamId: kgiTeamId },
        success: function (data) {
            $("#next-date-view").html(data.kgiTeam.nextCheckDateText);
            $("#kgi-name-view").html(data.kgiTeam.kgiName);
            $("#prirority-view").html(data.kgiTeam.priority);
            $("#quantRatio-view").html(data.kgiTeam.quantRatio);
            $("#unit-view").html(data.kgiTeam.unit);
            $("#target-view").html(data.kgiTeam.target);
            $("#result-view").html(data.kgiTeam.result);
            $("#percentRatio").css("width", data.kgiTeam.ratio + '%');
            $("#ratio-view").html(data.kgiTeam.ratio);
            $("#code-view").html(data.kgiTeam.code);
            $("#decription-view").html(data.kgiTeam.kgiDetail);
            $("#kgi-history").html(data.history);
        
            
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
function kgiFilterForTeam() { 
    var companyId = $("#company-filter").val();
	var branchId = $("#branch-filter").val();
	var teamId = $("#team-filter").val();
	var month = $("#month-filter").val();
	var status = $("#status-filter").val();
	var year = $("#year-filter").val();
	var type = $("#type").val();
	var url = $url + 'kgi/kgi-team/search-kgi-team';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { companyId: companyId,branchId: branchId,teamId: teamId,month: month,status: status,year: year,type:type },
		success: function (data) {
			
		}
	});
}