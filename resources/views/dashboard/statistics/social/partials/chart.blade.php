<x-cards.chart-card
    id="chart-social"
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

                const socialType = window.socialType;
                let options = {};

                const isChartEmpty = this.chartData.every(val => val === 0)

                switch (this.reqType) {
                    case socialType.religion:
                    case socialType.educationLevel:
                    case socialType.familyPlanning:
                    case socialType.bpjsStatus:
                    case socialType.welfareAssistance:
                    case socialType.sanitation:
                    case socialType.waterSource:
                    case socialType.electricitySource:
                    case socialType.electricityCapacity:
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

                    case socialType.schoolParticipation:
                    case socialType.bloodType:
                    case socialType.disability:
                    case socialType.pregnancy:

                        options = {
                            series: this.chartData,
                            colors: window.AppColors.chartPalette,
                            xaxis: this.chartLabels,
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
                        renderDonutChart(element, this.chartData, window.ChartOptions);
                        break;
                }
            },
        }));
    });
</script>
@endpush
