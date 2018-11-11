@extends('layouts.app')

@section('content')
    <h1>
        <a href="{{ route('app.categories.index') }}">
            Категория:
        </a>
        {{ $category->title }}

    </h1>
    <h2>Новости:</h2>
    @forelse($category->news as $news)
        <div class="row">
            <h2>
                <div class="ml-3">

                    <a href="{{ route('app.news.show', ['news' => $news->getKey()]) }}">
                        {{ $news->title }}
                    </a>
                    <h5><p> by {{$news->user->name}}</p></h5>
                </div>

            </h2>

        </div>
    @empty
        <h2>Нет новостей в данной категории</h2>
    @endforelse
    @auth
        <a href="{{ route('app.news.create') }}"
           class="btn btn-primary">
            Добавить новость
        </a>
    @endauth

    <h2>Обзоры:</h2>
    @forelse($category->posts as $post)
        <div class="row">
            <h2>
                <div class="ml-3">
                    <a href="{{ route('app.posts.show', ['post' => $post->getKey()]) }}">
                        {{ $post->title }}
                    </a>
                    <h5><p> by {{$post->user->name}}</p></h5>
                </div>

            </h2>

        </div>
    @empty
        <h2>Нет обзоров в данной категории</h2>
    @endforelse
    @auth
        <a href="{{ route('app.posts.create') }}"
           class="btn btn-primary">
            Добавить блог
        </a>
    @endauth
@endsection
