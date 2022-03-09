
$(function() {
    "use strict";
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });
});

// UNIVERSITY REPORT
$(document).ready(function() {
    var options = {
        chart: {
            height: 350,
            type: 'line',
            toolbar: {
                show: false,
            },
        },
        colors: ['#7568a7', '#fed284'],
        series: [{
            name: 'Fees',
            type: 'column',
            data: [440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160]
        }, {
            name: 'Donation',
            type: 'line',
            data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16]
        }],
        stroke: {
            width: [0, 4]
        },        
        // labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        labels: ['01 Jan 2001', '02 Jan 2001', '03 Jan 2001', '04 Jan 2001', '05 Jan 2001', '06 Jan 2001', '07 Jan 2001', '08 Jan 2001', '09 Jan 2001', '10 Jan 2001', '11 Jan 2001', '12 Jan 2001'],
        xaxis: {
            type: 'datetime'
        },
        yaxis: [{
            title: {
                text: 'Fees',
            },

        }, {
            opposite: true,
            title: {
                text: 'Donation'
            }
        }]
    }
    var chart = new ApexCharts(
        document.querySelector("#apex-chart-line-column"),
        options
    );

    chart.render();
});


// RADAR MULTIPLE SERIES
$(document).ready(function() {
    var options = {
        chart: {
            height: 350,
            type: 'radar',
            dropShadow: {
                enabled: true,
                blur: 1,
                left: 1,
                top: 1
            }
        },
        colors: ['#17a2b8', '#6435c9', '#45aaf2'],
        series: [{
            name: 'Sales',
            data: [80, 50, 30, 40, 100, 20],
        }, {
            name: 'Income',
            data: [20, 30, 40, 80, 20, 80],
        }, {
            name: 'Expense',
            data: [44, 76, 78, 13, 43, 10],
        }],
        stroke: {
            width: 0
        },
        fill: {
            opacity: 0.4
        },
        markers: {
            size: 0
        },
        labels: ['Jan', 'Feb', 'March', 'April', 'May', 'Jun']
    }

    var chart = new ApexCharts(
        document.querySelector("#apex-radar-multiple-series"),
        options
    );

    chart.render();
    function update() {

        function randomSeries() {
            var arr = []
            for(var i = 0; i < 6; i++) {
                arr.push(Math.floor(Math.random() * 100)) 
            }

            return arr
        }       

        chart.updateSeries([{
            name: 'Sales',
            data: randomSeries(),
        }, {
            name: 'Income',
            data: randomSeries(),
        }, {
            name: 'Expense',
            data: randomSeries(),
        }])
    }
});
