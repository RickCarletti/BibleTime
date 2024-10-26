var options = {
    series: [
        {
            data: [
                {
                    x: 'Adão',
                    y: [0, 930]
                },
                {
                    x: 'Sete',
                    y: [130, 1042]
                },
                {
                    x: 'Enos',
                    y: [235, 1140]
                },
                {
                    x: 'Cainã',
                    y: [325, 1235]
                },
                {
                    x: 'Maalalel',
                    y: [395, 1290]
                },
                {
                    x: 'Jarede',
                    y: [460, 1422]
                },
                {
                    x: 'Enoque',
                    y: [522, 887]
                },
                {
                    x: 'Metusalém',
                    y: [587, 1556]
                },
                {
                    x: 'Lameque',
                    y: [774, 1551]
                },
                {
                    x: 'Noé',
                    y: [956, 1906]
                }
            ]
        }
    ],
    chart: {
        height: 390,
        type: 'rangeBar',
        zoom: {
            enabled: false
        }
    },
    annotations: {
        xaxis: [
            {
                x: 1556,
                borderColor: '#ff0000',
                label: {
                    borderColor: '#ff0000',
                    style: {
                        color: '#fff',
                        background: '#ff0000'
                    },
                    text: '1556 - Dilúvio',
                    orientation: "horizontal"
                }
            }
        ]
    },
    colors: ['#36BDCB'],
    plotOptions: {
        bar: {
            horizontal: true
        }
    },
    dataLabels: {
        enabled: true,
        formatter: function (val) {
            return '[' + val[0] + ' - ' + val[1] + '] ' + (val[1] - val[0]) + ' anos';
        }
    },

    title: {
        text: 'Genealogia de Adão'
    },
    grid: {
        xaxis: {
            lines: {
                show: true
            }
        },
        yaxis: {
            lines: {
                show: false
            }
        }
    }
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();