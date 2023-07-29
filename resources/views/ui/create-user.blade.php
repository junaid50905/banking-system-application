@extends('ui.layouts.master')


@section('main_panel')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Register New User</h4>
                    <form class="forms-sample" action="{{ route('store.user') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">User Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Account Type</label>
                            <div class="col-sm-9">
                                <input type="text" name="account_type" class="form-control" placeholder="account type">
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
