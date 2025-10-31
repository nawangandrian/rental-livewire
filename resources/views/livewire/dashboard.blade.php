<div class="flex flex-col gap-6 p-6">

    {{-- Statistik Ringkas --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <x-dashboard-card title="Total Customers" :value="$totalCustomers" icon="users" color="blue" />
        <x-dashboard-card title="Total Items" :value="$totalItems" icon="box" color="green" />
        <x-dashboard-card title="Active Rentals" :value="$activeRentals" icon="handshake" color="yellow" />
        <x-dashboard-card title="Revenue" :value="number_format($totalRevenue,0,',','.')" icon="money-bill-wave" color="red" />
    </div>

    {{-- Tabel Rental Terbaru --}}
    <div class="p-6 bg-white rounded-xl shadow border border-gray-200 dark:bg-gray-800 dark:border-gray-700 overflow-x-auto">
        <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Latest Rentals</h2>
        <table class="min-w-full text-sm text-gray-700 dark:text-gray-300">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="border px-3 py-2 text-left">#</th>
                    <th class="border px-3 py-2 text-left">Customer</th>
                    <th class="border px-3 py-2 text-left">Item</th>
                    <th class="border px-3 py-2 text-left">Rent Date</th>
                    <th class="border px-3 py-2 text-left">Return Date</th>
                    <th class="border px-3 py-2 text-right">Total</th>
                    <th class="border px-3 py-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latestRentals as $rental)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="border px-3 py-2">{{ $rental->rental_id }}</td>
                        <td class="border px-3 py-2">{{ $rental->customer->name }}</td>
                        <td class="border px-3 py-2">{{ $rental->item->item_name }}</td>
                        <td class="border px-3 py-2">{{ $rental->rent_date }}</td>
                        <td class="border px-3 py-2">{{ $rental->return_date ?? '-' }}</td>
                        <td class="border px-3 py-2 text-right">Rp {{ number_format($rental->total_price,0,',','.') }}</td>
                        <td class="border px-3 py-2">
                            <span class="px-2 py-1 rounded text-xs font-medium {{ $rental->status=='rented' ? 'bg-yellow-500 text-white' : 'bg-green-600 text-white' }}">
                                {{ ucfirst($rental->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center p-4 text-gray-500 dark:text-gray-400">No rentals yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Grafik Rentals Terbaru --}}
    <div class="p-6 bg-white rounded-xl shadow border border-gray-200 dark:bg-gray-800 dark:border-gray-700" wire:ignore>
        <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Rental Trend (7 Days)</h2>
        {{--  <p>Labels: {{ json_encode($rentalChartLabels) }}</p>
        <p>Data: {{ json_encode($rentalChartData) }}</p>
        <p style="color:red;">Canvas size: <span id="canvas-size"></span></p>--}}
        <div class="relative w-full" style="height: 300px;">
        <canvas id="rentalChart"></canvas>
        </div>
    </div>



<script>
document.addEventListener('livewire:load', () => {
    const canvas = document.getElementById('rentalChart');
    if (canvas) {
        const rect = canvas.getBoundingClientRect();
    console.log(`Canvas size: ${rect.width}px x ${rect.height}px`);
        document.getElementById('canvas-size').textContent = `${rect.width}px x ${rect.height}px`;
    }
});
</script>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('rentalChart');
    const sizeInfo = document.getElementById('canvas-size');

    if (!canvas) {
        console.error("❌ Tidak ditemukan elemen canvas dengan id='rentalChart'");
        if (sizeInfo) sizeInfo.textContent = '❌ Canvas element not found';
        return;
    }

    // Pastikan parent div punya tinggi
    const parent = canvas.parentElement;
    if (parent && parent.offsetHeight === 0) {
        parent.style.height = '300px';
    }

    function updateCanvasInfo() {
        const rect = canvas.getBoundingClientRect();
        if (sizeInfo) sizeInfo.textContent = `${rect.width}px x ${rect.height}px`;
        console.log('📏 Canvas size:', rect.width, 'x', rect.height);
        return rect;
    }

    let rect = updateCanvasInfo();

    if (rect.width === 0 || rect.height === 0) {
        console.warn('⚠️ Canvas masih belum punya ukuran. Menunggu resize...');
    }

    const observer = new ResizeObserver(() => {
        rect = updateCanvasInfo();
        if (rect.width > 0 && rect.height > 0) {
            observer.disconnect();
            console.log('✅ Canvas siap, membuat chart...');

            try {
                const ctx = canvas.getContext('2d');
                const labels = @json($rentalChartLabels);
                const data = @json($rentalChartData);

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Rentals',
                            data: data,
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            borderColor: 'rgba(255, 159, 64, 1)',
                            borderWidth: 2,
                            tension: 0.4,
                            fill: true,
                            pointRadius: 5,
                            pointBackgroundColor: 'rgba(255, 159, 64, 1)',
                            pointBorderColor: '#fff',
                            pointHoverRadius: 7,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
                    }
                });
                console.log('✅ Chart berhasil dibuat.');
            } catch (err) {
                console.error('❌ Gagal membuat Chart.js:', err);
                if (sizeInfo) sizeInfo.textContent += ' | ❌ Error (lihat console)';
            }
        }
    });

    observer.observe(canvas);
});
</script>
@endpush
