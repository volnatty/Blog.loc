@extends('layouts.app')

@section('content')

    <div class="d-flex align-items-center">
        <h1>{{ $review->title }}</h1>
        <div class="ml-3">
            <a href="{{ route('app.categories.show', $review->category->getKey()) }}">
                {{ $review->category->title }}
            </a>
        </div>
    </div>

    @if ($review->description)
        <p class="lead">{{ $review->description }}</p>
    @endif

    {!! $review->body !!}

    @if ($review->tags->count())
        <p class="mt-5 mb-0">
            @foreach($review->tags as $tag)
                <a href="{{ route('app.reviews.index', ['tag' => $tag->getKey()]) }}" class="bg-dark text-white px-2 py-1 mr-2 rounded">
                    {{ $tag->title }}
                </a>
            @endforeach
        </p>
    @endif

        <p class="mt-4">
        Автор:
        <img src="{{ $review->user->user_avatar }}" class="rounded-circle" width="30" alt="">
        <a href="{{ route('app.reviews.index', ['author' => $review->user]) }}">
            {{ $review->user->name }}
        </a>
    </p>

    <h2 class="mt-5">Комментарии -- {{ $review->comments_count }}</h2>




@endsection
