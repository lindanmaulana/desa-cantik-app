import ApexCharts from "apexcharts";

export const renderDonutChart = (element, chartOptions) => {
    var options = {
        series: chartOptions.series,
        labels: chartOptions.labels,
        chart: {
            type: "donut",
            height: 500,
            animations: {
                enabled: true,
                easing: "easeinout",
                speed: 800,
                animateGradually: {
                    enabled: true,
                    delay: 120,
                },
                dynamicAnimation: {
                    enabled: true,
                    speed: 350,
                },
            },
        },
        plotOptions: {
            pie: {
                customScale: 0.8,
                donut: {
                    size: "45%",
                },
            },
        },
        colors: chartOptions.colors,
        dataLabels: {
            enabled: true,
        },
        legend: {
            position: "bottom",
        },
    };

    const chart = new ApexCharts(element, options);

    chart.render();
};
