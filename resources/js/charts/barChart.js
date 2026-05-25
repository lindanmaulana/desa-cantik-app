import ApexCharts from "apexcharts";

export const renderBarChart = (element, data, labels, series, colors) => {
    var options = {
        series: series,
        chart: {
            type: "bar",
            height: 400,
            toolbar: {
                show: false,
            },
            fontFamily: "Inter, sans-serif",
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "55%",
                borderRadius: 8,
                dataLabels: {
                    position: "top",
                },
            },
        },
        colors: colors,
        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: true,
            width: 5,
            colors: ["transparent"],
        },
        xaxis: {
            categories: labels,
            axisBorder: {
                show: false,
            },
        },
        fill: {
            opacity: 1,
        },
        legend: {
            position: "bottom",
            markers: {
                radius: 12,
            },
        },
        grid: {
            borderColor: "#f1f1f1",
        },
    };

    const chart = new ApexCharts(element, options);

    chart.render();
};
