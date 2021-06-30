<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class UserDashboardComonent extends Component
{
    public function render()
    {
        return view('livewire.user.user-dashboard-comonent')->layout('layouts.base');
    }
}
