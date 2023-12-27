import Chart from "chart.js/auto";
let usage = [];
let labels = [];
let usageData = [];
let refreshtime = 1000;
let timeUnit = {
    min: true,
    hour: false,
    day: false,
    month: false,
    year: false,
};

window.setTimeUnit = function (unit) {
    // Reset all time units to false
    for (let key in timeUnit) {
        timeUnit[key] = false;
    }
    // Set the selected time unit to true
    timeUnit[unit] = true;
    refreshData();
};

// fetch data from the server without reloading the page
async function refreshData() {
    switch (true) {
        case timeUnit.min:
            await fetch("/dashboard/fetch_usage_data/min")
                .then((response) => response.json())
                .then((data) => {
                    usage = data.map((item) => item.usage).slice(0,60);
                    labels = data.map((item) => item.recorded_at).slice(0,60);
                    refreshtime = 1000;
                    console.log(labels);
                })
                .catch((error) => console.error("Error:", error));
            break;
        case timeUnit.hour:
            await fetch("/dashboard/fetch_usage_data/hour")
                .then((response) => response.json())
                .then((data) => {
                    usage = data.map((item) => item.usage);
                    labels = data.map((item) => item.recorded_at);
                    refreshtime = 1000 * 60;
                })
                .catch((error) => console.error("Error:", error));
            break;
        case timeUnit.day:
            await fetch("/dashboard/fetch_usage_data/day")
                .then((response) => response.json())
                .then((data) => {
                    usage = data.map((item) => item.usage);
                    labels = data.map((item) => item.recorded_at);
                    refreshtime = 1000 * 60 * 60;
                })
                .catch((error) => console.error("Error:", error));
            break;
        case timeUnit.month:
            await fetch("/dashboard/fetch_usage_data/month")
                .then((response) => response.json())
                .then((data) => {
                    usage = data.map((item) => item.usage);
                    labels = data.map((item) => item.recorded_at);
                    refreshtime = 1000 * 60 * 60 * 24;
                })
                .catch((error) => console.error("Error:", error));
            break;
        case timeUnit.year:
            await fetch("/dashboard/fetch_usage_data/year")
                .then((response) => response.json())
                .then((data) => {
                    usage = data.map((item) => item.usage);
                    labels = data.map((item) => item.recorded_at);
                    refreshtime = 1000 * 60 * 60 * 24 * 30;
                })
                .catch((error) => console.error("Error:", error));
            break;
        default:
            break;
    }
}
setInterval(refreshData, refreshtime);
refreshData();
// // create a chart
// const ctx = document.getElementById("myChart");
// async function createChart() {
//     await refreshData();
//     const myChart = new Chart(ctx, {
//         type: "line",
//         data: {
//             labels: labels,
//             datasets: [
//                 {
//                     label: "Cubic interpolation (monotone)",
//                     data:usage ,
//                     borderColor: "rgb(75, 192, 192)",
//                     fill: false,
//                     cubicInterpolationMode: "monotone",
//                     tension: 0.4,
//                 },
//             ],
//         },
//         options: {
//             responsive: true,
//             plugins: {
//                 title: {
//                     display: true,
//                     text: "Chart.js Line Chart - Cubic interpolation mode",
//                 },
//             },
//             scales: {
//                 x: {
//                     display: true,
//                     title: {
//                         display: true,
//                     },
//                 },
//                 y: {
//                     display: true,
//                     title: {
//                         display: true,
//                         text: "Value",
//                     },
//                 },
//             },
//         },
//     });
// }
