@extends('admin.layout.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h2>Amminiostrazione sito:</h2>
                    <ul>
                        <li class="mb-2">
                            Lista utenti regitrati: <a href="{{route('admin.users.index')}}" class="btn btn-primary">Utenti</a>
                        </li>
                        <li class="mb-2">
                            Lista posts: <a href="{{route('admin.posts.index')}}" class="btn btn-primary">Posts</a>
                        </li>
                        <li class="mb-2">
                            Nuovo post: <a href="{{route('admin.posts.create')}}" class="btn btn-primary">New Post</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
