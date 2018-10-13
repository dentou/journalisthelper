"use strict";

var data = {
<<<<<<< HEAD
    // labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
=======
    labels: ["2018-10-13 10:42:14", "2018-10-13 10:42:15", "2018-10-13 10:42:16", "2018-10-13 10:42:17", "2018-10-13 10:42:18", "2018-10-13 10:42:19", "2018-10-13 10:42:20"],
>>>>>>> a48bcd96e1e6d05c31829c0d82f67fec76ad76fa
    datasets: [{
        label: "Carbon footprints",
        backgroundColor: "rgba(255,99,132,0.2)",
        borderColor: "rgba(255,99,132,1)",
        borderWidth: 2,
        hoverBackgroundColor: "rgba(255,99,132,0.4)",
        hoverBorderColor: "rgba(255,99,132,1)",
<<<<<<< HEAD
        // data: [65, 59, 20, 81, 56, 55, 40],
=======
        data: [39, 44, 27, 33, 14, 37, 11],
    }]
};

var data2 = {
    labels: ["2018-10-13 10:42:14", "2018-10-13 10:42:15", "2018-10-13 10:42:16", "2018-10-13 10:42:17", "2018-10-13 10:42:18", "2018-10-13 10:42:19", "2018-10-13 10:42:20"],
    datasets: [{
        label: "Carbon footprints",
        backgroundColor: "rgba(255,99,132,0.2)",
        borderColor: "rgba(255,99,132,1)",
        borderWidth: 2,
        hoverBackgroundColor: "rgba(255,99,132,0.4)",
        hoverBorderColor: "rgba(255,99,132,1)",
        data: [11, 37, 14, 33, 27, 44, 39],
>>>>>>> a48bcd96e1e6d05c31829c0d82f67fec76ad76fa
    }]
};

var options = {
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

<<<<<<< HEAD
var lineChart = Chart.Line("myChart", {
    options: options,
    data: data
});
=======
var realData = data;

setInterval(function(){

    Chart.Line("myChart", {
        options: options,
        data: realData
    });

}, 1000);
>>>>>>> a48bcd96e1e6d05c31829c0d82f67fec76ad76fa
