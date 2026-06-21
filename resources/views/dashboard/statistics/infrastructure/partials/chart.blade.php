<x-cards.chart-card
    id="chart-infrastructure"
    :title="$currentType->title() ? $currentType->title() : 'Statistik Infrastruktur Tematik'"
    :subtitle="ucfirst(str_replace('_', ' ', $currentType->value)) . ' — Data Agregat Kelurahan'"
    :chart-data="$chartData"
    :chart-labels="$chartLabels"
    :chart-type="$chartType"
    :req-type="request('type')" />

@push('scripts')
<script>
    if (!window.infrastructureChartComponentInitialized) {
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

                        const infraType = window.infrastructureType || {};
                        let options = {};

                        switch (this.reqType) {
                            // 📊 Grouping Chart BAR (Menggunakan format Array of Object)
                            case infraType.constructionYear:
                                options = {
                                    series: [{
                                        name: "Total Unit Fasilitas",
                                        data: this.chartData,
                                    }],
                                    colors: window.AppColors?.infrastructurePalette || window.AppColors?.chartPalette || ['#2563eb'],
                                    xaxis: {
                                        categories: this.chartLabels,
                                    },
                                };
                                break;

                                // 🍩 Grouping Chart DONUT (Menggunakan format Array angka murni langsung)
                            case infraType.facilityType:
                            case infraType.condition:
                                options = {
                                    series: this.chartData,
                                    colors: window.AppColors?.infrastructurePalette || window.AppColors?.chartPalette || ['#10b981', '#f59e0b', '#ef4444'],
                                    labels: this.chartLabels,
                                };
                                break;

                            default:
                                options = {
                                    series: [{
                                        name: "Total Unit Fasilitas",
                                        data: this.chartData,
                                    }],
                                    colors: window.AppColors?.infrastructurePalette || window.AppColors?.chartPalette || ['#2563eb'],
                                    xaxis: {
                                        categories: this.chartLabels,
                                    },
                                };
                        }

                        window.ChartOptions = options;

                        switch (chartType) {
                            case "bar":
                                if (typeof renderBarChart === "function") {
                                    renderBarChart(element, window.ChartOptions);
                                }
                                break;
                            case "donut":
                                if (typeof renderDonutChart === "function") {
                                    renderDonutChart(element, this.chartData, window.ChartOptions);
                                }
                                break;
                        }
                    });
                },
            }));
        });


        window.infrastructureChartComponentInitialized = true;
    }
</script>
@endpush
