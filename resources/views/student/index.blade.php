@extends('layouts.sidebar')
@section('breadcrumbs')
{{ Breadcrumbs::render('student') }}
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <a href="/student/create" class="btn btn-link"><i class="text-dark fa fa-plus" aria-hidden="true"></i></a>
                        <div class="ml-auto">
                            <form action="/student/check" method="post">
                                @csrf
                                @if (auth()->user()->status == 0)
                                    <select class="form-control" name="class" id="class">
                                        <option>Select Class</option>
                                        @foreach ($clas as $item)
                                            <option value="{{$item->id}}">{{$item->class}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    @foreach ($clas as $item)
                                        @if ($teacher->class == $item->class)
                                            <input type="text" name="class_id" hidden id="teacherlog" value="{{$item->id}}">
                                            <input type="text" disabled name="date" value="{{$item->class}}" class="form-control">
                                        @endif
                                    @endforeach
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Roll No</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Student Username</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div id="loading" class="d-none" style="
       position: fixed;
    top: 50%;
    left: 50%;
    z-index: 5000;
    transform: translate(-50%, -50%);
">
        <img src="http://appadmin.nalandapublicschoolbikaner.com/image/800.gif">
    </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        @if (auth()->user()->status == 0)
        $('#class').change(function(e){
            const class_id = $(this).val();
            const _token = $('input[name="_token"]').val();
        @else
        $(document).ready(function() {
            const class_id = $('#teacherlog').val();
            const _token = $('input[name="_token"]').val();
        setTimeout(function() {
        jQuery.support.cors = true;
        @endif
        $.ajax({
                type: "post",
                url: "/student/check",
                data: {'class_id':class_id,'_token':_token},
                beforeSend: function(){
                   $("#loading").removeClass('d-none');
                },
                complete: function(){
                   $("#loading").addClass('d-none');
                },
                success: function (response) {
                    $("table").each(function(){
                            $(this).find('td').remove();

                    });
                    for (let index = 0; index < response.length; index++) {
                        const element = response[index];

                        var input = "<tr><td>"+element.roll_no+"</td>"+"<td>"+element.name+"</td>"+"<td>"+element.username+"</td>"+"<td>"+element.phone+"</td>"+"<td>"+"<a class='text-center' href='/student/"+element.id+"/edit'><i class='fas fa-edit text-dark'></i></a></td><td></tr>";
                        $('tbody').append(input);
                    }
                }
            });
            @if (auth()->user()->status == 1)
    },1000);
        @endif
        });

    </script>
@endsection
