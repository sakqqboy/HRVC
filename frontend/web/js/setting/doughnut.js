
const dataDoughnut = {
    labels: ["KFI", "KGI", "KPI"],
    datasets: [{
        label: ['key Indicator'],
        data: [41, 17, 19],
        backgroundColor: [
            "#FF715B",
            "#FDCA40",
            "#748EE9",
        ],
        hoverOffset: 4,
    },],
};

const configDoughnut = {
    type: "doughnut",
    data: dataDoughnut,
    options: {},
};

var chartBar = new Chart(
    document.getElementById("chartDoughnut"),
    configDoughnut
);
