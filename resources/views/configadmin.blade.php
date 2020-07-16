@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    @csrf
                    <div class="border-bottom text-center">
                        <h1 class="mb-0 pb-3">Welcome to School App Installer</h1>
                    </div>
                    <div class="my-3">
                        <div class="border-bottom col-4 my-3">
                            <h4 class="mb-0 pb-3">3. Configure Admin</h4>
                        </div>
                    </div>
                    <div class="my-3">
                        <p>Enter credentials for the administrator.</p>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label" for="admin-name">Full Name<span>*</span></label>
                        <input type="text" name="admin[name]" placeholder="Admin's full name" id="admin-name"
                            class="form-control @error('admin.name') is-invalid @enderror" value="{{ old('admin.name') }}">
                
                        @error('admin.name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="admin-email">Email <span>*</span></label>
                        <input type="text" name="admin[email]" placeholder="Email address" id="admin-email"
                            class="form-control @error('admin.email') is-invalid @enderror" value="{{ old('admin.email') }}">
                
                        @error('admin.email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="admin-password">Password <span>*</span></label>
                        <input type="password" name="admin[password]" placeholder="Password" id="admin-password"
                            class="form-control @error('admin.password') is-invalid @enderror">
                
                        @error('admin.password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-lg w-100">Install</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection