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
				$("#delete-kpi-employee").modal("hide");
				$("#kpi-employee-" + kpiEmployeeId).hide();
			}
		}
	});
}
function validateFormKpiEmployee() {
	//	event.preventDefault(); // ป้องกันการส่งฟอร์มก่อนการตรวจสอบ
	var check1 = document.getElementById('check1').checked;
	var check2 = document.getElementById('check2').checked;
	console.log("validateFormKgi called");
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
	} else if (!check1 && !check2) {
		alert("Please select at least one status (In-Progress or Completed)");
		return false;
	} else {
		return true;
	}
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


function viewTabEmployeeKpi(kpiEmployeeHistoryId, kpiEmployeeId, tabId) {
	var currentTabId = $("#currentTab").val();
	//alert(currentTabId + '==' + tabId);
	var kpiId = $("#kpiId").val();
	// alert(kpiId);
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
		var url = $url + 'kpi/view/kpi-team-employee';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: {
				kpiId: kpiId
				// kpiTeamId: kpiEmployeeId,
				// kpiHistoryId: kpiEmployeeHistoryId
			},
			success: function (data) {
				$("#show-content").html(data.kpiEmployeeTeam);
			}
		});
	}
	if (tabId == 2) {
		var url = $url + 'kpi/kpi-personal/all-kpi-history';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: {
				kpiId: kpiId,
				kpiEmployeeId: kpiEmployeeId,
				kpiEmployeeHistoryId: kpiEmployeeHistoryId
			},
			success: function (data) {
				$("#show-content").html(data.monthlyDetailHistoryText);
			}
		});
	}
	if (tabId == 3) {
		var url = $url + 'kpi/view/kpi-issue';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: {
				kpiId: kpiId
				// kpiTeamId: kpiEmployeeId,
				// kpiHistoryId: kpiEmployeeHistoryId
			}, success: function (data) {
				$("#show-content").html(data.kpiIssue);
			}
		});
	}
	if (tabId == 4) {
		var url = $url + 'kpi/kpi-personal/kpi-chart';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: {
				kpiId: kpiId,
				kpiEmployeeId: kpiEmployeeId,
				kpiEmployeeHistoryId: kpiEmployeeHistoryId,

			}, success: function (data) {
				$("#show-content").html(data.kpiChart);
			}
		});
	}
	if (tabId == 5) {
		var url = $url + 'kpi/view/kpi-kgi';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: {
				kpiId: kpiId
				// kpiTeamId: kpiEmployeeId,
				// kpiHistoryId: kpiEmployeeHistoryId
			}, success: function (data) {
				$("#show-content").html(data.kgi);
			}
		});
	}
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
