<div class="p-6 max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">📦 Manajemen Rental</h1>

    {{-- Notifikasi sukses --}}
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-5 text-center shadow-sm">
            {{ session('message') }}
        </div>
    @endif

    {{-- FORM TAMBAH / EDIT --}}
    <div class="bg-white shadow rounded-lg p-5 mb-8 border border-gray-200">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">
            {{ $updateMode ? '✏️ Edit Rental' : '➕ Tambah Rental Baru' }}
        </h2>

        <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Select Customer --}}
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Customer</label>
                <select wire:model="customer_id" class="select select-bordered w-full">
                    <option value="">Pilih Customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->customer_id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
                @error('customer_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            {{-- Select Item --}}
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Item</label>
                <select wire:model="item_id" class="select select-bordered w-full">
                    <option value="">Pilih Item</option>
                    @foreach($items as $item)
                        <option value="{{ $item->item_id }}">{{ $item->item_name }} - Rp {{ number_format($item->price_per_day, 0, ',', '.') }}/hari</option>
                    @endforeach
                </select>
                @error('item_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            {{-- Rent Date --}}
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Sewa</label>
                <input type="date" wire:model="rent_date" class="input input-bordered w-full">
            </div>

            {{-- Return Date --}}
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Kembali</label>
                <input type="date" wire:model="return_date" class="input input-bordered w-full">
            </div>

            {{-- Total Price --}}
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Total Harga</label>
                <input type="number" wire:model="total_price" placeholder="Total Price" class="input input-bordered w-full bg-gray-100" readonly />
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                <select wire:model="status" class="select select-bordered w-full">
                    <option value="rented">Sedang Disewa</option>
                    <option value="returned">Sudah Dikembalikan</option>
                </select>
            </div>

            {{-- Tombol Aksi --}}
            <div class="col-span-full flex space-x-3 mt-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
                    {{ $updateMode ? '💾 Update' : '💾 Simpan' }}
                </button>
                @if ($updateMode)
                    <button type="button" wire:click="resetInput" class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">
                        Batal
                    </button>
                @endif
            </div>
        </form>
    </div>

    {{-- TABEL RENTAL --}}
    <div class="bg-white shadow rounded-lg border border-gray-200 overflow-x-auto">
        <table class="min-w-full text-sm text-gray-700">
            <thead class="bg-gray-100">
                <tr class="text-gray-700">
                    <th class="border p-3">#</th>
                    <th class="border p-3">Customer</th>
                    <th class="border p-3">Item</th>
                    <th class="border p-3">Tanggal Sewa</th>
                    <th class="border p-3">Tanggal Kembali</th>
                    <th class="border p-3">Total</th>
                    <th class="border p-3">Status</th>
                    <th class="border p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rentals as $rental)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="border p-2 text-center">{{ $rental->rental_id }}</td>
                        <td class="border p-2">{{ $rental->customer->name }}</td>
                        <td class="border p-2">{{ $rental->item->item_name }}</td>
                        <td class="border p-2 text-center">{{ $rental->rent_date }}</td>
                        <td class="border p-2 text-center">{{ $rental->return_date ?? '-' }}</td>
                        <td class="border p-2 text-right">Rp{{ number_format($rental->total_price, 0, ',', '.') }}</td>
                        <td class="border p-2 text-center">
                            <span class="px-2 py-1 rounded text-white text-xs 
                                {{ $rental->status === 'rented' ? 'bg-yellow-500' : 'bg-green-600' }}">
                                {{ ucfirst($rental->status) }}
                            </span>
                        </td>
                        <td class="border p-2 text-center space-x-2">
                            <button wire:click="edit({{ $rental->rental_id }})"
                                class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs">
                                Edit
                            </button>
                            <button wire:click="delete({{ $rental->rental_id }})"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-gray-500 p-4">Belum ada data rental.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
