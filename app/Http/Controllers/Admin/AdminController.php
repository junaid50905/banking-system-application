<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
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
    public function depositForm()
    {
        return view('ui.deposit');
    }
    public function depositStore(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'amount' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        $user_id = User::where('email', $request->email)->first()->id;
        Transaction::create([
            'user_id' => $user_id,
            'transaction_type' => $request->transaction_type,
            'amount' => $request->amount,
            'fee' => $request->fee,
            'date' => Carbon::now('Asia/dhaka')->toDateTimeString()
        ]);
        $user->balance += $request->amount;
        $user->save();
        return redirect()->route('admin.dashboard');
    }
    public function withdrawForm()
    {
        return view('ui.withdraw');
    }
    public function withdrawStore(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'amount' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        $user_id = User::where('email', $request->email)->first()->id;
        $account_type = User::where('email', $request->email)->first()->account_type;
        dd($account_type);
        Transaction::create([
            'user_id' => $user_id,
            'transaction_type' => $request->transaction_type,
            'amount' => $request->amount,
            'date' => Carbon::now('Asia/dhaka')->toDateTimeString(),
        ]);
        $user->balance += $request->amount;
        $user->save();
        return redirect()->route('admin.dashboard');
    }
}
