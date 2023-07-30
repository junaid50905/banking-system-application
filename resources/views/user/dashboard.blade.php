@extends('user.layouts.master')


@section('main_content')
    <h4>User Dashboard</h4>
    <div class="row">
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-2">{{ $data->balance }}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success">
                                <i>৳</i>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Current Balance</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $transactions->count() }}</h3>
                            </div>
                        </div>
                        <div class="col-3 d-flex gap-1">
                            <div class="icon icon-box-success">
                                <span class="mdi mdi-arrow-top-right icon-item"></span>
                            </div>
                            <div class="icon icon-box-danger">
                                <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total number of transactions</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $total_transaction }}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success">
                                <i>৳</i>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total transactions</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $total_withdraw }}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-danger">
                                <i>৳</i>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total withdraw</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Transactions</h4>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Date</th>
                                        <th>Fee</th>
                                        <th>Amount</th>
                                        <th>Transaction Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $transaction->date }}</td>
                                            <td>{{ $transaction->fee }}</td>
                                            <td
                                                class="text-{{ $transaction->transaction_type === 'deposit' ? 'success' : 'danger' }}">
                                                {{ $transaction->amount }} <i
                                                    class="mdi mdi-arrow-{{ $transaction->transaction_type === 'deposit' ? 'up' : 'down' }}"></i>
                                            </td>
                                            <td><label
                                                    class="badge badge-{{ $transaction->transaction_type === 'deposit' ? 'success' : 'danger' }}">{{ $transaction->transaction_type }}</label>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
