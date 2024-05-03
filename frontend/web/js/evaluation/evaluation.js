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
		//alert($(this).val());
		if ($("#kfi-check-" + $(this).val()).prop("checked") == true) {
			//alert(12222);
			sum += parseInt(weight);
		}
		if (sum <= 100) {
			$("#total-weight").html(sum);
			$("#sumPercent").val(sum);
		} else {
			if (type == 1) {
				$("#weight-kfi-" + kfiId).val(0);
			} else { 
				$("#kfi-check-" + $(this).val()).prop("checked",false);
			}
			alert('Total can not over 100%');
			return false;
		}
	});

}
function calculateKgiPercent(kgiId,type) { 
	var sum = 0;
	$('input[name="kgiIds[]"]').each(function () {
		var weight = $("#weight-kgi-" + $(this).val()).val();
		if ($("#kgi-check-" + $(this).val()).prop("checked") == true) {
			sum += parseInt(weight);
		}
		if (sum <= 100) {
			$("#total-weight").html(sum);
			$("#sumPercent").val(sum);
		} else {
			if (type == 1) {
				$("#weight-kgi-" + kgiId).val(0);
			} else { 
				$("#kgi-check-" + $(this).val()).prop("checked",false);
			}
			alert('Total can not over 100%');
			return false;
		}
	});
}
function calculateKpiPercent(kpiId,type) { 
	var sum = 0;
	$('input[name="kpiIds[]"]').each(function () {
		var weight = $("#weight-kpi-" + $(this).val()).val();
		if ($("#kpi-check-" + $(this).val()).prop("checked") == true) {
			sum += parseInt(weight);
		}
		if (sum <= 100) {
			$("#total-weight").html(sum);
			$("#sumPercent").val(sum);
		} else {
			if (type == 1) {
				$("#weight-kpi-" + kpiId).val(0);
			} else { 
				$("#kpi-check-" + $(this).val()).prop("checked",false);
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
	if (sumPercent == 100) {
		$("#save-kgi-weight").submit();
	} else { 
		alert("Total percent must be equal to 100");
	}
}
function checkKpiPercent() { 
	var sumPercent = $("#sumPercent").val();
	if (sumPercent == 100) {
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
function saveWeightAllocate() { 
	var type = $("#type").val();
	var pimWeightId = $("#pimWeightId").val();
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
			$("#kgi-d-weight").html($("#weight").val());
		}
		if (type == "KFI") { 
			$("#kfiWeight").val($("#weight").val());
			$("#kfi-d-weight").html($("#weight").val());
		}
		if (type == "KPI") { 
			$("#kpiWeight").val($("#weight").val());
			$("#kpi-d-weight").html($("#weight").val());
		}
		var url = $url + 'evaluation/environment/save-pim-allocate';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { type: type, pimWeightId: pimWeightId, weight: weight},
			success: function (data) {
				if (data.status) {
					$('.alert-box2').slideDown(500);
					setTimeout(function () {
						$('.alert-box2').fadeOut(300);
					}, 3000);
					$('#set_pim_weight').modal('hide');
					$("#totalPercent").html(totalPercent);
					$("#data-total-percent").removeAttr('data-num');
					$("#data-total-percent").attr("data-num", totalPercent);
					$("#data-total-percent").removeAttr('data-value');
					$("#data-total-percent").attr("data-value", totalPercent+'%');
				}
			}
		});
	}
	
}