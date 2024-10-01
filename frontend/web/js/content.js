let items = document.querySelectorAll('.progress-circle-inprogress');
const counters = Array(items.length);
const intervals = Array(items.length);
counters.fill(0);
items.forEach((number, index) => {
    intervals[index] = setInterval(() => {
        if (counters[index] == parseInt(number.dataset.num)) {
            clearInterval(intervals[index]);
        } else {
            counters[index] += 1;
            number.style.background = "conic-gradient(#2F42ED calc(" + counters[index] + "%), rgb(219, 239, 247) 0deg)";
            number.setAttribute('data-value', counters[index] + "%");
            number.innerHTML = counters[index] + "%";
        }
    }, 10);
});

let overs = document.querySelectorAll('.progress-circle-over');
const countersOver = Array(overs.length);
const intervalsOver = Array(overs.length);
countersOver.fill(0);
overs.forEach((number, index) => {
    intervalsOver[index] = setInterval(() => {
        if (countersOver[index] == parseInt(number.dataset.num)) {
            clearInterval(intervalsOver[index]);
        } else {
            countersOver[index] += 1;
            number.style.background = "conic-gradient(#E05757 calc(" + countersOver[index] + "%), rgb(219, 239, 247) 0deg)";
            number.setAttribute('data-value', countersOver[index] + "%");
            number.innerHTML = countersOver[index] + "%";
        }
    }, 10);
});


let complete = document.querySelectorAll('.progress-circle-complete');
const countersComplete = Array(complete.length);
const intervalsComplete = Array(complete.length);
countersComplete.fill(0);
complete.forEach((number, index) => {
    intervalsComplete[index] = setInterval(() => {
        if (countersComplete[index] == parseInt(number.dataset.num)) {
            clearInterval(intervalsComplete[index]);
        } else {
            countersComplete[index] += 1;
            number.style.background = "conic-gradient(#2D7F06 calc(" + countersComplete[index] + "%), rgb(219, 239, 247) 0deg)";
            number.setAttribute('data-value', countersComplete[index] + "%");
            number.innerHTML = countersComplete[index] + "%";
        }
    }, 10);
});

