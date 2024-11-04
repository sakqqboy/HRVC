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
				// $("#kgi-group-create").html(data.kgiGroup);
			}
		}
	   });
}
function checkAllBranch() { 
	var sumBranch = totalBranch();
	//alert(sumBranch);
	if ($("#check-all-branch").prop("checked") == true) {
		var i = 1;
		$('input[id="multi-check"]').each(function () {
			if (i < sumBranch) {
				$(this).prop("checked", true);
			} else { 
				$(this).prop("checked", true).trigger('change');
			}
			i++;
		});
	} else { 
		var i = 1;
		$('input[id="multi-check"]').each(function () {
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
	if (multiBranch.length > 0) {
		$('input[id="multi-check"]').each(function () {
			$(".multiCheck-"+$(this).val()).removeAttr('required');
		});
	} else { 
		$('input[id="multi-check"]').each(function () {
			$(".multiCheck-"+$(this).val()).prop('required',true);
		});
	}
	//alert(multiBranch.length);
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
	$('input[id="multi-check"]').each(function () {
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
		$('input[id="multi-check-' + branchId + '"]').each(function () {
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
		$('input[id="multi-check-' + branchId + '"]').each(function () {
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
	if (multiDepartmentBranch.length > 0) {
		$('input[id="multi-check-'+branchId+'"]').each(function () {
			$(".multiDepartment-"+$(this).val()).removeAttr('required');
		});
	} else { 
		$('input[id="multi-check-'+branchId+'"]').each(function () {
			$(".multiDepartment-"+$(this).val()).prop('required',true);
		});
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
function multiTeam(departmentId) {
	var sumTeam = totalTeam(departmentId);
	var multiTeamDepartment = [];
	var i = 0;
	$("#multi-check-team-"+departmentId+":checked").each(function () {
		multiTeamDepartment[i] = $(this).val();
		i++;
	});
	//alert(sumTeam + '=>' + multiTeamDepartment.length);
	if (sumTeam != multiTeamDepartment.length) {
		$("#multi-check-all-team-" + departmentId).prop("checked", false);
	} else { 
		$("#multi-check-all-team-" + departmentId).prop("checked", true);
	}
	if (multiTeamDepartment.length > 0) {
		$('input[id="multi-check-team-'+departmentId+'"]').each(function () {
			$(".multiTeam-department-"+$(this).val()).removeAttr('required');
		});
	} else { 
		$('input[id="multi-check-team-'+departmentId+'"]').each(function () {
			$(".multiTeam-department-"+$(this).val()).prop('required',true);
		});
	}
}
function multiTeamUpdate(departmentId) {
	var sumTeam = totalTeamUpdate(departmentId);
	var multiTeamDepartment = [];
	var i = 0;
	$("#multi-check-team-"+departmentId+"-update:checked").each(function () {
		multiTeamDepartment[i] = $(this).val();
		i++;
	});
	//alert(sumTeam + '=>' + multiTeamDepartment.length);
	if (sumTeam != multiTeamDepartment.length) {
		$("#multi-check-all-team-" + departmentId + '-update').prop("checked", false);
	} else { 
		$("#multi-check-all-team-" + departmentId + '-update').prop("checked", true);
	}
	if (multiTeamDepartment.length > 0) {
		$('input[id="multi-check-team-'+departmentId+'-update"]').each(function () {
			$(".multiTeam-department-update-"+$(this).val()).removeAttr('required');
		});
	} else { 
		$('input[id="multi-check-team-'+departmentId+'-update"]').each(function () {
			$(".multiTeam-department-update-"+$(this).val()).prop('required',true);
		});
	}
}
function totalDepartment(branchId) {
	var totalDepartment = 0;
	var data = [];
	var i = 0;
	$('input[id="multi-check-' + branchId + '"]').each(function () {
		data[i] = $(this).val();
		i++;
	});
	totalDepartment = data.length;
	return totalDepartment;
}
function totalTeam(departmentId) {
	var totalTeam = 0;
	var data = [];
	var i = 0;
	$('input[id="multi-check-team-' + departmentId + '"]').each(function () {
		data[i] = $(this).val();
		i++;
	});
	totalTeam = data.length;
	return totalTeam;
}
function totalTeamUpdate(departmentId) {
	var totalTeam = 0;
	var data = [];
	var i = 0;
	$('input[id="multi-check-team-' + departmentId + '-update"]').each(function () {
		data[i] = $(this).val();
		i++;
	});
	totalTeam = data.length;
	return totalTeam;
}
function clearEveryShow() { 
	$("#show-multi-department").html('');
	$("#show-multi-team").html('');
	$("#show-multi-department").html('');
	$("#kgi-group-create").html('');
	$("#kgi-group-update").html('');
	
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
	$("#v-kgiId").val(kgiId);
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
			if (data.kgi.status == 1) {
				$("#next-date-view").html(data.kgi.nextCheckText);
			} else {
				$("#next-date-view").html('-');
			}
			
			$("#company-name-view").html(data.kgi.companyName);
			$("#modal-branch-flag").attr("src", $url+data.kgi.flag);
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
function openTeamView(teamId,kgiId) {
	$("#team-progress").modal('show');
	var url = $url + 'kgi/kgi-team/team-progress';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { teamId: teamId,kgiId:kgiId },
		success: function (data) {
			$("#kgi-name").html(data.kgiName);
			$("#team-name").html(data.teamName);
			$("#kgi-team-progress").html(data.history);
			
		}
	});
}
function openEmployeeView(employeeId,kgiId) {
	$("#employee-progress").modal('show');
	var url = $url + 'kgi/kgi-personal/employee-progress';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { employeeId: employeeId,kgiId:kgiId },
		success: function (data) {
			$("#kgi-name-employee").html(data.kgiName);
			$("#employee-name").html(data.employeeName);
			$("#kgi-employee-progress").html(data.history);
			
		}
	});
}
function relatedKfiForKgi() { 
	var kgiId = $("#v-kgiId").val();
	$("#modal-kfi").modal('show');
	var url = $url + 'kgi/management/related-kfi';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kgiId: kgiId},
		success: function (data) {
			$("#related-kfi").html(data.kfiText);
            $("#kgi-name-v").html(data.kgiName);
			
		}
	});
	
}
function relatedKpiForKgi() { 
	var kgiId = $("#v-kgiId").val();
	$("#modal-kpi").modal('show');
	var url = $url + 'kgi/management/related-kpi';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kgiId: kgiId},
		success: function (data) {
			$("#related-kpi").html(data.kpiText);
			$("#kgi-name-p").html(data.kgiName);
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
function createNewIssue(kgiId) { 
	var issue = $("#issue").val();
	var description = $("#description").val();
	var employeeId = $("#employeeId").val();
	var fd = new FormData();
	var files = $("#attachKgiFile")[0].files;
	if (files.length > 0) {
		fd.append('file', files[0]);
   
	}
	fd.append('issue', issue);
	fd.append('kgiId', kgiId);
	fd.append('employeeId', employeeId);
	fd.append('description', description);
	var url = $url + 'kgi/management/create-new-issue';
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
					// $("#solution-" + kgiIssueId).append(data.commentText);
					// $("#answer-" + kgiIssueId).val('');
					// $("#lastest-issue-" + data.kgiId).html(data.issue);
					// $("#lastest-solution-" + data.kgiId).html(data.solution);
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
function answerKgiIssue(kgiIssueId) {
	var answer = $("#answer-" + kgiIssueId).val();
	//alert(answer);
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
				$("#lastest-issue-" + data.kgiId).html(data.issue);
				$("#lastest-solution-" + data.kgiId).html(data.solution);
				if (data.lastest != 0) { 
					$("#kgi-solution-" + data.lastest).addClass('border-left-bottom-radius');
				}
				$("#fileName-" + kgiIssueId).html('');
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
	var year = $("#year-filter").val();
	var type = $("#type").val();
	var url = $url + 'kgi/management/search-kgi';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { companyId: companyId,branchId: branchId,teamId: teamId,month: month,status: status,year: year,type:type },
		success: function (data) {
			
		}
	});
}
function copyKgi(kgiId) { 
	if (confirm('Do you want to make a copy?')) { 
	    var url = $url + 'kgi/management/copy-kgi?kgiId='+kgiId;
	    window.location.href=url;
	}
}
function kgiCompanyBranch(companyId,kgiId) { 
	var url = $url + 'kgi/management/kgi-branch';
	$.ajax({
	    type: "POST",
	    dataType: 'json',
	    url: url,
	    data: { companyId: companyId,kgiId:kgiId},
	    success: function (data) {
		 $("#kgi-branch").html(data.textBranch);
		 $("#kgiName").html(data.kgiName);
		 $("#companyName").html(data.companyName);
	    }
	});
}
function assignKgiBranch(kgiId,branchId) { 
	var checked = 0;
	if ($("#assign-branch-kgi-" + kgiId + '-' + branchId).prop("checked") == true) {
	    checked = 1;
	}
	var url = $url + 'kgi/management/kgi-assign-branch';
	$.ajax({
	    type: "POST",
	    dataType: 'json',
	    url: url,
	    data: { branchId: branchId,kgiId:kgiId,checked,checked},
	    success: function (data) {
		 if (data.status) { 
		     $("#total-branch-" + kgiId).html(data.totalBranch);
		 }
	    }
	});
}
function kgiCompanyEmployee(kgiId) { 
	var url = $url + 'kgi/management/kgi-employee';
	$("#kgiId").val(kgiId);
	$("#employeeInBranch").html('');
	$("#search-employee-box").css("display", "none");
	$("#search-employee-kgi").val('');
	$("#search-employee-department").val('')
	$("#search-employee-team").val('');
	$.ajax({
	    type: "POST",
	    dataType: 'json',
	    url: url,
	    data: {kgiId:kgiId},
	    success: function (data) {
		 if (data.status) { 
			 $("#search-employee-department").html(data.departmentText);
		     $("#employeeInBranch").html(data.textEmployee);
		 }
	    }
	});
}
function kgiEmployee(employeeId, kgiId) { 
   
	var url = $url + 'kgi/management/kgi-assign-employee';
	var checked = 0;
	if ($("#kgi-employee-" + employeeId + '-' + kgiId).prop("checked") == true) {
	    checked = 1;
	}
	$.ajax({
	    type: "POST",
	    dataType: 'json',
	    url: url,
	    data: {kgiId:kgiId,employeeId:employeeId,checked:checked},
	    success: function (data) {
		 if (data.status) { 
		     $("#totalEmployee-"+kgiId).html(data.totalEmployee);
		 }
	    }
	});
}
function searchKgiEmployee() { 
	var kgiId = $("#kgiId").val();
	//$("#search-employee-box").html('');
	// $("#search-employee-team").html('<option value="">Team</option>');
	var searchText = $("#search-employee-kgi").val();
	var departmentId = $("#search-employee-department").val();
	var teamId = $("#search-employee-team").val();
	
		var url = $url + 'kgi/management/search-kgi-employee';
		// if ($.trim(searchText) != '') {
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kgiId: kgiId, searchText: searchText, departmentId: departmentId, teamId: teamId },
			success: function (data) {
				if (data.status) {
					$("#search-employee-team").html(data.textTeam);
					$("#employeeInBranch").html(data.textEmployee);
				}
			}
		});
	// } else { 
	//     $("#search-employee-box").html('');
	//     $("#search-employee-box").css("display","none");
	// }
}
function searchKgiTeam() { 
	var kgiId = $("#kgiId").val();
	//$("#search-employee-box").html('');
	// $("#search-employee-team").html('<option value="">Team</option>');
	var searchText = $("#search-employee-kgi").val();
	var departmentId = $("#search-employee-department").val();
	var teamId = $("#search-employee-team").val();
	
		var url = $url + 'kgi/management/search-kgi-employee';
		// if ($.trim(searchText) != '') {
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kgiId: kgiId, searchText: searchText, departmentId: departmentId, teamId: teamId },
			success: function (data) {
				if (data.status) {
					$("#employeeInBranch").html(data.textEmployee);
				}
			}
		});
	// } else { 
	//     $("#search-employee-box").html('');
	//     $("#search-employee-box").css("display","none");
	// }
}
function searchAssignKgi() { 
	var month = $("#kgiMonthFilter").val();
	var year = $("#kgiYearFilter").val();
	var url = $url + 'kgi/management/search-assign-kgi';
	    $.ajax({
		 type: "POST",
		 dataType: 'json',
		 url: url,
		 data: { month: month,year:year},
		 success: function (data) {
		     if (data.status) {
			  $("#assign-search-result").html(data.kgiText);
		     }
		 }
	    });
}
function kpiInBranchForKpi(kgiId,branchId) { 
	var url = $url + 'kgi/management/kpi-branch';
	$("#kpi-branch").html('');
	$.ajax({
	    type: "POST",
	    dataType: 'json',
	    url: url,
	    data: { kgiId: kgiId, branchId: branchId },
	    success: function (data) {
		 if (data.status) {
		     $("#kpi-branch").html(data.kpiText);
		 }
	    }
	});
}
function saveSelectedKpi(kgiId) {
	var selectedKpi = [];
	$("input[name='kpi']:checked").each(function () {
		selectedKpi.push($(this).val());
	});
	if (selectedKpi.length == 0) {
		var selectedKpi = '';
	}
	var unCheck = [];
	$("input[name='kpi']").each(function () {
		if (!$(this).prop("checked")) {
			unCheck.push($(this).val());
		}
	});
	if (unCheck.length == 0) {
		var unCheck = '';
	}
	var url = $url + 'kgi/management/assign-kpi-to-kgi';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kgiId: kgiId, selectedKpi: selectedKpi, unCheck: unCheck },
		success: function (data) {
			if (data.status) {
				
			}
		}
	});
}
function assignKpiTokgi(kpiId, kgiId) { 
	var url = $url + 'kgi/management/assign-kpi-to-kgi';
	if ($("#kpi-branch-" + kpiId).prop("checked") == true) {
	    var type = 1;
	} else { 
	    var type = 0;
	}
	$.ajax({
	    type: "POST",
	    dataType: 'json',
	    url: url,
	    data: { kgiId: kgiId, kpiId: kpiId, type: type },
	    success: function (data) {
		 if (data.status) {
		 }
	    }
	});
}
function checkAllKgiEmployee(kgiId) {
	var url = $url + 'kgi/management/check-all-kgi-employee';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kgiId: kgiId },
		success: function (data) {
			if ($("#all-kgi-employee-" + kgiId).prop("checked") == true) {
	 
				$.each(data.employeeId, function (key, value) {
					if ($("#kgi-employee-" + value + '-' + kgiId).prop("checked") == false) {
						$("#kgi-employee-" + value + '-' + kgiId).prop("checked", true);
						kgiEmployee(value, kgiId);
					}
				});
			} else {
				$.each(data.employeeId, function (key, value) {
					if ($("#kgi-employee-" + value + '-' + kgiId).prop("checked") == true) {
						$("#kgi-employee-" + value + '-' + kgiId).prop("checked", false);
						kgiEmployee(value, kgiId);
					}
				});
			}
		}
	});
}
function approveTargetKgiTeam(kgiTeamId, approve) {
	var url = $url + 'kgi/management/approve-kgi-target';
	if (approve == 1) {
		var text = 'Are you sure to approve this target?';
	} else { 
		var text = 'Are you sure to reject this target?';
	}
	if (confirm(text)) {
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kgiTeamId: kgiTeamId, approve: approve },
			success: function (data) {
				if (data.status) {
					var url = $url + 'kgi/management/wait-approve';
					window.location.href = url;
				}
			}
		});
	}
}
function changeTargetKgiTeamReason(kgiTeamId) {
}
function approveTargetKgiEmployee(kgiEmployeeId, approve) {
	var url = $url + 'kgi/management/approve-kgi-employee-target';
	if (approve == 1) {
		var text = 'Are you sure to approve this target?';
	} else { 
		var text = 'Are you sure to reject this target?';
	}
	if (confirm(text)) {
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kgiEmployeeId: kgiEmployeeId, approve: approve },
			success: function (data) {
				if (data.status) {
					var url = $url + 'kgi/management/wait-approve';
					window.location.href = url;
				}
			}
		});
	}
}
function setSameKgiTeamRemark(teamId, kgiId) {
	var url = $url + 'kgi/kgi-team/kgi-team';
	var remark = $("#remark-" + teamId).val();
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kgiId: kgiId },
		success: function (data) {
			if (data.status) {
				$.each(data.kgiId, function (key, value) {
					$("#remark-" + value).val(remark);
					
				});
			} else { 
				alert('123');
			}
		}
	});
	
}
function prepareKgiNextTarget(kgiHistoryId) {
	$("#copy").modal('show');
	$("#kgiHistoryId").val(kgiHistoryId);
}
function prepareKgiTeamNextTarget(kgiTeamHistoryId) {
	$("#copy").modal('show');
	$("#kgiTeamHistoryId").val(kgiTeamHistoryId);
}
function prepareKgiEmployeeNextTarget(kgiEmployeeHistoryId) {
	$("#copy").modal('show');
	$("#kgiEmployeeHistoryId").val(kgiEmployeeHistoryId);
}
   function kgiNextTarget() { 
	var kgiHistoryId = $("#kgiHistoryId").val();
	var url = $url + 'kgi/management/next-kgi-history';
	$.ajax({
	    type: "POST",
	    dataType: 'json',
	    url: url,
	    data: {kgiHistoryId:kgiHistoryId},
	    success: function (data) {
		 
	    }
	});
   }
   function kgiTeamNextTarget() {
	var kgiTeamHistoryId = $("#kgiTeamHistoryId").val();
	var url = $url + 'kgi/kgi-team/next-kgi-team-history';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kgiTeamHistoryId: kgiTeamHistoryId },
		success: function (data) {
		 
		}
	});
}
function kgiEmployeeNextTarget() {
	var kgiEmployeeHistoryId = $("#kgiEmployeeHistoryId").val();
	var url = $url + 'kgi/kgi-personal/next-kgi-employee-history';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kgiEmployeeHistoryId: kgiEmployeeHistoryId },
		success: function (data) {
		 
		}
	});
}
function viewTabKgi(tabId) { 
	var currentTabId = $("#currentTab").val();
	//alert(currentTabId + '==' + tabId);
	var kgiId = $("#kgiId").val();
	//alert(kgiId);
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
		var url = $url + 'kgi/view/kgi-team-employee';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kgiId: kgiId },
			success: function (data) {kgiId
				$("#show-content").html(data.kgiEmployeeTeam);
			}
		});
	}
	if (tabId == 2) {
		var url = $url + 'kgi/view/all-kgi-history';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kgiId: kgiId },
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
		var url = $url + 'kgi/view/kgi-chart';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kgiId: kgiId },
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
   
function showAnswer(kgiIssueId, show) { 
	if (show == 1) {
		$("#answer-site-" + kgiIssueId).show();
		$("#reply-" +  kgiIssueId).hide();
		$("#cancel-" + kgiIssueId).show();
	} else { 
		$("#answer-site-" + kgiIssueId).hide();
		$("#reply-" +  kgiIssueId).show();
		$("#cancel-" + kgiIssueId).hide();
	}
}
function showTeamKpi(kpiId,type) { 
	if (type == 1) {
		$("#kpi-team-" + kpiId).show();
		$("#hide-" + kpiId).show();
		$("#show-" + kpiId).hide();
		var url = $url + 'kgi/view/kpi-team';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kpiId: kpiId },
			success: function (data) {
				$("#kpi-team-"+kpiId).html(data.kpiTeam);
			}
		});
	} else { 
		$("#kpi-team-" + kpiId).hide();
		$("#hide-" + kpiId).hide();
		$("#show-" + kpiId).show();
	}
}

function showEditRelateKpi(type,kgiId) {
	if (type == 1) {
		$("#editRelateKpi").hide();
		$("#saveRelateKpi").show();
		$("#cancelRelateKpi").show();
		$('input[id="check-relate-kpi"]').each(function () {
			$(this).show();
		});
		var url = $url + 'kgi/view/kgi-has-kpi';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kgiId: kgiId },
			success: function (data) {
				$("#kpi").html('');
				$("#kpi").html(data.kpi);
			}
		});
	}
	if (type == 2) { 
		$("#editRelateKpi").show();
		$("#saveRelateKpi").hide();
		$("#cancelRelateKpi").hide();
		$('input[id="check-relate-kpi"]').each(function () {
			$(this).hide();
		});
		saveSelectedKpi(kgiId);
		$("#show-content").html('');
		var url = $url + 'kgi/view/kgi-kpi';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kgiId: kgiId },
			success: function (data) {
				
				$("#show-content").html(data.kpi);
				$('.alert-box').slideDown(500);
				setTimeout(function () {
					$('.alert-box').fadeOut(300);
				}, 1000);
			}
		});
	}
	if (type == 0) { 
		$("#editRelateKpi").show();
		$("#saveRelateKpi").hide();
		$("#cancelRelateKpi").hide();
		$("#show-content").html('');
		var url = $url + 'kgi/view/kgi-kpi';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kgiId: kgiId },
			success: function (data) {
				$("#show-content").html('');
				$("#show-content").html(data.kpi);
			}
		});
	}
 }