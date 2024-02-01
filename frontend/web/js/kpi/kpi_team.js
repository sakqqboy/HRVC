var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
function updateTeamKpi(kpiTeamId) {
    var url = $url + 'kpi/kpi-team/prepare-update';
    $("#kpiTeamId").val(kpiTeamId);
    resetUnit();
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kpiTeamId: kpiTeamId},
		success: function (data) {
            $("#kpi-name").html(data.kpiTeam.kpiName);
            $("#team-name").html(data.kpiTeam.teamName);
            $("#kpi-detail").html(data.kpiTeam.kpiDetail);
            $("#quant-ratio").html(data.kpiTeam.quantRatio);
            $("#priority").html(data.kpiTeam.priority);
            $("#amount-type").html(data.kpiTeam.amountType);
            $("#code").html(data.kpiTeam.codeText);
            $(".currentUnit").val(data.kpiTeam.unitId);
            $(".previousUnit").val(data.kpiTeam.unitId);
            $(".unit-" + parseInt(data.kpiTeam.unitId)).css("background-color", "#3366FF");
            $(".unit-" + parseInt(data.kpiTeam.unitId)).css("color", "white");
            $("#status-update").val(data.kpiTeam.status);
            $("#month-update").val(data.kpiTeam.month);
            $("#target-amount").val(data.kpiTeam.target);
            $("#result").val(data.kpiTeam.result);
            $("#from-date-update").val(data.kpiTeam.fromDate);
			$("#to-date-update").val(data.kpiTeam.toDate);
			$("#nextCheckDate-update").val(data.kpiTeam.nextCheckDate);
		}
	});
}
function kpiTeamHistory(kpiTeamId) {
    var url = $url + 'kpi/kpi-team/kpi-team-view';
    resetUnit();
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kpiTeamId: kpiTeamId },
        success: function (data) {
            $("#next-date-view").html(data.kpiTeam.nextCheckDateText);
            $("#kpi-name-view").html(data.kpiTeam.kpiName);
            $("#prirority-view").html(data.kpiTeam.priority);
            $("#quantRatio-view").html(data.kpiTeam.quantRatio);
            $("#unit-view").html(data.kpiTeam.unit);
            $("#target-view").html(data.kpiTeam.target);
            $("#result-view").html(data.kpiTeam.result);
            $("#percentRatio").css("width", data.kpiTeam.ratio + '%');
            $("#ratio-view").html(data.kpiTeam.ratio);
            $("#code-view").html(data.kpiTeam.code);
            $("#decription-view").html(data.kpiTeam.kpiDetail);
            $("#kpi-history").html(data.history);
        
            
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
function kpiFilterForTeam() { 
    var companyId = $("#company-filter").val();
	var branchId = $("#branch-filter").val();
	var teamId = $("#team-filter").val();
	var month = $("#month-filter").val();
	var status = $("#status-filter").val();
	var year = $("#year-filter").val();
	var type = $("#type").val();
	var url = $url + 'kpi/kpi-team/search-kpi-team';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { companyId: companyId,branchId: branchId,teamId: teamId,month: month,status: status,year: year,type:type },
		success: function (data) {
			
		}
	});
}