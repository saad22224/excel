<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Showusers extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public ?string $search = null;

    public function render()
    {
        return view('livewire.ShowUsers', [
            'users' => User::query() // query eloquent
                // where methods
                ->where("name", "LIKE", "%$this->search%")
                ->orWhere("email", "LIKE", "%$this->search%")
                // pagination methods
                ->paginate(10),
        ]);
    }
}
