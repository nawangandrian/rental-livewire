<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;

class Items extends Component
{
    public $items;
    public $item_name, $category, $stock, $price_per_day, $description, $is_available;
    public $editId = null;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->items = Item::all();
    }

    public function resetForm()
    {
        $this->item_name = '';
        $this->category = '';
        $this->stock = '';
        $this->price_per_day = '';
        $this->description = '';
        $this->is_available = true;
        $this->editId = null;
    }

    public function save()
    {
        $this->validate([
            'item_name' => 'required|string|max:100',
            'category' => 'nullable|string|max:50',
            'stock' => 'required|integer|min:0',
            'price_per_day' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        if ($this->editId) {
            $item = Item::find($this->editId);
            $item->update([
                'item_name' => $this->item_name,
                'category' => $this->category,
                'stock' => $this->stock,
                'price_per_day' => $this->price_per_day,
                'description' => $this->description,
                'is_available' => $this->is_available,
            ]);
        } else {
            Item::create([
                'item_name' => $this->item_name,
                'category' => $this->category,
                'stock' => $this->stock,
                'price_per_day' => $this->price_per_day,
                'description' => $this->description,
                'is_available' => $this->is_available,
            ]);
        }

        $this->resetForm();
        $this->loadData();
    }

    public function edit($item_id)
    {
        $i = Item::find($item_id);

        if (!$i) return;

        $this->editId = $i->item_id;
        $this->item_name = $i->item_name;
        $this->category = $i->category;
        $this->stock = $i->stock;
        $this->price_per_day = $i->price_per_day;
        $this->description = $i->description;
        $this->is_available = $i->is_available;
    }

    public function delete($item_id)
    {
        Item::find($item_id)?->delete();
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.items.index', [
            'items' => $this->items,
        ]);
    }
}
