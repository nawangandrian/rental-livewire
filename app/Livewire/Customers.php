<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;

class Customers extends Component
{
    public $customers, $customer_id, $name, $phone, $email, $address;
    public $updateMode = false;

    public function mount()
    {
        $this->resetInput();
    }

    public function render()
    {
        $this->customers = Customer::all();
        return view('livewire.customers.index');
    }

    public function resetInput()
    {
        $this->name = '';
        $this->phone = '';
        $this->email = '';
        $this->address = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:customers,email',
        ]);

        Customer::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
        ]);

        session()->flash('message', 'Customer created successfully.');

        $this->resetInput();
        $this->customers = Customer::all();
    }

    public function edit($id)
    {
        $record = Customer::findOrFail($id);
        $this->customer_id = $id;
        $this->name = $record->name;
        $this->phone = $record->phone;
        $this->email = $record->email;
        $this->address = $record->address;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:customers,email,' . $this->customer_id . ',customer_id',
        ]);

        $record = Customer::find($this->customer_id);
        $record->update([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
        ]);

        $this->updateMode = false;
        session()->flash('message', 'Customer updated successfully.');
        $this->resetInput();
        $this->customers = Customer::all();
    }

    public function delete($id)
    {
        Customer::find($id)->delete();
        session()->flash('message', 'Customer deleted successfully.');
    }
}
