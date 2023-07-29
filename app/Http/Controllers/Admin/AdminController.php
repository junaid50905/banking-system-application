<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        $total_users = User::count();
        return view('ui.dashboard', compact('total_users'));
    }
    public function create()
    {
        return view('ui.create-user');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'account_type' => 'required'
        ]);
        User::create($request->all());
        return redirect()->route('admin.dashboard');
    }
}
