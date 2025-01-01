<?php

namespace App\Http\Livewire;

use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithPagination;
use Livewire\Component;




class Users extends Component
{
    use WithPagination;
    public $search = '';
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);
        $file = $request->file('file');
        Excel::import(new UsersImport, $file);
        return redirect()->back()->with('done' , 'users imported successfully');
    }

    public function updatingSearch()
    {
        // Reset the pagination when search changes
        $this->resetPage();
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->paginate(10);
        return view('livewire.users', compact('users'));
    }
}
