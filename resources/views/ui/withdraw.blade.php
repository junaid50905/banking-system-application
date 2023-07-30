@extends('ui.layouts.master')


@section('main_panel')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Withdraw</h4>
                    <form class="forms-sample" action="{{ route('withdraw.store') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Transaction Type</label>
                            <div class="col-sm-9">
                                <input type="text" name="transaction_type" class="form-control text-white" value="withdrawal">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control text-white" placeholder="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Amount</label>
                            <div class="col-sm-9">
                                <input type="text" name="amount" class="form-control text-white" placeholder="amount">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a class="btn btn-dark" href="{{ route('admin.dashboard') }}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
