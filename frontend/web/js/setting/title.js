var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
function createTitle() {
	var titleName = $("#titleName").val();
	var shortTag = $("#shortTag").val();
	var departmentId = $("#departmentId").val();
	var jobDescription = $("#jobDescription").val();
	var layer = $("#layer").val();
	if ($.trim(titleName) == '') {
		alert("Title name can not be null");
	} else if (layer == '' || layer == null) {
		alert('Please select Layer.');
	} else if (departmentId == '') { 
		alert('Please select Department.');
	} else{
		var url = $url + 'setting/title/save-create-title';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { titleName: titleName, shortTag: shortTag, layer: layer,departmentId:departmentId,jobDescription:jobDescription},
			success: function (data) {
				if (data.status) {
					$("#titleName").val('');
					$("#shortTag").val('');
					$("#layer").val('')
					$("#company-team").val('');
					$("#branch-team").val('');
					$("#department-team").val('');
					$("#jobDescription").val('')
					$("#departmentId").val('');
					$("#all-title-list").prepend(data.newTitle);
				} else {
					alert(data.errorText);
				}
			}
		});
	}
}
function updateTitle(titleId) {
	$("#titleId").val(titleId);
	var url = $url + 'setting/title/update-title';
	$.ajax({
	    type: "POST",
	    dataType: 'json',
	    url: url,
	    data: { titleId: titleId },
		success: function (data) {
			$("#create-title").css("display", "none");
			$("#update-title").show();
			$("#reset-title").show();
			$("#layer").val(data.title.layerId);
			$("#shortTag").val(data.title.shortTag);
			$("#titleName").val(data.title.titleName);
			// $("#jobDescription").html(data.title.jobDescription);
			$("#jobDescription").val(data.title.jobDescription);
			$("#department-team").html(data.department);
			$("#department-team").removeAttr("disabled");
			$("#branch-team").html(data.branch);
			$("#branch-team").removeAttr("disabled");
			$("#company-team").val(data.companyId);
		}
	});
}
$("#update-title").click(function (e) {
	var titleId=$("#titleId").val();
	var titleName = $("#titleName").val();
	var shortTag = $("#shortTag").val();
	var layer = $("#layer").val();
	var departmentId = $("#department-team").val();
	var jobDescription=$("#jobDescription").val();
	if ($.trim(titleName) == '') {
		alert("Title name can not be null");
	} else if (layer == '' || layer == null) {
		alert('Please select Layer');
	} else {
		var url = $url + 'setting/title/save-update-title';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { titleName: titleName, shortTag: shortTag, layer: layer,titleId:titleId,departmentId:departmentId,jobDescription:jobDescription },
			success: function (data) {
				$("#titleId").val('');
				$("#titleName").val('');
				$("#shortTag").val('');
				$("#layer").val('')
				$("#company-team").val('');
				$("#branch-team").val('');
				$("#department-team").val('');
				$("#title-" + titleId).html(data.textUpdate);
				$("#jobDescription").val('');
				
			}
		});
	}
});
$("#reset-title").click(function (e) {
	$("#titleId").val('');
	$("#titleName").val('');
	$("#layer").val('');
	$("#shortTag").val('');
	$("#department-team").val('');
	$("#department-team").prop('disabled','true');
	$("#update-title").css("display", "none");
	$("#branch-team").val('');
	$("#company-team").val('')
	$("#branch-team").prop('disabled','true');
	$("#reset-title").css("display", "none");
	$("#create-title").show();
});
function deleteTitle(titleId) {
	if (confirm("Are you sure to delete this title")) {
		var url = $url + 'setting/title/delete-title?';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { titleId: titleId },
			success: function (data) {
				if (data.status) {
					$("#title-" + titleId).hide(200);
				} else {
					alert("Can not delete this title.");
				}
   
			}
		});
	}
}
function addDepartmentId() { 
	var departmentId = $("#department-team").val();
	$("#departmentId").val(departmentId);
}
function filterTitle() { 
	var departmentId = $("#department-team").val();
	var branchId = $("#branch-team").val();
	var companyId = $("#company-team").val();
	var url = $url + 'setting/title/filter-title?';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { departmentId: departmentId,branchId:branchId,companyId:companyId },
		success: function (data) {
			

		}
	});

}