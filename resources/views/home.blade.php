@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center"><h3 class="m-0">Your Lists</h3></div>
                <div class="card-body">
                    @foreach ($user->lists as $list)
                        <h5 class="m-0">{{ $list->name }}</h5> <br>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
