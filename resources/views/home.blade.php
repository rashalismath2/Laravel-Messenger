@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-10">
            <div class="card">
                <div class="card-header">
                    We Code Messenger
                </div>
                <div  class="card-body p-0">
                    <App v-bind:user="{{auth()->user()}}"></App>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
