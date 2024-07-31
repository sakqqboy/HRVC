var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
function checkRankIncreasement() { 
	var rankName = $("#rank-name").val();
	var min = $("#min").val();
	var max = $("#max").val();
	var increment = $("#increment").val();
	var bonus = $("#max").val();
	var termId = $("#termId").val();
	if (rankName.trim() == "" || min.trim() == "" || max.trim() == "" || increment.trim() == "" || bonus.trim() == "") {
		alert("Plese fill out data completely ! ! !");
		$("#rank-name").val(null);
		$("#min").val(null);
		$("#max").val(null);
		$("#increment").val(null);
		$("#max").val(null);
	} else {
		if (parseInt(min) >= parseInt(max)) {
			alert("Maximum score must be greater than Minimum");
		} else {
			var url = $url + 'evaluation/rank/rank-name';
			$.ajax({
				type: "POST",
				dataType: 'json',
				url: url,
				data: { rankName: rankName, termId: termId, min: min, max: max },
				success: function (data) {
					if (data.status) {
						$("#create-rank").submit();
					} else {
						alert(data.text);
					}
				}
			});
		}
	}
}
function deleteTermRank(rankId) { 
	if (confirm('Are you sure to delete this rank?')) { 
		var url = $url + 'evaluation/rank/delete-rank';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { rankId: rankId},
			success: function (data) {
				if (data.status) {
					$("#rank-" + rankId).hide();
				}
			}
		});
	}
}

function saveBonusTerm(termId) { 
	var totalBudget = $("#totalBudget").val();
	var totalBonus = $("#totalBonus").val();
	var payableBonus = $("#payableBonus").val();
	if (totalBudget != "") {
		var url = $url + 'evaluation/bonus/save-bonus-budget';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { termId: termId, totalBudget: totalBudget, totalBonus: totalBonus, payableBonus: payableBonus },
			success: function (data) {
				if (data.status) {
					//$("#rank-" + rankId).hide();
					$("#totalBudget").val(data.budget);
					$("#total-bonus").html(totalBonus);
					$("#adjustment-bonus").html(data.adjustment);
				}
			}
		});
	} else { 
		alert("The Total Budget can not be null ! ! !");
	}
}
function changeFinalAdjustment(employeeId) { 
	var employeeSalary = $("#employee-salary-" + employeeId).val();
	if ($.isNumeric(employeeSalary)) {
		$("#final-adjustment-" + employeeId).show();
		$("#text-final-adjustment-" + employeeId).hide();
	} else { 
		alert("Please set the employee salary");
	}
}
function saveFinancialAdjustment(employeeId, termId) { 
	var adjustmentValue = $("#final-adjustment-" + employeeId).val();
	var employeeSalary = $("#employee-salary-" + employeeId).val();
	var url = $url + 'evaluation/bonus/save-final-adjustment';
	if ($.isNumeric(employeeSalary)) {
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { employeeId: employeeId, termId: termId, adjustmentValue: adjustmentValue },
			success: function (data) {
				if (data.status) {
					$("#final-adjustment-" + employeeId).hide();
					$("#text-final-adjustment-" + employeeId).html(data.adjustValue);
					$("#text-final-adjustment-" + employeeId).show();
					$("#payable-bonus-" + employeeId).html(data.adjustValue);
					$("#true-bonus-rate-" + employeeId).html(data.trueBonusRate+' X');
				}
			}
		});
	} else { 
			alert("Please set the employee salary");
		}
}