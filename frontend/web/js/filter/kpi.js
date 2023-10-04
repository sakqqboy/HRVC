var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
$("#company-filter").change(function () {
	var companyId = $("#company-filter").val();
	var url = $url + 'setting/filter/company-branch';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { companyId: companyId},
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
		data: { branchId: branchId},
		success: function (data) {
			if (data.status) {
				 $("#team-filter").removeAttr("disabled");
				$("#team-filter").html(data.text);
			}
		}
	   });
});
