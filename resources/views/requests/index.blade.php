@extends('app')

@section('content')

<div class="row">
    <div class="col-8 offset-2">
        @if(Session::has('token'))
            <div class="alert alert-danger">
                {{Session::get('token')}}
            </div>
        @endif
    </div>
</div>

@endsection
