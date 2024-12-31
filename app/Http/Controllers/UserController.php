<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);
        $file = $request->file('file');
        Excel::import(new UsersImport, $file);
        return redirect()->back()->with('done' , 'users imported successfully');
    }

    public function index()
    {
        $users = User::all();
        return view('users' ,[
            'users' => DB::table('users')->paginate(10)
        ]);
    }
   // تعريف خاصية البحث
        public $search = '';
    public function search()
    {
        return view('users', [
            'users' => User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%'),
        ]);
    }
}
