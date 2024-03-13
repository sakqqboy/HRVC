
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





console.clear();
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

const allDayEls = document.querySelectorAll('[data-day]');
allDayEls.forEach(dayEl => {
	dayEl.addEventListener('pointerdown', send);
	dayEl.addEventListener('pointerover', send);
});
document.body.addEventListener('pointerup', send);
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