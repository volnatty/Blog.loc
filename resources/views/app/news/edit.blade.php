@extends('layouts.app')

@section('content')


        <h2>UPDATING</h2>

    @php
        $route = route('app.news.store');
        $method = 'post';

        if (isset($news)) {

            $route = route('app.news.update', $news);
            $method = 'patch';
        }
    @endphp

    <form action="{{ route('app.news.update', $news) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="form-group{{ $errors->has('title') ? ' is-invalid' : '' }}">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') ?? $news->title }}" required>
            @if($errors->has('title'))
                <div class="mt-1 text-danger">
                    {{ $news->title }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="category">Категория (previous: {{$news->category->title}})</label>
            <select name="category_id" id="category" class="form-control" >
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Краткое описание</label>
            <textarea name="description" id="description" rows="2" class="form-control">{{ old('description') ?? $news->description}}</textarea>
        </div>

        <div class="form-group{{ $errors->has('body') ? ' is-invalid' : '' }}">
            <label for="body">Текст новости</label>
            <textarea class="form-control" id="body" name="body" rows="4" required>{{ old('body') ?? $news->body }}</textarea>
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

        @if ($news->picture)
            <label for="picture" class="form-group">
                <img src="{{ asset($news->picture) }}" alt="">
            </label>
        @endif

        <div class="form-group">
            <label>Image</label>
            <input type="file" class="form-control" id="picture" name="picture">
        </div>


        <div class="mt-4">
            <button class="btn btn-primary">Обновить</button>
        </div>
    </form>
@endsection


