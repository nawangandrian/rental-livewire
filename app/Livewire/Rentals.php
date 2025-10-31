<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rental;
use App\Models\Customer;
use App\Models\Item;

class Rentals extends Component
{
    public $rentals, $rental_id, $customer_id, $item_id, $rent_date, $return_date, $total_price, $status;
    public $customers, $items;
    public $updateMode = false;

    public function mount()
    {
        $this->customers = Customer::all();
        $this->items = Item::where('is_available', true)->get();
        $this->rent_date = now()->toDateString();
        $this->return_date = null;
        $this->total_price = 0;
        $this->status = 'rented';
    }

    public function render()
    {
        $this->rentals = Rental::with(['customer', 'item'])->get();
        return view('livewire.rentals.index');
    }

    public function resetInput()
    {
        $this->customer_id = '';
        $this->item_id = '';
        $this->rent_date = now()->toDateString();
        $this->return_date = null;
        $this->total_price = 0;
        $this->status = 'rented';
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['rent_date', 'return_date', 'item_id'])) {
            $this->calculateTotalPrice();
        }
    }


    public function calculateTotalPrice()
    {
        if (!$this->item_id || !$this->rent_date || !$this->return_date) {
            $this->total_price = 0;
            return;
        }

        $item = Item::find($this->item_id);
        if (!$item) {
            $this->total_price = 0;
            return;
        }

        $days = (strtotime($this->return_date) - strtotime($this->rent_date)) / 86400 + 1;
        $this->total_price = $item->price_per_day * $days;
    }

    public function store()
    {
        $this->validate([
            'customer_id' => 'required',
            'item_id' => 'required',
            'rent_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:rent_date',
        ]);

        $item = Item::find($this->item_id);
        $days = max(1, (strtotime($this->return_date) - strtotime($this->rent_date)) / 86400);
        $total_price = $item->price_per_day * $days;

        Rental::create([
            'customer_id' => $this->customer_id,
            'item_id' => $this->item_id,
            'rent_date' => $this->rent_date,
            'return_date' => $this->return_date,
            'total_price' => $total_price,
            'status' => $this->status ?? 'rented', // ✅ jaga agar tidak null
        ]);

        $item->is_available = false;
        $item->save();

        session()->flash('message', 'Rental created successfully.');
        $this->resetInput();
    }

    public function edit($id)
    {
        $record = Rental::findOrFail($id);
        $this->rental_id = $id;
        $this->customer_id = $record->customer_id;
        $this->item_id = $record->item_id;
        $this->rent_date = $record->rent_date;
        $this->return_date = $record->return_date;
        $this->total_price = $record->total_price;
        $this->status = $record->status;
        $this->updateMode = true;
    }

    public function update()
    {
        if ($this->rental_id) {
            $record = Rental::find($this->rental_id);
            $record->update([
                'customer_id' => $this->customer_id,
                'item_id' => $this->item_id,
                'rent_date' => $this->rent_date,
                'return_date' => $this->return_date,
                'total_price' => $this->total_price,
                'status' => $this->status ?? 'rented',
            ]);
            $this->updateMode = false;
            session()->flash('message', 'Rental updated successfully.');
            $this->resetInput();
        }
    }

    public function delete($id)
    {
        if ($id) {
            $record = Rental::find($id);
            if ($record) {
                $item = $record->item;
                if ($item) {
                    $item->is_available = true;
                    $item->save();
                }
                $record->delete();
                session()->flash('message', 'Rental deleted successfully.');
            }
        }
    }
}
