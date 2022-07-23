@extends('layouts.app')

@section('content')
    <div class="pt-md-6">
        <div class="text-center container-fluid">
            <h1> {{__('public.welcome')." ".auth()->user()->name}}</h1>
        </div>
    </div>
    <div class="container-fluid">
        @include('layouts.footers.auth')
    </div>
@endsection

