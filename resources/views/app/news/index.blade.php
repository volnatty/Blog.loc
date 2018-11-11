@extends('layouts.app')

@section('content')

    <div class="row">
        @forelse($newslist as $news)
            <div class="jumbotron">
                <h2>
                    <a href="{{ route('app.news.show', $news->getKey()) }}">
                        {{ $news->title }}
                    </a>
                </h2>
                <h4>by: {{ $news->user->name }}</h4>

                @if ($news->description)
                    <p>{{ $news->description }}</p>
                @else
                    <p>{{ str_limit(strip_tags($news->body), 50) }}</p>
                @endif
                <img src="{{ $news->picture }}" class="rounded" width="50" alt="">
                <p class="mb-0">{{ $news->created_at->diffForHumans() }}  добавлена</p>
                <p class="mb-0">{{ $news->updated_at->diffForHumans() }}  обновлена</p>
            </div>
        @empty
            <div class="col">
                <p>Новости пока не добавлены.</p>
            </div>
        @endforelse
    </div>

    {{ $newslist->appends(request()->except('page'))->links() }}

    @auth
        <a href="{{ route('app.news.create') }}"
           class="btn btn-primary">
            Добавить новость
        </a>

        <a href="{{ route('app.tags.create') }}"
           class="ml-3 btn btn-secondary">
            Добавить тег
        </a>
    @endauth

@endsection
