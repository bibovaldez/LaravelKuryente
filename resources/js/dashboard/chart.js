import Chart from "chart.js/auto";
let ctx;
let myChart;
let usage = [];
let labels = [];
let usageData = [];
let refreshtime = 1000;
let data = [];
let config = {};
let timeUnit = {
    min: true,
    hour: false,
    day: false,
    month: false,
    year: false,
};


// create chart 
(async () => {
    let unit = Object.keys(timeUnit).find((key) => timeUnit[key] === true);
    try {
        const response = await fetch(`/dashboard/fetch_usage_data/${unit}`);
        const data = await response.json();
        usage = data.map((item) => item.usage).slice(-60);
        labels = data
            .map((item) => {
                const date = new Date(item.recorded_at);
                let formattedDate;
                switch (unit) {
                    case "min":
                        formattedDate = `${date
                            .getMinutes()
                            .toString()
                            .padStart(2, "0")}:${date
                            .getSeconds()
                            .toString()
                            .padStart(2, "0")}`;
                        break;
                    case "hour":
                        formattedDate = `${date
                            .getHours()
                            .toString()
                            .padStart(2, "0")}:${date
                            .getMinutes()
                            .toString()
                            .padStart(2, "0")}`;
                        break;
                    case "day":
                        formattedDate = `${date
                            .getHours()
                            .toString()
                            .padStart(2, "0")}:${date
                            .getMinutes()
                            .toString()
                            .padStart(2, "0")}`;
                        break;
                    case "month":
                        formattedDate = `${(date.getMonth() + 1)
                            .toString()
                            .padStart(2, "0")}-${date
                            .getDate()
                            .toString()
                            .padStart(2, "0")}`;
                        break;
                    case "year":
                        formattedDate = `${date.getFullYear()}-${(
                            date.getMonth() + 1
                        )
                            .toString()
                            .padStart(2, "0")}`;
                        break;
                    default:
                        formattedDate = date.toString();
                        break;
                }
                return formattedDate;
            })
            .slice(-60);
    } catch (error) {
        console.error("Error:", error);
    }
    data = [
        {
            label: "Usage",
            data: usage,
            borderColor: "rgba(255, 99, 132, 1)",
            fill: false,
            cubicInterpolationMode: "monotone",
            tension: 0.4,
        },
    ];
    config = {
        type: "line",
        data: {
            labels: labels,
            datasets: data,
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "bottom",
                },
                title: {
                    display: true,
                    text: "Usage Chart",
                    position: "bottom",
                },
            },
        },
    };
    ctx = document.getElementById("myChart").getContext("2d");
    myChart = new Chart(ctx, config);
})();


// time control
window.setTimeUnit = function (unit) {
    // Reset all time units to false
    for (let key in timeUnit) {
        timeUnit[key] = false;
    }
    // Set the selected time unit to true
    timeUnit[unit] = true;
    refreshData();
};


// get data
async function fetchData(unit) {
    let sliceAmount;
    switch (unit) {
        case "min":
        case "hour":
            sliceAmount = -60;
            break;
        case "day":
        case "year":
            sliceAmount = -12;
            break;
        case "month":
            sliceAmount = -30;
            break;
        default:
            return;
    }
    // fetch data from the server
    try {
        const response = await fetch(`/dashboard/fetch_usage_data/${unit}`);
        const data = await response.json();
        usage = data.map((item) => item.usage).slice(sliceAmount);
        labels = data
            .map((item) => {
                const date = new Date(item.recorded_at);
                let formattedDate;
                switch (unit) {
                    case "min":
                        formattedDate = `${date
                            .getMinutes()
                            .toString()
                            .padStart(2, "0")}:${date
                            .getSeconds()
                            .toString()
                            .padStart(2, "0")}`;
                        break;
                    case "hour":
                        formattedDate = `${date
                            .getHours()
                            .toString()
                            .padStart(2, "0")}:${date
                            .getMinutes()
                            .toString()
                            .padStart(2, "0")}`;
                        break;
                    case "day":
                        formattedDate = `${date
                            .getHours()
                            .toString()
                            .padStart(2, "0")}:${date
                            .getMinutes()
                            .toString()
                            .padStart(2, "0")}`;
                        break;
                    case "month":
                        formattedDate = `${(date.getMonth() + 1)
                            .toString()
                            .padStart(2, "0")}-${date
                            .getDate()
                            .toString()
                            .padStart(2, "0")}`;
                        break;
                    case "year":
                        formattedDate = `${date.getFullYear()}-${(
                            date.getMonth() + 1
                        )
                            .toString()
                            .padStart(2, "0")}`;
                        break;
                    default:
                        formattedDate = date.toString();
                        break;
                }
                return formattedDate;
            })
            .slice(sliceAmount);
    } catch (error) {
        console.error("Error:", error);
    }
}


// refreh data
async function refreshData() {
    let unit = Object.keys(timeUnit).find((key) => timeUnit[key] === true);
    if (unit) {
        await fetchData(unit);
    }
}
setInterval(refreshData, refreshtime);


// update chart data
async function updateChart() {
    var newData = usage;
    var newLabels = labels;

    myChart.data.labels = newLabels;
    myChart.data.datasets[0].data = newData;
    myChart.update();

    console.log(newData);
}