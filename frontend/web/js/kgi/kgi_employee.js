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
	var month = $("#month").val();
	var year = $("#year").val();
	if ($("#team-" + teamId).prop("checked") == true) {
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { teamId: teamId, kgiId: kgiId,year:year,month:month },
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

function checkEnter(event, employeeId, teamId) {
	if (event.key === 'Enter') {
		event.preventDefault();  // ป้องกันการส่งฟอร์มเมื่อกด Enter

		// เลือก checkbox ถ้ากด Enter แล้วไม่ถูกเลือก
		const checkbox = document.getElementById('target-employee-' + employeeId);
		if (checkbox && !checkbox.checked) {
			checkbox.checked = true; // หาก checkbox ยังไม่ถูกเลือกให้เลือก
		}

		// console.log('Employee ID:', employeeId);
		let currentInput = document.querySelector(`#employee-target-${teamId}-${employeeId}`);

		// console.log('Current Input:', currentInput);

		if (currentInput) {
			// ค้นหากล่องที่ห่อหุ้มแถว (div ที่มี class col-12.bg-white.border-bottom)
			let currentRow = currentInput.closest('.col-12.bg-white.border-bottom');

			if (currentRow) {
				// ค้นหาแถวถัดไป
				let nextRow = currentRow.nextElementSibling;

				if (nextRow) {
					// ค้นหา input ในแถวถัดไป
					let nextInput = nextRow.querySelector('input[type="text"]');
					if (nextInput) {
						nextInput.focus(); // โฟกัสไปที่ input ในแถวถัดไป
					}
				} else {
					console.log('ไม่พบแถวถัดไป');
				}
			} else {
				console.log('ไม่พบแถวปัจจุบัน');
			}
		} else {
			console.log(`ไม่พบ input ที่มี id="employee-target-${teamId}-${employeeId}"`);
		}

	}
}
function checkEnterTextArea(event, employeeId, teamId,current) { 
	if (event.key === 'Enter') {
		event.preventDefault();
		var next = current + 1;
		if ($('#target-employee-' + employeeId).prop("checked")) {
		} else {
			$('#target-employee-' + employeeId).prop("checked", true);
		}
		$(".input-"+teamId+'-'+next).focus();
	}
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
			data: { kgiId: kgiId, kgiEmployeeHistoryId: kgiEmployeeHistoryId,kgiEmployeeId:kgiEmployeeId },
			success: function (data) {
				$("#show-content").html(data.kgiEmployeeTeam);
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
function showTeamEmployee1(teamId) {
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
function showTeamEmployee2(teamId) {
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
function showTeamEmployeeUpdate(teamId, kgiId, month, year,kgiTeamHistoryId) {
	var currentSelect = $("#currentSelect").val();
	if (kgiTeamHistoryId != currentSelect) {
		$("#historyMonthYear-" + currentSelect).removeClass("selectedTeam");
		$("#historyMonthYear-" + currentSelect).addClass("bg-white");

		$("#historyMonthYear-" + kgiTeamHistoryId).removeClass("bg-white");
		$("#historyMonthYear-" + kgiTeamHistoryId).addClass("selectedTeam");

		$('#img-' + currentSelect).attr('src', $url + 'images/icons/pim/doubleplay-black.svg');
		$("#btn-" + currentSelect).removeClass("doubleplay-btn-blue");
		$("#btn-" + currentSelect).addClass("doubleplay-btn");

		$('#img-' + kgiTeamHistoryId).attr('src', $url + 'images/icons/pim/doubleplay-white.svg');
		$("#btn-" + kgiTeamHistoryId).removeClass("doubleplay-btn");
		$("#btn-" + kgiTeamHistoryId).addClass("doubleplay-btn-blue");

		var url = $url + 'kgi/kgi-personal/kgi-each-team-employee';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kgiId: kgiId, teamId: teamId, year: year, month: month },
			success: function (data) {
				if (data.status) {
					$("#kgi-employee").html(data.employeeHistory);
				}
			}
		});
		$("#currentSelect").val(kgiTeamHistoryId);
	}
}
function showFirstTeamEmployeeUpdate(teamId, kgiId, month, year, kgiTeamHistoryId) {
	var currentSelect = kgiTeamHistoryId
	$("#historyMonthYear-" + currentSelect).removeClass("selectedTeam");
	$("#historyMonthYear-" + currentSelect).addClass("bg-white");

	$("#historyMonthYear-" + kgiTeamHistoryId).removeClass("bg-white");
	$("#historyMonthYear-" + kgiTeamHistoryId).addClass("selectedTeam");

	$('#img-' + currentSelect).attr('src', $url + 'images/icons/pim/doubleplay-black.svg');
	$("#btn-" + currentSelect).removeClass("doubleplay-btn-blue");
	$("#btn-" + currentSelect).addClass("doubleplay-btn");

	$('#img-' + kgiTeamHistoryId).attr('src', $url + 'images/icons/pim/doubleplay-white.svg');
	$("#btn-" + kgiTeamHistoryId).removeClass("doubleplay-btn");
	$("#btn-" + kgiTeamHistoryId).addClass("doubleplay-btn-blue");

	var url = $url + 'kgi/kgi-personal/kgi-each-team-employee';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kgiId: kgiId, teamId: teamId, year: year, month: month },
		success: function (data) {
			if (data.status) {
				$("#kgi-employee").html(data.employeeHistory);
			}
		}
	});
	$("#currentSelect").val(kgiTeamHistoryId);
	
}
function ShowEmployeeUpdating(kgiEmployeeId) { 
	var idStr = $("#allKgiEmployeeId").val();
	var idArr = idStr.split(",");

	$.each(idArr, function (index, value) {
		$("#history-" + value).hide();
		$("#main-"+value).hide();
	});
	$("#history-"+kgiEmployeeId).show();
}
function backUpdatingKgiEmployee(kgiEmployeeId) { 
	var idStr = $("#allKgiEmployeeId").val();
	var idArr = idStr.split(",");
	$.each(idArr, function (index, value) {
		$("#main-"+value).show();
	});
	$("#history-" + kgiEmployeeId).hide();
	
}