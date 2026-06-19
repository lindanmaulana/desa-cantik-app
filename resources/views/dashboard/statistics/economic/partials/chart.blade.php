<x-cards.chart-card
    id="chart-economic"
    :title="$currentType->labels() ? $currentType->title() : 'Statistik Ekonomi Tematik'"
    :subtitle="ucfirst(str_replace('_', ' ', $currentType->title())) . ' — Data Agregat Kelurahan'"
    :chart-data="$chartData"
    :chart-labels="$chartLabels"
    :chart-type="$chartType"
    :req-type="request('type')" />

@push('scripts')
<script>
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

                    const economicType = window.economicType || {};
                    let options = {};

                    const isChartEmpty = this.chartData.every(val => val === 0);

                    switch (this.reqType) {
                        // Kelompok Jenis Chart BAR (Kategori Berderet)
                        case economicType.occupation:
                        case economicType.jobSector:
                        case economicType.employmentStatus:
                            options = {
                                series: [{
                                    name: "Total KK / Warga",
                                    data: this.chartData,
                                }],
                                colors: window.AppColors.economicPalette || window.AppColors.chartPalette,
                                xaxis: {
                                    categories: this.chartLabels,
                                },
                            };
                            break;

                            // Kelompok Jenis Chart DONUT / PIE (Proporsi Tunggal)
                        case economicType.houseOwnership:
                        case economicType.floorMaterial:
                        case economicType.wallMaterial:
                        case economicType.roofMaterial:
                        case economicType.cookingFuel:
                        case economicType.electricitySource:
                        case economicType.electricityCapacity:
                        case economicType.economicStatus:
                            options = {
                                series: this.chartData,
                                colors: window.AppColors.economicPalette || window.AppColors.chartPalette,
                                xaxis: this.chartLabels,
                            };
                            break;

                        default:
                            options = {
                                series: [{
                                    name: "Total",
                                    data: this.chartData,
                                }],
                                colors: window.AppColors.economicPalette || window.AppColors.chartPalette,
                                xaxis: {
                                    categories: this.chartLabels,
                                },
                            };
                    }

                    window.ChartOptions = options;

                    switch (chartType) {
                        case "bar":
                            renderBarChart(element, window.ChartOptions);
                            break;
                        case "donut":
                            renderDonutChart(element, this.chartData, window.ChartOptions);
                            break;
                    }
                });
            },
        }));
    });
</script>
@endpush
