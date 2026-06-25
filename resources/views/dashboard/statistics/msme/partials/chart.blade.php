<x-cards.chart-card id="chart-umkm" :title="$currentType->title() ? $currentType->title() : 'Statistik Ekonomi UMKM Tematik'" :subtitle="ucfirst(str_replace('_', ' ', $currentType->value)) . ' — Data Agregat Kelurahan'" :chart-data="$chartData" :chart-labels="$chartLabels"
    :chart-type="$chartType" :req-type="request('type')" />


@push('scripts')
<script>
    if (!window.msmeChartComponentInitialized) {
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

                        const msmeType = window.msmeType || {};
                        let options = {};
                        
                        // Pengecekan data kosong untuk penanganan empty state pada canvas grafik
                        const isChartEmpty = this.chartData.every(val => val === 0);

                        switch (this.reqType) {
                            // 📊 Kelompok Jenis Chart BAR (Kategori Berderet / Klaster Sektoral)
                            case msmeType.businessSector:
                            case msmeType.ownerAge:
                            case msmeType.ownerEducation:
                            case msmeType.monthlyTurnover:
                            case msmeType.capitalSource:
                                options = {
                                    series: [{
                                        name: "Total Toko / UMKM",
                                        data: this.chartData,
                                    }],
                                    colors: window.AppColors?.umkmPalette || window
                                        .AppColors?.chartPalette || ['#059669'],
                                    xaxis: {
                                        categories: this.chartLabels,
                                    },
                                };
                                break;

                                // 🍩 Kelompok Jenis Chart DONUT / PIE (Proporsi Tunggal / Struktur Legalitas)
                            case msmeType.businessLocation:
                            case msmeType.legalStatus:
                            case msmeType.nibOwnership:
                            case msmeType.digitalTransaction:
                            case msmeType.digitalPlatform:
                            case msmeType.ecoFriendly:
                            case msmeType.bumdesPartnership:
                                options = {
                                    series: this.chartData,
                                    colors: window.AppColors?.umkmPalette || window
                                        .AppColors?.chartPalette || ['#059669',
                                            '#3b82f6', '#f59e0b', '#8b5cf6'
                                        ],
                                    labels: this.chartLabels,
                                };
                                break;

                            default:
                                options = {
                                    series: [{
                                        name: "Total Unit Usaha",
                                        data: this.chartData,
                                    }],
                                    colors: window.AppColors?.umkmPalette || window
                                        .AppColors?.chartPalette || ['#059669'],
                                    xaxis: {
                                        categories: this.chartLabels,
                                    },
                                };
                        }

                        window.ChartOptions = options;

                        // Eksekusi fungsi rendering engine global ApexCharts
                        switch (chartType) {
                            case "bar":
                                if (typeof renderBarChart === "function") {
                                    renderBarChart(element, window.ChartOptions);
                                }
                                break;
                            case "donut":
                                if (typeof renderDonutChart === "function") {
                                    renderDonutChart(element, window.ChartOptions);
                                }
                                break;
                        }
                    });
                },
            }));
        });
        window.msmeChartComponentInitialized = true;
    }
</script>
@endpush
