var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
function updateKpi(kpiId) { 
	$("#acType").val('update');
	$("#kpiId").val(kpiId);
	resetUnit();
	var url = $url + 'kpi/management/prepare-update';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kpiId: kpiId},
		success: function (data) {
			$("#kpiName-update").val(data.kpiName);
			$("#companyId-update").val(data.companyId);
			$(".currentUnit").val(data.unitId);
			$(".previousUnit").val(data.unitId);
			$(".unit-" + parseInt(data.unitId)).css("background-color", "#3366FF");
			$(".unit-" + data.unitId).css("color", "white");
			//$("#periodDate-update").val(data.periodCheck);
			$("#from-date-update").val(data.fromDate);
			$("#to-date-update").val(data.toDate);
			$("#nextCheckDate-update").val(data.nextCheck);
			$("#targetAmount-update").val(data.targetAmountText);
			$("#detail-update").val(data.detail);
			$("#quantRatio-update").val(data.quantRatio);
			$("#priority-update").val(data.priority);
			$("#amountType-update").val(data.amountType);
			$("#code-update").val(data.code);
			$("#status-update").val(data.status);
			$("#month-update").val(data.month);
			$("#result-update").val(data.resultText);
			$("#show-multi-branch-update").html(data.textBranch);
			$("#show-multi-department-update").html(data.textDepartment);
			$("#show-multi-team-update").html(data.textTeam);
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
function checkRequiredUpdateKpi() { 
	var i = 0;
	var isError = 0;
	var multiBranch = [];
		$("#multi-check-update:checked").each(function () {
			multiBranch[i] = $(this).val();
			i++;
		});
	checkedBranch = multiBranch.length;
	if (checkedBranch == 0) {
		alert("Please select at least 1 branch.");
		isError++;
		return false;
		
	} else { 
		for (a = 0; a < multiBranch.length; a++) { 
			multiDepartment = [];
			var b = 0;
			$("#multi-check-"+multiBranch[a]+"-update:checked").each(function () {
				multiDepartment[b] = $(this).val();
				b++;
			});
			checkedDepartment = multiDepartment.length;
			if (checkedDepartment == 0) {
				alert("Please select at least 1 department for each selected branch.");
				isError++;
				return false;
			} else { 
				for (c = 0; c < multiDepartment.length; c++) {
					var multiTeam = [];
					var d = 0;
					$("#multi-check-team"+multiDepartment[d]+"-update:checked").each(function () {
						multiTeam[d] = $(this).val();
						d++;
					});
					checkedTeam = multiTeam.length;
					if (checkedDepartment == 0) { 
						alert("Please select at least 1 team for each selected department.");
						isError++;
						return false;
					}
				 }
			}
		}
		
	}
	var check = 0;
	$('#update-kpi').find('input,select,textarea').each(function(){
		if(!$(this).prop('required')){
			
		} else {
			if (!$(this).val()) {
				check++;
			}
		}
	});
	if (check == 0) {
		$("#update-kpi").submit();
	} else { 
		alert("Please fill out the information completely !!!");
	}
	//
}
function kpiHistory(kpiId) { 
	var url = $url + 'kpi/management/history';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kpiId: kpiId },
		success: function (data) {
			$("#kpi-name-view").html(data.kpi.kpiName);
			$("#status-view").html(data.kpi.statusText);
			if (data.kpi.statusText == "Finished") { 
				$("#status-view").removeClass('bg-warning');
				$("#status-view").removeClass('text-dark');
				$("#status-view").addClass('bg-success');
				$("#status-view").css("color", "white !important");
			}
			$("#period-date-view").html(data.kpi.periodCheckText);
			if (data.kpi.status == 1) {
				$("#next-date-view").html(data.kpi.nextCheckText);
			} else {
				$("#next-date-view").html('-');
			}
			
			$("#company-name-view").html(data.kpi.companyName);
			$("#quantRatio-view").html(data.kpi.quantRatioText);
			$("#code-view").html(data.kpi.code);
			$("#target-view").html(data.kpi.targetAmountText);
			$("#result-view").html(data.kpi.resultText);
			$("#prirority-view").html(data.kpi.priority);
			$("#unit-view").html(data.kpi.unitText);
			$("#percentRatio").css("width", data.kpi.ratio + '%');
			$("#ratio-view").html(data.kpi.ratio);
			$("#country-view").html(data.kpi.countryName);
			$("#decription-view").html(data.kpi.detail);
			$("#team-view").html(data.teamText);
			$("#employee-view").html(data.employeeText);
			$("#kpi-history").html(data.historyText);
		 }
	});
}
function prepareDeleteKpi(kpiId) { 
	$("#kpiId-modal").val(kpiId);
}

function deleteKpi() { 
	var kpiId = $("#kpiId-modal").val();
	var url = $url + 'kpi/management/delete-kpi';
	$.ajax({
	    type: "POST",
	    dataType: 'json',
	    url: url,
	    data: { kpiId: kpiId },
	    success: function(data) {
		 if (data.status) {
		     $("#delete-kpi").modal("hide");
		     $("#kpi-" + kpiId).hide();
		 }
	    }
	});
}
$("#pills-Issues-tab-kpi").click(function () {
	$("#pills-Issues-tab-kpi").addClass("text-primary");
	$("#pills-History-tab-kpi").removeClass("text-primary");
	$("#pills-History").removeClass("active");
	$("#pills-Issues-tab-kpi").css("border-bottom", "5px #0d6efd solid");
	$("#pills-History-tab-kpi").removeAttr("style");
   });
$("#pills-History-tab-kpi").click(function () {
	$("#pills-History-tab-kpi").addClass("text-primary");
	$("#pills-Issues-tab-kpi").removeClass("text-primary");
	$("#pills-Issues").removeClass("active");
	$("#pills-History-tab-kpi").attr("style");
	$("#pills-History-tab-kpi").css("border-bottom", "5px #0d6efd solid");
	$("#pills-Issues-tab-kpi").removeAttr("style");
});
function showKpiComment(kpiId) { 
	var url = $url + 'kpi/management/show-comment';
	$.ajax({
	    type: "POST",
	    dataType: 'json',
	    url: url,
	    data: { kpiId: kpiId },
	    success: function(data) {
		 if (data.status) {
		     $("#kpi-name-issue").html(data.kpi.kpiName);
		     $("#pills-Issues").html(data.issueText);
		     $("#pills-History").html(data.historyText);
		     $("#company-issue").html(data.kpi.companyName);
		     $("#branch-issue").html(data.kpi.branchName);
		     $("#country-issue").html(data.kpi.countryName);
		     $("#flag-issue").attr('src',$url+data.kpi.flag);
		 }
	    }
	});
}
function showSelectFileNameKpi(kpiIssueId) {
	var message = "Attached : " + $("#attachKpiFileAnswer-" + kpiIssueId).val();
	$("#fileName-" + kpiIssueId).html(message);
}
function showAttachFileNameKpi(kpiId) {
	var message = "Attached : " + $("#attachkpiFile").val();
	$("#attachFile-" + kpiId).html(message);
}
function answerKpiIssue(kpiIssueId) {
	var answer = $("#answer-" + kpiIssueId).val();
	var fd = new FormData();
	var files = $("#attachKpiFileAnswer-" + kpiIssueId)[0].files;
	if (files.length > 0) {
		fd.append('file', files[0]);
   
	}
	fd.append('answer', answer);
	fd.append('kpiIssueId', kpiIssueId);
	var url = $url + 'kpi/management/save-kpi-answer';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: fd,
		contentType: false,
		processData: false,
		success: function (data) {
			if (data.status) {
				$("#solution-" + kpiIssueId).append(data.commentText);
				$("#answer-" + kpiIssueId).val('');
			}
		}
	});
}
function kpiFilter() {
	var companyId = $("#company-filter").val();
	var branchId = $("#branch-filter").val();
	var teamId = $("#team-filter").val();
	var month = $("#month-filter").val();
	var status = $("#status-filter").val();
	var year = $("#year-filter").val();
	var type = $("#type").val();
	var url = $url + 'kpi/management/search-kpi';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { companyId: companyId,branchId: branchId,teamId: teamId,month: month,status: status,year: year,type:type },
		success: function (data) {
			
		}
	});
}
function departmentMultiTeamUpdateKpi(branchId) { 
	var sumDepartment = totalDepartmentUpdate(branchId);
	var multiDepartmentBranch = [];
	var multiDepartment = [];
	var multiBranch = [];
	var i = 0;
		$("#multi-check-"+branchId+"-update:checked").each(function () {
			multiDepartmentBranch[i] = $(this).val();
			i++;
		});
		$("#multi-check-update:checked").each(function () {
			multiBranch[i] = $(this).val();
			i++;
		});
		$(".multi-check-department-update:checked").each(function () {
			multiDepartment[i] = $(this).val();
			i++;
		});
	if (sumDepartment != multiDepartmentBranch.length) {
		$("#multi-check-all-" + branchId+"-update").prop("checked", false);
	} else { 
		$("#multi-check-all-" + branchId+"-update").prop("checked", true);
	}
	var acType = $("#acType").val();
	var kpiId=$("#kpiId").val();
	var url = $url + 'kpi/management/department-multi-team';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { multiDepartment: multiDepartment, multiBranch: multiBranch, acType: acType,kpiId:kpiId },
		success: function (data) {
			if (data.status) {
				$("#show-multi-team-update").html(data.textTeam);
				
			} else {
				$("#show-multi-team-update").html('');
			}
		}
	});
}
function branchMultiDepartmentUpdateKpi() {
	var multiBranch = [];
	var sumBranch = totalBranchUpdate();
	var i = 0;
		$("#multi-check-update:checked").each(function () {
			multiBranch[i] = $(this).val();
			i++;
		});
	if (sumBranch != multiBranch.length) {
		$("#check-all-branch-update").prop("checked", false);
	} else { 
		$("#check-all-branch-update").prop("checked", true);
	}
	var url = $url + 'kpi/management/branch-multi-department';
	var acType = $("#acType").val();
	var kpiId=$("#kpiId").val();
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { multiBranch: multiBranch, acType: acType,kpiId:kpiId },
		success: function (data) {
			if (data.status) {
				$("#show-multi-department-update").html(data.textDepartment);
			} else {
				$("#show-multi-department-update").html('');
			}
		}
	});
}
function totalBranchUpdate() { 
	var totalBranch = 0;
	var data = [];
	var i = 0;
	$('input[id="multi-check-update"]').each(function () {
		data[i] = $(this).val();
		i++;
	});
	totalBranch=data.length;
	return totalBranch;
}
function copyKpi(kpiId) { 
	if (confirm('Do you want to make a copy?')) { 
	    var url = $url + 'kpi/management/copy-kpi?kpiId='+kpiId;
	    window.location.href=url;
	}
}
function kpiCompanyBranch(companyId,kpiId) { 
	var url = $url + 'kpi/management/kpi-branch';
	$.ajax({
	    type: "POST",
	    dataType: 'json',
	    url: url,
	    data: { companyId: companyId,kpiId:kpiId},
	    success: function (data) {
		 $("#kpi-branch").html(data.textBranch);
		 $("#kpiName").html(data.kpiName);
		 $("#companyName").html(data.companyName);
	    }
	});
}
function assignKpiBranch(kpiId,branchId) { 
	var checked = 0;
	if ($("#assign-branch-kpi-" + kpiId + '-' + branchId).prop("checked") == true) {
	    checked = 1;
	}
	var url = $url + 'kpi/management/kpi-assign-branch';
	$.ajax({
	    type: "POST",
	    dataType: 'json',
	    url: url,
	    data: { branchId: branchId,kpiId:kpiId,checked,checked},
	    success: function (data) {
		 if (data.status) { 
		     $("#total-branch-" + kpiId).html(data.totalBranch);
		 }
	    }
	});
}
function kpiCompanyEmployee(kpiId) { 
	var url = $url + 'kpi/management/kpi-employee';
	$("#kpiId").val(kpiId);
	$("#employeeInBranch").html('');
	$("#search-employee-box").css("display", "none");
	$("#search-employee-kpi").val('');
	$("#search-employee-department").val('')
	$.ajax({
	    type: "POST",
	    dataType: 'json',
	    url: url,
	    data: {kpiId:kpiId},
	    success: function (data) {
		 if (data.status) { 
		     $("#search-employee-department").html(data.departmentText);
		     $("#employeeInBranch").html(data.textEmployee);
   
		 }
	    }
	});
}
function kpiEmployee(employeeId, kpiId) { 
   
	var url = $url + 'kpi/management/kpi-assign-employee';
	var checked = 0;
	if ($("#kpi-employee-" + employeeId + '-' + kpiId).prop("checked") == true) {
	    checked = 1;
	}
	$.ajax({
	    type: "POST",
	    dataType: 'json',
	    url: url,
	    data: {kpiId:kpiId,employeeId:employeeId,checked:checked},
	    success: function (data) {
		 if (data.status) { 
		     $("#totalEmployee-"+kpiId).html(data.totalEmployee);
		 }
	    }
	});
}
function searchKpiEmployee() { 
	var kpiId = $("#kpiId").val();
	$("#search-employee-box").html('');
	var searchText = $("#search-employee-kpi").val();
	var departmentId = $("#search-employee-department").val();
	var teamId = $("#search-employee-team").val();
	var url = $url + 'kpi/management/search-kpi-employee';
	// if ($.trim(searchText) != '') {
	    $.ajax({
		 type: "POST",
		 dataType: 'json',
		 url: url,
		 data: { kpiId: kpiId, searchText: searchText,departmentId:departmentId,teamId:teamId },
		 success: function (data) {
		     if (data.status) {
			//   $("#search-employee-box").show();
			     //      $("#search-employee-box").html(data.textEmployee);
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
function searchKpiTeam() { 
	var kpiId = $("#kpiId").val();
	//$("#search-employee-box").html('');
	// $("#search-employee-team").html('<option value="">Team</option>');
	var searchText = $("#search-employee-kpi").val();
	var departmentId = $("#search-employee-department").val();
	var teamId = $("#search-employee-team").val();
	
		var url = $url + 'kpi/management/search-kpi-employee';
		// if ($.trim(searchText) != '') {
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kpiId: kpiId, searchText: searchText, departmentId: departmentId, teamId: teamId },
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
function searchAssignKpi() { 
	var month = $("#kpiMonthFilter").val();
	var url = $url + 'kpi/management/search-assign-kpi';
	    $.ajax({
		 type: "POST",
		 dataType: 'json',
		 url: url,
		 data: { month: month},
		 success: function (data) {
		     if (data.status) {
			  $("#assign-search-result").html(data.kpiText);
		     }
		 }
	    });
}
function checkAllKpiEmployee(kpiId) {
	var url = $url + 'kpi/management/check-all-kpi-employee';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kpiId: kpiId },
		success: function (data) {
			if ($("#all-kpi-employee-" + kpiId).prop("checked") == true) {
	 
				$.each(data.employeeId, function (key, value) {
					if ($("#kpi-employee-" + value + '-' + kpiId).prop("checked") == false) {
						$("#kpi-employee-" + value + '-' + kpiId).prop("checked", true);
						kpiEmployee(value, kpiId);
					}
				});
			} else {
		    
				$.each(data.employeeId, function (key, value) {
					if ($("#kpi-employee-" + value + '-' + kpiId).prop("checked") == true) {
						$("#kpi-employee-" + value + '-' + kpiId).prop("checked", false);
						kpiEmployee(value, kpiId);
					}
				});
			}
		}
	});
}
function approveTargetKpiTeam(kpiTeamId, approve) {
	var url = $url + 'kpi/management/approve-kpi-target';
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
			data: { kpiTeamId: kpiTeamId, approve: approve },
			success: function (data) {
				if (data.status) {
					var url = $url + 'kpi/management/wait-approve';
					window.location.href = url;
				}
			}
		});
	}
}
function approveTargetKpiEmployee(kpiEmployeeId, approve) {
	var url = $url + 'kpi/management/approve-kpi-employee-target';
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
			data: { kpiEmployeeId: kpiEmployeeId, approve: approve },
			success: function (data) {
				if (data.status) {
					var url = $url + 'kpi/management/wait-approve';
					window.location.href = url;
				}
			}
		});
	}
}