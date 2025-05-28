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
	var kpiEmployeeId = $("#kpiEmployeeId").val();
	var month = $("#month").val();
	var year = $("#year").val();
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
		//var url = $url + 'kpi/view/kpi-team-employee-detail';
	var url = $url + 'kpi/kpi-personal/kpi-team-employee';

		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: {
				kpiId: kpiId,
				kpiEmployeeId: kpiEmployeeId,
				month: month,
				year: year
			},
			success: function (data) {
				$("#show-content").html(data.kpiEmployeeTeam);
				if (viewType == 'list') {
					$('#man-check').css("display", 'none');
					$('#all').show();
					$('#employee-all').show();
					$('#kgi-employee').css("display", 'none');
					$("#viewType").val('list');
				}
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
function showKpiTeamEmployee1(teamId) {
	var teamStr = $("#allTeam1").val();
	var teamArr = teamStr.split(",");
	var currentTeam1 = $("#currentTeam1").val();
	if (teamId != currentTeam1) {
		$.each(teamArr, function (index, value) {
			if (value != '' && value != teamId) {
				$("#team1-" + value).css("display", "none");
				$("#employee1-" + value).css("display", "none");
				$("#selectTeam1-" + value).removeClass("selectedTeam");
				$("#selectTeam1-" + value).addClass("bg-white");
			}
		
		});
		$("#team1-" + teamId).show();
		$("#employee1-" + teamId).show();
		$("#selectTeam1-" + teamId).removeClass("bg-white");
		$("#selectTeam1-" + teamId).addClass("selectedTeam");
		$("#currentTeam1").val(teamId);
	} else { 
		$.each(teamArr, function (index, value) {
			$("#team1-" + value).css("display", "none");
			$("#employee1-" + value).css("display", "none");
			$("#selectTeam1-" + value).removeClass("selectedTeam");
			$("#selectTeam1-" + value).addClass("bg-white");
			$("#team1-" + value).show();
			$("#employee1-" + value).show();
		});
		$("#currentTeam1").val('all');
	}
}
function showKpiTeamEmployee2(teamId) {
	var teamStr = $("#allTeam2").val();
	var teamArr = teamStr.split(",");
	var currentTeam2 = $("#currentTeam2").val();
	if (teamId != currentTeam2) {
		$.each(teamArr, function (index, value) {
			if (value != '' && value != teamId) {
				$("#team2-" + value).css("display", "none");
				$("#employee2-" + value).css("display", "none");
				// $("#selectTeam1-" + value).css("border", "0px");
				$("#selectTeam2-" + value).removeClass("selectedTeam");
				$("#selectTeam2-" + value).addClass("bg-white");
			}
		});
		$("#team2-" + teamId).show();
		$("#employee2-" + teamId).show();
		$("#selectTeam2-" + teamId).removeClass("bg-white");
		$("#selectTeam2-" + teamId).addClass("selectedTeam");
		$("#currentTeam2").val(teamId);
	} else {
		$.each(teamArr, function (index, value) {
			$("#team2-" + value).css("display", "none");
			$("#employee2-" + value).css("display", "none");
			$("#selectTeam2-" + value).removeClass("selectedTeam");
			$("#selectTeam2-" + value).addClass("bg-white");
			$("#team2-" + value).show();
			$("#employee2-" + value).show();
		});
		$("#currentTeam2").val('all');
	}
	
}
function showKpiTeamEmployeeUpdate(teamId, kpiId, month, year,kpiTeamHistoryId) {
	var currentSelect = $("#currentSelect").val();
	if (kpiTeamHistoryId != currentSelect) {
		$("#historyMonthYear-" + currentSelect).removeClass("selectedTeam");
		$("#historyMonthYear-" + currentSelect).addClass("bg-white");

		$("#historyMonthYear-" + kpiTeamHistoryId).removeClass("bg-white");
		$("#historyMonthYear-" + kpiTeamHistoryId).addClass("selectedTeam");

		$('#img-' + currentSelect).attr('src', $url + 'images/icons/pim/doubleplay-black.svg');
		$("#btn-" + currentSelect).removeClass("doubleplay-btn-blue");
		$("#btn-" + currentSelect).addClass("doubleplay-btn");

		$('#img-' + kpiTeamHistoryId).attr('src', $url + 'images/icons/pim/doubleplay-white.svg');
		$("#btn-" + kpiTeamHistoryId).removeClass("doubleplay-btn");
		$("#btn-" + kpiTeamHistoryId).addClass("doubleplay-btn-blue");

		var url = $url + 'kpi/kpi-personal/kpi-each-team-employee';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kpiId: kpiId, teamId: teamId, year: year, month: month },
			success: function (data) {
				if (data.status) {
					$("#kpi-employee").html(data.employeeHistory);
				}
			}
		});
		$("#currentSelect").val(kpiTeamHistoryId);
	}
}
function showFirstKpiTeamEmployeeUpdate(teamId, kpiId, month, year, kpiTeamHistoryId) {
	var currentSelect = kpiTeamHistoryId
	$("#historyMonthYear-" + currentSelect).removeClass("selectedTeam");
	$("#historyMonthYear-" + currentSelect).addClass("bg-white");

	$("#historyMonthYear-" + kpiTeamHistoryId).removeClass("bg-white");
	$("#historyMonthYear-" + kpiTeamHistoryId).addClass("selectedTeam");

	$('#img-' + currentSelect).attr('src', $url + 'images/icons/pim/doubleplay-black.svg');
	$("#btn-" + currentSelect).removeClass("doubleplay-btn-blue");
	$("#btn-" + currentSelect).addClass("doubleplay-btn");

	$('#img-' + kpiTeamHistoryId).attr('src', $url + 'images/icons/pim/doubleplay-white.svg');
	$("#btn-" + kpiTeamHistoryId).removeClass("doubleplay-btn");
	$("#btn-" + kpiTeamHistoryId).addClass("doubleplay-btn-blue");

	var url = $url + 'kpi/kpi-personal/kpi-each-team-employee';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kpiId: kpiId, teamId: teamId, year: year, month: month },
		success: function (data) {
			if (data.status) {
				$("#kpi-employee").html(data.employeeHistory);
			}
		}
	});
	$("#currentSelect").val(kpiTeamHistoryId);
	
}
function ShowKpiEmployeeUpdating(kpiEmployeeId) { 
	var idStr = $("#allKpiEmployeeId").val();
	var idArr = idStr.split(",");

	$.each(idArr, function (index, value) {
		$("#history-" + value).hide();
		$("#main-"+value).hide();
	});
	$("#history-"+kpiEmployeeId).show();
}
function backUpdatingKpiEmployee(kpiEmployeeId) { 
	var idStr = $("#allKpiEmployeeId").val();
	var idArr = idStr.split(",");
	$.each(idArr, function (index, value) {
		$("#main-"+value).show();
	});
	$("#history-" + kpiEmployeeId).hide();
	
}
