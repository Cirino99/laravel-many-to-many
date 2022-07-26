@extends('admin.layout.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @include('admin.includes.side-bar')
                    
                    <h1>{{$post->title}}</h1>
                    <img src="{{$post->image}}" alt="{{$post->title}}">
                    <figcaption>
                        <p>{{$post->content}}</p>
                   </figcaption>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection