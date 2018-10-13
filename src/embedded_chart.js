"use strict";

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
    }
};

let lineChart = Chart.Line("myChart", {
    options: options,
    data: data
});

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
    addData(lineChart, 0, jdata.x, jdata.y);
})

eventSource.addEventListener("init", function (event) {
    let jdata = JSON.parse(event.data);
    lineChart.reset()
    addData(lineChart, 0, jdata.x, jdata.y);

    // let jdata = JSON.parse(event.data);
    // console.log(jdata);
})

function addData(chart, dataSetIndex, label, data) {
    chart.data.labels.push(label);
    chart.data.datasets[dataSetIndex].data.push(data);
    chart.update();
}

function removeData(chart, dataSetIndex) {
    chart.data.labels.pop();
    chart.data.datasets[dataSetIndex].data.pop();
    chart.update();
}

function removeData(chart, dataSetIndex, removalIndex) {
    if(removalIndex >= 0) { //make sure this element exists in the array
        data.datasets.splice(removalIndex, 1);
    }
}
