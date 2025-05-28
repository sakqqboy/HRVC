var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
	$baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
	$baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
function viewTabKpi(kpiHistoryId, tabId) {
	var currentTabId = $("#currentTab").val();
	//alert(currentTabId + '==' + tabId);
	var kpiId = $("#kpiId").val();
	//alert(kpiId);
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
		var url = $url + 'kpi/view/kpi-team-employee';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: {
				kpiId: kpiId,
				kpiHistoryId: kpiHistoryId
			},
			success: function (data) {
				$("#show-content").html(data.kpiEmployeeTeam);
				if (viewType == 'list') {
					$('#man-check').css("display", 'none');
					$('#all').show();
					$('#employee-all').show();
					$('#kpi-employee').css("display", 'none');
					$("#viewType").val('list');
				}
				
			}
		});
	}
	if (tabId == 2) {
		var url = $url + 'kpi/view/all-kpi-history';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: {
				kpiId: kpiId,
				kpiHistoryId: kpiHistoryId
			},
			success: function (data) {
				$("#show-content").html(data.monthlyDetailHistoryText);
			}
		});
	}
	if (tabId == 3) {
		var url = $url + 'kpi/view/kpi-issue';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: {
				kpiId: kpiId,
				kpiHistoryId: kpiHistoryId
			}, success: function (data) {
				$("#show-content").html(data.kpiIssue);
			}
		});
	}
	if (tabId == 4) {
		var url = $url + 'kpi/view/kpi-chart';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: {
				kpiId: kpiId,
				kpiHistoryId: kpiHistoryId
			}, success: function (data) {
				$("#show-content").html(data.kpiChart);
			}
		});
	}
	if (tabId == 5) {
		var url = $url + 'kpi/view/kpi-kgi';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: {
				kpiId: kpiId,
				kpiHistoryId: kpiHistoryId
			}, success: function (data) {
				$("#show-content").html(data.kgi);
			}
		});
	}
}

function validateFormKpi(acType) {
	//	event.preventDefault(); // ป้องกันการส่งฟอร์มก่อนการตรวจสอบ
	console.log("validateFormKgi called");
	var multiBranch = [];
	var multiDepartment = [];
	var multiTeam = [];
	var i = 0;
	if (acType != 'update') {
		$("#multi-check:checked").each(function () {
			multiBranch[i] = $(this).val();
			i++;
		});
		var a = 0;
		$(".multi-check-department:checked").each(function () {
			multiDepartment[a] = $(this).val();
			a++;
		});
		var b = 0;
		$(".multi-check-team:checked").each(function () {
			multiTeam[b] = $(this).val();
			b++;
		});
	} else {
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
	}
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

function companyMultiBrachKpi() {
	var acType = $("#acType").val();
	var companyId = acType == "update" ? $("#companyId").val() : $("#companyId").val();
	var kpiId = $("#kpiId").val();

	// var kfiBranchText = JSON.parse(localStorage.getItem("kfiBranchText")) || [];

	// alert(kfiBranchText);
	// ส่งข้อมูลผ่าน AJAX ไปยังเซิร์ฟเวอร์
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: $url + 'kpi/management/company-multi-branch', // URL ที่รับค่าจาก AJAX
		data: {
			companyId: companyId,
			acType: acType,
			kpiId: kpiId
			// kfiBranchText: kfiBranchText // ส่งค่า branchIds ที่เลือกไป
		},
		success: function (data) {
			if (data.status) {
				// เติมข้อมูลที่ต้องการแสดงกลับจากเซิร์ฟเวอร์
				if (acType == "update") {
					$("#show-multi-branch-update").html(data.branchText);
					$("#show-multi-branch-update").show();
				} else {
					$("#show-multi-branch").html(data.branchText);
					$("#show-multi-branch").show();
				}
			}
		}
	});
}
function createNewIssueKpi(kpiId) {
	var issue = $("#issue").val();
	var description = $("#description").val();
	var employeeId = $("#employeeId").val();
	var fd = new FormData();
	var files = $("#attachKpiFile")[0].files;
	if (files.length > 0) {
		fd.append('file', files[0]);

	}
	fd.append('issue', issue);
	fd.append('kpiId', kpiId);
	fd.append('employeeId', employeeId);
	fd.append('description', description);
	var url = $url + 'kpi/management/create-new-issue';
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
function showTeamKgi(kgiId, type) {
	if (type == 1) {
		$("#kgi-team-" + kgiId).show();
		$("#hide-" + kgiId).show();
		$("#show-" + kgiId).hide();
		var url = $url + 'kpi/view/kgi-team';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { kgiId: kgiId },
			success: function (data) {
				$("#kgi-team-" + kgiId).html(data.kgiTeam);
			}
		});
	} else {
		$("#kgi-team-" + kgiId).hide();
		$("#hide-" + kgiId).hide();
		$("#show-" + kgiId).show();
	}
}
function changeTargetKpiTeamReason(kpiTeamHistoryId) {
	var url = $url + 'kpi/management/channge-team-target-reason';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { kpiTeamHistoryId: kpiTeamHistoryId },
		success: function (data) {
			$("#kpi-team-reason").html(data.reason);
		}
	});
}


document.getElementById('check2').addEventListener('change', function () {
	const check1 = document.getElementById('check1');
	// const textboxDiv = document.querySelector('.textbox-check-hide') || document.querySelector(
	// 	'.textbox-check-green');
	const textboxDiv = document.getElementById('textbox-check-completed');
	const borderCicleDiv = document.getElementById('border-cicle-completed'); // ใช้ ID แทน
	const textgreen = document.getElementById('text-green'); // ใช้ ID แทน

	if (this.checked) {
		// alert("1"); // แสดง Alert เมื่อกดเลือก check2
		check1.style.display = 'none'; // ซ่อน check1
		textgreen.classList.add('text-green');

		if (textboxDiv) {
			textboxDiv.classList.remove('textbox-check-hide');
			textboxDiv.classList.add('textbox-check-green');
		}

		if (borderCicleDiv) {
			borderCicleDiv.classList.remove('text-black');
			borderCicleDiv.classList.add('text-green');
			borderCicleDiv.style.border = '0.5px solid #2D7F06'; // เปลี่ยนสี border
		}

		if (textgreen) {
			textgreen.classList.remove('text-black');
			textgreen.classList.add('text-green'); // เปลี่ยนสีข้อความ
		}

	} else {
		// alert("2"); // แสดง Alert เมื่อกดเลือก check2
		check1.style.display = 'inline-block'; // แสดง check1 กลับมา
		textgreen.classList.add('text-green');

		if (textboxDiv) {
			textboxDiv.classList.remove('textbox-check-green');
			textboxDiv.classList.add('textbox-check-hide');
		}

		if (borderCicleDiv) {
			borderCicleDiv.classList.remove('text-green');
			borderCicleDiv.classList.add('text-black');
			borderCicleDiv.style.border = '0.5px solid #30313D'; // กลับไปเป็นสีเดิม
		}

		if (textgreen) {
			textgreen.classList.remove('text-green');
			textgreen.classList.add('text-black'); // เปลี่ยนกลับเป็นสีดำ
		}
	}
});

document.getElementById('check1').addEventListener('change', function () {
	const textboxDiv = document.getElementById('textbox-check-progress');
	const borderCicleDiv = document.getElementById('border-cicle-progress');
	const textblue = document.getElementById('text-blue'); // ใช้ ID แทน

	if (this.checked) {
		if (textboxDiv) {
			// alert("1");
			textboxDiv.classList.remove('textbox-check-hide');
			textboxDiv.classList.add('textbox-check-blue');
		}

		if (borderCicleDiv) {
			// alert("1");
			borderCicleDiv.classList.remove('text-black');
			borderCicleDiv.classList.add('text-blue-sea');
			borderCicleDiv.style.border = '0.5px solid #2F42ED'; // เปลี่ยนสี border
		}
		if (textblue) {
			textblue.classList.remove('text-black');
			textblue.classList.add('text-blue-sea'); // เปลี่ยนสีข้อความ
		}

	} else {
		// alert("2"); // แสดง Alert เมื่อกดเลือก check1
		textblue.classList.add('text-blue-sea');

		if (textboxDiv) {
			textboxDiv.classList.remove('textbox-check-blue');
			textboxDiv.classList.add('textbox-check-hide');
		}

		if (borderCicleDiv) {
			borderCicleDiv.classList.remove('text-blue-sea');
			borderCicleDiv.classList.add('text-black');
			borderCicleDiv.style.border = '0.5px solid #30313D'; // กลับไปเป็นสีเดิม
		}

		if (textblue) {
			textblue.classList.remove('text-blue-sea');
			textblue.classList.add('text-black'); // เปลี่ยนกลับเป็นสีดำ
		}
	}
});


// ฟังก์ชันเปลี่ยนสีของ placeholder เมื่อมีการเลือกค่า
function updatePlaceholderColor(selector) {
	$(selector).on('change', function () {
		$(this).css('color', $(this).val() !== "" ? '#30313D' : 'var(--Helper-Text-Gray, #8A8A8A)');
	});
}
// ตรวจสอบค่าก่อนส่งฟอร์ม
document.getElementById("statusForm")?.addEventListener("submit", function (event) {
	let selected = document.querySelector('.status-checkbox:checked');
	if (!selected) {
		alert("Please select a status before submitting!");
		event.preventDefault();
	}
});

