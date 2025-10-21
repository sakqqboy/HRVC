var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
function searchWord() { 
	var word = $("#search-english").val();
	var url = $url + 'language/default/search-english';
	if (word != '') {
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { word: word },
			success: function (data) {
				if (data.textSearch != '') {
					$("#word-result").html(data.textSearch);
				} else {
					$("#word-result").html('');
				}
   
			}
		});
	} else { 
		$("#word-result").html('');
	}
}
function deleteTran(translatorId) {
	var url = $url + 'language/default/delete-translate';
	if (confirm('Are you sure to delete this translate?')) {
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { id: translatorId },
			success: function (data) {
				$("#tran" + translatorId).hide();
   
			}
		});
	}
}