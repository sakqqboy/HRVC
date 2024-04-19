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