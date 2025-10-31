<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rental;
use App\Models\Customer;
use App\Models\Item;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $totalCustomers;
    public $totalItems;
    public $activeRentals;
    public $totalRevenue;
    public $latestRentals;
    public $rentalChartLabels = [];
    public $rentalChartData = [];

    public function mount()
{
    // Statistik ringkas
    $this->totalCustomers = Customer::count();
    $this->totalItems = Item::count();
    $this->activeRentals = Rental::where('status', 'rented')->count();
    $this->totalRevenue = Rental::sum('total_price');

    // 5 rental terbaru
    $this->latestRentals = Rental::with(['customer', 'item'])->latest()->take(5)->get();

    // Chart 7 hari terakhir
    $period = CarbonPeriod::create(now()->subDays(6), now());

    $rentalCounts = Rental::where('created_at', '>=', now()->subDays(6))
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
        ->groupBy('date')
        ->pluck('count', 'date')
        ->toArray();

    $this->rentalChartLabels = [];
    $this->rentalChartData = [];

    foreach ($period as $date) {
        $day = $date->format('Y-m-d');
        $this->rentalChartLabels[] = $date->format('d M');
        $this->rentalChartData[] = $rentalCounts[$day] ?? 0;
    }

    // ❌ Hapus emit atau dispatchBrowserEvent
}



    public function render()
    {
        return view('livewire.dashboard');
    }
}
