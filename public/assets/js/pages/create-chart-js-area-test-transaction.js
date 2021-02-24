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

function drawEngagementGraphAreaTransactions(data){
    var ctx = document.getElementById("chart-transaction");
    // ctx.height = 500;
    var myBarChart;
    myBarChart = new Chart(ctx, {
        type: 'area',
        data: {
            labels: data.labels,
            datasets: [
                {
                    label: "Users",
                    type: 'line',
                    lineTension: 0.3,
                    backgroundColor: "#1BC5BD",
                    borderColor: "#f9141b",
                    pointBorderColor: "#fff",
                    pointBackgroundColor: "#f9141b",
                    pointRadius: 5,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#f9141b",
                    pointHitRadius: 20,
                    pointBorderWidth: 2,
                    data: data.comments
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            sparkline: {
                enabled: true
            },
            fill: {
                type: 'solid',
                opacity: .2
            },
            legend: { display: false },
            scales: {
                xAxes: [{
                    display:false,
                    gridLines: {
                        display: false
                    },
                    tooltip: {
                        enabled: true,
                        offsetY: 0,
                        style: {
                            fontSize: '12px',
                        }
                    }

                }],
                yAxes: [{
                    display:false,
                    gridLines: {
                        display:false
                    },
                    ticks: {
                        min: 0,
                        max: data.max_Y_axis,
                        maxTicksLimit: 10,
                        padding: 10,
                    },
                },
                ],
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
                caretPadding: 5,
                style: {
                    fontSize: '12px',
                },
            },
        }
    });

}
