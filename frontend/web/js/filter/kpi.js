var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
	$baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
	$baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;

$("#company-filter").change(function () {
	// alert(1);
	var companyId = $("#company-filter").val();
	var url = $url + 'setting/filter/company-branch';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { companyId: companyId },
		success: function (data) {
			if (data.status) {
				$("#branch-filter").removeAttr("disabled");
				$("#branch-filter").html(data.text);
			}
		}
	});
});

$("#branch-filter").change(function () {
	var branchId = $("#branch-filter").val();
	var url = $url + 'setting/filter/branch-team';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { branchId: branchId },
		success: function (data) {
			if (data.status) {
				$("#team-filter").removeAttr("disabled");
				$("#team-filter").html(data.text);
			}
		}
	});
	var url = $url + 'setting/filter/branch-department';
	// alert(branchId);
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { branchId: branchId },
		success: function (data) {
			// alert(data);
			if (data.status) {
				$("#department-filter").removeAttr("disabled");
				$("#department-filter").html(data.text);
			}
		}
	});
});

// $("#branch-select").change(function () {
// 	alert(1);
// 	var branchId = $("#branch-select").val();
// 	var url = $url + 'setting/filter/branch-department';
// 	$.ajax({
// 		type: "POST",
// 		dataType: 'json',
// 		url: url,
// 		data: { branchId: branchId },
// 		success: function (data) {
// 			if (data.status) {
// 				$("#departmentSelect").removeAttr("disabled");
// 				$("#departmentSelect").html(data.text);
// 			}
// 		}
// 	});
// });

$("#team-filter").change(function () {
	var teamId = $("#team-filter").val();
	var url = $url + 'setting/filter/employee-team';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { teamId: teamId },
		success: function (data) {
			if (data.status) {
				$("#employee-filter").removeAttr("disabled");
				$("#employee-filter").html(data.text);
			}
		}
	});
});
