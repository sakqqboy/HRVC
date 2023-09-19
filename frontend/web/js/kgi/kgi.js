var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
function companyMultiBrach() { 
	var companyId = $("#companyId").val();
	clearEveryShow();
	var url = $url + 'kgi/management/company-multi-branch';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { companyId: companyId },
		success: function(data) {
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
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { multiBranch: multiBranch },
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
	var url = $url + 'kgi/management/department-multi-team';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { multiDepartment: multiDepartment,multiBranch:multiBranch },
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
		$('input[id="multi-check-team"]').each(function () {
			$(this).prop("checked", true);
		}
		);
	} else { 
		$('input[id="multi-check-team"]').each(function () {
			$(this).prop("checked", false);
		}
		);
		
	}
}