<x-cards.chart-card
    id="chart-health"
    :title="$currentType->labels() ? $currentType->title() : 'Statistik Tematik'"
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
                const element = document.querySelector(`#${this.chartId}`);
                if (!element) return;

                console.log({
                    chartId: this.chartId,
                    chartData: this.chartData,
                    chartLabels: this.chartLabels
                })

                const healthType = window.healthType;
                let options = {};

                const isChartEmpty = this.chartData.every(val => val === 0)

                switch (this.reqType) {

                    case healthType.bpjsStatus:
                        options = {
                            series: [{
                                name: "Total KK / Warga",
                                data: this.chartData,
                            }],
                            colors: window.AppColors.chartPalette,
                            xaxis: {
                                categories: this.chartLabels,
                            },
                        };
                        break;

                    case healthType.stuntingStatus:
                    case healthType.nutritionalStatus:
                    case healthType.pregnancy:
                    case healthType.familyPlanning:
                    case healthType.bloodType:
                    case healthType.disability:
                        options = {
                            series: this.chartData,
                            colors: window.AppColors.chartPalette,
                            labels: this.chartLabels,
                        };
                        break;

                    default:
                        options = {
                            series: [{
                                name: "Total",
                                data: this.chartData,
                            }],
                            colors: window.AppColors.chartPalette,
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
                        renderDonutChart(element, window.ChartOptions);
                        break;
                }
            },
        }));
    });
</script>
@endpush