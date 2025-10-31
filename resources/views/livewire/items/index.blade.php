

<div class="p-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">CRUD Items</h1>

    <form wire:submit.prevent="save" class="mb-6 space-y-3">
        <input type="text" wire:model="item_name" placeholder="Nama Barang" class="border p-2 rounded w-full">
        <input type="text" wire:model="category" placeholder="Kategori" class="border p-2 rounded w-full">
        <input type="number" wire:model="stock" placeholder="Stock" class="border p-2 rounded w-full">
        <input type="number" wire:model="price_per_day" placeholder="Harga/Hari" class="border p-2 rounded w-full">
        <textarea wire:model="description" placeholder="Deskripsi" class="border p-2 rounded w-full"></textarea>
        <label><input type="checkbox" wire:model="is_available"> Tersedia</label>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
    {{ $editId ?? false ? 'Update' : 'Tambah' }}
</button>

@if($editId ?? false)
    <button type="button" wire:click="resetForm" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
@endif

    </form>

    <table class="min-w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Nama</th>
                <th class="border p-2">Kategori</th>
                <th class="border p-2">Stock</th>
                <th class="border p-2">Harga/Hari</th>
                <th class="border p-2">Tersedia</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $i)
                <tr>
                    <td class="border p-2">{{ $i->item_name }}</td>
                    <td class="border p-2">{{ $i->category }}</td>
                    <td class="border p-2">{{ $i->stock }}</td>
                    <td class="border p-2">{{ number_format($i->price_per_day, 0, ',', '.') }}</td>
                    <td class="border p-2 text-center">{{ $i->is_available ? 'Ya' : 'Tidak' }}</td>
                    <td class="border p-2 text-center">
                        <button wire:click="edit({{ $i->item_id }})" class="text-yellow-600 hover:underline mr-2">Edit</button>
                        <button wire:click="delete({{ $i->item_id }})" class="text-red-600 hover:underline">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
