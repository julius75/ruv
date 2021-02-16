// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

function drawEngagementGraph(elementId, chartType, labels, datasets, unit, maxTicksLimitX, maxTicksLimitY, maxY,maxYCount){
    // Bar Chart Example
    var ctx = document.getElementById(elementId);
    // ctx.height = 500;
    var myBarChart
    if(window.myLineChart != undefined)
        window.myLineChart.destroy();
    window.myLineChart = new Chart(ctx, {
        type: chartType,
        data: {
            labels: labels,
            datasets: datasets,
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 10,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    categoryPercentage: 0.8,
                    barPercentage: 1.0,
                    time: {
                        unit: unit
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxRotation: 50,
                        minRotation: 30,
                        padding: 10,
                        autoSkip: false,
                        fontSize: 10,
                        min: 0,
                        maxTicksLimit: 7
                    },
                    maxBarThickness: 100,
                }],
                yAxes: [{
                    id: 'A',
                    position: 'left',
                    ticks: {
                        min: 0,
                        max: maxY,
                        maxTicksLimit: maxTicksLimitY,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return number_format(value);
                        }
                    },
                    gridLines: {
                        display:true
                    }
                },
                    {
                        id: 'B',
                        position: 'right',
                        ticks: {
                            min: 0,
                            max: maxYCount,
                            maxTicksLimit: maxTicksLimitY,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return number_format(value);
                            }
                        },
                        gridLines: {
                            display:false
                        }
                    }
                ],
            },
            legend: {
                display: true
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                    }
                }
            },
        }
    });

}
