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

function drawEngagementGraphAreaUsers(data){
    if (
        window.myLines !== undefined
        &&
        window.myLines !== null
    ) {
        window.myLines.destroy();
    }
    var ctx = document.getElementById("chart-users");
    // ctx.height = 500;
    window.myLines= new Chart(ctx, {
        type: 'area',
        data: {
            labels: data.labels_users,
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
                    data: data.categories_users
                }
            ]
        },
        options: {
            sparkline: {
                enabled: true
            },
            legend: { display: false },
            maintainAspectRatio: false,
            scales: {
                xAxes: [{
                    display:false,
                    categoryPercentage: 0.8,
                    barPercentage: 1.0,
                    gridLines: {
                        display: false
                    },
                    tooltip: {
                        enabled: true,
                        formatter: undefined,
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
                    }
                },
                ],
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
            },
            fill: {
                type: 'solid',
                opacity: 1,
                colors: ['#1BC5BD']
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
