<div class="p-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">CRUD Customers</h1>

    {{-- Notifikasi sukses --}}
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    {{-- Form Tambah / Edit --}}
    <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" class="mb-6 space-y-3">
        <input type="text" wire:model="name" placeholder="Nama" class="border p-2 rounded w-full">
        <input type="text" wire:model="phone" placeholder="Telepon" class="border p-2 rounded w-full">
        <input type="email" wire:model="email" placeholder="Email" class="border p-2 rounded w-full">
        <textarea wire:model="address" placeholder="Alamat" class="border p-2 rounded w-full"></textarea>

        <div class="flex items-center space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ $updateMode ? 'Update' : 'Tambah' }}
            </button>

            @if ($updateMode)
                <button type="button" wire:click="resetInput" class="bg-gray-500 text-white px-4 py-2 rounded">
                    Batal
                </button>
            @endif
        </div>
    </form>

    {{-- Tabel Data Customer --}}
    <table class="min-w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">ID</th>
                <th class="border p-2">Nama</th>
                <th class="border p-2">Telepon</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Alamat</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($customers as $c)
                <tr>
                    <td class="border p-2 text-center">{{ $c->customer_id }}</td>
                    <td class="border p-2">{{ $c->name }}</td>
                    <td class="border p-2">{{ $c->phone }}</td>
                    <td class="border p-2">{{ $c->email }}</td>
                    <td class="border p-2">{{ $c->address }}</td>
                    <td class="border p-2 text-center">
                        <button wire:click="edit({{ $c->customer_id }})" class="text-yellow-600 hover:underline mr-2">
                            Edit
                        </button>
                        <button wire:click="delete({{ $c->customer_id }})" class="text-red-600 hover:underline">
                            Hapus
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center p-3 text-gray-500">Belum ada data pelanggan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
