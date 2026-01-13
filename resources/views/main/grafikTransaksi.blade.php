<x-layout>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5 class="mb-0">Pemasukan vs Pengeluaran</h5>
                    <p class="text-sm mb-0">
                        Perbandingan bulanan untuk melihat selisih
                    </p>
                </div>
                <div class="card-body">
                    <canvas id="chartSelisih" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- PENGELUARAN --}}
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h5 class="mb-0">Grafik Pengeluaran</h5>
                    <p class="text-sm mb-0">Rekap pengeluaran berdasarkan item masuk</p>
                </div>
                <div class="card-body">
                    <canvas id="chartPengeluaran" height="120"></canvas>
                </div>
            </div>
        </div>

        {{-- PEMASUKAN --}}
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h5 class="mb-0">Grafik Pemasukan</h5>
                    <p class="text-sm mb-0">Order dengan status confirmed</p>
                </div>
                <div class="card-body">
                    <canvas id="chartPemasukan" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // ===== PENGELUARAN =====
        new Chart(document.getElementById('chartPengeluaran'), {
            type: 'line',
            data: {
                labels: @json($labelsPengeluaran),
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

        // ===== PEMASUKAN =====
        new Chart(document.getElementById('chartPemasukan'), {
            type: 'line',
            data: {
                labels: @json($labelsPemasukan),
                datasets: [{
                    label: 'Pemasukan',
                    data: @json($dataPemasukan),
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

    <script>
        new Chart(document.getElementById('chartSelisih'), {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                        label: 'Pemasukan',
                        data: @json($pemasukanFix),
                        borderWidth: 2,
                        tension: 0.4,
                        fill: false
                    },
                    {
                        label: 'Pengeluaran',
                        data: @json($pengeluaranFix),
                        borderWidth: 2,
                        tension: 0.4,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


</x-layout>
