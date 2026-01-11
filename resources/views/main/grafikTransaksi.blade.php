<x-layout>


    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header pb-0">
                    <h5 class="mb-0">Grafik Pengeluaran</h5>
                    <p class="text-sm mb-0">
                        Rekap pengeluaran berdasarkan item masuk
                    </p>
                </div>

                <div class="card-body">
                    <canvas id="chartPengeluaran" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('chartPengeluaran');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Pengeluaran',
                    data: @json($dataPengeluaran),
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-layout>
