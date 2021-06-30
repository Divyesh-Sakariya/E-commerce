<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AdminDashboardComonent extends Component
{
    public function render()
    {
        return view('livewire.admin.admin-dashboard-comonent')->layout('layouts.base');
    }
}
