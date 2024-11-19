var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
	$baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
	$baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
function prepareDeleteKgiEmployee(kgiEmployeeId) {
	$("#kgiEmployeeId-modal").val(kgiEmployeeId);
}
function deleteKgiEmployee() {
	var kgiEmployeeId = $("#kgiEmployeeId-modal").val();
	var url = $url + 'kgi/kgi-team/delete-kgi-team';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kgiEmployeeId: kgiEmployeeId },
		success: function (data) {
			if (data.status) {
				$("#delete-kgi-employee").modal("hide");
				$("#kgi-employee-" + kgiEmployeeId).hide();
			}
		}
	});
}
function kgiFilterForEmployee() {
	var month = $("#month-filter").val();
	var status = $("#status-filter").val();
	var year = $("#year-filter").val();
	var companyId = $("#company-filter").val();
	var branchId = $("#branch-filter").val();
	var teamId = $("#team-filter").val();
	var type = $("#type").val();
	var employeeId = $("#employee-filter").val();
	var url = $url + 'kgi/kgi-personal/search-kgi-personal';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { companyId: companyId, branchId: branchId, teamId: teamId, month: month, status: status, year: year, type: type, employeeId: employeeId },
		success: function (data) {

		}
	});
}
function assignKgiToEmployeeInTeam(teamId, kgiId) {
	var url = $url + 'kgi/assign/employee-in-team-target';
	if ($("#team-" + teamId).prop("checked") == true) {
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { teamId: teamId, kgiId: kgiId },
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
function calculateEmployeeTargetValue(teamId) {
	var total = 0;
	$('input[id="employee-target-' + teamId + '"]').each(function () {
		let currentValue = $(this).val().replace(',', '');
		total = total + parseFloat(currentValue);
	});
	$("#total-team-target-" + teamId).html(total.toLocaleString());
}
function showEmployeeTeamTarget(teamId) {
	$("#employee-in-team-" + teamId).show();
	$("#show-" + teamId).hide();
	$("#hide-" + teamId).show();
}
function hideEmployeeTeamTarget(teamId) {
	$("#employee-in-team-" + teamId).hide();
	$("#show-" + teamId).show();
	$("#hide-" + teamId).hide();
}