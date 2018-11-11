@extends('layouts.app')

@section('content')

    <div class="row">
        @forelse($newslist as $news)

        @empty
            <div class="col">
                <p>Новости пока не добавлены.</p>
                @auth
                    <a href="{{ route('app.news.create') }}"
                       class="btn btn-primary">
                        Добавить новость
                    </a>
                @endauth
            </div>
        @endforelse
    </div>

@endsection
