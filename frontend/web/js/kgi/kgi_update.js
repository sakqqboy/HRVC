var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
function companyMultiBrachUpdate() { 
	
	var companyId = $("#companyId-update").val();
	clearEveryShow();
	var acType = $("#acType").val();
	var kgiId=$("#kgiId").val();
	var url = $url + 'kgi/management/company-multi-branch';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { companyId: companyId, acType: acType,kgiId:kgiId },
		success: function(data) {
		    if (data.status) {
			$("#show-multi-branch-update").html(data.branchText);
		    }
      
		}
	   });
}
function checkAllBranchUpdate() { 
	var sumBranch = totalBranchUpdate();
	//alert(sumBranch);
	if ($("#check-all-branch-update").prop("checked") == true) {
		var i = 1;
		$('input[id="multi-check-update"]').each(function () {
			if (i < sumBranch) {
				$(this).prop("checked", true);
			} else { 
				$(this).prop("checked", true).trigger('change');
			}
			i++;
		});
	} else { 
		var i = 1;
		$('input[id="multi-check-update"]').each(function () {
			if (i != sumBranch) {
				$(this).prop("checked", false);
			} else {
				$(this).prop("checked", false).trigger('change');
			}
			i++;
		});
		$("#show-multi-team-update").html('');
	}
}
function branchMultiDepartmentUpdate() {
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
	var url = $url + 'kgi/management/branch-multi-department';
	var acType = $("#acType").val();
	var kgiId=$("#kgiId").val();
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { multiBranch: multiBranch, acType: acType,kgiId:kgiId },
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
function allDepartmentUpdate(branchId) { 
	var sumDepartment = totalDepartmentUpdate(branchId);
	if ($("#multi-check-all-"+branchId+"-update").prop("checked") == true) {
		var i = 1;
		$('input[id="multi-check-' + branchId + '-update"]').each(function () {
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
		
		$('input[id="multi-check-' + branchId + '-update"]').each(function () {
			if (i != sumDepartment) {
				$(this).prop("checked", false);
			} else {
				$(this).prop("checked", false).trigger('change');
			}
			i++;
		});
		
	}
}
function departmentMultiTeamUpdate(branchId) { 
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
	var kgiId=$("#kgiId").val();
	var url = $url + 'kgi/management/department-multi-team';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { multiDepartment: multiDepartment, multiBranch: multiBranch, acType: acType,kgiId:kgiId },
		success: function (data) {
			if (data.status) {
				$("#show-multi-team-update").html(data.textTeam);
				
			} else {
				$("#show-multi-team-update").html('');
			}
		}
	});
}
function totalDepartmentUpdate(branchId) {
	var totalDepartment = 0;
	var data = [];
	var i = 0;
	$('input[id="multi-check-' + branchId + '-update"]').each(function () {
		data[i] = $(this).val();
		i++;
	});
	totalDepartment = data.length;
	return totalDepartment;
}
function clearEveryShow() { 
	$("#show-multi-department-update").html('');
	$("#show-multi-team-update").html('');
	$("#show-multi-department-update").html('');
}
function allTeamUpdate(departmentId) { 
	if ($("#multi-check-all-team-"+departmentId+"-update").prop("checked") == true) {
		$('input[id="multi-check-team-'+departmentId+'-update"]').each(function () {
			$(this).prop("checked", true);
		}
		);
	} else { 
		$('input[id="multi-check-team-'+departmentId+'-update"]').each(function () {
			$(this).prop("checked", false);
		}
		);
		
	}
}
function updateKgi(kgiId) { 
	$("#acType").val('update');
	$("#kgiId").val(kgiId);
	resetUnit();
	var url = $url + 'kgi/management/prepare-update';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kgiId: kgiId},
		success: function (data) {
			$("#kgiName-update").val(data.kgiName);
			$("#companyId-update").val(data.companyId);
			$(".currentUnit").val(data.unitId);
			$(".previousUnit").val(data.unitId);
			$(".unit-" + parseInt(data.unitId)).css("background-color", "#3366FF");
			$(".unit-" + data.unitId).css("color", "white");
			//$("#periodDate-update").val(data.periodCheck);
			$("#from-date-update").val(data.fromDate);
			$("#to-date-update").val(data.toDate);
			$("#nextCheckDate-update").val(data.nextCheck);
			$("#targetAmount-update").val(data.targetAmount);
			$("#detail-update").val(data.detail);
			$("#quantRatio-update").val(data.quantRatio);
			$("#priority-update").val(data.priority);
			$("#amountType-update").val(data.amountType);
			$("#code-update").val(data.code);
			$("#status-update").val(data.status);
			$("#month-update").val(data.month);
			$("#result-update").val(data.result);
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
function checkRequiredUpdate() { 
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
	$('#update-kgi').find('input,select,textarea').each(function(){
		if(!$(this).prop('required')){
			
		} else {
			if (!$(this).val()) {
				check++;
			}
		}
	});
	if (check == 0) {
		$("#update-kgi").submit();
	} else { 
		alert("Please fill out the information completely !!!");
	}
	//
}