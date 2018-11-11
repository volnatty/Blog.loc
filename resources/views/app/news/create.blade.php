@extends('layouts.app')

@section('content')
    @php
    $route = route('app.news.store');
    $method = 'post';

    if (isset($news)) {
        $route = route('app.news.update', $news);
        $method = 'patch';
    }
    @endphp

    <form action="{{ $route }}" method="post">
        @csrf
        @method($method)

        <div class="form-group{{ $errors->has('title') ? ' is-invalid' : '' }}">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            @if($errors->has('title'))
                <div class="mt-1 text-danger">
                    {{ $errors->first('title') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="category">Категория</label>
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
            <textarea name="description" id="description" rows="2" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="form-group{{ $errors->has('body') ? ' is-invalid' : '' }}">
            <label for="body">Текст новости</label>
            <textarea class="form-control" id="body" name="body" rows="4" required>{{ old('body') }}</textarea>
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

        <div class="mt-4">
            <button class="btn btn-primary">Сохранить</button>
        </div>
    </form>
@endsection
