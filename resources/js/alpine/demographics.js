document.addEventListener("alpine:init", () => {
    Alpine.data("chartComponent", (id, chartType, data, labels) => ({
        chartId: id,
        chartData: data,
        chartLabels: labels,

        reqType: "{{ request('type') }}",
        reqRw: "{{ request('rw') }}",

        initChart() {
            this.$nextTick(() => {
                const element = document.querySelector(`#${this.chartId}`);
                if (!element) return;

                console.log({ id, chartType, data, labels });

                const demoType = window.demographicsType;
                let options = {};

                switch (this.reqType) {
                    case demoType.ageGroup:
                        options = {
                            series: [
                                {
                                    name: "Jumlah",
                                    data: this.chartData,
                                },
                            ],
                            xaxis: {
                                categories: this.chartLabels,
                            },
                        };
                        break;

                    case demoType.gender:
                        options = {
                            series: [
                                Number(this.chartData.male ?? 0),
                                Number(this.chartData.female ?? 0),
                            ],
                            colors: [
                                window.AppColors.primary,
                                window.AppColors.secondary,
                            ],
                            xaxis: this.chartLabels,
                        };
                        break;

                    case demoType.maritalStatus:
                        options = {
                            series: this.chartData,
                            xaxis: this.chartLabels,
                        };
                        break;

                    case demoType.territory:
                        const labels = this.reqRw ? "RT" : "RW";
                        options = {
                            series: [
                                {
                                    name: "Jumlah Warga",
                                    data: this.chartData,
                                },
                            ],
                            colors: [
                                window.AppColors.primary,
                                window.AppColors.secondary,
                            ],
                            xaxis: {
                                type: "category",
                                categories: this.chartLabels.map((region) =>
                                    region === "Tidak Diisi"
                                        ? region
                                        : `${labels} ${region}`,
                                ),
                            },
                        };
                        break;

                    case demoType.citizenStatus:
                        options = {
                            series: [
                                {
                                    name: "Jumlah",
                                    data: this.chartData,
                                },
                            ],
                            colors: window.AppColors.chartPalette,
                            xaxis: {
                                categories: this.chartLabels,
                            },
                        };
                        break;

                    default:
                        options = {
                            series: [
                                {
                                    name: "Laki-laki",
                                    data: [],
                                },
                                {
                                    name: "Perempuan",
                                    data: [],
                                },
                            ],
                            colors: window.AppColors.chartPalette,
                            xaxis: {
                                categories: ["Laki-laki", "Perempuan"],
                            },
                        };
                }

                window.ChartOptions = options;
                switch (chartType) {
                    case "bar":
                        renderBarChart(element, window.ChartOptions);
                        break;
                    case "donut":
                        renderDonutChart(element, data, window.ChartOptions);
                        break;
                }
            });
        },
    }));
});
