var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
function checkKgiName() {
	var name = $("#kgiGroupName").val();
	var companyId = $("#companyId").val();
	var url = $url + 'kgi/kgi-group/check-kgi-group-name';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { name: name, companyId: companyId },
		success: function (data) {
			if (data.status) {
				$("#duplicateName").css("display", "none");
				if ($.trim(name) !== '' && companyId !== '') {
					$("#submit-kgi-group").removeAttr("disabled");
				} else { 
					$("#submit-kgi-group").prop("disabled",true);
				}
			} else {
				$("#duplicateName").show();
				$("#submit-kgi-group").prop("disabled",true);
			}

		}
	});
}
function checkKgiNameUpdate() {
	var name = $("#kgiGroupName").val();
	var companyId = $("#companyId").val();
	var kgiGroupId = $("#kgiGroupId").val();
	var url = $url + 'kgi/kgi-group/check-kgi-group-name-update';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { name: name, companyId: companyId, kgiGroupId: kgiGroupId },
		success: function (data) {
			if (data.status) {
				$("#duplicateName").css("display", "none");
				if ($.trim(name) !== '' && companyId !== '') {
					$("#submit-kgi-group").removeAttr("disabled");
				} else { 
					$("#submit-kgi-group").prop("disabled",true);
				}
			} else {
				$("#duplicateName").show();
				$("#submit-kgi-group").prop("disabled",true);
			}
		}
	});
}
function deleteKgiGroup(kgiGroupId) { 
	if (confirm('Are you sure to delete this group?')) { 
		var url = $url + 'kgi/kgi-group/delete-kgi-group';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: {kgiGroupId: kgiGroupId },
		success: function (data) {
			if (data.status) {
				$("#kgiGroup-" + kgiGroupId).hide();
			} 

		}
	});
	}
}