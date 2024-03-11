
var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
function previousMonth(type) {
	var year = $("#year"+type).val();
	var currrentMonth = $("#month"+type).val();
	var month = parseInt(currrentMonth) - 1;
	if (month == 0) {
		month = 12;
		year = parseInt(year) - 1;
	}
	var url = $url + 'evaluation/environment/calendar';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { year: year, month: month,type:type},
		success: function (data) {
			if (data.status) { 
				$("#month-year" + type).html(data.monthYear);
				$("#month" + type).val(month);
				$("#year" + type).val(year);
				$("#result-date" + type).html(data.newCalendar);
				
			}
		}
	});
}
function nextMonth(type) {
	var year = $("#year"+type).val();
	var currrentMonth = $("#month"+type).val();
	var month = parseInt(currrentMonth) + 1;
	if (month == 13) {
		month = 1;
		year = parseInt(year) + 1;
	}
	var url = $url + 'evaluation/environment/calendar';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: {year: year, month: month,type:type},
		success: function (data) {
			if (data.status) { 
				$("#month-year" + type).html(data.monthYear);
				$("#month" + type).val(month);
				$("#year" + type).val(year);
				$("#result-date" + type).html(data.newCalendar);
			}
		}
	});
}
function selectDate(type, day, month, year) {
	var lastSelect = $("#current-select-" + type).val();
	if (lastSelect != '') {
		$("#" + lastSelect).css("background-color", "white");
		$("#" + lastSelect).css("color", "gray");
	}
	if (type == 1) {
		$("#" + type + day + month + year).css("background-color", "#6666FF");
	} else { 
		$("#" + type + day + month + year).css("background-color", "#FF6633");
	}
	$("#" + type + day + month + year).css("color", "white");
	$("#current-select-" + type).val('' + type + '' + day + '' + month + '' + year);
	var url = $url + 'evaluation/environment/input-date';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: {day: day, month: month,year:year},
		success: function (data) {
			if (data.status) { 
				var dateText = day + '/' + month + '/' + year;
				if (type == 1) {
					$("#fromDate").html(data.fullDate);
					$("#fromDateVal").val(dateText);
				} else { 
					$("#toDate").html(data.fullDate);
					$("#toDateVal").val(dateText);
				}
			}
		}
	});
}

$("#create-frame").submit(function (e) {
	var fromDate = $("#fromDateVal").val();
	var toDate = $("#toDateVal").val();
	if (fromDate == '') {
		e.preventDefault();
		alert('Please select begin date');
		
	} else if (toDate == '') {
		e.preventDefault();
		alert('Please select end date');
	} 
	
   });
