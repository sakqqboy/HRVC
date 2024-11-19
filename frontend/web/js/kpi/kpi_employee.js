var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
	$baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
	$baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
function prepareDeleteKpiEmployee(kpiEmployeeId) {
	// $("#kpiEmployeeId-modal").val(kpiEmployeeId);
	// alert(kpiEmployeeId);
	// $("#delete-kpi-employee").modal('show');
	$("#kpiEmployeeId-modal").val(kpiEmployeeId);
}
function deleteKpiEmployee() {
	var kpiEmployeeId = $("#kpiEmployeeId-modal").val();
	var url = $url + 'kpi/kpi-personal/delete-kpi-personal';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kpiEmployeeId: kpiEmployeeId },
		success: function (data) {
			if (data.status) {
				$("#delete-kpi-personal").modal("hide");
				$("#kpi-employee-" + kpiEmployeeId).hide();
			}
		}
	});
}
function kpiFilterForEmployee() {
	var month = $("#month-filter").val();
	var status = $("#status-filter").val();
	var year = $("#year-filter").val();
	var companyId = $("#company-filter").val();
	var branchId = $("#branch-filter").val();
	var teamId = $("#team-filter").val();
	var type = $("#type").val();
	var employeeId = $("#employee-filter").val();
	var url = $url + 'kpi/kpi-personal/search-kpi-personal';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { companyId: companyId, branchId: branchId, teamId: teamId, month: month, status: status, year: year, type: type, employeeId: employeeId },
		success: function (data) {

		}
	});
}
function assignKpiToEmployeeInTeam(teamId, kpiId) {
	var url = $url + 'kpi/assign/employee-in-team-target';
	if ($("#team-" + teamId).prop("checked") == true) {
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { teamId: teamId, kpiId: kpiId },
			success: function (data) {
				if (data.status) {
					$("#team-employee-target").append(data.textHtml);
				}
			}
		});
	} else {

		$("#team-employee-" + teamId).remove();
		$("#employee-in-team-" + teamId).remove();
	}
}
