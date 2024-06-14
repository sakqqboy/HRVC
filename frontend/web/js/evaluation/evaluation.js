var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
function environmentFrame(environmentId) {
	$("#environmentId").val(environmentId);
}
function showFrame(environmentId) { 
	$("#show-frame-" + environmentId).hide();
	$("#hide-frame-" + environmentId).show();
	$("#environment-frame-" + environmentId).html('');
	var previousShow = $("#current-show").val();
	if (previousShow != '') {
		$("#environment-frame-" + previousShow).css("display", "none");
		$("#show-frame-" + previousShow).show();
		$("#hide-frame-" + previousShow).hide();
	}
	var url = $url + 'evaluation/environment/environment-frame';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { environmentId: environmentId},
		success: function (data) {
			if (data.status) { 
				$("#environment-frame-" + environmentId).css("display", "");
				$("#environment-frame-" + environmentId).html(data.frame);
				$("#current-show").val(environmentId);
			}
		}
	});
}
function hideFrame(environmentId) { 
	$("#hide-frame-" + environmentId).hide();
	$("#show-frame-" + environmentId).show();
	var previousShow = $("#current-show").val();
	if (previousShow != '') { 
		$("#environment-frame-" + previousShow).css("display", "none");
		$("#environment-frame-" + previousShow).html('');
		$("#current-show").val('');
	}
}
function deleteFrame(frameId) { 
	var url = $url + 'evaluation/environment/delete-frame';
	if (confirm('Are you sure to delete this Frame?')) {
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { frameId: frameId },
			success: function (data) {
				if (data.status) {
					$("#frame-" + frameId).hide();
				}
			}
		});
	}
}
function setTermDate(termItemId) {
	$("#termItemId").val(termItemId);
}
function changeTermBonus(termId) { 
	var oldValue = $("#bonus" + termId).val();
	var newValue = $("#isBonus" + termId+":checked").val();
	if (oldValue != newValue) { 
		if (newValue == 1) {
			var bonus = 'YES';
		} else { 
			var bonus = 'NO';
		}
		if (confirm("Are you sure to change BONUS to '" + bonus + "' ?")) {
			var url = $url + 'evaluation/environment/change-term-bonus';
			$.ajax({
				type: "POST",
				dataType: 'json',
				url: url,
				data: { termId: termId,newValue:newValue },
				success: function (data) {
					if (data.status) {
						$("#bonus" + termId).val(newValue);
					}
				}
			});
		}
	}
}
function clickAllAllowance() { 
	if ($("#all-allowance").prop("checked") == true) {
		$('input[id="structure"]').each(function () {
			$(this).prop("checked", true);
			enableSettingValue($(this).val());
		});
	} else { 
		$('input[id="structure"]').each(function () {
			$(this).prop("checked", false);
			enableSettingValue($(this).val());
	});
	}
}
function enableSettingValue(structureId) {
	//alert(structureId)
	if ($(".structure-" + structureId).prop("checked") == true) {
		$("#default-value-" + structureId).removeAttr("disabled");
	} else { 
		$("#default-value-" + structureId).attr("disabled",true);
	}
}
function checkDupplicateSalary() {
	var titleId = $("#title").val();
	var url = $url + 'evaluation/salary/check-dupplicate';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { titleId: titleId },
		success: function (data) {
			if (data.status) {
				alert("This title was already set up.");
				$("#title").val("");
			}
		}
	});
}
function checkDupplicateAllowance() {
	
	var allowanceName = $("#allowanceName").val();
	var url = $url + 'evaluation/salary/check-dupplicate-allowance';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { allowanceName: allowanceName },
		success: function (data) {
			if (data.status) {
				alert("This Allowance name was already set up.");
				$("#allowanceName").val("");
			} else { 
				$("#create-allowance").submit();
			}
		}
	});
}
function deleteAllowance(structureId) { 
	if (confirm('Are you sure to delete this allowance')) { 
		var url = $url + 'evaluation/salary/delete-allowance';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { structureId: structureId },
		success: function (data) {
			$("#allowance-" + structureId).hide();
		}
	});
	}
}
function prepareUpdateAllowance(structureId) { 
	$("#updateId").val(structureId);
	$("#create-allowance-btn").css("display","none");
	$("#update-allowance-btn").css("display","inline-block");
	var url = $url + 'evaluation/salary/prepare-update-allowance';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { structureId: structureId },
		success: function (data) {
			$("#allowanceName").val(data.allowanceName);
		}
	});
}
function updateAllowance() { 
	var structureId = $("#updateId").val();
	var newName= $("#allowanceName").val();
	var url = $url + 'evaluation/salary/update-allowance';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { structureId: structureId,newName:newName },
		success: function (data) {
			if (data.status) {
				$("#updateId").val('');
				$("#allowanceName-" + structureId).html(newName);
				$("#allowanceName").val("");
			} else { 
				alert("This Allowance name was already set up.");
				$("#allowanceName").val("");
			}
		}
	});
}
function filterSalary() {
	var companyId = $("#company").val();
	var departmentId = $("#department").val();
	var titleId = $("#title").val();
	var url = $url + 'evaluation/salary/filter-salary';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { companyId: companyId,departmentId:departmentId,titleId:titleId},
		success: function (data) {
			
		}
	});
}
function deleteCompanySalary(salaryId) { 
	if (confirm("Are you sure to delete this company's salary?")) { 
		var url = $url + 'evaluation/salary/delete-company-salary';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { salaryId: salaryId},
			success: function (data) {
				if (data.status) { 
					$("#title-salary-" + salaryId).css("display", "none");
				}
			}
		});
	}
}
function employeeAllowance(employeeId) { 
	//if ($("#employee-" + employeeId).prop('checked') == true) {
	if ($("#salaryRegistration").modal('show') == false) { 
		$("#salaryRegistration").modal('show');
	}
	var oldSelect = $("#currentSelect").val();
	$("#employeeId").val(employeeId);
		var url = $url + 'evaluation/salary/employee-allowance';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { employeeId: employeeId},
			success: function (data) {
				$("#select-employee-" + oldSelect).css("background-color", "white");
				$("#select-employee-" + oldSelect).css("font-weight", "400");
				$("#select-employee-" + employeeId).css("background-color", "#F0F8FF");
				$("#select-employee-" + employeeId).css("font-weight", "600");
				$("#not-set").html(" ");
				$("#currentSelect").val(employeeId);
				$("#employeeName").html(data.employeeName);
				if (data.status) {
					var hasSalary = 0;
					$.each(data.allAllowance, function (structureId, value) {
						$("#allowance-" + structureId).val(value.value);
						$("#allowance-" + structureId).removeAttr("disabled", true);
					});
					$.each(data.allowance, function (structureId, value) {
						$("#allowance-" + structureId).val(value.value);
						if (structureId == 'hasSalary' && value == 1) {
							hasSalary = 1;
						}
					});
					if (hasSalary == 1) {
						$("#create-button").css("display", "none");
						$("#update-button").css("display", "inline");
					} else {
						$("#create-button").css("display", "inline");
						$("#update-button").css("display", "none");
						
					}
					
				} else {
					$("#not-set").html("Didn't set this title salay ! ! !");
					$("#create-button").css("display", "none");
					$("#update-button").css("display", "none");
					$.each(data.allAllowance, function (structureId, value) {
						$("#allowance-" + structureId).val('');
						$("#allowance-" + structureId).attr("disabled", true);
					});
				}
				if (data.issetSalary == 0) {
					$("#not-set").html("Didn't set this title salay ! ! !");
					$.each(data.allAllowance, function (structureId, value) {
						$("#allowance-" + structureId).val('');
						$("#allowance-" + structureId).attr("disabled",true);
					});
				}
			}
		});
	//} else { 
	
	//}
}
function saveEmployeeSalary() { 
	var employeeId = $("#employeeId").val();
	var baseSalary = $("#allowance-1").val();
	if ($.trim(baseSalary) == '') {
		alert('Basic Salary can not be null');
	} else if (employeeId == '') { 
		alert('Please select 1 employee for set up salary');
	} else{
		var i = 0;
		var employeeAllownce = [];
		var url = $url + 'evaluation/salary/all-allowance';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			success: function (data) {
				$.each(data.allowance, function (structureId, value) {
					employeeAllownce[structureId] = $("#allowance-" + structureId).val();
				});
				var url = $url + 'evaluation/salary/save-employee-salary';
				$.ajax({
					type: "POST",
					dataType: 'json',
					url: url,
					data: { baseSalary: baseSalary, employeeAllownce: employeeAllownce, employeeId: employeeId },
					success: function (data) {
						if (data.status) {
							$("#create-button").css("display", "none");
							$("#update-button").css("display", "inline");
							$('.alert-box2').slideDown(500);
							setTimeout(function () {
								$('.alert-box2').fadeOut(300);
							}, 3000);
							$("#check-" + employeeId).css("display", "inline");
						} else { 

						}
					}
				});
			}
		});
	}
}
function filterSalaryRegister() { 
	var departmentId = $("#department").val();
	var companyId = $("#companyId").val();
	var titleId = $("#title").val();
	if (departmentId == "" && titleId == "") {
		alert("Please select Department and Title");
	} else { 
		var url = $url + 'evaluation/salary/filter-salary-register';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { departmentId: departmentId, titleId: titleId, companyId: companyId },
			success: function (data) {
				
			}
		});
	}
}
function deleteEmployeeSalary(employeeId) { 
	if (confirm('Are you sure to delete this employee salary?')) {
		var url = $url + 'evaluation/salary/delete-employee-salary';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { employeeId: employeeId },
			success: function (data) {
				window.location.reload();
			}
		});
	}
}
function showEvaluationDetail(type) { 
	if (type == 'kfi') { 
		if ($("#check-kfi").prop("checked") == true) {
			$("#kfi").show();
		} else { 
			$("#kfi").css("display","none");
		}
	}
	if (type == 'kgi') { 
		if ($("#check-kgi").prop("checked") == true) {
			$("#kgi").show();
		} else { 
			$("#kgi").css("display","none");
		}
	}
	if (type == 'kpi') { 
		if ($("#check-kpi").prop("checked") == true) {
			$("#kpi").show();
		} else { 
			$("#kpi").css("display","none");
		}
	}
}
function calculateKfiPercent(kfiId,type) { 
	var sum = 0;
	$('input[name="kfiIds[]"]').each(function () {
		var weight = $("#weight-kfi-" + $(this).val()).val();
		if ($("#kfi-check-" + $(this).val()).prop("checked") == true) {
			sum += parseInt(weight);
		}
		if (sum <= 100) {
			$("#total-weight").html(sum);
			$("#sumPercent").val(sum);
		} else {
			if (type == 1) {
				$("#weight-kfi-" + kfiId).val(0);
			} else { 
				$("#kfi-check-" + kfiId).prop("checked",false);
			}
			alert('Total can not over 100%');
			return false;
		}
	});

}
function calculateKgiPercent(kgiTeamId,type) { 
	var sum = 0;
	$('input[name="kgiTeamIds[]"]').each(function () {
		var weight = $("#weight-kgi-" + $(this).val()).val();
		if ($("#kgi-check-" + $(this).val()).prop("checked") == true) {
			sum += parseInt(weight);
		}
		if (sum <= 100) {
			$("#total-weight").html(sum);
			$("#sumPercent").val(sum);
		} else {
			if (type == 1) {
				$("#weight-kgi-" + kgiTeamId).val(0);
			} else { 
				$("#kgi-check-" + kgiTeamId).prop("checked",false);
			}
			alert('Total can not over 100%');
			return false;
		}
	});
}
function calculateKgiEmployeePercent(kgiEmployeeId,type) { 
	var sum = 0;
	$('input[name="kgiEmployeeIds[]"]').each(function () {
		var weight = $("#weight-kgi-employee-" + $(this).val()).val();
		if ($("#kgi-check-employee-" + $(this).val()).prop("checked") == true) {
			sum += parseInt(weight);
		}
		if (sum <= 100) {
			//$("#total-weight-employee").html(sum);
			$("#sumPercentEmployee").val(sum);
		} else {
			if (type == 1) {
				$("#weight-kgi-employee-" + kgiEmployeeId).val(0);
			} else { 
				$("#kgi-check-employee-" + kgiEmployeeId).prop("checked",false);
			}
			alert('Total can not over 100%');
			return false;
		}
	});
}
function calculateKpiPercent(kpiEmployeeId,type) { 
	var sum = 0;
	$('input[name="kpiEmployeeIds[]"]').each(function () {
		var weight = $("#weight-kpi-" + $(this).val()).val();
		if ($("#kpi-check-" + $(this).val()).prop("checked") == true) {
			sum += parseInt(weight);
		}
		if (sum <= 100) {
			$("#total-weight").html(sum);
			$("#sumPercent").val(sum);
		} else {
			if (type == 1) {
				$("#weight-kpi-" + kpiEmployeeId).val(0);
			} else { 
				$("#kpi-check-" + kpiEmployeeId).prop("checked",false);
			}
			alert('Total can not over 100%');
			return false;
		}
	});
}
function calculateKpiTeamPercent(kpiTeamId,type) { 
	var sum = 0;
	$('input[name="kpiTeamIds[]"]').each(function () {
		var weight = $("#weight-kpi-team-" + $(this).val()).val();
		if ($("#kpi-check-team-" + $(this).val()).prop("checked") == true) {
			sum += parseInt(weight);
		}
		if (sum <= 100) {
			//$("#total-weight").html(sum);
			$("#sumPercentTeam").val(sum);
		} else {
			if (type == 1) {
				$("#weight-kpi-team-" + kpiTeamId).val(0);
			} else { 
				$("#kpi-check-team-" + kpiTeamId).prop("checked",false);
			}
			alert('Total can not over 100%');
			return false;
		}
	});
}
function checkKfiPercent() { 
	var sumPercent = $("#sumPercent").val();
	if (sumPercent == 100) {
		$("#save-kfi-weight").submit();
	} else { 
		alert("Total percent must be equal to 100");
	}
}
function checkKgiPercent() { 
	var sumPercent = $("#sumPercent").val();
	var sumPercentEmployee = $("#sumPercentEmployee").val();
	if (sumPercent == 100 && sumPercentEmployee==100) {
		$("#save-kgi-weight").submit();
	} else { 
		alert("Total percent must be equal to 100");
	}
}
function checkKpiPercent() { 
	var sumPercent = $("#sumPercent").val();
	var sumPercentTeam = $("#sumPercentTeam").val();
	if (sumPercent == 100 && sumPercentTeam==100) {
		$("#save-kpi-weight").submit();
	} else { 
		alert("Total percent must be equal to 100");
	}
}
function checkAllEmployee(titleName) { 
	var url = $url + 'setting/employee/employee-title-name';
	var titleReplace=titleName.replace(" ", "");
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { titleName: titleName },
		success: function (data) {
			if (data.status) {
				$.each(data.employeeId, function (index, employeeId) {
					if ($("#check-title-" + titleReplace).prop("checked") == true) {
						$("#employee-" + employeeId).prop("checked", true);
					} else {
						$("#employee-" + employeeId).prop("checked", false);
					}
				});
			}
		}
	});
}
function saveEmployeePim(termId) { 
	var i = 0;
	var employeeIds = [];
	var pimWeightId = $("#pimWeightId").val();
	$('input[name="pimEmployee[]"]').each(function () {
		
		if ($("#employee-" + $(this).val()).prop("checked") == true) {
			employeeIds[i] = $(this).val();
			i++;
		}

	});
	if (employeeIds.length > 0) {
		var url = $url + 'evaluation/environment/save-employee-pim';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { employeeIds: employeeIds, termId: termId, pimWeightId: pimWeightId },
			success: function (data) {
				if (data.status) {
					$('.alert-box2').slideDown(500);
					setTimeout(function () {
						$('.alert-box2').fadeOut(300);
					}, 3000);
					
				}
			}
		});
	} else { 
		alert("please select the employee(s).")
	}
}
function showModalWeight(type) {
	var employeePimWeightId = $("#employeePimWeightId").val();
	if (employeePimWeightId == "") {
		alert("Please select an employee");
	} else {
		if (type == "KGI") {
			var weight = $("#kgiWeight").val();
		}
		if (type == "KFI") {
			var weight = $("#kfiWeight").val();
		}
		if (type == "KPI") {
			var weight = $("#kpiWeight").val();
		}
		$('#set_pim_weight').modal('show');
		$("#type-weight").html(type + ' Weight Allocate');
		$("#weight").val(weight);
		$("#type").val(type);
	}
	
}
function saveWeightAllocate() { 
	var type = $("#type").val();
	var employeePimWeightId = $("#employeePimWeightId").val();
	var weight = $("#weight").val();
	if (type == "KGI") { 
		var kgiWeight = parseInt($("#weight").val());
		var kfiWeight = parseInt($("#kfiWeight").val());
		var kpiWeight = parseInt($("#kpiWeight").val());
	}
	if (type == "KFI") { 
		var kfiWeight = parseInt($("#weight").val());
		var kgiWeight = parseInt($("#kgiWeight").val());
		var kpiWeight = parseInt($("#kpiWeight").val());
	}
	if (type == "KPI") { 
		var kpiWeight = parseInt($("#weight").val());
		var kgiWeight = parseInt($("#kgiWeight").val());
		var kfiWeight = parseInt($("#kfiWeight").val());
	}
	var totalPercent = kgiWeight + kpiWeight + kfiWeight;
	if (totalPercent > 100) {
		alert("Total percentage can not over 100.")
	} else { 
		if (type == "KGI") { 
			$("#kgiWeight").val($("#weight").val());
			$("#kgi-weight").html($("#weight").val());
		}
		if (type == "KFI") { 
			$("#kfiWeight").val($("#weight").val());
			$("#kfi-weight").html($("#weight").val());
		}
		if (type == "KPI") { 
			$("#kpiWeight").val($("#weight").val());
			$("#kpi-weight").html($("#weight").val());
		}
		var url = $url + 'evaluation/environment/save-pim-allocate';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { type: type, employeePimWeightId: employeePimWeightId, weight: weight},
			success: function (data) {
				if (data.status) {
					$('.alert-box2').slideDown(500);
					setTimeout(function () {
						$('.alert-box2').fadeOut(300);
					}, 3000);
					$('#set_pim_weight').modal('hide');
					// $("#totalPercent").html(totalPercent);
					// $("#data-total-percent").removeAttr('data-num');
					// $("#data-total-percent").attr("data-num", totalPercent);
					// $("#data-total-percent").removeAttr('data-value');
					// $("#data-total-percent").attr("data-value", totalPercent + '%');
					$("#totalPercent").attr("data-num", totalPercent);
					$("#totalPercent").attr("data-value", totalPercent + "%");
					$("#totalPercent").css("background", "conic-gradient(rgb(41, 140, 233) calc(" +totalPercent + "%), rgb(219, 239, 247) 0deg)");
					$("#kfi-weight").html(kfiWeight + "%");
					$("#kgi-weight").html(kgiWeight + "%");
					$("#kpi-weight").html(kpiWeight + "%");
				}
			}
		});
	}
	
}
function selectEmployeePim(employeeId,termId) { 
	var oldSelect = $("#current-select").val();
	var employeeName = $("#e-name-" + employeeId).val();
	if (oldSelect != '') { 
		$("#select-employee-" + oldSelect).css("background-color", "transparent");
		$("#select-employee-" + oldSelect).css("font-weight", "400");
	}
	$("#select-employee-" + employeeId).css("background-color", "#D7EBFF");
	$("#select-employee-" + employeeId).css("font-weight", "700");
	$("#current-select").val(employeeId);
	$("#all-employee-pim").html('<div class="col-12 text-center font-size-12">Select an employee</div>');
	$("#employee-name").html(employeeName);
	var url = $url + 'evaluation/environment/employee-pim';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { employeeId: employeeId, termId: termId },
		success: function (data) {
			if (data.status) {
				$("#totalPercent").attr("data-num", data.totalPimWeight);
				$("#totalPercent").attr("data-value", data.totalPimWeight + "%");
				$("#totalPercent").css("background", "conic-gradient(rgb(41, 140, 233) calc(" + data.totalPimWeight + "%), rgb(219, 239, 247) 0deg)");
				$("#kfi-weight").html(data.kfiWeight + "%");
				$("#kgi-weight").html(data.kgiWeight+"%");
				$("#kpi-weight").html(data.kpiWeight + "%");
				$("#all-employee-pim").html(data.employeePimWeight);
				$("#employeePimWeightId").val(data.employeePimWeightId);
				$("#kfiWeight").val(data.kfiWeight);
				$("#kgiWeight").val(data.kgiWeight);
				$("#kpiWeight").val(data.kpiWeight);
			}
		}
	});
}
function setEvaluator(employeeId) { 
	$("#evaluator-setting").modal('show');
	$("#evaluateeId").val(employeeId);
	 $('input[name="primary[]"]').each(function () {
		$("#primary-eva-" + $(this).val()).prop("checked",false);
		//$("#primary-eva-" + $(this).val()).removeAttr("checked",true);
	});
	$('input[name="final[]"]').each(function () {
		$("#final-eva-" + $(this).val()).prop("checked",false);
		//$("#final-eva-" + $(this).val()).removeAttr("checked");
	});
	var url = $url + 'setting/employee/employee-detail2';
	var termId = $("#termId").val();
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { employeeId: employeeId},
		success: function (data) {
			$("#employeeFirstname").html(data.employeeFirstname);
			$("#employeeSurename").html(data.employeeSurename);
			$("#employeeTitle").html(data.titleName);
			$("#employeeBranch").html(data.branchName);
			var url = $url + 'evaluation/environment/employee-evaluator';
			$.ajax({
				type: "POST",
				dataType: 'json',
				url: url,
				data: { employeeId: employeeId,termId:termId},
				success: function (data) {
					if (data.status2) { 
						$("#primary-eva-" + data.primaryId).prop("checked",true)
						$("#final-eva-" + data.finalId).prop("checked",true);
					}
				}
					
			});
		}
	});
}
// function checkAllEmployeeDepartment(departmentName) { 
// 	var departmentNameReplace = departmentName.replace(" ", "");
// 	var url = $url + 'setting/employee/employee-department-name';
// 	//alert(departmentNameReplace);
// 	$.ajax({
// 		type: "POST",
// 		dataType: 'json',
// 		url: url,
// 		data: { departmentName: departmentName },
// 		success: function (data) {
// 			if (data.status) {
// 				$.each(data.employeeIds, function (index, employeeId) {
// 					if ($("#check-department-" + departmentNameReplace).prop("checked") == true) {
// 						$("#primary-eva-" + employeeId).prop("checked", true);
// 					} else {
// 						$("#primary-eva-" + employeeId).prop("checked", false);
// 					}
// 				});
// 			}
// 		}
// 	});
// }
// function checkAllEmployeeDepartmentFinal(departmentName) { 
// 	var departmentNameReplace = departmentName.replace(" ", "");
// 	var url = $url + 'setting/employee/employee-department-name';
// 	//alert(departmentNameReplace);
// 	$.ajax({
// 		type: "POST",
// 		dataType: 'json',
// 		url: url,
// 		data: { departmentName: departmentName },
// 		success: function (data) {
// 			if (data.status) {
// 				$.each(data.employeeIds, function (index, employeeId) {
// 					if ($("#check-department-final-" + departmentNameReplace).prop("checked") == true) {
// 						$("#final-eva-" + employeeId).prop("checked", true);
// 					} else {
// 						$("#final-eva-" + employeeId).prop("checked", false);
// 					}
// 				});
// 			}
// 		}
// 	});
// }
function saveEvaluator() { 
	var employeeId = $("#evaluateeId").val();
	var termId = $("#termId").val();
	var primaryId = $("input[name='primary[]']:checked").val();
	var finalId =$("input[name='final[]']:checked").val();
	// $('input[name="primary[]"]').each(function () {
	// 	if ($("#primary-eva-" + $(this).val()).prop("checked") == true) {
	// 		primaryId[i] = $(this).val();
	// 		i++;
	// 	}
	// });
	// var j = 0;
	// $('input[name="final[]"]').each(function () {
	// 	if ($("#final-eva-" + $(this).val()).prop("checked") == true) {
	// 		finalId[i] = $(this).val();
	// 		j++;
	// 	}

	// });
	if (primaryId == "") {
		alert("Please select the evaluator.");
	} else {
		if (employeeId == primaryId || employeeId == finalId) { 
			alert("Can not choose same evaluator with employee.")
		} else {
			var url = $url + 'evaluation/environment/save-evaluator';
			$.ajax({
				type: "POST",
				dataType: 'json',
				url: url,
				data: { employeeId: employeeId, primaryId: primaryId, finalId: finalId, termId: termId },
				success: function (data) {
					if (data.status) {
						$("#evaluator-setting").modal('hide');
						$("#primary-" + employeeId).html(data.primaryName);
						$("#primary-title-" + employeeId).html(data.primaryTitle + ', ' + data.primaryBranch);
						$("#final-" + employeeId).html(data.finalName);
						$("#final-title-" + employeeId).html(data.finalTitle+', '+data.finalBranch);
					}
				}
			});
		}
		
	 }
	
}
function evaluationType(type, weight, total) { 
	$("#total-item").html(total);
	if (type == 'kfi') { 
		$("#eva-type").html('KFI ' + weight + '%');
		
		$("#kfi-eva").show();
		$("#kgi-eva").css("display","none");
		$("#kpi-eva").css("display","none");
	}
	if (type == 'kgi') { 
		$("#eva-type").html('KGI ' + weight + '%');
		$("#kgi-eva").show();
		$("#kfi-eva").css("display","none");
		$("#kpi-eva").css("display","none");
	}
	if (type == 'kpi') { 
		$("#eva-type").html('KPI ' + weight + '%');
		$("#kpi-eva").show();
		$("#kgi-eva").css("display","none");
		$("#kfi-eva").css("display","none");
	}
}
function prepareKfiEvaluate(kfiId,kfiWeightId) {
	var url = $url + 'evaluation/eva/prepare-kfi-eva';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kfiId: kfiId,kfiWeightId:kfiWeightId},
		success: function (data) {
			if (data.status) { 
				$("#kfiName").html(data.kfiName);
				$("#kfiWeightId").val(kfiWeightId);
				$("#firstScore").val(data.firstScore);
				$("#firstComment").html(data.firstComment);
				$("#finalScore").val(data.finalScore);
				$("#finalComment").html(data.finalComment);
				if (data.enableFirst == 1) {
					$("#firstScore").removeAttr("disabled");
					$("#firstComment").removeAttr("disabled");
				} else { 
					//$("#firstScore").removeAttr("disabled");
					//$("#firstComment").removeAttr("disabled");
					$("#firstScore").prop("disbled",true);
					$("#firstComment").prop("disbled",true);
				}
				if (data.enableFinal == 1) {
					$("#finalScore").removeAttr("disabled");
					$("#finalComment").removeAttr("disabled");
				} else { 
					//$("#finalScore").removeAttr("disabled");
					//$("#finalComment").removeAttr("disabled");
					$("#firstScore").prop("disbled",true);
					$("#firstComment").prop("disbled",true);
				}
			}
		}
	});
}
function saveKfiWeight() { 
	var kfiWeightId = $("#kfiWeightId").val();
	var firstScore = $("#firstScore").val();
	var finalScore = $("#finalScore").val();
	var firstComment=$("#firstComment").val();
	var finalComment = $("#finalComment").val();
	var evaluateeResult= $("#kfi-result-"+kfiWeightId).val();
	var url = $url + 'evaluation/eva/save-evaluator-point';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { firstScore: firstScore,finalScore:finalScore,firstComment:firstComment,finalComment:finalComment,kfiWeightId: kfiWeightId,evaluateeResult:evaluateeResult },
		success: function (data) {
			if (data.status) {
				$("#everage-score-" + kfiWeightId).html(data.point);
				$("#evaluator-score").modal('toggle');
			}
		}
	});

}
function saveKfiResult(kfiWeightId) {
	var score = $("#kfi-result-" + kfiWeightId).val();
	var midComment=$("#kfi-mid-comment-"+kfiWeightId).val();
	var primaryComment = $("#kfi-primary-comment-" + kfiWeightId).val();
	var url = $url + 'evaluation/eva/save-kfi-evaluatee-point';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { score: score, midComment: midComment, primaryComment: primaryComment, kfiWeightId: kfiWeightId},
		success: function (data) {
			if (data.status) {
				$("#everage-score-" + kfiWeightId).html(data.point);
				$('.alert-box2').slideDown(500);
				setTimeout(function () {
					$('.alert-box2').fadeOut(300);
				}, 3000);
			}
		}
	});
}
function prepareKgiEmployeeEvaluate(kgiId, kgiEmployeeWeigthId) {
	var url = $url + 'evaluation/eva/prepare-kgi-employee';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kgiId: kgiId, kgiEmployeeWeigthId: kgiEmployeeWeigthId },
		success: function (data) {
			if (data.status) { 
				$("#kgiEmployeeWeihtName").html(data.kgiName);
				$("#kgiEmployeeWeightId").val(kgiEmployeeWeigthId);
				$("#firstScoreKgiEmployee").val(data.firstScore);
				$("#firstCommentKgiEmployee").html(data.firstComment);
				$("#finalScoreKgiEmployee").val(data.finalScore);
				$("#finalCommentKgiEmployee").html(data.finalComment);
				alert(data.enableFirst);
				if (data.enableFirst == 1) {
					$("#firstScoreKgiEmployee").removeAttr("disabled");
					$("#firstCommentKgiEmployee").removeAttr("disabled");
				} else { 
					//$("#firstScoreKgiEmployee").removeAttr("disabled");
					//$("#firstCommentKgiEmployee").removeAttr("disabled");
					$("#firstScoreKgiEmployee").prop("disbled",true);
					$("#firstCommentKgiEmployee").prop("disbled",true);
				}
				if (data.enableFinal == 1) {
					$("#finalScoreKgiEmployee").removeAttr("disabled");
					$("#finalCommentKgiEmployee").removeAttr("disabled");
				} else { 
					//$("#finalScoreKgiEmployee").removeAttr("disabled");
					//$("#finalCommentKgiEmployee").removeAttr("disabled");
					$("#firstScoreKgiEmployee").prop("disbled",true);
					$("#firstCommentKgiEmployee").prop("disbled",true);
				}
			}
		}
	});
}
function saveKgiEmployeeWeight() { 
	var kgiEmployeeWeightId = $("#kgiEmployeeWeightId").val();
	var firstScore = $("#firstScoreKgiEmployee").val();
	var finalScore = $("#finalScoreKgiEmployee").val();
	var firstComment=$("#firstCommentKgiEmployee").val();
	var finalComment = $("#finalCommentKgiEmployee").val();
	var evaluateeResult= $("#kgi-employee-result-"+kgiEmployeeWeightId).val();
	var url = $url + 'evaluation/eva/save-kgi-employee-evaluator-point';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { firstScore: firstScore,finalScore:finalScore,firstComment:firstComment,finalComment:finalComment,kgiEmployeeWeightId: kgiEmployeeWeightId,evaluateeResult:evaluateeResult },
		success: function (data) {
			if (data.status) {
				$("#kgi-employee-everage-score-" + kgiEmployeeWeightId).html(data.point);
				$("#kgi-employee-evaluator-score").modal('toggle');
			}
		}
	});
}
function saveKgiEmployeeResult(kgiEmployeeWeightId) { 
	var score = $("#kgi-employee-result-" + kgiEmployeeWeightId).val();
	var midComment=$("#kgi-employee-mid-comment-"+kgiEmployeeWeightId).val();
	var primaryComment = $("#kgi-employee-primary-comment-" + kgiEmployeeWeightId).val();
	var url = $url + 'evaluation/eva/save-kgi-employee-evaluatee-point';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { score: score, midComment: midComment, primaryComment: primaryComment, kgiEmployeeWeightId: kgiEmployeeWeightId},
		success: function (data) {
			if (data.status) {
				$("#kgi-employee-everage-score-" + kgiEmployeeWeightId).html(data.point);
				$('.alert-box2').slideDown(500);
				setTimeout(function () {
					$('.alert-box2').fadeOut(300);
				}, 3000);
			}
		}
	});
}
function prepareKgiTeamEvaluate(kgiId, kgiTeamWeigthId) {
	var url = $url + 'evaluation/eva/prepare-kgi-team';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kgiId: kgiId, kgiTeamWeigthId: kgiTeamWeigthId },
		success: function (data) {
			if (data.status) { 
				$("#kgiTeamWeihtName").html(data.kgiName);
				$("#kgiTeamWeightId").val(kgiTeamWeigthId);
				$("#firstScoreKgiTeam").val(data.firstScore);
				$("#firstCommentKgiTeam").html(data.firstComment);
				$("#finalScoreKgiTeam").val(data.finalScore);
				$("#finalCommentKgiTeam").html(data.finalComment);
				if (data.enableFirst == 1) {
					$("#firstScoreKgiTeam").removeAttr("disabled");
					$("#firstCommentKgiTeam").removeAttr("disabled");
				} else { 
					//$("#firstScoreKgiTeam").removeAttr("disabled");
					//$("#firstCommentKgiTeam").removeAttr("disabled");
					$("#firstScoreKgiTeam").prop("disbled",true);
					$("#firstCommentKgiTeam").prop("disbled",true);
				}
				if (data.enableFinal == 1) {
					$("#finalScoreKgiTeam").removeAttr("disabled");
					$("#finalCommentKgiTeam").removeAttr("disabled");
				} else { 
					//$("#finalScoreKgiTeam").removeAttr("disabled");
					//$("#finalCommentKgiTeam").removeAttr("disabled");
					$("#firstScoreKgiTeam").prop("disbled",true);
					$("#firstCommentKgiTeam").prop("disbled",true);
				}
			}
		}
	});
}
function saveKgiTeamWeight() { 
	var kgiTeamWeightId = $("#kgiTeamWeightId").val();
	var firstScore = $("#firstScoreKgiTeam").val();
	var finalScore = $("#finalScoreKgiTeam").val();
	var firstComment=$("#firstCommentKgiTeam").val();
	var finalComment = $("#finalCommentKgiTeam").val();
	var evaluateeResult= $("#kgi-team-result-"+kgiTeamWeightId).val();
	var url = $url + 'evaluation/eva/save-kgi-team-evaluator-point';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { firstScore: firstScore,finalScore:finalScore,firstComment:firstComment,finalComment:finalComment,kgiTeamWeightId: kgiTeamWeightId,evaluateeResult:evaluateeResult },
		success: function (data) {
			if (data.status) {
				$("#kgi-team-everage-score-" + kgiTeamWeightId).html(data.point);
				$("#kgi-team-evaluator-score").modal('toggle');
			}
		}
	});
}
function saveKgiTeamResult(kgiTeamWeightId) { 
	var score = $("#kgi-team-result-" + kgiTeamWeightId).val();
	var midComment=$("#kgi-team-mid-comment-"+kgiTeamWeightId).val();
	var primaryComment = $("#kgi-team-primary-comment-" + kgiTeamWeightId).val();
	var url = $url + 'evaluation/eva/save-kgi-team-evaluatee-point';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { score: score, midComment: midComment, primaryComment: primaryComment, kgiTeamWeightId: kgiTeamWeightId},
		success: function (data) {
			if (data.status) {
				$("#kgi-team-everage-score-" + kgiTeamWeightId).html(data.point);
				$('.alert-box2').slideDown(500);
				setTimeout(function () {
					$('.alert-box2').fadeOut(300);
				}, 3000);
			}
		}
	});
}
function prepareKpiTeamEvaluate(kpiId, kpiTeamWeigthId) {
	var url = $url + 'evaluation/eva/prepare-kpi-team';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kpiId: kpiId, kpiTeamWeigthId: kpiTeamWeigthId },
		success: function (data) {
			if (data.status) { 
				$("#kpiTeamWeihtName").html(data.kpiName);
				$("#kpiTeamWeightId").val(kpiTeamWeigthId);
				$("#firstScoreKpiTeam").val(data.firstScore);
				$("#firstCommentKpiTeam").html(data.firstComment);
				$("#finalScoreKpiTeam").val(data.finalScore);
				$("#finalCommentKpiTeam").html(data.finalComment);
				if (data.enableFirst == 1) {
					$("#firstScoreKpiTeam").removeAttr("disabled");
					$("#firstCommentKpiTeam").removeAttr("disabled");
				} else { 
					//$("#firstScoreKpiTeam").removeAttr("disabled");
					//$("#firstCommentKpiTeam").removeAttr("disabled");
					$("#firstScoreKpiTeam").prop("disbled",true);
					$("#firstCommentKpiTeam").prop("disbled",true);
				}
				if (data.enableFinal == 1) {
					$("#finalScoreKpiTeam").removeAttr("disabled");
					$("#finalCommentKpiTeam").removeAttr("disabled");
				} else { 
					//$("#finalScoreKpiTeam").removeAttr("disabled");
					//$("#finalCommentKpiTeam").removeAttr("disabled");
					$("#firstScoreKpiTeam").prop("disbled",true);
					$("#firstCommentKpiTeam").prop("disbled",true);
				}
			}
		}
	});
}
function saveKpiTeamWeight() { 
	var kpiTeamWeightId = $("#kpiTeamWeightId").val();
	var firstScore = $("#firstScoreKpiTeam").val();
	var finalScore = $("#finalScoreKpiTeam").val();
	var firstComment=$("#firstCommentKpiTeam").val();
	var finalComment = $("#finalCommentKpiTeam").val();
	var evaluateeResult= $("#kpi-team-result-"+kpiTeamWeightId).val();
	var url = $url + 'evaluation/eva/save-kpi-team-evaluator-point';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { firstScore: firstScore,finalScore:finalScore,firstComment:firstComment,finalComment:finalComment,kpiTeamWeightId: kpiTeamWeightId,evaluateeResult:evaluateeResult },
		success: function (data) {
			if (data.status) {
				$("#kpi-team-everage-score-" + kpiTeamWeightId).html(data.point);
				$("#kpi-team-evaluator-score").modal('toggle');
			}
		}
	});
}
function saveKpiTeamResult(kpiTeamWeightId) { 
	var score = $("#kpi-team-result-" + kpiTeamWeightId).val();
	var midComment=$("#kpi-team-mid-comment-"+kpiTeamWeightId).val();
	var primaryComment = $("#kpi-team-primary-comment-" + kpiTeamWeightId).val();
	var url = $url + 'evaluation/eva/save-kpi-team-evaluatee-point';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { score: score, midComment: midComment, primaryComment: primaryComment, kpiTeamWeightId: kpiTeamWeightId},
		success: function (data) {
			if (data.status) {
				$("#kpi-team-everage-score-" + kpiTeamWeightId).html(data.point);
				$('.alert-box2').slideDown(500);
				setTimeout(function () {
					$('.alert-box2').fadeOut(300);
				}, 3000);
			}
		}
	});
}
function prepareKpiEmployeeEvaluate(kpiId, kpiEmployeeWeigthId) {
	var url = $url + 'evaluation/eva/prepare-kpi-employee';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kpiId: kpiId, kpiEmployeeWeigthId: kpiEmployeeWeigthId },
		success: function (data) {
			if (data.status) { 
				$("#kpiEmployeeWeihtName").html(data.kpiName);
				$("#kpiEmployeeWeightId").val(kpiEmployeeWeigthId);
				$("#firstScoreKpiEmployee").val(data.firstScore);
				$("#firstCommentKpiEmployee").html(data.firstComment);
				$("#finalScoreKpiEmployee").val(data.finalScore);
				$("#finalCommentKpiEmployee").html(data.finalComment);
				if (data.enableFirst == 1) {
					$("#firstScoreKpiEmployee").removeAttr("disabled");
					$("#firstCommentKpiEmployee").removeAttr("disabled");
				} else { 
					//$("#firstScoreKpiEmployee").removeAttr("disabled");
					//$("#firstCommentKpiEmployee").removeAttr("disabled");
					$("#firstScoreKpiEmployee").prop("disbled",true);
					$("#firstCommentKpiEmployee").prop("disbled",true);
				}
				if (data.enableFinal == 1) {
					$("#finalScoreKpiEmployee").removeAttr("disabled");
					$("#finalCommentKpiEmployee").removeAttr("disabled");
				} else { 
					//$("#finalScoreKpiEmployee").removeAttr("disabled");
					//$("#finalCommentKpiEmployee").removeAttr("disabled");
					$("#firstScoreKpiEmployee").prop("disbled",true);
					$("#firstCommentKpiEmployee").prop("disbled",true);
				}
			}
		}
	});
}
function saveKpiEmployeeWeight() { 
	var kpiEmployeeWeightId = $("#kpiEmployeeWeightId").val();
	var firstScore = $("#firstScoreKpiEmployee").val();
	var finalScore = $("#finalScoreKpiEmployee").val();
	var firstComment=$("#firstCommentKpiEmployee").val();
	var finalComment = $("#finalCommentKpiEmployee").val();
	var evaluateeResult= $("#kpi-employee-result-"+kpiEmployeeWeightId).val();
	var url = $url + 'evaluation/eva/save-kpi-employee-evaluator-point';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { firstScore: firstScore,finalScore:finalScore,firstComment:firstComment,finalComment:finalComment,kpiEmployeeWeightId: kpiEmployeeWeightId,evaluateeResult:evaluateeResult },
		success: function (data) {
			if (data.status) {
				$("#kpi-employee-everage-score-" + kpiEmployeeWeightId).html(data.point);
				$("#kpi-employee-evaluator-score").modal('toggle');
			}
		}
	});
}
function saveKpiEmployeeResult(kpiEmployeeWeightId) { 
	var score = $("#kpi-employee-result-" + kpiEmployeeWeightId).val();
	var midComment=$("#kpi-employee-mid-comment-"+kpiEmployeeWeightId).val();
	var primaryComment = $("#kpi-employee-primary-comment-" + kpiEmployeeWeightId).val();
	var url = $url + 'evaluation/eva/save-kpi-employee-evaluatee-point';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { score: score, midComment: midComment, primaryComment: primaryComment, kpiEmployeeWeightId: kpiEmployeeWeightId},
		success: function (data) {
			if (data.status) {
				$("#kpi-employee-everage-score-" + kpiEmployeeWeightId).html(data.point);
				$('.alert-box2').slideDown(500);
				setTimeout(function () {
					$('.alert-box2').fadeOut(300);
				}, 3000);
			}
		}
	});
}