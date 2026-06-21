<x-layouts.dashboard>
    <div class="space-y-6">
        <div class="flex items-center gap-4 pb-6 mb-10 border-b border-slate-200">
            <x-bi-shop class="p-3 rounded-md size-12 bg-primary/20 text-primary" />
            <div>
                <h3 class="text-xl font-bold">Data Spasial</h3>
                <p class="text-slate-600">Sebaran geografis Desa Sukaraja</p>
            </div>
        </div>

        <div class="flex flex-col mb-10 border-b rounded-lg shadow-lg border-slate-200">
            <div class="flex items-center justify-between w-full p-6">
                <div>
                    <h3 class="text-xl font-bold">Peta Sebaran</h3>
                    <p class="text-slate-600">Visualisasi Rumah Tangga</p>
                </div>

                <div class="flex items-center gap-1 px-4 py-2 text-xs font-semibold text-white bg-blue-600 rounded-full">
                    0
                    <span>Rumah Terpetakan</span>
                </div>
            </div>

            <div class="w-full">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.267741903397!2d108.48172981082516!3d-6.977702968299005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f1428587a5367%3A0x95d977de1597f6a!2sDinas%20Komunikasi%20dan%20Informatika%20Kabupaten%20Kuningan!5e0!3m2!1sid!2sid!4v1779004954240!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="w-full"></iframe>
            </div>
        </div>
    </div>


    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                series: [40, 20, 20, 20],
                labels: [
                    'Penyediaan Akomodasi dan Makan Minum',
                    'Perdagangan (Grosir / Eceran)',
                    'Industri Pengolahan',
                    'Jasa Lainnya'
                ],
                chart: {
                    type: 'donut',
                    height: 450,
                    toolbar: {
                        show: false
                    },
                    fontFamily: 'Inter, sans-serif'
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total',
                                    fontFamily: 'Inter, sans-serif',
                                    fontWeight: 600
                                }
                            }
                        }
                    }
                },
                colors: [
                    '#6366f1',
                    '#38bdf8',
                    '#fbbf24',
                    '#f87171'
                ],
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val.toFixed(1) + "%"
                    }
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['#fff']
                },
                legend: {
                    position: 'bottom',
                    horizontalAlign: 'center',
                    markers: {
                        radius: 12
                    }
                }
            };

            const chart = new window.ApexCharts(document.querySelector("#chart-msme"), options);
            chart.render();
        });
    </script>
    @endpush
</x-layouts.dashboard>
