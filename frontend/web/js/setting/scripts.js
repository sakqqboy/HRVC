new Chart(document.getElementById("mixed-chart"), {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: "Jan",
            type: "line",
            borderColor: "#008BF0",   //ฟ้า//
            data: [400, 450, 600, 734, 660, 750, 673, 750, 483, 598, 750, 800],
            fill: true,
        }, {
            label: "Feb",
            type: "line",
            data: [430, 600, 850, 930, 900, 920, 900, 970, 960, 850, 850, 950],
            fill: true,
            backgroundColor: "transparent",
            borderColor: "red",   ///แดง/
            borderDash: [4, 4],
        }, {
            label: "Mar",
            type: "bar",
            backgroundColor: "#A9EC9F", //เขียวอ่อน///
            data: [350, 547, 675, 905, 653, 899, 790, 950, 483, 598, 788, 940],
        }, {
            label: "Apr",
            type: "bar",
            backgroundColor: "#01724E",    //เขียวเข้ม//
            backgroundColorHover: "#3e95cd",
            data: [360, 547, 783, 905, 653, 899, 690, 950, 483, 598, 788, 940],
        }
        ]
    },
    options: {
        title: {
            display: true
        },
        legend: { display: false }
    }
});

