@extends('layouts.app')
@section('head')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="m-0 float-left">Your Lists</h3>
                    <i class="fas fa-plus fa-2x float-right" onclick="newList()"></i>
                </div>
                <div class="card-body" id="listsCard">
                    <div id="listsDiv">
                        @foreach ($user->lists as $list)
                            <a href="javascript:onClick=showList({{ $list->id }})"><h5 class="m-0{{ $loop->first ? ' mt-3' : '' }}" id="list{{ $list->id }}">{{ $list->name }}</h5></a> <br>
                        @endforeach
                    </div>
                    <form id="newListForm" class="d-none" action="javascript:storeList({{ $user->id }})" method="POST">
                        @csrf
                        <label for="newListName">New List Name:</label><br>
                        <input type="text" id="newListName" name="name" class="w-100"><br><br>
                        <input type="submit">
                    </form>
                </div>
                
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header text-center">
                    <h3 id="listName" class="m-0"></h3>
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
                        oneTask = $("<h4></h4>").text(tasks[i]);
                        oneTask.addClass("task");
                        $("#tasks").append(oneTask);
                    }
                    listName = $('#list'+id).html();
                    $('#listName').html(listName);
                }
            });
    }
    function newList(){
        $('#newListForm').removeClass('d-none');
        $('#newListForm').addClass('d-block');
    }
    function storeList(id){
        $.ajax({
                type:'POST',
                url:'/list/store',
                data:{_token: "{{ csrf_token() }}", userId: id, newListName: $('#newListName').val()
                },
                success: function( data ) {
                    listId = data[0];
                    listName = data[1];
                    var newList = $('<a></a>')
                    newList.attr('href', "javascript:onClick=showList("+listId+")");
                    newList.html("<h5 class='m-0' id='list"+listId+"'>"+listName+"</h5><br>");
                    $("#listsDiv").append(newList);
                }
            });
    }
</script>