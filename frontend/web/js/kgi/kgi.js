var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;

function changeType() {
	$("#acType").val('create');
	$("#kgiId").val('');
}
function companyMultiBrach() { 
	var companyId = $("#companyId").val();
	clearEveryShow();
	var url = $url + 'kgi/management/company-multi-branch';
	var acType = $("#acType").val();
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { companyId: companyId, acType: acType },
		success: function (data) {
			if (data.status) {
				$("#show-multi-branch").html(data.branchText);
			}
		}
	   });
}
function checkAllBranch() { 
	var sumBranch = totalBranch();
	//alert(sumBranch);
	if ($("#check-all-branch").prop("checked") == true) {
		var i = 1;
		$('input[id="multi-check"').each(function () {
			if (i < sumBranch) {
				$(this).prop("checked", true);
			} else { 
				$(this).prop("checked", true).trigger('change');
			}
			i++;
		});
	} else { 
		var i = 1;
		$('input[id="multi-check"').each(function () {
			if (i != sumBranch) {
				$(this).prop("checked", false);
			} else {
				$(this).prop("checked", false).trigger('change');
			}
			i++;
		});
		$("#show-multi-team").html('');
	}
}
function branchMultiDepartment() {
	var multiBranch = [];
	var sumBranch = totalBranch();
	var i = 0;
		$("#multi-check:checked").each(function () {
			multiBranch[i] = $(this).val();
			i++;
		});
	if (sumBranch != multiBranch.length) {
		$("#check-all-branch").prop("checked", false);
	} else { 
		$("#check-all-branch").prop("checked", true);
	}
	var url = $url + 'kgi/management/branch-multi-department';
	var acType = $("#acType").val();
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { multiBranch: multiBranch, acType: acType },
		success: function (data) {
			if (data.status) {
				$("#show-multi-department").html(data.textDepartment);
			} else {
				$("#show-multi-department").html('');
			}
		}
	});
}
function totalBranch() { 
	var totalBranch = 0;
	var data = [];
	var i = 0;
	$('input[id="multi-check"').each(function () {
		data[i] = $(this).val();
		i++;
	});
	totalBranch=data.length;
	return totalBranch;
}
function allDepartment(branchId) { 
	var sumDepartment = totalDepartment(branchId);
	if ($("#multi-check-all-"+branchId).prop("checked") == true) {
		var i = 1;
		$('input[id="multi-check-' + branchId + '"').each(function () {
			if (i < sumDepartment) {
				$(this).prop("checked", true);
			} else {
				$(this).prop("checked", true).trigger('change');
			}
			i++;
		}
			);
	} else { 
		var i = 1;
		$('input[id="multi-check-' + branchId + '"').each(function () {
			if (i != sumDepartment) {
				$(this).prop("checked", false);
			} else {
				$(this).prop("checked", false).trigger('change');
			}
			i++;
		});
		
	}
}
function departmentMultiTeam(branchId) { 
	var sumDepartment = totalDepartment(branchId);
	var multiDepartmentBranch = [];
	var multiDepartment = [];
	var multiBranch = [];
	var i = 0;
		$("#multi-check-"+branchId+":checked").each(function () {
			multiDepartmentBranch[i] = $(this).val();
			i++;
		});
		$("#multi-check:checked").each(function () {
			multiBranch[i] = $(this).val();
			i++;
		});
		$(".multi-check-department:checked").each(function () {
			multiDepartment[i] = $(this).val();
			i++;
		});
	if (sumDepartment != multiDepartmentBranch.length) {
		$("#multi-check-all-" + branchId).prop("checked", false);
	} else { 
		$("#multi-check-all-" + branchId).prop("checked", true);
	}
	var acType = $("#acType").val();
	var url = $url + 'kgi/management/department-multi-team';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { multiDepartment: multiDepartment, multiBranch: multiBranch, acType: acType },
		success: function (data) {
			if (data.status) {
				$("#show-multi-team").html(data.textTeam);
			} else {
				$("#show-multi-team").html('');
			}
		}
	});
}
function totalDepartment(branchId) {
	var totalDepartment = 0;
	var data = [];
	var i = 0;
	$('input[id="multi-check-' + branchId + '"').each(function () {
		data[i] = $(this).val();
		i++;
	});
	totalDepartment = data.length;
	return totalDepartment;
}
function clearEveryShow() { 
	$("#show-multi-department").html('');
	$("#show-multi-team").html('');
	$("#show-multi-department").html('');
	
}
function allTeam(departmentId) { 
	if ($("#multi-check-all-team-"+departmentId).prop("checked") == true) {
		$('input[id="multi-check-team-'+departmentId+'"]').each(function () {
			$(this).prop("checked", true);
		}
		);
	} else { 
		$('input[id="multi-check-team-'+departmentId+'"]').each(function () {
			$(this).prop("checked", false);
		}
		);
		
	}
}
function kgiHistory(kgiId) { 
	var url = $url + 'kgi/management/history';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kgiId: kgiId },
		success: function (data) {
			$("#kgi-name-view").html(data.kgi.kgiName);
			$("#status-view").html(data.kgi.statusText);
			if (data.kgi.statusText == "Finished") { 
				$("#status-view").removeClass('bg-warning');
				$("#status-view").removeClass('text-dark');
				$("#status-view").addClass('bg-success');
				$("#status-view").css("color", "white !important");
			}
			$("#period-date-view").html(data.kgi.periodCheckText);
			$("#next-date-view").html(data.kgi.nextCheckText);
			$("#company-name-view").html(data.kgi.companyName);
			$("#quantRatio-view").html(data.kgi.quantRatioText);
			$("#code-view").html(data.kgi.code);
			$("#target-view").html(data.kgi.targetAmountText);
			$("#result-view").html(data.kgi.resultText);
			$("#prirority-view").html(data.kgi.priority);
			$("#unit-view").html(data.kgi.unitText);
			$("#percentRatio").css("width", data.kgi.ratio + '%');
			$("#ratio-view").html(data.kgi.ratio);
			$("#country-view").html(data.kgi.countryName);
			$("#decription-view").html(data.kgi.detail);
			$("#team-view").html(data.teamText);
			$("#employee-view").html(data.employeeText);
			$("#kgi-history").html(data.historyText);
		 }
	});
}
function prepareDeleteKgi(kgiId) { 
	$("#kgiId-modal").val(kgiId);
}

function deleteKgi() { 
	var kgiId = $("#kgiId-modal").val();
	var url = $url + 'kgi/management/delete-kgi';
	$.ajax({
	    type: "POST",
	    dataType: 'json',
	    url: url,
	    data: { kgiId: kgiId },
	    success: function(data) {
		 if (data.status) {
		     $("#delete-kgi").modal("hide");
		     $("#kgi-" + kgiId).hide();
		 }
	    }
	});
}
$("#pills-Issues-tab-kgi").click(function () {
	$("#pills-Issues-tab-kgi").addClass("text-primary");
	$("#pills-History-tab-kgi").removeClass("text-primary");
	$("#pills-History").removeClass("active");
	$("#pills-Issues-tab-kgi").css("border-bottom", "5px #0d6efd solid");
	$("#pills-History-tab-kgi").removeAttr("style");
   });
$("#pills-History-tab-kgi").click(function () {
	$("#pills-History-tab-kgi").addClass("text-primary");
	$("#pills-Issues-tab-kgi").removeClass("text-primary");
	$("#pills-Issues").removeClass("active");
	$("#pills-History-tab-kgi").attr("style");
	$("#pills-History-tab-kgi").css("border-bottom", "5px #0d6efd solid");
	$("#pills-Issues-tab-kgi").removeAttr("style");
});
function showKgiComment(kgiId) { 
	var url = $url + 'kgi/management/show-comment';
	$.ajax({
	    type: "POST",
	    dataType: 'json',
	    url: url,
	    data: { kgiId: kgiId },
	    success: function(data) {
		 if (data.status) {
		     $("#kgi-name-issue").html(data.kgi.kgiName);
		     $("#pills-Issues").html(data.issueText);
		     $("#pills-History").html(data.historyText);
		     $("#company-issue").html(data.kgi.companyName);
		     $("#branch-issue").html(data.kgi.branchName);
		     $("#country-issue").html(data.kgi.countryName);
		     $("#flag-issue").attr('src',$url+data.kgi.flag);
		 }
	    }
	});
}
function showSelectFileNameKgi(kgiIssueId) {
	var message = "Attached : " + $("#attachKgiFileAnswer-" + kgiIssueId).val();
	$("#fileName-" + kgiIssueId).html(message);
}
function showAttachFileNameKgi(kgiId) {
	var message = "Attached : " + $("#attachKgiFile").val();
	$("#attachFile-" + kgiId).html(message);
}
function answerKgiIssue(kgiIssueId) {
	var answer = $("#answer-" + kgiIssueId).val();
	var fd = new FormData();
	var files = $("#attachKgiFileAnswer-" + kgiIssueId)[0].files;
	if (files.length > 0) {
		fd.append('file', files[0]);
   
	}
	fd.append('answer', answer);
	fd.append('kgiIssueId', kgiIssueId);
	var url = $url + 'kgi/management/save-kgi-answer';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: fd,
		contentType: false,
		processData: false,
		success: function (data) {
			if (data.status) {
				$("#solution-" + kgiIssueId).append(data.commentText);
				$("#answer-" + kgiIssueId).val('');
			}
		}
	});
}
function kgiFilter() {
	var companyId = $("#company-filter").val();
	var branchId = $("#branch-filter").val();
	var teamId = $("#team-filter").val();
	var month = $("#month-filter").val();
	var status = $("#status-filter").val();
	var date = $("#date-filter").val();
	var type = $("#type").val();
	var url = $url + 'kgi/management/search-kgi';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { companyId: companyId,branchId: branchId,teamId: teamId,month: month,status: status,date: date,type:type },
		success: function (data) {
			
		}
	});
}