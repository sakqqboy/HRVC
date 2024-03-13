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
