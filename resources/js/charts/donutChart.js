import ApexCharts from "apexcharts";

export const renderDonutChart = (element, data, labels, series, colors) => {
    var options = {
        series: series,
        labels: labels,
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
        colors: colors,
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
