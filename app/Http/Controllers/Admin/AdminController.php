<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // adminDashboard
    public function adminDashboard()
    {
        $total_users = User::count();
        return view('ui.dashboard', compact('total_users'));
    }
    // create
    public function create()
    {
        return view('ui.create-user');
    }
    // store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'account_type' => 'required'
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'account_type' => $request->account_type,
        ]);
        return redirect()->route('admin.dashboard');
    }
    // depositForm
    public function depositForm()
    {
        return view('ui.deposit');
    }
    // depositStore
    public function depositStore(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'amount' => 'required',
            'transaction_type' => 'required',
            'fee' => 'required',
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
    // withdrawForm
    public function withdrawForm()
    {
        return view('ui.withdraw');
    }
    // withdrawStore
    public function withdrawStore(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'amount' => 'required',
            'transaction_type' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        $user_id = User::where('email', $request->email)->first()->id;
        $account_type = User::where('email', $request->email)->first()->account_type;
        $total_withdraw = Transaction::where('user_id', $user_id)->where('transaction_type', 'withdrawal')->sum('amount');


        Transaction::create([
            'user_id' => $user_id,
            'transaction_type' => $request->transaction_type,
            'amount' => $request->amount,
            'date' => Carbon::now('Asia/dhaka')->toDateTimeString(),
            'fee' => $account_type === 'individual' ? (Carbon::now()->format('l') === 'Friday' ? 0.00 : $request->amount * 0.00015) : ($total_withdraw >= 50000 ? $request->amount * 0.00015 : $request->amount * 0.00025),
        ]);
        $user->balance -= $request->amount;
        $user->balance -= $account_type === 'individual' ? (Carbon::now()->format('l') === 'Friday' ? 0.00 : $request->amount * 0.00015) : ($total_withdraw === 50000 ? $request->amount * 0.00015 : $request->amount * 0.00025);
        $user->save();
        return redirect()->route('admin.dashboard');
    }
}
