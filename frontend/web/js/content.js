let items = document.querySelectorAll('.progress-item1');
const counters = Array(items.length);
const intervals = Array(items.length);
counters.fill(0);
items.forEach((number, index) => {
    intervals[index] = setInterval(() => {
        if (counters[index] == parseInt(number.dataset.num)) {
            clearInterval(intervals[index]);
        } else {
            counters[index] += 1;
            number.style.background = "conic-gradient(rgb(41, 140, 233) calc(" + counters[index] + "%), rgb(219, 239, 247) 0deg)";
            number.setAttribute('data-value', counters[index] + "%");
            number.innerHTML = counters[index] + "%";
        }
    }, 15);
});


$(".animated-progress span").each(function () {
    $(this).animate(
        {
            width: $(this).attr("data-progress") + "%",
        },
        1000
    );
    $(this).text($(this).attr("data-progress") + "%");
});