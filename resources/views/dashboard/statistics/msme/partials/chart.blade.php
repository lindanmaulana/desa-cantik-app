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

                            const umkmType = window.umkmType || {};
                            let options = {};

                            // Pengecekan data kosong untuk penanganan empty state pada canvas grafik
                            const isChartEmpty = this.chartData.every(val => val === 0);

                            switch (this.reqType) {
                                // 📊 Kelompok Jenis Chart BAR (Kategori Berderet / Klaster Sektoral)
                                case umkmType.businessSector:
                                case umkmType.ownerAge:
                                case umkmType.ownerEducation:
                                case umkmType.monthlyTurnover:
                                case umkmType.capitalSource:
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
                                case umkmType.businessLocation:
                                case umkmType.legalStatus:
                                case umkmType.nibOwnership:
                                case umkmType.digitalTransaction:
                                case umkmType.digitalPlatform:
                                case umkmType.ecoFriendly:
                                case umkmType.bumdesPartnership:
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
                                        renderDonutChart(element, this.chartData, window
                                            .ChartOptions);
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
