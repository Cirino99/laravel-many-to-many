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
                    
                    <h1>Update post</h1>
                    <form action="{{ route('admin.posts.update', ['post' => $post]) }}" method="post" novalidate>
                        @method('PUT')
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="title">Title</label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ $post->title }}">
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="slug">Slug</label>
                            <input class="form-control @error('slug') is-invalid @enderror" type="text" name="slug" id="slug" value="{{ $post->slug }}">
                            <button type="button" class="btn btn-primary">Reset</button>
                            @error('slug')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="image">Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="url" name="image" id="image" value="{{ $post->image }}">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="category_id">Category</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                                <option disabled value="">Choose...</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if($category->id === $post->category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <fieldset class="mb-3 my-fieldset">
                            <legend>Tags</legend>
                            @foreach ($tags as $tag)
                                <div class="form-check">
                                    {{-- ricordarsi di aggiungere [] al name per avere un array come valore di ritorno --}}
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="tags[]"
                                        value="{{ $tag->id }}"
                                        id="tag-{{ $tag->id }}"
                                        @foreach ($post->tags as $tagPost)
                                            @if($tag->id === $tagPost->id) checked @endif
                                        @endforeach
                                    >
                                    <label class="form-check-label" for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                                </div>
                            @endforeach

                            {{-- TODO: l'errore non si vede --}}
                            @error('tags')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </fieldset>

                        <div class="mb-3">
                            <label class="form-label" for="content">Content</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content">{{ $post->content }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection