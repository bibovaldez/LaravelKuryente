import Chart from "chart.js/auto";

let three_secs= true;
let fifteen_min = false;
let one_hour = false;
let four = false;
let one_day = false;


// array of objects
let usage = [];
let labels = [];
let usageData = [];

// fetch data from the server without reloading the page
async function refreshData() {
    return fetch("/dashboard/fetch_usage_data")
        .then((response) => response.json())
        .then((data) => {
            usage = data.map((item) => item.usage);
            labels = data.map((item) => item.recorded_at);
            createChart();
        })
        .catch((error) => console.error("Error:", error));
}
setInterval(refreshData, 1000);



// create a chart
const ctx = document.getElementById("myChart");
async function createChart() {
    await refreshData();
    const myChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Cubic interpolation (monotone)",
                    data:usage ,
                    borderColor: "rgb(75, 192, 192)",
                    fill: false,
                    cubicInterpolationMode: "monotone",
                    tension: 0.4,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: "Chart.js Line Chart - Cubic interpolation mode",
                },
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                    },
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: "Value",
                    },
                },
            },
        },
    });
}
