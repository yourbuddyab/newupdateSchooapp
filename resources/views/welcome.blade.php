@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="border-bottom text-center">
                    <h1 class="mb-0 pb-3">Welcome to School App Installer</h1>
                </div>
                <div class="my-3">
                    <div class="border-bottom col-4 my-3">
                        <h4 class="mb-0 pb-3">1. Pre-Installation</h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                          
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Extenstion</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($extensions as $key => $value)
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>{!!$value == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-times" aria-hidden="true"></i>'!!}</td>
                                        </tr>    
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="my-3">
                        <p>Please make sure you have set the correct permissions for the directories listed below. All these directories/files should be writable.</p>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Directories</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($directories as $key => $item)
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>{!! $item ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-times" aria-hidden="true"></i>' !!}</td>
                                        </tr>    
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="my-3 col-12">
                        <a href="@if($satisfied) {{route('configuration')}} @endif" class="btn btn-primary btn-lg w-100 @if(!$satisfied) disabled @endif">Continue</a>
                    </div>
                    {{-- <form action="" method="post">
                        <div class="form-group">
                            <label for="appname">App Name</label>
                            <input type="text" name="appname" id="appname" class="form-control" placeholder="App Name">
                        </div>
                    </form> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection