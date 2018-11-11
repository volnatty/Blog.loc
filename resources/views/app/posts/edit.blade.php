@extends('layouts.app')

@section('content')




    <h2>Updating POST</h2>

    @php
        $route = route('app.posts.store');
        $method = 'post';
        if (isset($post)) {

            $route = route('app.posts.update', $post);
            $method = 'patch';
        }
    @endphp

    <form action="{{ $route }}" method="post">
        @csrf
        @method($method)

        <div class="form-group{{ $errors->has('title') ? ' is-invalid' : '' }}">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') ?? $post->title }}" required>
            @if($errors->has('title'))
                <div class="mt-1 text-danger">
                    {{ $errors->first('title') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="category">Категория (previous: {{$post->category->title}}</label>
            <select name="category_id" id="category" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Краткое описание</label>
            <textarea name="description" id="description" rows="2" class="form-control">{{ old('description') ?? $post->description }}</textarea>
        </div>

        <div class="form-group{{ $errors->has('body') ? ' is-invalid' : '' }}">
            <label for="body">Текст поста</label>
            <textarea class="form-control" id="body" name="body" rows="4" required>{{ old('body') ?? $post->body}}</textarea>
            @if($errors->has('body'))
                <div class="mt-1 text-danger">
                    {{ $errors->first('body') }}
                </div>
            @endif
        </div>

        @if ($tags->count())
            <div class="form-group">
                @foreach($tags as $tag)
                    <label class="mr-3">
                        <input type="checkbox" name="tags[]"
                               value="{{ $tag->getKey() }}">
                        {{ $tag->title }}
                    </label>
                @endforeach
            </div>
        @endif

        @if ($post->picture)
            <label for="picture" class="form-group">
                <img src="{{ asset($post->picture) }}" alt="NO IMAGE">
            </label>
        @endif

        <div class="form-group">
            <label>Image</label>
            <input type="file" class="form-control" id="picture" name="picture">
        </div>

        <div class="mt-4">
            <button class="btn btn-primary">Сохранить</button>
        </div>

    </form>

@endsection
