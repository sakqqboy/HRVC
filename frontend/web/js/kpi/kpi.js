var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
	$baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
	$baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
function viewTabKpi(kpiHistoryId, tabId) {
	var currentTabId = $("#currentTab").val();
	//alert(currentTabId + '==' + tabId);
	var kpiId = $("#kpiId").val();
	//alert(kpiId);
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
				kpiId: kpiId,
				kpiHistoryId: kpiHistoryId
			},
			success: function (data) {
				$("#show-content").html(data.kpiEmployeeTeam);
			}
		});
	}
	if (tabId == 2) {
		var url = $url + 'kpi/view/all-kpi-history';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: {
				kpiId: kpiId,
				kpiHistoryId: kpiHistoryId
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
				kpiId: kpiId,
				kpiHistoryId: kpiHistoryId
			}, success: function (data) {
				$("#show-content").html(data.kpiIssue);
			}
		});
	}
	if (tabId == 4) {
		var url = $url + 'kpi/view/kpi-chart';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: {
				kpiId: kpiId,
				kpiHistoryId: kpiHistoryId
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
				kpiId: kpiId,
				kpiHistoryId: kpiHistoryId
			}, success: function (data) {
				$("#show-content").html(data.kgi);
			}
		});
	}
}
function validateFormKpi(event) {
	event.preventDefault(); // ป้องกันการส่งฟอร์มก่อนการตรวจสอบ

	var fromDate = document.getElementById('fromDate').value.trim();
	var toDate = document.getElementById('toDate').value.trim();

	if (!fromDate && !toDate) {
		alert("กรุณาระบุวันที่เริ่มต้นและวันที่สิ้นสุด");
		return false;
	} else if (!fromDate) {
		alert("กรุณาระบุวันที่เริ่มต้น");
		return false;
	} else if (!toDate) {
		alert("กรุณาระบุวันที่สิ้นสุด");
		return false;
	}

	document.getElementById('create-kpi').submit(); // ส่งฟอร์มหากข้อมูลครบถ้วน
	// alert("0");
	return true;
}
function companyMultiBrachKpi() {
	var acType = $("#acType").val();
	var companyId = acType == "update" ? $("#companyId").val() : $("#companyId").val();
	var kpiId = $("#kpiId").val();

	// var kfiBranchText = JSON.parse(localStorage.getItem("kfiBranchText")) || [];

	// alert(kfiBranchText);
	// ส่งข้อมูลผ่าน AJAX ไปยังเซิร์ฟเวอร์
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: $url + 'kpi/management/company-multi-branch', // URL ที่รับค่าจาก AJAX
		data: {
			companyId: companyId,
			acType: acType,
			kpiId: kpiId
			// kfiBranchText: kfiBranchText // ส่งค่า branchIds ที่เลือกไป
		},
		success: function (data) {
			if (data.status) {
				// เติมข้อมูลที่ต้องการแสดงกลับจากเซิร์ฟเวอร์
				if (acType == "update") {
					$("#show-multi-branch-update").html(data.branchText);
					$("#show-multi-branch-update").show();
				} else {
					$("#show-multi-branch").html(data.branchText);
					$("#show-multi-branch").show();
				}
			}
		}
	});
}
function createNewIssueKpi(kpiId) {
	var issue = $("#issue").val();
	var description = $("#description").val();
	var employeeId = $("#employeeId").val();
	var fd = new FormData();
	var files = $("#attachKpiFile")[0].files;
	if (files.length > 0) {
		fd.append('file', files[0]);

	}
	fd.append('issue', issue);
	fd.append('kpiId', kpiId);
	fd.append('employeeId', employeeId);
	fd.append('description', description);
	var url = $url + 'kpi/management/create-new-issue';
	if (issue != '') {
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: fd,
			contentType: false,
			processData: false,
			success: function (data) {
				if (data.status) {
					$("#issue").val('');
					$("#description").val('');
					$("#updated-issue").html(data.text);
				}
			}
		});
	} else {
		alert('Please fill in the headline!');
	}
}
function showTeamKgi(kgiId, type) {
	if (type == 1) {
		$("#kgi-team-" + kgiId).show();
		$("#hide-" + kgiId).show();
		$("#show-" + kgiId).hide();
		var url = $url + 'kpi/view/kgi-team';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kgiId: kgiId },
			success: function (data) {
				$("#kgi-team-" + kgiId).html(data.kgiTeam);
			}
		});
	} else {
		$("#kgi-team-" + kgiId).hide();
		$("#hide-" + kgiId).hide();
		$("#show-" + kgiId).show();
	}
}
function changeTargetKpiTeamReason(kpiTeamHistoryId) {
	var url = $url + 'kpi/management/channge-team-target-reason';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kpiTeamHistoryId: kpiTeamHistoryId },
		success: function (data) {
			$("#kpi-team-reason").html(data.reason);
		}
	});
}