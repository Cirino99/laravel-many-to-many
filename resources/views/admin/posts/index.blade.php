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
                    
                    <h1>Posts</h1>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Slug</th>
                                <th>Title</th>
                                <th colspan="3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr data-id="{{ $post->id }}">
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>{{ $post->slug }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>
                                        <a href="{{ route('admin.posts.show', ['post' => $post]) }}" class="btn btn-primary">View</a>
                                    </td>
                                    <td>
                                        @if(Auth::id() == $post->user_id)
                                            <a href="{{ route('admin.posts.edit', ['post' => $post]) }}" class="btn btn-warning">Edit</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if(Auth::id() == $post->user_id)
                                            <button class="btn btn-danger js-delete">Delete</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{$posts->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection