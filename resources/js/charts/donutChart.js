import ApexCharts from "apexcharts";

export const renderDonutChart = (element, chartOptions) => {
    var options = {
        series: chartOptions.series,
        labels: chartOptions.labels,
        chart: {
            type: "donut",
            height: 500,
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
