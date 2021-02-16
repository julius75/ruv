// $( ".random" ).click(function( event ) {
//     event.preventDefault();
//     var date = document.getElementById('kt_datepicker_1_modal').value;
//    alert(date);
// });
( function ( $ ) {
    var charts = {
        init: function () {
            // -- Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            this.ajaxGetPostMonthlyData();

        },

        ajaxGetPostMonthlyData: function () {
            var urlPath =  APP_URL +'/admin/datatables/chart-data';
            var request = $.ajax( {
                method: 'GET',
                url: urlPath
            } );

            request.done( function ( response ) {
                console.log( response );
                charts.createCompletedJobsChart( response );
            });
        },

        /**
         * Created the Completed Jobs Chart
         */
        createCompletedJobsChart: function ( response ) {

            var ctx = document.getElementById("myAreaChart");
            var myLineChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: response.month, // The response got from the ajax request containing all month names in the database
                    datasets: [
                        {
                            label: "Transaction count",
                            yAxisID: 'B',
                            type: 'line',
                            lineTension: 0.3,
                            backgroundColor: "rgba(244,176,64,0.78)",
                            borderColor: "rgba(219,141,13, 0.8)",
                            pointBorderColor: "#fff",
                            pointBackgroundColor: "rgba(219,141,13, 0.8)",
                            pointRadius: 5,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(219,141,13, 0.8)",
                            pointHitRadius: 20,
                            pointBorderWidth: 2,
                            data: response.daily_count
                        }
                        ,{
                        label: 'Amount',
                        type: 'bar',
                        yAxisID: 'A',
                        backgroundColor: "rgba(111,163,58, 0.8)",
                        borderColor: "rgba(85,125,45, 0.8)",
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(111,163,58, 0.8)",
                        pointBorderColor: "rgba(255,255,255,0.8)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(111,163,58, 0.8)",
                        pointHitRadius: 20,
                        pointBorderWidth: 2,
                        data: response.post_count_data // The response got from the ajax request containing data for the completed jobs in the corresponding months
                    }
                    ],
                },
                options: {
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 7,
                                maxRotation: 50,
                                minRotation: 30,
                                padding: 10,
                                autoSkip: false,
                                fontSize: 10
                            }
                        }],
                        yAxes: [{
                            id: 'A',
                            position: 'left',
                            ticks: {
                                min: 0,
                                max: response.max, // The response got from the ajax request containing max limit for y axis
                                maxTicksLimit: 5
                            },
                            gridLines: {
                                color: "rgba(0, 0, 0, .125)",
                            }
                        }, {
                            id: 'B',
                            position: 'right',
                            ticks: {
                                max:response.max_daily,
                                min: 0,
                                maxTicksLimit: 5
                            },
                            gridLines: {
                                display:false
                            }
                        }],
                    },
                    legend: {
                        display: true
                    }
                }
            });
        }
    };

    charts.init();

} )( jQuery );
