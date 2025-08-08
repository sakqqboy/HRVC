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
		data: { kpiTeamId: kpiTeamId },
		success: function (data) {
			$("#kpi-name").html(data.kpiTeam.kpiName);
			$("#team-name").html(data.kpiTeam.teamName);
			$("#kpi-detail").html(data.kpiTeam.kpiDetail);
			$("#kpi-remark").html(data.kpiTeam.remark);
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
			$("#year-update").val(data.kpiTeam.year);
			$("#target-amount").val(data.kpiTeam.targetAmount);
			$("#result").val(data.kpiTeam.result);
			$("#from-date-update").val(data.kpiTeam.fromDate);
			$("#to-date-update").val(data.kpiTeam.toDate);
			$("#nextCheckDate-update").val(data.kpiTeam.nextCheckDate);
		}
	});
}

function viewTabTeamKpi(kpiTeamHistoryId, kpiTeamId, tabId) {
	var currentTabId = $("#currentTab").val();
	//alert(currentTabId + '==' + tabId);
	var kpiId = $("#kpiId").val();
	var kpiTeamId = $("#kpiTeamId").val();
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
		var url = $url + 'kpi/kpi-team/kpi-team-employee';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: {
				kpiId: kpiId,
				kpiTeamId: kpiTeamId,
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
		var url = $url + 'kpi/kpi-team/all-kpi-history';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: {
				kpiId: kpiId,
				kpiTeamId: kpiTeamId,
				kpiTeamHistoryId: kpiTeamHistoryId
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
				// kpiTeamId: kpiTeamId,
				// kpiHistoryId: kpiTeamHistoryId
			}, success: function (data) {
				$("#show-content").html(data.kpiIssue);
			}
		});
	}
	if (tabId == 4) {
		var url = $url + 'kpi/kpi-team/kpi-chart';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: {
				kpiId: kpiId,
				kpiTeamId: kpiTeamId,
				kpiTeamHistoryId: kpiTeamHistoryId,

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
				// kpiTeamId: kpiTeamId,
				// kpiHistoryId: kpiTeamHistoryId
			}, success: function (data) {
				$("#show-content").html(data.kgi);
			}
		});
	}
}
function kpiTeamHistory(kpiTeamId) {
	var url = $url + 'kpi/kpi-team/kpi-team-view';
	//alert(kpiTeamId);
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
function kpiTeamHistoryEva(kpiTeamId) {
	var url = $url + 'kpi/kpi-team/kpi-team-view';
	//alert(kpiTeamId);
	resetUnit();
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kpiTeamId: kpiTeamId },
		success: function (data) {
			$("#next-date-view-kpi-team").html(data.kpiTeam.nextCheckDateText);
			$("#kpi-name-view-kpi-team").html(data.kpiTeam.kpiName);
			$("#prirority-view-kpi-team").html(data.kpiTeam.priority);
			$("#quantRatio-view-kpi-team").html(data.kpiTeam.quantRatio);
			$("#unit-view-kpi-team").html(data.kpiTeam.unit);
			$("#target-view-kpi-team").html(data.kpiTeam.target);
			$("#result-view-kpi-team").html(data.kpiTeam.result);
			$("#percentRatio-kpi-team").css("width", data.kpiTeam.ratio + '%');
			$("#ratio-view-kpi-team").html(data.kpiTeam.ratio);
			$("#code-view-kpi-team").html(data.kpiTeam.code);
			$("#decription-view-kpi-team").html(data.kpiTeam.kpiDetail);
			$("#kpi-history").html(data.history);
		}
	});
}
function validateFormKpiTeam() {
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
function kpiTeamHistory2(teamId, kpiId) {
	//
	var url = $url + 'kpi/kpi-team/kpi-team-view2';
	resetUnit();
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { teamId: teamId, kpiId: kpiId },
		success: function (data) {
			if (data.status) {
				//        alert(data.status);
				$("#next-date-team").html(data.kpiTeam.nextCheckDateText);
				$("#kpi-name-team").html(data.kpiTeam.kpiName);
				$("#team-name").html(data.kpiTeam.teamName);
				$("#prirority-team").html(data.kpiTeam.priority);
				$("#quantRatio-team").html(data.kpiTeam.quantRatio);
				$("#unit-team").html(data.kpiTeam.unit);
				$("#target-team").html(data.kpiTeam.target);
				$("#result-team").html(data.kpiTeam.result);
				$("#percentRatio-team").css("width", data.kpiTeam.ratio + '%');
				$("#ratio-team").html(data.kpiTeam.ratio);
				$("#code-team").html(data.kpiTeam.code);
				$("#decription-team").html(data.kpiTeam.kpiDetail);
				$("#kpi-history-team").html(data.history);
				$("#kpi-view-team").modal('show');
			} else {

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
		data: { companyId: companyId, branchId: branchId, teamId: teamId, month: month, status: status, year: year, type: type },
		success: function (data) {

		}
	});
}
function prepareDeleteKpiTeam(kpiTeamId) {
	//alert(kpiTeamId);
	$("#delete-kpi-team").modal('show');
	$("#kpiTeamId-modal").val(kpiTeamId);
}
function deleteKpiTeam() {
	var kpiTeamId = $("#kpiTeamId-modal").val();
	var url = $url + 'kpi/kpi-team/delete-kpi-team';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kpiTeamId: kpiTeamId },
		success: function (data) {
			if (data.status) {
				$("#delete-kpi-team").modal("hide");
				$("#kpi-team-" + kpiTeamId).hide();
			}
		}
	});
}
function setSameKpiTeamRemark(teamId, kpiId) {
	var url = $url + 'kpi/kpi-team/kpi-team';
	var remark = $("#remark-" + teamId).val();
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kpiId: kpiId },
		success: function (data) {
			if (data.status) {
				$.each(data.kpiId, function (key, value) {
					$("#remark-" + value).val(remark);

				});
			} else {
				alert('123');
			}
		}
	});

}
function autoUpdateResultTeamKpi(kpiTeamId) {
	if ($("#historic-checkbox-kpi-team").prop("checked") == true) {
		$("#override-checkbox-kpi-team").prop("checked", false);

		var url = $url + 'kpi/kpi-team/auto-result';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kpiTeamId: kpiTeamId },
			success: function (data) {
				$("#result-update").val(data.result);
				$("#auto-result").val(data.result);
			}
		});
		$("#result-update").prop("disabled", true);
	} else {
		$("#override-checkbox-kpi-team").prop("checked", true);
		$("#result-update").val($("#previous-result").val());
		$("#result-update").prop("disabled", false);
	}
}
function assignKpiTeam(kpiId) {
	$("#kpiId-team").val(kpiId);
	var url = $url + 'kpi/kpi-team/assign-kpi-team';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kpiId: kpiId },
		success: function (data) {
			$("#teamInDepartment").html(data.textTeam);
			$("#department-search-team").html(data.textDepartment);
		}
	});
}
function searchKpiTeam() {
	var departmentId = $("#department-search-team").val();
	var teamName = $("#search-team-name").val();
	var kpiId = $("#kpiId-team").val();
	var url = $url + 'kpi/kpi-team/search-team';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { departmentId: departmentId, teamName: teamName, kpiId: kpiId },
		success: function (data) {
			$("#teamInDepartment").html(data.textTeam);
		}
	});
}
function checkKpiTeam(teamId, kpiId) {
	var url = $url + 'kpi/kpi-team/kpi-assign-team';
	var checked = 0;
	if ($("#kpi-team-" + teamId + '-' + kpiId).prop("checked") == true) {
		checked = 1;
	}
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kpiId: kpiId, teamId: teamId, checked: checked },
		success: function (data) {
			if (data.status) {
				// $("#totalEmployee-" + kpiId).html(data.totalEmployee);
				$("#totalTeam-" + kpiId).html(data.countTeam);
			}
		}
	});
}
function checkAllKpiTeam(kpiId) {
	var url = $url + 'kpi/kpi-team/check-all-kpi-team';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		//data: { kpiId: kpiId },
		success: function (data) {
			if ($("#all-kpi-team-" + kpiId).prop("checked") == true) {
				$.each(data.team, function (key, value) {
					if ($("#kpi-team-" + value + '-' + kpiId).prop("checked") == false) {
						$("#kpi-team-" + value + '-' + kpiId).prop("checked", true);
						checkKpiTeam(value, kpiId);
					}
				});
			} else {

				$.each(data.team, function (key, value) {
					if ($("#kpi-team-" + value + '-' + kpiId).prop("checked") == true) {
						$("#kpi-team-" + value + '-' + kpiId).prop("checked", false);
						checkKpiTeam(value, kpiId);
					}
				});
			}
		}
	});
}
function kpiTeamHistoryView(kpiId, teamId) {
	var viewType = $("#viewType").val();
	//alert(viewType);
	var url = $url + 'kpi/view/kpi-team-history-view';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { teamId: teamId, kpiId: kpiId, viewType: viewType },
		success: function (data) {
			if (data.status) {
				$("#all").css('display', 'none');
				$("#all").html('');
				$("#employee-all").css('display', 'none');
				$("#employee-all").html('');
				$("#man-check").show();
				$("#kpi-employee").show();
				$("#man-check").html(data.history);
			}

		}
	});
}