
var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
	$baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
	$baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
function previousMonth(type) {
	var year = $("#year" + type).val();
	var currrentMonth = $("#month" + type).val();
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
		data: { year: year, month: month, type: type },
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
	var year = $("#year" + type).val();
	var currrentMonth = $("#month" + type).val();
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
		data: { year: year, month: month, type: type },
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
	var termItemId = $("#termItemId").val();
	var url = $url + 'evaluation/environment/input-date';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { day: day, month: month, year: year },
		success: function (data) {
			if (data.status) {
				var dateText = day + '/' + month + '/' + year;
				if (type == 1) {
					$("#fromDate").html(data.fullDate);
					$("#fromDateVal").val(dateText);
					if (termItemId != '') {
						$("#start-date-" + termItemId).html(data.fullDate);
						var url = $url + 'evaluation/environment/set-term-item-date';
						var type2 = '1';
						$.ajax({
							type: "POST",
							dataType: 'json',
							url: url,
							data: { termItemId: termItemId, type2: type2, dateText: dateText },
							success: function (data) {
								if (data.status) {
									$("#duration-date-" + termItemId).html(data.duration);
								}
							}
						});
					}
				} else {
					$("#toDate").html(data.fullDate);
					$("#toDateVal").val(dateText);
					if (termItemId != '') {
						$("#finish-date-" + termItemId).html(data.fullDate);
						var url = $url + 'evaluation/environment/set-term-item-date';
						var type2 = '2';
						$.ajax({
							type: "POST",
							dataType: 'json',
							url: url,
							data: { termItemId: termItemId, type2: type2, dateText: dateText },
							success: function (data) {
								if (data.status) {
									$("#duration-date-" + termItemId).html(data.duration);
								}
							}
						});
					}
				}

			}
		}
	});
}


console.clear();
// idle
// -> onPointerDown
// dragging
// -> onPointerMove / onPointerOver
// <- onPointerUp
/* NOTE: We retooled the data to be based on first selection and second selection. We'll calculate which is the start & end date later in the `updateDOM` function. */
const data = {
	firstDate: null,
	secondDate: null
};
const machine = {
	initial: 'idle',
	states: {
		idle: {
			on: {
				pointerdown: (data, event) => {
					data.firstDate = +event.currentTarget.dataset.day;
					data.secondDate = null;
					return 'dragging';
				}
			}
		},
		dragging: {
			on: {
				pointerover: (data, event) => {
					data.secondDate = +event.currentTarget.dataset.day;
					return 'dragging';
				},
				pointerup: 'idle',
				pointercancel: 'idle'
			}
		}
	}
};
// idle
let currentState = machine.initial;
function send(event) {
	const transition = machine
		.states[currentState]
		.on[event.type];
	if (typeof transition === 'function') {
		currentState = transition(data, event);
		updateDOM();
	} else if (transition) {
		currentState = transition;
		updateDOM();
	}
}
/* ---------------------------------- */
const allDayEls = document.querySelectorAll('[data-day]');
allDayEls.forEach(dayEl => {
	dayEl.addEventListener('pointerdown', send);
	dayEl.addEventListener('pointerover', send);
});
document.body.addEventListener('pointerup', send);
/* ---------------------------------- */
function updateDOM() {
	document.querySelectorAll('[data-selected]')
		.forEach(el => {
			delete el.dataset.selected
		});
	const startDate = Math.min(data.firstDate, data.secondDate);
	const endDate = Math.max(data.firstDate, data.secondDate);
	if (startDate) {
		const startDateEl = document.querySelector(`[data-day="${startDate}"]`);
		startDateEl.dataset.selected = "start";
	}
	if (endDate) {
		const endDateEl = document.querySelector(`[data-day="${endDate}"]`);
		endDateEl.dataset.selected = "end";
	}
}


