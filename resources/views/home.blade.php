@extends('layouts.app')
@section('head')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center"><h3 class="m-0">Your Lists</h3></div>
                <div class="card-body">
                    @foreach ($user->lists as $list)
                        <a href="javascript:onClick=showList({{ $list->id }})"><h5 class="m-0">{{ $list->name }}</h5></a> <br>
                    @endforeach
                    
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header text-center">
                    
                </div>
                <div class="card-body" id="tasks">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    var oneTask;
    function showList(id){
        $.ajax({
                type:'POST',
                url:'/list',
                data:{_token: "{{ csrf_token() }}", listId: id
                },
                success: function( tasks ) {
                    $("#tasks").html("");
                    for(i=0;i<tasks.length;i++) {
                        oneTask = $("<h5></h5>").text(tasks[i]);
                        oneTask.addClass("task");
                        $("#tasks").append(oneTask);
                    }

                }
            });
    }
</script>