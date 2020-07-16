@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="border-bottom text-center">
                        <h1 class="mb-0 pb-3">Welcome to School App Installer</h1>
                    </div>
                    <div class="my-3">
                        <div class="border-bottom col-4 my-3">
                            <h4 class="mb-0 pb-3">2. Configuration</h4>
                        </div>
                    </div>
                    <div class="my-3">
                        <p>Enter your App details.</p>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="host">Name<span>*</span></label>
                        <input type="text" name="app[name]" placeholder="Your app name" id="name" autofocus=""
                            class="form-control @error('app.name') is-invalid @enderror" value="{{ old('app.name') }}">

                        @error('app.name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="host">Environment<span>*</span></label>
                        <input type="text" name="app[env]" placeholder="local or production" id="host" autofocus=""
                            class="form-control @error('app.env') is-invalid @enderror" value="{{ old('app.env') }}">

                        @error('app.env')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="host">Debug Mode<span>*</span></label>
                        <input type="text" name="app[debug]" placeholder="True or False" id="host" autofocus=""
                            class="form-control @error('app.debug') is-invalid @enderror"
                            value="{{ old('app.debug') }}">

                        @error('app.debug')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="host">App URL<span>*</span></label>
                        <input type="text" name="app[url]" placeholder="http://localhost" id="host" autofocus=""
                            class="form-control @error('app.url') is-invalid @enderror" value="{{ old('app.url') }}">

                        @error('app.url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="logo">App Logo<span>*</span></label>
                        <div class="custom-file">
                            <input type="file" name="app[logo]"
                                class="custom-file-input @error('app.logo') is-invalid @enderror" id="logo">
                            <label class="custom-file-label" for="logo">Choose file</label>
                        </div>
                        @error('app.logo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="my-3">
                        <p>Enter your database connection details.</p>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="host">Host <span>*</span></label>
                        <input type="text" name="db[host]" placeholder="Mostly 127.0.0.1 or localhost" id="host"
                            autofocus="" class="form-control @error('db.host') is-invalid @enderror"
                            value="{{ old('db.host') }}">

                        @error('db.host')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="port">Port <span>*</span></label>
                        <input type="text" name="db[port]" placeholder="Mostly 3306" id="port"
                            class="form-control @error('db.port') is-invalid @enderror" value="{{ old('db.port') }}">

                        @error('db.port')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="database">Database <span>*</span></label>
                        <input type="text" name="db[database]" placeholder="Database name" id="database"
                            class="form-control @error('db.database') is-invalid @enderror"
                            value="{{ old('db.database') }}">

                        @error('db.database')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="db-username">DB Username <span>*</span></label>
                        <input autocomplete="new-user" type="text" name="db[username]" placeholder="Database username"
                            id="db-username" class="form-control @error('db.username') is-invalid @enderror"
                            value="{{ old('db.username') }}">

                        @error('db.username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="db-password">DB Password</label>
                        <input autocomplete="new-password" type="text" name="db[password]"
                            placeholder="Database password" id="db-password"
                            class="form-control @error('db.password') is-invalid @enderror">

                        @error('db.password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary btn-lg w-100">Next</button>
                    </div>

                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection