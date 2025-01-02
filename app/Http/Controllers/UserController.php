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
        if($file->getClientOriginalExtension() != 'xlsx'){
            return redirect()->back()->with('error' , 'file must be xlsx');
        }
        try{
            Excel::import(new UsersImport, $file);
            return redirect()->back()->with('done' , 'users imported successfully');
        }catch(\Exception $e){
            return redirect()->back()->with('error' , 'something went wrong');
        }
    }

    public function index()
    {
        $users = User::all();
        return view('users' ,[
            'users' => DB::table('users')->paginate(10)
        ]);
    }

}
