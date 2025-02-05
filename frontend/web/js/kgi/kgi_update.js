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
	var kgiId = $("#kgiId").val();
	var url = $url + 'kgi/management/company-multi-branch';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { companyId: companyId, acType: acType, kgiId: kgiId },
		success: function (data) {
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
	if (multiBranch.length > 0) {
		let imageSrc = $url + "image/branches.svg"; // กำหนดแหล่งที่มาของภาพ
		let blackimageSrc = $url + "image/branches-black.svg"; // กำหนดแหล่งที่มาของภาพ

		// เปลี่ยนค่าใน <div> ที่มี id="selected-count" เฉพาะใน #image-branches
		$("#image-branches #branch-selected-count").removeClass("cycle-current-gray").addClass("cycle-current-white");
		$("#image-branches #branch-selected-message").html(``);

		if (multiBranch.length == 1) {
			$("#image-branches .cycle-current").slice(0, 3)
				.removeClass("cycle-current")
				.addClass("cycle-current-gray")
				.find("img")
				.attr("src", blackimageSrc);
			// เปลี่ยน class ของ cycle-current-gray เป็น cycle-current สำหรับ 1 div แรก ใน #kfi-branches
			$("#image-branches .cycle-current-gray").slice(0, 1).removeClass("cycle-current-gray").addClass("cycle-current");
			// เปลี่ยนแหล่งที่มาของภาพสำหรับ 1 รูปแรก
			$("#image-branches .cycle-current").slice(0, 1).find("img").attr("src", imageSrc);
		}
		if (multiBranch.length == 2) {
			$("#image-branches .cycle-current").slice(0, 3)
				.removeClass("cycle-current")
				.addClass("cycle-current-gray")
				.find("img")
				.attr("src", blackimageSrc);
			// เปลี่ยน class ของ cycle-current-gray เป็น cycle-current สำหรับ 2 div แรก ใน #image-branches
			$("#image-branches .cycle-current-gray").slice(0, 2).removeClass("cycle-current-gray").addClass("cycle-current");
			// เปลี่ยนแหล่งที่มาของภาพสำหรับ 2 รูปแรก
			$("#image-branches .cycle-current").slice(0, 2).find("img").attr("src", imageSrc);
		}
		if (multiBranch.length >= 3) {
			// เปลี่ยน class ของ cycle-current-gray เป็น cycle-current สำหรับ 3 div แรก ใน #image-branches
			$("#image-branches .cycle-current-gray").slice(0, 3).removeClass("cycle-current-gray").addClass("cycle-current");
			// เปลี่ยนแหล่งที่มาของภาพสำหรับ 3 รูปแรก
			$("#image-branches .cycle-current").slice(0, 3).find("img").attr("src", imageSrc);
		}

		// แสดงจำนวนที่เลือกใน #multi-branch-text
		$("#multi-branch-text").html(multiBranch.length + ` Branches Selected`);
		
		// เปลี่ยน style ของ #multi-branch-text
		$("#multi-branch-text").css({
			"color": "var(--HRVC---Text-Black, #30313D)",
			"font-family": '"SF Pro Display"',
			"font-size": "14px",
			"font-style": "normal",
			"font-weight": "500",
			"line-height": "20px"
		});
	} else { 
		$("#image-branches #branch-selected-count").removeClass("cycle-current-white").addClass("cycle-current-gray");
		$("#image-branches #branch-selected-message").html("No Branches are Selected Yet");

		// เปลี่ยนแหล่งที่มาของภาพกลับเป็น default เฉพาะใน #image-branches
		$("#image-branches .cycle-current img").attr("src", $url + "image/branches-black.svg");

		// เปลี่ยน class ของ cycle-current เป็น cycle-current-gray สำหรับ 3 div แรก ใน #image-branches
		$("#image-branches .cycle-current").slice(0, 3).removeClass("cycle-current").addClass("cycle-current-gray");

		// ถ้าไม่ได้เลือกบริษัทใดๆ ให้แสดงข้อความ "Select Branches"
		$("#multi-branch-text").html(`Selected Branches`);

		// คืนค่าการตั้งสไตล์กลับเป็นค่าเดิม
		$("#multi-branch-text").css({
			"color": "var(--Helper-Text-Gray, #8A8A8A)",
			"font-family": '"SF Pro Display", sans-serif',
			"font-size": "14px",
			"font-weight": "400",
			"line-height": "20px",
			"text-transform": "capitalize"
		});
	}
	$("#branch-selected-count").html(multiBranch.length);
	var url = $url + 'kgi/management/branch-multi-department';
	var acType = $("#acType").val();
	var kgiId = $("#kgiId").val();
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { multiBranch: multiBranch, acType: acType, kgiId: kgiId },
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
	totalBranch = data.length;
	return totalBranch;
}
function allDepartmentUpdate(branchId) {
	var sumDepartment = totalDepartmentUpdate(branchId);
	if ($("#multi-check-all-" + branchId + "-update").prop("checked") == true) {
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
	$("#multi-check-" + branchId + "-update:checked").each(function () {
		multiDepartmentBranch[i] = $(this).val();
		i++;
	});
	var i = 0;
	$("#multi-check-update:checked").each(function () {
		multiBranch[i] = $(this).val();
		i++;
	});
	var i = 0;
	$(".multi-check-department-update:checked").each(function () {
		multiDepartment[i] = $(this).val();
		i++;
	});
	if (sumDepartment != multiDepartmentBranch.length) {
		$("#multi-check-all-" + branchId + "-update").prop("checked", false);
	} else {
		$("#multi-check-all-" + branchId + "-update").prop("checked", true);
	}
	if (multiDepartment.length > 0) {
		let deptImageSrc = $url + "image/departments.svg"; // แหล่งที่มาของภาพสำหรับ departments
		let deptblackImageSrc = $url + "image/departments-black.svg"; // แหล่งที่มาของภาพสำหรับ departments

		// เปลี่ยน class และข้อความสำหรับ #image-departments
		$("#image-departments #department-selected-count")
			.removeClass("cycle-current-gray")
			.addClass("cycle-current-white");
		$("#image-departments #department-selected-message").html("");

		if (multiDepartment.length == 1) {
			$("#image-departments .cycle-current").slice(0, 3)
				.removeClass("cycle-current")
				.addClass("cycle-current-gray")
				.find("img")
				.attr("src", deptblackImageSrc);
			$("#image-departments .cycle-current-gray").slice(0, 1)
				.removeClass("cycle-current-gray")
				.addClass("cycle-current")
				.find("img")
				.attr("src", deptImageSrc);
		}
		if (multiDepartment.length == 2) {
			$("#image-departments .cycle-current").slice(0, 3)
				.removeClass("cycle-current")
				.addClass("cycle-current-gray")
				.find("img")
				.attr("src", deptblackImageSrc);
			$("#image-departments .cycle-current-gray").slice(0, 2)
				.removeClass("cycle-current-gray")
				.addClass("cycle-current")
				.find("img")
				.attr("src", deptImageSrc);
		}
		if (multiDepartment.length >= 3) {
			$("#image-departments .cycle-current-gray").slice(0, 3)
				.removeClass("cycle-current-gray")
				.addClass("cycle-current")
				.find("img")
				.attr("src", deptImageSrc);
		}


		// แสดงจำนวนที่เลือกใน #multi-department-text
		$("#multi-department-text").html(multiDepartment.length + ` Departments Selected`);

		// เปลี่ยน style ของ #multi-branch-text
		$("#multi-department-text").css({
			"color": "var(--HRVC---Text-Black, #30313D)",
			"font-family": '"SF Pro Display"',
			"font-size": "14px",
			"font-style": "normal",
			"font-weight": "500",
			"line-height": "20px"
		});
	} else { 
		$('input[id="multi-check"]').each(function () {
			$(".multiCheck-" + $(this).val()).prop('required', true);
		});

		// เปลี่ยน class และข้อความเมื่อไม่มี departments ที่เลือก
		$("#image-departments #department-selected-count")
			.removeClass("cycle-current-white")
			.addClass("cycle-current-gray");
		$("#image-departments #department-selected-message").html("No Departments are Selected Yet");

		// เปลี่ยนภาพกลับเป็น default
		$("#image-departments .cycle-current img").attr("src", $url + "image/departments-black.svg");
		$("#image-departments .cycle-current").slice(0, 3)
			.removeClass("cycle-current")
			.addClass("cycle-current-gray");


		// ถ้าไม่ได้เลือกบริษัทใดๆ ให้แสดงข้อความ "Select Department"
		$("#multi-department-text").html("Select Department");

		// คืนค่าการตั้งสไตล์กลับเป็นค่าเดิม
		$("#multi-department-text").html("Selected Departments").css({
			"color": "var(--Helper-Text-Gray, #8A8A8A)",
			"font-family": '"SF Pro Display", sans-serif',
			"font-size": "14px",
			"font-weight": "400",
			"line-height": "20px",
			"text-transform": "capitalize"
		});
	}
	$("#department-selected-count").html(multiDepartment.length);
	var acType = $("#acType").val();
	var kgiId = $("#kgiId").val();
	var url = $url + 'kgi/management/department-multi-team';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { multiDepartment: multiDepartment, multiBranch: multiBranch, acType: acType, kgiId: kgiId },
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

function updateKgi(kgiId, kgiHistoryId) {
	$("#acType").val('update');
	$("#kgiId").val(kgiId);
	resetUnit();
	var url = $url + 'kgi/management/prepare-update';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kgiId: kgiId, kgiHistoryId: kgiHistoryId },
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
			$("#targetAmount-update").val(data.targetAmountText);
			$("#detail-update").val(data.detail);
			$("#quantRatio-update").val(data.quantRatio);
			$("#priority-update").val(data.priority);
			$("#amountType-update").val(data.amountType);
			$("#code-update").val(data.code);
			$("#status-update").val(data.status);
			$("#month-update").val(data.month);
			$("#year-update").val(data.year);
			$("#result-update").val(data.resultText);
			$("#show-multi-branch-update").html(data.textBranch);
			$("#show-multi-department-update").html(data.textDepartment);
			$("#show-multi-team-update").html(data.textTeam);
			// $("#kgi-group-update").html(data.textGroup);
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
			$("#multi-check-" + multiBranch[a] + "-update:checked").each(function () {
				multiDepartment[b] = $(this).val();
				b++;
			});
			checkedDepartment = multiDepartment.length;
			if (checkedDepartment == 0) {

				var branchDepartment = checkBranchDepartment(multiBranch[a]);
				if (branchDepartment > 0) {
					isError++;
					alert("Please select at least 1 department for each selected branch.");
					return false;
				}
			} else {
				for (c = 0; c < multiDepartment.length; c++) {
					var multiTeam = [];
					var d = 0;
					$("#multi-check-team" + multiDepartment[d] + "-update:checked").each(function () {
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
	$('#update-kgi').find('input,select,textarea').each(function () {
		if (!$(this).prop('required')) {

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
function multiTeamUpdateCheckUpdate() { 

}
function checkBranchDepartment(branchId) {
	var url = $url + 'setting/department/branch-department';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { branchId: branchId },
		success: function (data) {
			return data.totalDepartments
		}
	});
}
function autoUpdateResult(kgiId) {
	if ($("#historic-checkbox-kgi").prop("checked") == true) {
		//if (confirm('Are you sure to use the summarize data from Team KGI?')) {
			$("#override-checkbox-kgi").prop("checked", false);
			
			var url = $url + 'kgi/management/auto-result';
			$.ajax({
				type: "POST",
				dataType: 'json',
				url: url,
				data: { kgiId: kgiId },
				success: function (data) {
					$("#result-update").val(data.result);
					$("#auto-result").val(data.result);
				}
			});
			$("#result-update").prop("disabled", true);
		//} else {
			//$("#override-checkbox-kgi").prop("checked", true);
			//$("#historic-checkbox-kgi").prop("checked", false);
			//$("#result-update").prop("disabled", false);
		//}
		//cal
	} else { 
		$("#override-checkbox-kgi").prop("checked", true);
		$("#result-update").val($("#previous-result").val());
		$("#result-update").prop("disabled", false);
	}
}
function overrideUpdate() { 
	if ($("#override-checkbox-kgi").prop("checked") == true) {
		$("#historic-checkbox-kgi").prop("checked", false);
		$("#result-update").prop("disabled", false);
		$("#result-update").val($("#previous-result").val());
	} else { 
		$("#historic-checkbox-kgi").prop("checked", true).trigger('change');
	}
}

