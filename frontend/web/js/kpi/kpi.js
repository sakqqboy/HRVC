var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
function viewTabKpi(tabId) { 
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
			data: { kpiId: kpiId },
			success: function (data) {kpiId
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
			data: { kpiId: kpiId },
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
			data: { kpiId: kpiId },
			success: function (data) {
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
			data: { kpiId: kpiId },
			success: function (data) {
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
			data: { kpiId: kpiId },
			success: function (data) {
				$("#show-content").html(data.kgi);
			}
		});
	}
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
function showTeamKgi(kgiId,type) { 
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
				$("#kgi-team-"+kgiId).html(data.kgiTeam);
			}
		});
	} else { 
		$("#kgi-team-" + kgiId).hide();
		$("#hide-" + kgiId).hide();
		$("#show-" + kgiId).show();
	}
}