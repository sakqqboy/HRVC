var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
	$baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
	$baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;

function companyMultiBrachUpdateKPI() {
	var companyId = $("#companyId-update").val();
	clearEveryShow();

	var acType = $("#acType").val();
	var kpiId = $("#kpiId").val();
	var url = $url + 'kpi/management/company-multi-branch';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { companyId: companyId, acType: acType, kpiId: kpiId },
		success: function (data) {
			// alert('1.1');
			if (data.status) {
				$("#show-multi-branch-update").html(data.branchText);
			}

		}
	});
}
function autoUpdateResultKpi(kpiId) {
	if ($("#historic-checkbox-kpi").prop("checked") == true) {
		//if (confirm('Are you sure to use the summarize data from Team KPI?')) {
		$("#override-checkbox-kpi").prop("checked", false);
		var url = $url + 'kpi/management/auto-result';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kpiId: kpiId },
			success: function (data) {
				// alert(data.result);
				$("#resultKPI-update").val(data.result);
				$("#autoKPI-result").val(data.result);
			}
		});
		// alert("1");
		$("#resultKPI-update").prop("disabled", true);
		//} else {
		//$("#override-checkbox-kgi").prop("checked", true);
		//$("#historic-checkbox-kgi").prop("checked", false);
		//$("#result-update").prop("disabled", false);
		//}
		//cal
	} else {
		$("#override-checkbox-kpi").prop("checked", true);
		$("#resultKPI-update").val($("#previous-result").val());
		$("#resultKPI-update").prop("disabled", false);
	}
}
function checkAllBranchUpdateKPI() {
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

function updateKpi(kpiId) {
	$("#acType").val('update');
	$("#kpiId").val(kpiId);
	// alert(kpiId);
	resetUnit();
	var url = $url + 'kpi/management/prepare-update';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kpiId: kpiId },
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
			$("#year-update").val(data.year);
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
			$("#multi-check-" + multiBranch[a] + "-update:checked").each(function () {
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
	$('#update-kpi').find('input,select,textarea').each(function () {
		if (!$(this).prop('required')) {

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
	$("#v-kpiId").val(kpiId);
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
			$("#modal-branch-flag").attr("src", $url + data.kpi.flag);
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
function openKpiTeamView(teamId, kpiId) {
	$("#team-progress").modal('show');
	var url = $url + 'kpi/kpi-team/team-progress';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { teamId: teamId, kpiId: kpiId },
		success: function (data) {
			$("#kpi-name").html(data.kpiName);
			$("#team-name").html(data.teamName);
			$("#kpi-team-progress").html(data.history);

		}
	});
}
function openKpiEmployeeView(employeeId, kpiId) {
	$("#employee-progress").modal('show');
	var url = $url + 'kpi/kpi-personal/employee-progress';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { employeeId: employeeId, kpiId: kpiId },
		success: function (data) {
			$("#kpi-name-employee").html(data.kpiName);
			$("#employee-name").html(data.employeeName);
			$("#kpi-employee-progress").html(data.history);

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
		success: function (data) {
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
		success: function (data) {
			if (data.status) {
				$("#kpi-name-issue").html(data.kpi.kpiName);
				$("#pills-Issues").html(data.issueText);
				$("#pills-History").html(data.historyText);
				$("#company-issue").html(data.kpi.companyName);
				$("#branch-issue").html(data.kpi.branchName);
				$("#country-issue").html(data.kpi.countryName);
				$("#flag-issue").attr('src', $url + data.kpi.flag);
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
	//alert(answer);
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
				$("#lastest-issue-" + data.kpiId).html(data.issue);
				$("#lastest-solution-" + data.kpiId).html(data.solution);
				if (data.lastest != 0) {
					$("#kpi-solution-" + data.lastest).addClass('border-left-bottom-radius');
				}
				$("#fileName-" + kpiIssueId).html('');
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
	showLoading();
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { companyId: companyId, branchId: branchId, teamId: teamId, month: month, status: status, year: year, type: type },
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
	$("#multi-check-" + branchId + "-update:checked").each(function () {
		multiDepartmentBranch[i] = $(this).val();
		i++;
	});
	$("#multi-check-update:checked").each(function () {
		multiBranch[i] = $(this).val();
		i++;
	});
	// $(".multi-check-department-update:checked").each(function () {
	// 	multiDepartment[i] = $(this).val();
	// 	i++;
	// });
	if (sumDepartment != multiDepartmentBranch.length) {
		$("#multi-check-all-" + branchId + "-update").prop("checked", false);
	} else {
		$("#multi-check-all-" + branchId + "-update").prop("checked", true);
	}

	$(".multi-check-department-update:checked").each(function () {
		multiDepartment.push($(this).val());
		i++;
	});

	if (multiDepartment.length > 0) {
		$('input[id="multi-check' + branchId + '-update"]').each(function () {
			$(".multiCheck-" + $(this).val()).removeAttr('required');
		});

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

	// สำหรับ Departments
	var selectedDepartmentCount = multiDepartment.length;
	$("#department-selected-count").text(selectedDepartmentCount.toString());
	$("#department-selected-message").text(
		selectedDepartmentCount > 0
			? ``
			: "No Departments are Selected Yet"
	);

	var acType = $("#acType").val();
	var kpiId = $("#kpiId").val();
	var url = $url + 'kpi/management/department-multi-team';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { multiDepartment: multiDepartment, multiBranch: multiBranch, acType: acType, kpiId: kpiId },
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
	$("#img-branch-1").removeClass("cycle-current-branch").addClass("cycle-current-gray");
	$("#img-branch-2").removeClass("cycle-current-branch").addClass("cycle-current-gray");
	$("#img-branch-3").removeClass("cycle-current-branch").addClass("cycle-current-gray");
	if (multiBranch.length > 0) {
		$("#branch-selected-count").removeClass("cycle-current-gray").addClass("cycle-current-white").html(multiBranch.length);
		$("#branch-selected-message").html(``);
		if (multiBranch.length == 1) {
			$("#img-branch-1").removeClass("cycle-current-gray").addClass("cycle-current-branch");
		}
		if (multiBranch.length == 2) {
			$("#img-branch-1").removeClass("cycle-current-gray").addClass("cycle-current-branch");
			$("#img-branch-2").removeClass("cycle-current-gray").addClass("cycle-current-branch");
		}
		if (multiBranch.length >= 3) {
			$("#img-branch-1").removeClass("cycle-current-gray").addClass("cycle-current-branch");
			$("#img-branch-2").removeClass("cycle-current-gray").addClass("cycle-current-branch");
			$("#img-branch-3").removeClass("cycle-current-gray").addClass("cycle-current-branch");
		}
		$("#multi-branch-text").html(multiBranch.length + ` Branches Selected`);
		$("#multi-branch-text").css({
			"color": "var(--HRVC---Text-Black, #30313D)",
			"font-size": "14px",
			"font-style": "normal",
			"font-weight": "500",
			"line-height": "20px"
		});
	} else {
		$("#image-branches #branch-selected-count").removeClass("cycle-current-white").addClass("cycle-current-gray");
		$("#image-branches #branch-selected-message").html("No Branches are Selected Yet");
		$("#multi-branch-text").html(`Selected Branches`);

		$("#branch-selected-count").text("00");
		$("#tbranch-selected-count").removeClass("cycle-current-white").addClass("cycle-current-gray")

		// คืนค่าการตั้งสไตล์กลับเป็นค่าเดิม
		$("#multi-branch-text").css({
			"color": "var(--Helper-Text-Gray, #8A8A8A)",
			"font-size": "14px",
			"font-weight": "400",
			"line-height": "20px",
			"text-transform": "capitalize"
		});
	}
	var url = $url + 'kpi/management/branch-multi-department';
	var acType = $("#acType").val();
	var kpiId = $("#kpiId").val();
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { multiBranch: multiBranch, acType: acType, kpiId: kpiId },
		success: function (data) {
			if (data.status) {
				$("#show-multi-department-update").html(data.textDepartment);
				loadDepartmentKpi();
			} else {
				$("#show-multi-department-update").html('');
			}
		}
	});
}
function loadDepartmentKpi() {
	var totalDepartment = $("#totalDepartment").val();
	// alert(totalDepartment);
	let deptImageSrc = $url + "image/departments.svg"; // แหล่งที่มาของภาพสำหรับ departments
	if (parseInt(totalDepartment) > 0) {

		// เปลี่ยน class และข้อความสำหรับ #image-departments
		$("#department-selected-count").removeClass("cycle-current-gray").addClass("cycle-current-white");
		$("#department-selected-count").html(totalDepartment);

		if (totalDepartment == 1) {
			$("#img-department-1").find("img").attr("src", deptImageSrc);
			$("#img-department-1").removeClass("cycle-current-gray").addClass("cycle-current-department");
		}
		if (totalDepartment == 2) {
			$("#img-department-1").find("img").attr("src", deptImageSrc);
			$("#img-department-2").find("img").attr("src", deptImageSrc);
			$("#img-department-1").removeClass("cycle-current-gray").addClass("cycle-current-department");
			$("#img-department-2").removeClass("cycle-current-gray").addClass("cycle-current-department");
		}
		if (totalDepartment >= 3) {
			$("#img-department-1").find("img").attr("src", deptImageSrc);
			$("#img-department-2").find("img").attr("src", deptImageSrc);
			$("#img-department-3").find("img").attr("src", deptImageSrc);
			$("#img-department-1").removeClass("cycle-current-gray").addClass("cycle-current-department");
			$("#img-department-2").removeClass("cycle-current-gray").addClass("cycle-current-department");
			$("#img-department-3").removeClass("cycle-current-gray").addClass("cycle-current-department");
		}
		$("#multi-department-text").html(totalDepartment + ` Departments Selected`);
		$("#multi-department-text").css({
			"color": "var(--HRVC---Text-Black, #30313D)",
			"font-size": "14px",
			"font-style": "normal",
			"font-weight": "500",
			"line-height": "20px"
		});
	}
	var i = 0;
	var multiDepartment = [];
	var multiBranch = [];
	$(".multi-check-department-update:checked").each(function () {
		multiDepartment[i] = $(this).val();
		i++;
	});
	var i = 0;
	$("#multi-check-update:checked").each(function () {
		multiBranch[i] = $(this).val();
		i++;
	});
	var acType = $("#acType").val();
	var kpiId = $("#kpiId").val();
	var url = $url + 'kpi/management/department-multi-team';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { multiDepartment: multiDepartment, multiBranch: multiBranch, acType: acType, kpiId: kpiId },
		success: function (data) {
			if (data.status) {
				$("#show-multi-team-update").html(data.textTeam);
				loadTeamKpi();

			} else {
				$("#show-multi-team-update").html('');
			}
		}
	});
}
function loadTeamKpi() {
	var i = 0;
	var multiTeam = [];
	$(".multi-check-team-update:checked").each(function () {
		multiTeam[i] = $(this).val();
		i++;
	});
	let deptImageSrc = $url + "image/teams.svg"; // แหล่งที่มาของภาพสำหรับ teams
	let deptblackImageSrc = $url + "image/teams-black.svg"; // แหล่งที่มาของภาพสำหรับ teams
	$("#img-team-1").removeClass("cycle-current-team").addClass("cycle-current-gray").find("img").attr("src", deptblackImageSrc);
	$("#img-team-2").removeClass("cycle-current-team").addClass("cycle-current-gray").find("img").attr("src", deptblackImageSrc);
	$("#img-team-3").removeClass("cycle-current-team").addClass("cycle-current-gray").find("img").attr("src", deptblackImageSrc);
	if (multiTeam.length > 0) {
		$("#team-selected-count").removeClass("cycle-current-gray").addClass("cycle-current-white");
		$("#team-selected-count").html(multiTeam.length);
		if (multiTeam.length == 1) {
			$("#img-team-1").find("img").attr("src", deptImageSrc);
			$("#img-team-1").removeClass("cycle-current-gray").addClass("cycle-current-team");
		}
		if (multiTeam.length == 2) {
			$("#img-team-1").find("img").attr("src", deptImageSrc);
			$("#img-team-2").find("img").attr("src", deptImageSrc);
			$("#img-team-1").removeClass("cycle-current-gray").addClass("cycle-current-team");
			$("#img-team-2").removeClass("cycle-current-gray").addClass("cycle-current-team");
		}
		if (multiTeam.length >= 3) {
			$("#img-team-1").find("img").attr("src", deptImageSrc);
			$("#img-team-2").find("img").attr("src", deptImageSrc);
			$("#img-team-3").find("img").attr("src", deptImageSrc);
			$("#img-team-1").removeClass("cycle-current-gray").addClass("cycle-current-team");
			$("#img-team-2").removeClass("cycle-current-gray").addClass("cycle-current-team");
			$("#img-team-3").removeClass("cycle-current-gray").addClass("cycle-current-team");
		}
		$("#team-selected-count").text(multiTeam.length.toString());

		// ปรับสไตล์ข้อความ
		$("#multi-team-text").html(multiTeam.length + " Teams Selected").css({
			"color": "#30313D",
			"font-size": "14px",
			"font-weight": "500",
			"line-height": "20px"
		});

	}
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
function copyKpi(kpiId) {
	if (confirm('Do you want to make a copy?')) {
		var url = $url + 'kpi/management/copy-kpi?kpiId=' + kpiId;
		window.location.href = url;
	}
}
function kpiCompanyBranch(companyId, kpiId) {
	var url = $url + 'kpi/management/kpi-branch';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { companyId: companyId, kpiId: kpiId },
		success: function (data) {
			$("#kpi-branch").html(data.textBranch);
			$("#kpiName").html(data.kpiName);
			$("#companyName").html(data.companyName);
		}
	});
}
function assignKpiBranch(kpiId, branchId) {
	var checked = 0;
	if ($("#assign-branch-kpi-" + kpiId + '-' + branchId).prop("checked") == true) {
		checked = 1;
	}
	var url = $url + 'kpi/management/kpi-assign-branch';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { branchId: branchId, kpiId: kpiId, checked, checked },
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
		data: { kpiId: kpiId },
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
		data: { kpiId: kpiId, employeeId: employeeId, checked: checked },
		success: function (data) {
			if (data.status) {
				$("#totalEmployee-" + kpiId).html(data.totalEmployee);
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
		data: { kpiId: kpiId, searchText: searchText, departmentId: departmentId, teamId: teamId },
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
	var year = $("#kpiYearFilter").val();
	var url = $url + 'kpi/management/search-assign-kpi';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { month: month, year: year },
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
function approveTargetKpiEmployee(kpiEmployeeHistoryId, approve) {
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
			data: { kpiEmployeeHistoryId: kpiEmployeeHistoryId, approve: approve },
			success: function (data) {
				if (data.status) {
					var url = $url + 'kpi/management/wait-approve-kpi-personal';
					window.location.href = url;
				}
			}
		});
	}
}
function relatedKgiForKpi() {
	var kpiId = $("#v-kpiId").val();
	$("#modal-kgi").modal('show');
	var url = $url + 'kpi/management/related-kgi';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kpiId: kpiId },
		success: function (data) {
			$("#related-kgi").html(data.kgiText);
			$("#kpi-name-v").html(data.kpiName);
		}
	});
}
function prepareKpiNextTarget(kpiHistoryId) {
	$("#copy").modal('show');
	$("#kpiHistoryId").val(kpiHistoryId);
}
function prepareKpiTeamNextTarget(kpiTeamHistoryId) {
	$("#copy").modal('show');
	$("#kpiTeamHistoryId").val(kpiTeamHistoryId);
}
function prepareKpiEmployeeNextTarget(kpiEmployeeHistoryId) {
	$("#copy").modal('show');
	$("#kpiEmployeeHistoryId").val(kpiEmployeeHistoryId);
}
function kpiNextTarget() {
	var kpiHistoryId = $("#kpiHistoryId").val();
	var url = $url + 'kpi/management/next-kpi-history';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kpiHistoryId: kpiHistoryId },
		success: function (data) {

		}
	});
}
function kpiTeamNextTarget() {
	var kpiTeamHistoryId = $("#kpiTeamHistoryId").val();
	var url = $url + 'kpi/kpi-team/next-kpi-team-history';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kpiTeamHistoryId: kpiTeamHistoryId },
		success: function (data) {

		}
	});
}
function kpiEmployeeNextTarget() {
	var kpiEmployeeHistoryId = $("#kpiEmployeeHistoryId").val();
	var url = $url + 'kpi/kpi-personal/next-kpi-employee-history';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kpiEmployeeHistoryId: kpiEmployeeHistoryId },
		success: function (data) {

		}
	});
}

function overrideChecked(check, value) {
	// alert(value);
	const inbox = document.getElementById('result-inbox');
	const input = document.getElementById('result-update');
	const icon = document.getElementById('result-icon');
	// const storedValue = value;
	input.value = value;
	input.readOnly = !input.readOnly; // Toggle readonly status
	if (input.readOnly) {
		input.style.backgroundColor = '#f0f0f0'; // Gray when readonly
		input.style.color = 'black';
		inbox.style.backgroundColor = 'rgb(240, 240, 240)'; // สีเทาอ่อน
		icon.src = $url + "image/result-gray.svg";
	} else {
		input.style.backgroundColor = 'white'; // White when editable
		input.style.color = 'black';
		inbox.style.backgroundColor = 'rgb(255, 255, 255)'; // สีพื้นหลังขาว
		icon.src = $url + "image/result-blue.svg";
	}
}


function validateFormKpiUpdate() {
	var multiBranch = [];
	var multiDepartment = [];
	var multiTeam = [];
	var i = 0;
	$("#multi-check-update:checked").each(function () {
		multiBranch[i] = $(this).val();
		i++;
	});
	var a = 0;
	$(".multi-check-department-update:checked").each(function () {
		multiDepartment[a] = $(this).val();
		a++;
	});
	var b = 0;
	$(".multi-check-team-update:checked").each(function () {
		multiTeam[b] = $(this).val();
		b++;
	});
	var fromDate = document.getElementById('fromDate').value.trim();
	var toDate = document.getElementById('toDate').value.trim();
	var nextDate = $('#nextDate').val();
	if (multiBranch.length == 0) {
		alert("Please select at least one branch!");
		return false;
	}
	else if (multiDepartment.length == 0) {
		alert("Please select at least one department!");
		return false;
	} else if (multiTeam.length == 0) {
		alert("Please select at least one team!");
		return false;
	} else if (!fromDate && !toDate) {
		alert("Please fill in Due Term");
		return false;
	} else if (!fromDate) {
		alert("Please fill in Start Date");
		return false;
	} else if (!toDate) {
		alert("Please fill in End Date");
		return false;
	} else if (nextDate == '') {
		alert("Please fill in Target Due Update Date");
		return false;
	} else {
		return true;
	}
}

function multiteamKpi() {
	$("#show-multi-team-update").html(' ');
	var kpiId = $("#kpiId").val();
	var url = $url + 'kpi/kpi-team/kpi-team-update';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kpiId: kpiId },
		success: function (data) {
			$("#show-multi-team-update").html(data.textTeam);
			totalChecked = data.countTeam;
			if (totalChecked > 0) {
				let deptImageSrc = $url + "image/teams.svg";
				let deptBlackImageSrc = $url + "image/teams-black.svg";

				$("#image-team #team-selected-count")
					.removeClass("cycle-current-gray")
					.addClass("cycle-current-white");
				$("#image-team #team-selected-message").html("");

				$("#image-team .cycle-current-gray")
					.removeClass("cycle-current-gray")
					.addClass("cycle-current")
					.find("img")
					.attr("src", deptImageSrc);

				if (totalChecked < 3) {
					$("#image-team .cycle-current").slice(totalChecked, 3)
						.removeClass("cycle-current")
						.addClass("cycle-current-gray")
						.find("img")
						.attr("src", deptBlackImageSrc);
				}

				// อัปเดตจำนวนที่เลือก
				$("#team-selected-count").text(totalChecked.toString());
				$("#team-selected-message").text("");

				// ปรับสไตล์ข้อความ
				$("#multi-team-text").html(totalChecked + " Teams Selected").css({
					"color": "#30313D",
					"font-family": '"SF Pro Display"',
					"font-size": "14px",
					"font-weight": "500",
					"line-height": "20px"
				});

			} else {
				$('input[id^="multi-check-team-"]').each(function () {
					//        $(".multiCheck-" + $(this).val()).prop('required', true);
				});

				// รีเซ็ตค่าหากไม่มีการเลือก
				$("#image-team .cycle-current").slice(0, 3)
					.removeClass("cycle-current")
					.addClass("cycle-current-gray")
					.find("img")
					.attr("src", $url + "image/teams-black.svg");

				$("#team-selected-count").text("00");
				$("#team-selected-message").text("No Teams are Selected Yet");

				$("#multi-team-text").html("Selected Teams").css({
					"color": "var(--Helper-Text-Gray, #8A8A8A)",
					"font-family": '"SF Pro Display", sans-serif',
					"font-size": "14px",
					"font-weight": "400",
					"line-height": "20px",
					"text-transform": "capitalize"
				});
			}
		}
	});

}
