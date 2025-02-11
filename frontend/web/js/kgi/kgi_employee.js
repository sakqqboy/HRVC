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
	// alert(kgiEmployeeId);
	var url = $url + 'kgi/kgi-personal/delete-kgi-employee';
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
function viewTabEmployeeKgi(kgiEmployeeHistoryId, tabId, kgiId, kgiEmployeeId) {
	var currentTabId = $("#currentTab").val();
	var kgiId = $("#kgiId").val();
	$("#tab-" + currentTabId).removeClass("view-tab-active");
	$("#tab-" + currentTabId).addClass("view-tab");
	$("#tab-" + tabId).removeClass("view-tab");
	$("#tab-" + tabId).addClass("view-tab-active");
	$("#tab-" + currentTabId + "-blue").hide();
	$("#tab-" + currentTabId + "-black").show();
	$("#tab-" + tabId + "-blue").show();
	$("#tab-" + tabId + "-black").hide();
	$("#currentTab").val(tabId);
	if (tabId == 1) {
		var url = $url + 'kgi/kgi-personal/kgi-team-employee';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kgiId: kgiId, kgiEmployeeHistoryId: kgiEmployeeHistoryId },
			success: function (data) {
				kgiId
				$("#show-content").html(data.kgiEmployeeTeam);
			}
		});
	}
	if (tabId == 2) {
		var url = $url + 'kgi/kgi-personal/all-kgi-history';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kgiEmployeeId: kgiEmployeeId, kgiEmployeeHistoryId: kgiEmployeeHistoryId },
			success: function (data) {
				$("#show-content").html(data.monthlyDetailHistoryText);
			}
		});
	}
	if (tabId == 3) {
		var url = $url + 'kgi/view/kgi-issue';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kgiId: kgiId },
			success: function (data) {
				$("#show-content").html(data.kgiIssue);
			}
		});
	}
	if (tabId == 4) {
		//alert(kgiTeamId);
		var url = $url + 'kgi/kgi-personal/kgi-employee-chart';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kgiEmployeeId: kgiEmployeeId, kgiEmployeeHistoryId: kgiEmployeeHistoryId, kgiId: kgiId },
			success: function (data) {
				$("#show-content").html(data.kgiChart);
			}
		});
	}
	if (tabId == 5) {
		var url = $url + 'kgi/view/kgi-kpi';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kgiId: kgiId },
			success: function (data) {
				$("#show-content").html(data.kpi);
			}
		});
	}
}
function validateFormKgiEmployee() {
	var fromDate = document.getElementById('fromDate').value.trim();
	var toDate = document.getElementById('toDate').value.trim();
	var nextDate = $('#nextDate').val();
	if (!fromDate && !toDate) {
	    alert("Please fill in Due Term");
	    return false;
	} else if (!fromDate) {
	    alert("Please fill in Start Date");
	    return false;
	} else if (!toDate) {
	    alert("Please fill in End Date");
	    return false;
	} else if (nextDate == '') {
	    alert("Please fill in Target Due Update Date");
	    return false;
	} else if ($('#check1').prop('checked') == false && $('#check2').prop('checked') == false) {
	    alert("Please check the status");
	    return false;
	} else {
	    return true;
	}
   }