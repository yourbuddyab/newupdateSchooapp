@extends('layouts.sidebar')
@section('breadcrumbs')
{{ Breadcrumbs::render('teacher') }}
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md 12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mt-2">Teachers</h3>
                    <div class="card-tools">
                        <a href="/teacher/create" class="btn btn-secondary"><i class="fa fa-plus" aria-hidden="true"></i></a>
                    </div>
                  </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Name</td>
                                <td>Phone</td>
                                <td>Subject</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->sub}}</td>
                                <td>
                                    <form action="/teacher/{{$item->id}}" method="post">
                                        @csrf
                                        @method('patch')
                                        <div class="form-group">
                                            <input type="text" name="roll" hidden value="Status" id="">
                                            <select name="status" class="form-control" onchange="this.form.submit()">
                                                <option value="1" {{$item->status == 1 ? 'selected' : ' '}}>Active</option>
                                                <option value="0" {{$item->status == 0 ? 'selected' : ' '}}>Deactive</option>
                                                <option value="2" {{$item->status == 2 ? 'selected' : ' '}}>Permanent Delete</option>
                                            </select>
                                        </div>
                                    </form>
                                </td>
                                <td class="text-center">
                                    @if ($item->status == 1)
                                    <a href="/teacher/{{$item->id}}/edit" class="text-dark"><i class="fas fa-edit"></i></a>
                                    @endif
                                    <button class="fa fa-trash ml-2 btn-delete" data-toggle="modal" data-target="#myModal{{$item->id}}"></button>
                                    <div class="modal" id="myModal{{$item->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Confirm</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4 class="modal-title">Are You Sure?</h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="/teacher/{{$item->id}}" method="post">
                                                        @csrf @method('delete')
                                                        <button class="btn btn-danger">Delete</button>
                                                    </form>
                                                    <button class="btn btn-info" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($item->status == 1)
                                    <button class="fa fa-user ml-2 btn-delete" data-toggle="modal" data-target="#myModalroll{{$item->id}}"></button>
                                    <div class="modal" id="myModalroll{{$item->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Class Teacher</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <form action="/teacher/{{$item->id}}" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="modal-title">Are You Sure {{$item->name}} as class teacher ?</h4>
                                                        @if (!empty($item->class))
                                                            <h6 class="text-danger">Already class teacher of {{$item->class}}</h6> 
                                                        @endif
                                                        @csrf 
                                                        @method('patch')
                                                        <div class="form-group row my-5">
                                                            <div class="col-md-12">
                                                                <label for="class">Choose Roll and Class</label>
                                                                <input type="text" name="roll" value="Roll" hidden >
                                                            </div>
                                                            <div class="col-md-6">
                                                                <select name="rolls" class="form-control rolls">
                                                                <option>Select Roll for {{$item->name}}</option>
                                                                    <option value="0" {{$item->roll == 0 ? 'selected' : ''}}>Non Class Teacher</option>
                                                                    <option value="1" {{$item->roll == 1 ? 'selected' : ''}}>Class Teacher</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <select name="class" disabled class="form-control class">
                                                                    <option disabled>select class</option>
                                                                    @foreach ($list as $key => $checkclass)
                                                                        @foreach ($class as $classes)
                                                                            @if ($checkclass->class != $classes->class)
                                                                                @php
                                                                                    $newclass[] = $classes->class;
                                                                                    $uniqueclass = array_unique($newclass)
                                                                                @endphp
                                                                            @else
                                                                                @php
                                                                                    $newclass[] = ''; 
                                                                                @endphp
                                                                            @endif
                                                                            @endforeach
                                                                        @endforeach
                                                                        @foreach ($uniqueclass as $testclass)
                                                                            @if (!empty($testclass))
                                                                                <option value="{{$testclass}}">{{$testclass}}</option>
                                                                                
                                                                            @endif
                                                                        @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                            <button class="btn btn-info" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
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
@section('js')
<script>
  $('.rolls').change(function(e){
    const rolls = $(this).val();
    if (rolls == 0) {
        $('.class').prop('disabled', true);
    }else{
        $('.class').prop('disabled', false);
    }
  });
</script>
@endsection
@endsection
