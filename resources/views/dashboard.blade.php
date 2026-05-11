<x-app-layout>

    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 py-10 px-6">

        <div class="max-w-6xl mx-auto">

            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-extrabold text-white">
                    Sales Analytics Dashboard
                </h1>

                <p class="text-slate-300 mt-2">
                    Monitor your monthly business performance in real-time.
                </p>
            </div>

            <!-- Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <div class="bg-white/10 backdrop-blur-lg border border-white/10 p-6 rounded-2xl shadow-xl">
                    <h3 class="text-slate-300 text-sm uppercase">
                        Total Months
                    </h3>

                    <p class="text-4xl font-bold text-cyan-400 mt-3">
                        {{ count($labels) }}
                    </p>
                </div>

                <div class="bg-white/10 backdrop-blur-lg border border-white/10 p-6 rounded-2xl shadow-xl">
                    <h3 class="text-slate-300 text-sm uppercase">
                        Highest Sale
                    </h3>

                    <p class="text-4xl font-bold text-emerald-400 mt-3">
                        ₱{{ number_format(max($data->toArray()), 2) }}
                    </p>
                </div>

                <div class="bg-white/10 backdrop-blur-lg border border-white/10 p-6 rounded-2xl shadow-xl">
                    <h3 class="text-slate-300 text-sm uppercase">
                        Revenue Growth
                    </h3>

                    <p class="text-4xl font-bold text-pink-400 mt-3">
                        +24%
                    </p>
                </div>

            </div>

            <!-- Chart Container -->
            <div class="bg-white/10 backdrop-blur-lg border border-white/10 rounded-3xl p-8 shadow-2xl">

                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-white">
                            Monthly Revenue Report
                        </h2>

                        <p class="text-slate-300 text-sm">
                            Interactive visualization of sales trends.
                        </p>
                    </div>
                </div>

                <div class="h-[500px]">
                    <canvas id="salesChart"></canvas>
                </div>

            </div>

        </div>

    </div>

    @vite(['resources/js/app.js'])

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const ctx = document.getElementById('salesChart');

            const labels = @json($labels);
            const data = @json($data);

            new Chart(ctx, {
                type: 'bar',

                data: {
                    labels: labels,

                    datasets: [{
                        label: 'Monthly Sales',

                        data: data,

                        borderWidth: 2,

                        borderRadius: 12,

                        backgroundColor: [
                            '#06b6d4',
                            '#3b82f6',
                            '#6366f1',
                            '#8b5cf6',
                            '#d946ef',
                            '#ec4899'
                        ],

                        borderColor: '#ffffff',
                        hoverBorderWidth: 3,
                    }]
                },

                options: {
                    responsive: true,
                    maintainAspectRatio: false,

                    plugins: {
                        legend: {
                            labels: {
                                color: '#ffffff',
                                font: {
                                    size: 14
                                }
                            }
                        }
                    },

                    scales: {
                        x: {
                            ticks: {
                                color: '#e2e8f0'
                            },

                            grid: {
                                color: 'rgba(255,255,255,0.05)'
                            }
                        },

                        y: {
                            beginAtZero: true,

                            ticks: {
                                color: '#e2e8f0'
                            },

                            grid: {
                                color: 'rgba(255,255,255,0.05)'
                            }
                        }
                    }
                }
            });

        });
    </script>

</x-app-layout>