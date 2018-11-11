@extends('layouts.app')

@section('content')

    <div class="row">
        @forelse($postlist as $post)
            <div class="jumbotron">
                <h2>
                    <a href="{{ route('app.posts.show', $post->getKey()) }}">
                        {{ $post->title }}
                    </a>
                </h2>
                <h4>by: {{ $post->user->name }}</h4>

                @if ($post->description)
                    <p>{{ $post->description }}</p>
                @else
                    <p>{{ str_limit(strip_tags($news->body), 50) }}</p>
                @endif

                <p class="mb-0">{{ $post->created_at->diffForHumans() }}  добавлена</p>
                <p class="mb-0">{{ $post->updated_at->diffForHumans() }}  обновлена</p>
            </div>
        @empty
            <div class="col">
                <p>Блоги пока не добавлены.</p>

            </div>
        @endforelse

        {{ $postlist->appends(request()->except('page'))->links() }}

    </div>
    @auth
        @if (\App\Models\Category::count())
            <a href="{{ route('app.posts.create') }}"
               class="btn btn-primary">
                Добавить post
            </a>
        @else
            Для начала Вам нужно
            <a href="{{ route('app.categories.create') }}"
               class="ml-3 btn btn-primary">
                Создать категорию
            </a>
        @endif
    @endauth

@endsection
