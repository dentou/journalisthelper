"use strict";

const MAX_DATA_POINTS = 5;

let data = {
    labels: [],
    datasets: [{
        label: "Dataset #1",
        backgroundColor: "rgba(255,99,132,0.2)",
        borderColor: "rgba(255,99,132,1)",
        borderWidth: 2,
        hoverBackgroundColor: "rgba(255,99,132,0.4)",
        hoverBorderColor: "rgba(255,99,132,1)",

        data: [],
    }]
};

let options = {
    maintainAspectRatio: false,
    scales: {
        yAxes: [{
            stacked: true,
            gridLines: {
                display: true,
                color: "rgba(255,99,132,0.2)"
            }
        }],
        xAxes: [{
            gridLines: {
                display: false
            }
        }]
    },
    animation: false
};

let dataChart;
drawChart()
// let dataChart = Chart.Line("myChart", {
//     options: options,
//     data: data
// });

let eventSource = new EventSource('//localhost/journalisthelper/modules/dataserver.php');
console.log(eventSource.withCredentials);
console.log(eventSource.readyState);
console.log(eventSource.url);

eventSource.onopen = function() {
    console.log("Connection to server opened.");
};
eventSource.onmessage = function(event) {
    // let newElement = document.createElement("li");
    // newElement.textContent = "message: " + e.data;
    // eventList.appendChild(newElement);

};
eventSource.onerror = function() {
    console.log("EventSource failed.");
};

eventSource.addEventListener("update", function (event) {
    let jdata = JSON.parse(event.data);
    addData(dataChart, 0, jdata.x, jdata.y);
})

eventSource.addEventListener("init", function (event) {
    let jdata = JSON.parse(event.data);

    dataChart.destroy();
    dataChart = Chart.Line("myChart", {
        options: options,
        data: data
    });
    addData(dataChart, 0, jdata.x, jdata.y);

    // let jdata = JSON.parse(event.data);
    // console.log(jdata);
})

function drawChart() {
    dataChart = Chart.Line("myChart", {
        options: options,
        data: data
    });
}

function addData(chart, dataSetIndex, label, data) {
    chart.data.labels.push(label);
    chart.data.datasets[dataSetIndex].data.push(data);
    // console.log(chart.data.datasets[dataSetIndex].data.length);
    if (chart.data.datasets[dataSetIndex].data.length > MAX_DATA_POINTS) {
        removeData(chart, dataSetIndex, 0);
    }
    chart.update();
}

function removeData(chart, dataSetIndex) {
    chart.data.labels.pop();
    chart.data.datasets[dataSetIndex].data.pop();
    chart.update();
}

function removeData(chart, dataSetIndex, removalIndex) {
    if(removalIndex >= 0) { //make sure this element exists in the array
        data.datasets[dataSetIndex].data.splice(removalIndex, 1);
        chart.data.labels.splice(removalIndex, 1);
        chart.update();
    }
}
